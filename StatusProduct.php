<?php include 'includes/head.php' ?>
</head>
<body>
<?php include 'includes/header.php'; ?>
<div id="page-container">
    <div id="content-wrap">
        <h1 class="title">Alter Product Status</h1>
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

        <div class="center">
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
                        echo "<input class='butEdit' type='submit' value='Inativate'><br><br>";
                    }else{
                        echo "<input type='hidden' name='id_prod' value='".$id_prod."'>";
                        echo "<input type='hidden' name='status' value='0'>";
                        echo "<input class='butEdit' type='submit' value='Ativate'><br><br>";
                    }
                ?>
            </form>
            </div>
        <?php include 'includes/footer.php' ?>
    </div>
    </body>
</html>