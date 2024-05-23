<?php
session_start();
if($_SESSION['access'] < 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");

include_once(__DIR__."/../../config.php");
require_once(__DIR__."/../../Database.php");
global $database;


mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);


$id = $_POST['id'];


$database->query("UPDATE users SET
	apall = '".$_POST['off']."',
	dpall = '".$_POST['def']."'
	WHERE id = $id");

header("Location: ../../../2388076972/admin.php?p=player&uid=".$id."");
?>