<?php
###############################  E    N    D   ##################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Developed by:  Brainiac & Wolfcruel                                        ##
##  License:       Travian-Hell Project                                        ##
##  Copyright:     Travian-Hell (c) 2011-2014. Skype brainiac.brainiac         ##
##                                                                             ##
#################################################################################
include("Mail/Mailer.php");
include_once("GameEngine/Database.php");
class banksystem
{

    function getInfo($milo)
    { 
global $mailer,$database;
		
        $value = substr($milo, 0, 40);
        $email = htmlspecialchars($value);
        $info = $database->row("SELECT * FROM bank WHERE `email`='" . $email . "'");
        if (count($info)) {
            $code = $this->generateRandStr(10);
            $ip = $_SERVER['REMOTE_ADDR'];
            $mailer->sendGold($email,$code);
            $database->row("UPDATE operation SET `status`='1' WHERE `email`='" . $email . "'");
            $database->row("INSERT INTO operation (`email`,`code`,`gold`,`ip`,`time`,`status`) VALUES ('" . $info['email'] . "','" . $code . "','0','" . $ip . "','" . time() . "','0')");

        }
        return $info;
    }
	function getGoldCount($email) {
		global $database;
        $value = substr($email, 0, 30);
        $email1 = htmlspecialchars($value);
		$info = $database->row("SELECT gold FROM bank WHERE email='" . $email1 . "'");
		$return['gold']  = $info['gold'];
		return $return;
	}
	
	
	
	
	function CheckUser($server, $id, $email, $code, $gold)
    {
        
        global $database,$database,$connect;
        $back = array();
        $email = substr($email, 0, 30);
        $email = htmlspecialchars($email);
        $code = substr($code, 0, 30);
        $code = htmlspecialchars($code);
        $gold = substr($gold,0,10);
        $gold = preg_replace("/[^0-9]/", "", $gold);
        $gold=intval($gold);



      //  echo $server." ; ".$id." ; ".$email." ; ".$code." ; ".$gold;
        
        $lineinfo = $database->row("SELECT o.id,b.email,o.code,o.status,b.gold FROM operation as o INNER JOIN bank as b ON o.email = b.email
        WHERE
        o.email='" . $email . "' and o.status ='0' ORDER BY o.id DESC") or die(mysql_error());
        
        
        if($lineinfo['gold']>=$gold && !empty($lineinfo) && $lineinfo['code']==$code){
          
        
        if (empty($id)) {
            $back['id'] = 0;
            $back['fail']=false;
        } else {
            $back['id'] = $id;
            $back['gold'] = $gold;
            $database->row("UPDATE operation SET `gold`=".$gold.",`server`='".$server."',`userid`='". $back['id']."' WHERE `id`=".$lineinfo['id']."") or die(mysql_error());
            $back['fail']=false;
      }
        $back['code'] = $lineinfo['code'];
        $back['nick'] = $nick;
            $back['email'] = $lineinfo['email'];
            return $back;
        }
        $back['id']=0;
        $back['fail']=true;
        return $back;
    }


    function generateRandStr($length)
    {
        $randstr = "";
        for ($i = 0; $i < $length; $i++) {
            $randnum = mt_rand(0, 61);
            if ($randnum < 10) {
                $randstr .= chr($randnum + 48);
            } else if ($randnum < 36) {
                $randstr .= chr($randnum + 55);
            } else {
                $randstr .= chr($randnum + 61);
            }
        }
        return $randstr;
    }

    

    function addGold($code,$email)
    {
        $result = false;
        global $database,$database;
        $email = substr($email, 0, 30);
        $email = htmlspecialchars($email);
        $code = substr($code, 0, 30);
        $code = htmlspecialchars($code);
        
        $lineinfo2 = $database->row("SELECT gold,server,userid,email,code FROM operation WHERE `email`='".$email."' and `code`='" . $code . "' and `status`='0'");
        
        if(!empty($lineinfo2)){
        $checode = $lineinfo2['code'];
            $gold = $lineinfo2['gold'];
         $database->row("UPDATE bank SET `gold`=`gold`-".$gold." WHERE `email`='".$email."'");
            $database->row("UPDATE operation SET `status`='1' WHERE `code`='".$checode."'");

            $userid = $lineinfo2['userid'];
            $server = $lineinfo2['server'];


            //для юзера
			$ttema = "Transfer gold!";
			$ttext = "[message]Gold is successfully transferred from the bank ! The amount of ".$gold." gold.[/message]";
						
            $database->modifyGold( $userid ,$gold , 1,"Gold transferred from the bank ");
            $database->query("INSERT INTO mdata (id, target, owner, topic, message, viewed, send, time) VALUES('','".$userid."','6','".$ttema."','".$ttext."','0','0','".time()."')");

            //для банковских шняг
            $ip = $_SERVER['REMOTE_ADDR'];
            $database->query("INSERT INTO log (`id`,`userid`,`email`,`gold`,`ip`,`time`,`server`) VALUES ('0','" . $userid . "','" . $lineinfo2['email'] . "','".$gold."','" . $ip . "','" . time() . "','".$server."')");

            $result = true;

        }
        return $result;
    }
}
$banksystem = new banksystem;