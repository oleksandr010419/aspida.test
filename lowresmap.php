<?php
include_once("GameEngine/Database.php");
include_once "GameEngine/Village.php";
$queue = array();
$maxTilesH = 8;
$maxTilesW = 8;

if(isset($_POST['data'])) {
$data = $_POST['data'];
$x = $data['x'];
$y = $data['y'];

	if(isset($data['width'])) {
		$screenW = $data['width'];
		$screenH = $data['height'];
		
		$maxTilesH = (int)($screenH/56);
		$maxTilesW = (int)($screenW/56);
	}
}
else {
$y = $village->coor['y'];
$x = $village->coor['x'];
}

$maxY = (int)($maxTilesH/2);
$maxX = (int)($maxTilesW/2);
$yarray = $xarray = $ids = array();


for($i=$maxY;$i>=-$maxY;$i--){//+1
    $tmp = $y+$i;
	$yarray[] = $tmp;
}

for($i=-$maxY;$i<=$maxY;$i++){
    $tmp = $x+$i;
	$xarray[] = $tmp;
}

$x1 = $xarray[0];
$x2 = $xarray[count($xarray)-1];
$y1 = $yarray[0];
$y2 = $yarray[count($yarray)-1];

if($x2<$x1){
	$tmp = $x2;
	$x2 = $x1;
	$x1 = $tmp;
}
if($y2<$y1){
	$tmp = $y2;
	$y2 = $y1;
	$y1 = $tmp;
}

$maparray=$database->query("
SELECT w.*,IF(v.owner IS NULL, o.owner,v.owner) as owner,IF(v.pop IS NULL,0, v.pop) as pop,IF(v.name IS NULL,'oasis', v.name) as name,
IF(u_vil.alliance IS NULL,u_oasis.alliance,u_vil.alliance) as alliance,IF(u_vil.tribe IS NULL,u_oasis.tribe,u_vil.tribe) as tribe,IF(u_vil.username IS NULL,u_oasis.username,u_vil.username) as username,
u_oasis.username as o_user,IF(v.owner IS NULL, a_oas.tag , a.tag) as tag
    FROM ((((((wdata as w
     LEFT JOIN vdata as v ON v.wref = w.id)
     LEFT JOIN odata as o ON o.wref = w.id )
     LEFT JOIN users as u_oasis ON o.owner = u_oasis.id)
     LEFT JOIN users as u_vil ON v.owner = u_vil.id)
     LEFT JOIN alidata as a ON a.id = u_vil.alliance)
     LEFT JOIN alidata as a_oas ON a_oas.id = u_oasis.alliance) "
        //."where w.x IN (".implode(',',$xarray).") AND w.y IN (".implode(',',$yarray).")"
		."where (w.x between ".$x1." AND ".$x2." AND w.y BETWEEN ".$y1." AND ".$y2.") ORDER BY w.y DESC,w.x ASC"
);	

$tiles = array();
foreach($maparray as $tile){
	$tiles[$tile['x']][$tile['y']] = $tile;
}

$fx=$fy=$lx=$ly = null;
$html ="";
foreach($yarray as $ty){
	
	$html.= '<div class="tileRow">';
	foreach($xarray as $tx){		
		
		$maptile = $tiles[$tx][$ty];
		$xx = $maptile['x'];
		$yy = $maptile['y'];
		
		if(empty($fx)){
			$fx=$xx;
			$fy=$yy;
		}
		
		$lx = $xx;
		$ly = $yy;
		
		$background = (($xx>=-21 && $xx<=21) && ($yy>=-21 && $yy<=21))?'ash':'grassland';
		$is_volcano = false;
		$volcano = $background;
		if((($xx>=-2 && $xx<=2) && ($yy>=-2 && $yy<=2)))
		{
			$is_volcano = true;
			if ($xx==-1 && $yy==1){$volcano .= '-vulcano-11';
			}elseif ($xx==0 && $yy==1){$volcano .= '-vulcano01';
			}elseif ($xx==1 && $yy==1){$volcano .= '-vulcano11';
			}elseif ($xx==-2 && $yy==0){$volcano .= '-vulcano-20';
			}elseif ($xx==-1 && $yy==0){$volcano .= '-vulcano-10';
			}elseif ($xx==0 && $yy==0){$volcano .= '-vulcano00';
			}elseif ($xx==1 && $yy==0){$volcano .= '-vulcano10';
			}elseif ($xx==2 && $yy==0){$volcano .= '-vulcano20';
			}elseif ($xx==-2 && $yy==-1){$volcano .= '-vulcano-2-1';
			}elseif ($xx==-1 && $yy==-1){$volcano .= '-vulcano-1-1';
			}elseif ($xx==0 && $yy==-1){$volcano .= '-vulcano0-1';
			}elseif ($xx==1 && $yy==-1){$volcano .= '-vulcano1-1';
			}elseif ($xx==2 && $yy==-1){$volcano .= '-vulcano2-1';
			}elseif ($xx==-2 && $yy==-2){$volcano .= '-vulcano-2-2';
			}elseif ($xx==-1 && $yy==-2){$volcano .= '-vulcano-1-2';
			}elseif ($xx==0 && $yy==-2){$volcano .= '-vulcano0-2';
			}elseif ($xx==1 && $yy==-2){$volcano .= '-vulcano1-2';
			}elseif ($xx==2 && $yy==-2){$volcano .= '-vulcano2-2';}
		}
		
		
		$oasistype="-oasis".getvaley_class($maptile['oasistype']);
		if(!empty($maptile['type_of'])){
			$background.='-'.$maptile['type_of'];
		}
		
		$tribename = "";
		if($maptile['tribe']==4 || empty($maptile['tribe'])){$maptile['tribe']=1;}
		if ($maptile['tribe'] > 0) {
			$tribename = constant('TRIBE' . $maptile['tribe']);
		}
		$allyname = '';
		if ($maptile['alliance'] != 0) {
			$allyname = $maptile['tag'];
		} 
		$username = $oasisowner = $maptile['username'];
		
		
		$tt = getvaley_tt($maptile['fieldtype'],$maptile['occupied']);
		$targetXYText = '(' . $xx . "|" . $yy . ')';
		
		if($maptile['fieldtype'] > 0 && $maptile['oasistype'] == 0 && $maptile['occupied'] > 0) {
			if($maptile['occupied'] > 0){
				$background.='-village-village'.$maptile['tribe'];
				
				if ($maptile['fieldtype'] > 0 && $maptile['occupied'] == 1) {
					$title = "<font color='white'><b>" .map_village. ": " . $maptile['name'] . "</b></font><br>" . $targetXYText . "<br>" . PLAYER . ": " . $username . "<br>" . POPULATION . ": " . $maparray[$i]['pop'] . "<br>" . ALLIANCE . ": " . $allyname . "<br>" . TRIBE . ": " . $tribename . "";
				}
			}else{
				$title = "<font color='white'><b>" . ABANDONEDVALLEY . " " . $tt . "</b></font><br>" . $targetXYText;
			}
		}
		else if($maptile['fieldtype'] == 0 && $maptile['oasistype'] > 0) {
			if($maptile['owner'] <= 3){
				$background.='-oasis'.$oasistype.'-free';
				$title = "<font color='white'><b>" . UNOCCUPIEDOASIS . "</b></font><br />" . $targetXYText . $tt . "";
			}
			else{
				$background.='-oasis'.$oasistype.'-occupied';
				$title = "<font color='white'><b>" . OCCUPIEDOASIS . "</b></font><br />" . $targetXYText . "<br />" . $tt . "<br>" . PLAYER . ": " . $username . "<br>" . ALLIANCE . ": " . $allyname . "<br>" . TRIBE . ": " . $tribename . "";
			}
		}
		else{
			$title=$targetXYText;
		}
		
		/*if($i%$maxTilesW == 0){
			$html.= '<div class="tileRow">';
		}*/
		
		if($maptile['occupied'] == 0 && $is_volcano){
			$background =$volcano;
		}
		
		$html.=  '<div class="tile tile-'.$maptile['id'].' x{'.$xx.'} y{'.$yy.'} '.$background.'" title="'.$title.'"></div>';
		/*if($i%$maxTilesW == ($maxTilesW-1)){
			$html.=  '<div class="clear"></div></div>';
		}*/				
	}
	$html.=  '<div class="clear"></div></div>';
}
$html.=  '
<div class="ruler x">
	<div class="rulerContainer">';
			foreach(range($fx,$lx) as $xxx){
				$html.=  '<div class="coordinate zoom1">'.$xxx.'</div>';
			}
$html.=  '		<div class="clear"></div>
	</div>
</div>
<div class="ruler y">
	<div class="rulerContainer">';
			foreach(range($fy,$ly) as $yyy){
				$html.=  '<div class="coordinate zoom1">'.$yyy.'</div>';
			}
$html.=  '		<div class="clear"></div>';
$html.=  '			
	</div>
</div>';
if($is_ajax){
	echo json_encode( array('response' => array('error'=>false,'errorMsg'=>null,'data' => array("html"=> $html))) );
}
else{
	echo $html;
}

function getvaley_class($oasistype){
	switch ($oasistype) {
		case 1:
			return 2;
		case 2:
			return 4;
		case 3:
			return 3;
		case 4:
			return 6;
			break;
		case 5:
			return 8;
			break;
		case 6:
			return 7;
		case 7:
			return 10;
		case 8:
			return 12;
		case 9:
			return 11;
		case 10:
			return 10;
		case 11:
			return 14;
		case 12:
			return 15;
	}
}
function getvaley_tt($fieldtype,$oasistype){
	$tt="";
	if ($oasistype == 0) {
		switch ($fieldtype) {
			case 1:
				$tt = "<br>3-3-3-9";
				break;
			case 2:
				$tt = "<br>3-4-5-6";
				break;
			case 3:
				$tt = "<br>4-4-4-6";
				break;
			case 4:
				$tt = "<br>4-5-3-6";
				break;
			case 5:
				$tt = "<br>5-3-4-6";
				break;
			case 6:
				$tt = "<br>1-1-1-15";
				break;
			case 7:
				$tt = "<br>4-4-3-7";
				break;
			case 8:
				$tt = "<br>3-4-4-7";
				break;
			case 9:
				$tt = "<br>4-3-4-7";
				break;
			case 10:
				$tt = "<br>3-5-4-6";
				break;
			case 11:
				$tt = "<br>4-3-5-6";
				break;
			case 12:
				$tt = "<br>5-4-3-6";
				break;
		}
	} else {
		switch ($oasistype) {
			case 1:
				$tt = "<br><img class='r1' src='img/x.gif' /> " . WOOD . " 25%";
				break;
			case 2:
				$tt = "<br><img class='r1' src='img/x.gif' /> " . WOOD . " 50%";
				break;
			case 3:
				$tt = "<br><img class='r1' src='img/x.gif' /> " . WOOD . " 25%<br><img class='r4' src='img/x.gif' /> " . CROP . " 25%";
				break;
			case 4:
				$tt = "<br><img class='r2' src='img/x.gif' /> " . CLAY . " 25%";
				break;
			case 5:
				$tt = "<br><img class='r2' src='img/x.gif' /> " . CLAY . " 50%";
				break;
			case 6:
				$tt = "<br><img class='r2' src='img/x.gif' /> " . CLAY . " 25%<br><img class='r4' src='img/x.gif' /> " . CROP . " 25%";
				break;
			case 7:
				$tt = "<br><img class='r3' src='img/x.gif' /> " . IRON . " 25%";
				break;
			case 8:
				$tt = "<br><img class='r3' src='img/x.gif' /> " . IRON . " 50%";
				break;
			case 9:
				$tt = "<br><img class='r3' src='img/x.gif' /> " . IRON . " 25%<br><img class='r4' src='img/x.gif' /> " . CROP . " 25%";
				break;
			case 10:
			case 11:
				$tt = "<br><img class='r4' src='img/x.gif' /> " . CROP . " 25%";
				break;
			case 12:
				$tt = "<br><img class='r4' src='img/x.gif' /> " . CROP . " 50%";
				break;
		}
	}
	return $tt;
}