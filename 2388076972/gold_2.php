<?php

include_once("../../config.php");

mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);

if(isset($_GET['g']))
	{
		echo '<br /><br /><font color="Red"><b>Gold was taken, greedy to fuck you</font></b>';
	}else{
$id = $_POST['id'];

  echo $_POST['gold'];
  $gold=$_POST['gold'];
$database->query("UPDATE users SET gold = gold - $gold WHERE id = ".$id."");
       header("Location: admin.php?p=player&uid=$id");
    echo '<br /><br /><font color="Red"><b>Gold was taken, greedy to fuck you</font></b>';
}

?>