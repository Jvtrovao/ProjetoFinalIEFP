<?php
function listProducts($result){
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
        while($row = $result->fetch_assoc()){
            echo "<tbody><tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['price']."€</td>";
            echo "<td>".$row['stock']."</td>";
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
                <input type="hidden" size="20" name="id_artigo" value="<?php echo $row['id'] ?>">
                <input type="submit" value="Edit">
                </form>&nbsp;&nbsp;
                <form action="Inative.php" id="form1" method="POST">
                <input type="hidden" size="20" name="id_artigo" value="<?php echo $row['id'] ?>">
                <input type="submit" value="Inative">
                </form>
            </div>
            <?php
            echo "</td>";
            echo "</tr></tbody>";
        }
    }else{
        ?>
        <h1>There are no products of this type</h1>
        <?php
    }
}