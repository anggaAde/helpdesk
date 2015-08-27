<?php $page = basename($_SERVER['REQUEST_URI']);
if (isset($_GET["recent"])) {
	$page = "recent";
	}
?>

<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="fhd_dashboard.php" title="dashboard"><?php echo FHD_TITLE;?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      	<ul class="nav navbar-nav">
		<li<?php if($page == 'fhd_calls.php'){echo ' class="active"';};?>><a href="fhd_calls.php">Laporan Masalah</a></li>

		<?php
		switch ($_SESSION['user_level']) {
		    case 0:
		        $addpage = "fhd_call_add.php";
		        break;
		    case 1:
		        $addpage = "fhd_user_call_add.php";
				break;
		    case 2:
		        $addpage = "fhd_call_add.php";
				break;
		}
		$addpage = ($_SESSION['user_level'] == 1) ? "fhd_user_call_add.php" : "fhd_call_add.php"; ?>
		<li<?php if($page == $addpage){echo ' class="active"';};?>><a href="<?php echo $addpage;?>">laporkan Masalah</a></li>

		<li<?php if($page == 'fhd_search.php'){echo ' class="active"';};?>><a href="fhd_search.php" title="Ticket Search">Cari!</a></li>
		<li<?php if($page == 'fhd_myaccount.php'){echo ' class="active"';};?>><a href="fhd_myaccount.php">My Account</a></li>
		<li><a href="includes/session.php?logout=y" title="Logout"><i class="fa fa-sign-out fa-lg"></i></a></li>

		<?php
		//ADMIN ONLY DROP DOWN NAV
		if(isset($_SESSION['admin'])){ ?>
		<li<?php if($page == 'recent'){echo ' class="active"';};?>><a href="fhd_search.php?call_status=&search=1&recent=1&call_date1=&call_date2=&call_email=&call_first_name=&call_phone=&call_department=&call_request=&call_device=&call_staff=&call_details=&call_solution=" title="All Recent Tickets">Recent</a></li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <b class="caret"></b></a>
          <ul class="dropdown-menu">
			<li<?php if($page == 'fhd_settings.php'){echo ' class="active"';};?>><a href="fhd_settings.php" title="Help Desk Settings">Settings</a></li>
			<li<?php if($page == 'fhd_admin_register.php'){echo ' class="active"';};?>><a href="fhd_admin_register.php">Add User</a></li>
			<li<?php if($page == 'fhd_users.php'){echo ' class="active"';};?>><a href="fhd_users.php">Edit User</a></li>
          </ul>
        </li>
		<?php } ?>

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>