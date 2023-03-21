<?php
  include_once 'deleteorder.php';
  include_once 'session.php';
?>

<!DOCTYPE html>
<html>
<style>
body {
  background-image: url('photos/order.png');
  background-size: auto;
  background-color: rgba(255, 255, 255, 1.0);
}
</style>
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
      <h2 style="color:white">Order List (Today)</h2>
      </div>
      
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
        $stmt = $conn->prepare("select * from orders where DATE(orderdate) = CURDATE() ORDER BY ordersid DESC LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }

      

      foreach($result as $readrow) {
      ?>   
      
      <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="thumbnail" style="height:140px; width:100%; position: relative; background-color:#CCCCCC; background-image: url('photos/do.png');">
                    
                    <div class="caption">
                    <table>
                    <tr> 
                        <td  style="width: 15%"><h2 style="color:white"><?php echo $readrow['ordersid'];  ?></h2></td>
                        
                                                       
                        <td width="35%"><h3>
                        <?php if ($readrow['tablenumber']=="0"){
                          echo "<b>Take Away</b>";
                        } else {          
                        echo  "<strong>Table: ".  $readrow['tablenumber'] ."</strong>";
                        }?>  
                        </h3>         
                       </td>                          
                      
                      <td width="42%"><h3>
                      <?php echo "Ordered Time: <strong>".$readrow['ordertime'] ."</strong>";?>
                      </h3>
                      </td>    

                      <td width=""><h3>
                      <?php echo is_null($readrow['orderstatus']) ? "Pending..." : "<strong>". $readrow['orderstatus'] ."</strong>";?>
                      </h3>
                      </td>
                      
                      <td width="100%">
                      <button name = "details" data-href="orderdetails.php?oid=<?php echo $readrow['ordersid']; ?>" class="btn btn-primary btn-block" role="button" style="vertical-align: bottom;position: absolute; bottom: 10px; right: 7px; width: 27%; background-color: #FFDE59; border-color: #FFDE59"> <?php echo '<span style="color:#080808; text-align:right"> <b>View Order</b></span>'; ?> </button>                        
                      </td>
                    </tr>	
                      </table>



                    </div>                
                </div>
            </div>

      <?php
      }
      $conn = null;
      ?>
 
  
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
            <li><a href="order.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"order.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"order.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="order.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
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