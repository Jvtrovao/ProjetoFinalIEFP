<?php
    include 'includes/head.php';
?>
    </head>
    <body>
        <h1>Alter Product Status</h1>
        <?php 
        include 'includes/db_conn.php';

        $id_prod = $_POST['id_prod'];

        $sql = "SELECT prod.*, cat.category FROM t_product prod
        INNER JOIN t_category cat on cat.id = prod.idCategory WHERE prod.id=".$id_prod;

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        ?>


        Name: <?php echo $row['name'] ?><br><br>
        Price: <?php echo $row['price'] ?>€<br><br>
        Stock: <?php echo $row['stock'] ?><br><br>
        Category: <?php echo $row['category'] ?><br><br>
        Photo:
        <?php
        if($row['photo'] == ''){
            echo "<td></td>";
        }else{
            echo "<td><img src='resources/".$row['photo']."' width='100'></td>";
        }
        ?><br><br>
        Status: 
        <?php
        if($row['Inative'] == 0){
            echo "Ative";
        }else{
            echo "Inative";
        }
        $stmt->close();
        ?><br><br>
        <form action="StatusProduct2.php" method="POST">
            <?php
                if($row['Inative'] == 0){
                    echo "<input type='hidden' name='id_prod' value='".$id_prod."'>";
                    echo "<input type='hidden' name='status' value='1'>";
                    echo "<input type='submit' value='Inativate'><br><br>";
                }else{
                    echo "<input type='hidden' name='id_prod' value='".$id_prod."'>";
                    echo "<input type='hidden' name='status' value='0'>";
                    echo "<input type='submit' value='Ativate'><br><br>";
                }
            ?>
        </form>
        <input type="button" value="Return to the list" onclick="window.open('ConsultProd.php', '_self')"><br><br>
    </body>
<?php
include 'includes/footer.php';
?>