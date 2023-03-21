<?php
  include_once 'database.php';  
  
?>
 
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Nasi Kukus: Menu Details</title>
  <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
       
<body>
 
 
 
<?php
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM menu WHERE menuid = :pid");
  $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
    $pid = $_GET['pid'];
  $stmt->execute();
  $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
  }
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
 
<div class="container-fluid">

  <tr>
      <?php if ($readrow['menuphoto'] == "" ) { ?>
      <img src="photos/noimagerip.jpg" class="img-responsive" width="100%" height="100%">
      <?php } else { ?>
      <img src="photos/<?php echo $readrow['menuphoto'] ?>" class="img-responsive" width="100%" height="100%">
      <?php } ?>

        </tr>
        </br>        
      <div class="panel panel-default">
      <div class="panel-heading">
      <strong>Menu Details</strong></div>
    
      <table class="table">
              
        <tr>
          <td><strong>Name</strong></td>
          <td><?php echo $readrow['menuname'] ?></td>
        </tr>
        <tr>
          <td><strong>Description</strong></td>
          <td><?php echo $readrow['menudescription'] ?></td>
        </tr>
        <tr>
          <td><strong>Price</strong></td>
          <td>RM<?php echo $readrow['menuprice'] ?></td>
        </tr>
        <tr>
          <td><strong>Type</strong></td>
          <td><?php echo $readrow['menutype'] ?></td>
        </tr>               
      </table>
      </br>       
      </div>       
       </div>
    </div>
</div>
 
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
   <!--  for modal popup -->
   <script>
    $(document).ready(function(){
        $(".btn").click(function(){
           var dataURL = $(this).attr( "data-href" )
            $('.modal-body').load(dataURL,function(){
        $('#myModal').modal({show:true});
        $('#myModal').on('hidden.bs.modal', function () {
 			    location.reload();
		    })
    });
        });
    });
</script>
 <style>
    .bs-example{
      margin: 20px;
    }
</style>
</body>
</head>
</html>

<?php


