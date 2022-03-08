<?php
include 'includes/head.php';
?>
    <body>
    <?php
    include 'includes/db_conn.php';
    

        //$sql = 'CALL GetFunction()';
        //$var = $conn->query($sql);
    if(isset($_FILES["upFile"]["name"])){
        include 'includes/photo_valid.php';
        
        if($uploadOk == 0){
            echo "Ficheiro nao enviado";
        }
        else{
            if($uploadOk == 1){
                mysqli_query($conn ,"SET @p0='".$_POST['name']."'");
                mysqli_query($conn ,"SET @p1='".$_POST['price']."'");
                mysqli_query($conn ,"SET @p2='".$_POST['stock']."'");
                mysqli_query($conn ,"SET @p3='".$photo."'");
                mysqli_query($conn ,"SET @p4='".$_POST['idCategory']."'");

                mysqli_multi_query ($conn, "CALL InsertProduct(@p0,@p1,@p2,@p3,@p4)") OR DIE (mysqli_error($conn));
            }
        }
    }
    ?>    


    <form action="addProd.php" method="post" enctype="multipart/form-data">
        Name:<input type="text" size="50" name="name" required>
        <br><br>
        Price:<input type="number" min="0" step="0.01" name="price" required>
        <br><br>
        Stock:<input type="number" min="0" step="1" name="stock" required>
        <br><br>
        Image: <input type="file" name="upFile">
        <br><br>
        Category:<input type="text" size="10" name="idCategory" required>
        <br><br>
        <input type="submit" value="Insert"> 
        <input type="reset" value="Clear fields">
        <input type="button" value="Back" onclick="window.open('index.html','_self')">
    </form>
    </body>
</html>