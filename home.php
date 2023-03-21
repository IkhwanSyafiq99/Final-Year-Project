<?php 
  include_once 'menu_crud.php';
  include_once 'database.php';
  include_once 'session.php';

  if (isset($_POST["submit"])){
    if (!empty($_POST["search"])){
        $query = str_replace(" ","+",$_POST["search"]);
        header("location:home.php?search=".$query);        
    }
  }  
?>
<!DOCTYPE html>
<html>
<head>
    <title>Nasi Kukus: Home</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    </style>
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
</head>
<body>
    <?php include_once 'nav_bar.php'; ?>
    <div class="container-fluid">
    <div class="col-md-12">
        <div class="jumbotron" style="background-color: #F5F5F5">
            <center>
                <h3> <font>Menu</font></h3>
            </center>
                    <form autocomplete="off" class="" action="home.php" method="get">
                    <div class="row pull-centre">
                      <div class="col-sm-10- col-xs-10">
                          <input class="form-control" type="text" name="search" value="<?php if (isset($_GET["search"])) echo $_GET["search"]; ?>" required placeholder="Search by name, type or price">
                      </div>

                    <div class="row pull-centre">
                        <button type="submit" name="submit" class="btn btn-success" value="search" style="background-color: #2E2E2E ; border-color: #2E2E2E">Search</button>                       
                    </div>
                </form>
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
            <br><br>
         <div class="row">
            <?php
            $per_page = 9;
            if (isset($_GET["page"])) {
                $page = $_GET["page"];
            }else{
                $page = 1;
            }
            $start_from = ($page-1)*$per_page;

            try{
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT * FROM menu LIMIT $start_from,$per_page");
                 

                 if (isset($_GET["search"])) {
                    $sql_query = "SELECT * FROM menu WHERE CONCAT(`menuname`, `menuprice`,  `menutype`) LIKE '%".$_GET["search"]."%'";
                    
                    $stmt=$conn->prepare($sql_query);
                 } 
                 $stmt->execute();
                 $result = $stmt->fetchAll();

            }
            catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
            foreach($result as $readrow) {
            ?>

            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail" style="height:340px; position: relative;">
                    <?php if ($readrow['menuphoto'] == "" ) { ?>
                    <img src="photos/noimagerip.jpg" class="img-responsive" width="65%" height="65%">  
                    <?php } else { ?>
                    <img src="photos/<?php echo $readrow['menuphoto'] ?>" class="img-responsive" width="65%" height="65%">
                    <?php } ?>
                    <div class="caption">
                        <h3><center><a style="pointer-events: none;" href="menu_details.php?pid=<?php echo $readrow['menuname']; ?>"?> <?php echo $readrow['menuname'];  ?></a></center></h3>
                        <h4 class="pull-right" style="vertical-align: bottom;"><td>RM<?php echo $readrow['menuprice']; ?></td></h4> 
                    </div>
                    <center>
                        <button name = "details" data-href="menu_detailsnobutton.php?pid=<?php echo $readrow['menuid']; ?>" class="btn btn-primary btn-block" role="button" style="vertical-align: bottom;position: absolute; bottom: 10px; right: 7px; width: 95%; background-color: #FFDE59; border-color: #FFDE59"> <?php echo '<span style="color:#080808; text-align:center"> <b>View Menu</b></span>'; ?> </button>
                    </center>  
                </div>
            </div>
            <?php
                }
                $conn = null;
                ?>
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
            <li><a href="home.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"menu.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"home.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="home.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
    </div>



    </html>