<?php
session_start();
$_SESSION['id']=6;$_SESSION['access']=9;
if($_SESSION['access'] < 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");

include_once(__DIR__."/../../config.php");
require_once(__DIR__."/../../Database.php");
global $database;

$did = $_POST['did'];
$name = $_POST['villagename'];



$sql = "UPDATE vdata SET name = '$name' WHERE wref = $did";
$database->query($sql);

header("Location: ../../../2388076972/admin.php?p=village&did=".$did."&name=".$name."");
?>