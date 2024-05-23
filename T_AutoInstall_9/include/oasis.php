<?php
set_time_limit(0);
ini_set('memory_limit', '-1');
include_once (dirname(__FILE__)."/../../GameEngine/config.php");
include_once (dirname(__FILE__)."/../../GameEngine/DB.php");
include_once (dirname(__FILE__)."/../../GameEngine/Database/db_MYSQL.php");

populateOasisdata();
        	
function populateOasisdata() {
	global $database;

	$q2 = "SELECT id,oasistype,occupied FROM wdata where oasistype != 0";
	$res2=$database->query($q2);
	foreach($res2 as $row) {
		$database->query("SET TRANSACTION ISOLATION LEVEL SERIALIZABLE");
		$database->starttransaction();
		$q3 = "SELECT wref, type, conqured FROM odata where wref=".$row['id'];
		$oasis=$database->row($q3);
		
		if(empty($oasis)){
			//We switch type of oasis and instert record with apropriate infomation.
			$q = "INSERT INTO `odata` (`wref`, `type`, `conqured`, `wood`, `iron`, `clay`, `maxstore`, `crop`, `maxcrop`, `lastupdated`, `loyalty`, `owner`) VALUES ('".$row['id']."','".$row['oasistype']."','0','400','400','400','400','400','400','" . time() . "','100','2')";
			$database->query($q);
			$q = "INSERT INTO `units` (`vref`) values ('".$row['id']."')";
			$database->query($q);
		}else{
			$q = "UPDATE `odata`  set `type`=".$row['oasistype']." WHERE `wref`=".$row['id'];
			$database->query($q);
		}
		
		if(!empty($oasis) && !$oasis['conqured']){
			if(SPEED == 10){
				$q = "UPDATE units SET u1 = 0, u2 = 0, u3 = 0,u4 = 0, u5 = 0, u6 = 0, u7 = 0, u8 = 0,u9 = 0 WHERE vref = '" . $wid . "'";
				$database->query($q);
			}
			populateOasis($oasis['wref'],$oasis['type']);
		}
		
		$database->commitq();
	}
}

function populateOasis($wid,$type) {
global $database;
$speed=OASISX;
	switch($type) {
		
		case 1:
		case 2:
			//+25% lumber per hour
			$q = "UPDATE units SET u1 = u1 + '".$speed*rand(0,50)."', u5 = u5 + '".$speed*rand(20,40)."', u6 = u6 + '".$speed*rand(15,30)."',u7 = u7 + '".$speed*rand(0,15)."', u9 = u9 + '".$speed*rand(0,10)."' WHERE vref = '" . $wid . "'";
		$database->query($q);
			break;
		case 3:
			//+25% lumber and +25% crop per hour
			$q = "UPDATE units SET u6 = u6 + '".$speed*rand(15,40)."', u7 = u7 + '".$speed*rand(10,20)."', u8 = u8 + '".$speed*rand(10,20)."', u10 = u10 + '".$speed*rand(0,10)."' WHERE vref = '" . $wid . "'";
			$database->query($q);
			break;
		case 4:
		case 5:
			//+25% clay per hour
			$q = "UPDATE units SET u3 = u3 + '".$speed*rand(0,50)."', u6 = u6 + '".$speed*rand(15,40)."', u7 = u7 + '".$speed*rand(10,20)."', u8 = u8 + '".$speed*rand(0,10)."' WHERE vref = '" . $wid . "'";
			$database->query($q);
			break;
		case 6:
			//+25% clay and +25% crop per hour
			$q = "UPDATE units SET u6 = u6 + '".$speed*rand(15,40)."', u7 = u7 + '".$speed*rand(10,20)."', u8 = u8 + '".$speed*rand(10,20)."', u9 = u9 + '".$speed*rand(0,10)."' WHERE vref = '" . $wid . "'";
			$database->query($q);
			break;
		case 7:
		case 8:
			//+25% iron per hour
			$q = "UPDATE units SET u1 = u1 + '".$speed*rand(15,40)."', u2 = u2 + '".$speed*rand(10,20)."', u4 = u4 + '".$speed*rand(10,20)."' WHERE vref = '" . $wid . "'";
			$database->query($q);
			break;
		case 9:
			//+25% iron and +25% crop
			$q = "UPDATE units SET u1 = u1 + '".$speed*rand(15,40)."', u2 = u2 + '".$speed*rand(10,20)."', u4 = u4 + '".$speed*rand(10,20)."' WHERE vref = '" . $wid . "'";
			$database->query($q);
			break;
		case 10:
		case 11:
			//+25% crop per hour
			$q = "UPDATE units SET u3 = u3 + '".$speed*rand(0,20)."', u7 = u7 + '".$speed*rand(0,10)."', u8 = u8 + '".$speed*rand(0,10)."', u9 = u9 + '".$speed*rand(0,10)."' WHERE vref = '" . $wid . "'";
			$database->query($q);
			break;
		case 12:
			//+50% crop per hour
			$q = "UPDATE units SET u3 = u3 + '".$speed*rand(0,20)."', u7 = u7 + '".$speed*rand(0,10)."', u8 = u8 + '".$speed*rand(0,10)."', u9 = u9 + '".$speed*rand(0,10)."', u10 = u10 + '".$speed*rand(0,20)."' WHERE vref = '" . $wid . "'";
			$database->query($q);
			break;
	}
}
if(!$doNotRedir)
header("Location: ../index.php?s=6");
