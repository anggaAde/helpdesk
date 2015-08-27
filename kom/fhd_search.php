<?php
include("includes/session.php");
include("includes/checksession.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<title>Ticket Search</title>
<?php 
include("fhd_config.php");
include("includes/header.php");
include("includes/all-nav.php");
include("includes/functions.php");
include("includes/ez_sql_core.php");
include("includes/ez_sql_mysqli.php");
$searchquery = "";
$colspan = 2;
$num = "";
if($user_level == 1){
	$searchquery = " AND call_user = $user_id";
	$colspan = 1;
}

$db = new ezSQL_mysqli(db_user,db_password,db_name,db_host);
//<SEARCHQUERY>
if (isset($_GET['search'])){
	$call_status = $db->escape((int)($_GET['call_status']));
	$call_date1 = strtotime($_GET['call_date1']);
	$call_date2 = strtotime($_GET['call_date2']);

	if ($call_date2 == "") {
		$call_date2 = $call_date1;
	}

	$call_first_name = $db->escape($_GET['call_first_name']);
	$call_email = $db->escape($_GET['call_email']);
	$call_phone = $db->escape($_GET['call_phone']);	
	$call_department = $db->escape((int)($_GET['call_department']));
	$call_request = $db->escape((int)($_GET['call_request']));
	$call_device = $db->escape((int)($_GET['call_device']));
	$call_staff = $db->escape((int)($_GET['call_staff']));
	$call_details = $db->escape($_GET['call_details']);
	$call_solution = $db->escape($_GET['call_solution']);
	if ($_GET['call_status'] <> '') {$searchquery .= " AND (call_status = $call_status)";};
	if (!empty($call_date1)) {$searchquery .= " AND (call_date BETWEEN $call_date1 AND $call_date2)";};
	if (!empty($call_first_name)) {$searchquery .= " AND (call_first_name LIKE '%$call_first_name%')";};
	if (!empty($call_email)) {$searchquery .= " AND (call_email LIKE '%$call_email%')";};
	if (!empty($call_phone)) {$searchquery .= " AND (call_phone LIKE '%$call_phone%')";};
	if (!empty($call_department)) {$searchquery .= " AND (call_department = $call_department)";};
	if (!empty($call_request)) {$searchquery .= " AND (call_request = $call_request)";};
	if (!empty($call_device)) {$searchquery .= " AND (call_device = $call_device)";};
	if (!empty($call_staff)) {$searchquery .= " AND (call_staff = $call_staff)";};
	if (!empty($call_details)) {$searchquery .= " AND (call_details LIKE '%$call_details%')";};
	if (!empty($call_solution)) {$searchquery .= " AND (call_solution LIKE '%$call_solution%')";};
	$searchquery .= (" order by call_date desc LIMIT 50;");
	$site_calls = $db->get_results("Select * from site_calls WHERE 1=1 $searchquery");
	//$db->debug();
	$num = $db->num_rows;
}
//</SEARCHQUERY>
if ($num > 0){
//<RESULTS>
echo "<h4><small>[ ".$num." ] found</small></h4>";
?>
<table class="<?php echo $table_style_3;?>" style='width: auto;'>
<tr>
	<th colspan="<?php echo $colspan;?>" style='text-align: center;'>Action</th>
	<th>Status</th>
	<th>Date</td>
	<th>Name</th>
	<th>Type</th>
	<th>Dept</th>
	<th>Device</th>
</tr>
<?php
foreach ( $site_calls as $call )
{
	$call_status = $call->call_status;
	$call_id = $call->call_id;
	//$call_date = date("Y-m-d",$call->call_date);
	$call_date = date("m/d/y",$call->call_date);
	$call_first_name  = $call->call_first_name;
	$call_last_name  = $call->call_last_name;
	$call_request = $call->call_request;
	$call_department = $call->call_department;
	$call_device = $call->call_device;
	$request_name = $db->get_var("SELECT type_name from site_types WHERE (type_id = $call_request);");
	$department_name = $db->get_var("SELECT type_name from site_types WHERE (type_id = $call_department);");
	$device_name = $db->get_var("SELECT type_name from site_types WHERE (type_id = $call_device);");
	
	//show closed or deleted as muted.
	$display = "";
	if ($call_status <> 0){
		$display = " class='text-muted'";
	}

	echo "<tr$display>\n<td style='text-align: center;'><a href='fhd_call_details.php?call_id=$call_id'><i class='fa fa-eye' title='view'></i></a></td>\n";

if($user_level <> 1){
	echo "<td style='text-align: center;'><a href='fhd_call_edit.php?call_id=$call_id'><i class='fa fa-pencil-square-o' title='edit'></i></a></td>\n";
	}

	echo "<td>".call_status($call_status)."</td></td><td>$call_date</td>\n<td>$call_first_name $call_last_name</td>\n<td>$request_name</td>\n<td>$department_name</td>\n<td>$device_name</td>\n</tr>\n";
}
?>
</table>
<?php } 
//</RESULTS>
?>

<h4 id="searchform"><i class='fa fa-search'></i> Ticket Search</h4>

<form action="fhd_search.php" method="get" name="chooseDateForm" class="form-horizontal">
<table class="<?php echo $table_style_3;?>" style='width: auto;'>
	<tr><td style="vertical-align: top">Status</td>
	<td><select name='call_status' class="input-small">
	<option value="">Choose</option>
	<option value='0' selected>active</option>
	<option value='1'>closed</option>
	<option value='3'>deleted</option>
	</select>
	</td></tr>
	<tr>
	<td>From Date</td>
	<td><input type="text" name="call_date1" id="datepicker" class="input-small"></td>
	</tr>		
	
	<tr>
	<td>To Date</td>
	<td><input type="text" name="call_date2" id="datepicker2" class="input-small"></td></tr>		
	
	<tr><td>Name</td>
	<td><input type="text" name="call_first_name" class="input-xlarge"></td></tr>
	
	<tr><td>Email</td>
	<td><input type="text" name="call_email" class="input-xlarge"></td></tr>
	
	<tr><td>Phone</td>
	<td><input type="text" name="call_phone" class="input-medium"></td></tr>

	<tr><td>Dept</td><td><select name='call_department'>
	<option value="">Choose</option>
	<?php $call_dept = $db->get_results("select type_id,type_name from site_types where type=1 order by type_name;");
foreach ($call_dept as $dept )
{?>
	<option value='<?php echo $dept->type_id;?>'><?php echo $dept->type_name;?></option>
<?php } ?>
	</select></td></tr>

	<tr><td>Request</td><td><select name='call_request'>
	<option value="">Choose</option>
	<?php $request_name = $db->get_results("select type_id,type_name from site_types where type=2 order by type_name;");
foreach ($request_name as $request )
{?>
	<option value='<?php echo $request->type_id;?>'><?php echo $request->type_name;?></option>
<?php } ?>
	</select></td></tr>

	<tr><td>Device</td><td><select name='call_device'>
	<option value="">Choose</option>	
	<?php $device_name = $db->get_results("select type_id,type_name from site_types where type=3 order by type_name;");
foreach ($device_name as $device )
{?>
	<option value='<?php echo $device->type_id;?>'><?php echo $device->type_name;?></option>
<?php } ?>
	</select></td></tr>

	<tr><td style="vertical-align: top">Details</td><td><input type="text" name="call_details" size="45"></td></tr>
	<tr><td style="vertical-align: top">Solution</td><td><input type="text" name="call_solution" size="45"></td></tr>

	<tr><td>Staff</td><td><select name='call_staff'>
	<option value="">Choose</option>
	<?php $staff_name = $db->get_results("select user_id,user_name from site_users where user_level<>1 order by user_name;");
foreach ($staff_name as $staff )
{?>
	<option value='<?php echo $staff->user_id;?>'><?php echo $staff->user_name;?></option>
<?php } ?>
	</select></td></tr>
</table>
<input type="hidden" name="search" value="1">
<input type="submit" value="search" class="btn btn-primary">
</form>
<br>
<?php
if(isset($_SESSION['user_name'])){
	
	echo "" . $_SESSION['user_name'] . "";
}
include("includes/footer.php");