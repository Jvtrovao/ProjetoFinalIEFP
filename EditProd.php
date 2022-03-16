<?php include 'includes/head.php' ?>
</head>
<body>
<?php include 'includes/header.php' ?>
    <div id="page-container">
        <div id="content-wrap">
            <div class="center">
                <h2 class="title">Update Product Information</h2>
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

                        <!-- <label for="fname"><b>Name: </b></label><br>
                        <input class="inputC" type="text" id="fname" placeholder="Client name..." size="50" name="name" required>
                        <br><br> -->
                        <label for="fid"><b>ID:</b></label><br>
                        <input class="inputRead" type="text" name="id" id="fid" size="10" value="<?php echo $id?>" readonly>
                        <br><br>

                        <label for="fname"><b>Name:</b></label>
                        <br><input class="inputC" type="text" id="name" name="fname" size="50" maxlength="50" value="<?php echo $name?>">
                        <br><br>

                        <label for="fcat"><b>Category: </b></label><br>
                        <select class="inputCat" id="fcat" name="idCategory">
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

                        </select>
                        <br><br>

                        <label for="fprice"><b>Price:</b></label><br>
                        <input class="inputC" type="number" id="fprice" name="price" size="20" min="0"  step="0.01" value="<?php echo $price?>">
                        <br><br>

                        <label for="fstock"><b>Stock:</b><br></label>
                        <input class="inputC" type="number" id="fstock" name="stock" size="20" min="0" step="1" value="<?php echo $stock?>"><br><br>
                        <?php
                        if($photo == ''){
                            echo "<b>Image:</b><br><br><br><br><br><br><br><br><br>";
                        }else{
                            echo "<label for='fimage'><b>Image:</b></label><br>";
                            echo "<br><img src='pics/".$photo."' id='fimage' width='150'><input type='hidden' name='existing_image' value='".$photo."'><br>";
                        }
                        ?>
                        <br><b>New Image:</b><br><input class="butFile" type="file" name="upFile"></p><br>
                        
                        <?php
                        $stmt2->close(); 
                        ?>

                        <input class="butEdit" type="submit" value="Confirm">
                        <input class="butClear" type="reset" value="Clear"><br><br>
                        <input class="butStatus" type="button" value="Cancel" onclick="window.open('ConsultProd.php', '_self')"></p><br>
                    </form>
            </div>
        </div>
        <?php include 'includes/footer.php' ?>
    </div>
    </body>
</html>