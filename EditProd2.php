
    <body> 
        <?php

        //estabelecer a conexão á base e dados;
        include 'include/liga_bd.php';
        //valida o acesso atraves das variaveis de sessão
        //include 'include/validar.php';
      
       

        if(empty($_FILES['upFile']['name'][0])){
            
            //in case there is no update of foto
            //mysql operation to update the information of the product at t-category, with procedure registared on the DB
            $stmt = $conn->prepare("CALL UpdateProductNP(?, ?, ?, ?, ?)");
            $stmt->bind_param('sdiii', $_POST['name'], $_POST['price'], $_POST['stock'], $_POST['category'], $_POST['id']);
    
            if ($stmt->execute()){ 

                echo "<h3>The product updated</h3>";
            }
            else{
                echo "<h3>Error<h3>";
            }
        }
        else
        {       
             //validate image and upload
            include 'include/validate_photo.php';
            if($uploadOk == 0){
                echo "image failed to upload";
            }
            else{
                if($uploadOk == 1){

                    //mysql operation to update the information of the product at t-category, with procedure registared on the DB

                    $stmt = $conn->prepare("CALL UpdateProduct(?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param('sdisii', $_POST['name'], $_POST['price'], $_POST['stock'], $photo, $_POST['category'], $_POST['id']);
                    $stmt->execute();

                    if ($stmt->execute()){ 
            
                        echo "<h3>The product updated</h3>";
                        move_uploaded_file($_FILES["upFile"]["tmp_name"], $target_file);
                    }
                    else{
                        echo "<h3>Error<h3>";
                    }
                    
                }
            }
        }

        mysqli_close($conn);  
        ?>
        
        <p>Will be redirected to Menu</p>
    </body>
</html>