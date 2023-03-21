<?php
include_once 'db.php';

session_start(); 
	
	$email = $_SESSION['staffemail'];
	
	$stmt = $conn->prepare("SELECT * FROM staff WHERE staffemail = '$email'");

	$stmt->execute();
	
	$readrow = $stmt->fetch(PDO::FETCH_ASSOC);

	$sid = $readrow['staffemail'];
	$name = $readrow['staffname'];	
	$email= $readrow['staffemail'];
	$pos = $readrow['staffposition'];
	$pass= $readrow['staffpassword'];
		
if($email==''){
	header("location:login.php");
	}
	else {
	header("");
	}
?>