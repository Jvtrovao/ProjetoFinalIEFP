<?php
//Function that creates the inside of the table
function listProducts($result){

    //If there was any data received
    if($result->num_rows > 0){
        ?>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Photo</th>
                <th>idCategory</th>
                <th>Category</th>
                <th></th>
            </tr>
        </thead>
        <?php

        //While there is data
        while($row = $result->fetch_assoc()){
            echo "<tbody><tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['price']."€</td>";
            echo "<td>".$row['stock']."</td>";


            //If the product has a image on its 'photo' column it will show it, else it leaves a blank
            if($row['photo'] == ''){
                echo "<td></td>";
            }else{
                echo "<td><img src='resources/".$row['photo']."' width='100'></td>";
            }
            echo "<td>".$row['idCategory']."</td>";
            echo "<td>".$row['category']."</td>";
            echo "<td>";
            ?>
            <div class="DivFlex"">
                <form action="EditProd.php" id="form1" method="POST">
                <input type="hidden" size="20" name="id_prod" value="<?php echo $row['id'] ?>">
                <input type="submit" value="Edit">
                </form>&nbsp;&nbsp;
                <form action="StatusProduct.php" id="form1" method="POST">
                <?php
                if($row['Inative'] == 0){
                    echo "<input type='hidden' name='id_prod' value='".$row['id']."'>";
                    echo "<input type='submit' value='Inativate'><br><br>";
                }else{
                    echo "<input type='hidden' name='id_prod' value='".$row['id']."'>";
                    echo "<input type='submit' value='Ativate'><br><br>";
                }
                ?>
                </form>
            </div>
            <?php
            echo "</td>";
            echo "</tr></tbody>";
        }

    //If no data was received, the table is not loaded and instead it will print the following
    }else{
        ?>
        <h1>There are no products of this type</h1>
        <?php
    }
}