<?php

define('QUEST_ADVENTURE', 				'adventure');
define('QUEST_RAID_OASIS', 				'raid_oasis');
define('QUEST_RAID_ATTACK_NATARS', 		'raid_attack_natars');
define('QUEST_AUCTION', 				'auction');
define('QUEST_GAIN_SPEND_GOLD', 		'gain_spend_gold');
define('QUEST_UPGRADE_BUILDING', 		'upgrade_building');
define('QUEST_UPGRADE_RESOURCE', 		'upgrade_resource');
define('QUEST_BUILD_INFANTRY', 			'build_infantry');
define('QUEST_BUILD_CAVALRY', 			'build_cavalry');
define('QUEST_CELEBRATION', 			'celebration');
define('QUEST_VOTE', 					'vote');


require_once __DIR__.'/config.php';
require_once __DIR__.'/Database.php';
class DailyQuest {
	var $userId;
	var $database;
	
	function __construct($userId) {
		global $database;
		$this->userId = $userId;
		$this->database = new DB();
	}
	function incrementQuest($witch){
		$this->createQuest();
		$this->database->query("UPDATE daily_quests SET ".$witch." = ".$witch." + 1 WHERE userId = ".$this->userId);
	}
	function claimReward($rewardId){
		$this->database->query("UPDATE daily_quests SET reward".$rewardId." = 1 WHERE userId = ".$this->userId);
	}
	function getQuests() {
		$q = $this->database->row("SELECT * FROM daily_quests WHERE userId = ".$this->userId);
		return $q;
	}
	function createQuest() {
		$q2 = $this->database->query("SELECT * FROM daily_quests WHERE userId = ".$this->userId);
		if (count($q2) < 1) {
			$q = $this->database->query("INSERT IGNORE INTO daily_quests( userId, adventure, raid_oasis, raid_attack_natars, auction, gain_spend_gold, upgrade_building, upgrade_resource, build_infantry, build_cavalry, celebration) VALUES ('".$this->userId."', 0,0,0,0,0,0,0,0,0,0)");
		}
	}
	function __destruct(){
		$this->database=null;
	}
}