<?php  

 include_once 'database.php';
 session_start();
 if(isset($_SESSION["staffid"]))  
      {  
        header("location:home.php");
      }

if(isset($_POST["goback"]))  
      {
        header("location:main.php");
      } 

 try  
 {  
       $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      if(isset($_POST["login"]))  
      {  
           if(empty($_POST["staffemail"]) || empty($_POST["password"]))  
           {  
                $message = '<label>You must fill in all of the fields</label>';  
           }  
           else  
           {  
                $query = "SELECT * FROM staff WHERE staffemail = :staffemail AND staffpassword = :password";  
                $stmt = $conn->prepare($query);  
                $stmt->execute(  
                     array(  
                          'staffemail'     =>     $_POST["staffemail"],  
                          'password'     =>     $_POST["password"]  
                     )  
                );  
                $count = $stmt->rowCount();  
                if($count > 0)  
                {  
                	
                    $_SESSION["staffemail"] = $_POST["staffemail"];  
                   
                  

                     header("location:login_success.php");  
                }  
                else  
                {  
                     $message = '<label>The email or password that you have entered is incorrect</label>';  
                }  
           }  
      }  
 }  
 catch(PDOException $error)  
 {  
      $message = $error->getMessage();  
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
 <style>
body {
  background-image: url('photos/kitchen2jpg.jpg');
  background-size: 1550px 900px;
}
</style>
      <head>  
        <?php include_once 'nav_bar_login.php' ?>
           <title>Nasi Kukus: Login</title>  
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
          <link href="css/bootstrap.min.css" rel="stylesheet"> 
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
             <script src="js/bootstrap.min.js"></script>  
             <script src="js/bootstrap.min.js"></script>
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
		<link rel="stylesheet" href="css/style.css" />
             
               
      </head>  
      <body>  
           <br />            
           <div class="container" style=" width:500px">                        
           <div class="col-6 mx-auto">       
           <div class="jumbotron" style="background-color: #F5F5F5; center-align">                                
           <div class="container-fluid"> 
                <?php  
                if(isset($message))  
                {  
                     echo '<label class="text-danger">'.$message.'</label>';  
                }  
                ?>  
                <center>
                <h3> <font>Nasi Kukus Staff Login</font></h3>
            </center>  
            <br/>
            <br/>
                <form autocomplete="off" method="post">  
                     <label>Email</label>  
                     <input type="text" name="staffemail" class="form-control" class="required" placeholder="Email" id="inputEmail" />  
                     <br />  
                     <label>Password</label>  
                     <input type="password" name="password" class="form-control pwd" placeholder="Staff Password" id="inputPassword" />                                                             
                     <br>
                     
                     <br/>
                     <br/>  
                     <br/>   
                     <input type="submit" name="goback" class="btn btn-primary" value="Go Back" style="background-color: #065eb7; float: left;" />                       
                     <input type="submit" name="login" class="btn btn-success" value="Login" style=" float: right;" id="start_button" disabled/>  
                </form> 
                </div> 
                </div>
                </div>  
                </div> 
          <div class="container" style=" width:500px"> 
          <div class="jumbotron" style="background-color: #F5F5F5; center-align">  
          *Please refer to the admin for changes or if you are unable to access the website     
          </div> 
          </div>

          <script>
          
          function myFunction() {
          var x = document.getElementById("inputPassword");
          if (x.type === "password") {
          x.type = "text";
          } else {
          x.type = "password";
          }
          }

          function validate(){
               if ($('#inputEmail').val().length   >   0   &&                    
                    $('#inputPassword').val().length    >   0) {
                    $("#start_button").prop("disabled", false);
               }
               else {
                    $("#start_button").prop("disabled", true);
               }
          }

         

          $(document).ready(function (){
               validate();
               $('#inputEmail, #inputPassword').change(validate);
          });
          </script>

      </body>  
 </html>  