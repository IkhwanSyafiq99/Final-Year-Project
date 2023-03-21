<?php

include_once 'database.php';  

  if(isset($_POST['submit']))
    {      
        
        try {

            $oid = $_POST['oid'];
            
            $sql = "UPDATE orders SET orderstatus = 'Completed' WHERE ordersid = '$oid'";

            if ($conn->query($sql) === TRUE) {
              header('Location:order.php');
            } else {
              echo "Error updating record: " . $conn->error;
            }
                             
          }
       
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
         }  ?>
        
        <?php  } 
?>




