<?php
if(!$fromfile){header('Content-Type: text/html; charset=UTF-8'); die("Open this file can only be another file.");}
set_time_limit(0);
$amt = 13;
$uid=3;
if($_GET['step']==1){
    /**
     * SMALL ARTEFACTS
     */

    /**
     * THE ARCHITECTS
     */
    for ($kid = 1; $kid <=4; $kid++) {
        if ($kid == 1) {
            Artefact($uid, 1, 3, 'Hemons Scrolls', $kid);
			Artefact($uid, 8, 1, 'Pendant of Mischief', $kid);
        }
        if ($kid == 2) {
            Artefact($uid, 2, 3, 'Pheidippides Sandals', $kid);
			Artefact($uid, 4, 3, 'King Arthur\'s Chalice', $kid);
        }
        if ($kid == 3) {
            Artefact($uid, 3, 3, 'Diary of Sun Tzu', $kid);
			Artefact($uid, 7, 3, 'Trojan Horse', $kid);
        }
        if ($kid == 4) {
            Artefact($uid, 5, 3, 'Memoirs of Alexander the Great', $kid);
			Artefact($uid, 8, 3, 'Forbidden Manuscript', $kid);
        }

        Artefact($uid, 1, 1, 'Diamond Chisel', $kid);
        Artefact($uid, 1, 2, 'Giant Marble Hammer', $kid);
		Artefact($uid, 4, 1, 'Silver Platter', $kid);
		Artefact($uid, 4, 2, 'Sacred Hunting Bow', $kid);
		Artefact($uid, 7, 1, 'Map of the Hidden Caverns', $kid);
		Artefact($uid, 7, 2, 'Bottomless Satchel', $kid);
        /**
         * MILITARY HASTE
         */
        Artefact($uid, 2, 1, 'Opal Horseshoe', $kid);
        Artefact($uid, 2, 2, 'Golden Chariot', $kid);
        /**
         * HAWK'S EYESIGHT
         */
        Artefact($uid, 3, 1, 'Tale of a Rat', $kid);
        Artefact($uid, 3, 2, 'Generals Letter', $kid);
        Artefact($uid, 5, 1, 'Scribed Soldiers Oath', $kid);
        Artefact($uid, 5, 2, 'Declaration of War', $kid);
        /**
         * STORAGE MASTER PLAN
         */
        Artefact($uid, 6, 1, 'Builders Sketch', $kid);
        Artefact($uid, 6, 2, 'Babylonian Tablet', $kid);
		
		/*Village wide (Silver Platter) – 50% reduction in crop consumption
		Account wide (Sacred Hunting Bow) – 25% reduction in crop consumption
		Unique (King Arthur's Chalice) – 50% reduction in crop consumption
		
		Village wide (Map of the Hidden Caverns) – Cranny capacity increased by 200%. Treasury can be targeted and hit.
		Account wide (Bottomless Satchel) – Cranny capacity increased by 100%. Treasury can be targeted and hit.
		Unique (Trojan Horse) – Cranny capacity increased by 500%.

		This artifact changes its effect every 24 hours, and can get any of the effects of other artifacts (except building plans for World Wonders, Great Granaries, and Great Warehouses). The effect scope (village or account) is randomly decided every 24 hours. Additionally, the magnitude of the effect is random (such as a 2x effect, 1.5x effect, 0.5x effect, etc.).

		Small artifacts of this type may also get negative effects. For example, troops might move slower, or they might consume more food. Unique artifact of this type may only get positive effects. For both types of artifacts the magnitude of the effect is still random. 

		Small (Pendant of Mischief) – positive and negative effects are possible.
		Unique (Forbidden Manuscript) – Only positive effects are possible.
		
		*/




    }
	$database->setArtefactOfTheFoolEffect();

}elseif($_GET['step']==3){


    for($i=1;$i<=$amt;$i++) {

        $kid += 1;
        if($kid>4){
            $kid=1;}
        $wid = $database->generateBase($kid);
        $database->setFieldTaken($wid);
        $time = time();
        $coo=$database->getWInfo($wid);
        $q = "INSERT  into vdata (`wref`,`owner`,`name`,`capital`,`pop`,`cp`,`celebration`,`type`,`wood`,`clay`,`iron`,`maxstore`,`crop`,`maxcrop`,`lastupdate`,`loyalty`,`exp1`,`exp2`,`exp3`,`created`,`vx`,`vy`,`vtype`) values ('$wid','3','WW Buildingplan',0,230,0,0,0,80000.00,80000.00,80000.00,80000,80000.00,80000,1314974534,100,0,0,0,1314968914,".$coo['x'].",".$coo['y'].",".$coo['fieldtype'].")";
        $database->query($q);
        $q = "INSERT  into fdata (`vref`,`f1`,`f1t`,`f2`,`f2t`,`f3`,`f3t`,`f4`,`f4t`,`f5`,`f5t`,`f6`,`f6t`,`f7`,`f7t`,`f8`,`f8t`,`f9`,`f9t`,`f10`,`f10t`,`f11`,`f11t`,`f12`,`f12t`,`f13`,`f13t`,`f14`,`f14t`,`f15`,`f15t`,`f16`,`f16t`,`f17`,`f17t`,`f18`,`f18t`,`f19`,`f19t`,`f20`,`f20t`,`f21`,`f21t`,`f22`,`f22t`,`f23`,`f23t`,`f24`,`f24t`,`f25`,`f25t`,`f26`,`f26t`,`f27`,`f27t`,`f28`,`f28t`,`f29`,`f29t`,`f30`,`f30t`,`f31`,`f31t`,`f32`,`f32t`,`f33`,`f33t`,`f34`,`f34t`,`f35`,`f35t`,`f36`,`f36t`,`f37`,`f37t`,`f38`,`f38t`,`f39`,`f39t`,`f40`,`f40t`,`f99`,`f99t`,`wwname`) values ($wid,0,1,0,4,0,1,0,3,0,2,0,2,0,3,0,4,0,4,0,3,0,3,0,4,0,4,0,1,0,4,0,2,0,1,0,2,20,17,20,11,10,27,20,10,10,22,10,25,0,0,20,15,10,19,0,0,0,0,0,0,10,23,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,16,0,0,0,0,'World Wonder')";
        $database->query($q);
        $database->addUnits($wid);
        $database->addTech($wid);
        $database->addABTech($wid);
        $database->query("UPDATE units SET u1 = " . (rand(2000, 4000) * $speed) . ", u2 = " . (rand(3000, 4000) * $speed) . ", u3 = " . (rand(4600, 5600) * $speed) . ", u4 = " . (rand(50, 150) * $speed) . ", u5 = " . (rand(2400, 3800) * $speed) . ", u6 = " . (rand(3000, 4000) * $speed) . ", u7 = " . (rand(1000, 1800) * $speed) . ", u8 = " . (rand(200, 600) * $speed) . " , u9 = " . (rand(2, 10) * $speed) . ", u10 = " . (rand(2, 10) * $speed) . " WHERE vref = " . $wid . "");
        $database->addArtefact($wid, 3, 11, 1);
    }

}elseif($_GET['step']==4){
    $speed=80000;
    $database->query("UPDATE units SET u1 = " . (rand(2000, 4000) * $speed) . ", u2 = " . (rand(3000, 4000) * $speed) . ", u3 = " . (rand(4600, 5600) * $speed) . ", u4 = " . (rand(50, 150) * $speed) . ", u5 = " . (rand(2400, 3800) * $speed) . ", u6 = " . (rand(3000, 4000) * $speed) . ", u7 = " . (rand(1000, 1800) * $speed) . ", u8 = " . (rand(200, 600) * $speed) . " , u9 = " . (rand(2, 10) * $speed) . ", u10 = " . (rand(2, 10) * $speed) . " WHERE vref =  20201");


}elseif($_GET['step']==5){
    addToFileLogNatars("=======================================================");
	$wid = null; 
	$q = "SELECT vref FROM fdata fd JOIN vdata vd ON fd.vref=vd.wref where fd.f99>=1 AND vd.owner=3 and vd.name = 'World Wonder' LIMIT 0,1";
	if($wid = $database->single($q)){	
        addToFileLogNatars("Natars village with WW is:".$wid);

		$res = "SELECT `wood`,`clay`,`iron`,`crop`, (SELECT f99 FROM fdata where vref='$wid') as currentlvl FROM vdata where wref='$wid' LIMIT 0,1";
		$resources = $database->row($res);
		
		$lvl = $resources['currentlvl'] + 1;		
		$id = 99;
		$tid = 40;
		$name = "bid".$tid;
		global $$name;
		$dataarray = $$name;
		$buildJob = $database->getJobs($wid);
		
		if($lvl<=100 && $resources['wood']>=$dataarray[$lvl]['wood'] && $resources['clay']>=$dataarray[$lvl]['clay'] && $resources['iron']>=$dataarray[$lvl]['iron'] && $resources['crop']>=$dataarray[$lvl]['crop'] && !count($buildJob)){
			addToFileLogNatars(print_r($dataarray[$lvl],true));
			
			$buildTime = (time() + $dataarray[$lvl]['time'] / SPEED * 2);
			$database->addBuilding($wid,$id,$tid,0,$buildTime,$lvl,0,0);
			$database->modifyResource($wid,$dataarray[$lvl]['wood'],$dataarray[$lvl]['clay'],$dataarray[$lvl]['iron'],$dataarray[$lvl]['crop'],0);		
			//reset troops
			$database->query("UPDATE units SET u1 = " . (1.8E19 / 2) . ", u2 = " . (1.8E19 / 2) . ", u3 = " . (1.8E19 / 2) . ", u4 = " . (1.8E19 / 2) . ", u5 = " . (1.8E19 / 2) . ", u6 = " . (1.8E19 / 2) . ", u7 = " . (1.8E19 / 2) . ", u8 = " . (1.8E19 / 2) . " , u9 = " . (2147483647) . ", u10 = " . (2147483647) . " WHERE vref = " . $wid . "");	
            addToFileLogNatars("Upgrading to lvl".$lvl."Building till:".date('c',$buildTime));
		}else{
            
            if(count($buildJob)){
				//assume only one
				$job = $buildJob[0];
            	addToFileLogNatars("Already upgrading to lvl:".$job['level'].".Time done at:".date('c',$job['timestamp']));      	
            }else{
            	addToFileLogNatars(print_r($resources,true));
            	addToFileLogNatars(print_r($dataarray[$lvl],true));
            	addToFileLogNatars("Not enought resourecs or max level - waiting");            	
            }
        }
	}else{
        addToFileLogNatars("Natars village does not exist. Building...");
		$kid = rand(1, 4);
		$wid = $database->generateBase($kid);
		$database->setFieldTaken($wid);
		$time = time();
		$coo=$database->getWInfo($wid);
		$q = "INSERT  into vdata (`wref`,`owner`,`name`,`capital`,`pop`,`cp`,`celebration`,`type`,`wood`,`clay`,`iron`,`maxstore`,`crop`,`maxcrop`,`lastupdate`,`loyalty`,`exp1`,`exp2`,`exp3`,`created`,`vx`,`vy`,`vtype`) values ('$wid','3','World Wonder',0,230,0,0,0,8000000,8000000,8000000,1010000,8000000,1010000,1314974534,100,0,0,0,1314968914,".$coo['x'].",".$coo['y'].",".$coo['fieldtype'].")";
		$database->query($q);
		$q = "INSERT  into fdata (`vref`,`f1`,`f1t`,`f2`,`f2t`,`f3`,`f3t`,`f4`,`f4t`,`f5`,`f5t`,`f6`,`f6t`,`f7`,`f7t`,`f8`,`f8t`,`f9`,`f9t`,`f10`,`f10t`,`f11`,`f11t`,`f12`,`f12t`,`f13`,`f13t`,`f14`,`f14t`,`f15`,`f15t`,`f16`,`f16t`,`f17`,`f17t`,`f18`,`f18t`,`f19`,`f19t`,`f20`,`f20t`,`f21`,`f21t`,`f22`,`f22t`,`f23`,`f23t`,`f24`,`f24t`,`f25`,`f25t`,`f26`,`f26t`,`f27`,`f27t`,`f28`,`f28t`,`f29`,`f29t`,`f30`,`f30t`,`f31`,`f31t`,`f32`,`f32t`,`f33`,`f33t`,`f34`,`f34t`,`f35`,`f35t`,`f36`,`f36t`,`f37`,`f37t`,`f38`,`f38t`,`f39`,`f39t`,`f40`,`f40t`,`f99`,`f99t`,`wwname`) values ($wid,20,1,20,4,20,1,20,3,20,2,20,2,20,3,20,4,20,4,20,3,20,3,20,4,20,4,20,1,20,4,20,2,20,1,20,2,20,17,20,39,1,15,20,38,10,22,10,25,0,0,0,0,10,19,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,16,0,0,1,40,'World Wonder')";
		$database->query($q);
		$database->addUnits($wid);
		$database->addTech($wid);
		$database->addABTech($wid);
		$database->query("UPDATE units SET u1 = " . (1.8E19 / 2) . ", u2 = " . (1.8E19 / 2) . ", u3 = " . (1.8E19 / 2) . ", u4 = " . (1.8E19 / 2) . ", u5 = " . (1.8E19 / 2) . ", u6 = " . (1.8E19 / 2) . ", u7 = " . (1.8E19 / 2) . ", u8 = " . (1.8E19 / 2) . " , u9 = " . (2147483647) . ", u10 = " . (2147483647) . " WHERE vref = " . $wid . "");
		
		/*$database->sendMessage($session->uid, 6, 
						"Free Gold Recieved",
                        "Natars are trying to build World Wonder!You must beat them to it!" ,
                         0, 0, 0, 0);*/
	}
	
	$info=$database->WowSoQueryV($wid);
	$infvil=array('loyalty'=>$info['loyalty'],'pop'=>$info['pop'],'lastupdate'=>$info['lastupdate'],'maxstore'=>$info['maxstore'],'maxcrop'=>$info['maxcrop'],'uid'=>$info['owner'],'lastup'=>$info['lastupdate']);
    $usin=array(); $usin['tribe']=0;    $usin['b1']=0; $usin['b2']=0; $usin['b3']=0; $usin['b4']=0;
	//$unitall1 = $database->getAllUnits($this->wid,0,1,$session->tribe,$this->unitarray,$this->oasisowned,$this->enforce);
	
	$database->processProduction($wid,$info,$infvil,array(),$usin,array(),null);
}



    function addToFileLogNatars($string){
        $myFile = dirname(__FILE__)."/natars_test_log.txt";
        $fh = fopen($myFile, 'a') or die("can't open file");
        fwrite($fh, date('c', strtotime("now")).':'.$string.PHP_EOL);
        fclose($fh);
    }

    function buildNow($wid,$field,$type,$level){
     global $database,$bid18,$session,$village;
     $q = "UPDATE fdata set f".$jobs['field']." = ".$jobs['level'].", f".$jobs['field']."t = ".$jobs['type']." where vref = '".$jobs['wid']."'";
     $database->query($q); 
    }
    function Artefact($uid, $type, $size, $village_name, $kid)
    {
        addToFileLogNatars("adding ".$village_name);
        global $database;
        $speed = (SPEED==10?1:round(SPEED/100)); //если и менять,то чуть ниже,в функции,надо тож менять значение
        $wid = $database->generateNatarBase($kid,($size == 3));
        $database->addArtefact($wid, $uid, $type, $size);
        $database->setFieldTaken($wid);
        $database->addVillage($wid, $uid, $village_name, '0', 163);
        $database->addResourceFields($wid, $database->getVillageType($wid));
        $database->addUnits($wid);
        $database->addTech($wid);
        $database->addABTech($wid);
        $database->setVillageField($wid, "name", $village_name);
        if ($size == 1) {
            $database->query("UPDATE units SET u1 = " . (rand(1000, 2000) * $speed) . ", u2 = " . (rand(1500, 2000) * $speed) . ", u3 = " . (rand(2300, 2800) * $speed) . ", u4 = " . (rand(25, 75) * $speed) . ", u5 = " . (rand(1200, 1900) * $speed) . ", u6 = " . (rand(1500, 2000) * $speed) . ", u7 = " . (rand(500, 900) * $speed) . ", u8 = " . (rand(100, 300) * $speed) . " , u9 = " . (rand(1, 5) * $speed) . ", u10 = " . (rand(1, 5) * $speed) . " WHERE vref = " . $wid . "");
            $database->query("UPDATE fdata SET f22t = 27, f22 = 10, f28t = 25, f28 = 10, f19t = 23, f19 = 10, f32t = 23, f32 = 10 WHERE vref = $wid");
        } elseif ($size == 2) {
            $database->query("UPDATE units SET u1 = " . (rand(2000, 4000) * $speed) . ", u2 = " . (rand(3000, 4000) * $speed) . ", u3 = " . (rand(4600, 5600) * $speed) . ", u4 = " . (rand(50, 150) * $speed) . ", u5 = " . (rand(2400, 3800) * $speed) . ", u6 = " . (rand(3000, 4000) * $speed) . ", u7 = " . (rand(1000, 1800) * $speed) . ", u8 = " . (rand(200, 600) * $speed) . " , u9 = " . (rand(2, 10) * $speed) . ", u10 = " . (rand(2, 10) * $speed) . " WHERE vref = " . $wid . "");
            $database->query("UPDATE fdata SET f22t = 27, f22 = 20, f28t = 25, f28 = 20, f19t = 23, f19 = 10, f32t = 23, f32 = 10 WHERE vref = $wid");
        } elseif ($size == 3) {
            $database->query("UPDATE units SET u1 = " . (rand(4000, 8000) * $speed) . ", u2 = " . (rand(6000, 8000) * $speed) . ", u3 = " . (rand(9200, 11200) * $speed) . ", u4 = " . (rand(100, 300) * $speed) . ", u5 = " . (rand(4800, 7600) * $speed) . ", u6 = " . (rand(6000, 8000) * $speed) . ", u7 = " . (rand(2000, 3600) * $speed) . ", u8 = " . (rand(400, 1200) * $speed) . " , u9 = " . (rand(4, 20) * $speed) . ", u10 = " . (rand(4, 20) * $speed) . " WHERE vref = " . $wid . "");
            $database->query("UPDATE fdata SET f22t = 27, f22 = 20, f28t = 25, f28 = 20, f19t = 23, f19 = 10, f32t = 23, f32 = 10 WHERE vref = $wid");
        }
    }