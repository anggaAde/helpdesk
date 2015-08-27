<?php
ob_start();
include("includes/session.php");
include("includes/checksession.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<title>Ticket Details</title>
<?php 
include("fhd_config.php");
include("includes/header.php");
include("includes/all-nav.php");
include("includes/functions.php");
include("includes/ez_sql_core.php");
include("includes/ez_sql_mysqli.php");

$namauser = $_SESSION['user_name'];

$actionstatus = "";
$db = new ezSQL_mysqli(db_user,db_password,db_name,db_host);
//<ADD>
if (isset($_POST['nacl'])){
 if ( $_POST['nacl'] == md5(AUTH_KEY.$db->get_var("select last_login from site_users where user_id = $user_id;")) ) {
	//authentication verified, continue.";
	$call_status = 0;
	$call_date = strtotime(date('n/j/y g:i a'));
	$call_first_name = $db->escape($_POST['call_first_name']);
	$call_email = $db->escape($_POST['call_email']);
	$call_phone = $db->escape($_POST['call_phone']);	
	$call_department = $db->escape((int)$_POST['call_department']);
	$call_request = $db->escape((int)$_POST['call_request']);
	$call_device = $db->escape((int)$_POST['call_device']);
	$call_details = $db->escape($_POST['call_details']);
	$db->query("INSERT INTO site_calls(call_status,call_user,call_date,call_first_name,call_email,call_phone,call_department,call_request,call_device,call_details)VALUES($call_status,$user_id,$call_date,'$call_first_name','$call_email','$call_phone',$call_department,$call_request,$call_device,'$call_details');");
	$insert_id = $db->insert_id;

		//********** manage file upload
	if (isset($insert_id)) {
		if (FHD_UPLOAD_ALLOW == "yes") {
			$file_name = $_FILES['hasupload']['name'];
			if($file_name <> ''){
				$files_var1 = $_FILES["hasupload"]["name"];
				$files_var2 = explode( ".", $files_var1 );
				$extension = end( $files_var2 );
				if(in_array(strtolower($extension), $allowedExts)){
					$db->query("INSERT into site_upload(call_id,file_name,file_ext)VALUES($insert_id,'$file_name','$extension');");
					$upload_id = $db->insert_id;
					$path= "upload/".md5(UPLOAD_KEY.$upload_id).".".$extension;
					(copy($_FILES['hasupload']['tmp_name'], $path));
				}
			}
		}
	}
	//*********************************	

			//<SEND EMAIL>
			$headers = "From:" . FROM_EMAIL . "\r\n";
			$headers .="Reply-To: " .$from . "\r\n";
			$headers .="X-Mailer: PHP/" . phpversion() ."\r\n";
			$headers .="MIME-Version: 1.0" . "\r\n";
			$headers .="Content-type: text/html; charset=iso-8859-1" . "\r\n";
			$subject = "Ticket ". FHD_TITLE ." [# $insert_id]";
			$message = "
		<html>
		<head>
		  <title>Ticket</title>
		</head>
		<body>
		  <p>Ticket Request Received.</p>
		  <p>Ticket Number: $insert_id</p>
		  <p>Name: $call_first_name</p>
		  <p>Ticket Details: $call_details</p>
			";
			//if user has config set, then send them an email
			if ($db->get_var("select user_msg_send from site_users where user_id = $user_id;") == 1){
				mail($call_email, $subject, $message, $headers);
			}
			$mailsent = "&mailsent=yes";
			//notify admin
			mail(TO_EMAIL, "New Ticket [# $insert_id]", $message, $headers);
			//</SEND EMAIL>
		header("Location: fhd_calls.php?added=yes$mailsent");
 }
}
//</ADD>

$nacl = md5(AUTH_KEY.$db->get_var("select last_login from site_users where user_id = $user_id limit 1;"));

//GET USERS INFO
$myquery = "SELECT user_name,user_phone,user_email from site_users WHERE (user_id = $user_id) limit 1;";
$user_info = $db->get_row($myquery);
?>

<h4><i class='fa fa-tag'></i> Laporan Masalah</h4>
<?php echo $actionstatus;?>

<form action="fhd_user_call_add.php" method="post" enctype="multipart/form-data" class="form-horizontal">
<table class="<?php echo $table_style_2;?>" style='width:75%;'>
	<tr><td style="width: 150px;">Date and Time</td>
	<td><?php echo date('n/j/y g:i a');?></td></tr>		
	
	<tr><td>Nama</td>
	<td><input type="text" name="call_first_name" id="call_first_name" value="<?php echo $namauser;?>" required disabled></td></tr>
	
	<tr><td>Email</td>
	<td><input type="text" name="call_email" id="call_email" value="<?php echo $user_info->user_email;?>" required></td></tr>
	
	<tr><td>Telp / PABX</td>
	<td><input type="text" name="call_phone" class="input-medium" value="<?php echo $user_info->user_phone;?>"></td></tr>

	<tr><td>Bagian / UPT</td><td><select name='call_department'>
	<option></option>
	<?php $call_dept = $db->get_results("select type_id,type_name from site_types where type=1 order by type_name;");
foreach ($call_dept as $dept )
{?>
	<option value='<?php echo $dept->type_id;?>'><?php echo $dept->type_name;?></option>
<?php } ?>
	</select></td></tr>

	<tr><td>Request</td><td><select name='call_request'>
	<option></option>
	<?php $request_name = $db->get_results("select type_id,type_name from site_types where type=2 order by type_name;");
foreach ($request_name as $request )
{?>
	<option value='<?php echo $request->type_id;?>'><?php echo $request->type_name;?></option>
<?php } ?>
	</select></td></tr>

	<tr><td>Alat yang rusak</td><td><select name='call_device'>
	<option></option>
	<?php $device_name = $db->get_results("select type_id,type_name from site_types where type=3 order by type_name;");
foreach ($device_name as $device )
{?>
	<option value='<?php echo $device->type_id;?>'><?php echo $device->type_name;?></option>
<?php } ?>
	</select></td></tr>

	<tr><td valign="top">Details</td><td><textarea rows="5" name="call_details" id="call_details" style="width: 100%" required></textarea></td></tr>
</table>

<?php if (FHD_UPLOAD_ALLOW == "yes") {?>
	<p>Upload a file: <input type="file" name="hasupload" id="hasupload" size="50"></p>
<?php } ?>

<input type='hidden' name='nacl' value='<?php echo $nacl;?>'>
<input type="submit" value="Laporkan Masalah!" class="btn btn-primary btn-large btn-success">
</form>
<!-- validation -->
<script type="text/javascript" src="js/livevalidation_standalone.compressed.js"></script>
<style type="text/css">
.LV_valid {
    color: green;
	margin:0 0 0 5px;
}
	
.LV_invalid {
    color:#CC0000;
	margin:0 0 0 5px;
}
</style>
<!-- validation -->
<script type="text/javascript">
var call_first_name = new LiveValidation( 'call_first_name', {wait: 500, validMessage: "Thank you" } );
call_first_name.add( Validate.Presence, { failureMessage: " Required" } );
call_first_name.add( Validate.Length, { minimum: 2 } );

var call_email = new LiveValidation( 'call_email', {wait: 500, validMessage: "Thank you" } );
call_email.add( Validate.Presence, { failureMessage: " Required" } );
call_email.add( Validate.Email );

var call_details = new LiveValidation( 'call_details', {wait: 500, validMessage: "Thank you" } );
call_details.add( Validate.Presence, { failureMessage: " Required" } );
call_details.add( Validate.Length, { minimum: 5 } );
</script>
<br>
<?php
if(isset($_SESSION['user_name'])){
	
	echo "" . $_SESSION['user_name'] . "";
}
include("includes/footer.php");