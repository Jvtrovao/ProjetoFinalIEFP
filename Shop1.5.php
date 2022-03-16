<?php
// import header file
include 'includes/head.php';
?>
    <body> 
        <?php

        //connection to database
        include 'includes/db_conn.php';

        

        if(!isset($_POST['idInvoice'])){


            //create regist of invoice - these 2 queries can be made in 1 procedure 
            $sql = "INSERT INTO t_invoice (idClient) VALUES (?);";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $_POST['idClient']);
            if ($stmt->execute()){ 
  
                
                $sql = "SELECT id FROM t_invoice ORDER BY id DESC LIMIT 1;";
                $stmt = $conn->prepare($sql);
                $stmt->execute();      
                $result = $stmt->get_result();    
                if($result->num_rows > 0){
                    $row = $result->fetch_assoc();
                    $idInvoice = $row['id'];
                }  
                
            } 
              
            $stmt->close();

        }
        else
        {
            $idInvoice = $_POST['idInvoice'];
   
           
            //insert invoice line      
        }

        $sql2 = "SELECT price FROM t_product WHERE id = ?;";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param('i', $_POST['idProduct']);
        $stmt2->execute();      
        $result2 = $stmt2->get_result();    
        if($result2->num_rows > 0){
            $row2 = $result2->fetch_assoc();
            $price = $row2['price'];
        }       
        $stmt2->close();
    

        //case the regist in t_invoice for the invoice already exists
        $sql3 = "INSERT INTO t_invoice_lines (idProduct, quatity, idInvoice) VALUES (?, ?, ?);";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->bind_param('iii', $_POST['idProduct'], $_POST['quantity'], $idInvoice);
        $stmt3->execute();
        $stmt3->close();
        //Send back id invoice and id client to Shop1
        ?>
        
        
        <form action="Shop1.php" id="ids" method="post">
            <input type="hidden" name="idInvoice" value="<?php echo $idInvoice;?>">
            <input type="hidden" name="idClient" value="<?php echo $_POST['idClient'];?>">
            <input type="hidden" name="total" value="<?php echo $_POST['total'] + ($_POST['quantity'] * $price);?>">
            <input type="hidden" name="points" value="<?php echo $_POST['points'];?>">
        </form>
        <script type="text/javascript">
            document.getElementById('ids').submit(); // SUBMIT FORM
        </script>
        <?php
        
        ?>
        
    </body>
        <?php
//incleds footer file
include 'includes/footer.php';
?>