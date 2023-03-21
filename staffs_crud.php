<?php
 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['submit'])) {

  
 
  try {
 
    $stmt = $conn->prepare("INSERT INTO staff (staffid, staffname, staffemail, staffposition, staffpassword, staffdate) VALUES(:sid, :sname, :email, :pos, :password, :sdate)");

    $staffdate = date('Y-m-d');
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':sname', $sname, PDO::PARAM_STR);   
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':pos', $pos, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->bindParam(':sdate', $staffdate, PDO::PARAM_STR);
    
    $sid = $_POST['sid'];
    $sname = $_POST['sname'];    
    $email = $_POST['email'];
    $pos = $_POST['pos'];
    $password = $_POST['password'];

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
 
    $stmt = $conn->prepare("UPDATE staff SET
        staffid = :sid, staffname = :sname, staffemail = :email, staffposition = :pos, staffpassword = :password WHERE staffid = :oldsid");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':sname', $sname, PDO::PARAM_STR);    
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':pos', $pos, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->bindParam(':oldsid', $oldsid, PDO::PARAM_STR);
      
    $sid = $_POST['sid'];
    $sname = $_POST['sname'];    
    $email = $_POST['email'];
    $pos = $_POST['pos'];
    $password = $_POST['password'];
    $oldsid = $_POST['oldsid'];
         
    $stmt->execute();
 
    header("Location: staffs.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
    $stmt = $conn->prepare("DELETE FROM staff where staffid = :sid");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
       
    $sid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: staffs.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
   
  try {
 
    $stmt = $conn->prepare("SELECT * FROM staff where staffid = :sid");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
       
    $sid = $_GET['edit'];
     
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