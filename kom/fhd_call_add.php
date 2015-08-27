<?php
include("includes/session.php");
include("includes/checksession.php");
include("includes/checksession_ss.php");
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
$db = new ezSQL_mysqli(db_user,db_password,db_name,db_host);
$actionstatus = "";
//<ADD>
if (isset($_POST['nacl'])){
 if ( $_POST['nacl'] == md5(AUTH_KEY.$db->get_var("select last_login from site_users where user_id = $user_id;")) ) {
	//authentication verified, continue.
	$call_status = $db->escape($_POST['call_status']);
	$call_date = $db->escape(strtotime($_POST['call_date']));
	$call_first_name = $db->escape($_POST['call_first_name']);
	$call_email = $db->escape($_POST['call_email']);
	$call_phone = $db->escape($_POST['call_phone']);	
	$call_department = $db->escape($_POST['call_department']);
	$call_request = $db->escape($_POST['call_request']);
	$call_device = $db->escape($_POST['call_device']);
	$call_details = $db->escape($_POST['call_details']);
	$call_solution = $db->escape($_POST['call_solution']);
	$call_staff = $db->escape($_POST['call_staff']);
	$db->query("INSERT INTO site_calls(call_status,call_date,call_first_name,call_email,call_phone,call_department,call_request,call_device,call_details,call_solution,call_staff)VALUES($call_status,$call_date,'$call_first_name','$call_email','$call_phone',$call_department,$call_request,$call_device,'$call_details','$call_solution',$call_staff);");

	//********** manage file upload
	if (FHD_UPLOAD_ALLOW == "yes") {
		$insert_id = $db->insert_id;
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
	//*********************************

    $actionstatus = "<div class=\"alert alert-success\" style=\"max-width: 250px;\">
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    Ticket Created.
    </div>";
 }
}
//</ADD>

$nacl = md5(AUTH_KEY.$db->get_var("select last_login from site_users where user_id = $user_id;"));
$adjdate=date('Y-m-d');
?>

<h4><i class='fa fa-tag'></i> Add Ticket</h4>
<?php echo $actionstatus;?>
<form action="fhd_call_add.php" method="post" enctype="multipart/form-data" class="form-horizontal" data-parsley-validate>
<table class="<?php echo $table_style_3;?>" style='width:75%;'>
	<tr>
	<td valign="top" style="width: 150px;">Status</td>
	<td><select name='call_status' class="input-medium">
	<option value='0' selected>active</option>
	<option value='1'>closed</option>
	</select>
	</td>
	</tr>

	<tr>
	<td>Date</td>
	<td><!-- mktime(hour, minute, second, month, day, year) -->
	<input type="text" name="call_date" value="<?php echo $adjdate;?>" id="datepicker" class="input-small"></td>
	</tr>		
	
	<tr>
	<td>Name</td>
	<td><input type="text" name="call_first_name" class="input-xlarge" required></td>
	</tr>
	
	<tr>
	<td>Email</td>
	<td><input type="email" name="call_email" class="input-xlarge" required></td>
	</tr>
	
	<tr>
	<td>Phone</td>
	<td><input type="text" name="call_phone" class="input-medium"></td>
	</tr>

	<tr><td>Departtment</td><td><select name='call_department'>
	<?php $call_dept = $db->get_results("select type_id,type_name from site_types where type=1 order by type_name;");
foreach ($call_dept as $dept )
{?>
	<option value='<?php echo $dept->type_id;?>'><?php echo $dept->type_name;?></option>
<?php } ?>
	</select></td></tr>

	<tr><td>Request</td><td><select name='call_request'>
	<?php $request_name = $db->get_results("select type_id,type_name from site_types where type=2 order by type_name;");
foreach ($request_name as $request )
{?>
	<option value='<?php echo $request->type_id;?>'><?php echo $request->type_name;?></option>
<?php } ?>
	</select></td></tr>

	<tr><td>Device</td><td><select name='call_device'>
	<?php $device_name = $db->get_results("select type_id,type_name from site_types where type=3 order by type_name;");
foreach ($device_name as $device )
{?>
	<option value='<?php echo $device->type_id;?>'><?php echo $device->type_name;?></option>
<?php } ?>
	</select></td></tr>

	<tr>
		<td valign="top">Details</td>
		<td><textarea rows="3" name="call_details" style="width: 100%"></textarea></td>
	</tr>
	
	<tr>
		<td valign="top">Solution</td>
		<td><textarea rows="3" name="call_solution" style="width: 100%"></textarea></td>
	</tr>

	<tr><td>Staff</td><td><select name='call_staff'>
	<?php $staff_name = $db->get_results("select user_id,user_name from site_users where user_level<>1 order by user_name;");
foreach ($staff_name as $staff )
{?>
	<option value='<?php echo $staff->user_id;?>' <?php if($staff->user_id == $user_id){echo ' selected';}?>><?php echo $staff->user_name;?></option>
<?php } ?>
	</select></td></tr>
</table>

<?php if (FHD_UPLOAD_ALLOW == "yes") {?>
	<p>Upload a file: <input type="file" name="hasupload" id="hasupload" size="50"></p>
<?php } ?>

<input type='hidden' name='nacl' value='<?php echo $nacl;?>'>
<input type="submit" value="add" class="btn btn-large btn-primary">
</form>
<?php
if(isset($_SESSION['user_name'])){
	
	echo "" . $_SESSION['user_name'] . "";
}
include("includes/footer.php");