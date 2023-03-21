<?php
  session_start();
?>


<!DOCTYPE html>
<html>
<style>
body {
  background-image: url('photos/demo.png');
  background-size: auto;
  background-color: rgba(255, 255, 255, 1.0);
}
</style>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Nasi Kukus: Cart</title>
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

<?php include_once 'nav_barcustomer.php'; ?>

<div class="container-fluid">
<div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Your Cart</h2>
      </div>

      <div class="container-fluid">                        
        <div class="col-md-12">       
          <div class="jumbotron" style="background-color: #FFFFFF; border: 2px; border-color: #D9D9D9; border-style: solid;center-align">                                            

          <?php 
          if (!empty($_SESSION["shoppingcart"]))
            {
              ?>  
            <table class="table" style="border: none">
              <tr style="font-weight:bold; background-color: #">
                <th>Order</th>
                <th>Quantity</th>
                <th>Price</th>                                                                   
                <th></th>     
            </tr>
            
            <?php        
              $subtotal = 0;
              foreach($_SESSION["shoppingcart"] as $keys => $values)
              {
              ?>  
              <tr>
                  <td ><?php echo $values["itemname"]; ?></td>                
                  <td style="width: 70px">x<?php echo  $values["itemquantity"]; ?> </td>              
                  <td><strong>RM<?php echo number_format($values["itemquantity"] * $values["itemprice"], 2);  ?></strong></td>             
                  <td><a href="session_shoppingcart.php?action=delete&itemid=<?php echo $values["itemid"]; ?>"><span class="text-danger">Remove</span></a></td>                                
              </tr>    
              <?php 
              $subtotal = $subtotal + ($values["itemquantity"] * $values["itemprice"]);

                    }
                ?>        
            </table>                    
          </div>
        </div>  
      </div> 
                 
      <div class="container-fluid"    id="payment">                        
        <div class="col-md-12" >       
          <div class="jumbotron" style="center-align">
          
          <form action="order_crud.php" method="post">
      
          <input type="radio" id="css" name="fav_language" value="takeout" onChange='onChange(false)' required>
          <label for="takeout">Take Out</label>    
          <input type="radio" id="html" name="fav_language" value="dinein" style="margin-left:2.5em" id="dinein" onChange='onChange(true)' required>
          <label for="dinein">Dine-In</label> 
        
            <div class="Box" style="display:none">
            </br>
              <div class="form-group">
                <label for="tablenumber">Table Number (1-13)</label>         
                <input name="tnum" type="number" class="form-control" id="tablenumber" placeholder="Please select the correct table number" min="1" max="13" step="1">         
             </div>
      </div>
      </br>
        
      <table class="table" style="border: none; font-size: 150%">         
        <tr>
            <td colspan="3" align ="left"><strong>Total</strong></td>
         
              <td align="right"><strong>RM <?php echo number_format($subtotal, 2); ?></strong></td>   

            <td></td>
        </tr>   
        
      </table>
      
        <input type="submit" name="submit" class="btn btn-success" value="Submit Order" style="vertical-align: bottom; position: absolute; right: 30px; width: 35%;"/>                                 
      </form>
      <?php
        } else { ?>
        <center>
          <img src="photos/emptycart.png" width="40%" height="40%">
        </center>
          <?php }
      ?>
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
    function onChange(required) {
      document.getElementById('tablenumber').required = required;      
    }  

    $("#tablenumber").keypress(function (evt) {
    evt.preventDefault();
    });

    $(document).keydown(function(e) {
        var elid = $(document.activeElement).hasClass('textInput');
      console.log(e.keyCode + ' && ' + elid);
        //prevent both backspace and delete keys
        if ((e.keyCode === 8 || e.keyCode === 46) && !elid) {
            return false;
        };
    });
      
    $(document).mouseup(function(e) {
      var $container = $("#payment");
      if (!$container.is(e.target) && !$("#paymentbutton").is(e.target) && $container.has(e.target).length === 0) {
        $container.show();
      }
    });

    $("#paymentbutton").click(function() {
      $("#payment").toggle();
    });

    $(document).ready(function () {
        $('input[type="radio"]').click(function () {
            if ($(this).attr("value") == "takeout") {
                $(".Box").hide('fast');
            }
            if ($(this).attr("value") == "dinein") {
                $(".Box").show('fast');

            }
        });

        $('input[type="radio"]').trigger('click');  // trigger the event
    });
</script>
 <style>
    .bs-example{
      margin: 20px;
    }
</style>
</head>
</html>

