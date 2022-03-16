<?php
// include header file
include 'includes/head.php';
?>
<body>
    <h2>Insert Client NIF</h2>
    <form action="SelectClient.php" method="post">
            <input type="text" size="9" name="nif" required onkeypress="return allowNumbers(event)">
   
            <br><br>
            <input type="submit" value="Select">
            <br><br>
            <input type="reset" value="Clear">
            <br><br>
            <input type="button" value="Go back" onclick="window.history.go(-1);"></p><br>
    </form>

    <?php
    //establish connection to database;
    include 'includes/db_conn.php';

    $sql = "SELECT id, name, NIF FROM t_client";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $existNIF = 0;

    if(isset($_POST['nif']))
    {
        $nif = $_POST['nif'];

        //if result have more than 1 line
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                if($row['NIF'] == $nif)
                {
                    $existNIF = 1;
                    $clientName = $row['name'];
                    $clientId = $row['id'];
                } 
            }
        }
        $stmt->close();

        if($existNIF)
        {
            echo "<h2>NIF registered with client name - ".$clientName."</h2>";
            ?>
            <form action="EditClient.php" method="post">
                <input type="hidden" name="id_cliente" value="<?php echo $clientId;?>">
                
                <input type="submit" value="Edit Client Profile">
            </form>

        <?php
        } else
            echo "<h2>NIF not registered in database</h2>";
    }
        ?>
</body>
<?php include "includes/footer.php"; ?>