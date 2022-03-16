<?php include 'includes/head.php' ?>
</head>
    <body>
    <?php
        include 'includes/header.php';
        ?>
    <h1 class="title">Market</h1>

    <div id="page-container">
        <div id="content-wrap">
            <div class="MainDiv">
                <div class="DivBox">
                    <h2>Products</h2><br>
                    <!-- <a href="addProd.php">Add Product</a>
                    <a href="addProd.php">List Products</a> -->
                    <input class="butMenu" type="button" value="Add Product" onclick="window.open('addProd.php', '_self')"><br><br>
                    <input class="butMenu" type="button" value="List Products" onclick="window.open('ConsultProd.php', '_self')">
                </div>
                <div class="DivBox">
                    <h2>Clients</h2><br>
                    <input class="butMenu" type="button" value="Add Client" onclick="window.open('addClient.php', '_self')"><br><br>
                    <input class="butMenu" type="button" value="Update Client" onclick="window.open('SelectClient.php', '_self')"><br><br>
                    <input class="butMenu" type="button" value="Shop" onclick="window.open('SelectClientShop.php', '_self')"><br><br>
                    <input class="butMenu" type="button" value="Client History" onclick="window.open('SelectClientHistory.php', '_self')">
                </div>
            </div>
        </div>
        <?php include 'includes/footer.php' ?>
    </div>
    </body>
</html>
