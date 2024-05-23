<?php 
require_once((dirname(__FILE__))."/../GameEngine/common.php");
$check='7e7ced60d233c88d156f53b0089ac009';
$checkValue = (isset($check))?$check:((isset($_GET['check']))?$_GET['check']:0);
if(!isset($checkValue) || $checkValue!='7e7ced60d233c88d156f53b0089ac009'){
	addToFileLogAU("I cannot do that...".$checkValue);
	removeLogs();
	die("I cannot do that...");
}
if(isset($_GET['force']) && $_GET['force'] == 1){
	addToFileLogAU("Force restart...");
    @unlink(dirname(__FILE__)."/../GameEngine/autoinstall.txt");
}
require_once((dirname(__FILE__))."/../GameEngine/Database.php");
require_once((dirname(__FILE__))."/../GameEngine/DBBackup/DBBackup.php");
$doNotRedir = true;

//Steps 0-1 not needed - leave config as is
if(!file_exists((dirname(__FILE__))."/../GameEngine/autoinstall.txt")){
	//This whole block is being done 12 hours before server starts
	$fHandle = fopen((dirname(__FILE__))."/../GameEngine/autoinstall.txt", 'w');
	fclose($fHandle); 	
	
	ob_start();
	addToFileLogAU("Copy users...");
	$notify=1;
	include_once(dirname(__FILE__)."/../../scripts/mailer/main.php");	
	addToFileLogAU("Send out invitations");	
	addToFileLogAU(ob_get_contents());
	ob_end_clean();
	
	addToFileLogAU("Save database structure");
	$db = new DBBackup(array(
		'driver' => 'mysql',
		'host' => SQL_SERVER,
		'user' => SQL_USER,
		'password' => SQL_PASS,
		'database' => SQL_DB
	));
	$backup = $db->backup();
	saveToFileLogAU($backup['msg'],OPENING.".sql");
	
	addToFileLogAU("Drop database structure");

	$database->query("SET foreign_key_checks = 0;");

	$database->query("DROP TABLE `a2b`, `abdata`, `achiev`, `activate`, `adventure`, `alidata`, `ali_invite`, `ali_log`, `ali_permission`, `antimult`;");

	$database->query("DROP TABLE `artefacts`, `attacks`, `auction`, `bank`, `banlist`, `bdata`, `CountryTbl`, `critical_log`, `daily_quests`, `demolition`;"); //`buygold`, 

	$database->query("DROP TABLE `diplomacy`, `enforcement`, `farmlist`, `fdata`, `hero`, `heroface`, `heroinventory`, `heroitems`, `links`, `log`, `map_control`, `market`;");

	$database->query("DROP TABLE  `mdata`, `medal`, `movement`, `ndata`, `newproc`, `odata`, `online`, `operation`, `palevo`, `password`, `prisoners`, `queue`, `raidlist`;");

	$database->query("DROP TABLE  `referals`, `research`, `route`, `sitters`, `spravka`,  `tdata`, `training`, `units`, `users`, `vdata`, `wdata`;");

	$database->query("SET foreign_key_checks = 1;");

	//Step 2 - reset db

	addToFileLogAU("Rebuild database structure");

	resetDatabase();

	//Step 3 - fields

	addToFileLogAU("Create map");

	ob_start();

	require_once("include/wdata.php");

	addToFileLogAU(ob_get_contents());

	ob_end_clean();

	//reset time and update config

	addToFileLogAU("Reset start time and isFinished flag");

	if(($status = $database->row("SELECT * FROM status WHERE `isFinished` = 1"))==false){	
		addToFileLogAU("Forced restart...");
		$daysToAdd = 1;
		$finishedDate = time();
		$restartDate = mktime(9,0,0, date('m'), date('d')+$daysToAdd, date('Y'));
		
		$date1 = new DateTime();$date1->setTimestamp($finishedDate);
		$date2 = new DateTime();$date2->setTimestamp($restartDate);
		$diff = $date2->diff($date1);
		$hours = $diff->h;
		if($diff->y ==0 && $diff->m==0 && $diff->d ==0 && $diff->h <= 24 && $diff->invert){
			$daysToAdd=2;
			$restartDate = mktime(9,0,0, date('m'), date('d')+$daysToAdd, date('Y'));
		}
	
		$database->query("INSERT IGNORE INTO `status` (`isFinished`, `finishedTime`, `restartTime`) VALUES (0, NULL, ".$restartDate.")");

		//Set config.php - start time

		updateConfig('define("OPENING",',"define(\"OPENING\", ".$restartDate.")");

		addToFileLogAU("Setting OPENING:".$restartDate);

	}else{		
		addToFileLogAU("Restart after finish...");

		$database->query("UPDATE status set `isFinished`=0,finishedTime=NULL");

		//Set config.php - start time

		updateConfig('define("OPENING",',"define(\"OPENING\", ".$status['restartTime'].")");

		addToFileLogAU("Setting OPENING:".$status['restartTime']);

	}
	updateConfig('define("GAME_ROUND",',"define(\"GAME_ROUND\", ".(GAME_ROUND+1).")");

	require_once((dirname(__FILE__))."/../GameEngine/config.php");

	addToFileLogAU("Current OPENING:".OPENING);
	addToFileLogAU("Current GAME_ROUND:".GAME_ROUND);

	//Step 4 - multihunter

	addToFileLogAU("Setting multihunter");

	$_POST['username'] = "multihunter";

	$_POST['password'] = "!Stratis33!";

	ob_start();

		require_once("include/multihunter.php");

		addToFileLogAU(ob_get_contents());

	ob_end_clean();

	//Step 5 - oasis

	addToFileLogAU("Setting oasis");

	ob_start();

		require_once("include/oasis.php");

		addToFileLogAU(ob_get_contents());

	ob_end_clean();
	
	//remove blocking files

	@unlink(dirname(__FILE__)."/../GameEngine/autoinstall.txt");
	
	@unlink(dirname(__FILE__)."/../GameEngine/artefacts.txt");

	@unlink(dirname(__FILE__)."/../GameEngine/ww_plans.txt");

	@unlink(dirname(__FILE__)."/../GameEngine/error_log");

	@unlink(dirname(__FILE__)."/../error_log");
	
	ob_start();
		@removeLogs();
		@removeCache();
		addToFileLogAU(ob_get_contents());

		file_get_contents('https://www.aspidanetwork.com/ban_system/check_email_domain.php?action=reload');
	ob_end_clean();
		
	addToFileLogAU(" Done.");
	die();
}
else{
	addToFileLogAU("Install in progress...");
}

function resetDatabase(){
	global $database;
	if(!$database->bConnected){
		$database->Connect();
	}
	/*$p_query = file_get_contents(dirname(__FILE__)."/data/sql.sql");

	$p_query = 'START TRANSACTION;' . $p_query . '; COMMIT;';

	$query_split = preg_split ("/[;]+/", $p_query);

	foreach ($query_split as $command_line) {		

		$command_line = trim($command_line);

		if ($command_line != '') {				

			$query_result = $database->query($command_line);

			if ($query_result == 0) {	

				addToFileLogAU($command_line);

				//addToFileLogAU(mysql_error());

			}		

		}

	}*/
	$query_result =$database->importSqlFile(dirname(__FILE__)."/data/sql.sql");
	if ($query_result == 0) {	
		addToFileLogAU("Failed to import database");
	}		
}

function addToFileLogAU($string){ 
	if(DEBUG){
		$myFile = dirname(__FILE__)."/install_log.txt";	$fh = fopen($myFile, 'a') or die("can't open file");	fwrite($fh, date('c', strtotime("now")).':'.$string.PHP_EOL);	fclose($fh);
	}
}

function saveToFileLogAU($content,$filename){ 
	$myFile = dirname(__FILE__)."/backup/".$filename;	$fh = fopen($myFile, 'a') or die("can't open file");	fwrite($fh, date('c', strtotime("now")).':'.$content.PHP_EOL);	fclose($fh);
}

function updateConfig($param,$value){

	$data = file(dirname(__FILE__)."/../GameEngine/config.php");

	$data = array_map(function($data) use($param,$value){

	  return stristr($data,$param) ? $value.";\n" : $data;

	}, $data);

	file_put_contents(dirname(__FILE__)."/../GameEngine/config.php", implode('', $data));

}