<?php
include_once dirname(__FILE__).'/../Database.php';
include_once dirname(__FILE__).'/../Attacks.php';

include_once dirname(__FILE__).'/../Lib/Mutex/Mutex.php';
use NinjaMutex\Mutex;
include_once dirname(__FILE__).'/../Lib/Mutex/Lock/FlockLock.php';
use NinjaMutex\Lock\FlockLock;

class Cron extends Att
{
	function __construct()
	{
	}

	function DelTrash($id,$type){
		global $database;
		$database->query("DELETE FROM `queue` WHERE `jobID`='" . $id."' and `type`='".$type."'");
	}
	
	static function callWorker($method){
		if(HALT_CRON){
			addToLog("cron","Cron is halted");
			die();
		}
		global $database;
		if (php_sapi_name() != "cgi-fcgi") {
			addToLog("cron","Trying to run this cron from ".php_sapi_name());
			die();
		}
		$database->testAndReconnect();
		
		$starttime = time();
		$startday = date('H:i',$starttime);
		addToLog("cron",$method."_starting cron at ".time()." ".$startday);

		$retry = 0;

		while($startday == date('H:i',time())){
			//addToLog("cron","running for ".(time()-$starttime). " Current time:".date('H:i',time()));
			$cron = new Cron ();
			call_user_func(array($cron, $method));
			$cron = null;
		}
		addToLog("cron",$method."_finished ".date('H:i',time()));
		$database->PerformClose();
		die();
	}

	
	function processQueue(){
		global $database;
		$t = time();
		$queryLock = new Mutex("query",new FlockLock(dirname(__FILE__)));
		if ($queryLock->acquireLock(1000)) {
			$sql = $database->query("SELECT id,if1,jobID,type FROM queue WHERE finish <= '" . $t . "' and status ='0' ORDER BY finish ASC,type ASC FOR UPDATE");
			if(empty($sql)){
				sleep(3);
			}else{
				$this->queue($sql);
				sleep(1);
			}
			$queryLock->releaseLock("query");
		}else{
			addToLog("cron","Other process is working on query");
		}
	}
	
	function processMasterBuilder(){
		$masterLock = new Mutex("master",new FlockLock(dirname(__FILE__)));
		if ($masterLock->acquireLock(1000)) {
			$this->MasterBuilder();
			sleep(2);
			$masterLock->releaseLock("master");
		}else{
			addToLog("cron","Other process is working on master");
		}
	}
	
	function processTradeRoutes(){
		$tradeLock = new Mutex("trade",new FlockLock(dirname(__FILE__)));
		if ($tradeLock->acquireLock(1000)) {
			$this->TradeRoute();
			sleep(2);
			$tradeLock->releaseLock("trade");
		}else{
			addToLog("cron","Other process is working on trade");
		}
	}
	
	function processBuilder(){
		$builderLock = new Mutex("builder",new FlockLock(dirname(__FILE__)));
		if ($builderLock->acquireLock(1000)) {
			$this->Builder();
			$this->traiCom();
			$builderLock->releaseLock("builder");
		}else{
			addToLog("cron","Other process is working on builder");
		}
	}
	
	function processAuctions(){
		global $database;
		$masterLock = new Mutex("auction",new FlockLock(dirname(__FILE__)));
		if ($masterLock->acquireLock(1000)) {
			$database->auctionComplete();
			sleep(2);
			$masterLock->releaseLock("auction");
		}else{
			addToLog("cron","Other process is working on auction");
		}
	}

	function queue($s)
	{
		global $database;

		foreach ($s as $f) {
			switch ($f['type']) {
				case 1: //?????
					if($this->attCom($f['jobID'])){
						//$database->query("DELETE FROM `queue` WHERE `id`='" . $f['id']."'");
					}else{
						//$database->query("INSERT IGNORE INTO critical_log (`id`,`work`,`work_id`,`job_id`) VALUES ('0','?????','" . $f['id']."','".$f['jobID']."')");
					}
					break;
				case 2: //???????
					if($this->returnCom($f['jobID'])){
						$database->query("DELETE FROM `queue` WHERE `id`='" . $f['id']."'");
					}else{
						//$database->query("INSERT IGNORE INTO critical_log (`id`,`work`,`work_id`,`job_id`) VALUES ('0','???????','" . $f['id']."','".$f['jobID']."')");
					}
					break;
				case 3: //???????
					if($this->reiCom($f['jobID'])){
						$database->query("DELETE FROM `queue` WHERE `id`='" . $f['id']."'");
					}else{
						//$database->query("INSERT IGNORE INTO critical_log (`id`,`work`,`work_id`,`job_id`) VALUES ('0','???????','" . $f['id']."','".$f['jobID']."')");
					}
					break;
				case 4: //   ??????
					if($this->settCom($f['jobID'])){
						$database->query("DELETE FROM `queue` WHERE `id`='" . $f['id']."'");
					}else{
						//$database->query("INSERT IGNORE INTO critical_log (`id`,`work`,`work_id`,`job_id`) VALUES ('0','??????','" . $f['id']."','".$f['jobID']."')");
					}
					break;
				case 6: //   ????????
					if($this->researchComplete($f['jobID'])){
						$database->query("DELETE FROM `queue` WHERE `id`='" . $f['id']."'");
					}else{
						//$database->query("INSERT IGNORE INTO critical_log (`id`,`work`,`work_id`,`job_id`) VALUES ('0','????????','" . $f['id']."','".$f['jobID']."')");
					}
					break;
				case 7: //   ????? ????????
					if($this->marketComplete($f['jobID'])){
						$database->query("DELETE FROM `queue` WHERE `id`='" . $f['id']."'");
					}else{
						//$database->query("INSERT IGNORE INTO critical_log (`id`,`work`,`work_id`,`job_id`) VALUES ('0','????? ?1','" . $f['id']."','".$f['jobID']."')");
					}
					break;
				case 8: //   ????? ??????? ? ?2/?3 ?????????
					if($this->Market2($f['jobID'])){
						$database->query("DELETE FROM `queue` WHERE `id`='" . $f['id']."'");
					}else{
						//$database->query("INSERT IGNORE INTO critical_log (`id`,`work`,`work_id`,`job_id`) VALUES ('0','????? ?2/3','" . $f['id']."','".$f['jobID']."')");
					}
					break;
				case 9: //   ???? ??????
					if($this->demolitionComplete($f['jobID'])){
						$database->query("DELETE FROM `queue` WHERE `id`='" . $f['id']."'");
					}else{
						//$database->query("INSERT IGNORE INTO critical_log (`id`,`work`,`work_id`,`job_id`) VALUES ('0','???? ??????','" . $f['id']."','".$f['jobID']."')");
					}
					break;
				case 10: //   ???????? ????????
					if($this->clearDeleting($f['if1'])){
						$database->query("DELETE FROM `queue` WHERE `id`='" . $f['id']."'");
					}else{
						//$database->query("INSERT IGNORE INTO critical_log (`id`,`work`,`work_id`,`job_id`) VALUES ('0','???????? ????????','" . $f['id']."','".$f['jobID']."')");
					}
					break;
				case 11: //   ????????? ??????
					if($this->reviveHero($f['jobID'], $f['if1'])){
						$database->query("DELETE FROM `queue` WHERE `id`='" . $f['id']."'");
					}else{
						//$database->query("INSERT IGNORE INTO critical_log (`id`,`work`,`work_id`,`job_id`) VALUES ('0','????????? ?????','" . $f['id']."','".$f['jobID']."')");
					}
					break;
				case 13:
					if($this->sendAdventuresComplete($f['jobID'])){
						$database->query("DELETE FROM `queue` WHERE `id`='" . $f['id']."'");
					}else{
						//$database->query("INSERT IGNORE INTO critical_log (`id`,`work`,`work_id`,`job_id`) VALUES ('0','???????????','" . $f['id']."','".$f['jobID']."')");
					}
					break;
			}
		}
	}
}