<?php
error_reporting(E_ALL & ~E_NOTICE);
header("Content-type: text/html; charset=utf-8");
session_start();
if (isset($_GET['logout'])) {
	$logout = trim($_GET['logout']);
	if ($logout == "y"){
		session_destroy();
		header( "Location: ../index.php?loggedout=yes" );
		exit;
		}
	}