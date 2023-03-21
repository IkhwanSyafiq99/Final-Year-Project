<?php

include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Delete
if (isset($_GET['delete'])) {
 
    try {
   
        $stmt = $conn->prepare("DELETE FROM orders WHERE ordersid = :oid");
       
        $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
         
      $oid = $_GET['delete'];
       
      $stmt->execute();
   
      header("Location: orderhistory.php");
      }
   
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
  }
?>