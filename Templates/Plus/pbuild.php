<?php
require_once("GameEngine/DailyQuest.php");	
require_once("GameEngine/Database.php");		

if(isset($_GET['action']) && $_GET['action']=='barracks20'){
if($session->gold >= 30) {
		$stat = getBuildSpace($village->wid,19);
		if($stat!==false){
			addBuilding($stat,19,20,$village->wid);
        	$database->modifyGold($session->uid,30,0,"Instant build max lvl building (barracks20)");
		}
    }
    header("Location: more.php");
}

if(isset($_GET['action']) && $_GET['action']=='stable20'){
if($session->gold >= 30) {
		$stat = getBuildSpace($village->wid,20);
		if($stat!==false){
			addBuilding($stat,20,20,$village->wid);
        	$database->modifyGold($session->uid,30,0,"Instant build max lvl building (stable20)");
		}
    }
    header("Location: more.php");
}

if(isset($_GET['action']) && $_GET['action']=='workshop20'){
if($session->gold >= 30) {
		$stat = getBuildSpace($village->wid,21);
		if($stat!==false){
			addBuilding($stat,21,20,$village->wid);
        	$database->modifyGold($session->uid,30,0,"Instant build max lvl building (workshop20)");
		}
    }
    header("Location: more.php");
}

if(isset($_GET['action']) && $_GET['action']=='academy20'){
	if($session->gold >= 20) {
		$stat = getBuildSpace($village->wid,22);
		if($stat!==false){
			addBuilding($stat,22,20,$village->wid);
        	$database->modifyGold($session->uid,20,0,"Instant build max lvl building (academy20)");
		}
    }
    header("Location: more.php");
}

if(isset($_GET['action']) && $_GET['action']=='smithy20'){
	if($session->gold >= 30) {
		$stat = getBuildSpace($village->wid,12);
		if($stat!==false){
			addBuilding($stat,12,20,$village->wid);
        	$database->modifyGold($session->uid,30,0,"Instant build max lvl building (smithy20)");
		}
    }
    header("Location: more.php");
}

if(isset($_GET['action']) && $_GET['action']=='treasury20'){
	if($session->gold >= 30 && $village->resarray['f99t'] != 40) {
		$stat = getBuildSpace($village->wid,27);
		if($stat!==false){
			addBuilding($stat,27,20,$village->wid);
        	$database->modifyGold($session->uid,30,0,"Instant build max lvl building (treasury20)");
		}
    }
    header("Location: more.php");
}

if(isset($_GET['action']) && $_GET['action']=='tournament_square20'){
	if($session->gold >= 30) {
		$stat = getBuildSpace($village->wid,14);
		if($stat!==false){
			addBuilding($stat,14,20,$village->wid);
        	$database->modifyGold($session->uid,30,0,"Instant build max lvl building (tournament_square20)");
		}
    }
    header("Location: more.php");
}

if(isset($_GET['action']) && $_GET['action']=='warehouse20'){
	if($session->gold >= 10) {
		$stat = getBuildSpace($village->wid,10);
		if($stat!==false){
			addBuilding($stat,10,20,$village->wid);
        	$database->modifyGold($session->uid,10,0,"Instant build max lvl building (warehouse20)");
		}
    }
    header("Location: more.php");
}


if(isset($_GET['action']) && $_GET['action']=='main20'){
	if($session->gold >= 10) {		
    	addBuilding(26,15,20,$village->wid);
        $database->modifyGold($session->uid,10,0,"Instant build max lvl building (main20)");
    }
    header("Location: more.php");
}


if(isset($_GET['action']) && $_GET['action']=='granary20'){
	if($session->gold >= 10) {
		$stat = getBuildSpace($village->wid,11);
		if($stat!==false){
			addBuilding($stat,11,20,$village->wid);
        	$database->modifyGold($session->uid,10,0,"Instant build max lvl building (granary20)");
		}
    }
    header("Location: more.php");
}



if(isset($_GET['action']) && $_GET['action']=='ordoogah'){
	if($session->gold >= 20) {
    	addBuilding(39,16,20,$village->wid);
        $database->modifyGold($session->uid,20,0,"Instant build (ordoogah)");
    }
    header("Location: more.php");
}

function addBuilding($pos,$type,$level,$vid){		
	$database = new MYSQL_DB;
	$database->query("UPDATE fdata SET `f{$pos}` = '{$level}', `f{$pos}t` = '{$type}' WHERE `vref` = '".$vid."'");
	$population = 0;
	$cp = 0;
	for($i = 1; $i < $level;$i++){
		$pop = $database->getPop($type, $i);
		$population+=$pop[0];
		$cp+=$pop[1];
	}	
	$database->addCPop($vid, $cp, $population);
}

function getBuildSpace($vid,$buildingType){
	$database = new MYSQL_DB;
	$buildOrUpgrade = true;
	//tab holding buildings with lowest levels
	$buildings = array();
	$freeSpace = false;
	$build = $database->row("SELECT * FROM fdata WHERE vref = ".$vid."");

	for($i=19;$i<=38;$i++){
		$buildLevel = $build['f'.$i];
		$buildType = $build['f'.$i.'t'];

		if(!$freeSpace && $buildLevel==0 && $buildType==0){
			$freeSpace = $i;
		}
		else if($buildLevel!=0 && $buildType!=0){
			//if exists but level is lower than last max
			if((isset($buildings[$buildType]) && $buildings[$buildType]['level']>$buildLevel) || !isset($buildings[$buildType])) {
				$buildings[$buildType] = array('level'=>$buildLevel,'pos'=>$i);
			}
		}
	}

	if(isset($buildings[$buildingType])){
		if($buildings[$buildingType]['level']!=20){
			//we can upgrade everything
			$freeSpace = $buildings[$buildingType]['pos'];
		}
		else{
			//if level 20
			if($buildingType==10 or $buildingType==11  or $buildingType==38 or $buildingType==39 or $buildingType==36 or $buildingType==12 or $buildingType==27  or $buildingType==14) {
				$buildOrUpgrade = true;	
			}
			else{
				//do not build/upgrade - building exists
				$buildOrUpgrade = false;	
			}
		}
	}
	//else build new
	//echo var_dump($freeSpace);
	return (($buildOrUpgrade)?$freeSpace:false);
}
?>