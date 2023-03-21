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
$per_page = 10;
if (isset($_GET["page"]))
  $page = $_GET["page"];
else
  $page = 1;
$start_from = ($page-1) * $per_page;
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM orderedfood LEFT JOIN orders ON orders.ordersid=orderedfood.ordersid WHERE orderedfood.ordersid = :oid  LIMIT $start_from, $per_page");
  $stmt->bindParam(':oid', $pid, PDO::PARAM_STR);
    $pid = $_GET['oid'];
  $stmt->execute();
  $result = $stmt->fetchAll();
  }
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
 
<div class="container-fluid">
  <table class="table" style="border: none">
    <tr style="font-weight:bold; background-color: #">      
      <th>Order</th>
      <th>Quantity</th>
      <th>Price</th>
      <?php if (!empty($readrow['additionalcomments'])) { ?> 
      <th>Special Instructions</th>
      <?php } ?>                                                                    
      <th></th>     
    </tr>


    
    <?php
      foreach($result as $readrow) {
    ?>   
     
      <tr>    
                   
          <td ><?php echo $readrow["menuname"]; ?></td>                
          <td style="width: 70px">x<?php echo  $readrow["menuquantity"]; ?> </td>
          <td style="width: 70px">RM<?php echo number_format($readrow["menuquantity"] * $readrow["orderedprice"], 2); ?> </td>
          <?php if (!empty($readrow['additionalcomments'])) { ?>           
          <td><?php echo "(" . $readrow["additionalcomments"] . ")" ?></td>          
          <?php } ?>                                                      
      </tr>						       
      <?php
      }
      $conn = null;
      ?>
        
              
      </table>

      
    <form id="forstatusupdate" method="post" action="updatestatus.php"> 

    <?php 
      foreach($result as $readrow) { ?>
      
      <input type="hidden" name="oid" value=<?php echo $readrow ["ordersid"]; ?>></input>
      
      <?php
      }
    ?>
      
    </form> 
    
    </br>

      <table class="table" style="border: none; font-size: 150%">         
        <tr>            
         
        <td >
                        <?php if ($readrow['tablenumber']=="0"){
                          echo "<b>Take Away</b>";
                        } else {          
                        echo  "<strong>Table: ".  $readrow['tablenumber'] ."</strong>";
                        }?>  
                                
                       </td> 
                         
                       

            <td></td>
        </tr> 
    </table>
      <table class="table" style="border: none; font-size: 150%">         
        <tr>
            <td colspan="3" align ="left"><strong>Total</strong></td>
         
              <td align="right"><strong>RM <?php echo $readrow["ordersamount"]; ?></strong></td>   

            <td></td>
        </tr> 
    </table>

    </table>
      <table class="table" style="border: none; font-size: 150%">         
        <tr>
            <td colspan="3" align ="left"><strong>Ordered On: </strong></td>
         
            <td align="right"><strong><?php echo $readrow["orderdate"]; ?></strong></td>    

            <td></td>
        </tr> 
    </table>

    </br>
      
      </br>       
      
</div>
 
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
   <!--  for modal popup -->
   <script>
   function submitform(){         
          confirm = confirm('Confirm order has been completed?');

          if (confirm) {            
            window.location.replace("/nasikukus/updatestatus.php?");
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


