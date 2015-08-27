<?php
include("includes/session.php");
include("includes/checksession.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Users</title>
<?php
include("fhd_config.php");
include("includes/header.php");
include("includes/all-nav.php");
include("includes/ez_sql_core.php");
include("includes/ez_sql_mysqli.php");
include("includes/functions.php");
$db = new ezSQL_mysqli(db_user,db_password,db_name,db_host);

$pending = "";
$title	 = "";

if (isset($_GET['pending'])){
	$pending = "AND user_pending = 1";
}

if (isset($_GET['support_staff'])){
	$pending = "AND user_level = 2";
	$title = "Support Staff";
}

$myquery = "SELECT user_id,user_name,user_email,user_pending,user_level,user_protect_edit,user_msg_send from site_users where 1 $pending order by user_level,user_id desc;";
$site_calls = $db->get_results($myquery);
$num = $db->num_rows;
echo "<p><a href='fhd_settings.php'>Settings</a></p>";
echo "<h4>$num $title Users</h4>";
if ($num > 0){
?>

<table class="<?php echo $table_style_2;?>" style='width: auto;'>
<tr>
	<th>ID</th>
	<th>Open</th>
	<th>Name</th>
	<th>Email</th>
	<th>Level</th>
	<th>Email Ticket Updates</th>
	<th>Pending</th>
	<th>Edit Locked</th>
	<th>Delete User</th>
</tr>
<?php
foreach ( $site_calls as $call )
{
	$user_id = $call->user_id;
	$user_name = $call->user_name;
	$user_email  = $call->user_email;
	$user_pending = $call->user_pending;
	$user_protect_edit = $call->user_protect_edit;
	$user_level = $call->user_level;
	$user_msg_send = $call->user_msg_send;
	$bg = ($user_pending == 1) ? " class='usernote'" : "";
	$call_count = $db->get_var("SELECT count(call_id) from site_calls WHERE (call_user = $user_id) AND (call_status = 0);");
	echo "<tr>\n";
	echo "<td".$bg."><a href='fhd_edit_user.php?url_user_id=$user_id'>$user_id</a></td>\n";
	echo "<td align='center'><a href='fhd_calls.php?user_id=$user_id'>$call_count</a></td>\n";
	echo "<td>$user_name</td>\n";
	echo "<td>$user_email</td>\n";
	echo "<td>".show_user_level($user_level)."</td>\n";
	echo "<td style='text-align: center;'>".onoff($user_msg_send)."</td>\n";
	echo "<td style='text-align: center;'>".onoff($user_pending)."</td>\n";
	echo "<td style='text-align: center;'>".onoff($user_protect_edit)."</td>\n";
	echo "<td style='text-align: center;'><a href='fhd_any_call_add.php' class='btn btn-success'>delete</a></td>\n";
	echo "</tr>\n";
	}
}
?>
</table>

<?php
if(isset($_SESSION['user_name'])){
	echo "<h5>Current User: " . $_SESSION['user_name'] . "</h5>";
}
include("includes/footer.php");