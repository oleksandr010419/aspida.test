<?php

include "GameEngine/Village.php";


require_once ("GameEngine/Ranking.php");
$ranking->PlayerClimber();
if(!isset($_GET['id'])){$_GET['id']=1;}
$id=$database->filterIntValue($database->filterVar($_GET['id']));
$_GET['id']=$id;
if(isset($id) && !is_numeric($id)) die('Hacking Attemp');
/*if(isset($_GET['rank'])){$_GET['rank']=$database->filterIntValue($database->filterVar($_GET['rank']));}
if(isset($_GET['rank']) && !is_numeric($_GET['rank'])) die('Hacking Attemp');
if(isset($_POST['rank'])){$_POST['rank']=$database->filterIntValue($database->filterVar($_POST['rank']));}
if(isset($_POST['rank']) && !is_numeric($_POST['rank'])) die('Hacking Attemp');*/
$ranking->procRankReq($_GET);
$ranking->procRank($_POST);

?>
<!DOCTYPE html>
<html>
<?php include("Templates/html.php");?>


<body class="v35 <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> statistics <?php if($dorf1==''){echo 'perspectiveBuildings';}else{ echo 'perspectiveResources';} ?>">
<script type="text/javascript">
    window.ajaxToken = 'de3768730d5610742b5245daa67b12cd';
</script>
<div id="background">
    <div id="headerBar"></div>
    <div id="bodyWrapper">

        <div id="header">

                <?php
                include("Templates/topheader.php"); // mehdi jan injaro man edit kardam bordam tu hamin file ke berim baghie ja ha ham include konim!
                include("Templates/toolbar.php"); // mehdi jan injaro man edit kardam bordam tu hamin file ke berim baghie ja ha ham include konim!

                ?>

        </div>
        <div id="center">

            <?php include("Templates/sideinfo.php"); ?>

            <div id="contentOuterContainer" class="size1">
                <?php include("Templates/res.php"); ?>

                <div class="contentTitle">
                    <a id="closeContentButton" class="contentTitleButton" href="dorf<?=$session->link?>.php" title="Close window">&nbsp;</a>
                    <a id="answersButton" class="contentTitleButton" href="http://t4.answers.travian.com/index.php?aid=106#go2answer" target="_blank" title="Travian Answers">&nbsp;</a>						</div>
                <div class="contentContainer">
                    <div id="content" class="statistics">
                        <script type="text/javascript">
                            window.addEvent('domready', function()
                            {
                                $$('.subNavi').each(function(element)
                                {
                                    new Travian.Game.Menu(element);
                                });
                            });
                        </script>


                        <h1 class="titleInHeader"><?=HEADER_STATS?></h1>
                        <div class="contentNavi subNavi">
                            <div title="" <?php if(!isset($_GET['id']) || (isset($_GET['id']) && ($_GET['id'] == 1 || $_GET['id'] == 31 || $_GET['id'] == 32 || $_GET['id'] == 7))) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
                                <div class="background-start">&nbsp;</div>
                                <div class="background-end">&nbsp;</div>
                                <div class="content"><a href="statistiken.php"><span class="tabItem"><?=STATISTIC28?></span></a></div>
                            </div>
                            <div title="" <?php if(isset($_GET['id']) && ($_GET['id'] == 4 || $_GET['id'] == 41 || $_GET['id'] == 42 || $_GET['id'] == 43)) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
                                <div class="background-start">&nbsp;</div>
                                <div class="background-end">&nbsp;</div>
                                <div class="content"><a href="statistiken.php?id=4"><span class="tabItem"><?=STATISTIC29?></span></a></div>
                            </div>
                            <div title="" <?php if(isset($_GET['id']) && $_GET['id'] == 8) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
                                <div class="background-start">&nbsp;</div>
                                <div class="background-end">&nbsp;</div>
                                <div class="content"><a href="statistiken.php?id=8"><span class="tabItem"><?=STATISTIC30?></span></a></div>
                            </div>
                            <div title="" <?php if(isset($_GET['id']) && $_GET['id'] == 0) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
                                <div class="background-start">&nbsp;</div>
                                <div class="background-end">&nbsp;</div>
                                <div class="content"><a href="statistiken.php?id=0"><span class="tabItem"><?=STATISTIC31?></span></a></div>
                            </div>
                            <div title="" <?php if(isset($_GET['id']) && $_GET['id'] == 9) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
                                <div class="background-start">&nbsp;</div>
                                <div class="background-end">&nbsp;</div>
                                <div class="content"><a href="statistiken.php?id=9"><span class="tabItem"><?=STATISTIC_COUNTRY?></span></a></div>
                            </div>
                            <div title="" <?php if(isset($_GET['id']) && $_GET['id'] == 99) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
                                <div class="background-start">&nbsp;</div>
                                <div class="background-end">&nbsp;</div>
                                <div class="content"><a href="statistiken.php?id=99"><span class="tabItem"><?=STATISTIC27?></span></a></div>
                            </div>
                            <div title="" <?php if(isset($_GET['id']) && $_GET['id'] == 999) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
                                <div class="background-start">&nbsp;</div>
                                <div class="background-end">&nbsp;</div>
                                <div class="content"><a href="statistiken.php?id=999"><span class="tabItem">Rewards</span></a></div>
                            </div>
                            <div class="clear"></div>
                        </div>
<?php
if(isset($id)) {
	switch($id) {		
		case 999:        
			include("Templates/Ranking/reward.php");		
			break;
		case 31:
			include("Templates/Ranking/player_attack.php");
			break;
        case 32:
			include("Templates/Ranking/player_defend.php");
			break;
        case 7:
			include("Templates/Ranking/player_top10.php");
			break;
        case 4:
			include("Templates/Ranking/alliance.php");
			break;
        case 8:
			include("Templates/Ranking/heroes.php");
			break;
        case 11:
			include("Templates/Ranking/player_1.php");
			break;
        case 12:
			include("Templates/Ranking/player_2.php");
			break;
        case 13:
			include("Templates/Ranking/player_3.php");
			break;
        case 41:
			include("Templates/Ranking/alliance_attack.php");
			break;
        case 42:
			include("Templates/Ranking/alliance_defend.php");
			break;
        case 43:
			include("Templates/Ranking/ally_top10.php");
			break;
        case 0:
			include("Templates/Ranking/general.php");
			break;
        case 9:
            include("Templates/Ranking/country.php");
            break;
        case 1:
        default:
			include("Templates/Ranking/overview.php");
			break;
        case 99:
			include("Templates/Ranking/ww.php");
			break;
	}
}
else {
	include("Templates/Ranking/overview.php");
}
?>
                    </div>
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
        <div id="ce"></div>
    </div>
</body>
</html>


