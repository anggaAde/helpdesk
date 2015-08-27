<?php
include("includes/session.php");
include("includes/checksession.php");
include("includes/checksessionadmin.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<title>Administration Dashboard</title>
<?php
include("fhd_config.php");
include("includes/PasswordHash.php");
include("includes/header.php");
include("includes/all-nav.php");
include("includes/ez_sql_core.php");
include("includes/ez_sql_mysqli.php");
include("includes/functions.php");
$db = new ezSQL_mysqli(db_user,db_password,db_name,db_host);
echo '<h4>One-Time Password Encryption</h4>';
$encrypted_passwords = $db->get_var("SELECT option_value FROM site_options where option_name = 'encrypted_passwords';");
if ($encrypted_passwords == "yes") {
	echo "<p class='text-danger'><strong>This function has already been run!</strong></p>";
	include("includes/footer.php");
	exit;
}
?>

<h4><strong>Please <u>backup database</u> before starting.</strong></h4>

<p><a href="fhd_admin_e.php?start=1" class="btn btn-success" onclick="return confirm('Please be sure you have a good database backup!')">Start</a> <a href="fhd_settings.php" class="btn btn-danger">Cancel</a></p>

<?php
if ( isset($_GET['start']) ) {
	$db->query("ALTER TABLE `site_users` CHANGE `user_password` `user_password` VARCHAR( 225 );");
	$myquery = "SELECT user_id,user_login,user_password from site_users;";
	$e = $db->get_results($myquery);
	foreach ( $e as $ep ){
		$user_id = $ep->user_id;
		$user_login = $ep->user_login;
		$user_password = $ep->user_password;
		$hasher = new PasswordHash(8, false);
		$hash = $hasher->HashPassword($user_password);
		echo $user_login." -> <i class='fa fa-lock'></i><br />";
		$db->query("UPDATE `site_users` SET user_password = '$hash' WHERE user_id = $user_id limit 1;");
		}
		echo "<h4>Update Complete!</h4>";
	//mark passwords as updated.	
	$db->query("UPDATE `site_options` SET option_value = 'yes' WHERE option_name = 'encrypted_passwords';");
}
include("includes/footer.php");
