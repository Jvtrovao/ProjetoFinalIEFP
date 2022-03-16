<?php
//Function that creates the inside of the table
function listProducts($result, $idClient, $idInvoice, $total, $points){

    //If there was any data received
    if($result->num_rows > 0){
        ?>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Photo</th>
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


            //If the product has a image on its 'photo' column it will show it, else it leaves a blank
            if($row['photo'] == ''){
                echo "<td></td>";
            }else{
                echo "<td><img src='resources/".$row['photo']."' width='100'></td>";
            }

            echo "<td>".$row['category']."</td>";
            echo "<td>";
            ?>

            <!-- form to add invoice lines -->
            <div class="DivFlex"">
                <form action="Shop1.5.php" id="form1" method="POST">
                <input type="hidden" size="20" name="idProduct" value="<?php echo $row['id'] ?>">
                <input type="hidden" name="idClient" value="<?php echo $idClient; ?>">
                <input type="hidden" name="points" value="<?php echo $points; ?>">
                <input type="hidden" name="total" value="<?php echo $total; ?>">
                <?php
                    if (isset($idInvoice))
                        echo "<input type='hidden' name='idInvoice' value=".$idInvoice.">";
                ?>
                Quantity <input type="number" min="0" required max=<?php echo $row['stock']; ?> name="quantity">
                <input type="submit" value="Add">
                </form>&nbsp;&nbsp;
                
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