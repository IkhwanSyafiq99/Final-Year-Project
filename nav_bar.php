<nav class="navbar navbar-default" style="background-color: #262626">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="home.php" class="navbar-brand" style="color: #FFFFFF">Nasi Kukus Staff</a>
    </div>
   

 
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav" >      
    </ul>
      <ul class="nav navbar-nav navbar-right">
         <li><a href="#" disabled="disabled" style="color: #FFFFFF"><span class="glyphicon glyphicon-user" aria-hidden="true" style="color: #FFDE59"></span>  <?php echo $name; ?> (<?php echo $pos; ?>)</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: #FFFFFF"><span class="caret; glyphicon glyphicon-menu-hamburger"></span></a>
          <ul class="dropdown-menu" style="background-color: #262626">

            <li><a href="home.php" style="color:white"><span class="glyphicon glyphicon-home" aria-hidden="true" style="color:white"></span> Home</font></a></li> 
            <li><a href="menu.php"style="color:white"><span class="glyphicon glyphicon-cutlery" aria-hidden="true" style="color:white"></span> Menu</font></a></li>                       
            <li><a href="staffs.php" style="color:white"><span class="glyphicon glyphicon-briefcase" aria-hidden="true" style="color:white"></span> Staff</a></font></li>
            <li><a href="order.php" style="color:white"><span class="glyphicon glyphicon-edit" aria-hidden="true" style="color:white"></span> Orders</a></font></li>
            <li><a href="orderhistory.php" style="color:white"><span class="glyphicon glyphicon-list-alt" aria-hidden="true" style="color:white"></span> Order History</a></font></li>            
            <?php if($pos==="Admin"){ ?>
            <li><a href="change_password.php" style="color:white"><span class="glyphicon glyphicon-pencil" aria-hidden="true" style="color:white"></span> Change Password </a></li>
            <?php } ?>
            <li><a href="logout.php" style="color:white"><span class="glyphicon glyphicon-log-out" aria-hidden="true" style="color:white"></span> Logout </a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>