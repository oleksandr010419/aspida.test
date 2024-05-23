<?php

$gameinstall = 1;



		include_once (dirname(__FILE__)."/../../GameEngine/config.php");

include_once (dirname(__FILE__)."/../../GameEngine/DB.php");

include_once (dirname(__FILE__)."/../../GameEngine/Database/db_MYSQL.php");

include_once (dirname(__FILE__)."/../../GameEngine/Register.php");

			$wid = $database->getBaseID(0,0);

			$uid = 2;



				$database->setFieldTaken($wid);

				$database->addVillage($wid, 2, 'Natureland', '0');

				$database->addResourceFields($wid, $database->getVillageType($wid));

				$database->addUnits($wid);

				$database->addTech($wid);

				$database->addABTech($wid);





$wid = $database->getBaseID(1,1);



if(!empty($_POST['username']) && !empty($_POST['password'])){

    $uid = $regme->register($_POST['username'],md5($_POST['password'].mb_convert_case($_POST['username'],MB_CASE_LOWER,"UTF-8")),"aspidagames@gmail.com",1,'XA',0,6);

}

$frandom0 = rand(0,4);$frandom1 = rand(0,3);$frandom2 = rand(0,4);$frandom3 = rand(0,3);


    $database->setFieldTaken($wid);

    $database->addVillage($wid, $uid, 'Multihunter', '0');

    $database->addResourceFields($wid, $database->getVillageType($wid));

    $database->addUnits($wid);

    $database->addTech($wid);

    $database->addABTech($wid);

if($uid) {

    $database->addHeroFace($uid,$frandom0,$frandom1,$frandom2,$frandom3,$frandom3,$frandom2,$frandom1,$frandom0,$frandom2);

    $database->addHero($uid);

    $database->modifyUnit($wid, array(11), array(1), 1);

    $database->addHeroinventory($uid);

    $database->modifyHero2('wref', $wid, $uid, 0);

    $database->addAdventure($wid, $uid,10);

    $database->query("UPDATE users SET access=9 WHERE id='".$uid."'");

	$database->query("UPDATE users SET IsoCountryCode='XA' WHERE id='".$uid."'");
	
	$database->query("UPDATE users SET gold=999999 WHERE id='".$uid."'");
	
	$database->query("UPDATE users SET desc2='[#multihunter]' WHERE id='".$uid."'");	
}

$gameinstall = 0;

	if(!$doNotRedir)
		header("Location: ../index.php?s=5");