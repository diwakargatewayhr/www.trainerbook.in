<?php
session_start();
ob_start();
ini_set('display_errors', 0);
ini_set('upload_max_filesize', "400M");
ini_set('post_max_size', '400M');
ini_set('max_input_time', 600);
ini_set('max_execution_time', 600);

include 'database.php';
/* Connection Details */
//if ($_SERVER['HTTP_HOST'] == "127.0.0.1" || $_SERVER['HTTP_HOST'] == "localhost") {
if (in_array($_SERVER['HTTP_HOST'], ["127.0.0.1", "localhost", "::1"])) {
    $SERVER = $host_server;
	$USER = $db_username;
	$PASSWORD = $db_password;
	$DATABASE = $db_name;
	// $widgetPath = 'https://kidzz.in/projects/trainerbook/';
	// $widgetPath = 'https://trainerbook.in/';

	/* Site information */
} else {
	$SERVER = $host_server1;
	$USER = $db_username1;
	$PASSWORD = $db_password1;
	$DATABASE = $db_name1;
	// $widgetPath = 'https://kidzz.in/projects/trainerbook/';
	// $widgetPath = 'https://trainerbook.in/';
}
$widgetPath = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
$CONN = mysqli_connect($SERVER, $USER, $PASSWORD, $DATABASE);

if (!$CONN) {
	die('Could not connect: ' . mysql_error());
}
//mysql_select_db($DATABASE) or die(mysql_error());

$adminTitle = "Trainer Book";
// $baseURL = 'https://kidzz.in/projects/trainerbook/';
//$baseURL = 'https://trainerbook.in/';
$baseURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';

if (isset($_COOKIE["user_id"])) {
	$_SESSION['userid'] = $_COOKIE["user_id"];
	$_SESSION['id'] = $_COOKIE["user_id"];
}

if (isset($_COOKIE["user_type"])) {
	$_SESSION['type'] = $_COOKIE["user_type"];
}

$portalSetting = mysqli_fetch_array(mysqli_query($CONN, "SELECT * FROM `website_settings` WHERE `id` = '1'"));

$qry = mysqli_query($CONN, "SELECT * FROM `user_register` WHERE `id` = '" . @$_SESSION['userid'] . "'");
$getUser = mysqli_fetch_array($qry);
