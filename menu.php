<?php
  include_once 'menu_crud.php';
  include_once 'session.php';
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Nasi Kukus: Menu</title>
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
<?php if($pos==="Admin"){ ?> 
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
        <h2>Create New Menu</h2>
      </div>
    <form autocomplete="off" action="menu.php" method="post" class="form-horizontal" enctype="multipart/form-data">

      <div class="form-group">
          <label for="menuid" class="col-sm-3 control-label">Menu ID</label>
          <div class="col-sm-9">          
          <input name="pid" type="text" class="form-control" id="menuid" placeholder="Menu ID" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['menuid'] ; ?>">          
          </div>
      </div>

      <div class="form-group">
          <label for="menuname" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-9">
          <input name="name" type="text" class="form-control" id="menuname" placeholder="Menu Name" pattern="[^0-9]*" value="<?php if(isset($_GET['edit'])) echo $editrow['menuname']; ?>" required>
          </div>
      </div>

      <div class="form-group">
          <label for="menudescription" class="col-sm-3 control-label">Description</label>
          <div class="col-sm-9">
          <input name="description" type="text" class="form-control" id="menudescription" placeholder="Menu Description" value="<?php if(isset($_GET['edit'])) echo $editrow['menudescription']; ?>" required>
          </div>
      </div>

      <div class="form-group">
          <label for="menuprice" class="col-sm-3 control-label">Price</label>
          <div class="col-sm-9">
          <input name="price" type="number" class="form-control" id="menuprice" placeholder="Menu Price" value="<?php if(isset($_GET['edit'])) echo $editrow['menuprice']; ?>" min="0.0" step="0.1" required>
          </div>
      </div>      

      <div class="form-group">
          <label for="menutype" class="col-sm-3 control-label">Type</label>
          <div class="col-sm-9">
          <select name="type" class="form-control" id="menutype" required>
            <option value="">Please select</option>
            <option value="Food" <?php if(isset($_GET['edit'])) if($editrow['menutype']=="Food") echo "selected"; ?>>Food</option>
            <option value="Drink" <?php if(isset($_GET['edit'])) if($editrow['menutype']=="Drink") echo "selected"; ?>>Drink</option>
          </select>
          </div>
      </div>   

      <div class="form-group">
          <label for="menuphoto" class="col-sm-3 control-label">Photo</label>
          <div class="col-sm-9">
          <input name="photo" type="file" id="menuphoto" accept="image/*"  value="<?php if(isset($_GET['edit'])) echo $editrow['menuphoto']; ?>">
          </div>
      </div>           

      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">

          <?php if (isset($_GET['edit'])) { ?>
          <input type="hidden" name="oldpid" value="<?php echo $editrow['menuid']; ?>">
          <button class="btn btn-success" type="submit" name="update" style="float: right;"><span aria-hidden="true"></span>Update</button>
          <?php } else { ?>
          <button class="btn btn-success" type="submit" name="submit" style="float: right;"><span aria-hidden="true"></span>Submit</button>
          <?php } ?>
          <button class="btn btn-default" type="reset" style="float: right; margin-right: 10px;"><span aria-hidden="true"></span>Clear</button>
        </div>
      </div>

    </form>
    </div>
  </div>
  <?php } ?>

  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Menu List</h2>
      </div>
      <table class="table table-striped table-bordered">
        <tr style="font-weight:bold; background-color: #FFDE59;">
          <th>Menu ID</th>
          <th>Name</th>
          <th>Description</th>
          <th>Price</th>
          <td>Type</td>          
          <?php if($pos==="Admin") {?>                  
          <th></th>
           <?php } ?>
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
        $stmt = $conn->prepare("select * from menu LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>   
      <tr>
        <td><?php echo $readrow['menuid']; ?></td>
        <td><?php echo $readrow['menuname']; ?></td>
        <td><?php echo $readrow['menudescription']; ?></td>
        <td>RM<?php echo $readrow['menuprice']; ?></td>
        <td><?php echo $readrow['menutype']; ?></td>        
        <?php if($pos==="Admin"){ ?>
        <td>
          <button 
          data-href="menu_detailsnobutton.php?pid=<?php echo $readrow['menuid']; ?>" class="btn btn-info btn-xs; glyphicon glyphicon-eye-open;" role="button" style="font-family: arial">View</button>          
          <a href="menu.php?edit=<?php echo $readrow['menuid']; ?>" class="btn btn-warning btn-xs; glyphicon glyphicon-edit;" role="button" style="font-family: arial">Edit</a>
          <a href="menu.php?delete=<?php echo $readrow['menuid']; ?>" onclick="return confirm('Are you sure you want to delete menu?');" class="btn btn-danger btn-xs; glyphicon glyphicon-trash;" role="button" style="font-family: arial">Delete</a>
        </td>
      <?php } ?>
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
            $stmt = $conn->prepare("SELECT * FROM menu");
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
            <li><a href="menu.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"menu.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"menu.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="menu.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
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
                    <h3 class="modal-title" style="color: white">Menu Details</h3>
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