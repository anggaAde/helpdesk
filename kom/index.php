<?php include("includes/session.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
html { height: 100% }
::-moz-selection { background: #fe57a1; color: #fff; text-shadow: none; }
::selection { background: #fe57a1; color: #fff; text-shadow: none; }
body { background-image: radial-gradient( cover, rgba(92,100,111,1) 0%,rgba(31,35,40,1) 100%), url('http://i.minus.com/io97fW9I0NqJq.png') }
.login {
  background: #eceeee;
  border: 1px solid #42464b;
  border-radius: 6px;
  height: 257px;
  margin: 20px auto 0;
  width: 298px;
  align: center;
}
.login h1 {
  background-image: linear-gradient(top, #f1f3f3, #d4dae0);
  border-bottom: 1px solid #a6abaf;
  border-radius: 6px 6px 0 0;
  box-sizing: border-box;
  color: #727678;
  display: block;
  height: 43px;
  font: 600 14px/1 'Open Sans', sans-serif;
  padding-top: 14px;
  margin: 0;
  text-align: center;
  text-shadow: 0 -1px 0 rgba(0,0,0,0.2), 0 1px 0 #fff;
}
input[type="password"], input[type="text"] {
  background: url('http://i.minus.com/ibhqW9Buanohx2.png') center left no-repeat, linear-gradient(top, #d6d7d7, #dee0e0);
  border: 1px solid #a1a3a3;
  border-radius: 4px;
  box-shadow: 0 1px #fff;
  box-sizing: border-box;
  color: #696969;
  height: 39px;
  margin: 1px 0 0 29px;
  padding-left: 37px;
  transition: box-shadow 0.3s;
  width: 240px;
}
input[type="password"]:focus, input[type="text"]:focus {
  box-shadow: 0 0 4px 1px rgba(55, 166, 155, 0.3);
  outline: 0;
}
.show-password {
  display: block;
  height: 16px;
  margin: 26px 0 0 28px;
  width: 87px;
}
input[type="checkbox"] {
  cursor: pointer;
  height: 16px;
  opacity: 0;
  position: relative;
  width: 64px;
}
input[type="checkbox"]:checked {
  left: 29px;
  width: 58px;
}
.toggle {
  background: url(http://i.minus.com/ibitS19pe8PVX6.png) no-repeat;
  display: block;
  height: 16px;
  margin-top: -20px;
  width: 87px;
  z-index: -1;
}
input[type="checkbox"]:checked + .toggle { background-position: 0 -16px }
.forgot {
  color: #7f7f7f;
  display: inline-block;
  float: right;
  font: 12px/1 sans-serif;
  left: -19px;
  position: relative;
  text-decoration: none;
  top: 5px;
  transition: color .4s;
}
.forgot:hover { color: #3b3b3b }
input[type="submit"] {
  width:240px;
  height:35px;
  display:block;
  font-family:Arial, "Helvetica", sans-serif;
  font-size:16px;
  font-weight:bold;
  color:#fff;
  text-decoration:none;
  text-transform:uppercase;
  text-align:center;
  text-shadow:1px 1px 0px #37a69b;
  padding-top:6px;
  margin: 29px 0 0 29px;
  position:relative;
  cursor:pointer;
  border: none;  
  background-color: #37a69b;
  background-image: linear-gradient(top,#3db0a6,#3111);
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
  border-bottom-left-radius:5px;
  box-shadow: inset 0px 1px 0px #2ab7ec, 0px 5px 0px 0px #497a78, 0px 10px 5px #999;
}

.shadow {
  background: #000;
  border-radius: 12px 12px 4px 4px;
  box-shadow: 0 0 20px 10px #000;
  height: 12px;
  margin: 30px auto;
  opacity: 0.2;
  width: 270px;
}


input[type="submit"]:active {
  top:3px;
  box-shadow: inset 0px 1px 0px #2ab7ec, 0px 2px 0px 0px #31524d, 0px 5px 3px #999;
}
</style>


<meta charset="utf-8">
	<title>Help Desk UPT Komputer</title>
<?php
$_SESSION['auth'] = md5(uniqid(microtime()));
//check for fhd_config
$filename = 'fhd_config.php';
if (!file_exists($filename)) {
	define('css', 'css/bootstrap.min.css');
    echo "<p></p><strong>Notice:</strong> Software Configuration Needed</p>";
    echo "<p>Please check the <strong>fhd_config.php</strong> file.</p>";
    echo "<p>If this is a new install, you can <strong>rename fhd_config_sample.php to fhd_config.php</strong></p>";
    echo "<p>Open fhd_config.php in a text editor and <strong>configure your settings</strong>.</p>";
    echo "<p>For more information, please check the <a href='readme.htm' target='_blank'>readme file</a>.</p>";
	include("includes/footer.php");
	exit;
}

include("fhd_config.php");
include("includes/header.php");

//check database settings.
include("includes/ez_sql_core.php");
include("includes/ez_sql_mysqli.php");
$db = new ezSQL_mysqli(db_user,db_password,db_name,db_host);
$SCHEMA_NAME = $db->get_var("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '".db_name."';");
if ($SCHEMA_NAME <> db_name) {
    echo "<p></p><strong>Notice:</strong> Software Configuration Needed</p>";
	echo "<p>Database specified in fhd_config.php [ ".db_name." ] does not exist, please check the <a href='readme.htm' target='_blank'>readme file</a>.</p>";
	include("includes/footer.php");
	exit;
}

//check if tables actually exist.
$user_table_exists = $db->get_var("SHOW TABLES LIKE 'site_users';");
if ($user_table_exists <>  "site_users") {
    echo "<p></p><strong>Notice:</strong> Software Configuration Needed</p>";
	echo "<p>One or more database tables are missing from database (named: ".db_name."). Please run <strong>site.sql</strong> against your databsae to create the tables. Please check the <a href='readme.htm' target='_blank'>readme file</a></p>";
	include("includes/footer.php");
	exit;
}

//create upload table if it does not exist.
$upload_exists = $db->get_var("SHOW TABLES LIKE 'site_upload';");
if ($upload_exists <>  "site_upload") {
	$db->query("CREATE TABLE `site_upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `call_id` int(11) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_ext` varchar(4) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `call_id` (`call_id`)
) ;");
}

//create options table if it does not exist.
$options_exists = $db->get_var("SHOW TABLES LIKE 'site_options';");
if ($options_exists <>  "site_options") {
	$db->query("CREATE TABLE `site_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(255) DEFAULT NULL,
  `option_value` varchar(500) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `option_name` (`option_name`)
) ;");
	$db->query("INSERT INTO site_options(option_name) VALUES ('encrypted_passwords');");
	}

if(isset($_SESSION['user_id'])){
	$user_id = $_SESSION['user_id'];
	include("includes/all-nav.php");
	echo "<p>Welcome</p>";
	echo "<p><a href='fhd_dashboard.php'>Help Desk Dashboard</a></p>";
}else{
?>	

<?php
//limit login tries.
if (isset ( $_SESSION['hit'] ) ) {
	if ($_SESSION['hit'] > LOGIN_TRIES){
		echo "<p><i class='fa fa-lock fa-2x pull-left'></i> Access Locked</p>";
		include("includes/footer.php");
		exit;
	}
}
?>
<div align="center">
<h2><?php echo FHD_TITLE;?></h2>
<?php
if ( isset ($_GET['loggedout']) ) {
echo "<div class=\"alert alert-success\" style=\"max-width: 350px; text-align: center;\"><strong>Logged Out</strong><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>";
}
?>
</div>

<form action="fhd_login.php" method="post" class="form-horizontal" role="form">
<!--  -->

<div class="login">
	<legend><div align="center">LOGIN:</div></legend>
    <input type="text" id="inputEmail" name="user_login" placeholder="Username" required> 
  <input type="password" id="inputPassword" name="user_password" placeholder="Password" required>
  <a href="fhd_forgotpassword.php" class="forgot">Lupa Password?</a>

<p><?php if (ALLOW_REGISTER == "yes"){?>
<a href="fhd_register.php" class="forgot">Daftar!&nbsp;&nbsp;&nbsp;</a>
<?php } ?> </p>

  <input type="submit" value="Sign In">
  <?php
if (ALLOW_ANY_ADD == 'yes') {
	echo "<div align='center'><h4><a href='fhd_any_call_add.php' class='btn btn-success'>Laporkan Masalah! <i class='glyphicon glyphicon-new-window'></i></a></h4></div>";
	//echo "<hr>";
	//echo "<p>or Login</p>";
}
?>
</div>
<div class="shadow"></div>

</form>
<?php }?>

<?php include("includes/footer.php");?>
