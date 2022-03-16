<?php include 'includes/head.php' ?>
</head>
    <body>
    <?php include 'includes/header.php' ?>
    <div id="page-container">
        <div id="content-wrap">
            <h1>Client History</h1>
            <?php
            //Includes the connection to the data base and the function to list products
            include 'includes/db_conn.php';

            //Checks if its receiveing a post category that changes the order that it shows the products
            $idClient = $_POST['id_cliente'];


            $stmt = $conn->prepare("SELECT invo.id idInvo, invo.date, prod.name product, prod.price, invol.quatity, cli.name FROM `t_invoice` invo 
            INNER JOIN t_invoice_lines invol ON invo.id = invol.idInvoice  
            INNER JOIN t_product prod ON prod.id = invol.idProduct 
            INNER JOIN t_client cli ON cli.id = invo.idClient 
            WHERE idCLient = ".$idClient);
            $stmt->execute();
            $result = $stmt->get_result();

            echo "<table class='paddingBetweenCols'>";
            
            if($result->num_rows > 0){
                ?>
                <thead>
                    <tr>
                        <th>Invoice ID</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <?php

                $total = 0.00;

                //While there is data
                while($row = $result->fetch_assoc()){
                    echo "<tbody><tr>";
                    echo "<td>".$row['idInvo']."</td>";
                    echo "<td>".$row['product']."</td>";
                    echo "<td>".$row['price']."€</td>";
                    echo "<td>".$row['quatity']."</td>";
                    echo "<td>".$total."€</td>";
                    echo "</tr></tbody>";
                }
            }else{
                ?>
                <h1>There are no products from this client</h1>
                <?php
            }
            echo "</table>";
            $stmt->close();
            ?>
        </div>
        <?php include 'includes/footer.php' ?>
    </div>
    </body>
</html>