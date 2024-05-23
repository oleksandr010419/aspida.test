<?php
session_start();
if($_SESSION['access'] < 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");

include_once(__DIR__."/../../config.php");
require_once(__DIR__."/../../Database.php");
global $database;



$id = $_POST['id'];

$pdur =  $_POST['plus'] * 86400;
$b1dur = $_POST['wood'] * 86400;
$b2dur = $_POST['clay'] * 86400;
$b3dur = $_POST['iron'] * 86400;
$b4dur = $_POST['crop'] * 86400;
//$quest = $_POST['quest'];

if($pdur  > 1){ $plus = (time() + $pdur); } else { $plus = 0; }
if($b1dur > 1){ $wood = (time() + $b1dur); } else { $wood = 0; }
if($b2dur > 1){ $clay = (time() + $b2dur); } else { $clay = 0; }
if($b3dur > 1){ $iron = (time() + $b3dur); } else { $iron = 0; }
if($b4dur > 1){ $crop = (time() + $b4dur); } else { $crop = 0; }

$database->query("UPDATE users SET
	plus = ".$plus.",
	b1 = ".$wood.",
	b2 = ".$clay.",
	b3 = ".$iron.",
	b4 = ".$crop."
	WHERE id = $id");
	

header("Location: ../../../2388076972/admin.php?p=player&uid=".$id."");
?>