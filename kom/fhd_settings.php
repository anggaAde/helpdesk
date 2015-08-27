<?php
include("includes/session.php");
include("includes/checksession.php");
include("includes/checksessionadmin.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<title>Help Desk Settings</title>
<?php
include("fhd_config.php");
include("includes/header.php");
include("includes/all-nav.php");
include("includes/functions.php");
include("includes/ez_sql_core.php");
include("includes/ez_sql_mysqli.php");
$db = new ezSQL_mysqli(db_user,db_password,db_name,db_host);
$encrypted_passwords = $db->get_var("SELECT option_value from site_options where option_name = 'encrypted_passwords';");
$encrypted_link = "";
if ($encrypted_passwords <> 'yes') {
	$encrypted_link = " <small><a href='fhd_admin_e.php'>Encrypt Passwords</a></small>";
	}
$date = date_create();
$fhddate = date_format($date, 'U')
?>

<h4>Help Desk Settings</h4>

<a href="fhd_settings_action.php?type=1" class="btn btn-default btn-sm"><i class="fa fa-cog"></i> Departments</a> 
<a href="fhd_settings_action.php?type=2" class="btn btn-default btn-sm"><i class="fa fa-cog"></i> Request Types</a> 
<a href="fhd_settings_action.php?type=3" class="btn btn-default btn-sm"><i class="fa fa-cog"></i> Device Type</a> 
<a href="fhd_users.php?support_staff=show" class="btn btn-default btn-sm"><i class="fa fa-cog"></i> Support Staff</a>

<hr>
<h4>Config Settings <small>from: fhd_config.php</small></h4>

<table class="<?php echo $table_style_1;?>" style='width: auto;'>
<tr>
	<td>Login tries before session lockout</td>
	<td><span class="label label-info"><?php echo LOGIN_TRIES;?></span></td>
</tr> 

<?php if (FHD_UPLOAD_ALLOW == "yes") { 

$upload_path = 'upload/test.txt';
$write = "";
if ( !is_writable( dirname ( $upload_path ) ) ) {
    $write = " <span class='label label-danger'>[".dirname($upload_path).'] directory is not writable</span>';
}
?>

<tr>
	<td>Allow uploads</td>
	<td><?php echo yesno(FHD_UPLOAD_ALLOW) . $write;?></td>
</tr> 
<tr>
	<td>Upload file extensions allowed</td>
	<td>
	<?php foreach ($allowedExts as $v) {
    	echo " <span class='label label-success'>$v</span>";
	}
	?>
	</td>
</tr> 
<?php } ?>

<tr>
	<td>Allow registration</td>
	<td><?php echo yesno(ALLOW_REGISTER);?></td>
</tr> 
<tr>
	<td>Registration captcha</td>
	<td><?php echo yesno(CAPTCHA_REGISTER);?></td>
</tr> 
<tr>
	<td>Reset Password captcha</td>
	<td><?php echo yesno(CAPTCHA_RESET_PASSWORD);?></td>
</tr> 
<tr>
	<td>Allow unregistered users to open tickets</td>
	<td><?php echo yesno(ALLOW_ANY_ADD);?></td>
</tr> 
<tr>
	<td>Time adjust</td>
	<td><span class="label label-info"><?php echo FHD_TIMEADJUST;?></span>
	<?php echo date('Y-m-d g:i a');?> <i class="fa fa-arrow-circle-right"></i> <?php echo date('Y-m-d g:i a',($fhddate + (FHD_TIMEADJUST * 3600)));?>
	</td>
</tr> 
<tr>
	<td>Encrypted passwords</td>
	<td><?php echo yesno($encrypted_passwords);?> <?php echo $encrypted_link;?></td>
</tr> 
<tr>
	<td>Notification email</td>
	<td><?php echo TO_EMAIL;?></td>
</tr> 
<tr>
	<td>From email</td>
	<td><?php echo FROM_EMAIL;?></td>
</tr> 
<tr>
	<td>Database name</td>
	<td><?php echo db_name;?></td>
</tr> 

<tr>
	<td>CSS theme <a href="http://bootswatch.com/" target="_blank" class="btn btn-default btn-xs">view demo's</a></td>
	<td><?php echo css;?></td>
</tr> 

</table>

<?php
include("includes/footer.php");	
