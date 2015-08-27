<?php
include("fhd_config.php");
if (ALLOW_REGISTER == "yes"){
	include("includes/ez_sql_core.php");
	include("includes/ez_sql_mysqli.php");
	$db = new ezSQL_mysqli(db_user,db_password,db_name,db_host);
	$q = $db->escape( $_GET["q"] );
	$db = new ezSQL_mysqli(db_user,db_password,db_name,db_host);
	$q = $db->escape($q);
	$num = $db->get_var("select count(user_login) from site_users where user_login = '$q';");
	if ($num == 0){
		echo "<i class='glyphicon glyphicon-ok'></i> <small><em>available</em></small>";
		}else{
		echo "<i class='glyphicon glyphicon-ban-circle'></i> <small><em>name not available</em></small>";
	}
}