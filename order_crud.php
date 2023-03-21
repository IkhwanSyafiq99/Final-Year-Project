<?php
 
include_once 'database.php';
session_start();
// unset($_SESSION["shoppingcart"]);
// die();
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['submit'])) {
 
    $subtotal = 0;
    foreach($_SESSION["shoppingcart"] as $keys => $values)
    {
    $subtotal = $subtotal + ($values["itemquantity"] * $values["itemprice"]);
    }
    
    
  try {
 
    $stmt = $conn->prepare("INSERT INTO orders (ordersamount, tablenumber, orderdate, ordertime) VALUES(:ordersamount, :tnum, :odate, :otime)");

    $orderdate = date('Y-m-d H:i:s');
    $ordertime = date('H:i:s');
   
    $stmt->bindParam(':ordersamount', $subtotal, PDO::PARAM_STR);   
    $stmt->bindParam(':tnum', $tnum, PDO::PARAM_STR); 
    $stmt->bindParam(':odate', $orderdate, PDO::PARAM_STR); 
    $stmt->bindParam(':otime', $ordertime, PDO::PARAM_STR); 
    
    $tnum = $_POST['tnum'];

    $stmt->execute();
    $oid = $conn->lastInsertId();

    foreach($_SESSION["shoppingcart"] as $keys => $values)
    {
        $stmt = $conn->prepare("INSERT INTO orderedfood (ordersid, menuid, menuname, menuquantity, additionalcomments, orderedprice) VALUES(:oid, :mid, :name,:quantity, :comments, :oprice)");  
        
        $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
        $stmt->bindParam(':mid', $values["itemid"], PDO::PARAM_STR);   
        $stmt->bindParam(':name', $values["itemname"], PDO::PARAM_STR);   
        $stmt->bindParam(':quantity', $values["itemquantity"], PDO::PARAM_STR);       
        $stmt->bindParam(':comments', $values["itemcomments"], PDO::PARAM_STR);    
        $stmt->bindParam(':oprice', $values["itemprice"], PDO::PARAM_STR);        
        
        $stmt->execute();
    }

    unset($_SESSION["shoppingcart"]);

    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
  ?>
  <script> alert("Thank you. Please wait while we prepare your meal.");</script>
  <script type="text/javascript">location.href = '/nasikukus/main.php';</script>
<?php
}
?>

 