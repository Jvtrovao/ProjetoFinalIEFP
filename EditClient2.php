
<?php
//incleds header file
include 'includes/head.php';
?>
    <body> 
        <?php

        //establish connection to database;
        include 'includes/db_conn.php';
        
      
        //mysql operation to update the information of the client at t_client, with procedure registared on the DB        
        $stmt = $conn->prepare("CALL UpdateClient(?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssdii', $_POST['name'], $_POST['email'], $_POST['address'], $_POST['contact'], $_POST['balance'], $_POST['points'], $_POST['id']);

        if ($stmt->execute()){ 
            echo "<h3>data of the client updated</h3>";
        }
        else{
            echo "<h3>Error<h3>";
        }
        $stmt->close();  
        ?>
        <p>Will be redirected to Menu</p>
    </body>
<?php
//incleds footer file
include 'includes/footer.php';
?>