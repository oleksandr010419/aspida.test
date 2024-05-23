<?php
if(!isset($_GET['key']) || empty($_GET['key'])){ header("Location: /"); }
include_once("../../GameEngine/config.php");
include_once("../../GameEngine/DB.php");
include_once("../../GameEngine/Database/db_MYSQL.php");

$tarifs=array("A","B","C","D","E","F");
$golds=array(PACK_A_GOLD,PACK_B_GOLD,PACK_C_GOLD,PACK_D_GOLD,PACK_E_GOLD,PACK_F_GOLD);
$money=array(PACK_A_PRICE,PACK_B_PRICE,PACK_C_PRICE,PACK_D_PRICE,PACK_E_PRICE,PACK_F_PRICE);
$keydec=base64_decode($_GET['key']);
$mas=explode(";",$keydec);
if($mas[0]=="Arina" && $mas[2]==88 && $mas[4]=="Wolf" && in_array($mas[3],$tarifs)) {


    include("../class.http.php");
    include("SkrillRequest.php");
    include("SkrillClient.php");

    $email=$mas[1];
    $tarif=$mas[3];
	$descr = "";

    switch($tarif){
        case "A": $gold=$golds[0];
			$m=$money[0];
			$descr = "Package A: ".$gold." Gold";
            break;
        case "B": $gold=$golds[1];
			$m=$money[1];
			$descr = "Package B: ".$gold." Gold";
            break;
        case "C": $gold=$golds[2];
			$m=$money[2];
			$descr = "Package C: ".$gold." Gold";
            break;
        case "D": $gold=$golds[3];
			$m=$money[3];
			$descr = "Package D: ".$gold." Gold";
            break;
        case "E": $gold=$golds[4];
			$m=$money[4];
			$descr = "Package E: ".$gold." Gold";
            break;
        case "F": $gold=$golds[5];
			$m=$money[5];
			$descr = "Package F: ".$gold." Gold";
            break;
        case "S": $gold=$golds[6];
			$m=$money[6];
			$descr = "Package AS: ".$gold." Gold";
            break;
        case "L": $gold=$golds[7];
			$m=$money[7];
			$descr = "Package L: ".$gold." Gold";
            break;
    }
    $ip=$_SERVER['REMOTE_ADDR'];
    $p=array('E'=>$email,'T'=>$tarif,'G'=>$gold,'IP'=>$ip);
    $q="INSERT INTO buygold (`id`,`email`,`tarif`,`gold`,`time`,`ip`,`status`) VALUES (0,:E,:T,:G,'".time()."' ,:IP,'0')";
    $database->query($q,$p);
    $yourid=$database->get_last_id();
	
	$request = new SkrillRequest();
	$request->pay_to_email = 'demoqco@sun-fish.com';//change me stellaafr@gmail.com
	$request->recipient_description = "ASPIDANETWORK";
	$request->detail1_description = $descr;
	$request->transaction_id = SPEED."_".$yourid;
	$request->return_url = HOMEPAGE."/payment/paypal/success.php";
	$request->cancel_url = HOMEPAGE."/payment/paypal/failure.php";
	$request->status_url2 = "verify@aspidanetwork.com";//change me
	$request->status_url = "aspidanetwork.com/scripts/paygol/skrill_ipn.php";
	$request->amount = $m;
	$request->currency = 'GBP';
	$request->language = 'EN';
	$request->prepare_only = 1;

	$client = new SkrillClient($request);	
	header("Location: https://pay.skrill.com/?sid=".$client->generateSID()); //return redirect url	
}