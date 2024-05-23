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

	$cp_merchant_id = '5446e296d610b5575c159e9faea56e21';
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
			$descr = "Package S: ".$gold." Gold";
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
	
	$payment_url = 'https://www.coinpayments.net/index.php?';
	$parms = array(
		'cmd' => '_pay_auto',
		'reset' => '1',
		'merchant' => $cp_merchant_id,
		'amountf' => $m,
		'currency' => 'USD',
		'want_shipping' => '0',
		'custom' => SPEED."_".$yourid,
		'item_name' => $descr,
		'success_url'      => HOMEPAGE."/payment/coin/success.php",
		'cancel_url'       => HOMEPAGE."/payment/coin/failure.php",
		//'ipn_url'     => HOMEPAGE."/scripts/paygol/coin_ipn.php",
	);
	$payment_url .= http_build_query( $parms, '', '&' );
	
	header("Location: ".$payment_url); //return redirect url	
}