<?php
require_once __DIR__.'/../../GameEngine/DailyQuest.php';	
require_once __DIR__.'/../../GameEngine/Database.php';							
$dailyQuest = new DailyQuest($session->uid);

include("Templates/Plus/pmenu.php");

$golds = $database->getUserGold($session->uid);
$today = date("mdHi");

if ($golds) {
	if($session->gold == 0) {
		echo "<div class=\"boxes boxesColor gray goldBalance\"><div class=\"boxes-tl\"></div><div class=\"boxes-tr\"></div><div class=\"boxes-tc\"></div><div class=\"boxes-ml\"></div><div class=\"boxes-mr\"></div><div class=\"boxes-mc\"></div><div class=\"boxes-bl\"></div><div class=\"boxes-br\"></div><div class=\"boxes-bc\"></div><div class=\"boxes-contents\">&#1583;&#1585; &#1581;&#1575;&#1604; &#1581;&#1575;&#1590;&#1585; &#1588;&#1605;&#1575; <b>&#1607;&#1740;&#1670;</b> &#1587;&#1705;&#1607; &#1575;&#1740; &#1606;&#1583;&#1575;&#1585;&#1740;&#1583;</div></div>";
	} else {
		echo "<div class=\"boxes boxesColor gray goldBalance\"><div class=\"boxes-tl\"></div><div class=\"boxes-tr\"></div><div class=\"boxes-tc\"></div><div class=\"boxes-ml\"></div><div class=\"boxes-mr\"></div><div class=\"boxes-mc\"></div><div class=\"boxes-bl\"></div><div class=\"boxes-br\"></div><div class=\"boxes-bc\"></div><div class=\"boxes-contents\">&#1583;&#1585; &#1581;&#1575;&#1604; &#1581;&#1575;&#1590;&#1585; &#1588;&#1605;&#1575; <b>$session->gold</b> &#1593;&#1583;&#1583; &#1587;&#1705;&#1728; &#1591;&#1604;&#1575;&#1740; &#1578;&#1585;&#1575;&#1608;&#1740;&#1606; &#1583;&#1575;&#1585;&#1610;&#1583;.</div></div>";
	}
}

if(isset($_GET['action']) && $_GET['action']=='manabe'){
	$check = $database->row("SELECT * FROM `fdata` WHERE `vref` = '".$village->wid."'");
	if($session->gold >= 10 && $check['f99t']==0) {
        $database->query("UPDATE `vdata` SET wood = wood + '".$village->getProd("wood")."' WHERE `wref` = '".$village->wid."'");
        $database->query("UPDATE `vdata` SET clay = clay + '".$village->getProd("clay")."' WHERE `wref` = '".$village->wid."'");
        $database->query("UPDATE `vdata` SET iron = iron + '".$village->getProd("iron")."' WHERE `wref` = '".$village->wid."'");
        $database->query("UPDATE `vdata` SET crop = crop + '".$village->getProd("crop")."' WHERE `wref` = '".$village->wid."'");
        if($village->getProd("crop")>0){
        	$database->query("UPDATE `vdata` SET crop = crop + ".$village->getProd("crop")." WHERE `wref` = '".$village->wid."'");
        }
		$database->modifyGold($session->uid,10,0,"Bought Crop in village:".$village->wid);
		$dailyQuest->incrementQuest(QUEST_GAIN_SPEND_GOLD);
    }
    header("Location: dorf1.php");

}


if(isset($_GET['action']) && $_GET['action']=='buycp'){
	if($session->gold >= 40) {
    	$database->query("UPDATE vdata SET `cp` = cp + 5000 WHERE `wref` = '".$village->wid."'");
		$database->modifyGold($session->uid,40,0,"Bought 5000 CP");
		$dailyQuest->incrementQuest(QUEST_GAIN_SPEND_GOLD);
    }
    header("Location: dorf1.php");
}
/*
if($_GET['action']=='t11'){
	if($session->gold >= 100) {
        $modifier = (SPEED * ((100 / 60) * (3600 / ($u11['time'] * (13.51 / 100)))));
    	$database->query("UPDATE units SET u1 = u1 + ".$modifier." WHERE `vref` = '".$village->wid."'");
		$database->modifyGold($session->uid,100,0,"Bought units");		
$dailyQuest->incrementQuest(QUEST_GAIN_SPEND_GOLD);
    }
    header("Location: dorf1.php");
}
if($_GET['action']=='r11'){
	if($session->gold >= 100) {
    	$modifier = (SPEED * ((100 / 60) * (3600 / ($u1['time'] * (13.51 / 100)))));
    	$database->query("UPDATE units SET u1 = u1 + ".$modifier." WHERE `vref` = '".$village->wid."'");
		$database->modifyGold($session->uid,100,0,"Bought units");		
$dailyQuest->incrementQuest(QUEST_GAIN_SPEND_GOLD);
    }
    header("Location: dorf1.php");
}*/
if($_GET['troop']==1){
	$pack = $_GET['action'];
	$troop_id = floor($pack/10);
	$troop = 'u'.$troop_id;
	if($session->tribe>1){
		$unit = 'u'.($session->tribe-1).$troop_id;
	}else{
		$unit = 'u'.$troop_id;
	}
	global ${$unit};
	if($pack%10 == 1){
		$gold=100;
		$troop_modifier = 1;
	}
	else if($pack%10 == 2){
		$gold=200;
		$troop_modifier = 2;
	}
	else if($pack%10 == 3){
		$gold=400;
		$troop_modifier = 4;
	}
	else if($pack%10 == 4){
		$gold=1000;
		$troop_modifier = 10;
	}
	else if($pack%10 == 5){
		$gold=5000;
		$troop_modifier = 50;
	}
	else if($pack%10 == 6){
		$gold=10000;
		$troop_modifier = 100;
	}else{
		$gold = 1000000000000;
	}
	
	if($troop_id<7 && $session->gold >= $gold && ${$unit}['time']>0) {//200/400/1000
    	$modifier = ($troop_modifier * (SPEED/5) * ((100 / 60) * (3600 / (${$unit}['time'] * (13.51 / 100)))));
    	$database->query("UPDATE units SET ".$troop." = ".$troop." + ".$modifier." WHERE `vref` = '".$village->wid."'");
		$database->modifyGold($session->uid,$gold,0,"Bought units");		
		$dailyQuest->incrementQuest(QUEST_GAIN_SPEND_GOLD);
    }
    header("Location: dorf1.php");
}

if($_GET['action']=='lumber'){
	if($session->gold >= 20) {
		$modifier = ((2450 *4) * SPEED);
    	$database->query("UPDATE vdata SET `wood` = `wood` + ".$modifier." WHERE wref =".$village->wid."");
		$database->modifyGold($session->uid,20,0,"Bought lumber");		
		
$dailyQuest->incrementQuest(QUEST_GAIN_SPEND_GOLD);
    }
	header("Location: dorf1.php");
}	

if($_GET['action']=='clay'){
	if($session->gold >= 20) {
		$modifier = ((2450 *4) * SPEED);
    	$database->query("UPDATE vdata SET `clay` = `clay` + ".$modifier." WHERE wref =".$village->wid."");
		$database->modifyGold($session->uid,20,0,"Bought clay");		
$dailyQuest->incrementQuest(QUEST_GAIN_SPEND_GOLD);
    }
	header("Location: dorf1.php");
}	

if($_GET['action']=='iron'){
	if($session->gold >= 20) {
		$modifier = ((2450 *4) * SPEED);
    	$database->query("UPDATE vdata SET `iron` = `iron` + ".$modifier." WHERE wref =".$village->wid."");
		$database->modifyGold($session->uid,20,0,"Bought iron");		
$dailyQuest->incrementQuest(QUEST_GAIN_SPEND_GOLD);
    }
	header("Location: dorf1.php");
}	

if($_GET['action']=='crop'){
	if($session->gold >= 20) {
		$modifier = ((2450 *4) * SPEED);
    	$database->query("UPDATE vdata SET `crop` = `crop` + ".$modifier." WHERE wref =".$village->wid."");
		$database->modifyGold($session->uid,20,0,"Bought crop");		
$dailyQuest->incrementQuest(QUEST_GAIN_SPEND_GOLD);
    }
	header("Location: dorf1.php");
}	

if($_GET['action']=='combo1'){
	if($session->gold >= 80) {
		$modifier = ((2450 *4) * SPEED);
    	$database->query("UPDATE vdata SET `wood` = `wood` + ".$modifier." WHERE wref =".$village->wid."");
		$database->query("UPDATE vdata SET `clay` = `clay` + ".$modifier." WHERE wref =".$village->wid."");
		$database->query("UPDATE vdata SET `iron` = `iron` + ".$modifier." WHERE wref =".$village->wid."");
		$database->query("UPDATE vdata SET `crop` = `crop` + ".$modifier." WHERE wref =".$village->wid."");
		$database->modifyGold($session->uid,80,0,"Bought combo1");		
$dailyQuest->incrementQuest(QUEST_GAIN_SPEND_GOLD);
    }
	header("Location: dorf1.php");
}	

if($_GET['action']=='combo2'){
	if($session->gold >= 480) {
		$modifier = (((2450 *4) * SPEED) * 6);
    	$database->query("UPDATE vdata SET `wood` = `wood` + ".$modifier." WHERE wref =".$village->wid."");
		$database->query("UPDATE vdata SET `clay` = `clay` + ".$modifier." WHERE wref =".$village->wid."");
		$database->query("UPDATE vdata SET `iron` = `iron` + ".$modifier." WHERE wref =".$village->wid."");
		$database->query("UPDATE vdata SET `crop` = `crop` + ".$modifier." WHERE wref =".$village->wid."");
		$database->modifyGold($session->uid,480,0,"Bought combo2");		
$dailyQuest->incrementQuest(QUEST_GAIN_SPEND_GOLD);
    }
	header("Location: dorf1.php");
}	

if($_GET['action']=='combo3'){
	if($session->gold >= 1920) {
		$modifier = (((2450 *4) * SPEED) * 24);
    	$database->query("UPDATE vdata SET `wood` = `wood` + ".$modifier." WHERE wref =".$village->wid."");
		$database->query("UPDATE vdata SET `clay` = `clay` + ".$modifier." WHERE wref =".$village->wid."");
		$database->query("UPDATE vdata SET `iron` = `iron` + ".$modifier." WHERE wref =".$village->wid."");
		$database->query("UPDATE vdata SET `crop` = `crop` + ".$modifier." WHERE wref =".$village->wid."");
		$database->modifyGold($session->uid,1920,0,"Bought combo3");		
$dailyQuest->incrementQuest(QUEST_GAIN_SPEND_GOLD);
    }
	header("Location: dorf1.php");
}	

if(isset($_GET['action']) && $_GET['action']=='manba'){
	if($session->gold >= 300) {
    	$database->query("UPDATE fdata SET `f1` = '10',`f3` = '10',`f14` = '10',`f17` = '10',`f5` = '10',`f6` = '10',`f16` = '10',`f18` = '10',`f11` = '10',
		`f10` = '10',`f7` = '10',`f4` = '10',`f13` = '10',`f9` = '10',`f15` = '10',`f2` = '10',`f8` = '10',`f12` = '10'	WHERE `vref` = '".$village->wid."'");
		
		$database->recountPop($village->wid);
		$database->modifyGold($session->uid,300,0,"Upgrade all farms to 10");
		$dailyQuest->incrementQuest(QUEST_GAIN_SPEND_GOLD);
    }
    header("Location: dorf1.php");
}
if(isset($_GET['action']) && $_GET['action']=='manba3'){
	if($session->gold >= 500 && $village->capital) {
    	/*$database->query("UPDATE fdata SET `f1` = '20' WHERE `vref` = '".$village->wid."'");//, `f1t` = '1'
		$database->query("UPDATE fdata SET `f3` = '20' WHERE `vref` = '".$village->wid."'");//, `f3t` = '1'
		$database->query("UPDATE fdata SET `f14` = '20' WHERE `vref` = '".$village->wid."'");//, `f14t` = '1'
		$database->query("UPDATE fdata SET `f17` = '20' WHERE `vref` = '".$village->wid."'");//, `f17t` = '1'
		$database->query("UPDATE fdata SET `f5` = '20' WHERE `vref` = '".$village->wid."'");//, `f5t` = '2'
		$database->query("UPDATE fdata SET `f6` = '20' WHERE `vref` = '".$village->wid."'");//, `f6t` = '2'
		$database->query("UPDATE fdata SET `f16` = '20' WHERE `vref` = '".$village->wid."'");//, `f16t` = '2'
		$database->query("UPDATE fdata SET `f18` = '20' WHERE `vref` = '".$village->wid."'");//, `f18t` = '2'
		$database->query("UPDATE fdata SET `f11` = '20' WHERE `vref` = '".$village->wid."'");//, `f11t` = '3'
		$database->query("UPDATE fdata SET `f10` = '20' WHERE `vref` = '".$village->wid."'");//, `f10t` = '3' 
		$database->query("UPDATE fdata SET `f7` = '20' WHERE `vref` = '".$village->wid."'");//, `f7t` = '3'
		$database->query("UPDATE fdata SET `f4` = '20' WHERE `vref` = '".$village->wid."'");//, `f4t` = '3'
		$database->query("UPDATE fdata SET `f13` = '20' WHERE `vref` = '".$village->wid."'");//, `f13t` = '4'
		$database->query("UPDATE fdata SET `f9` = '20' WHERE `vref` = '".$village->wid."'");//, `f9t` = '4'
		$database->query("UPDATE fdata SET `f15` = '20' WHERE `vref` = '".$village->wid."'");//, `f15t` = '4'
		$database->query("UPDATE fdata SET `f2` = '20' WHERE `vref` = '".$village->wid."'");//, `f2t` = '4'
		$database->query("UPDATE fdata SET `f8` = '20' WHERE `vref` = '".$village->wid."'");//, `f8t` = '4'
		$database->query("UPDATE fdata SET `f12` = '20' WHERE `vref` = '".$village->wid."'");//, `f12t` = '4'*/
		$database->query("UPDATE fdata SET `f1` = '20',`f3` = '20',`f14` = '20',`f17` = '20',`f5` = '20',`f6` = '20',`f16` = '20',`f18` = '20',`f11` = '20',
		`f10` = '20',`f7` = '20',`f4` = '20',`f13` = '20',`f9` = '20',`f15` = '20',`f2` = '20',`f8` = '20',`f12` = '20'	WHERE `vref` = '".$village->wid."'");
		
		$database->recountPop($village->wid);
		$database->modifyGold($session->uid,500,0,"Upgrade to 20");		
$dailyQuest->incrementQuest(QUEST_GAIN_SPEND_GOLD);
    }
    header("Location: dorf1.php");
}
if(isset($_GET['action']) && $_GET['action']=='manba2'){
	if($session->gold >= 150) {
    	/*$database->query("UPDATE fdata SET `f1` = '5' WHERE `vref` = '".$village->wid."'");// `f1t` = '1'
		$database->query("UPDATE fdata SET `f3` = '5' WHERE `vref` = '".$village->wid."'");//, `f3t` = '1'
		$database->query("UPDATE fdata SET `f14` = '5' WHERE `vref` = '".$village->wid."'");//, `f14t` = '1' 
		$database->query("UPDATE fdata SET `f17` = '5' WHERE `vref` = '".$village->wid."'");//, `f17t` = '1' 
		$database->query("UPDATE fdata SET `f5` = '5' WHERE `vref` = '".$village->wid."'");//, `f5t` = '2'
		$database->query("UPDATE fdata SET `f6` = '5' WHERE `vref` = '".$village->wid."'");//, `f6t` = '2'
		$database->query("UPDATE fdata SET `f16` = '5' WHERE `vref` = '".$village->wid."'");//, `f16t` = '2'
		$database->query("UPDATE fdata SET `f18` = '5' WHERE `vref` = '".$village->wid."'");//, `f18t` = '2'
		$database->query("UPDATE fdata SET `f11` = '5' WHERE `vref` = '".$village->wid."'");//, `f11t` = '3' 
		$database->query("UPDATE fdata SET `f10` = '5' WHERE `vref` = '".$village->wid."'");//, `f10t` = '3'
		$database->query("UPDATE fdata SET `f7` = '5' WHERE `vref` = '".$village->wid."'");//, `f7t` = '3'
		$database->query("UPDATE fdata SET `f4` = '5' WHERE `vref` = '".$village->wid."'");//, `f4t` = '3'
		$database->query("UPDATE fdata SET `f13` = '5' WHERE `vref` = '".$village->wid."'");//, `f13t` = '4'
		$database->query("UPDATE fdata SET `f9` = '5'  WHERE `vref` = '".$village->wid."'");//, `f9t` = '4'
		$database->query("UPDATE fdata SET `f15` = '5' WHERE `vref` = '".$village->wid."'");//, `f15t` = '4'
		$database->query("UPDATE fdata SET `f2` = '5' WHERE `vref` = '".$village->wid."'");//, `f2t` = '4'
		$database->query("UPDATE fdata SET `f8` = '5' WHERE `vref` = '".$village->wid."'");//, `f8t` = '4'
		$database->query("UPDATE fdata SET `f12` = '5' WHERE `vref` = '".$village->wid."'");//, `f12t` = '4'*/
		$database->query("UPDATE fdata SET `f1` = '5',`f3` = '5',`f14` = '5',`f17` = '5',`f5` = '5',`f6` = '5',`f16` = '5',`f18` = '5',`f11` = '5',
		`f10` = '5',`f7` = '5',`f4` = '5',`f13` = '5',`f9` = '5',`f15` = '5',`f2` = '5',`f8` = '5',`f12` = '5'	WHERE `vref` = '".$village->wid."'");
		$database->recountPop($village->wid);
		$database->modifyGold($session->uid,150,0,"Upgrade to 5");		
		$dailyQuest->incrementQuest(QUEST_GAIN_SPEND_GOLD);
    }
    header("Location: dorf1.php");
}

if($_GET['action']=='n1'){
	if($session->gold >= 100) {
		
		//total defence (infantry+cavalry) for every nature troop
		$tot31=($u31['di'] + $u31['dc']);
		$tot32=($u32['di'] + $u32['dc']);
		$tot33=($u33['di'] + $u33['dc']);
		$tot34=($u34['di'] + $u34['dc']);
		$tot35=($u35['di'] + $u35['dc']);
		$tot36=($u36['di'] + $u36['dc']);
		$tot37=($u37['di'] + $u37['dc']);
		$tot38=($u38['di'] + $u38['dc']);
		$tot39=($u39['di'] + $u39['dc']);
		$tot40=($u40['di'] + $u40['dc']);
		
		//times number (elephant/nature)
		$times31=($tot40 / $tot31);
		$times32=($tot40 / $tot32);
		$times33=($tot40 / $tot33);
		$times34=($tot40 / $tot34);
		$times35=($tot40 / $tot35);
		$times36=($tot40 / $tot36);
		$times37=($tot40 / $tot37);
		$times38=($tot40 / $tot38);
		$times39=($tot40 / $tot39);
		$times40=($tot40 / $tot40);
		
		//number of troops * game speed
		$troop31=(($times31 * SPEED) / 2);
		$troop32=(($times32 * SPEED) / 2);
		$troop33=(($times33 * SPEED) / 2);
		$troop34=(($times34 * SPEED) / 2);
		$troop35=(($times35 * SPEED) / 2);
		$troop36=(($times36 * SPEED) / 2);
		$troop37=(($times37 * SPEED) / 2);
		$troop38=(($times38 * SPEED) / 2);
		$troop39=(($times39 * SPEED) / 2);
		$troop40=(($times40 * SPEED) / 2);
		
		$randomVillage = $database->row('SELECT *  FROM `wdata` WHERE `oasistype` > 0 LIMIT 1');
		
		$database->query("INSERT INTO  `enforcement` (`u1` ,`u2` ,`u3` ,`u4` ,`u5` ,`u6` ,`u7` ,`u8` ,`u9` ,`u10` ,`from` ,`vref`
		) VALUES ('".$troop31."',  '".$troop32."',  '".$troop33."',  '".$troop34."',  '".$troop35."',  '".$troop36."',  '".$troop37."',  '".$troop38."',  '".$troop39."',  '".$troop40."',  '".$randomVillage['id']."',  '".$village->wid."');");
		$database->modifyGold($session->uid,100,0,"Bought units");		
    
$dailyQuest->incrementQuest(QUEST_GAIN_SPEND_GOLD);
}
    header("Location: dorf1.php");
}

if($_GET['action']=='n2'){
	if($session->gold >= 200) {
		//total defence (infantry+cavalry) for every nature troop
		$tot31=($u31['di'] + $u31['dc']);
		$tot32=($u32['di'] + $u32['dc']);
		$tot33=($u33['di'] + $u33['dc']);
		$tot34=($u34['di'] + $u34['dc']);
		$tot35=($u35['di'] + $u35['dc']);
		$tot36=($u36['di'] + $u36['dc']);
		$tot37=($u37['di'] + $u37['dc']);
		$tot38=($u38['di'] + $u38['dc']);
		$tot39=($u39['di'] + $u39['dc']);
		$tot40=($u40['di'] + $u40['dc']);
		
		//times number (elephant/nature)
		$times31=($tot40 / $tot31);
		$times32=($tot40 / $tot32);
		$times33=($tot40 / $tot33);
		$times34=($tot40 / $tot34);
		$times35=($tot40 / $tot35);
		$times36=($tot40 / $tot36);
		$times37=($tot40 / $tot37);
		$times38=($tot40 / $tot38);
		$times39=($tot40 / $tot39);
		$times40=($tot40 / $tot40);
		
		//number of troops * game speed
		$troop31=(($times31 * SPEED) / 1);
		$troop32=(($times32 * SPEED) / 1);
		$troop33=(($times33 * SPEED) / 1);
		$troop34=(($times34 * SPEED) / 1);
		$troop35=(($times35 * SPEED) / 1);
		$troop36=(($times36 * SPEED) / 1);
		$troop37=(($times37 * SPEED) / 1);
		$troop38=(($times38 * SPEED) / 1);
		$troop39=(($times39 * SPEED) / 1);
		$troop40=(($times40 * SPEED) / 1);
		
		$randomVillage = $database->row('SELECT *  FROM `wdata` WHERE `oasistype` > 0 LIMIT 1');
		
		$database->query("INSERT INTO  `enforcement` (`u1` ,`u2` ,`u3` ,`u4` ,`u5` ,`u6` ,`u7` ,`u8` ,`u9` ,`u10` ,`from` ,`vref`
		) VALUES ('".$troop31."',  '".$troop32."',  '".$troop33."',  '".$troop34."',  '".$troop35."',  '".$troop36."',  '".$troop37."',  '".$troop38."',  '".$troop39."',  '".$troop40."',  '".$randomVillage['id']."',  '".$village->wid."');");
		$database->modifyGold($session->uid,200,0,"Bought units");		
$dailyQuest->incrementQuest(QUEST_GAIN_SPEND_GOLD);
    }
    header("Location: dorf1.php");
}

if($_GET['action']=='n3'){
	if($session->gold >= 400) {
		//total defence (infantry+cavalry) for every nature troop
		$tot31=($u31['di'] + $u31['dc']);
		$tot32=($u32['di'] + $u32['dc']);
		$tot33=($u33['di'] + $u33['dc']);
		$tot34=($u34['di'] + $u34['dc']);
		$tot35=($u35['di'] + $u35['dc']);
		$tot36=($u36['di'] + $u36['dc']);
		$tot37=($u37['di'] + $u37['dc']);
		$tot38=($u38['di'] + $u38['dc']);
		$tot39=($u39['di'] + $u39['dc']);
		$tot40=($u40['di'] + $u40['dc']);
		
		//times number (elephant/nature)
		$times31=($tot40 / $tot31);
		$times32=($tot40 / $tot32);
		$times33=($tot40 / $tot33);
		$times34=($tot40 / $tot34);
		$times35=($tot40 / $tot35);
		$times36=($tot40 / $tot36);
		$times37=($tot40 / $tot37);
		$times38=($tot40 / $tot38);
		$times39=($tot40 / $tot39);
		$times40=($tot40 / $tot40);
		
		//number of troops * game speed
		$troop31=(($times31 * SPEED) * 2);
		$troop32=(($times32 * SPEED) * 2);
		$troop33=(($times33 * SPEED) * 2);
		$troop34=(($times34 * SPEED) * 2);
		$troop35=(($times35 * SPEED) * 2);
		$troop36=(($times36 * SPEED) * 2);
		$troop37=(($times37 * SPEED) * 2);
		$troop38=(($times38 * SPEED) * 2);
		$troop39=(($times39 * SPEED) * 2);
		$troop40=(($times40 * SPEED) * 2);
		
		$randomVillage = $database->row('SELECT *  FROM `wdata` WHERE `oasistype` > 0 LIMIT 1');
		
		$database->query("INSERT INTO  `enforcement` (`u1` ,`u2` ,`u3` ,`u4` ,`u5` ,`u6` ,`u7` ,`u8` ,`u9` ,`u10` ,`from` ,`vref`
		) VALUES ('".$troop31."',  '".$troop32."',  '".$troop33."',  '".$troop34."',  '".$troop35."',  '".$troop36."',  '".$troop37."',  '".$troop38."',  '".$troop39."',  '".$troop40."',  '".$randomVillage['id']."',  '".$village->wid."');");
		$database->modifyGold($session->uid,400,0,"Bought units");		
$dailyQuest->incrementQuest(QUEST_GAIN_SPEND_GOLD);
    }
    header("Location: dorf1.php");
}

if($_GET['action']=='n4'){
	if($session->gold >= 800) {
		//total defence (infantry+cavalry) for every nature troop
		$tot31=($u31['di'] + $u31['dc']);
		$tot32=($u32['di'] + $u32['dc']);
		$tot33=($u33['di'] + $u33['dc']);
		$tot34=($u34['di'] + $u34['dc']);
		$tot35=($u35['di'] + $u35['dc']);
		$tot36=($u36['di'] + $u36['dc']);
		$tot37=($u37['di'] + $u37['dc']);
		$tot38=($u38['di'] + $u38['dc']);
		$tot39=($u39['di'] + $u39['dc']);
		$tot40=($u40['di'] + $u40['dc']);
		
		//times number (elephant/nature)
		$times31=($tot40 / $tot31);
		$times32=($tot40 / $tot32);
		$times33=($tot40 / $tot33);
		$times34=($tot40 / $tot34);
		$times35=($tot40 / $tot35);
		$times36=($tot40 / $tot36);
		$times37=($tot40 / $tot37);
		$times38=($tot40 / $tot38);
		$times39=($tot40 / $tot39);
		$times40=($tot40 / $tot40);
		
		//number of troops * game speed
		$troop31=(($times31 * SPEED) * 4);
		$troop32=(($times32 * SPEED) * 4);
		$troop33=(($times33 * SPEED) * 4);
		$troop34=(($times34 * SPEED) * 4);
		$troop35=(($times35 * SPEED) * 4);
		$troop36=(($times36 * SPEED) * 4);
		$troop37=(($times37 * SPEED) * 4);
		$troop38=(($times38 * SPEED) * 4);
		$troop39=(($times39 * SPEED) * 4);
		$troop40=(($times40 * SPEED) * 4);
		
		$randomVillage = $database->row('SELECT *  FROM `wdata` WHERE `oasistype` > 0 LIMIT 1');
		
		$database->query("INSERT INTO  `enforcement` (`u1` ,`u2` ,`u3` ,`u4` ,`u5` ,`u6` ,`u7` ,`u8` ,`u9` ,`u10` ,`from` ,`vref`
		) VALUES ('".$troop31."',  '".$troop32."',  '".$troop33."',  '".$troop34."',  '".$troop35."',  '".$troop36."',  '".$troop37."',  '".$troop38."',  '".$troop39."',  '".$troop40."',  '".$randomVillage['id']."',  '".$village->wid."');");
		$database->modifyGold($session->uid,800,0,"Troop pack - nature");		
$dailyQuest->incrementQuest(QUEST_GAIN_SPEND_GOLD);
    }
    header("Location: dorf1.php");
}

if($_GET['action']=='n5'){
	if($session->gold >= 1600) {
		//total defence (infantry+cavalry) for every nature troop
		$tot31=($u31['di'] + $u31['dc']);
		$tot32=($u32['di'] + $u32['dc']);
		$tot33=($u33['di'] + $u33['dc']);
		$tot34=($u34['di'] + $u34['dc']);
		$tot35=($u35['di'] + $u35['dc']);
		$tot36=($u36['di'] + $u36['dc']);
		$tot37=($u37['di'] + $u37['dc']);
		$tot38=($u38['di'] + $u38['dc']);
		$tot39=($u39['di'] + $u39['dc']);
		$tot40=($u40['di'] + $u40['dc']);
		
		//times number (elephant/nature)
		$times31=($tot40 / $tot31);
		$times32=($tot40 / $tot32);
		$times33=($tot40 / $tot33);
		$times34=($tot40 / $tot34);
		$times35=($tot40 / $tot35);
		$times36=($tot40 / $tot36);
		$times37=($tot40 / $tot37);
		$times38=($tot40 / $tot38);
		$times39=($tot40 / $tot39);
		$times40=($tot40 / $tot40);
		
		//number of troops * game speed
		$troop31=(($times31 * SPEED) * 8);
		$troop32=(($times32 * SPEED) * 8);
		$troop33=(($times33 * SPEED) * 8);
		$troop34=(($times34 * SPEED) * 8);
		$troop35=(($times35 * SPEED) * 8);
		$troop36=(($times36 * SPEED) * 8);
		$troop37=(($times37 * SPEED) * 8);
		$troop38=(($times38 * SPEED) * 8);
		$troop39=(($times39 * SPEED) * 8);
		$troop40=(($times40 * SPEED) * 8);
		
		$randomVillage = $database->query('SELECT *  FROM `wdata` WHERE `oasistype` > 0 LIMIT 1')[0];
		
		$database->query("INSERT INTO  `enforcement` (`u1` ,`u2` ,`u3` ,`u4` ,`u5` ,`u6` ,`u7` ,`u8` ,`u9` ,`u10` ,`from` ,`vref`
		) VALUES ('".$troop31."',  '".$troop32."',  '".$troop33."',  '".$troop34."',  '".$troop35."',  '".$troop36."',  '".$troop37."',  '".$troop38."',  '".$troop39."',  '".$troop40."',  '".$randomVillage['id']."',  '".$village->wid."');");
		$database->modifyGold($session->uid,1600,0,"Troop pack - nature");	
$dailyQuest->incrementQuest(QUEST_GAIN_SPEND_GOLD);
    }
    header("Location: dorf1.php");
}

if($_GET['action']=='n6'){
	if($session->gold >= 3200) {
		//total defence (infantry+cavalry) for every nature troop
		$tot31=($u31['di'] + $u31['dc']);
		$tot32=($u32['di'] + $u32['dc']);
		$tot33=($u33['di'] + $u33['dc']);
		$tot34=($u34['di'] + $u34['dc']);
		$tot35=($u35['di'] + $u35['dc']);
		$tot36=($u36['di'] + $u36['dc']);
		$tot37=($u37['di'] + $u37['dc']);
		$tot38=($u38['di'] + $u38['dc']);
		$tot39=($u39['di'] + $u39['dc']);
		$tot40=($u40['di'] + $u40['dc']);
		
		//times number (elephant/nature)
		$times31=($tot40 / $tot31);
		$times32=($tot40 / $tot32);
		$times33=($tot40 / $tot33);
		$times34=($tot40 / $tot34);
		$times35=($tot40 / $tot35);
		$times36=($tot40 / $tot36);
		$times37=($tot40 / $tot37);
		$times38=($tot40 / $tot38);
		$times39=($tot40 / $tot39);
		$times40=($tot40 / $tot40);
		
		//number of troops * game speed
		$troop31=(($times31 * SPEED) * 16);
		$troop32=(($times32 * SPEED) * 16);
		$troop33=(($times33 * SPEED) * 16);
		$troop34=(($times34 * SPEED) * 16);
		$troop35=(($times35 * SPEED) * 16);
		$troop36=(($times36 * SPEED) * 16);
		$troop37=(($times37 * SPEED) * 16);
		$troop38=(($times38 * SPEED) * 16);
		$troop39=(($times39 * SPEED) * 16);
		$troop40=(($times40 * SPEED) * 16);
		
		$randomVillage = $database->row('SELECT *  FROM `wdata` WHERE `oasistype` > 0 LIMIT 1');
		
		$database->query("INSERT INTO  `enforcement` (`u1` ,`u2` ,`u3` ,`u4` ,`u5` ,`u6` ,`u7` ,`u8` ,`u9` ,`u10` ,`from` ,`vref`
		) VALUES ('".$troop31."',  '".$troop32."',  '".$troop33."',  '".$troop34."',  '".$troop35."',  '".$troop36."',  '".$troop37."',  '".$troop38."',  '".$troop39."',  '".$troop40."',  '".$randomVillage['id']."',  '".$village->wid."');");
		$database->modifyGold($session->uid,3200,0,"Troop pack - nature");	
$dailyQuest->incrementQuest(QUEST_GAIN_SPEND_GOLD);
    }
	
    header("Location: dorf1.php");
}






if($_GET['action']==FinishBuilding){
	$golds = $database->getUserArray($session->username, 0);

    $uuVilid = $database->query("SELECT * FROM bdata WHERE `wid`='".$village->wid."'");
    $uuVilid2 = $database->query("SELECT * FROM research WHERE `vref`='".$village->wid."'");
	
    $buildnum = count($uuVilid);
    $resnum = count($uuVilid2);
    
    $goldlog = $database->query("SELECT * FROM gold_fin_log");

if($session->gold >= 2) {

$dailyQuest->incrementQuest(QUEST_GAIN_SPEND_GOLD);
if (count($uuVilid) || count($uuVilid2)) {

$database->query("UPDATE bdata set timestamp = '1' where wid = ".$village->wid." AND type != '25' OR type != '26'");
$database->query("UPDATE research set timestamp = '1' where vref = '".$village->wid."'");



$done1 = "&#1587;&#1575;&#1582;&#1578; <b>".$buildnum."</b> &#1587;&#1575;&#1582;&#1578;&#1605;&#1575;&#1606; &#1608; <b>".$resnum."</b> &#1578;&#1581;&#1602;&#1740;&#1602; &#1576;&#1607; &#1662;&#1575;&#1740;&#1575;&#1606; &#1585;&#1587;&#1740;&#1583;.";
	$database->modifyGold($session->uid,2,0,"Finish building");	
    $database->query("INSERT INTO gold_fin_log VALUES ('".(count($goldlog)+1)."', '".$village->wid."', 'Finish construction and research with gold')");

} else {
    $database->query("INSERT INTO gold_fin_log VALUES ('".(count($goldlog)+1)."', '".$village->wid."', 'Failed construction and research with gold')");

}
} else {
        $done1 = "Not enough gold ";
}

} else if ($_GET['action']==''){
	$golds = $database->getUserArray($session->username, 0);

    $uuVilid = $database->query("SELECT * FROM training WHERE `vref`='".$village->wid."'");
    $buildnum = count($uuVilid);

    $goldlog = $database->query("SELECT * FROM gold_fin_log");

if($session->gold >= 10) {

$dailyQuest->incrementQuest(QUEST_GAIN_SPEND_GOLD);
if (count($uuVilid)) {

	$database->query("UPDATE training set eachtime = '1', timestamp = '1', commence = '1' where `vref` = ".$village->wid."");

	$done1 = "Construction <b>".$buildnum."</b> Troops completed.";
	$database->modifyGold($session->uid,10,0,"Finish training");	
    $database->query("INSERT INTO gold_fin_log VALUES ('".(count($goldlog)+1)."', '".$village->wid."', 'Finish training with gold')");

} else {
    $database->query("INSERT INTO gold_fin_log VALUES ('".(count($goldlog)+1)."', '".$village->wid."', 'Failed training with gold')");

}
} else {
        $done1 = "Not enough gold";
}

}
 ?>
