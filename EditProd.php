    <body>
        <h2>Update Product Information</h2>
        <?php
        
        //estabelecer a conexão á base e dados;
        include 'include/liga_bd.php';
        //valida o acesso atraves das variaveis de sessão
        include 'include/validar.php';

        //recieve id of the produc to update fro Consult.php
        $id_prod=$_POST['id_prod'];

        //mysql operation to get information of product by id from t-product, with procedure registared in DB 
        $sql ="Procedure1".$id_prod;
        $resultado = mysqli_query($ligacao, $sql) or die (mysqli_error($ligacao));
        $linha = mysqli_fetch_assoc($resultado);
        ?>
        

            <!--form to modify information of product and send it tto EditProd2.php when submitted  -->
        <form action="EditProd2.php" method="post" enctype="multipart/form-data">
            ID:<br><input type="text" name="id" size="100%" value="<?php echo $linha['id']?>" readonly>
            Name:<br><input type="text" name="nick" size="50" value="<?php echo $linha['name']?>">

            Category: <select name="categoria" id="categoria">
            <?php

            //mysql operation to get all the product categories from t-category, with procedure registared in DB
            $sql ="Procedure2";
            $resultado = mysqli_query($ligacao, $sql) or die (mysqli_error($ligacao));
            $linha = mysqli_fetch_assoc($resultado);
        
            //fill select box options with categories
            while($linha = mysqli_fetch_assoc($resultado)){
                if ($_POST['categoria']==$linha['id'])
                    echo "<option value='".$linha['id']."' selected>" .$linha['category']. "</option>";
                else
                    echo "<option value='".$linha['id']."'>".$linha['category']."</option>"; 
            }
            mysqli_close($ligacao)  
            ?>

            Price:<br><input type="number" name="nome" size="100" value="<?php echo $linha['nome']?>">
            Stock:<br><input type="number" name="email" size="50" value="<?php echo $linha['stock']?>">
            Image:<input type="file" name="image"><br><br>
            
            </select>

            <input type="submit" value="Edit"><br><br>
            <input type="reset" value="Clear"><br><br>
            <input type="button" value="Cancel" onclick="window.history.go(-1);"></p><br>
        </form>

        <a href="index.html" target="_self">Back to Menu</a>
    </body>
</html>