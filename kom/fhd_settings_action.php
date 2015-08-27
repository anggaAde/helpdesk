<?php
ob_start();
include("includes/session.php");
include("includes/checksession.php");
include("includes/checksessionadmin.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Settings</title>
<?php
include("fhd_config.php");
include("includes/header.php");
include("includes/all-nav.php");
include("includes/ez_sql_core.php");
include("includes/ez_sql_mysqli.php");
include("includes/functions.php");
$db = new ezSQL_mysqli(db_user,db_password,db_name,db_host);

//<DELETE>
if (isset($_GET['nacl'])){
 if ( $_GET['nacl'] == md5(AUTH_KEY.$db->get_var("select last_login from site_users where user_id = $user_id;")) ) {
	//authentication verified, continue.
	$type_id = checkid($_GET['type_id']);
	$action = $db->escape( $_GET['action'] );
	$type = checkid($_GET['type']);
	if ($action == 'delete'){
		$db->query("DELETE FROM site_types where type_id = $type_id;");
		header("Location: fhd_settings_action.php?type=$type");
		}
 }
}
//</DELETE>

//check type variable
$type = checkid( $_GET['type'] );
?>
<p><a href="fhd_settings.php">Settings</a></p>

<h4><?php show_type_name($type);?></h4>
<h5><i class="fa fa-plus"></i> <a href="fhd_add_type.php?type=<?php echo $type;?>">Add New</a></h5>
<?php
$num = $db->get_var("select count(type_name) from site_types where type = $type;");

if ($num == 0) {
	echo "<p>Invalid Type (error 2)</p>";
	include("includes/footer.php");
	exit;
}
?>

<?php if ($num > 0) { ?>
<table class="<?php echo $table_style_2;?>" style='width: auto;'>
<tr>
	<th>Name</th>
<?php if ($type == 0) { ?>
	<th>Email</th>
	<th>Location</th>
	<th>Phone</th>
<?php } ?>
	<th>Edit</th>
	<th>Delete</th>
	<?php if ($type <> 0) { ?>
	<th>Calls</th>
	<?php } ?>
</tr>
<?php
$nacl = md5(AUTH_KEY.$db->get_var("select last_login from site_users where user_id = $user_id;"));
$site_types = $db->get_results("SELECT type_id,type,type_name,type_email,type_location,type_phone from site_types where type = $type order by type_name;");
foreach ( $site_types as $site_type )
{
$type_id = $site_type->type_id;
$type = $site_type->type;
$type_name = $site_type->type_name;
$type_email = $site_type->type_email;
$type_location = $site_type->type_location;
$type_phone = $site_type->type_phone;
$col_name = show_type_col($type);
$count = $db->get_var("select count(call_id) from site_calls where $col_name = $type_id;");
if ($count == 0){
	//if there are no calls, then the category can be removed.
	$deletelink = "<a href='fhd_settings_action.php?type_id=$type_id&type=$type&action=delete&nacl=$nacl' onclick=\"return confirm('Are you sure you want to delete?')\"><i class='glyphicon glyphicon-remove-circle' title='delete'></i></a>";
}else{
	$deletelink = "&nbsp;";
}

echo "<tr><td>$type_name</td>";
	if ($type == 0) {
		echo "<td>$type_email</td><td>$type_location</td><td>$type_phone</td>\n";
	}
echo "<td align='center'><a href='fhd_mod_types.php?id=$type_id&action=edit'><i class='glyphicon glyphicon-edit' title='edit'></i></a></td>\n";
echo "<td align='center'>$deletelink</td>\n";
		//don't show for staff
		if ($type <> 0) {
echo "<td>$count</td>\n";
		}
echo "</tr>\n";
$count = NULL;
}
?>
</table>
<?php } ?>

<?php
if(isset($_SESSION['name'])){
	
	echo "<br /><p><strong>Login Name:</strong> " . $_SESSION['name'] . "</p>";
}
include("includes/footer.php");