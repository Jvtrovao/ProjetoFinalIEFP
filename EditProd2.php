
    <body> 
        <?php

        //estabelecer a conexão á base e dados;
        include 'include/liga_bd.php';
        //valida o acesso atraves das variaveis de sessão
        //include 'include/validar.php';

       

        if(empty($_FILES['image']['name'][0])){
            
            //in case there is no update of foto
            //mysql operation to update the information of the product at t-category, with procedure registared on the DB
            mysqli_query($conn, "SET @1='".$_POST['name']."'");
            mysqli_query($conn, "SET @2=".$_POST['price']);
            mysqli_query($conn, "SET @3=".$_POST['stock']);
            mysqli_query($conn, "SET @5=".$_POST['category']);
            mysqli_query($conn, "SET @6=".$_POST['id']);
            if (mysqli_multi_query($conn, "CALL UpdateProductNP(@1, @2, @3, @4, @5)")){ 

                echo "<h3>The product updated</h3>";
            }
            else{
                DIE (mysqli_error($conn));
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
                    mysqli_query($conn, "SET @1='".$_POST['name']."'");
                    mysqli_query($conn, "SET @2=".$_POST['price']);
                    mysqli_query($conn, "SET @3=".$_POST['stock']);
                    mysqli_query($conn, "SET @4='".$_POST['image']."'");
                    mysqli_query($conn, "SET @5=".$_POST['category']);
                    mysqli_query($conn, "SET @6=".$_POST['id']);
                    if (mysqli_multi_query($conn, "CALL UpdateProduct(@1, @2, @3, @4, @5, @6)")){ 

            
                        echo "<h3>The product updated</h3>";
                        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                    }
                    else{
                        DIE (mysqli_error($conn));
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