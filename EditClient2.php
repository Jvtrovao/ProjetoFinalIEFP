<?php include 'includes/head.php' ?>
    <meta http-equiv="refresh" content="3;url=Index.php"/>
</head>
<body>
<?php include 'includes/header.php' ?>
    <div id="page-container">
        <div id="content-wrap">
            <?php
                //establish connection to database;
                include 'includes/db_conn.php';

                //mysql operation to update the information of the client at t_client, with procedure registared on the DB        
                $stmt = $conn->prepare("UPDATE t_client SET name = ?, email = ?, adress = ?, contact = ?, balance = ?, points = ? WHERE id = ?");
                $stmt->bind_param('ssssdii', $_POST['name'], $_POST['email'], $_POST['address'], $_POST['contact'], $_POST['balance'], $_POST['points'], $_POST['id']);

                if ($stmt->execute()){ 
                    echo "<h3>data of the client updated</h3>";
                }
                else{
                    echo "<h3>Error<h3>";
                }
                $stmt->close();  
            ?>
            <p>Redirecting to Menu</p>
            <input class="butStatus" type="button" value="Back" onclick="window.open('Index.php', '_self')"></p><br>
        </div>
        <?php include 'includes/footer.php' ?>
    </div>
</body>
</html>