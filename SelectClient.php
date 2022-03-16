<?php include 'includes/head.php' ?>
</head>
<body>
    <?php include 'includes/header.php' ?>
    <div id="page-container">
        <div id="content-wrap">
            <div class="center">
            <h2>Insert Client NIF</h2>
                <form action="SelectClient.php" method="post">
                    <label for="fnif"><b>NIF: </b></label><br>
                    <input class="inputC" type="text" size="9" name="nif" id="fnif" required onkeypress="return allowNumbers(event)">
                    <br><br>

                    <input class="butEdit" type="submit" value="Confirm">
                    <input class="butClear" type="reset" value="Clear"><br><br>
                    <input class="butStatus" type="button" value="Cancel" onclick="window.open('Index.php', '_self')"></p><br>
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
                        echo "<h2>NIF registered with client name: </h2>";
                        echo "<h3>".$clientName."</h3>";
                        ?>
                        <form action="EditClient.php" method="post">
                            <input type="hidden" name="id_cliente" value="<?php echo $clientId;?>">
                            <input class="butEdit" type="submit" value="Edit Client Profile">
                        </form>

                    <?php
                    } else
                        echo "<h2>NIF not registered in database</h2>";
                }
            ?>
            </div>
        </div>
    <?php include 'includes/footer.php' ?>
    </div>
</body>
</html>