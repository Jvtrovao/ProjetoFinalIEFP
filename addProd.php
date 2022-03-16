<?php include 'includes/head.php' ?>
</head>
    <body>
    <?php include 'includes/header.php' ?>
    <div id="page-container">
        <div id="content-wrap">
            <div class="center">
                <?php include 'includes/db_conn.php' ?>
                    <!--form to input product information-->
                    <form action="addProd2.php" method="post" enctype="multipart/form-data">
                        <label for="fname"><b>Name: </b></label><br>
                        <input class="inputC" type="text" size="50" id="fname" name="name" placeholder="Product name..." required>
                        <br><br>

                        <label for="fprice"><b>Price: </b></label><br>
                        <input class="inputC" type="number" min="0" step="0.01" name="price" id="fprice" placeholder="xx.xx" required>
                        <br><br>

                        <label for="fstock"><b>Stock: </b></label><br>
                        <input class="inputC" type="number" min="0" step="1" name="stock" id="fstock" placeholder="Stock number..." required>
                        <br><br>

                        <label for="fimage"><b>Image: </b></label><br>
                        <input class="butFile" type="file" name="upFile" id="fimage" required>
                        <br><br>

                        <label for="fcat"><b>Category: </b></label><br>
                        <select class="inputCat" name="idCategory" id="fcat">
                        <?php
                            $sql = "CALL GetCategory()";

                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            echo "<option value='0'>All products</option>";

                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    if($_POST['category'] == $row['id'])
                                        echo "<option value='".$row['id']."' selected>".$row['category']."</option>";
                                    else
                                        echo "<option value='".$row['id']."'>".$row['category']."</option>";
                                }
                            }
                        ?>
                        </select>
                        <br><br>


                        <input class="butEdit" type="submit" value="Insert"> 
                        <input class="butClear" type="reset" value="Clear fields">
                        <input class="butStatus" type="button" value="Cancel" onclick="window.open('Index.php', '_self')"></p><br>
                        <br>
                    </form>
            </div>
        </div>
    <?php include 'includes/footer.php' ?>
    </div>
    </body>
</html>