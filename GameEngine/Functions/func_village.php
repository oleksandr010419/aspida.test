<?php 
function checkVillageStatus($vref){
	include (__DIR__."/../Database.php");
	global $session,$database;//,$building,$technology;
	
	//check artifacts
	$resourcearray = $database->getResourceLevel($vref);
	$building = array('main'=>0,'treasury'=>0,'academy'=>0,'smithy'=>0,'stables'=>0,'workshop'=>0,'barracks'=>0);
	
	for($i=18;$i<40;$i++){
		if($resourcearray['f'.$i.'t'] == 27){
			$building['treasury'] = $resourcearray['f'.$i];
		}
		if($resourcearray['f'.$i.'t'] == 22){
			$building['academy'] = $resourcearray['f'.$i];
		}
		if($resourcearray['f'.$i.'t'] == 12){
			$building['smithy'] = $resourcearray['f'.$i];
		}
		if($resourcearray['f'.$i.'t'] == 20){
			$building['stables'] = $resourcearray['f'.$i];
		}
		if($resourcearray['f'.$i.'t'] == 30){
			$building['gstables'] = $resourcearray['f'.$i];
		}
		if($resourcearray['f'.$i.'t'] == 21){
			$building['workshop'] = $resourcearray['f'.$i];
		}
		if($resourcearray['f'.$i.'t'] == 19){
			$building['barracks'] = $resourcearray['f'.$i];
		}
		if($resourcearray['f'.$i.'t'] == 29){
			$building['gbarracks'] = $resourcearray['f'.$i];
		}
		if($resourcearray['f'.$i.'t'] == 15){
			$building['main'] = $resourcearray['f'.$i];
		}
	}
		
	$treasury = $building['treasury'];
	if($treasury < 10 || $database->countOwnedActiveSmallArtefacts($session->uid)>2){
		$database->changeStateAllSmallArtefacts($vref,0);
	}
	if($treasury < 20  || $database->countOwnedActiveLargeArtefacts($session->uid)>1){
		$database->changeStateAllLargeArtefacts($vref,0);
	}
	if($treasury >=10 ){
		//$database->changeStateSmallArtefacts($vref,1);
	}
	if($treasury ==20 ){
		//$database->changeStateLargeArtefacts($vref,1);
	}
	
	//if barracks/stables/workshop/residence - cancel training if level = 0
	$trainingarray = $database->getTraining($vref);
	foreach($trainingarray as $train) {
		if($train['amt']>0 && !meetRRequirement($train['unit'],$building)) {
			$database->deleteTrainingByUnit(array($train['unit']),$vref);
		}
	}
}
function meetRRequirement($tech,$building){
	$b22 = $building['academy'];
	switch($tech) {
		//roman
		case 1:
		case 2:
		case 3:
			if($building['barracks'] >= 1) { return true; } else { return false; }
			break;
		case 201:
		case 202:
		case 203:
			if($building['gbarracks'] >= 1) { return true; } else { return false; }
			break;
		case 4:
		case 5:
		case 6:
			if($building['stables'] >= 1) { return true; } else { return false; }
			break;
		case 204:
		case 205:
		case 206:
			if($building['gstables'] >= 1) { return true; } else { return false; }
			break;
		case 7:
		case 8:
			if($building['workshop'] >= 1) { return true; } else { return false; }
			break;
		case 9:
		case 10:
			return true;
			break;
		//teuton
		case 11:
		case 12:
		case 13:
		case 14:
			if($building['barracks'] >= 1) { return true; } else { return false; }
			break;
		case 211:
		case 212:
		case 213:
		case 214:
			if($building['gbarracks'] >= 1) { return true; } else { return false; }
			break;
		case 15:
		case 16:
			if($building['stables'] >= 1) { return true; } else { return false; }
			break;
		case 215:
		case 216:
			if($building['gstables'] >= 1) { return true; } else { return false; }
			break;
		case 17:
		case 18:
			if($building['workshop'] >= 1) { return true; } else { return false; }
			break;
		case 19:
		case 20:
			return true;
		break;
		//gaul
		case 21:
		case 22:
			if($building['barracks'] >= 1) { return true; } else { return false; }
			break;
		case 221:
		case 222:
			if($building['gbarracks'] >= 1) { return true; } else { return false; }
			break;
		case 23:
		case 24:
		case 25:
		case 26:
			if($building['stables'] >= 1) { return true; } else { return false; }
			break;
		case 223:
		case 224:
		case 225:
		case 226:
			if($building['gstables'] >= 1) { return true; } else { return false; }
			break;
		case 27:
		case 28:
			if($building['workshop'] >= 1) { return true; } else { return false; }
			break;
		case 29:
		case 30:
		return true;
		break;
		//egyptians
		case 51:
		case 52:
		case 53:
			if($building['barracks'] >= 1) { return true; } else { return false; }
			break;
		case 251:
		case 252:
		case 253:
			if($building['gbarracks'] >= 1) { return true; } else { return false; }
			break;
		case 54:
		case 55:
		case 56:
			if($building['stables'] >= 1) { return true; } else { return false; }
			break;
		case 254:
		case 255:
		case 256:
			if($building['gstables'] >= 1) { return true; } else { return false; }
			break;
		case 57:
		case 58:
			if($building['workshop'] >= 1) { return true; } else { return false; }
			break;
		case 59:
		case 60:
		return true;
		break;
		//mongol
		case 61:
		case 62:
			if($building['barracks'] >= 1) { return true; } else { return false; }
			break;
		case 261:
		case 262:
			if($building['gbarracks'] >= 1) { return true; } else { return false; }
			break;
		case 63:
		case 64:
		case 65:
		case 66:
			if($building['stables'] >= 1) { return true; } else { return false; }
			break;
		case 263:
		case 264:
		case 265:
		case 266:
			if($building['gstables'] >= 1) { return true; } else { return false; }
			break;
		case 67:
		case 68:
			if($building['workshop'] >= 1) { return true; } else { return false; }
			break;
		case 69:
		case 70:
		return true;
		break;
		default:
		return true;
	}
	return false;
}
?>