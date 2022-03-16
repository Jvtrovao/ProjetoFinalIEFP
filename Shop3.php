<?php
// import header file
include 'includes/head.php';
?>
    <body> 
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
        <br><br><a href="index.php">Voltar ao menu</a>
    </body>
        <?php
//incleds footer file
include 'includes/footer.php';
?>