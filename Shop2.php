<?php
// import header file
include 'includes/head.php';
?>
    <body> 
        <?php

        //connection to database before shopping
        include 'includes/db_conn.php';

        //get balance and point of the client
        $stmt = $conn->prepare("SELECT balance, points FROM t_client WHERE id = ?;");
        $stmt->bind_param('i', $_POST['idClient']);
        $stmt->execute();
        $result = $stmt->get_result();    
        $row = $result->fetch_assoc();
        $balance = $row['balance'] + $_POST['value'];
        $points = $row['points'] + $_POST['points'];
        $stmt->close();
        
        //update points and balance of the client after shopping
        $sql1 = "UPDATE t_client SET balance = ?, points = ? WHERE id = ?;";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param('iii', $balance,  $points,  $_POST['idClient']);
        $stmt1->execute();
        $stmt1->close();

        //set the date of the invoice to finalize
        $sql2 = "UPDATE t_invoice SET date = ? WHERE id = ?;";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param('si', $_POST['date'], $_POST['idInvoice']);
        $stmt2->execute();
        $stmt2->close();

        //get the invoice line to obtain current quantity and id to manage stock
        $sql3 = "SELECT * FROM t_invoice_lines WHERE idInvoice = ?;";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->bind_param('i', $_POST['idInvoice']);
        if ($stmt3->execute()){      
            $result3 = $stmt3->get_result();    
            while($row3 = $result3->fetch_assoc()){
                
                $bought = $row3['quatity'];
                
                //identify product could have made join....
                $sql5 = "SELECT stock FROM t_product WHERE id = ?;";
                $stmt5 = $conn->prepare($sql5);
                $stmt5->bind_param('i', $row3['idProduct']);
                $stmt5->execute();      
                $result5 = $stmt5->get_result();    
                $row5 = $result5->fetch_assoc();
                $stock = $row5['stock'];        
                $stock = $stock - $bought;
                
                //update stock of the product purchased
                $sql4 = "UPDATE t_product SET stock = ? WHERE id = ?;";
                $stmt4 = $conn->prepare($sql4);
                $stmt4->bind_param('ii', $stock, $row3['idProduct']);
                $stmt4->execute();
                

            }
        }     
        $stmt3->close();
        $stmt4->close();
        $stmt5->close();

        echo "thank you for shopping with us";
        ?>
        <br><br><a href="index.php">Voltar ao menu</a>

    </body>
        <?php
//incleds footer file
include 'includes/footer.php';
?>