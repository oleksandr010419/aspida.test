<?php
if(!isset($_GET['key']) || empty($_GET['key'])){ header("Location: /"); }

include_once("../../GameEngine/config.php");

include_once("../../GameEngine/DB.php");

include_once("../../GameEngine/Database/db_MYSQL.php");

$tarifs=array("A","B","C","D","E","F","H");
$golds=array(PACK_A_GOLD,PACK_B_GOLD,PACK_C_GOLD,PACK_D_GOLD,PACK_E_GOLD,PACK_F_GOLD,PACK_H_GOLD);
$money=array(PACK_A_PRICE,PACK_B_PRICE,PACK_C_PRICE,PACK_D_PRICE,PACK_E_PRICE,PACK_F_PRICE,PACK_H_PRICE);
$keydec=base64_decode($_GET['key']);
$mas=explode(";",$keydec);
//print_r($mas);
if($mas[0]=="Arina" && $mas[2]==88 && $mas[4]=="Wolf" && in_array($mas[3],$tarifs)) {

    include("class.paypal.php");
    include("../class.http.php");

    $paypal = new PayPal(true);


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
    $paypal->setReturn(HOMEPAGE."/payment/paypal/success.php?key=".$_GET['key']."&yourid=".$yourid);
    $paypal->setCancel(HOMEPAGE."/payment/paypal/failure.php");
    
	
	switch($tarif){
        case "A":
            $res = ($paypal->doExpressCheckout($m, "Package A: ".$gold." Gold")); // EUR
            break;
        case "B":
            $res = ($paypal->doExpressCheckout($m, "Package B: ".$gold." Gold")); // EUR
            break;
        case "C":
            $res = ($paypal->doExpressCheckout($m, "Package C: ".$gold." Gold")); // EUR
            break;
        case "D":
            $res = ($paypal->doExpressCheckout($m, "Package D: ".$gold." Gold")); // EUR
            break;
        case "E":
            $res = ($paypal->doExpressCheckout($m, "Package E: ".$gold." Gold")); // EUR
            break;
        case "F":
            $res = ($paypal->doExpressCheckout($m, "Package F: ".$gold." Gold")); // EUR
            break;
        case "H":
            $res = ($paypal->doExpressCheckout($m, "Package H: ".$gold." Gold")); // EUR
            break;
        
    }
    $final = $paypal->doPayment();
}