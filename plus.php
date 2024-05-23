<?php
include "GameEngine/Village.php";
include("GameEngine/Building.php");




//if(isset($_GET['id']) && !is_numeric($_GET['id'])) die('Hacking Attemp');
if(isset($_GET['utakegold']) && !is_numeric($_GET['utakegold'])) die('Hacking Attemp');

$database->isWinner();
 $schek =$session->checker;
if(isset($_GET['utakegold'])  and ($_GET['checker'])==$schek){
    $Refid=$database->FilterIntValue($_GET['utakegold']);
    $referer=$database->getUserField($Refid,'invited',0);
    $pop=$database->getVSumField($Refid,'pop');
    if($referer==$session->uid && $pop>=REF_POP){
	$Gu=$session->gold;
	$Gusum=$Gu+REF_GOLD;

	if($_GET['checker']==$session->checker){
		$database->modifyGold($session->uid,REF_GOLD,1,"Referal bonus");
        $database->query("UPDATE users set invited=0 where id = '".$Refid."'");
        $database->query("INSERT INTO `referals` (`id`,`uid`,`referer`) VALUES ('0','".$session->uid."','".$Refid."')");
    }
    $session->changeChecker();

    header("Location: plus.php?id=3");
    exit();
    }
     }

?>
<!DOCTYPE html>
<html>
<?php include("Templates/html.php");?>
<body class="v35 <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> hero <?php if($dorf1==''){echo 'perspectiveBuildings';}else{ echo 'perspectiveResources';} ?>">
<script type="text/javascript">
    window.ajaxToken = 'de3768730d5610742b5245daa67b12cd';
</script>
<div id="background">
    <div id="headerBar"></div>
    <div id="bodyWrapper">

        <div id="header">

            <?php
            include("Templates/topheader.php");
            include("Templates/toolbar.php");

            ?>

        </div>
        <div id="center">


            <?php include("Templates/sideinfo.php"); ?>

            <div id="contentOuterContainer" class="size1">

                <?php include("Templates/res.php"); ?>
                <div class="contentTitle"><a id="closeContentButton" class="contentTitleButton" href="dorf<?=$session->link?>.php" title="Close window">&nbsp;</a>
                    <a id="answersButton" class="contentTitleButton" href="http://t4.answers.travian.com/index.php?aid=106#go2answer" target="_blank" title="Travian Answers">&nbsp;</a></div>
                <div class="contentContainer">
                    <div id="content" class="hero_editor">
                        <script type="text/javascript">
                            window.addEvent('domready', function()
                            {
                                $$('.subNavi').each(function(element)
                                {
                                    new Travian.Game.Menu(element);
                                });
                            });
                        </script>

<?php
if(!isset($_GET['change'])){
if(isset($_GET['id'])) {
$id = intval($_GET['id']);
} else {
$id = "";
}
if($_GET['id']=="traviann" && (EXTRA_MENU )){
	include("Templates/Plus/traviann.php");
}
if($_GET['id']=="pbuild" && (EXTRA_MENU )){
	include("Templates/Plus/pbuild.php");
}
elseif ($id == 3 || $id == 1 || $id==0) {
include("Templates/Plus/3.php");
}
elseif ($id == 5) {
include("Templates/Plus/5.php");
}elseif($id == 9){	
include("Templates/Plus/9.php");}
elseif ($id == 6) {
include("Templates/Plus/bank.php");
}
$gold=$session->gold;
if ($id == 7 && $session->right['s4']) {
	if($gold>=2){
$building->finishAll();
header("Location: plus.php?id=3&fin");
        exit();
}else{ header("Location: plus.php?id=3&fig");
        exit();}
}


if ($id == 15) {
    if(!$session->goldclub && $session->right['s4']){
    $uid=$session->uid;
    $database->BuyClub($uid,$session->gold);
    }
    header("Location: plus.php?id=3");exit();
}
elseif ($id >= 16) {
include("Templates/Plus/3.php"); exit();
}
}else{
    include("Templates/Plus/7.php");
}

?>


                        <div class="clear">&nbsp;</div>
                    </div>
                    <div class="clear"></div>


                </div>
                <div class="contentFooter">&nbsp;</div>

            </div>
            <?php
            include("Templates/rightsideinfor.php");
            ?>
            <div class="clear"></div>
        </div>
        <?php

        include("Templates/header.php");
        ?>
    </div>
    <div id="ce"></div>
</div>
</body>
</html>