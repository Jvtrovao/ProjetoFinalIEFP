<?php
// include header file
include 'includes/head.php';
?>
<body>
        <h2>Update Client Information</h2>
        <?php
        
        //establish connection to database;
        include 'includes/db_conn.php';

        //$id_client = $_POST['id_cliente'];
        $id_client=1;

    
        //get data of client and fill the form to be changed
        $stmt = $conn->prepare("SELECT * FROM t_client WHERE id= 1");
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                ?>
                <form action="EditClient2.php" method="post" enctype="multipart/form-data">
                    ID:<br><input type="text" name="id" size="10" value="<?php echo $row['id']?>" readonly><br><br>
                    Name:<br><input type="text" name="name" size="50" maxlength="50" value="<?php echo $row['name']?>"><br><br>
                    NIF:<br><input type="text" name="NIF" size="20" maxlength="9" value="<?php echo $row['NIF']?>" readonly><br><br>
                    Email:<br><input type="text" name="email" size="50" maxlength="50" value="<?php echo $row['email']?>"><br><br>
                    Address:<br><input type="text" name="address" size="50" maxlength="50" value="<?php echo $row['adress']?>"><br><br>
                    Contact:<br><input type="text" name="contact" size="20" maxlength="10" value="<?php echo $row['contact']?>" onkeypress="return allowNumbers(event)"><br><br>
                    Balance:<br><input type="number" name="balance" size="20" min="0"  step="0.01" value="<?php echo $row['balance']?>">€<br><br>
                    Point:<br><input type="number" name="points" size="20" min="0" step="1" value="<?php echo $row['points']?>"><br><br>
                    <?php
            }
        }
        $stmt->close();
        ?>
            <input type="submit" value="Edit"><br><br>
            <input type="reset" value="Clear"><br><br>
            <input type="button" value="Cancel" onclick="window.history.go(-1);"></p><br>
        </form>   
        <a href="index.html" target="_self">Back to Menu</a>
    </body>
</html>