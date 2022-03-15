<?php include 'includes/head.php';?>
<body>
    <?php
    include 'includes/db_conn.php';

    $nif = $_POST['nif'];

    //using preperad statment to get list of existent NIF in DB
    //$sql = "CALL GetNIF()";
    $sql = "SELECT NIF FROM t_client";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    //boolean variable to verify if NIF is already registered in DB
    $existNIF = 0;
    //if result have more than 1 line

    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            if($row['NIF'] == $nif)
            {
                $existNIF = 1;
            }  
        }
    }
    $stmt->close();


    //if NIF is not yet registered, form data is inserted into DB
    if(!$existNIF)
    {
        try{
            //$sql = "CALL InsertClient(?,?,?,?,?)";
            $sql2 = "INSERT INTO `t_client`(`name`, `NIF`, `email`, `adress`, `contact`) VALUES (?,?,?,?,?)";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param("sssss", $_POST['name'], $nif, $_POST['email'], $_POST['adress'], $_POST['contact']);
            $stmt2->execute();
            $stmt2->close();
            $conn->close();

            echo "<h1>Client registered</h1>";
        } catch(Exception $ex){
            echo $ex;
            $conn->close();
        }
    } else
        echo "<h1>NIF already registered in database</h1>";  
    ?>
    <input type="button" value="Back" onclick="window.open('index.html','_self')">
</body>
<?php include "includes/footer.php"; ?>