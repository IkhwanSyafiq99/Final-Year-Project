<?php

include_once 'database.php'; 
  session_start();  

  if(isset($_GET["action"]))
    {
        if($_GET["action"] == "delete")
        {
            foreach($_SESSION["shoppingcart"] as $keys => $values)
            {
                if($values["itemid"] == $_GET["itemid"])
                {
                    unset($_SESSION["shoppingcart"][$keys]);
                    echo '<script>alert("Item has been removed!")</script>';
                    echo '<script>window.location="shoppingcart.php"</script>';
                }
            }
        }
        return true;
    }

  if(isset($_SESSION["shoppingcart"]))
    {
      $item_array_id = array_column($_SESSION["shoppingcart"], "itemid");
      if (!in_array($_GET["pid"], $item_array_id))
      {
          $count = count($_SESSION["shoppingcart"]);
          $item_array = array(
            "itemid" => $_GET["pid"],
            "itemname" => $_GET["hiddenname"],
            "itemprice" => $_GET["hiddenprice"],
            "itemquantity" => $_GET["quantity"],
            "itemcomments" => $_GET["special_instructions"]
          );
          $_SESSION ["shoppingcart"][$count] = $item_array;
      } else {
        //   echo '<script>alert("Item Already Added")</script>';
        //   echo '<script>window.location="menu_details.php"</script>';            
      }
    }
    else
    {
      $item_array = array (
        "itemid" => $_GET["pid"],
        "itemname" => $_GET["hiddenname"],
        "itemprice" => $_GET["hiddenprice"],
        "itemquantity" => $_GET["quantity"],
        "itemcomments" => $_GET["special_instructions"]
      );
      $_SESSION["shoppingcart"][] = $item_array;
    }
  
    // var_dump($_SESSION);
    // die();

  ?>

<script type="text/javascript">location.href = '/nasikukus/homecustomer.php';</script>