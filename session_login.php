<?php
include_once 'db.php';

session_start(); 
	
	$sid = $_SESSION['staffid'];
	
	$stmt = $conn->prepare("SELECT * FROM staff WHERE staffid = '$sid'");

	$stmt->execute();
	
	$readrow = $stmt->fetch(PDO::FETCH_ASSOC);

	$sid = $readrow['staffid'];
	$name = $readrow['staffname'];	
	$email= $readrow['staffemail'];
	$pos = $readrow['staffposition'];
	$pass= $readrow['staffpassword'];
		
if($sid==''){
	header("location:login.php");
	}
	else {
	header("");
	}
?>