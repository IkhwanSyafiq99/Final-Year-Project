<?php  
include_once 'database.php';
include_once 'session.php';

	//$pos = $readrow['FLD_POSITION'];

 //login_success.php  

 
 	if(isset($_SESSION["staffemail"]))  
 	{  
     	echo '<script type="text/javascript">'; 
		echo 'alert("Welcome '.$name.'! Your position is '.$pos.'");'; 
		echo 'window.location.href = "home.php";';
		echo '</script>';
 	}  
 	else  
 	{  
	   	echo '<script type="text/javascript">'; 
		echo 'alert("Please login First!");'; 
		echo 'window.location.href = "login.php";';
		echo '</script>';
 	}  
 ?>  