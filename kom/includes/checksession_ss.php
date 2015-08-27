<?php
//check to make sure the session variable is registered
if(isset($_SESSION['user_level'])){

	if ($_SESSION['user_level'] == 0 || $_SESSION['user_level'] == 2) {
	}else{
	header( "Location: index.php?e=1" );
	exit;
	}

}
?>