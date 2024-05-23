<?php
if(!isset($_GET['key']) || empty($_GET['key'])){ header("Location: /"); }

include("../../GameEngine/config.php");

include("../../GameEngine/DB.php");

include("../../GameEngine/Database/db_MYSQL.php");

include(__DIR__."/../../../scripts/money_round/main.php");

$tarifs=array("A","B","C","D","E","F","H");
$golds=array(PACK_A_GOLD,PACK_B_GOLD,PACK_C_GOLD,PACK_D_GOLD,PACK_E_GOLD,PACK_F_GOLD,PACK_H_GOLD);
$money=array(PACK_A_PRICE,PACK_B_PRICE,PACK_C_PRICE,PACK_D_PRICE,PACK_E_PRICE,PACK_F_PRICE,PACK_H_PRICE);
$keydec=base64_decode($_GET['key']);
$mas=explode(";",$keydec);
//print_r($mas);
if($mas[0]=="Arina" && $mas[2]==88 && $mas[4]=="Wolf" && in_array($mas[3],$tarifs)) {

    include("class.paygol.php");
    include("../class.http.php");

    $paygol = new PayGol(true);

    $email=$mas[1];
    $tarif=$mas[3];

    switch($tarif){
        case "A": $gold=$golds[0];$m=$money[0];
            break;
        case "B": $gold=$golds[1];$m=$money[1];
            break;
        case "C": $gold=$golds[2];$m=$money[2];
            break;
        case "D": $gold=$golds[3];$m=$money[3];
            break;
        case "E": $gold=$golds[4];$m=$money[4];
            break;
        case "F": $gold=$golds[5];$m=$money[5];
            break;
        case "H": $gold=$golds[6];$m=$money[6];
            break;
        }
    $ip=$_SERVER['REMOTE_ADDR'];
    $p=array('E'=>$email,'T'=>$tarif,'G'=>$gold,'IP'=>$ip);
    $q="INSERT INTO buygold (`id`,`email`,`tarif`,`gold`,`time`,`ip`,`status`) VALUES (0,:E,:T,:G,'".time()."' ,:IP,'0')";

    $database->query($q,$p);
    $yourid=$database->get_last_id();
    $paygol->setReturn(HOMEPAGE."/payment/paygol/success.php?key=".$_GET['key']."&yourid=".$yourid);
    $paygol->setCancel(HOMEPAGE."/payment/paygol/failure.php");
	$serv_id = SPEED.'_'.$yourid;//test;
	
    switch($tarif){
        case "A":
            $res = ($paygol->doExpressCheckout($serv_id, $m, "Package A: ".$gold." Gold")); // EUR
            break;
        case "B":
            $res = ($paygol->doExpressCheckout($serv_id, $m, "Package B: ".$gold." Gold")); // EUR
            break;
        case "C":
            $res = ($paygol->doExpressCheckout($serv_id, $m, "Package C: ".$gold." Gold")); // EUR
            break;
        case "D":
            $res = ($paygol->doExpressCheckout($serv_id, $m, "Package D: ".$gold." Gold")); // EUR
            break;
        case "E":
            $res = ($paygol->doExpressCheckout($serv_id, $m, "Package E: ".$gold." Gold")); // EUR
            break;
        case "F":
            $res = ($paygol->doExpressCheckout($serv_id, $m, "Package F: ".$gold." Gold")); // EUR
            break;
		case "H":
            $res = ($paygol->doExpressCheckout($serv_id, $m, "Package H: ".$gold." Gold")); // EUR
            break;
    }
    //$final = $paygol->doPayment();
	
	
	/*if($final['ACK'] == 'Success') {
        switch($tarif) {
            case "A":
                $gold=$golds[0];$m=$money[0];
                break;
            case "B":
                $gold=$golds[1];$m=$money[1];
                break;
            case "C":
                $gold=$golds[2];$m=$money[2];
                break;
            case "D":
                $gold=$golds[3];$m=$money[3];
                break;
            case "E":
                $gold=$golds[4];$m=$money[4];
                break;
            case "F":
                $gold=$golds[5];$m=$money[5];
                break;
			case "H":
                $gold=$golds[5];$m=$money[6];
                break;
        }
        $p=array('I'=>$_GET['yourid']);
        $userinfa=$database->row("SELECT email,gold,ip,tarif FROM `buygold` WHERE `id`=:I",$p);
        //$userinfa=$lin[0];

        $p=array('E'=>$userinfa['email']);
        //$database->query("UPDATE `users` SET `gold`=`gold`+".$userinfa['gold']." WHERE `email`=:E",$p);
		$database->modifyGold($database->getUserWithEmail($userinfa['email']),$userinfa['gold'],1,"Bought gold by PayPal");
        $p=array('I'=>$_GET['yourid']);
        $database->query("UPDATE `buygold` SET `status`='1' WHERE `id`=:I",$p);
        $p=array('ID'=>$_GET['yourid'],'E'=>$userinfa['email'],'G'=>$userinfa['gold'],'IP'=>$userinfa['ip']);
        $database->query("INSERT INTO log (`id`,`userid`,`email`,`gold`,`ip`,`time`,`server`) VALUES ('0',:ID,:E,:G,:IP,'" . time() . "','0')",$p);
		
		$money = new Money();

		$money->insertPayment($userinfa['email'], $m * 100);
        $message = "Payment completed successfully!";

    } else {
		$message = "Error code: <b>".$final['L_ERRORCODE0']."</b><br/><b>Error:</b> ".$final['L_SHORTMESSAGE0']."<br/><b>Addidentional:</b> ".$final['L_LONGMESSAGE0'];
	}*/
}