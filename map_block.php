<?php
set_time_limit(0);
ini_set('memory_limit', '-1');
session_start();
ob_start("ob_gzhandler");
include("GameEngine/Database.php");

error_reporting(0);
$queue = array();


$x0 = $_GET['tx0'];
$y0 = $_GET['ty0'];
$x1 = $_GET['tx1'];
$y1 = $_GET['ty1'];

//$database->query("INSERT IGNORE into map_images values (0,'".$x0."','".$y0."','".$x1."','".$y1."',0)");

$nob = $x1 - $x0 + 1;

$checkzoom= abs(abs($x1)-abs($x0))+1;

if($checkzoom<10){$nob=10;}
if($checkzoom>13 && $checkzoom<24){$nob=20;}
$noc = $nob/2;

$x = floor($x0+$noc);
$y = floor($y0+$noc-1);
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
        //."where w.x IN (".implode(',',$xarray).") AND w.y IN (".implode(',',$yarray).")"
		."where (w.x between ".$x1." AND ".$x2." AND w.y BETWEEN ".$y1." AND ".$y2.")"
);
$tiles = array();
$hash_data=$x0.$x1.$y0.$y1.$nob;
foreach($maparray as $tile){
	$tiles[$tile['x']][$tile['y']] = $tile;
	
	if(!isset($tile['pop']) || $tile['pop']<0 ){
        $popclass = 'pop';
    } elseif($tile['pop']<100){
        $popclass .= '99';
    } elseif($tile['pop']<250){
        $popclass .= '249';
    } elseif($tile['pop']<500){
        $popclass .= '499';
    } else {
        $popclass .= '500';
    }
	$hash_data.=$tile['owner'].$tile['o_ow'].$tile['tribe'].$tile['occupied'].$popclass;
}
$hash=md5($hash_data);

if($database->count_files("mcache/")>MAX_FILES){
    $folder="mcache/";
    unset($folder);
}
@mkdir("mcache/");
//$control=$database->MapVersionControl($x0,$x1,$y0,$y1);
//if(count($control)){
//    if($control['hash']!=$hash){
//        $database->MapVersionUpdate($x0,$x1,$y0,$y1,$hash);
//    }
//}else{
//    $database->MapVersionStartControl($x0,$x1,$y0,$y1,$hash);
//}

$file = "mcache/".$hash.".jpg";
$nareadis=22;
if(file_exists($file)) {
//if(false){
    header('Content-type: image/jpeg');
    if(isset($_GET['cache'])){
        header('Cache-Control: public,max-age=6000');
    }else{
        header('Cache-Control: public,max-age=20');
    }
    header('Pragma:');
    echo file_get_contents(	$file );
    //unlink($file);
}else{
	foreach($yarray as $ty){
		foreach($xarray as $tx){			
			if(!isset($tiles[$tx][$ty])){
				$bgimgclass1 = 'img/m/gressland/grassland'.(mt_rand(0,6)).'.png';
				array_push($queue,array($bgimgclass1, 'pop',false,null,false,'tilespbgimg',null,array('x'=>0,'y'=>0)));
				continue;
			}else{
				$tile = $tiles[$tx][$ty];
				$tile['zerodis'] = sqrt(($tile['x']*$tile['x'])+($tile['y']*$tile['y']));
				if ($tile['zerodis']<=$nareadis) {$tile['isgraytile']=true;} else {$tile['isgraytile']=false;}

				$tribe = 0;
				if($tile['occupied'] > 0) {
					$tribe = $tile['tribe'];
				}

				$bgimgclass0 = 'tilespbgimg';
				$bgimgclass1 = $bgimgclass2='';

				if($tribe==4){$tribe=1;}
				$popclass = 't'.$tribe.'p';

				if($tile['isgraytile']){
					if ($tile['x']==-1 && $tile['y']==1){$bgimgclass2 = ' 1';
					}elseif ($tile['x']==0 && $tile['y']==1){$bgimgclass2 = ' 2';
					}elseif ($tile['x']==1 && $tile['y']==1){$bgimgclass2 = ' 3';
					}elseif ($tile['x']==-2 && $tile['y']==0){$bgimgclass2 = ' 4';
					}elseif ($tile['x']==-1 && $tile['y']==0){$bgimgclass2 = ' 5';
					}elseif ($tile['x']==0 && $tile['y']==0){
						$bgimgclass2 = ' 6';
						$wallclass = '';
						$popclass = 'pop';
					}elseif ($tile['x']==1 && $tile['y']==0){$bgimgclass2 = ' 7';
					}elseif ($tile['x']==2 && $tile['y']==0){$bgimgclass2 = ' 8';
					}elseif ($tile['x']==-2 && $tile['y']==-1){$bgimgclass2 = ' 9';
					}elseif ($tile['x']==-1 && $tile['y']==-1){$bgimgclass2 = ' 10';
					}elseif ($tile['x']==0 && $tile['y']==-1){$bgimgclass2 = ' 11';
					}elseif ($tile['x']==1 && $tile['y']==-1){$bgimgclass2 = ' 12';
					}elseif ($tile['x']==2 && $tile['y']==-1){$bgimgclass2 = ' 13';
					}elseif ($tile['x']==-2 && $tile['y']==-2){$bgimgclass2 = ' 14';
					}elseif ($tile['x']==-1 && $tile['y']==-2){$bgimgclass2 = ' 15';
					}elseif ($tile['x']==0 && $tile['y']==-2){$bgimgclass2 = ' 16';
					}elseif ($tile['x']==1 && $tile['y']==-2){$bgimgclass2 = ' 17';
					}elseif ($tile['x']==2 && $tile['y']==-2){$bgimgclass2 = ' 18';
					}else{
						for($rc=0;$rc<3;$rc++){
							for($tc=0;$tc<3;$tc++){
								$cx = $tile['x']+$tc-1;
								$cy = $tile['y']-$rc+1;
								$cdis = sqrt(($cx*$cx)+($cy*$cy));
								if ($cdis<=$nareadis) {	$bgimgclass0 .= '1';} else {$bgimgclass0 .= '0';}
							}
						}
					}
				}
				if($bgimgclass0=='tilespbgimg100110100' || $bgimgclass0=='tilespbgimg001011001' || $bgimgclass0=='tilespbgimg111010000'){
					$tile['isgraytile']=false;
					$bgimgclass0='tilespbgimg';
				}
				if(!isset($tile['pop']) || $tile['pop']<0){
					$popclass = 'pop';
				} elseif($tile['pop']<100){
					$popclass .= '99';
				} elseif($tile['pop']<250){
					$popclass .= '249';
				} elseif($tile['pop']<500){
					$popclass .= '499';
				} else {
					$popclass .= '500';
				}


				$lol=0;
				$bgimgclass1 = $tile['image'];
				if($tile['fieldtype']==0 && $tile['o_ow']!=2){$bgimgclass1 ='img/m/'.$tile['image'].'o.gif';}elseif($tile['oasistype']==0){
					$bgimgclass1 = 'img/m/gressland/grassland'.(substr($bgimgclass1, 1)).'.png';
					$lol=1;
				}
				else{ 
					$bgimgclass1 ='img/m/'.$tile['image'].'.gif';
				}
				$oaimg='';
				if($tile['type_of']){
					$oaimg=array('img/m/'.$tile['type_of'].'/'.$tile['type_of'].$tile['oasisimg'].'.png',explode('_',$tile['partimg']));
				}
				array_push($queue,array($bgimgclass1, $popclass,$lol,$oaimg,$tile['isgraytile'],$bgimgclass0,$bgimgclass2,array('x'=>$tile['x'],'y'=>$tile['y'])));
		}
    }
}

//die;

//die;
	$img = imagecreatetruecolor($_GET['w'],$_GET['h']);
	$lgreen = imagecolorallocate($img, 195,237,174);

	imagefill($img, 0, 0, $lgreen);
//block backgrounds
    $x = 0;
    $y = 0;
    $n = 0;
    $nx = $nob;
    $ny = $nob;
    $bw = $_GET['w']/$nx;
    $bh = $_GET['h']/$ny;
    foreach($queue as $block) {


       if(!$block[4]) {
            if(!$block[2] && empty($block[3])){
            imagecopyresized($img, imagecreatefromgif($block[0]), $x, $y, 0, 0, $bw, $bh, 60, 60);
        }else{
                imagecopyresized($img, imagecreatefrompng($block[0]), $x, $y, 0, 0, $bw, $bh, 60, 60);
    }
        }
        if($block[4]) {
            imagecopyresized($img, imagecreatefrompng('img/m/grey.png'), $x, $y, 0, 0, $bw, $bh, 60, 60);
        }
        if($block[5]!='tilespbgimg'){
            imagecopyresized($img, imagecreatefromgif('img/m/'. $block[5] .'.gif'), $x, $y, 0, 0, $bw, $bh, 60, 60);
        }elseif(!empty($block[6])){
            switch($block[6]){
                case 1: imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 60, 0, $bw, $bh, 60, 60);
                    break;
                case 2:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 120, 0, $bw, $bh, 60, 60);
                    break;
                case 3:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 180, 0, $bw, $bh, 60, 60);
                    break;
                case 4:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 0, 60, $bw, $bh, 60, 60);
                    break;
                case 5:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 60, 60, $bw, $bh, 60, 60);
                    break;
                case 6:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 120, 60, $bw, $bh, 60, 60);

                    break;
                case 7:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 180, 60, $bw, $bh, 60, 60);
                    break;
                case 8:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 240, 60, $bw, $bh, 60, 60);
                    break;
                case 9:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 0, 120, $bw, $bh, 60, 60);
                    break;
                case 10:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 60, 120, $bw, $bh, 60, 60);
                    break;
                case 11:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 120, 120, $bw, $bh, 60, 60);
                    break;
                case 12:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 180, 120, $bw, $bh, 60, 60);
                    break;
                case 13:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 240, 120, $bw, $bh, 60, 60);
                    break;
                case 14:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 0, 180, $bw, $bh, 60, 60);
                    break;
                case 15:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 60, 180, $bw, $bh, 60, 60);
                    break;
                case 16:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 120, 180, $bw, $bh, 60, 60);
                    break;
                case 17:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 180, 180, $bw, $bh, 60, 60);
                    break;
                case 18:imagecopyresized($img, imagecreatefrompng('img/m/volcano.png'), $x, $y, 240, 180, $bw, $bh, 60, 60);
                    break;
            }
        }

        if($block[1]!='pop'){
            imagecopyresized($img, imagecreatefromgif('img/m/'. $block[1] .'.gif'), $x, $y, 0, 0, $bw, $bh, 60, 60);
        }
        if(!empty($block[3])){
            imagecopyresized($img, imagecreatefrompng($block[3][0]), $x, $y, $block[3][1][0], $block[3][1][1], $bw, $bh, 60, 60); //если это оазис
            imagecopyresized($img, imagecreatefromgif($block[0]), $x, $y, 0, 0, $bw, $bh, 60, 60); //иконка оазов

        }

        $x += $bw;
        $n++;

        if( $n % $nx == 0 ) { $y += $bh;$x = 0; };

    }
    //die;

	imagejpeg($img,$file,IMGQUALITY);
	imagedestroy($img);
	header('Content-type: image/jpeg');
	if(isset($_GET['cache'])){
		header('Cache-Control: public,max-age=6000');
	}else{
		header('Cache-Control: public,max-age=20');
	}
	header('Pragma:');
	echo file_get_contents($file);
}