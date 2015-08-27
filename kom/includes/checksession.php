<?php
//check to make sure the session variable is registered
if(isset($_SESSION['user_id'])){
	$user_name = $_SESSION['user_name'];
	$user_id = $_SESSION['user_id'];
	$user_level = $_SESSION['user_level'];
	}
	else{
	echo "<script>document.location.href='/?e=1'</script>";
	exit;
	}
?>