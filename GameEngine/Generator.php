<?php
class Generator0 {

	public function generateRandID(){
		return md5($this->generateRandStr(16));
		}
		
		
		
		public function getGoldForTime($time) {
			$return = '?';
			if (INSTANT_TRAIN) {
				$return = $time > 0 ? ceil($time / INSTANT_TRAIN_MODIFIER) : '?';
			}
			return $return;
		}

   public function generateRandStr($length){
	  $randstr = "";
	  for($i=0; $i<$length; $i++){
		 $randnum = mt_rand(0,61);
		 if($randnum < 10){
			$randstr .= chr($randnum+48);
		 }else if($randnum < 36){
			$randstr .= chr($randnum+55);
		 }else{
			$randstr .= chr($randnum+61);
		 }
	  }
	  return $randstr;
   }

   public function encodeStr($str,$length) {
	   $encode = md5($str);
	   return substr($encode,0,$length);
   }	
   public function getMilisecFormat($ms) {
	   $sec = intval(floor($ms/1000)) ;	
	   $ms = $ms%1000;		
	   $min = intval(floor($sec/60)) ;		
	   $sec = $sec%60;		
	   $hr = intval(floor($min/60)) ;		
	   $min = $min%60;		
	   $res = sprintf("%02d:%02d:%02d (+ %d ms)",$hr,$min,$sec,$ms);		
	   return $res;	}	   


   public function getTimeFormat($t) {
       return sprintf('%02d:%02d:%02d', ($t/3600),($t/60%60), $t%60);
   }

public function procMtime($time, $pref = 3) {


$today = date('d',time())-1;
if (date('Ymd',time()) == date('Ymd',$time)) {
	$day = REPORT_TODAY;
	}elseif($today == date('d',$time)){
	$day = REPROT_YESTERDAY;
	}
		else {

			$day = date("j/m/y",$time);

		}
		$new = date("H:i:s",$time);
		if ($pref=="9"||$pref==9)
			return $new;
		else
			return array($day,$new);
	}



	public function getMapCheck($wref) {
		return substr(md5($wref),5,2);
	}


};
$generator = new Generator0;