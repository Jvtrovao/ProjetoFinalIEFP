<?php include 'includes/head.php' ?>
</head>
    <body>
    <?php include 'includes/header.php' ?>
    <div id="page-container">
        <div id="content-wrap">
        <?php

        //connection to database
        include 'includes/db_conn.php';

        //recieve id of client
        $idClient = $_POST['idClient'];
        ?>


        <h2>Shop</h2>
        <table class='paddingBetweenCols'>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Sub Total</th>
            </tr>
        <?php
        
        //if the id of invoice already exists, go fetch lines
        if (isset($_POST['idInvoice'])){
            
            $stmt1 = $conn->prepare("SELECT tp.name AS nameP, tp.price AS price, til.quatity AS quantity FROM t_invoice_lines til INNER JOIN t_product tp ON til.idProduct = tp.id WHERE til.idInvoice = ?;");
            $stmt1->bind_param('i', $_POST['idInvoice']);
            $stmt1->execute();
            $result1 = $stmt1->get_result();
            if($result1->num_rows > 0){
                while($row1 = $result1->fetch_assoc()){
                    echo "<tr><td>".$row1['nameP']."</td><td>".$row1['price']."</td><td>".$row1['quantity']."</td><td>";
                    echo $row1['quantity'] * $row1['price']. "</td></tr>";
                }        
            }
            
            //calculate total and points acumulated
            $idInvoice = $_POST['idInvoice'];
            $total = $_POST['total'];
            $points =  floor($total / 50) * 3;
            $stmt1->close(); 
        }
        else
        {
            //if invoice still not exists, define total and point for the invoice as 0
            $idInvoice=NULL;
            $total = 0;
            $points = 0;
        }
        ?>
    <!--- form for finalization of the shopping --->
    </table><hr>
        <form action="Shop2.php" method="post">
            <input type="hidden" name="idInvoice" value="<?php echo $idInvoice;?>">
            <input type="hidden" name="idClient" value="<?php echo $idClient;?>">
            <input type="hidden" size = "10" name="date" value="<?php echo date("Y-m-d"); ?>">
            <label for="ftotal"><b>Total: </b></label><br>
            <input class="inputNum" type="number" size="10" name="value" id="ftotal" readonly value="<?php echo $total?>"€>
            <br><br>
            <label for="fpoints"><b>Points: </b></label><br>
            <input class="inputNum" type="number" size="10" name="points" id="fpoints" readonly value="<?php echo $points?>"><br><br>
            <input class="butEdit" type="submit" value="Check out">
        </form>
    
        <form action="Shop3.php" method="post">
            <input type="hidden" name="idInvoice" value="<?php echo $idInvoice;?>"><br>
            <input class="butStatus" type="submit" value="Cancel">
        </form><br><hr><br>
        
<?php
        include 'includes/functionProductsShop.php';

            //Checks if its receiveing a post category that changes the order that it shows the products
            if(!isset($_POST['category'])){
                $category = 0;
            }else{
                $category = $_POST['category'];
            }

            ?>
            <!-- Form that filters what category of items is being listed on the page -->
            
            <div class="DivFlex inputCat">
                <form action="Shop1.php" id="form1" method="POST">
                    <label for="fcat"><b>Category: </b></label>
                    <select class="inputCat" name="category" id="cat" onchange="this.form.submit();">
                        <?php
                            //Calls and execute the procedure that lists all categories
                            $sql = "CALL GetCategory()";

                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            echo "<option value='0'>All products</option>";

                            //Here it allows the user to decide which category of items is going to be show
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    if($category == $row['id'])
                                        echo "<option value='".$row['id']."' selected>".$row['category']."</option>";
                                    else
                                        echo "<option value='".$row['id']."'>".$row['category']."</option>";
                                }
                            }
                            $stmt->close();
                        ?>
                    </select>
                </form>&nbsp;&nbsp;

                <!-- Form that reads the user input to search for a specific item -->
                <form action="Shop1.php" id="form1" method="POST">
                    <input class="inputS" type="text" name="search" placeholder="Search..." size="50" maxlength="50">
                    <input type="submit" hidden />
                </form>
            </div>
            
            <?php

            //If the user put something on the search, it will take priority and search items with that name
            //then load the table with the results that have similar names with the one the user input

            if(isset($_POST['search'])){
                $search = $_POST['search'];

                $stmt = $conn->prepare("CALL GetProductsByName(?)");
                $stmt->bind_param("s", $search);
                $stmt->execute();
                
                echo "<table class='paddingBetweenCols'>";

                //After getting the result it calls the function that will create the table based on the data received

                $result = $stmt->get_result();
                listProducts($result, $idClient, $idInvoice, $total, $points);
                $stmt->close();

                echo "</table>";
            }else{

                //Else, if the user selected a category instead, it will list the products based on the category decided
                //Or list all of the products if no category was decided nor was a search input found

                if($category == 0){
                    $stmt = $conn->prepare("CALL GetProducts");
                    $stmt->execute();
                }else{
                    $stmt = $conn->prepare("CALL GetProductsCat(?)");
                    $stmt->bind_param("i", $category);
                    $stmt->execute();
                }
                echo "<table class='paddingBetweenCols'>";

                $result = $stmt->get_result();
                listProducts($result, $idClient, $idInvoice, $total, $points);
                $stmt->close();

                echo "</table>";
            }
            ?>
        </div>
        <?php include 'includes/footer.php' ?>
    </div>
    </body>
</html>