<?php
include_once("../config.php");
include_once("../Data/buidata.php");
include_once("../Database.php");
include_once '../Attacks.php';

global $database;
$isFinished = $database->isFinished();

if(HALT_CRON){
	addToLog("cron","Cron is halted");
	die();
}

if(file_exists((dirname(__FILE__))."/../autoinstall.txt")){
	addToLog("cron","Install in progress - break;");
	die();
}

if(!$isFinished && ARTEFACTS<=time() && !file_exists(dirname(__FILE__)."/../artefacts.txt")) 			{
	addToLog("cron","Setting up artifacts...");
	$ourFileHandle = fopen(dirname(__FILE__)."/../artefacts.txt", 'w');
	fclose($ourFileHandle);
	$_GET['step']=1;
	$fromfile=true;
	include_once(dirname(__FILE__)."/../WowSoHardTofInDandSuchNaTars.php");
}
if(!$isFinished && WW_PLAN<=time()&& !file_exists(dirname(__FILE__)."/../ww_plans.txt")) {
	addToLog("cron","Setting up WW plan villages...");
	$ourFileHandle = fopen(dirname(__FILE__)."/../ww_plans.txt", 'w');
	fclose($ourFileHandle);
	$_GET['step']=3;
	$fromfile=true;
	include_once(dirname(__FILE__)."/../WowSoHardTofInDandSuchNaTars.php");
}
if(!$isFinished && NATARS_TIME<=time()) {
	addToLog("cron","Update Natars WW...");
	$_GET['step']=5;
	$fromfile=true;
	include_once(dirname(__FILE__)."/../WowSoHardTofInDandSuchNaTars.php");
}

if($uids = $database->query("SELECT id FROM users WHERE id>6 AND username NOT LIKE '%Farm%' AND (logtime<".(time()-(60*60*24*7)).") AND logtime<>0")){
	addToLog("cron","There are inactive users...");
	foreach($uids as $uid){
		addToLog("cron","Removing inactive user:".$uid['id']);
		$database->setDeleting($uid['id'],0);
		$database->insertQueue(0,10,time(),(time()+86400),$uid['id']);
	}
}


//end server here
if($database->row("SELECT vref FROM fdata WHERE `f99` = 100 AND (SELECT isFinished from status LIMIT 1) = 0") != false){
	$daysToAdd = 1;
	$finishedDate = time();
	$restartDate = mktime(9,0,0, date('m'), date('d')+$daysToAdd, date('Y'));
	
	$date1 = new DateTime();$date1->setTimestamp($finishedDate);
	$date2 = new DateTime();$date2->setTimestamp($restartDate);
	$diff = $date2->diff($date1);
	$hours = $diff->h;
	addToLog("cron","Perform system finish");
	addToLog("cron",$hours." hours till 9");
	if($diff->y ==0 && $diff->m==0 && $diff->d ==0 && $diff->h <= 24 && $diff->invert){
		$daysToAdd=2;
		$restartDate = mktime(9,0,0, date('m'), date('d')+$daysToAdd, date('Y'));
	}
	
	$database->query("UPDATE status set isFinished=1,finishedTime=".$finishedDate.",restartTime=".$restartDate);
	require_once __DIR__.'/../../../scripts/bank_coupon/main.php';
	require_once __DIR__.'/../../../scripts/prize/main.php';
	$bank = new Bank(SQL_SERVER, SQL_USER, SQL_PASS, SQL_DB, DEFAULT_GOLD, str_replace(' ', '_', SERVER_NAME), OPENING);
	$bank->handleServerEnd();

	$prize = new Prize(SQL_SERVER, SQL_USER, SQL_PASS, SQL_DB, str_replace(' ', '_', SERVER_NAME), OPENING);
	$prize->handleServerEnd();
	
	ob_start();
	addToLog("cron","Copy users...");
	$notify=1;
	include_once (__DIR__.'/../../../scripts/mailer/main.php');	
	addToLog("cron","Send out invitations");	
	addToLog("cron",ob_get_contents());
	ob_end_clean();
}

//perform restart which should clear db and reset isFinished
//$isFinished=$database->row("SELECT * FROM status WHERE `isFinished` = 1");
if($isFinished){
	$now = time();
	$status = $database->getServerStatus();
	$restartDate = $status['restartTime'];
	
	$date1 = new DateTime();$date1->setTimestamp($now);
	$date2 = new DateTime();$date2->setTimestamp($restartDate);
	$diff = $date2->diff($date1);
	$hours = $diff->h;
		
	echo $hours." hours till server start";
	if($diff->y ==0 && $diff->m==0 && $diff->d ==0 && $diff->h <= 12 && $diff->invert || !$diff->invert){
		addToLog("cron","Server will start in less than 12 hours");
		addToLog("cron","Perform autoinstall");
		//perform restart
		$check='7e7ced60d233c88d156f53b0089ac009';
		include_once(dirname(__FILE__)."/../../T_AutoInstall_9/autoinstall.php");
	}
}

addToLog("cron","Queue jobs done");
$database->PerformClose();