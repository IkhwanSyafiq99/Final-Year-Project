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
      <img src="photos/<?php echo $readrow['menuphoto'] ?>" class="img-responsive" width="100%" height="100%" alt="image">
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
      <form id="formmenudetails">
            <td><strong>Special Instructions</strong></td>
						<input type="text" name="special_instructions" class="form-control" placeholder="e.g. extra sambal" autocomplete="off"/>
            </br>            
            <td><strong>Quantity</strong></td>
						<input type="number" name="quantity" value="1"  min="1.0" step="1" class="form-control" id="number" required/>            

            <input type="hidden" name="pid" value="<?php echo $readrow['menuid']; ?>" />

						<input type="hidden" name="hiddenname" value="<?php echo $readrow['menuname']; ?>" />

						<input type="hidden" name="hiddenprice" value="<?php echo $readrow['menuprice']; ?>" />
            </br>
            </br>
						<button type="button" name="addtocart" class="btn btn-success; pull-right; border-radius:1px" onclick="submitform();" style="vertical-align: bottom; position: absolute; bottom: 10px; right: 7px; width: 95%; background-color: #FFDE59; border-color: #FFDE59">               
            <?php echo '<span style="color:#080808; text-align:center"> <b>Place Order</b></span>'; ?>
            </button>
       </form>
       </div>
    </div>
</div>
 
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
   <!--  for modal popup -->
   <script>
   function submitform(){         
          confirm = confirm('Are you sure you want to add <?php echo $readrow['menuname'] ?> to cart?');

          if (confirm) {
            data = $("#formmenudetails").serialize();
            console.log(data);
            window.location.replace("/nasikukus/session_shoppingcart.php?"+data);
          }
        }
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


