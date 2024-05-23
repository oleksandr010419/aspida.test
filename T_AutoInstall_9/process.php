<?php
set_time_limit(0);
ini_set('memory_limit','512M');
	
include_once(__DIR__."/../config.php");
require_once(__DIR__."/../Database.php");
global $database;

class Process {

	function Process($skip=0) {
		if(isset($_POST['subconst'])) {
			$this->constForm();
            header("Location: index.php?s=2");
		} else
			if(isset($_POST['substruc'])) {
				$this->createStruc();
			} else
				if(isset($_POST['subwdata'])) {
					$this->createWdata();
				}  else {
							if(!$skip)header("Location: index.php");
						}
	}

	function constForm() {
		$myFile = "../GameEngine/config.php";
		$fh = fopen($myFile, 'w') or die("<br/><br/><br/>Can't open file:GameEngine/config.php");

		$text = file_get_contents("data/constant_format.tpl");
		$text = preg_replace("'%INSTANTTRAIN%'", $_POST['instant_train'], $text);
		$text = preg_replace("'%INSTANTTRAINMODIFIER%'", $_POST['instant_train_mod'], $text);
		
		$text = preg_replace("'%SERVERNAME%'", $_POST['servername'], $text);
		$text = preg_replace("'%OPENING%'", $_POST['opening'], $text);
		$text = preg_replace("'%SPEED%'", $_POST['speed'], $text);
		$text = preg_replace("'%INCSPEED%'", $_POST['incspeed'], $text);
        $text = preg_replace("'%TRADER%'", $_POST['tradercap'], $text);

		$text = preg_replace("'%STORAGE_MULTIPLIER%'", $_POST['storage_multiplier'], $text);
		$text = preg_replace("'%MAX%'", $_POST['wmax'], $text);
		$text = preg_replace("'%SSERVER%'", $_POST['sserver'], $text);
		$text = preg_replace("'%SUSER%'", $_POST['suser'], $text);
		$text = preg_replace("'%SPASS%'", $_POST['spass'], $text);
		$text = preg_replace("'%SDB%'", $_POST['sdb'], $text);


		$text = preg_replace("'%ARANK%'", $_POST['admin_rank'], $text);
		$text = preg_replace("'%EXTRAMENU%'", $_POST['extra_menu'], $text);
		$text = preg_replace("'%BEGINNER%'", $_POST['beginner'], $text);
		$text = preg_replace("'%HOMEPAGE%'", $_POST['homepage'], $text);
		$text = preg_replace("'%DEMOLISH%'", $_POST['demolish'], $text);
		$text = preg_replace("'%VILLAGE_EXPAND%'", $_POST['village_expand'], $text);
		$text = preg_replace("'%PLUS_TIME%'", $_POST['plus_time'], $text);
		$text = preg_replace("'%PLUS_PRODUCTION%'", $_POST['plus_production'], $text);
		$text = preg_replace("'%TS_THRESHOLD%'", $_POST['ts_threshold'], $text);


        $text = preg_replace("'%MAX_FILES%'", $_POST['MAX_FILES'], $text);
        $text = preg_replace("'%MAX_FILESH%'", $_POST['MAX_FILESH'], $text);
        $text = preg_replace("'%IMGQUALITY%'", $_POST['IMGQUALITY'], $text);
        $text = preg_replace("'%MOMENT_TRAIN%'", $_POST['MOMENT_TRAIN'], $text);
        $text = preg_replace("'%QUEST%'", $_POST['QUEST'], $text);
        //$text = preg_replace("'%ARTEFACTS%'", $_POST['ARTEFACTS'], $text);
       // $text = preg_replace("'%WW_TIME%'", $_POST['WW_TIME'], $text);
       // $text = preg_replace("'%WW_PLAN%'", $_POST['WW_PLAN'], $text);
        $text = preg_replace("'%SELL_CP%'", $_POST['SELL_CP'], $text);
        $text = preg_replace("'%SELL_RES%'", $_POST['SELL_RES'], $text);


        $text = preg_replace("'%COSTRES%'", $_POST['costres'], $text);
        $text = preg_replace("'%DEFGOLD%'", $_POST['defgold'], $text);
        $text = preg_replace("'%HOWRES%'", $_POST['howres'], $text);
        $text = preg_replace("'%COSTCP%'", $_POST['costcp'], $text);
        $text = preg_replace("'%HOWCP%'", $_POST['howcp'], $text);
        $text = preg_replace("'%AUCTIME%'", $_POST['auctime'], $text);
        $text = preg_replace("'%REFPOP%'", $_POST['refpop'], $text);
        $text = preg_replace("'%REFGOLD%'", $_POST['refgold'], $text);
        $text = preg_replace("'%OASISX%'", $_POST['oasisx'], $text);
        $text = preg_replace("'%PRHOUR%'", $_POST['phour'], $text);
        $text = preg_replace("'%CRANNY%'", $_POST['cranny'], $text);
        $text = preg_replace("'%TRAPER%'", round($_POST['speed']/10), $text);
        $text = preg_replace("'%ADVS%'", max($_POST['adv'],1), $text);
		
		$text = preg_replace("'%OFFENSE1_BONUS%'", $_POST['offense1_bonus'], $text);
        $text = preg_replace("'%DEFENCE1_BONUS%'", $_POST['defence1_bonus'], $text);
		
		$text = preg_replace("'%OFFENSE1_COST%'", $_POST['offense1_cost'], $text);
        $text = preg_replace("'%DEFENCE1_COST%'", $_POST['defence1_cost'], $text);
		
		$text = preg_replace("'%OFF_DEF_TIME%'", $_POST['off_def_time'], $text);
		
		$text = preg_replace("'%POP_TO_GET_GOLD%'", $_POST['pop_to_get_gold'], $text);
		
		$text = preg_replace("'%ROUND_LENGTH%'", $_POST['round_length'], $text);
		
		
		
		fwrite($fh, $text);

		if(file_exists("../../GaneEngine/config.php")) {
			header("Location: index.php?s=2");
		} else {
			header("Location: index.php?s=1&c=1");
		}

		fclose($fh);
	}

	function createStruc() {
		@unlink(__DIR__."/../artefacts.txt");
		@unlink(__DIR__."/../ww_plans.txt");
        $p_query = file_get_contents("data/sql.sql");
		$p_query = 'START TRANSACTION;' . $p_query . '; COMMIT;';

            $query_split = preg_split ("/[;]+/", $p_query);
            foreach ($query_split as $command_line) {
                $command_line = trim($command_line);
                if ($command_line != '') {
                    $query_result = $database->query($command_line);
                    if ($query_result == 0) {
                        break;
                    }
                }
            }


		if($query_result) {
			header("Location: index.php?s=3");
		} else {
			header("Location: index.php?s=2&c=1");
		}
	}

	function createWdata() {
		header("Location: include/wdata.php");
	}

}
;

$process = new Process;


