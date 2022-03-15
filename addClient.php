<?php include 'includes/head.php';?>
<body>
    <?php
    include 'includes/db_conn.php';
    ?>
    <form action="addClient2.php" method="post" enctype="multipart/form-data">
        Name:<input type="text" size="50" name="name" required>
        <br><br>
        NIF:<input type="text" size="9" name="nif" required onkeypress="return allowNumbers(event)">
        <br><br>
        E-mail:<input type="text" size="50" name="email" required>
        <br><br>
        Address: <input type="text" size="50" name="adress" required>
        <br><br>
        Contact: <input type="text" size="15" name="contact" required onkeypress="return allowNumbers(event)">
        <br><br>
        <input type="submit" value="Insert"> 
        <input type="reset" value="Clear fields">
    </form>
    <input type="button" value="Back" onclick="window.open('index.html','_self')">
    <br><br>
</body>
<?php include "includes/footer.php"; ?>