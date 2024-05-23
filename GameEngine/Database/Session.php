<?php
###############################  E    N    D   ##################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Developed by:  Brainiac & Wolfcruel                                        ##
##  License:       BrainianZ Project                                        ##
##  Copyright:     BrainianZ © 2011-2014. Skype brainiac.brainiac         ##
##                                                                             ##
#################################################################################
require_once("Database.php");
require_once("Generator.php");
require_once("Form.php");

ob_start();
if(!empty($_GET['lang'])){
	if($_GET['lang']=='ru'){
		setcookie('lang', 'ru');
		$_COOKIE['lang']='ru';
	}elseif($_GET['lang']=='en'){
		setcookie('lang', 'en');
		$_COOKIE['lang']='en';
	}
}

if ((!isset($_COOKIE['lang'])  || empty($_COOKIE['lang'])) && isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
	$language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	if (in_array($language, array('ru', 'ua', 'be'))) {
		setcookie('lang', 'ru');
		$language=$_COOKIE['lang']='ru';
	} else {
		setcookie('lang', 'en');
		$language=$_COOKIE['lang']='en';
	}
}elseif(!isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
	setcookie('lang', 'en');
	$language=$_COOKIE['lang']='en';
}else {
	$language = $_COOKIE['lang'];
}
if(!in_array($language, array('ru', 'en'))) {
	setcookie('lang', 'en');
	$language=$_COOKIE['lang']='en';
}
include("Lang/" . $language . ".php");

if (!empty($_GET['builder'])) {
    if ($_GET['builder'] == 'On') {
        setcookie('builder', 'On');
        $_COOKIE['builder'] = "On";
    } elseif ($_GET['builder'] == 'Off') {
        setcookie('builder', 'Off');
        $_COOKIE['builder'] = "Off";
    }
}

if (!isset($_COOKIE['builder'])) {
    setcookie('builder', 'Off');
    $_COOKIE['builder'] = "Off";
    $another = "Off";
    $todo = "disable";
} elseif ($_COOKIE['builder'] == "On") {
    $another = "Off";
    $todo = "disable";
} else {
    $another = "On";
    $todo = "enable";
}


class Session {

    public $logged_in = false;
    public $username,$uid,$unread,$link,$quest,$deleting, $access, $plus,$mescheck, $tribe,$silver,$face,$evasion,  $alliance, $gold, $brewery,$lastupdate,$sit,$sit1,$sit2,$protection,$protect,$cp,$password,$plust,$vvillages,$email,$refer,$heroD,$goldclub,$checker, $mchecker;
    public $gotgold = 0;
	public $bonus = 0;
    public $bonus1 = 0;
    public $bonus2 = 0;
    public $bonus3 = 0;
    public $bonus4 = 0;
	public $offbonus = 0;
	public $defbonus = 0;
    public $villages = array();
    public $right;
    public $lowres = 0;

    function Session() {

		//////////////////////
        session_start();
        $_SESSION['numba']=0;
        $this->logged_in = $this->checkLogin();
        $this->SurfControl();
        if(isset($_GET['newdid']) && is_numeric($_GET['newdid'])) {
            $_SESSION['wid'] = $_GET['newdid'];
        }
		userActivityMonitor($this->uid);
    }

    public function Login($user,$lowres) {
        global $generator,$database;		

        $_SESSION['username'] = $user;
        $this->logged_in = true;
        $_SESSION['checker'] = $generator->generateRandStr(3);
        $_SESSION['mchecker'] = $generator->generateRandStr(5);
        $this->PopulateVar();
        $_SESSION['dorf']=1;
        $_SESSION['lowres']=(int)$lowres;
        $_SESSION['wid'] = $this->villages[0];
        $this->sit = $_SESSION['sit'];
        $_SESSION['timestamp']=time()-30;

		//$database->isWinner();
        header("Location: dorf1.php");
    }




    public function Logout() {
        global $database;
		//$database->PerformClose();
		$this->logged_in = false;
		
        unset($_SESSION);
        session_destroy();

    }

    public function changeChecker() {
        global $generator;
        $this->checker = $_SESSION['checker'] = $generator->generateRandStr(3);
        $this->mchecker = $_SESSION['mchecker'] = $generator->generateRandStr(5);
        $this->mescheck = $_SESSION['mescheck'] = $generator->generateRandStr(3);
    }

    private function checkLogin(){
        global $database;
        //print_r($_SESSION);
        if(isset($_SESSION['username']) && isset($_SESSION['sessid'])) {
            $mas=count($database->GetAOnline2($_SESSION['sessid']));

            if(!$mas){ $this->Logout();return false;}

            //Get and Populate Data
            $this->PopulateVar();

            //update database

            if(time()-$_SESSION['timestamp']>30){$_SESSION['timestamp']=time();
                $database->updateUserField($_SESSION['username'], "timestamp", time(),0);
            }

            return true;


        }
        return false;
    }

    private function PopulateVar() {
        global $database;

        $u = $database->getUserSes($_SESSION['username']);
        $this->username = $_SESSION['username'];
        $this->lowres = $_SESSION['lowres'];
        $this->refer = $u['invited'];
        $this->password = $u['password'];
        $this->email = $u['email'];
        $this->uid = $u['id'];
		$_SESSION['id_user'] = $this->uid;
        $this->access = $u['access'];
        $this->link=$_SESSION['dorf'];
        $this->plus = ($u['plus'] > time());
        $this->brewery = $u['brewery'];
        $this->deleting =$u['deleting'];
        $this->tribe = $u['tribe'];
        $this->lastupdate = $u['lastupdate'];
        $this->alliance = $_SESSION['alliance_user'] = $u['alliance'];
        $this->checker = $_SESSION['checker'];
        $this->mchecker = $_SESSION['mchecker'];
        $this->evasion = $u['evasion'];
        $this->sit1 = $u['sit1'];
        $this->quest = $u['quest'];
        $this->sit2 = $u['sit2'];
        $this->protection = $u['regtime']+PROTECTION;
        $this->protect = $u['protect'];		        
		$this->main_id = null;
        $this->cp = floor($u['cp']);
        $this->gold  = $_SESSION['gold'] = $u['gold'];
        $_SESSION['ok'] = $u['ok'];

        $this->bonus1 = $u['b1'];
        $this->bonus2 = $u['b2'];
        $this->bonus3 = $u['b3'];
        $this->bonus4 = $u['b4'];	
		$this->gotgold = $u['breceived'];
		$this->offbonus = $u['a1'];	
		$this->defbonus = $u['d1'];	
        $this->goldclub  = $u['goldclub'];
        $this->silver = $_SESSION['silver'] = $u['silver'];
        $this->plust = $u['plus'];
        $this->sit=$_SESSION['sit'];
        $this->heroD = $database->WowSoQueryH($this->uid);
		
        $this->vote1 = $u['vote1'];
        $this->vote2 = $u['vote2'];
        $this->vote3 = $u['vote3'];	
		
        $this->share_fb = $u['share_fb'];
        $this->share_gp = $u['share_gp'];
        $this->share_tw = $u['share_tw'];	

        $this->unread=$database->NoticeMessage($this->uid);

        $vilmas=$database->getVillID2($this->uid);
        $adventures=$database->countAdventures($this->uid, $tovil);
        $this->villages = $vilmas[0];
        $this->vvillages = $vilmas[1];
        $this->updateHero();
       // print_r($vilmas[0]);
        if($this->uid > 0 && $u['advtime']+ADV_TIME<time()){ //&& $adventures <= 30 
            //$advs=min((time()-$u['advtime'])/ADV_TIME, (30-$adventures));
            $advs=floor((time()-$u['advtime'])/ADV_TIME);
            for($i=0;$i<$advs;$i++){
               $rvil= rand(0,count($vilmas[0])-1);
			   $tovil=$vilmas[0][$rvil];
			   $database->addAdventure($tovil, $this->uid,1);
            }
            if($advs>0){

            $database->newAdvTime($this->uid,time()-(time()-$u['advtime']-($advs*ADV_TIME)));
            }
        }
		if(!$this->sit){
			$this->right =array('s1'=>1,'s2'=>1,'s3'=>1,'s4'=>1,'s5'=>1,'s6'=>1);
		}else{
			$this->right =array('s1'=>$_SESSION['s1'],'s2'=>$_SESSION['s2'],'s3'=>1,$_SESSION['s3'],'s4'=>$_SESSION['s4'],'s5'=>$_SESSION['s5'],'s6'=>$_SESSION['s6']);
		}
		$this->removeBonuses();
		/*if(empty($u['vote1_link']) || empty($u['vote2_link']) || empty($u['vote3_link'])){
			$this->setVotingLinks();
		}else{
			$this->vote1_link = $u['vote1_link'];
			$this->vote2_link = $u['vote2_link'];
			$this->vote3_link = $u['vote3_link'];
		}*/
		$this->vote1_link = 'http://www.arena-top100.com/index.php?a=in&u=aspida&id='.$this->uid.'x'.SPEED;
		$this->vote2_link = 'http://topg.org/travian-private-servers/in-409660-'.$this->uid.'x'.SPEED;
		$this->vote3_link = 'http://www.gtop100.com/topsites/Travian/sitedetails/Aspida-Servers-89726?vote=1&pingUsername='.$this->uid.'x'.SPEED;
    }
	
	private function setVotingLinks(){	
        global $database;	
		$vote1_link = 'http://www.arena-top100.com/index.php?a=in&u=aspida&id='.$this->uid.'x'.SPEED;
		$vote2_link = 'http://topg.org/travian-private-servers/in-409660-'.$this->uid.'x'.SPEED;
		$vote3_link = 'http://www.gtop100.com/topsites/Travian/sitedetails/Aspida-Servers-89726?vote=1&pingUsername='.$this->uid.'x'.SPEED;

		$vote_links = buildAdFlyLink(
			array($vote1_link,$vote2_link,$vote3_link)
		);

		$this->vote1_link = isset($vote_links[0]['short_url'])?$vote_links[0]['short_url']:$vote1_link;
		$this->vote2_link = isset($vote_links[1]['short_url'])?$vote_links[1]['short_url']:$vote2_link;
		$this->vote3_link = isset($vote_links[2]['short_url'])?$vote_links[2]['short_url']:$vote3_link;
		
		$database->setVoteLinks($this->uid,$this->vote1_link,$this->vote2_link,$this->vote3_link);
	}

	private function removeBonuses(){	
        global $database;	
		if ($this->bonus1 <= time()) {
			$database->removeBonus("b1",$this->uid,$this->bonus1);
		}
		if ($this->bonus2 <= time()) {
			$database->removeBonus("b2",$this->uid,$this->bonus2);
		}
		if ($this->bonus3 <= time()) {
			$database->removeBonus("b3",$this->uid,$this->bonus3);
		}
		if ($this->bonus4 <= time()) {
			$database->removeBonus("b4",$this->uid,$this->bonus4);
		}
		if ($this->vote1 <= time()) {
			$database->removeBonus("vote1",$this->uid,$this->vote1);
		}
		if ($this->vote2 <= time()) {
			$database->removeBonus("vote2",$this->uid,$this->vote2);
		}
		if ($this->vote3 <= time()) {
			$database->removeBonus("vote3",$this->uid,$this->vote3);
		}
		if ($this->share_fb <= time()) {
			$database->removeBonus("share_fb",$this->uid,$this->share_fb);
		}
		if ($this->share_gp <= time()) {
			$database->removeBonus("share_gp",$this->uid,$this->share_gp);
		}
		if ($this->share_tw <= time()) {
			$database->removeBonus("share_tw",$this->uid,$this->share_tw);
		}
	}
	
    private function SurfControl(){
        $page = $_SERVER['SCRIPT_NAME'];
        $pagearray = array("/index.php", "/login.php", "/activate.php", "/anmelden.php", "/first.php",'/password.php');
        if(!$this->logged_in) {
            if(!in_array($page, $pagearray) || $page == "/logout.php") {
                header("Location: /login.php");
                exit();
            }
        } else {
            if(!$this->access && !in_array($page,array("/banned.php","/nachrichten.php"))){
                header("Location: /banned.php");
            }
            if(in_array($page, $pagearray)) {
                header("Location: /dorf1.php");
                exit();
            }

        }
        
        if($this->logged_in and ($_SERVER['SCRIPT_NAME']!="/winner.php" && $_SERVER['SCRIPT_NAME']!="/logout.php" 
        	&& $_SERVER['SCRIPT_NAME']!="/statistiken.php" && $_SERVER['SCRIPT_NAME']!="/nachrichten.php")){
            global $database;        
        	$database->isWinner();
        }
    }
    function updateHero() {
        global $database,$hero_levels,$hero_model;

        $hero_model->heroControll($_SESSION['wid'],$this->villages,$this->heroD);

        //накидываем герою здоровье и уровни
        $timeisrunningout=time()-$this->heroD['lastupdate'];
        $herodone=$miracle1=$miracle2=$miracle3=0;
        $sql="";
        if($this->heroD['dead']==0 && $this->heroD['health']<100) {
            $speed=SPEED;
            if(SPEED>10000){$speed=10000;}
            $hill=$this->heroD['health']+($this->heroD['autoregen']*(($speed/10)+1)*2.5/(24*60*60)*$timeisrunningout);
			//$regen = ($this->heroD['autoregen']/((24*60*60)))*$timeisrunningout;
            if($hill>=1 and $this->heroD['health']<$hill){
                if($hill>100){$hill=100;}
                $sql ="`health`='".$hill."',`lastupdate`='".time()."'";
                $this->heroD['health']=$hill;
				$database->modifyHeroS($sql,$this->heroD['heroid']);
            }
        }
        $i=0;
		if($this->heroD['level']<100){
            for($i=$this->heroD['level'];$i<=99;$i++) {
                if($this->heroD['experience'] < $hero_levels[$i+1]) {
                    break;
                }
            }
        }


        if($this->heroD['experience'] > $hero_levels[99] && $this->heroD['level']==100 ||$this->heroD['level']==99){$herodone=1;}
		if($this->heroD['level'] != $i && !$herodone) {
            //накидываем сразу в окно пользователя обновленные данные
            $this->heroD['level']=$i;

            $sql = "`level`='".$i."',`lastupdate`='".time()."'";
            $database->modifyHeroS($sql,$this->heroD['heroid']);
        }


    }
}
$session = new Session;
$form = new Form;
//делаем работу по созданию объекта $session

$dorf1 = $dorf2 = '';
${'dorf'.$session->link}='active';
