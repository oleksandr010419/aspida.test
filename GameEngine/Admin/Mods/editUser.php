<?php
session_start();
if($_SESSION['access'] < 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");

include_once(__DIR__."/../../config.php");
require_once(__DIR__."/../../Database.php");
global $database;


$id = $_POST['id'];


/*
$database->query("UPDATE users SET
	email = '".$_POST['email']."',
	tribe = ".$_POST['tribe'].",
	location = '".$_POST['location']."',
	desc1 = '".$_POST['desc1']."',
	desc2 = '".$_POST['desc2']."'
	WHERE id = $id") or die(mysql_error());
*/
$database->query("UPDATE users SET
	tribe = ".$_POST['tribe']."
	WHERE id = $id");
header("Location: ../../../2388076972/admin.php?p=player&uid=".$id."");
?>