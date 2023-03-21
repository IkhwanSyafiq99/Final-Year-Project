<?php
 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




//Create
if (isset($_POST['submit'])) {
 
  try {
    $target = "photos/";
    $target = $target . basename( $_FILES['photo']['name']);

      $stmt = $conn->prepare("INSERT INTO menu (menuid, menuname, menudescription,menuprice, menutype, menuphoto) VALUES(:pid, :name, :description, :price, :type, :photo)");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':description', $description, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_STR);
      $stmt->bindParam(':type', $type, PDO::PARAM_STR);  
      $stmt->bindParam(':photo', $photo, PDO::PARAM_STR);      
       
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $type =  $_POST['type'];
    $photo=($_FILES['photo']['name']); 
    
          

     
    $stmt->execute();
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }    

}
 
//Update
if (isset($_POST['update'])) {
   
  try {
    $target = "photos/";
    $target = $target . basename( $_FILES['photo']['name']);
 
      $stmt = $conn->prepare("UPDATE menu SET menuid = :pid, menuname = :name, menudescription = :description, menuprice = :price, menutype = :type, menuphoto = :photo WHERE menuid = :oldpid");
     
      
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':description', $description, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_STR);
      $stmt->bindParam(':type', $type, PDO::PARAM_STR); 
      $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);  
      $stmt->bindParam(':photo', $photo, PDO::PARAM_STR);    
       
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $type =  $_POST['type'];    
    $oldpid = $_POST['oldpid'];
    $photo=($_FILES['photo']['name']); 
     
    $stmt->execute();
 
    header("Location: menu.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
      $stmt = $conn->prepare("DELETE FROM menu WHERE menuid = :pid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
       
    $pid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: menu.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
 
  try {
 
      $stmt = $conn->prepare("SELECT * FROM menu WHERE menuid = :pid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
       
    $pid = $_GET['edit'];
     
    $stmt->execute();
 
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
  $conn = null;
?>