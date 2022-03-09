<?php
include 'includes/head.php';
?>
    <body>
<?php
    include 'includes/db_conn.php';

?>
    <form action="addClient.php" method="post" enctype="multipart/form-data">
        Name:<input type="text" size="50" name="name" required>
        <br><br>
        NIF:<input type="text" size="9" name="nif" required>
        <br><br>
        E-mail:<input type="text" size="50" name="email" required>
        <br><br>
        Adress: <input type="text" size="50" name="adress" required>
        <br><br>
        Contact: <input type="text" size="15" name="contact" required>
        <br><br>
        <input type="submit" value="Insert"> 
        <input type="reset" value="Clear fields">
        <input type="button" value="Back" onclick="window.open('index.html','_self')">
    </form>
<?php
    
        //$sql = "CALL GetNIF()";
        if(!isset($_POST['nif'])){
            $nif = 0;
        } else{
            $nif = $_POST['nif'];
        }
        
        $sql = "SELECT NIF FROM t_client";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $existsNIF = false;

        if($result->num_rows > 0){
            $exisNIF = true;
        }
        $stmt->close();
        
        if(!$existsNIF){
            try{
                //$sql = "CALL InsertClient(?,?,?,?,?)";
                $sql2 = "INSERT INTO `t_client`(`name`, `NIF`, `email`, `adress`, `contact`) VALUES (?,?,?,?,?)";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bind_param("sssss", $_POST['name'], $nif, $_POST['email'], $_POST['adress'], $_POST['contact']);
                $stmt2->execute();
                $stmt2->close();
                $conn->close();
                echo "<h1>user registado com sucesso</h1>";
            } catch(Exception $ex){
                echo $ex;
                $conn->close();
            }
        } else
            echo "<h1>NIF ja registado</h1>";  
    
?>
    </body>
</html>