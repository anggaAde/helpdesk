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
include("includes/header.php");
include("includes/all-nav.php");
?>

<h4>Administration Dashboard</h4>
<?php
if(isset($_SESSION['name'])){
	echo "<p><strong>Name:</strong> " . $_SESSION['name'] . "</p>";
}
include("includes/footer.php");
