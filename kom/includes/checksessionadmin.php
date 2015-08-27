<?php
//check to make sure the session variable is registered
if(isset($_SESSION['admin'])){
	$admin = 1;
	}
	else{
	header( "Location: index.php?e=1" );
	exit;
	}
?>