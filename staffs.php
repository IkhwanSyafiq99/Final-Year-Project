<?php
  include_once 'staffs_crud.php';
  include_once 'session.php';
?>
 
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Nasi Kukus : Staffs</title>
  <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
             <script src="js/bootstrap.min.js"></script>  
             <script src="js/bootstrap.min.js"></script>
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
		<link rel="stylesheet" href="css/style.css" />
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
   
  <?php include_once 'nav_bar.php'; ?>
 
 <!-- admin ui only-->
  <?php if($pos==="Admin" ){ ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
      <?php if($pos==="Admin"){ ?>
        <h2>Create New Staff</h2>
      <?php }else{ ?>
         <h2>Edit Staffs</h2>
          <?php } ?>
      </div>
    <form autocomplete="off" action="staffs.php" method="post" class="form-horizontal" enctype="multipart/formdata">      
    <div class="form-group">
          <label for="staffid" class="col-sm-3 control-label">Staff ID</label>
          <div class="col-sm-9">
          <input name="sid" type="text" class="form-control" id="staffid" placeholder="Staff ID" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['staffid']; ?>">
          </div>
      </div>
      <div class="form-group">
          <label for="staffname" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-9">
          <input name="sname" type="text" class="form-control" id="staffname" placeholder="Staff Name" pattern="[^0-9]*" value="<?php if(isset($_GET['edit'])) echo $editrow['staffname']; ?>" required>
        </div>
        </div>        
        <div class="form-group">
         <label for="staffemail" class="col-sm-3 control-label">Email</label>
          <div class="col-sm-9">
          <input name="email" type="email" class="form-control" id="staffemail" placeholder="Staff Email"  pattern="[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)" value="<?php if(isset($_GET['edit'])) echo $editrow['staffemail']; ?>" required>
        </div>
        </div>
        <div class="form-group">
         <label for="password" class="col-sm-3 control-label">Password</label>
          <div class="col-sm-9">
          <input name="password" type="password" class="form-control" id="password" placeholder="Staff Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" value="<?php if(isset($_GET['edit'])) echo $editrow['staffpassword']; ?>" required>
          <span class="passwordwarning" style='color: red' >Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters.</span>
          <br>
          <input onclick="myFunction()" type="checkbox"> Show Password                                         
          <br/>
        </div>      
        </div>         
        <div class="form-group">
          <label for="position" class="col-sm-3 control-label">Position</label>
          <div class="col-sm-9">
          <select name="pos" class="form-control" id="position" required>
            <option value="">Please select</option>
            <option value="Admin" <?php if(isset($_GET['edit'])) if($editrow['staffposition']=="Admin") echo "selected"; ?>>Admin</option>            
            <option value="Staff" <?php if(isset($_GET['edit'])) if($editrow['staffposition']=="Staff") echo "selected"; ?>>Staff</option>
          </select>
          </div>
        </div>              
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
          <?php if (isset($_GET['edit'])) { ?>
          <input type="hidden" name="oldsid" value="<?php echo $editrow['staffid']; ?>">
          <button class="btn btn-success" type="submit" name="update" style="float: right;"><span aria-hidden="true"></span>Update</button>
          <?php } else { ?>
             <?php if($pos === "Admin"){ ?>
              <button class="btn btn-success" type="submit" name="submit" style="float: right;"><span aria-hidden="true"></span>Submit</button>
        <?php } ?>
          <?php } ?>
          <button class="btn btn-default" type="reset" style="float: right; margin-right: 10px;"><span aria-hidden="true"></span>Clear</button>
        </div>
      </div>
    </form>
    </div>
  </div>
  <?php } ?>
 <!-- end of admin ui -->


  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Staff List</h2> 
      </div>
      <table class="table table-striped table-bordered">
        <tr style="font-weight:bold; background-color: #FFDE59;">
          <th>Staff ID</th>
          <th>Name</th>          
          <th>Email</th>
          <th>Position</th>
          <th>DOE</th>
          <?php if($pos==="Admin") {?>
          <?php if($pos==="Admin") {?>
          <th>Password</th>
          <?php } ?>           
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
        $stmt = $conn->prepare("select * FROM staff LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }     

      foreach($result as $readrow) {
      ?>   
      <tr>        
        <td><?php echo $readrow['staffid']; ?></td>
        <td><?php echo $readrow['staffname']; ?></td>        
        <td><?php echo $readrow['staffemail']; ?></td>
        <td><?php echo $readrow['staffposition']; ?></td>
        <td><?php echo $readrow['staffdate']; ?></td>
        <?php if($pos==="Admin") {?>
        <td><?php echo $readrow['staffpassword']; ?></td>
        <?php } ?>        
         <?php if($pos==="Admin" ){ ?>
        <td>
          <?php if ($readrow['staffid'] != '1' ) {?>
          <a href="staffs.php?edit=<?php echo $readrow['staffid']; ?>" class="btn btn-warning btn-xs; glyphicon glyphicon-edit;" role="button"  style="font-family: arial">Edit</a>
          <?php } ?>
          <?php if($pos==="Admin"){ ?>
            <?php if ($readrow['staffid'] != '1' ) {?>
          <a href="staffs.php?delete=<?php echo $readrow['staffid']; ?>" onclick="return confirm('Are you sure you want to delete account?');" class="btn btn-danger btn-xs; glyphicon glyphicon-trash;" role="button"  style="font-family: arial">Delete</a>
          <?php } ?>
        <?php } ?>
         </td><?php } ?>
      </tr>
      <?php } ?>   
 
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
            $stmt = $conn->prepare("SELECT * FROM staff");
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
            <li><a href="staffs.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"staffs.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"staffs.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="staffs.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
   
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <!--  for modal popup -->
   <script>
    function myFunction() {
          var x = document.getElementById("password");
          if (x.type === "password") {
          x.type = "text";
          } else {
          x.type = "password";
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
    if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<style>
    .bs-example{
      margin: 20px;
    }
</style>
</body>
</html>