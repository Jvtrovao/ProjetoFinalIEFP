<?php
//Function that creates the inside of the table
function listProducts($result){

    //If there was any data received
    if($result->num_rows > 0){
        ?>
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Stock</th>
                <th scope="col">Photo</th>
                <th scope="col">Category</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <?php

        //While there is data
        while($row = $result->fetch_assoc()){
            echo "<tbody><tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['price']." €</td>";
            echo "<td>".$row['stock']."</td>";


            //If the product has a image on its 'photo' column it will show it, else it leaves a blank
            if($row['photo'] == ''){
                echo "<td></td>";
            }else{
                echo "<td><img src='resources/".$row['photo']."' width='30'></td>";
            }
            echo "<td>".$row['category']."</td>";
            echo "<td>";
            ?>
            <div class="DivFlex"">
                <form action="EditProd.php" id="form1" method="POST">
                <input type="hidden" size="20" name="id_prod" value="<?php echo $row['id'] ?>">
                <input class="butEdit" type="submit" value="Edit">
                </form>&nbsp;&nbsp;
                <form action="StatusProduct.php" id="form1" method="POST">
                <?php
                if($row['Inative'] == 0){
                    echo "<input type='hidden' name='id_prod' value='".$row['id']."'>";
                    echo "<input class='butStatus' type='submit' value='Inativate'><br><br>";
                }else{
                    echo "<input type='hidden' name='id_prod' value='".$row['id']."'>";
                    echo "<input class='butStatus' type='submit' value='Ativate'><br><br>";
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