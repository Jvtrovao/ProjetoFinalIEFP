
<body>
        <h2>Update Product Information</h2>
        <?php
        
        //estabelecer a conexão á base e dados;
        include 'include/liga_bd.php';
        //valida o acesso atraves das variaveis de sessão
        //include 'include/validar.php';

        //include 'include/validate_photo.php';

        //recieve id of the produc to update fro Consult.php
        //$id_prod=$_POST['id_prod'];

        $id_prod=1;

        //mysql operation to get information of product by id from t-product, with procedure registared in DB 
        mysqli_query($conn, "SET @1=".$id_prod);
        mysqli_multi_query($conn, "CALL GetProductById(@1)") OR DIE (mysqli_error($conn));

        while(mysqli_more_results($conn)){
            if($result = mysqli_store_result($conn)){
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['id'];
                    $name = $row['name'];
                    $category= $row['idCategory'];
                    $price = $row['price'];
                    $stock = $row['stock'];
                    $photo = $row['photo'];
                }
                mysqli_free_result($result);
            } 
            mysqli_next_result($conn);
        }
        ?>

        <!--form to modify information of product and send it tto EditProd2.php when submitted  -->
        <form action="EditProd2.php" method="post" enctype="multipart/form-data">
            ID:<br><input type="text" name="id" size="10" value="<?php echo $id?>" readonly><br><br>
            Name:<br><input type="text" name="name" size="50" maxlength="50" value="<?php echo $name?>"><br><br>

            Category: <select name="category" id="category">
            <?php

            //mysql operation to get all the product categories from t-category, with procedure registared in DB
            mysqli_multi_query($conn, "CALL GetCategory()") OR DIE (mysqli_error($conn));

            while(mysqli_more_results($conn)){
                if($result2 = mysqli_store_result($conn)){
                    while($row2 = mysqli_fetch_assoc($result2)){
                        if ($category == $row2['id'])
                            echo "<option value='".$row2['id']."' selected>" .$row2['category']. "</option>";
                        else
                            echo "<option value='".$row2['id']."'>".$row2['category']."</option>"; 
                    }
                mysqli_free_result($result2);
                }
            mysqli_next_result($conn);
            }
            ?>

            </select><br><br>
            Price:<br><input type="number" name="price" size="20" min="0"  step="0.01" value="<?php echo $price?>"><br><br>
            Stock:<br><input type="number" name="stock" size="20" min="0" step="1" value="<?php echo $stock?>"><br><br>
            Image:<br><img src="pics/<?php echo $photo;?>" width="150"><input type="hidden" name="existing_image" value="<?php echo $photo?>"><br>
            <br>New Image:<br><input type="file" name="image"></p><br>
            
            <?php
            mysqli_close($conn) 
            ?>

            <input type="submit" value="Edit"><br><br>
            <input type="reset" value="Clear"><br><br>
            <input type="button" value="Cancel" onclick="window.history.go(-1);"></p><br>
        </form>
        
        
        <a href="index.html" target="_self">Back to Menu</a>
    </body>
</html>