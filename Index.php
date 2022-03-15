<?php
include 'includes/head.php';
?>
<body>
    <h1 id="title">Market</h1>
<div class="BodyFix">
    <div class="MainDiv">
        <div class="DivProducts">
            <h2>Products</h2><br>
            <input type="button" value="Add Product" onclick="window.open('addProd.php', '_self')"><br><br>
            <input type="button" value="List Products" onclick="window.open('ConsultProd.php', '_self')">
        </div>
        <div class="DivClients">
        <h2>Clients</h2><br>
        <input type="button" value="Add Client" onclick="window.open('addClient.php', '_self')"><br><br>
        <input type="button" value="Checkout" onclick="window.open('Checkout.php', '_self')"><br><br>
        <input type="button" value="Client History" onclick="window.open('History.php', '_self')">
        </div>
    </div>
</div>
</body>
<?php
include 'includes/footer.php';
?>