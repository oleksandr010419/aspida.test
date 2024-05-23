<?php
if(!isset($_GET['key']) || empty($_GET['key'])){ header("Location: /"); }

include_once("../../GameEngine/config.php");
include_once("../../GameEngine/Database.php");

include_once(__DIR__."/../../../scripts/money_round/main.php");

$tarifs=array("A","B","C","D","E","F","H");
$golds=array(PACK_A_GOLD,PACK_B_GOLD,PACK_C_GOLD,PACK_D_GOLD,PACK_E_GOLD,PACK_F_GOLD,PACK_H_GOLD);
$money=array(PACK_A_PRICE,PACK_B_PRICE,PACK_C_PRICE,PACK_D_PRICE,PACK_E_PRICE,PACK_F_PRICE,PACK_H_PRICE);
$keydec=base64_decode($_GET['key']);
$mas=explode(";",$keydec);
//print_r($mas);

if($mas[0]=="Arina" && $mas[2]==88 && $mas[4]=="Wolf" && in_array($mas[3],$tarifs)) {

    include_once("class.paypal.php");
    include_once("../class.http.php");

    $paypal = new PayPal(true);


    $email=$mas[1];
    $tarif=$mas[3];

    $paypal->setCancel(HOMEPAGE."payment/failure.php");
    $paypal->setReturn(HOMEPAGE."payment/success.php?key={$_GET['key']}");
    $final = $paypal->doPayment();
	
	

    if($final['ACK'] == 'Success') {
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
                $gold=$golds[6];$m=$money[6];
                break;
        }
        $p=array('I'=>$_GET['yourid']);
        $userinfa=$database->row("SELECT email,gold,ip,tarif FROM `buygold` WHERE `id`=:I",$p);
        //$userinfa=$lin[0];
        $p=array('E'=>$userinfa['email']);
		if(WW_PLAN > time()){
			$userinfa['gold']+= $userinfa['gold']*(3/10);
		}
		$database->modifyGold($database->getUserWithEmail($userinfa['email']),$userinfa['gold'],1,"Bought gold by PayPal");
        $p=array('I'=>$_GET['yourid']);
        $database->query("UPDATE `buygold` SET `status`='1' WHERE `id`=:I",$p);
        $p=array('ID'=>$_GET['yourid'],'E'=>$userinfa['email'],'G'=>$userinfa['gold'],'IP'=>$userinfa['ip']);
        $database->query("INSERT INTO log (`id`,`userid`,`email`,`gold`,`ip`,`time`,`server`) VALUES ('0',:ID,:E,:G,:IP,'" . time() . "','1')",$p);
		
		$money = new Money();

		$money->insertPayment($userinfa['email'], $m * 100);
        $message = "Payment completed successfully!";

    } else {
		$message = "Error code: <b>".$final['L_ERRORCODE0']."</b><br/><b>Error:</b> ".$final['L_SHORTMESSAGE0']."<br/><b>Addidentional:</b> ".$final['L_LONGMESSAGE0'];
	}
} else {
    // not succesful
    $message = "There was a problem with Your payment. Unable to process.";
}

include_once "../../GameEngine/Village.php";
//header("refresh:5;url=/dorf1.php" );
?>


<!DOCTYPE html>

<html>

<?php include_once("../../Templates/html.php");?>

<body class="v35 <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> perspectiveResources">



<script type="text/javascript">
	setTimeout( function(){ 
		//window.close();
	}  , 3000 );

    window.ajaxToken = 'de3768730d5610742b5245daa67b12cd';



</script>



<div id="background">

    <div id="headerBar"></div>

    <div id="bodyWrapper">

        <div id="header">

            <?php

            include_once("../../Templates/topheader.php");

            ?>

        </div>

        <div id="center">

            <?php

           // include("../Templates/sideinfo.php");?>

           <div id="sidebarBeforeContent" class="sidebar beforeContent"></div>         

            <div id="contentOuterContainer">                

                <?php  include("../../Templates/res.php");      ?>

                <div class="contentTitle">

                    <a id="closeContentButton" class="contentTitleButton" href="dorf1.php">&nbsp;</a>

                    <a id="answersButton" class="contentTitleButton" href="http://t4.answers.travian.com/index.php?aid=106#go2answer" target="_blank">&nbsp;</a>

                </div>

                <div class="contentContainer">

                    <div id="content" class="hero_editor">

                        <h1 class="titleInHeader">PayPal Checkout</h1>

                        <div class="boxes boxesColor gray adventureStatusMessage">

                        <div class="boxes-tl"></div>

                        <div class="boxes-tr"></div>

                        <div class="boxes-tc"></div>

                        <div class="boxes-ml"></div>

                        <div class="boxes-mr"></div>

                        <div class="boxes-mc"></div>

                        <div class="boxes-bl"></div>

                        <div class="boxes-br"></div>

                        <div class="boxes-bc"></div>

                        <div class="boxes-contents"> <?php echo $message;?> </div></div>

                        

                        <h4 class="spacer"><img class="chest" src="../../img/treasure-box1.png" alt="PayPal Checkout" /></h4>

                    </div>

                <div class="clear"></div>

                </div>

            </div>

            <div id="ce"></div>

        </div>

        <!--/ GtopStats.com - (begin) v2.1/-->

</body>

<script type="text/javascript" language="javascript">

var site_id = 79861;

var gtopSiteIcon = 4;

var _gtUrl = (("https:" == document.location.protocol) ? "https://secure." : "http://fx.");

document.write(unescape("%3Cscript src='" + _gtUrl + "gtopstats.com/js/gTOP.js' type='text/javascript'%3E%3C/script%3E"));

</script>

<!--/ GtopStats.com - (end) v2.1/-->

</html>