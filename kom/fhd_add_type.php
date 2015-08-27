<?php
ob_start();
include("includes/session.php");
include("includes/checksession.php");
include("includes/checksessionadmin.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add</title>
<?php
include("fhd_config.php");
include("includes/header.php");
include("includes/all-nav.php");
include("includes/ez_sql_core.php");
include("includes/ez_sql_mysqli.php");
include("includes/functions.php");
$db = new ezSQL_mysqli(db_user,db_password,db_name,db_host);

// <ADD>
if (isset($_POST['nacl'])){
 if ( $_POST['nacl'] == md5(AUTH_KEY.$db->get_var("select user_password from site_users where user_id = $user_id;")) ) {
	//authentication verified, continue.
	$type = checkid($_POST['type']);
	$type_name = $db->escape($_POST['type_name']);
	$type_email = $db->escape($_POST['type_email']);
	$type_location = $db->escape($_POST['type_location']);
	$type_phone = $db->escape($_POST['type_phone']);
	$db->query("INSERT INTO site_types(type,type_name,type_email,type_location,type_phone) VALUES( $type,'$type_name','$type_email','$type_location','$type_phone');");
	header("Location: fhd_settings_action.php?type=$type");
 }else{
	//not verified, warning and exit!
	echo "<p class='save'>Warning: Verification Error!</p>";
 	exit;
}
}
// </ADD>

//check type variable
$type = checkid($_GET['type']);
$nacl = md5(AUTH_KEY.$db->get_var("select user_password from site_users where user_id = $user_id;"));
?>

<h4>Add: <?php show_type_name($type);?></h4>

<table class="<?php echo $table_style_3;?>" style='width: auto;'>
<form action="fhd_add_type.php" method="post" class="form-horizontal">
<input type='hidden' name='nacl' value='<?php echo $nacl;?>'>
<input type='hidden' name='type' value='<?php echo $type;?>'>
<?php
if ($type <> 0) { ?>
	<tr><td>Name: </td><td><input type='text' name='type_name'></td></tr>
	<tr><td colspan='2'><input type='submit' value='add' class='btn btn-primary'></td></tr>
	</table>
<?php  }
if ($type == 0) { ?>
	<tr><td>Name</td><td><input type='text' name='type_name'></td></tr>
	<tr><td>Email</td><td><input type='text' name='type_email'></td></tr>
	<tr><td>Location</td><td><input type='text' name='type_location'></td></tr>
	<tr><td>Phone</td><td><input type='text' name='type_phone'></td></tr>
	<tr><td colspan='2'><input type='submit' value='add' class='btn btn-primary'></td></tr>
	</table>
<?php }?>
</form>
</table>
<h5><i class="fa fa-arrow-left"></i> <a href="fhd_settings_action.php?type=<?php echo $type;?>">Back to <?php echo show_type_name($type);?></a></h5>

<?php
if(isset($_SESSION['name'])){
	
	echo "<br /><p><strong>Login Name:</strong> " . $_SESSION['name'] . "</p>";
}
include("includes/footer.php");