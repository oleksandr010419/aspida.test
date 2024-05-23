<?php
include "GameEngine/Village.php";
include "GameEngine/Units.php";

if(isset($_GET['z']) && !is_numeric($_GET['z'])) die('Hacking Attemp');
if(isset($_GET['w']) && !is_numeric($_GET['w'])) die('Hacking Attemp');
if(isset($_GET['r']) && !is_numeric($_GET['r'])) die('Hacking Attemp');
if(isset($_GET['o']) && !is_numeric($_GET['o'])) die('Hacking Attemp');
if(isset($_GET['id']) && !is_numeric($_GET['id'])) die('Hacking Attemp');
$id=0;
if(isset($_GET['id'])) {
	$id = $database->FilterIntValue($_GET['id']);
}
if(isset($_GET['id'])) {
	$id = $database->FilterIntValue($_GET['id']);

}
if(isset($_GET['w'])) {
	$w = $database->FilterIntValue($_GET['w']);
}
if(isset($_GET['r'])) {
	$r = $database->FilterIntValue($_GET['r']);
}

$checked=$disabledr=$disabled=$disableN="";
if($session->sit == 1){
    $disabled ="disabled=disabled";
}
if(!$session->right['s1']){
    $disableN="disabled='disabled'";
}
if(!$session->right['s2']){
    $disabler="disabled='disabled'";
}
if(isset($_GET['z'])) {
    $z=$database->FilterIntValue($_GET['z']);

	if($database->isVillageOases($z)){

        $oasi=$database->checkviloas2($z);
if($oasi['owner'] == 2){$disabledr ="disabled=disabled"; $disabled ="disabled=disabled"; $checked="checked=checked";}


}
}

	$process = $units->procUnits($_POST);
	$database->isWinner();
	
?>
<!DOCTYPE html>
<html>
<?php include("Templates/html.php");?>

<body class="v35 <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> a2b perspectiveBuildings  ">
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
                <div class="contentTitle"><a id="closeContentButton" class="contentTitleButton" href="dorf<?=$session->link?>.php" title="<?=cls_win?>">&nbsp;</a>
                    <a id="answersButton" class="contentTitleButton" href="http://t4.answers.travian.com/index.php?aid=106#go2answer" target="_blank" title="Travian Answers">&nbsp;</a></div>
                <div class="contentContainer">
                    <div id="content" class="a2b">
                        <h1 class="titleInHeader"><?php echo OTPRAV1;?></h1>

<?php

		if(!empty($id)) {
if(isset($_GET['s'])){
			include("Templates/a2b/newdorf.php");
}elseif(isset($_GET['h'])){
                include "Templates/a2b/adventure.php";
            }
		} else
			if(isset($w)) {
				$enforce = $database->getEnforceArray($w, 0);
              //  echo $enforce['vref']; print_r($village->oasisowned); die;
				if($enforce['vref'] == $village->wid || in_array($enforce['vref'],array($village->oasisowned[0]['wref'],$village->oasisowned[1]['wref'],$village->oasisowned[2]['wref']))) {
					$to = $database->getVillage($enforce['from']);
					$ckey = $w;
					include("Templates/a2b/sendback.php");
				} else {
					include("Templates/a2b/units.php");
					include("Templates/a2b/search.php");
				}
			} else
				if(isset($r)) {
					$enforce = $database->getEnforceArray($r, 0);
					if($enforce['from'] == $village->wid) {
						$to = $database->getVillage($enforce['from'] || in_array($enforce['vref'],array($village->oasisowned[0]['wref'],$village->oasisowned[1]['wref'],$village->oasisowned[2]['wref'])));
						$ckey = $r;
						include("Templates/a2b/sendback.php");
					} else {
						include("Templates/a2b/units.php");
						include("Templates/a2b/search.php");
					}
				}  else {
					if(isset($process['0'])) {
						$coor = $database->getCoor($process['0']);
						include("Templates/a2b/attack.php");
					} else {
						include("Templates/a2b/units.php");
						include("Templates/a2b/search.php");
					}
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

