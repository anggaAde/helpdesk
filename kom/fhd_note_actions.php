<?php
ob_start();
include("includes/session.php");
include("includes/checksession.php");
include("includes/checksession_ss.php");
include("fhd_config.php");
include("includes/ez_sql_core.php");
include("includes/ez_sql_mysqli.php");
include("includes/functions.php");
$db = new ezSQL_mysqli(db_user,db_password,db_name,db_host);

//<EDIT NOTE>
if ($_GET['action'] == 'delete'){
	if (isset($_GET['nacl'])){
 		if ( $_GET['nacl'] == md5(AUTH_KEY.$db->get_var("select last_login from site_users where user_id = $user_id;")) ){
		//authentication verified, continue.
		$note_id = checkid($_GET['note_id']);
		$call_id = checkid($_GET['call_id']);
		$db->query("UPDATE site_notes SET note_type = 0 where note_id = $note_id limit 1;");
		header("Location: fhd_call_edit.php?call_id=$call_id");
		}
	}
}
//</EDIT NOTE>

//<DELETE NOTE>
if ($_GET['action'] == 'delete'){
	if (isset($_GET['nacl'])){
 		if ( $_GET['nacl'] == md5(AUTH_KEY.$db->get_var("select last_login from site_users where user_id = $user_id;")) ){
		//authentication verified, continue.
		$note_id = checkid($_GET['note_id']);
		$call_id = checkid($_GET['call_id']);
		$db->query("UPDATE site_notes SET note_type = 0 where note_id = $note_id limit 1;");
		header("Location: fhd_call_edit.php?call_id=$call_id#notes");
		}
	}
}
//</DELETE NOTE>