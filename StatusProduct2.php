<?php include 'includes/head.php' ?>
        <meta http-equiv="refresh" content="3;url=ConsultProd.php"/>
</head>
    <body>
    <div id="page-container">
        <div id="content-wrap">
            <?php include 'includes/header.php' ?>
                <h1>Alter Product Status</h1>
                <?php
                include 'includes/db_conn.php';

                $stmt = $conn->prepare("CALL UpdateProductInativeStatus(?,?)");
                $stmt->bind_param("ii", $_POST['status'], $_POST['id_prod']);
                $stmt->execute();
                $stmt->close();

                ?>
                <br/>
                <h4>You will be redirected shortly...</h4>
                <input type="button" value="Return to the list" onclick="window.open('ConsultProd.php', '_self')"><br><br>
        </div>
        <?php include 'includes/footer.php' ?>
    </div>
</body>
</html>