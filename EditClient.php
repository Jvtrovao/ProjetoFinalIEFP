<?php include 'includes/head.php' ?>
</head>
<body>
<?php include 'includes/header.php' ?>
    <div id="page-container">
        <div id="content-wrap">
            <div class="center">
                <h2 class="title">Update Client Information</h2>
                <?php
                
                //establish connection to database;
                include 'includes/db_conn.php';

                //$id_client = $_POST['id_cliente'];
                $id_client=$_POST['id_cliente'];

                //get data of client and fill the form to be changed
                $stmt = $conn->prepare("SELECT * FROM t_client WHERE id= 1");
                $stmt->execute();
                $result = $stmt->get_result();
                
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        ?>
                        <form action="EditClient2.php" method="post" enctype="multipart/form-data">
                            <!--
                            <label for="fname"><b>Name: </b></label><br>
                            <input class="inputC" type="text" id="fname" placeholder="Client name..." size="50" name="name" required>
                            <br><br> -->
                            <label for="fid"><b>ID: </b></label><br>
                            <input class="inputRead" type="text" name="id" id="fid" size="10" value="<?php echo $row['id']?>" readonly>
                            <br><br>

                            <label for="fname"><b>Name: </b></label><br>
                            <input class="inputC" type="text" name="name" id="fname" size="50" maxlength="50" value="<?php echo $row['name']?>">
                            <br><br>

                            <label for="fnif"><b>NIF: </b></label><br>
                            <input class="inputC" type="text" name="NIF" id="fnif" size="20" maxlength="9" value="<?php echo $row['NIF']?>" readonly>
                            <br><br>

                            <label for="femail"><b>E-mail: </b></label><br>
                            <input class="inputC" type="text" name="email" id="femail" size="50" maxlength="50" value="<?php echo $row['email']?>">
                            <br><br>

                            <label for="faddress"><b>Address: </b></label><br>
                            <input class="inputC" type="text" name="address" id="faddress" size="50" maxlength="50" value="<?php echo $row['adress']?>">
                            <br><br>

                            <label for="fcontac"><b>Contact: </b></label><br>
                            <input class="inputC" type="text" name="contact" id="fcontac" size="20" maxlength="10" value="<?php echo $row['contact']?>" onkeypress="return allowNumbers(event)">
                            <br><br>

                            <label for="fbalan"><b>Balance: </b></label><br>
                            <input class="inputC" type="number" name="balance" id="fbalan" size="20" min="0"  step="0.01" value="<?php echo $row['balance']?>€">
                            <br><br>

                            <label for="fpoints"><b>Points: </b></label><br>
                            <input class="inputC" type="number" name="points" id="fpoints" size="20" min="0" step="1" value="<?php echo $row['points']?>">
                            <br><br>

                            <?php
                    }
                }
                $stmt->close();
                ?>
                    <input class="butEdit" type="submit" value="Edit">
                    <input class="butClear" type="reset" value="Clear"><br><br>
                    <input class="butStatus" type="button" value="Cancel" onclick="window.open('Index.php', '_self')"></p><br>
                </form>
            </div>
        </div>
        <?php include 'includes/footer.php' ?>
    </div>
</body>
</html>