<?php
session_start();

include("GameEngine/Database.php");
if(empty($_COOKIE['lang'])){$language="ru";}else{$language=$_COOKIE['lang'];}
include("GameEngine/Lang/" . $language . ".php");
if($_GET){
	if(isset($_GET['cmd'])){
		header('Content-Type:application/json; charset=UTF-8;');
		switch($_GET['cmd']) {
			case 'mapInfo':
                $block="";
                /*foreach($_POST['data'] as $p){
					$x0 = $p['position']['x0'];
					$y0 = $p['position']['y0'];
					$x1 = $p['position']['x1'];
					$y1 = $p['position']['y1'];
					$nob = $x1 - $x0 + 1;

					$checkzoom= abs(abs($x1)-abs($x0))+1;

					if($checkzoom<10){$nob=10;}
					if($checkzoom>13 && $checkzoom<24){$nob=20;}
					$noc = $nob/2;

					$x = $x0+$noc;
					$y = $y0+$noc-1;

					$yarray = $xarray = $ids = array();

					for($i=$noc;$i>=-$noc-1;$i--){
						$tmp = $y+$i;
						$yarray[] = $tmp;
					}

					for($i=-$noc;$i<=$noc-1;$i++){
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
					SELECT w.*,IF(v.owner IS NULL, o.owner,v.owner) as owner,IF(v.pop IS NULL,0, v.pop) as pop,IF(o.owner IS NULL,0, o.owner) as o_ow,IF(u_vil.tribe IS NULL,0,u_vil.tribe) as tribe
						FROM (((wdata as w
						 LEFT JOIN vdata as v ON v.wref = w.id)
						 LEFT JOIN odata as o ON o.wref = w.id )
						 LEFT JOIN users as u_vil ON v.owner = u_vil.id) "
							."where (w.x between ".$x1." AND ".$x2." AND w.y BETWEEN ".$y1." AND ".$y2.")"
					);

					$hash=md5($x0.$x1.$y0.$y1.$nob);
					foreach($maparray as $m){
						if(!isset($m['pop']) || $m['pop']<=0){
							$popclass = 'pop';
						} elseif($m['pop']<100){
							$popclass .= '99';
						} elseif($m['pop']<250){
							$popclass .= '249';
						} elseif($m['pop']<500){
							$popclass .= '499';
						} else {
							$popclass .= '500';
						}
						$hash=md5($hash.$m['owner'].$m['o_ow'].$m['tribe'].$m['occupied'].$popclass);
					}
					$control=$database->MapVersionControl($x0,$x1,$y0,$y1);
					if(count($control)){
						if($control['hash']!=$hash){
							$database->MapVersionUpdate($x0,$x1,$y0,$y1,$hash);
							$control['version']++;
						}
					}else{
						$database->MapVersionStartControl($x0,$x1,$y0,$y1,$hash);
						$control['version']=0;
					}
					$block.= '"'.$x0.'":{"'.$y0.'":{"'.$x1.'":{"'.$y1.'":{"version":"'.$control["version"].'&cache"}}}},';
				}
				$block = (substr($block, 0, -1));*/
				$block = '"blocks":[]';//'"blocks":{'.$block.'';
				echo '{"response": {"error":false,"errorMsg":null,"data":{"elements":[],'.$block.'}}}';
			break;
			case 'mapPositionData':
				$tiles = array();

				$x = $_POST['data']['x'];
				$y = $_POST['data']['y'];
				$noc = 6;
				$yarray = $xarray = $ids = array();


				for($i=$noc;$i>=-$noc-1;$i--){
					$tmp = $y+$i;
					$yarray[] = $tmp;
				}

				for($i=-$noc;$i<=$noc-1;$i++){
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
						."where (w.x between ".$x1." AND ".$x2." AND w.y BETWEEN ".$y1." AND ".$y2.")"
				);


				for($i=0;$i<=99;$i++) {
					$targetalliance = 0;
					$tribe = -1;
					$username = $oasisowner = $tribename = $text= '';
					if($maparray[$i]['type_of']=='' || $maparray[$i]['oasistype']>0) {

						if ($maparray[$i]['occupied'] > 0) {
							$targetalliance = $maparray[$i]['alliance'];
							$tribe = $maparray[$i]['tribe'];
							$username = $oasisowner = $maparray[$i]['username'];
						}


						$targettitle = '';
						if ($tribe > 0) {
							$tribename = constant('TRIBE' . $tribe);
						}
						if ($maparray[$i]['oasistype'] == 0) {
							switch ($maparray[$i]['fieldtype']) {
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
							switch ($maparray[$i]['oasistype']) {
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

						if ($targetalliance != 0) {
							$allyname = $maparray[$i]['tag'];
						} else {
							$allyname = '';
						}

						$uinfo = $maparray[$i]['o_user'];
						$targetXYText = '(' . $maparray[$i]['x'] . "|" . $maparray[$i]['y'] . ')';
						if ($maparray[$i]['fieldtype'] > 0 && $maparray[$i]['occupied'] == 1) {
							$targettitle = "<font color='white'><b>" .map_village. ": " . $maparray[$i]['name'] . "</b></font><br>" . $targetXYText . "<br>" . PLAYER . ": " . $username . "<br>" . POPULATION . ": " . $maparray[$i]['pop'] . "<br>" . ALLIANCE . ": " . $allyname . "<br>" . TRIBE . ": " . $tribename . "";
						}
						if ($maparray[$i]['oasistype'] == 0 && $maparray[$i]['occupied'] == 0) {
							$targettitle = "<font color='white'><b>" . ABANDONEDVALLEY . " " . $tt . "</b></font><br>" . $targetXYText;
						}

						if ($maparray[$i]['fieldtype'] == 0 && $maparray[$i]['oasistype'] > 0 && $maparray[$i]['occupied'] == 0) {
							$targettitle = "<font color='white'><b>" . UNOCCUPIEDOASIS . "</b></font><br />" . $targetXYText . $tt . "";
						} elseif ($maparray[$i]['fieldtype'] == 0 && $maparray[$i]['oasistype'] > 0 && $maparray[$i]['occupied'] > 0) {
							$targettitle = "<font color='white'><b>" . OCCUPIEDOASIS . "</b></font><br />" . $targetXYText . "<br />" . $tt . "<br>" . PLAYER . ": " . $uinfo . "<br>" . ALLIANCE . ": " . $allyname . "<br>" . TRIBE . ": " . $tribename . "";

						}

						$text = $targettitle;
					}else{
						$text= '(' . $maparray[$i]['x'] . "|" . $maparray[$i]['y'] . ')';
					}

							array_push($tiles,	array("x"=>$maparray[$i]['x'],"y"=>$maparray[$i]['y'],"c"=>'',"t"=>$text));

				}


				echo json_encode( array('response' => array('error'=>false,'errorMsg'=>null,'data' => array("tiles"=>$tiles))) );
				break;
		}
	}

}
