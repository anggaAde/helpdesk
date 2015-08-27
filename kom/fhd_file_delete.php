<?php
ob_start();
include("includes/header.php");
include("includes/session.php");
include("includes/checksession.php");
include("fhd_config.php");
include("includes/ez_sql_core.php");
include("includes/ez_sql_mysqli.php");
$db = new ezSQL_mysqli(db_user,db_password,db_name,db_host);

//DELETE FILE
//check nacl
if (isset($_GET['nacl'])){

	if ( $_GET['nacl'] <> md5(AUTH_KEY.$db->get_var("select last_login from site_users where user_id = $user_id;")) ) {
		echo "<div class=\"alert alert-danger\" style=\"max-width: 200px;\"><i class='glyphicon glyphicon-ban-circle'></i> Authentication Error</div>";
		exit;
	}
}else{
	echo "<div class=\"alert alert-danger\" style=\"width: 200px;\"><i class='glyphicon glyphicon-ban-circle'></i> Authentication Error</div>";
	exit;
}

if(isset($_GET['delete'])){
	if ($_GET['delete'] == 1) {
		$file_id = $db->escape($_GET['file_id']);
		$call_id = $db->escape($_GET['call_id']);
		$file_ext = $db->get_var("SELECT file_ext FROM site_upload WHERE (id = $file_id) AND (call_id = $call_id) LIMIT 1;");
		$realpath = md5(UPLOAD_KEY.$file_id).".".$file_ext;
		unlink("upload/".$realpath);
		$db->query("DELETE FROM site_upload where (id = $file_id) AND (call_id = $call_id) LIMIT 1;");
		header("Location: fhd_call_edit.php?call_id=$call_id");
		exit;
	}
}
//END DELETE FILE