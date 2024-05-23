

<?php
$_SESSION['loadMarket'] = 1;
if(!isset($_POST['action']) && !isset($_GET['action'])){
    include("GameEngine/Market.php");
	$market->procMarket($_POST);
	$market->procRemove($_GET);
}


if(!isset($_GET['t']) || !in_array($_GET['t'],array(1,2,3,4))){
    include("17_0.php");
}else{
    include("Templates/Build/".$village->resarray['f'.$_GET['id'].'t']."_".$_GET['t'].".php");
}


