<?php
session_start();

if($_SESSION['access'] < 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");

include_once(__DIR__."/../../config.php");
require_once(__DIR__."/../../Database.php");
global $database;

$q = "UPDATE users SET gold = gold + ".$_POST['gold']." WHERE id != '0'";
$database->query($q);

header("Location: ../../../2388076972/admin.php?p=gold&g");
?>