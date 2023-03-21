<?php  

 include_once 'database.php';
 
 ?>  
 <!DOCTYPE html>  
 <html>  
 <style>
body {
  background-image: url('photos/home.jpg');
  background-size: 1550px 900px;
}
</style>
      <head>          
           <title>Nasi Kukus: Main Page</title>  
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
          <link href="css/bootstrap.min.css" rel="stylesheet"> /
             <script src="js/bootstrap.min.js"></script>  
             <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.container {
  position: relative;
  width: 100%;
  height: 100%;
}

.image {
  opacity: 1;
  transition: .5s ease;
  backface-visibility: hidden;
}

.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.container:hover .image {
  opacity: 0.3;
}

.container:hover .middle {
  opacity: 0.9;
}

.text {
     
  background-color: #262626;
  color: white;
  font-size: 24px;
  padding: 32px 64px;
}
</style>
      </head>  
      <body>  
           <br />            
           <div class="container" style=" width:500px">                        
           <div class="col-6 mx-auto">       
           <div class="jumbotron" style="background-color: #EDEDED; center-align">                                           
                <?php  
                if(isset($message))  
                {  
                     echo '<label class="text-danger">'.$message.'</label>';  
                }  
                ?>  
                <center>
                <img src="photos/mainlogo.PNG" width="100%" height="100%" >
                
            </center>  
            <br/>
            <br/>
            <div class="container">
            <a href="https://localhost/nasikukus/homecustomer.php"  onclick="alert('Welcome to Nasi Kukus. We hope you enjoy your visit!')">
            <img src="photos/customernew.jpg" class="img-responsive" width="100%" height="100%"> 
            <div class="middle">
            <div class="text">Customer</div>
            </div>
            </div> 
            </br>
            </br>           
            <div class="container">
            <a href="https://localhost/nasikukus/login.php">
            <img src="photos/staffnew.jpg" class="img-responsive" width="100%" height="100%"></figure>             
            <div class="middle">
            <div class="text">Staff</div>
            </div>
            </div>  
            </br>
            </br>
                </div>                
                </div>
                </div>  
                </div>                        
      </body>  
 </html>  