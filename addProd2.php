<?php include 'includes/head.php'; ?>
<body>
    <?php 
    include 'includes/db_conn.php';
    include 'includes/photo_valid.php';
    
    //if file was included    
    if($uploadOk == 1)
    {
        //try to insert into database
        try{
            //prepared statment using a procedure
            $query = "CALL InsertProduct(?,?,?,?,?)";
            $stmt = $conn->prepare($query);
            //binding parameters
            $stmt->bind_param("sdisi", $_POST['name'],  $_POST['price'], $_POST['stock'], $photo, $_POST['idCategory']);
            //execution of prepared statent
            $stmt->execute();
            //closing use of prepared statment
            $stmt->close();
            //send the file(photo) to the asigned folder
            move_uploaded_file($_FILES["upFile"]["tmp_name"], $target_file);
            //closing connection to db
            $conn->close();
            //info for user
            echo "Product added to database";
        }
        catch(Exception)
        {
            echo "Fail to add product";
            $conn->close();
        }
    }
    //when occurs an error when uploading the file
    else
    {
        echo "File not sent";
    }
    ?>
    <!--button to go back to the menu-->
    <input type="button" value="Back" onclick="window.open('index.html','_self')">
</body>
<?php include "includes/footer.php"; ?>