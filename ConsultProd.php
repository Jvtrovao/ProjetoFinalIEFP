<?php
include 'includes/head.php';
?>
    <body>
        <div class="BodyFix">
            <h1>Consult Products</h1>
            <?php
            //Includes the connection to the data base and the function to list products
            include 'includes/db_conn.php';
            include 'includes/functionProducts.php';

            //Checks if its receiveing a post category that changes the order that it shows the products
            if(!isset($_POST['category'])){
                $category = 0;
            }else{
                $category = $_POST['category'];
            }

            ?>
            <!-- Form that filters what category of items is being listed on the page -->
            <div class="DivFlex">
                <form action="ConsultProd.php" id="form1" method="POST">
                    Category: <select name="category" id="cat" onchange="this.form.submit();">
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
                <form action="ConsultProd.php" id="form1" method="POST">
                    <input type="text" name="search" size="50" maxlength="50">
                    <input type="submit" value="Search">
                </form>
            </div>
            <h2>Products</h2>
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
                listProducts($result);
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
                listProducts($result);
                $stmt->close();

                echo "</table>";
            }
            ?>
        </div>
    </body>
<?php
include 'includes/footer.php';
?>