<?php include 'includes/head.php' ?>
</head>
    <body>
    <?php include 'includes/header.php' ?>
    <div id="page-container">
        <div id="content-wrap">
            <?php

            //connection to database
            include 'includes/db_conn.php';

            //delete cancelled invoice
            $sql = "DELETE FROM t_invoice WHERE id = ?;";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $_POST['idInvoice']);
            $stmt->execute();
    
            //delete invoce ines associated with canceled invoice
            $sql = "DELETE FROM t_invoice_lines WHERE idInvoice = ?;";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $_POST['idInvoice']);
            $stmt->execute();

            $stmt->close();
            echo "Visit us again!";
            ?>
            <input class="butStatus" type="button" value="Back" onclick="window.open('Index.php', '_self')"></p><br>
        </div>
    <?php include 'includes/footer.php' ?>
    </div>
    </body>
</html>