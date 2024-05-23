<?php
ob_start();
session_start();
require __DIR__.'/GameEngine/config.php';
require __DIR__.'/GameEngine/Database.php';
require __DIR__.'/GameEngine/Generator.php';

$refererStr = parse_str(parse_url($_SERVER['HTTP_REFERER'],PHP_URL_QUERY), $referer);

if ($_SERVER['HTTP_REFERER'] == "" || $referer['id'] < 1 || $referer['id'] > 40 || !$_SESSION || $_SESSION['username'] == '') {
	echo "Hacking attempt.";
	exit; 
}

$mysqli = new mysqli(SQL_SERVER, SQL_USER,SQL_PASS,SQL_DB);
if ($mysqli->connect_error) die('Connect Error (' . $mysqli->connect_errno . ') '.$mysqli->connect_error);

///////////////////////
echo "<pre>";
$buildingsQ= $mysqli->query('SELECT * FROM fdata WHERE vref='.((int)$_SESSION['wid']));
$buildings = $buildingsQ->fetch_assoc();

if ($buildings['f'.((int)$referer['id'])] > 0 && $buildings['f'.((int)$referer['id']).'t']) {
	if (in_array($buildings['f'.((int)$referer['id']).'t'], array(19,20,21,29,30))){
		$building = array(
			"id" 	=> $buildings['f'.((int)$referer['id']).'t'],
			"level" => $buildings['f'.((int)$referer['id'])],
		);
		
		$unarray = array(1=>
		U1,U2,U3,U4,U5,U6,U7,U8,U9,U10,
		U11,U12,U13,U14,U15,U16,U17,U18,U19,U20,
		U21,U22,U23,U24,U25,U26,U27,U28,U29,U30,
		U31,U32,U33,U34,U35,U36,U37,U38,U39,U40,
		U41,U42,U43,U44,U45,U46,U47,U48,U49,U50,
		U51,U52,U53,U54,U55,U56,U57,U58,U59,U60,
		U61,U62,U63,U64,U65,U66,U67,U68,U69,U70,
		U0);
		$type 			= $building['id'] == 19 ? 1 : ($building['id'] == 20 ? 2 : ($building['id'] == 21 ? 3 : ($building['id'] == 29 ? 5  : ($building['id'] == 30 ? 6 : 4))));
		$trainingquery  = $mysqli->query('SELECT * FROM training where vref = '.((int)$_SESSION['wid']).' ORDER BY id');
		$trainingarray 	= $trainingquery->fetch_all(MYSQLI_ASSOC);
		$listarray 		= array();
		$barracks = array(1,2,3,11,12,13,14,21,22,51,52,53,61,62);
		$greatbarracks = array(1,2,3,11,12,13,14,21,22,51,52,53,61,62);//array(61,62,63,71,72,73,74,81,82);
		$stables = array(4,5,6,15,16,23,24,25,26,54,55,56,63,64,65,66);
		$greatstables = array(4,5,6,15,16,23,24,25,26,54,55,56,63,64,65,66);//array(64,65,66,75,76,83,84,85,86);
		$workshop = array(7,8,17,18,27,28,57,58,67,68);
		$residence = array(9,10,19,20,29,30,59,60,69,70);
		
		$totalTime		= 0;

		if(count($trainingarray) > 0) {
			foreach($trainingarray as $train) {
				if($train['amt']>0) { //что б не выводить 0 юнитов
					if ($type == 1 && in_array($train['unit'], $barracks)) {
					$totalTime += $train['eachtime'] * $train['amt'];
						$train['name'] = $unarray[$train['unit']];
						array_push($listarray, $train);
					}
					if ($type == 2 && in_array($train['unit'], $stables)) {
					$totalTime += $train['eachtime'] * $train['amt'];
						$train['name'] = $unarray[$train['unit']];
						array_push($listarray, $train);
					}
					if ($type == 3 && in_array($train['unit'], $workshop)) {
					$totalTime += $train['eachtime'] * $train['amt'];
						$train['name'] = $unarray[$train['unit']];
						array_push($listarray, $train);
					}
					if ($type == 4 && in_array($train['unit'], $residence)) {
					$totalTime += $train['eachtime'] * $train['amt'];
						$train['name'] = $unarray[$train['unit']];
						array_push($listarray, $train);
					}
					if ($type == 5 && in_array($train['unit'], $greatbarracks)) {
					$totalTime += $train['eachtime'] * $train['amt'];
						$train['name'] = $unarray[$train['unit'] - 60];
						array_push($listarray, $train);
					}
					if ($type == 6 && in_array($train['unit'], $greatstables)) {
					$totalTime += $train['eachtime'] * $train['amt'];
						$train['name'] = $unarray[$train['unit'] - 60];
						array_push($listarray, $train);
					}
				}
			}
		}
		echo "Time: ".$totalTime."<br/>";
		$requiredGold = $generator->getGoldForTime($totalTime);
		$userDataQuery= $mysqli->query('SELECT gold FROM users WHERE id='.((int)$_SESSION['id_user']));
		$userGold	  = $userDataQuery->fetch_assoc()['gold'];
		
		echo "Required gold: ".$requiredGold."<br>";
		echo "My gold: ".$userGold;
		
		if ($requiredGold <= $userGold) {
			$ids = array();
			foreach($listarray as $troopArray) {
				$ids[] = $troopArray['id'];
			}
			$mysqli->query("UPDATE training SET timestamp = '".time()."', lastupdate='0' WHERE id IN (".implode(",",$ids).")");
			$database->modifyGold($_SESSION['id_user'],$requiredGold,0,"Finished troop construction");
		} else {
			echo "<hr/>----<a href=\"dorf1.php\">Village overview</a>";
			exit;
		}
	}
}

///////////////////////
$mysqli->close();
header("Location: ".$_SERVER['HTTP_REFERER']);