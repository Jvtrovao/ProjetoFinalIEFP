<?php
include 'includes/head.php'; 
include 'includes/db_conn.php';
?>
<body>
    <!--form to input product information-->
    <form action="addProd2.php" method="post" enctype="multipart/form-data">
        Name:<input type="text" size="50" name="name" required>
        <br><br>
        Price:<input type="number" min="0" step="0.01" name="price" required>
        <br><br>
        Stock:<input type="number" min="0" step="1" name="stock" required>
        <br><br>
        Image: <input type="file" name="upFile" required>
        <br><br>
        Category: <select name="idCategory">
        <?php
            $sql = "CALL GetCategory()";

            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            echo "<option value='0'>All products</option>";

            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    if($_POST['category'] == $row['id'])
                        echo "<option value='".$row['id']."' selected>".$row['category']."</option>";
                    else
                        echo "<option value='".$row['id']."'>".$row['category']."</option>";
                }
            }
        ?>
        </select>
        <br><br>
        <input type="submit" value="Insert"> 
        <input type="reset" value="Clear fields">
        <br>
    </form>

    <!--button to go back to the menu-->
    <input type="button" value="Back" onclick="window.open('index.html','_self')">
</body>

<?php include "includes/footer.php"; ?>