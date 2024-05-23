<?php

class adm_DB extends MYSQL_DB{


	function LoginA($username,$password){
        
		$q = "SELECT password FROM users where username = '$username' and access >= ".MULTIHUNTER;
		$result = $this->query($q);
		$dbarray = $result[0];
		if($dbarray['password'] == md5($password.mb_convert_case($username,MB_CASE_LOWER,"UTF-8"))) {
			return true;
		}

return false;

	}

	function recountPopUser($uid){

	 $villages = $this->getProfileVillages($uid);
	for ($i = 0; $i <= count($villages)-1; $i++) {
	  $vid = $villages[$i]['wref'];
	  $this->recountPop($vid);
	}
  }
      	function StopDelPlayer($uid){
	$q = "UPDATE users SET `deleting` = '0' WHERE `id` = $uid";
	$this->query($q);

	}


  function buildingPOP($f,$lvl){
  	if($f==99){$f=40;}
	$name = "bid".$f;
		global $$name;
		$popT = 0;
		$dataarray = $$name;
	for ($i = 0; $i <= $lvl; $i++) {
	  $popT += $dataarray[$i]['pop'];
	}
	return $popT;
  }

	function getWref($x,$y) {
		$q = "SELECT id FROM wdata where x = $x and y = $y";
		$result = $this->query($q);
		$r = $result[0];
		return $r['id'];
	}

	function AddVillageA($post){
	
	  $wid = $this->getWref($post['x'],$post['y']);
	  $uid = $post['uid'];
	$status = $this->getVillageState($wid);

	if($status == 0){
	 $this->setFieldTaken($wid);
		  $this->addVillage($wid,$uid,'new village','0');
		  $this->addResourceFields($wid,$this->getVillageType($wid));
		  $this->addUnits($wid);
		  $this->addTech($wid);
		  $this->addABTech($wid);
	}
  }

    function changeTroops($post){
        $id = $post['id'];
        $u1 = $post['u1'];
        $u2 = $post['u2'];
        $u3 = $post['u3'];
        $u4 = $post['u4'];
        $u5 = $post['u5'];
        $u6 = $post['u6'];
        $u7 = $post['u7'];
        $u8 = $post['u8'];
        $u9 = $post['u9'];
        $u10 = $post['u10'];
        $hero = $post['hero'];


        $q = "UPDATE units SET u1 = $u1, u2 = $u2, u3 = $u3, u4 = $u4, u5 = $u5, u6 = $u6, u7 = $u7, u8 = $u8, u9 = $u9, u10 = $u10 ,u11 = $hero WHERE vref = $id";
        $this->query($q);

        $adminlog="Changed troop anmount in village <a href=\"admin.php?p=village&did=$id\">$id</a> ,".time()."";
        $this->addPalevo($_SESSION['id'],$adminlog,1);
    }
	function Punish($post){
	 
	   $villages = $this->getProfileVillages($post['uid']);
	   $admid = $post['admid'];
	   $user = $this->getUserArray($post['uid'],1);
		  for ($i = 0; $i <= count($villages)-1; $i++) {
			$vid = $villages[$i]['wref'];
			if($post['punish']){
			  $popOld = $villages[$i]['pop'];
			  $proc = 100-$post['punish'];
			  $pop = floor(($popOld/100)*($proc));
				if($pop <= 1 ){$pop = 2;}
				$this->PunishBuilding($vid,$proc,$pop);

			}
			if($post['del_troop']){
				if($user['tribe'] == 1) {
				  $unit = 1;
				}else if($user['tribe'] == 2) {
				  $unit = 11;
				}else if($user['tribe'] == 3) {
				  $unit = 21;
				}
				  $this->DelUnits($villages[$i]['wref'],$unit);
			}
			if($post['clean_ware']){
			  $time = time();
			  $q = "UPDATE vdata SET `wood` = '0', `clay` = '0', `iron` = '0', `crop` = '0', `lastupdate` = '$time' WHERE wref = $vid;";
			  $this->query($q);
			}
		  }
}

  function PunishBuilding($vid,$proc,$pop){
	
	$q = "UPDATE vdata set pop = $pop where wref = $vid;";
	$this->query($q);
	$fdata = $this->getResourceLevel($vid);
	for ($i = 1; $i <= 40; $i++) {
	  if($fdata['f'.$i]>1){
		$zm = ($fdata['f'.$i]/100)*$proc;
		if($zm < 1){$zm = 1;}else{$zm = floor($zm);}
		$q = "UPDATE fdata SET `f$i` = '$zm' WHERE `vref` = $vid;";
		$this->query($q);
	  }
	}
  }

  function DelUnits($vid,$unit){
	for ($i = $unit; $i <= 9+$unit; $i++) {
	  $this->DelUnits2($vid,$unit);
	}
  }

  function DelUnits2($vid,$unit){
	  $q = "UPDATE units SET `u$unit` = '0' WHERE `vref` = $vid;";
	  $this->query($q);
  }

	function DelPlayer($uid,$pass){
	 
	$ID = $_SESSION['id'];//$this->getUserField($_SESSION['username'],'id',1);
	   if($this->CheckPass($pass,$ID)){
		 $villages = $this->getProfileVillages($uid);
		  for ($i = 0; $i <= count($villages)-1; $i++) {
			$this->DelVillage($villages[$i]['wref']);
		  }
		//  $deadinfo=$this->getUserFieldforDeleteByAdmin($uid);
		//$name = $deadinfo['username'];
       // $gold = $deadinfo['gold'];
      //  $email = $deadinfo['email'];
	//	$q = "DELETE FROM users WHERE `id` = $uid;";
	//	 $this->query($q);
		 		    //   $code=$generator->generateRandStr(15);
   // include("../../travian-hell.ru/configfile48162342DdTUriiShevshuck/fileforcoNNectionToDBotOlegaGazmanOvaLoL.php");
     //    $connect->connectionPrefix("index");
      //   mysql_query("INSERT INTO bank987321 (`username`,`email`,`secretcode`,`deldate`,`gold`) VALUES ('".$name."','".$email."','".$code."','".time()."','".$gold."')");

   // $mailer->sendGold($need['email'],$need['username'],$code);
	//	$this->query($q);
		$q = "DELETE FROM palevo where uid = ".$uid;

		 $this->query($q);
		 		$q = "DELETE FROM users where id = ".$uid;

		 $this->query($q);
	}
  }

  function getUserActive() {
	$time = time() - (60*5);
		$q = "SELECT * FROM users where timestamp > $time and username != 'support'";
		$result = $this->query($q);
	return $result;
	}

  function CheckPass($password,$uid){
	$q = "SELECT password,username FROM users where id = '$uid' and access = ".ADMIN;
		$result = $this->query($q);
		$dbarray = $result[0];
		if($dbarray['password'] == md5($password.mb_convert_case($dbarray['username'],MB_CASE_LOWER,"UTF-8"))) {
		  return true;
	}else{
	  return false;
	}
  }
     	function recountCp($vid){
	
	$fdata = $this->getResourceLevel($vid);
            $cpTot = 0;
	for ($i = 1; $i <= 40; $i++) {
	  $lvl = $fdata["f".$i];
	  $building = $fdata["f".$i."t"];
	  if($building){
		$cpTot += $this->buildingCp($building,$lvl);
	  }
	}
	$q = "UPDATE vdata set cp = $cpTot where wref = $vid";
	$this->query($q);
  }

  function buildingCp($f,$lvl){
	$name = "bid".$f;
		global $$name;
		$cpT = 0;
		$dataarray = $$name;
	for ($i = 0; $i <= $lvl; $i++) {
	  $cpT += $dataarray[$i]['cp'];
	}

	return $cpT;
  }
	function DelBan($uid,$id){
	$q = "UPDATE users SET `access` = '2' WHERE `id` = $uid;";
	$this->query($q);
	$q = "UPDATE banlist SET `active` = '0' WHERE `id` = $id;";
	$this->query($q);
	$this->setDeleting($uid,1);
  }

  function AddBan($uid,$end,$reason){

	$q = "UPDATE users SET `access` = '0' WHERE `id` = $uid;";
	$this->query($q);
	$time = time();
	$admin = $_SESSION['id'];  //$this->getUserField($_SESSION['username'],'id',1);
	$name = addslashes($this->getUserField($uid,'username',0));
	$q = "INSERT INTO banlist (`uid`, `name`, `reason`, `time`, `end`, `admin`, `active`) VALUES ($uid, '$name' , '$reason', '$time', '$end', '$admin', '1');";
	$this->query($q);
	$this->setDeleting($uid,0);
  }

  function search_player($player){
	$q = "SELECT id,username,email,gold,
	(SELECT SUM( vdata.pop )	FROM vdata	WHERE vdata.owner = users.id) tp,
	(SELECT COUNT(vdata.wref) FROM vdata WHERE vdata.owner = users.id AND type != 99) AS tv
	FROM users WHERE `username` LIKE '%$player%' and username != 'support' ORDER BY tp DESC";
	$result = $this->query($q);
	return $result;
  }

  function search_email($email){
	$q = "SELECT id,email FROM users WHERE `email` LIKE '%$email%' and username != 'support'";
	$result = $this->query($q);
	return $result;
  }

  function search_village($village){
	$q = "SELECT * FROM vdata WHERE `name` LIKE '%$village%' or `wref` LIKE '%$village%'";
	$result = $this->query($q);
	return $result;
  }

  function search_alliance($alliance){
	$q = "SELECT * FROM alidata WHERE `name` LIKE '%$alliance%' or `tag` LIKE '%$alliance%' or `id` LIKE '%$alliance%'";
	$result = $this->query($q);
	return $result;
  }

  function search_ip($ip){
	$q = "SELECT * FROM login_log WHERE `ip` LIKE '%$ip%'";
	$result = $this->query($q);
	return $result;
  }

  function search_banned(){
	$q = "SELECT * FROM banlist where active = '1'";
	$result = $this->query($q);
	return $result;
  }

  function Del_banned(){
	//$q = "SELECT * FROM banlist";
	//$result = $this->query($q);
	//return $result;
  }




};

$admin = new adm_DB;
include("../GameEngine/Admin/function.php");