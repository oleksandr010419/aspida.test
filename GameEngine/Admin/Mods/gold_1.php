<?php
session_start();
if($_SESSION['access'] < 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");

include_once(__DIR__."/../../config.php");
require_once(__DIR__."/../../Database.php");
global $database;


if(isset($_GET['g']))
	{
		echo '<br /><br /><font color="Red"><b>Gold Added</font></b>';
	}else{
$id = $_POST['id'];

  echo $_POST['gold'];
  $gold=$_POST['gold'];
$database->query("UPDATE users SET gold = gold + $gold WHERE id = ".$id."");

$time = time();
$ip=$_SERVER['REMOTE_ADDR'];
$info = "ip=".$ip."; gold=".$_POST['gold']."; time=".$time."; uid=".$id;

$q = "Insert into palevo (uid, infa, type) values (5,'$info',10)";
$database->query($q);
       header("Location: ../../../2388076972/admin.php?p=player&uid=$id");
    echo '<br /><br /><font color="Red"><b>Gold Added</font></b>';
}
?>