<?php
include 'includes/head.php';
?>
    <body onload="atualiza();">
        <h1>Consult Products</h1>
        <?php 
        include 'includes/db_conn.php';
        include 'includes/listProducts.php';

        if(!isset($_POST['category'])){
            $category = 0;
        }else{
            $category = $_POST['category'];
        }

        ?>
        <div class="DivFlex">
            <form action="ConsultProd.php" id="form1" method="POST">
                Category: <select name="category" id="cat" onchange="this.form.submit();">
                    <?php 
                        $sql = "CALL GetCategory()";

                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        echo "<option value='0'>All products</option>";

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
            <form action="ConsultProd.php" id="form1" method="POST">
                <input type="text" name="search" size="50" maxlength="50">
                <input type="submit" value="Search">
            </form>
        </div>
        <h2>Products</h2>
        <?php
        if(isset($_POST['search'])){
            $search = $_POST['search'];

            $stmt = $conn->prepare("CALL GetProductsByName(?)");
            $stmt->bind_param("s", $search);
            $stmt->execute();

            echo "<table class='paddingBetweenCols'>";

            $result = $stmt->get_result();
            listProducts($result);
            $stmt->close();

            echo "</table>";
        }else{
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
    </body>
</html>