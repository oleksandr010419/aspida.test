<?php
require dirname(__FILE__)."/cronClass.php";

if(file_exists((dirname(__FILE__))."/../autoinstall.txt")){
	addToLog("cron","Install in progress - break;");
	die();
}
Cron::callWorker("processAuctions");
?>