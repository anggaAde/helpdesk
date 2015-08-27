<?php
include("includes/session.php");
include("includes/checksession.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<title>My Account</title>
<?php 
include("fhd_config.php");
include("includes/header.php");
include("includes/all-nav.php");
include("includes/functions.php");
$user_id = checkid($user_id);
include("includes/ez_sql_core.php");
include("includes/ez_sql_mysqli.php");
$actionstatus = "";
$db = new ezSQL_mysqli(db_user,db_password,db_name,db_host);

//check that user exists before continuing.
//$isuser = $db->get_var("SELECT count(*) from site_users WHERE (user_id = $user_id);");
//if ($isuser == 0) {
//	echo "<p>Error</p>";
//	echo exit;
//}

//check if user is locked out from changes
$user_protect_edit = $db->get_var("select user_protect_edit from site_users where user_id = $user_id;");
if ($user_protect_edit == 1){
	echo "<br /><div class=\"alert alert-success\" style=\"max-width: 220px;\"><i class='fa fa-lock'></i> Account Changes Locked</div>";
	include("includes/footer.php");
	exit;
}

//<UPDATE>
if (isset($_POST['update'])){
 if ( $_POST['nacl'] == md5(AUTH_KEY.$db->get_var("select last_login from site_users where user_id = $user_id;")) ) {
	//authentication verified, continue.
	$user_email = $db->escape($_POST['user_email']);
		//check email exists
		$num = $db->get_var("select count(user_email) from site_users where (user_email = '$user_email') and (user_id <> $user_id);");
		if ($num > 0) {
		echo "<p><a href='fhd_myaccount.php'>Error: that email address is already in  use.</a></p>";
		include("includes/footer.php");
		exit;
		}

	$user_name = $db->escape($_POST['user_name']);
	$user_password_set = "";

	if( strlen($_POST['user_password'] ) > 4){
		$user_password = makepwd( trim( $db->escape( $_POST['user_password'] ) ) );
		$user_password_set = "user_password='$user_password',";
	}

	$user_date = date(time());
	$user_phone = $db->escape($_POST['user_phone']);
	$user_address = $db->escape($_POST['user_address']);
	$user_city = $db->escape($_POST['user_city']);
	$user_state = $db->escape($_POST['user_state']);
	$user_zip = $db->escape($_POST['user_zip']);
	$user_country = $db->escape($_POST['user_country']);
	$user_msg_send = 0;

	if (isset ($_POST['user_msg_send']) ) {
		$user_msg_send_value = $db->escape($_POST['user_msg_send']);
		if($user_msg_send_value == 1){$user_msg_send = 1;};
	}

	$db->query("UPDATE site_users SET $user_password_set user_email='$user_email',user_name='$user_name',user_phone='$user_phone',user_address='$user_address',user_city='$user_city',user_state='$user_state',user_zip='$user_zip',user_country='$user_country',user_msg_send=$user_msg_send where user_id = $user_id;");
        $actionstatus = "<div class=\"alert alert-success\" style=\"max-width: 110px;\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>Updated.</div>";
 }
}
//</UPDATE>

$nacl = md5(AUTH_KEY.$db->get_var("select last_login from site_users where user_id = $user_id;"));
$site_users = $db->get_row("SELECT user_login,user_password,user_name,user_address,user_city,user_state,user_zip,user_country,user_phone,user_email,user_msg_send,user_level FROM site_users WHERE (user_id = $user_id) limit 1;");
$user_msg_send = $site_users->user_msg_send;
?>

<?php echo $actionstatus;?>
<h4><i class="fa fa-user"></i> My Account <small>(<?php echo $user_id;?>)</small></h4>

<form action="fhd_myaccount.php" method="post" class="form-horizontal" role="form">
<div class="form-group">
	<label for="user_login" class="col-sm-2 control-label">User Login</label>
    <div class="col-sm-2">
	<input type="text" class="form-control" name="user_login" id="user_login" value="<?php echo $site_users->user_login;?>" readonly>
    </div>
</div>

<div class="form-group">
	<label for="user_password" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-3">
	<input type="text" class="form-control" name="user_password" id="user_password" value="" placeholder="Minimum 5 Characters">
    </div>
</div>
<div class="form-group">
	<label for="user_name" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-3">
	<input type="text" class="form-control" name="user_name" id="user_name" value="<?php echo $site_users->user_name;?>">
    </div>
</div>
<div class="form-group">
	<label for="user_email" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-3">
	<input type="email" class="form-control" name="user_email" id="user_email" value="<?php echo $site_users->user_email;?>">
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-2 col-sm-6">
	<div class="checkbox">
    <label>
      <input type="checkbox" name="user_msg_send" value="1" <?php if($user_msg_send == 1){echo " CHECKED";}?>> Receive ticket status emails?
    </label>
	</div>
	</div>
</div>

<div class="form-group">
	<label for="user_phone" class="col-sm-2 control-label">Phone</label>
    <div class="col-sm-2">
	<input type="text" class="form-control" name="user_phone" id="user_phone" value="<?php echo $site_users->user_phone;?>">
	</div>
</div>

<div class="form-group">
	<label for="user_address" class="col-sm-2 control-label">Address</label>
    <div class="col-sm-3">
	<input type="text" class="form-control" name="user_address" id="user_address" value="<?php echo $site_users->user_address;?>">
	</div>
</div>

<div class="form-group">
	<label for="user_city" class="col-sm-2 control-label">City</label>
    <div class="col-sm-2">
	<input type="text" class="form-control" name="user_city" id="user_city" value="<?php echo $site_users->user_city;?>">
	</div>
</div>

<div class="form-group">
	<label for="user_state" class="col-sm-2 control-label">State</label>
    <div class="col-sm-2">
	<input type="text" class="form-control" name="user_state" id="user_state" value="<?php echo $site_users->user_state;?>">
	</div>
</div>

<div class="form-group">
	<label for="user_zip" class="col-sm-2 control-label">Zip</label>
    <div class="col-sm-1">
	<input type="text" class="form-control" name="user_zip" id="user_zip" value="<?php echo $site_users->user_zip;?>">
	</div>
</div>

<div class="form-group">
	<label for="user_country" class="col-sm-2 control-label">Country</label>
    <div class="col-sm-2">
	<input type="text" class="form-control" name="user_country" id="user_country" value="<?php echo $site_users->user_country;?>">
	</div>
</div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" value="update" class="btn btn-primary btn-lg">
    </div>
  </div>
<input type='hidden' name='nacl' value='<?php echo $nacl;?>'>
<input type='hidden' name='update' value='1'>
</form>
<br>
<?php include("includes/footer.php");