<?php
session_start();
if($_SESSION['access'] < 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");

include_once(__DIR__."/../../config.php");
require_once(__DIR__."/../../Database.php");
global $database;


$uid = $_POST['uid'];
$topic = $_POST['topic'];
$message = $_POST['message'];

$query = "INSERT INTO mdata (target, owner, topic, message, viewed, time, send) VALUES ('$uid', 1, '$topic', '$message', 0, '".time()."', 0)";

$database->query($query);

header("Location: ../../../2388076972/admin.php?p=Newmessage&uid=".$uid."&msg=ok");
?>