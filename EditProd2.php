
    <body> 
        <?php

        //estabelecer a conexão á base e dados;
        include 'include/liga_bd.php';
        //valida o acesso atraves das variaveis de sessão
        include 'include/validar.php';

        //validate image and upload
        include 'include/valida_foto.php';

        if($uploadOk == 0){
                echo "image failed to upload";
        }
        else{
            if($uploadOk == 1){

                //mysql operation to update the information of the product at t-category, with procedure registared on the DB
                $sql ="Procedure3";  

                if(mysqli_query($ligacao, $sql)){
                    echo "<h3>The product updated</h3>";
                    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                }
                else
                    echo "<h3>Error<h3>";
            }
        }
        mysqli_close($ligacao);  
        ?>
        
        <p>Will be redirected to Menu</p>
    </body>
</html>