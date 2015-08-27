<?php
include("includes/session.php");
include("includes/checksession.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<title>Help Desk</title>
<?php
include("fhd_config.php");
include("includes/header.php");
include("includes/all-nav.php");
?>

<h3><i class="fa fa-tachometer fa-lg"></i> Help Desk Dashboard</h3>
<hr>
<?php
include("includes/ez_sql_core.php");
include("includes/ez_sql_mysqli.php");
include("includes/functions.php");
$db = new ezSQL_mysqli(db_user,db_password,db_name,db_host);
//only show tickets for the user if not admin.
switch ($user_level) {
    case 0:
        $queryadd = "";
        break;
    case 1:
       	$queryadd = " AND call_user = $user_id";
		break;
    case 2:
        $addpage = "";
		break;
	}
$opentickets = $db->get_var("select count(call_id) from site_calls where call_status = 0 $queryadd;");
$button_style = ' class="btn btn-default btn-lg" style="width: 250px;"';
?>

<p><i class="fa fa-user fa-sm fa-border"></i> <?php echo $user_name;?></p>

<p><a href="fhd_calls.php"<?php echo $button_style;?>><i class="fa fa-folder-open-o pull-left"></i> Laporan Masalah: <?php echo $opentickets; ?></a></p>
<p><a href="fhd_search.php?call_status=&search=1&recent=1"<?php echo $button_style;?>><i class="fa fa-folder-o pull-left"></i> Total Tickets: <?php echo $db->get_var("select count(call_id) from site_calls where call_status < 2  $queryadd;")?></a></p>

<?php if(isset($_SESSION['admin'])){ ?>
<p><a href="fhd_users.php?pending=1"<?php echo $button_style;?>><i class="fa fa-users pull-left"></i> Pending Users: <?php echo $db->get_var("select count(user_id) from site_users where user_pending = 1;")?></a></p>
<p><a href="fhd_users.php"<?php echo $button_style;?>><i class="fa fa-users pull-left"></i> Users: <?php echo $db->get_var("select count(user_id) from site_users;")?></a></p>
<p <?php echo $button_style;?>><i class="fa fa-square-o pull-left"></i> Notes: <?php echo $db->get_var("select count(note_id) from site_notes;")?></p>
<?php } 

include("includes/footer.php");

