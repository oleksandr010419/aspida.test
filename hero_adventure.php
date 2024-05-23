<?php
include("GameEngine/Village.php");
?>
<!DOCTYPE html>
<html>
<?php include("Templates/html.php");?>
<body class="v35 <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> hero_adventure <?php if($dorf1==''){echo 'perspectiveBuildings';}else{ echo 'perspectiveResources';} ?>">
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
                    <div id="content" class="hero hero_adventure">
                        <h1 class="titleInHeader"><?php echo U0; ?></h1>
<div class="contentNavi subNavi">
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_inventory.php"><span class="tabItem"><?=herohero0?></span></a></div>
				</div>
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero.php"><span class="tabItem"><?=herohero1?></span></a></div>
				</div>
				<div class="container active">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_adventure.php"><span class="tabItem"><?=herohero2?></span></a></div>
				</div>
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_auction.php"><span class="tabItem"><?=herohero3?></span></a></div>
				</div><div class="clear"></div>
		</div><script type="text/javascript">
					window.addEvent('domready', function()
					{
						$$('.subNavi').each(function(element)
						{
							new Travian.Game.Menu(element);
						});
					});
				</script>
<table cellspacing="1" cellpadding="1">
	<thead>
		<tr>
			<th class="location" colspan="2"><center><?=HEROA0?></th>
			<th class="moveTime"><center><?=HEROA1?></th>
			<th class="difficulty"><center><?=HEROA2?></th>
			<th class="timeLeft"><center><?=HEROA3?></th>
			<th class="goTo"><center><?=HEROA4?></th>
		</tr>
	</thead>
	<tbody>

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

    <div class="boxes-contents cf">		<div class="heroStatusMessage header">

                 <img alt ="В родной деревне" src="img/x.gif" class="heroStatus100" />
               <?=$where2?>
               	</div>
		

</div>
</div>
        <br />

<?php
$database->query("DELETE FROM adventure WHERE `time`<= '".time()."' and `end`='0'");
$sql = $database->query("SELECT * FROM adventure WHERE `end` = '0' and `uid` = '".$session->uid."' ORDER BY time ASC");
$query = count($sql);

$outputList = '';
if(!isset($timer)){
$timer = 1;
}
if($query == 0) {
    $outputList .= "<td colspan=\"6\" class=\"none\"><center>".HEROA5."</center></td>";
}else{
    $from = array('x'=>$village->coor['x'], 'y'=>$village->coor['y']);
	foreach($sql as $row){



$to = array('x'=>$row['x'], 'y'=>$row['y']);
$speed = $session->heroD['speed'];
$time = $database->procDistanceTime2($from,$to,$speed,1);


switch($row['type']) {
case 1:
$tname = HEROA7;
break;
case 2:
$tname =  HEROA8;
break;
case 3:
$tname =  HEROA9;
break;
case 4:
$tname =  HEROA10;
break;
}

	$outputList .= "<tr><td class=\"location\">".$tname."</td>";

	$outputList .= '<td class="coords"><a>
        <span class="coordinates coordinatesAligned">
        <span class="coordinateHeroX">('.$row['x'].'</span>
        <span class="coordinatePipe">|</span>
        <span class="coordinateHeroY">'.$row['y'].')</span>
        </span><span class="clear"></span>
        </a></td>';
    $outputList .= "<td class=\"moveTime\"> ".$generator->getTimeFormat($time)." </td>";
	if(!$row['dif']){
		$outputList .= "<td class='difficulty'><img src='img/x.gif' class='adventureDifficulty2' title=".dif_adv1." /></td>";
	}else{
		$outputList .= "<td class='difficulty'><img src='img/x.gif' class='adventureDifficulty0' title=".dif_adv2." /></td>";
	}
	$outputList .= "<td class=\"timeLeft\"><span id=\"timer".$timer."\">".$generator->getTimeFormat($row['time']-time())."</span></td>";
	$outputList .= "<td class=\"goTo\"><a class=\"gotoAdventure arrow\" href=\"a2b.php?id=".$row['wref']."&h=1\">".HEROA6."</a></td></tr>";
    $timer++;
	}
}
echo $outputList;
?>

    </tbody>
</table>
						<div class="finishNow">
							<button type="button" class="gold buyAdventure" silver="" id="buttoneEbaRvLfuIeWy" onclick="window.location.href = 'hero_adventure.php?action=buy'; return false;"><div class="button-container addHoverClick ">
								<div class="button-background">
									<div class="buttonStart">
										<div class="buttonEnd">
											<div class="buttonMiddle"></div>
										</div>
									</div>
								</div>
								<div class="button-content"><?php echo buy_adv1?><img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">2</span></div></div>
							</button>   
						</div>
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
<?php 
if($_GET['action'] == 'buy'){
		$error = true;
		if($session->gold >= 2) {			
			include_once("GameEngine/Database.php");
			$database->addAdventure($village->wid, $session->uid,1);
			$database->modifyGold($session->uid,2,0);
			$done1 =  "Your purchace is successful.";
			$error = false;
		}else{
			$done1 = "Not enough gold coin";
		}	
		header("Location: hero_adventure.php");
}
?>