<?php
include("GameEngine/config.php");
include("GameEngine/DB.php");
include("GameEngine/Session.php");


$providerId = $_REQUEST['provider'];
$productId = $_REQUEST['product'];


$packages = array(
	"0" => array("name"=>"A","gold"=>PACK_A_GOLD,"price"=>PACK_A_PRICE,'img'=>'Travian_Facelift_1.png','moneyUnit'=>'&euro;'),
	"1" => array("name"=>"B","gold"=>PACK_B_GOLD,"price"=>PACK_B_PRICE,'img'=>'Travian_Facelift_2.png','moneyUnit'=>'&euro;'),
	"2" => array("name"=>"C","gold"=>PACK_C_GOLD,"price"=>PACK_C_PRICE,'img'=>'Travian_Facelift_3.png','moneyUnit'=>'&euro;'),
	"3" => array("name"=>"D","gold"=>PACK_D_GOLD,"price"=>PACK_D_PRICE,'img'=>'Travian_Facelift_4.png','moneyUnit'=>'&euro;'),
	"4" => array("name"=>"E","gold"=>PACK_E_GOLD,"price"=>PACK_E_PRICE,'img'=>'Travian_Facelift_5.png','moneyUnit'=>'&euro;'),
	"5" => array("name"=>"F","gold"=>PACK_F_GOLD,"price"=>PACK_F_PRICE,'img'=>'Travian_Facelift_6.png','moneyUnit'=>'&euro;'),
	"6" => array("name"=>"H","gold"=>PACK_H_GOLD,"price"=>PACK_H_PRICE,'img'=>'Travian_Facelift_6.png','moneyUnit'=>'&euro;'),
	//"S" => array("gold"=>20,"price"=>0.2,'img'=>'Travian_Facelift_1.png'),
	//"L" => array("gold"=>1,"price"=>0.01,'img'=>'Travian_Facelift_1.png'),
);
$package            = $packages[$productId];

$mas= 'Arina;'.$session->email.';88;'.$package ['name'].';Wolf'; 
$keydec=base64_encode($mas);
$paymentOptions     = array('5'=>array('name'=>'paypal','img'=>'paypal.png','payment_data'=>array('post_url'=>'payment/paypal/payment.php?key='.$keydec)),
							'6'=>array('name'=>'paygol','img'=>'paygol.png','payment_data'=>array('post_url'=>'payment/paygol/payment.php?key='.$keydec)),
							'7'=>array('name'=>'skrill','img'=>'skrill.gif','payment_data'=>array('post_url'=>'payment/skrill/payment.php?key='.$keydec)),
							'8'=>array('name'=>'coin','img'=>'coin_blue.png','payment_data'=>array('post_url'=>'payment/coin/payment.php?key='.$keydec)));



$str                = "NO-REFUND-".$session->email."-".time(); // join(array_map('chr', str_split($numbers, 3)));
$security_code      = join(array_map(function ($n) { return sprintf('%03d', $n); }, unpack('C*', $str)));

ob_start();
$vars['order']    = "$security_code";
$vars['package']  = $package;
//die(print_r($vars['package']));
//$vars['package']['moneyUnit'] = "&euro;";
$vars['checkout'] = $paymentOptions[$providerId];


include("Templates/Plus/tabs/tgpay.php");
echo ob_get_clean();
?>