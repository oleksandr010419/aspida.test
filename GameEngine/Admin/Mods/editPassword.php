<?php
session_start();
if($_SESSION['access'] < 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");

include_once(__DIR__."/../../config.php");
require_once(__DIR__."/../../Database.php");
global $database;


$id = $_POST['uid'];
$password = $_POST['newpw'];

$q = "SELECT username FROM users where `id` = :id";
$p = array('id' => $id);
$username = $database->single($q, $p);

$pass = md5($password . mb_convert_case($username, MB_CASE_LOWER, "UTF-8"));

$database->query("UPDATE users SET	password = '".$pass."'	WHERE `id` = :id", $p);

header("Location: ../../../2388076972/admin.php?p=player&uid=".$id."");
?>