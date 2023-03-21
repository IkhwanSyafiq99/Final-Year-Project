<?php
include_once 'db.php';
include_once 'session.php';

 if (count($_POST) > 0) {
    if ($_POST["currentPassword"] === $pass ) {
         $stmt= $conn->prepare ( "UPDATE staff set staffpassword= :confirmPassword WHERE staffemail = '$email'");
        
        
         $stmt->bindParam(':confirmPassword', $confirmPassword, PDO::PARAM_STR);
         
         
         $confirmPassword = $_POST['confirmPassword'];
         
         $stmt->execute();
        echo '<script type="text/javascript">'; 
		echo 'alert("Your password has been changed successfully!");'; 
		echo 'window.location.href = "home.php";';
		echo '</script>';

    } else
         	echo '<script type="text/javascript">'; 
			echo 'alert("Current Password is not correct!");'; 
			echo '</script>';
}
?>

<html>
<head>
<title>Nasi Kukus: Change Password</title>
 <link href="css/bootstrap.min.css" rel="stylesheet"> 
</head>
<body>
 	
 <?php include_once 'nav_bar.php'; ?>
<div class="container" style="width:500px;">  

<?php if(isset($message)) {  
	echo '<label class="text-danger">'.$message.'</label>'; 
} ?>

<div class="page-header">
        <h2>Change Password</h2>
      </div>
	
<form name="frmChange" method="post" action="" onSubmit="return validatePassword()">

<label>Current Password</label>
<input type="password" name="currentPassword" class="form-control"/><span id="currentPassword"  class="required"></span>
<br />
<label>New Password</label>
<input type="password" name="newPassword" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"/><span id="newPassword" class="required"></span>
<span class="passwordwarning" style='color: red'>Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters.</span>
<br />
<br />
<label>Confirm Password</label></td>
<input type="password" name="confirmPassword" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"/><span id="confirmPassword" class="required"></span>
<br />
<br />
<input type="submit" name="submit" value="Submit" class="btn btn-info" style="background-color: #4CAF50; border-color: #4CAF50; float: right">

</div>
</form>
</body></html>

<script>
function validatePassword() {
var currentPassword,newPassword,confirmPassword,output = true;

currentPassword = document.frmChange.currentPassword;
newPassword = document.frmChange.newPassword;
confirmPassword = document.frmChange.confirmPassword;

if(!currentPassword.value) {
currentPassword.focus();
document.getElementById("currentPassword").innerHTML = "<span style='color: red;'>Required</span>";
output = false;
}
else if(!newPassword.value) {
newPassword.focus();
document.getElementById("newPassword").innerHTML = "<span style='color: red;'>Required</span>";
output = false;
}
else if(!confirmPassword.value) {
confirmPassword.focus();
document.getElementById("confirmPassword").innerHTML = "<span style='color: red;'>Required</span>";
output = false;
}
if(newPassword.value != confirmPassword.value) {
newPassword.value="";
confirmPassword.value="";
newPassword.focus();
document.getElementById("confirmPassword").innerHTML = "<span style='color: red;'>Passwords do not match!</span>";
output = false;
} 	
return output;
}
</script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <link href="css/bootstrap.min.css" rel="stylesheet"> 
             <script src="js/bootstrap.min.js"></script>  