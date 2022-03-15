<?php
include 'includes/head.php';
?>
<body>
        <h2>Update Product Information</h2>
        <?php
        
        //estabelecer a conexão á base e dados;
        include 'includes/db_conn.php';
        
        //recieve id_prod
        $id_prod=$_POST['id_prod'];

        //mysql operation to get information of product by id from t-product, with procedure registared in DB 
        $sql = "CALL GetProductById(?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_prod);
        $stmt->execute();

        $result = $stmt->get_result();
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){

                $id = $row['id'];
                $name = $row['name'];
                $category = $row['idCategory'];
                $price = $row['price'];
                $stock = $row['stock'];
                $photo = $row['photo'];
            }
        }
        $stmt->close();
        ?>

        <!--form to modify information of product and send it tto EditProd2.php when submitted  -->
        <form action="EditProd2.php" method="post" enctype="multipart/form-data">
            ID:<br><input type="text" name="id" size="10" value="<?php echo $id?>" readonly><br><br>
            Name:<br><input type="text" name="name" size="50" maxlength="50" value="<?php echo $name?>"><br><br>

            Category: <select name="idCategory">
            <?php
                // Obtain list of category to create selectbox
                $sql2 = "CALL GetCategory()";

                $stmt2 = $conn->prepare($sql2);
                $stmt2->execute();
                $result2 = $stmt2->get_result();

                if($result2->num_rows > 0){
                    while($row2 = $result2->fetch_assoc()){
                        if($category == $row2['id'])
                            echo "<option value='".$row2['id']."' selected>".$row2['category']."</option>";
                        else
                            echo "<option value='".$row2['id']."'>".$row2['category']."</option>";
                    }
                }
            ?>

            </select><br><br>
            Price:<br><input type="number" name="price" size="20" min="0"  step="0.01" value="<?php echo $price?>"><br><br>
            Stock:<br><input type="number" name="stock" size="20" min="0" step="1" value="<?php echo $stock?>"><br><br>
            Image:<br><img src="pics/<?php echo $photo;?>" width="150"><input type="hidden" name="existing_image" value="<?php echo $photo?>"><br>
            <br>New Image:<br><input type="file" name="upFile"></p><br>
            
            <?php
            //mysqli_close($conn) 
            ?>

            <input type="submit" value="Edit"><br><br>
            <input type="reset" value="Clear"><br><br>
            <input type="button" value="Cancel" onclick="window.history.go(-1);"></p><br>
        </form>
        
        
        <a href="index.html" target="_self">Back to Menu</a>
            </body>
        <?php
//incleds footer file
include 'includes/footer.php';
?>