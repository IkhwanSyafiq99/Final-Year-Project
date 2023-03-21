<?php
  include_once 'deleteorder.php';
  include_once 'session.php';
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Nasi Kukus: Order</title>
  <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<?php include_once 'nav_bar.php'; ?>

<div class="container-fluid">

  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Order History</h2>
      </div>
      <table class="table table-striped table-bordered">
        <tr style="font-weight:bold; background-color: #FFDE59;">
          <th>Order ID</th>        
          <th>Order Amount</th>
          <th>Table Number/Take Away</th>         
          <td>Status</td> 
          <td>Date/Time</td> 
          <td></td>                       
      </tr>
      <?php
      // Read
      $per_page = 10;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
      $start_from = ($page-1) * $per_page;
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
        $stmt = $conn->prepare("select * from orders ORDER BY ordersid DESC LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>   
      <tr>
        <td><?php echo $readrow['ordersid']; ?></td>        
        <td>RM<?php echo $readrow['ordersamount']; ?></td>
        <td>
          <?php if ($readrow['tablenumber']=="0"){
            echo "Take Away";
          } else {          
          echo $readrow['tablenumber'];
          }?>
        </td>
        <td>
        <?php echo is_null($readrow['orderstatus']) ? "Pending..." : "<strong>". $readrow['orderstatus'] . "<strong>";?>
        </td>
        <td>
        <?php echo $readrow['orderdate'];?>
        </td>         
        <td>
        <button 
          data-href="orderdetailsnobutton.php?oid=<?php echo $readrow['ordersid']; ?>" class="btn btn-info btn-xs; glyphicon glyphicon-eye-open;" role="button" style="font-family: arial">View</button>                    
          <?php if ($readrow['orderstatus'] == NULL) { ?>
        <a href="order.php?delete=<?php echo $readrow['ordersid']; ?>" onclick="return confirm('Are you sure you want to cancel this order?');" class="btn btn-danger btn-xs; glyphicon glyphicon-trash;" role="button" style="font-family: arial">Cancel Order</a>
            <?php } ?>
        </td>
      </tr>
      <?php
      }
      $conn = null;
      ?>
 
    </table>
  </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <nav>
          <ul class="pagination">
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM orders");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $total_records = count($result);
          }
          catch(PDOException $e){
                echo "Error: " . $e->getMessage();
          }
          $total_pages = ceil($total_records / $per_page);
          ?>
          <?php if ($page==1) { ?>
            <li class="disabled"><span aria-hidden="true">«</span></li>
          <?php } else { ?>
            <li><a href="orderhistory.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"orderhistory.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"orderhistory.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="orderhistory.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
</div>

<div class="bs-example">
    <!-- Button HTML (to Trigger Modal) -->
   
    <!-- Modal HTML -->
    <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#262626; width:100.09%">
                    <h3 class="modal-title" style="color: white">Order Details</h3>
                    <button type="button" class="close" style="color: white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                </div>
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
    if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
 <style>
    .bs-example{
      margin: 20px;
    }
</style>
</head>
</html>