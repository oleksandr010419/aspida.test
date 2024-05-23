<?php
include_once (dirname(__FILE__)."/../../GameEngine/config.php");
include_once (dirname(__FILE__)."/../../GameEngine/DB.php");
include_once (dirname(__FILE__)."/../../GameEngine/Database/db_MYSQL.php");
set_time_limit(0);
ini_set('memory_limit', '-1');
//кол-во чуд
$amt = 13;
$speed = (SPEED==10?1:round(SPEED/100)); 
//серая зона
$nareadis=22;
$database->query("SET TRANSACTION ISOLATION LEVEL SERIALIZABLE");
$database->starttransaction();
$xyas=(1+(2*WORLD_MAX));

for($i=0; $i<$xyas; $i++){
    $q="INSERT into wdata values ";
$y=(WORLD_MAX-$i);

	for($j=0; $j<$xyas; $j++){
	$x=((WORLD_MAX*-1)+$j);

	//choose a field type
	if($x == 0 && $y == 0 || $x==1 && $y==1){
		$typ='3';
		$otype='0';
	}else{
	$rand=rand(1, 1000);
		if("10" >= $rand){
		$typ='1';
		$otype='0';
		} else if("90" >= $rand){
		$typ='2';
		$otype='0';
		} else if("400" >= $rand){
		$typ='3';
		$otype='0';
		} else if("480" >= $rand){
		$typ='4';
		$otype='0';
		} else if("560" >= $rand){
		$typ='5';
		$otype='0';
		} else if("570" >= $rand){
		$typ='6';
		$otype='0';
		} else if("600" >= $rand){
		$typ='7';
		$otype='0';
		} else if("630" >= $rand){
		$typ='8';
		$otype='0';
		} else if("660" >= $rand){
		$typ='9';
		$otype='0';
		} else if("740" >= $rand){
		$typ='10';
		$otype='0';
		} else if("820" >= $rand){
		$typ='11';
		$otype='0';
		} else if("900" >= $rand){
		$typ='12';
		$otype='0';
		} else if("908" < $rand){
            $typ='3';
            $otype='0';

		}
	}
	//image pick
//	if($otype=='0'){
		$image="t".rand(0,9)."";
	//} else {
	//	$image="o".$otype."";
	//}
//
		//into database
		$q .= "(0,'".$typ."','".$otype."','".$x."','".$y."',0,'".$image."',0,'',0,''),";

	}
    $q = (substr($q, 0, -1));

    $database->query($q);
}
$database->commitq();


$database->setFieldTaken($database->getBaseID(0,0)); //забиваем клетку 0/0
$database->setFieldTaken($database->getBaseID(1,1)); //забиваем клетку 1/1

    //ебашим стольню натар на 1|0
function generateBase($kid, $uid, $username)
{
    global $database;

    $wid = $database->getBaseID(1,0);
    $database->setFieldTaken($wid);
    $database->addVillage($wid, $uid, $username, 1, 888);
    $database->addResourceFields($wid, $database->getVillageType($wid));
    $database->addUnits($wid);
    $database->addTech($wid);
    $database->addABTech($wid);
    return $wid;
}


/**
 * Creating account & capital village
 */
$username = "Natars";
$password = md5("superparoldlyanatar");
$email = "natars@noreply.com";
$tribe = 5;
$desc = "********************
					[#natars]
				********************";

$q = "INSERT INTO users (id,username,password,email,timestamp,tribe,IsoCountryCode,protect,desc2) VALUES (3, '" . $username . "', '" . $password . "', '" . $email . "', " . time() . ", 5, 'XA', 0,'" . $desc . "')";
$database->query($q);
$database->query("UPDATE users SET IsoCountryCode='XA' WHERE id='".$uid."'");
unset($q);
$uid = 3;
$wid = generateBase(0, $uid, $username);
$frandom0 = rand(0,4);$frandom1 = rand(0,3);$frandom2 = rand(0,4);$frandom3 = rand(0,3);


$database->addHeroFace($uid,$frandom0,$frandom1,$frandom2,$frandom3,$frandom3,$frandom2,$frandom1,$frandom0,$frandom2);
$database->addHero($uid);
$database->addHeroinventory($uid);
$spe = 888888;

$q3 = "UPDATE units SET u1 = " . (34700 * $spe) . ", u2 = " . (29531 * $spe) . ", u3 = " . (18747 * $spe) . ", u4 = " . (7 * $spe) . ", u5 = " . (34401 * $spe) . ", u6 = " . (21602 * $spe) . ", u7 = " . (2034 * $spe) . ", u8 = " . (1040 * $spe) . " , u9 = " . (1 * $spe) . ", u10 = " . (9 * $spe) . " WHERE vref = " . $wid . "";
$database->query($q3);

//добавляем чуды
$kid=0;
$wwids=array($database->getBaseID(-100,100),
     $database->getBaseID(-100,-100),
     $database->getBaseID(100,-100),
     $database->getBaseID(100,100),
    $database->getBaseID(100,0),
    $database->getBaseID(-100,0),
    $database->getBaseID(0,100),
    $database->getBaseID(0,-100));
foreach($wwids as $wid){
    $database->setFieldTaken($wid);
    $coo=$database->getWInfo($wid);
    $time = time();
    $q = "INSERT  into vdata (`wref`,`owner`,`name`,`capital`,`pop`,`cp`,`celebration`,`type`,`wood`,`clay`,`iron`,`maxstore`,`crop`,`maxcrop`,`lastupdate`,`loyalty`,`exp1`,`exp2`,`exp3`,`created`,`natar`,`vx`,`vy`,`vtype`) values ('$wid','3','WW village',0,233,0,0,0,80000.00,80000.00,80000.00,80000,80000.00,80000,1314974534,100,0,0,0,$time,1,".$coo['x'].",".$coo['y'].",".$coo['fieldtype'].")";
    $database->query($q);
    $q = "INSERT  into fdata (`vref`,`f1`,`f1t`,`f2`,`f2t`,`f3`,`f3t`,`f4`,`f4t`,`f5`,`f5t`,`f6`,`f6t`,`f7`,`f7t`,`f8`,`f8t`,`f9`,`f9t`,`f10`,`f10t`,`f11`,`f11t`,`f12`,`f12t`,`f13`,`f13t`,`f14`,`f14t`,`f15`,`f15t`,`f16`,`f16t`,`f17`,`f17t`,`f18`,`f18t`,`f19`,`f19t`,`f20`,`f20t`,`f21`,`f21t`,`f22`,`f22t`,`f23`,`f23t`,`f24`,`f24t`,`f25`,`f25t`,`f26`,`f26t`,`f27`,`f27t`,`f28`,`f28t`,`f29`,`f29t`,`f30`,`f30t`,`f31`,`f31t`,`f32`,`f32t`,`f33`,`f33t`,`f34`,`f34t`,`f35`,`f35t`,`f36`,`f36t`,`f37`,`f37t`,`f38`,`f38t`,`f39`,`f39t`,`f40`,`f40t`,`f99`,`f99t`,`wwname`) values ($wid,0,1,0,4,0,1,0,3,0,2,0,2,0,3,0,4,0,4,0,3,0,3,0,4,0,4,0,1,0,4,0,2,0,1,0,2,20,17,20,11,20,15,20,10,10,22,10,25,0,0,0,0,10,19,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,16,0,0,0,40,'World Wonder')";
    $database->query($q);
    $database->addUnits($wid);
    $database->addTech($wid);
    $database->addABTech($wid);

    $database->query("UPDATE units SET u1 = " . (rand(2000, 4000) * $speed) . ", u2 = " . (rand(3000, 4000) * $speed) . ", u3 = " . (rand(4600, 5600) * $speed) . ", u4 = " . (rand(50, 150) * $speed) . ", u5 = " . (rand(2400, 3800) * $speed) . ", u6 = " . (rand(3000, 4000) * $speed) . ", u7 = " . (rand(1000, 1800) * $speed) . ", u8 = " . (rand(200, 600) * $speed) . " , u9 = " . (rand(2, 10) * $speed) . ", u10 = " . (rand(2, 10) * $speed) . " WHERE vref = " . $wid . "");

}



function setOasis($otype,$type,$ftype,$img,$x,$y,$force_adv=false){
	global $database;
	$is_adv = !(rand(0,12)%4==0);
	if($force_adv || $is_adv){
		$quero="`adv`='1',`type_of`='".$ftype."'";
	}else{
		$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='".$ftype."'";
	}
	
	$database->query("UPDATE wdata SET $quero, `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '".$img."' WHERE `x` = '".$x."' and `y` = '".$y."'");               
}
function setOasisByID($otype,$type,$ftype,$img,$id,$force_adv=false){
	global $database;
	$is_adv = !(rand(0,12)%4==0);
	if($force_adv || $is_adv){
		$quero="`adv`='1',`type_of`='".$ftype."'";
	}else{
		$quero=" `oasistype`='".$otype."',`fieldtype`='0',`type_of`='".$ftype."'";
	}
	
	$database->query("UPDATE wdata SET $quero, `oasisimg` = '".$type."',`image` ='o".$otype."' , `partimg` = '".$img."' WHERE `id` = '".$id."'");               
}

function exist($x,$y,$_kk,$kk,$_ii,$ii){
    global $database;
    $maparray0="";
    for($i=$_ii;$i<=$ii;$i++){
        for($k=$_kk;$k<=$kk;$k++){
            $xx=$database->WPosition($x,$k);
            $yy=$database->WPosition($y,$i);
            $id=$database->getBaseID($xx,$yy);
            $maparray0 .= '\''.$id.'\',';
            if(in_array($xx,array(-2,-1,0,1,2)) && in_array($yy,array(-2,-1,0,1,2)) || (($xx==100 || $xx==-100 || $xx==0) && ($yy==0 || $yy==100 || $yy=-100))){
                return true;
            }
        }
    }

    $maparray0 = (substr($maparray0, 0, -1));
    if(count($database->query("SELECT id FROM wdata WHERE `type_of`!='' and `occupied`='0' and `id` IN(".$maparray0.")"))){
        return true;
    }
    return false;
}
$maparray="";
for($i=-3;$i<=2;$i++){
    for($k=-3;$k<=3;$k++){
        $id=$database->getBaseID($database->WPosition(0,$k),$database->WPosition(0,$i));
        $maparray .= '\''.$id.'\',';
    }
}
$maparray = (substr($maparray, 0, -1));
$wdata=$database->query("SELECT x,y FROM wdata WHERE `occupied` = '0' and `oasistype`= '0' and `id` NOT IN (".$maparray.") ORDER BY RAND() LIMIT ".round(WORLD_MAX*(WORLD_MAX*2)));
$coor_exist=array();
foreach($wdata as $w){
    $coor_around=array();
    $coor_around['00']=$database->getBaseID($database->WPosition($w['x'],0),$database->WPosition($w['y'],0));

    $database->starttransaction();
    $maparray0='';//
	$oas25=array(1,3,4,6,7,9,10,11,12,1,3,4,6,7,9,10,11,12);
	$oas50=array(2,5,8,12,5,8,12,2,5,8,12);
    $mapa = sqrt(($w['x']*$w['x'])+($w['y']*$w['y']));
    
	if ($mapa<=$nareadis) {
		//in greay area - allow to have both 25 and 50
        $otype=$oas50[array_rand($oas50,1)];
    }else{
		$otype=$oas25[array_rand($oas25,1)];
	}
	$is_adv = !(rand(0,9)%3==0);
	
	//ash types: 3,6,9,12? or 50% yes -> ?2,5,8,12
	
    switch($otype) {
        case 1:
        case 2:
        case 3:
            $type=rand(0,7);
			$ftype = 'forest';
            switch($type){
                case 0:
                    if(exist($w['x'],$w['y'],0,0,0,0)){
                        break;
                    }
                    setOasisByID($otype,$type,$ftype,'0_0',$coor_around['00']);
                    break;
                case 1:
                    if(exist($w['x'],$w['y'],0,1,-1,0)){
                        break;
                    }
                    setOasis($otype,$type,$ftype,'0_60',$w['x'],$database->WPosition($w['y'],-1));
                    setOasis($otype,$type,$ftype,'60_0',$database->WPosition($w['x'],1),$w['y']);
                    setOasis($otype,$type,$ftype,'60_60',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-1));
                    break;
                case 2:
                    if(exist($w['x'],$w['y'],0,1,0,0)){
                        break;
                    }
                    setOasisByID($otype,$type,$ftype,'0_0',$coor_around['00']);
                    setOasis($otype,$type,$ftype,'60_0',$database->WPosition($w['x'],1),$w['y']);
                    break;
                case 3:
                    if(exist($w['x'],$w['y'],0,0,-1,0)){
                        break;
                    }
					setOasisByID($otype,$type,$ftype,'0_0',$coor_around['00']);
                    setOasis($otype,$type,$ftype,'0_60',$w['x'],$database->WPosition($w['y'],-1));
                    break;
                case 4:
                    if(exist($w['x'],$w['y'],0,1,-1,0)){
                        break;
                    }
                    setOasisByID($otype,$type,$ftype,'0_0',$coor_around['00']);
                    setOasis($otype,$type,$ftype,'0_60',$database->WPosition($w['x'],1),$w['y']);
                    setOasis($otype,$type,$ftype,'0_60',$w['x'],$database->WPosition($w['y'],-1));
                    break;
                case 5:
                    if(exist($w['x'],$w['y'],0,0,-2,0)){
                        break;
                    }
					setOasisByID($otype,$type,$ftype,'0_0',$coor_around['00']);
                    setOasis($otype,$type,$ftype,'0_60',$w['x'],$database->WPosition($w['y'],-1));
                    setOasis($otype,$type,$ftype,'0_120',$w['x'],$database->WPosition($w['y'],-2));
					break;
                case 6:
                    if(exist($w['x'],$w['y'],0,2,0,0)){
                        break;
                    }
                    setOasisByID($otype,$type,$ftype,'0_0',$coor_around['00']);
                    setOasis($otype,$type,$ftype,'60_0',$database->WPosition($w['x'],1),$w['y']);
                    setOasis($otype,$type,$ftype,'120_0',$database->WPosition($w['x'],2),$w['y']);
                    break;
                case 7:
                    if(exist($w['x'],$w['y'],0,1,-1,0)){
                        break;
                    }
                    setOasisByID($otype,$type,$ftype,'0_0',$coor_around['00']);
                    setOasis($otype,$type,$ftype,'60_0',$database->WPosition($w['x'],1),$w['y']);
                    setOasis($otype,$type,$ftype,'60_60',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-1));
                    break;
            }


            break;
        case 4:
        case 5:
        case 6:
        $type=rand(0,7);
		$ftype = 'clay';      
        switch($type){
            case 0:
                if(exist($w['x'],$w['y'],0,0,0,0)){
                    break;
                }
				setOasisByID($otype,$type,$ftype,'0_0',$coor_around['00']);
                break;
            case 1:
                if(exist($w['x'],$w['y'],0,1,0,0)){
                    break;
                }
				setOasisByID($otype,$type,$ftype,'0_0',$coor_around['00']);
                setOasis($otype,$type,$ftype,'60_0',$database->WPosition($w['x'],1),$w['y']);

                break;
            case 2:
                if(exist($w['x'],$w['y'],0,0,-1,0)){
                    break;
                }
				setOasisByID($otype,$type,$ftype,'0_0',$coor_around['00']);
                setOasis($otype,$type,$ftype,'0_60',$w['x'],$database->WPosition($w['y'],-1));
				break;
            case 3:
            case 7:
				if(exist($w['x'],$w['y'],0,1,-2,0)){
					break;
				}
				setOasisByID($otype,$type,$ftype,'0_0',$coor_around['00']);
                setOasis($otype,$type,$ftype,'0_60',$w['x'],$database->WPosition($w['y'],-1));
                setOasis($otype,$type,$ftype,'0_120',$w['x'],$database->WPosition($w['y'],-2));
                setOasis($otype,$type,$ftype,'60_0',$database->WPosition($w['x'],1),$w['y']);
                setOasis($otype,$type,$ftype,'60_60',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-1));
                setOasis($otype,$type,$ftype,'60_120',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-2));
                break;
            case 4:
            case 5:
            case 6:
				if(exist($w['x'],$w['y'],0,1,-1,0)){
					break;
				}
				setOasisByID($otype,$type,$ftype,'0_0',$coor_around['00']);
                setOasis($otype,$type,$ftype,'0_60',$w['x'],$database->WPosition($w['y'],-1));
                setOasis($otype,$type,$ftype,'60_0',$database->WPosition($w['x'],1),$w['y']);
                setOasis($otype,$type,$ftype,'60_60',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-1));
                break;


        }
            break;
        case 7:
        case 8:
        case 9:
        $type=rand(0,7);
		$ftype = 'hill';  
        switch($type){
            case 0:
                if(exist($w['x'],$w['y'],0,1,0,0)){
                    break;
                }
				setOasisByID($otype,$type,$ftype,'0_0',$coor_around['00'],true);
                setOasis($otype,$type,$ftype,'60_60',$database->WPosition($w['x'],1),$w['y']);
                break;
            case 1:
                if(exist($w['x'],$w['y'],0,3,-1,0)){
                    break;
                }
				setOasis($otype,$type,$ftype,'0_60',$w['x'],$database->WPosition($w['y'],-1),true);
                setOasis($otype,$type,$ftype,'60_0',$database->WPosition($w['x'],1),$database->WPosition($w['y'],0),true);
				setOasis($otype,$type,$ftype,'60_60',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-1));
                setOasis($otype,$type,$ftype,'120_0',$database->WPosition($w['x'],2),$database->WPosition($w['y'],0),true);
                setOasis($otype,$type,$ftype,'120_60',$database->WPosition($w['x'],2),$database->WPosition($w['y'],-1));
                setOasis($otype,$type,$ftype,'180_60',$database->WPosition($w['x'],3),$database->WPosition($w['y'],-1),true);
				
				break;
            case 2:
                if(exist($w['x'],$w['y'],0,3,-1,0)){
                    break;
                }
                setOasisByID($otype,$type,$ftype,'0_0',$coor_around['00'],true);
                setOasis($otype,$type,$ftype,'0_60',$w['x'],$database->WPosition($w['y'],-1),true);
				setOasis($otype,$type,$ftype,'60_0',$database->WPosition($w['x'],1),$database->WPosition($w['y'],0));
				setOasis($otype,$type,$ftype,'60_60',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-1));
				setOasis($otype,$type,$ftype,'120_0',$database->WPosition($w['x'],2),$database->WPosition($w['y'],0));
				setOasis($otype,$type,$ftype,'120_60',$database->WPosition($w['x'],2),$database->WPosition($w['y'],-1));
                setOasis($otype,$type,$ftype,'180_0',$database->WPosition($w['x'],3),$database->WPosition($w['y'],0),true);
                setOasis($otype,$type,$ftype,'180_60',$database->WPosition($w['x'],3),$database->WPosition($w['y'],-1),true);
                 
				break;
            case 3:
                if(exist($w['x'],$w['y'],0,3,-3,0)){
                    break;
                }
                setOasis($otype,$type,$ftype,'0_60',$w['x'],$database->WPosition($w['y'],-1),true);
                setOasis($otype,$type,$ftype,'60_0',$database->WPosition($w['x'],1),$database->WPosition($w['y'],0),true);
				setOasis($otype,$type,$ftype,'60_60',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-1));
				setOasis($otype,$type,$ftype,'60_120',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-2));
                setOasis($otype,$type,$ftype,'60_180',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-3),true);
                setOasis($otype,$type,$ftype,'120_60',$database->WPosition($w['x'],2),$database->WPosition($w['y'],-1),true);
				setOasis($otype,$type,$ftype,'120_120',$database->WPosition($w['x'],2),$database->WPosition($w['y'],-2));
                setOasis($otype,$type,$ftype,'120_180',$database->WPosition($w['x'],2),$database->WPosition($w['y'],-3),true);
				  
                break;
            case 4:
                if(exist($w['x'],$w['y'],0,3,-2,0)){
                    break;
                }
				setOasisByID($otype,$type,$ftype,'0_0',$coor_around['00'],true);
                setOasis($otype,$type,$ftype,'0_60',$w['x'],$database->WPosition($w['y'],-1),true);
                setOasis($otype,$type,$ftype,'0_120',$w['x'],$database->WPosition($w['y'],-2),true);
				setOasis($otype,$type,$ftype,'60_60',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-1));
				setOasis($otype,$type,$ftype,'60_120',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-2));
                setOasis($otype,$type,$ftype,'120_0',$database->WPosition($w['x'],2),$database->WPosition($w['y'],0),true);
				setOasis($otype,$type,$ftype,'120_60',$database->WPosition($w['x'],2),$database->WPosition($w['y'],-1));
				setOasis($otype,$type,$ftype,'120_120',$database->WPosition($w['x'],2),$database->WPosition($w['y'],-2));
                
				break;
            case 5:
                if(exist($w['x'],$w['y'],0,4,-1,0)){
                    break;
                } 
				setOasisByID($otype,$type,$ftype,'0_0',$coor_around['00'],true);
                setOasis($otype,$type,$ftype,'0_60',$$w['x'],$database->WPosition($w['y'],-1),true);
				setOasis($otype,$type,$ftype,'60_0',$database->WPosition($w['x'],1),$database->WPosition($w['y'],0));
				setOasis($otype,$type,$ftype,'60_60',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-1));
				setOasis($otype,$type,$ftype,'120_0',$database->WPosition($w['x'],2),$database->WPosition($w['y'],0));
				setOasis($otype,$type,$ftype,'120_60',$database->WPosition($w['x'],2),$database->WPosition($w['y'],-1));
				setOasis($otype,$type,$ftype,'180_0',$database->WPosition($w['x'],3),$w['y']);
				setOasis($otype,$type,$ftype,'180_60',$database->WPosition($w['x'],3),$database->WPosition($w['y'],-1));
                setOasis($otype,$type,$ftype,'240_0',$database->WPosition($w['x'],4),$w['y'],true);
                setOasis($otype,$type,$ftype,'240_60',$database->WPosition($w['x'],4),$database->WPosition($w['y'],-1),true);
                
                break;
            case 6:
                if(exist($w['x'],$w['y'],0,2,-3,0)){
                    break;
                } 
                setOasis($otype,$type,$ftype,'0_60',$w['x'],$database->WPosition($w['y'],-1),true);
                setOasis($otype,$type,$ftype,'0_120',$w['x'],$database->WPosition($w['y'],-2),true);
                setOasis($otype,$type,$ftype,'60_0',$database->WPosition($w['x'],1),$database->WPosition($w['y'],0),true);
				setOasis($otype,$type,$ftype,'60_60',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-1));
				setOasis($otype,$type,$ftype,'60_120',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-2));
				setOasis($otype,$type,$ftype,'60_180',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-3));
				
                setOasis($otype,$type,$ftype,'120_180',$database->WPosition($w['x'],2),$database->WPosition($w['y'],-3),true);
                break;
            case 7:
                if(exist($w['x'],$w['y'],0,1,0,0)){
                    break;
                }
				setOasisByID($otype,$type,$ftype,'0_0',$coor_around['00'],true);
                break;
        }
            break;
        case 10:
        case 11:
        case 12:
        $type=rand(0,7);
		$ftype = 'lake';      
        switch($type){
            case 0:
                if(exist($w['x'],$w['y'],0,0,0,0)){
                    break;
                }
                setOasisByID($otype,$type,$ftype,'0_0',$coor_around['00']);
                break;
            case 1:
                if(exist($w['x'],$w['y'],0,1,-1,0)){
                    break;
                }
                setOasisByID($otype,$type,$ftype,'0_0',$coor_around['00']);
				setOasis($otype,$type,$ftype,'0_60',$w['x'],$database->WPosition($w['y'],-1));
				setOasis($otype,$type,$ftype,'60_0',$database->WPosition($w['x'],1),$database->WPosition($w['y'],0));
				setOasis($otype,$type,$ftype,'60_60',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-1));
				break;
            case 2:
                if(exist($w['x'],$w['y'],0,3,-2,0)){
                    break;
                }
                setOasisByID($otype,$type,$ftype,'0_0',$coor_around['00'],true);
				setOasis($otype,$type,$ftype,'0_60',$w['x'],$database->WPosition($w['y'],-1));
                setOasis($otype,$type,$ftype,'0_120',$w['x'],$database->WPosition($w['y'],-2),true);
				setOasis($otype,$type,$ftype,'60_0',$database->WPosition($w['x'],1),$database->WPosition($w['y'],0));
				setOasis($otype,$type,$ftype,'60_60',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-1));
				setOasis($otype,$type,$ftype,'60_120',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-2));
				setOasis($otype,$type,$ftype,'120_0',$database->WPosition($w['x'],2),$database->WPosition($w['y'],0));
				setOasis($otype,$type,$ftype,'120_60',$database->WPosition($w['x'],2),$database->WPosition($w['y'],-1));
				setOasis($otype,$type,$ftype,'120_120',$database->WPosition($w['x'],2),$database->WPosition($w['y'],-2));
				setOasis($otype,$type,$ftype,'180_0',$database->WPosition($w['x'],3),$database->WPosition($w['y'],0));
				setOasis($otype,$type,$ftype,'180_60',$database->WPosition($w['x'],3),$database->WPosition($w['y'],-1));
				setOasis($otype,$type,$ftype,'180_120',$database->WPosition($w['x'],3),$database->WPosition($w['y'],-2));
                
                break;
            case 3:
                if(exist($w['x'],$w['y'],0,3,-3,0)){
                    break;
                }
                setOasisByID($otype,$type,$ftype,'0_0',$coor_around['00'],true);
				setOasis($otype,$type,$ftype,'0_60',$w['x'],$database->WPosition($w['y'],-1));
				setOasis($otype,$type,$ftype,'0_120',$w['x'],$database->WPosition($w['y'],-2));
                setOasis($otype,$type,$ftype,'0_180',$w['x'],$database->WPosition($w['y'],-3),true);
				setOasis($otype,$type,$ftype,'60_0',$database->WPosition($w['x'],1),$database->WPosition($w['y'],0));
				setOasis($otype,$type,$ftype,'60_60',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-1));
				setOasis($otype,$type,$ftype,'60_120',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-2));
				setOasis($otype,$type,$ftype,'60_180',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-3));
				setOasis($otype,$type,$ftype,'120_0',$database->WPosition($w['x'],2),$database->WPosition($w['y'],0));
				setOasis($otype,$type,$ftype,'120_60',$database->WPosition($w['x'],2),$database->WPosition($w['y'],-1));
				setOasis($otype,$type,$ftype,'120_120',$database->WPosition($w['x'],2),$database->WPosition($w['y'],-2));
				setOasis($otype,$type,$ftype,'120_180',$database->WPosition($w['x'],2),$database->WPosition($w['y'],-3));
                setOasis($otype,$type,$ftype,'180_0',$database->WPosition($w['x'],3),$database->WPosition($w['y'],0),true);
                setOasis($otype,$type,$ftype,'180_60',$database->WPosition($w['x'],3),$database->WPosition($w['y'],-1),true);
                setOasis($otype,$type,$ftype,'180_120',$database->WPosition($w['x'],3),$database->WPosition($w['y'],-2),true);
				setOasis($otype,$type,$ftype,'180_180',$database->WPosition($w['x'],3),$database->WPosition($w['y'],-3));
				
                 
				break;
            case 4:
                if(exist($w['x'],$w['y'],0,2,-2,0)){
                    break;
                }
                setOasisByID($otype,$type,$ftype,'0_0',$coor_around['00'],true);
				setOasis($otype,$type,$ftype,'0_60',$w['x'],$database->WPosition($w['y'],-1));
				setOasis($otype,$type,$ftype,'0_120',$w['x'],$database->WPosition($w['y'],-2));
				setOasis($otype,$type,$ftype,'60_0',$database->WPosition($w['x'],1),$database->WPosition($w['y'],0));
				setOasis($otype,$type,$ftype,'60_60',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-1));
				setOasis($otype,$type,$ftype,'60_120',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-2));
				setOasis($otype,$type,$ftype,'120_0',$database->WPosition($w['x'],2),$database->WPosition($w['y'],0));
				setOasis($otype,$type,$ftype,'120_60',$database->WPosition($w['x'],2),$database->WPosition($w['y'],-1));
				setOasis($otype,$type,$ftype,'120_120',$database->WPosition($w['x'],2),$database->WPosition($w['y'],-2));
				
                
              break;
            case 5:
                if(exist($w['x'],$w['y'],0,4,-4,0)){
                    break;
                }	
                setOasisByID($otype,$type,$ftype,'0_0',$coor_around['00'],true);
				setOasis($otype,$type,$ftype,'0_60',$w['x'],$database->WPosition($w['y'],-1));
				setOasis($otype,$type,$ftype,'0_120',$w['x'],$database->WPosition($w['y'],-2));
				setOasis($otype,$type,$ftype,'0_180',$w['x'],$database->WPosition($w['y'],-3));
				setOasis($otype,$type,$ftype,'0_240',$w['x'],$database->WPosition($w['y'],-4));
				setOasis($otype,$type,$ftype,'60_0',$database->WPosition($w['x'],1),$database->WPosition($w['y'],0));
				setOasis($otype,$type,$ftype,'60_60',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-1));
				setOasis($otype,$type,$ftype,'60_120',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-2));
				setOasis($otype,$type,$ftype,'60_180',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-3));
				setOasis($otype,$type,$ftype,'60_240',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-4));
				setOasis($otype,$type,$ftype,'120_0',$database->WPosition($w['x'],2),$database->WPosition($w['y'],0));
				setOasis($otype,$type,$ftype,'120_60',$database->WPosition($w['x'],2),$database->WPosition($w['y'],-1));
				setOasis($otype,$type,$ftype,'120_120',$database->WPosition($w['x'],2),$database->WPosition($w['y'],-2));
                setOasis($otype,$type,$ftype,'120_180',$database->WPosition($w['x'],2),$database->WPosition($w['y'],-3),true);
                setOasis($otype,$type,$ftype,'120_240',$database->WPosition($w['x'],2),$database->WPosition($w['y'],-4),true);
				setOasis($otype,$type,$ftype,'180_0',$database->WPosition($w['x'],3),$database->WPosition($w['y'],0));
				setOasis($otype,$type,$ftype,'180_60',$database->WPosition($w['x'],3),$database->WPosition($w['y'],-1));
                setOasis($otype,$type,$ftype,'180_120',$database->WPosition($w['x'],3),$database->WPosition($w['y'],-2),true);
                setOasis($otype,$type,$ftype,'180_180',$database->WPosition($w['x'],3),$database->WPosition($w['y'],-3),true);
                setOasis($otype,$type,$ftype,'180_240',$database->WPosition($w['x'],3),$database->WPosition($w['y'],-4),true);
				setOasis($otype,$type,$ftype,'240_0',$database->WPosition($w['x'],4),$database->WPosition($w['y'],0));
                setOasis($otype,$type,$ftype,'240_60',$database->WPosition($w['x'],4),$database->WPosition($w['y'],-1),true);
                setOasis($otype,$type,$ftype,'240_120',$database->WPosition($w['x'],4),$database->WPosition($w['y'],-2),true);
                setOasis($otype,$type,$ftype,'240_180',$database->WPosition($w['x'],4),$database->WPosition($w['y'],-3),true);
                setOasis($otype,$type,$ftype,'240_240',$database->WPosition($w['x'],4),$database->WPosition($w['y'],-4),true);

                break;
            case 6:
                if(exist($w['x'],$w['y'],0,3,-3,0)){
                    break;
                }
                setOasisByID($otype,$type,$ftype,'0_0',$coor_around['00'],true);
				setOasis($otype,$type,$ftype,'0_60',$w['x'],$database->WPosition($w['y'],-1));
				setOasis($otype,$type,$ftype,'0_120',$w['x'],$database->WPosition($w['y'],-2));
				setOasis($otype,$type,$ftype,'0_180',$w['x'],$database->WPosition($w['y'],-3));
				setOasis($otype,$type,$ftype,'60_0',$database->WPosition($w['x'],1),$database->WPosition($w['y'],0));
				setOasis($otype,$type,$ftype,'60_60',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-1));
				setOasis($otype,$type,$ftype,'60_120',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-2));
				setOasis($otype,$type,$ftype,'60_180',$database->WPosition($w['x'],1),$database->WPosition($w['y'],-3));
				setOasis($otype,$type,$ftype,'120_0',$database->WPosition($w['x'],2),$database->WPosition($w['y'],0));
				setOasis($otype,$type,$ftype,'120_60',$database->WPosition($w['x'],2),$database->WPosition($w['y'],-1));
				setOasis($otype,$type,$ftype,'120_120',$database->WPosition($w['x'],2),$database->WPosition($w['y'],-2));
                setOasis($otype,$type,$ftype,'120_180',$database->WPosition($w['x'],2),$database->WPosition($w['y'],-3),true);
                setOasis($otype,$type,$ftype,'180_0',$database->WPosition($w['x'],3),$database->WPosition($w['y'],0),true);
				setOasis($otype,$type,$ftype,'180_60',$database->WPosition($w['x'],3),$database->WPosition($w['y'],-1));
                setOasis($otype,$type,$ftype,'180_120',$database->WPosition($w['x'],3),$database->WPosition($w['y'],-2),true);
                  
				break;
            case 7:
                if(exist($w['x'],$w['y'],0,1,0,0)){
                    break;
                }
                setOasisByID($otype,$type,$ftype,'0_0',$coor_around['00'],true);
                setOasis($otype,$type,$ftype,'60_0',$database->WPosition($w['x'],1),$w['y'],true);
                break;
        }
            break;
    }
$database->commitq();
}
for($i=1;$i<=($amt-8);$i++) {
    $kid += 1;
    if($kid ==4){
        $kid=1;}

    $wid = $database->generateBase($kid);
    $database->setFieldTaken($wid);
    $coo=$database->getWInfo($wid);
    $time = time();
    $q = "INSERT  into vdata (`wref`,`owner`,`name`,`capital`,`pop`,`cp`,`celebration`,`type`,`wood`,`clay`,`iron`,`maxstore`,`crop`,`maxcrop`,`lastupdate`,`loyalty`,`exp1`,`exp2`,`exp3`,`created`,`natar`,`vx`,`vy`,`vtype`) values ('$wid','3','WW village',0,233,0,0,0,80000.00,80000.00,80000.00,80000,80000.00,80000,1314974534,100,0,0,0,$time,1,".$coo['x'].",".$coo['y'].",".$coo['fieldtype'].")";
    $database->query($q);				switch($coo['fieldtype']) {			case 1:				$q1 = "4,4,1,4,4,2,3,4,4,3,3,4,4,1,4,2,1,2";				break;			case 2:				$q1 = "3,4,1,3,2,2,3,4,4,3,3,4,4,1,4,2,1,2";				break;			case 3:				$q1 = "1,4,1,3,2,2,3,4,4,3,3,4,4,1,4,2,1,2";				break;			case 4:				$q1 = "1,4,1,2,2,2,3,4,4,3,3,4,4,1,4,2,1,2";				break;			case 5:				$q1 = "1,4,1,3,1,2,3,4,4,3,3,4,4,1,4,2,1,2";				break;			case 6:				$q1 = "4,4,1,3,4,4,4,4,4,4,4,4,4,4,4,2,4,4";				break;			case 7:				$q1 = "1,4,4,1,2,2,3,4,4,3,3,4,4,1,4,2,1,2";				break;			case 8:				$q1 = "3,4,4,1,2,2,3,4,4,3,3,4,4,1,4,2,1,2";				break;			case 9:				$q1 = "3,4,4,1,1,2,3,4,4,3,3,4,4,1,4,2,1,2";				break;			case 10:				$q1 = "3,4,1,2,2,2,3,4,4,3,3,4,4,1,4,2,1,2";				break;			case 11:				$q1 = "3,1,1,3,1,4,4,3,3,2,2,3,1,4,4,2,4,4";				break;			case 12:				$q1 = "1,4,1,1,2,2,3,4,4,3,3,4,4,1,4,2,1,2";				break;		}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	$q1 = explode(",",$q1);	$q2 = '';	foreach($q1 as $qq){		if($q2 != "") $q2 .= ",";		$q2 .= "0,".$qq;	}		
    $q = "INSERT  into fdata (`vref`,`f1`,`f1t`,`f2`,`f2t`,`f3`,`f3t`,`f4`,`f4t`,`f5`,`f5t`,`f6`,`f6t`,`f7`,`f7t`,`f8`,`f8t`,`f9`,`f9t`,`f10`,`f10t`,`f11`,`f11t`,`f12`,`f12t`,`f13`,`f13t`,`f14`,`f14t`,`f15`,`f15t`,`f16`,`f16t`,`f17`,`f17t`,`f18`,`f18t`,`f19`,`f19t`,`f20`,`f20t`,`f21`,`f21t`,`f22`,`f22t`,`f23`,`f23t`,`f24`,`f24t`,`f25`,`f25t`,`f26`,`f26t`,`f27`,`f27t`,`f28`,`f28t`,`f29`,`f29t`,`f30`,`f30t`,`f31`,`f31t`,`f32`,`f32t`,`f33`,`f33t`,`f34`,`f34t`,`f35`,`f35t`,`f36`,`f36t`,`f37`,`f37t`,`f38`,`f38t`,`f39`,`f39t`,`f40`,`f40t`,`f99`,`f99t`,`wwname`) values ($wid,".$q2.",20,17,20,11,20,15,20,10,10,22,10,25,0,0,0,0,10,19,0,0,0,0,0,0,10,23,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,16,0,0,0,40,'World Wonder')";	$p=array('V'=>$wid);
    $database->query($q, $p);
    $database->addUnits($wid);
    $database->addTech($wid);
    $database->addABTech($wid);

    $database->query("UPDATE units SET u1 = " . (rand(2000, 4000) * $speed) . ", u2 = " . (rand(3000, 4000) * $speed) . ", u3 = " . (rand(4600, 5600) * $speed) . ", u4 = " . (rand(50, 150) * $speed) . ", u5 = " . (rand(2400, 3800) * $speed) . ", u6 = " . (rand(3000, 4000) * $speed) . ", u7 = " . (rand(1000, 1800) * $speed) . ", u8 = " . (rand(200, 600) * $speed) . " , u9 = " . (rand(2, 10) * $speed) . ", u10 = " . (rand(2, 10) * $speed) . " WHERE vref = " . $wid . "");

}





		if(!$doNotRedir)
		header("Location: ../index.php?s=4");

