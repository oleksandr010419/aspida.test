<?php

include("GameEngine/Village.php");
//$database->isWinner();
if(!$database->Winnerkills()){header("Location:dorf1.php"); exit;}

$fromfile=true;
include("givegoldoutSluShayGruPPySPLIN.php");
## Get Rankings for Ranking Section
## Top 3 Population
$q = "
    SELECT users.id userid, users.username username,users.alliance alliance, (
    SELECT SUM( vdata.pop )
    FROM vdata
    WHERE vdata.owner = userid
    )totalpop, (
        SELECT COUNT( vdata.wref )
    FROM vdata
    WHERE vdata.owner = userid AND type != 99
    )totalvillages, (
    SELECT alidata.tag
    FROM alidata, users
    WHERE alidata.id = users.alliance
    AND users.id = userid
    )allitag
    FROM users
    WHERE users.access < " . (INCLUDE_ADMIN ? "10" : "8") . " and id>5
    ORDER BY totalpop DESC, totalvillages DESC, username ASC";

    $result = $database->query($q);
    foreach($result as $row)
    {
        $datas[] = $row;
    }

    ## Top Attacker
    $q = "
    SELECT users.id userid, users.username username, users.apall,  (
    SELECT COUNT( vdata.wref )
    FROM vdata
    WHERE vdata.owner = userid AND type != 99
    )totalvillages, (
    SELECT SUM( vdata.pop )
    FROM vdata
            WHERE vdata.owner = userid
    )pop
    FROM users
    WHERE users.apall >=0 AND users.access < " . (INCLUDE_ADMIN ? "10" : "8") . " 
    ORDER BY users.apall DESC, pop DESC, username ASC";

        $result = $database->query($q);
    foreach($result as $row)
    {
        $attacker[] = $row;
    }

    ## Top Defender
    $q = "
    SELECT users.id userid, users.username username, users.dpall,  (
    SELECT COUNT( vdata.wref )
    FROM vdata
    WHERE vdata.owner = userid AND type != 99
    )totalvillages, (
    SELECT SUM( vdata.pop )
    FROM vdata
    WHERE vdata.owner = userid
    )pop
    FROM users
    WHERE users.dpall >=0 AND users.access < " . (INCLUDE_ADMIN ? "10" : "8") . " and id>5
    ORDER BY users.dpall DESC, pop DESC, username ASC";
        $result = $database->query($q);
    foreach($result as $row)
    {
        $defender[] = $row;
    }


	$sql = $database->query("SELECT vref FROM fdata WHERE f99 = '100' and f99t = '40'");
	$vref = $winner = $sql[0]['vref'];

	$sql = $database->query("SELECT name,owner FROM vdata WHERE wref = '".$vref."'");
	$winningvillagename = $sql[0]['name'];
    $owner = $sql[0]['owner'];

	$sql = $database->query("SELECT username,alliance FROM users WHERE id = '".$owner."'");
	$username = $sql[0]['username'];
   $allianceid = $sql[0]['alliance'];

	$sql = $database->query("SELECT name,tag FROM alidata WHERE id = '".$allianceid."'");
	$winningalliance = $sql[0]['name'];
    $winningalliancetag = $sql[0]['tag'];
	
	$statusS = $database->getServerStatus();
	//print_r($status['finishedTime']);
	//die(print_r($status));
?>

<!DOCTYPE html >
<html>
<?php include("Templates/html.php");?>
<body class="v35 <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> village-2 <?php if($dorf1==''){echo 'perspectiveBuildings';}else{ echo 'perspectiveResources';} ?>">
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
                    <div id="content" class="plus">
                        <script type="text/javascript">
                            window.addEvent('domready', function()
                            {
                                $$('.subNavi').each(function(element)
                                {
                                    new Travian.Game.Menu(element);
                                });
                            });
                        </script>

                <div id="content" class="village2" style="font-size: 9pt;">
                    <img class="ww g40 g40_9" src="img/x.gif" align="right" title=""/>
<p>
					<b>Dear <?php echo SERVER_NAME; ?> Players,</b>
					<br /><br />
					All good things must come to an end, and so too must this age. Once solomon was given a ring, upon which was inscribed a message that could take away all
					the joys or sorrows of the world, that message was roughly translated "this too shall pass". It is both our joy and sorrow to announce to all Players that
					this too has now passed! We hope you enjoyed your time with us as much as we enjoyed serving you and thank you for staying until the very end!<br /><br />

					The results: Day had long since passed into night, yet the workers in <?php echo "<a href=\"karte.php?d=$vref&c=".$generator->getMapCheck($vref)."\">$winningvillagename</a>"; ?>,
					laboured on throught the wintery eve, every wary of the countless armies marching to destroy their work, knowing that they raced against time and the greatest
					threat that had ever faced the free people. Their tireless struggles were rewared at <b><?php echo date('H:i:s',$statusS['finishedTime']); ?></b> on <b><?php echo date('d:M:Y',$statusS['finishedTime']); ?></b> after a
					nameless worker laid the dinal stone in what will forever known as the greatest and most magnificent creation in all of history since the fall of the Natars Empire.<br /><br />

					Together with the alliance "<?php echo "<a href=\"allianz.php?aid=$allianceid\">$winningalliancetag</a>"; ?>", "<?php echo "<a href=\"spieler.php?uid=$owner\">$username</a>"; ?>"
					was the first to finish the Wonder of the World, using millions of resources whilst also protecting it with hundereds of thousands of brave defenders. It is therefore <b><?php echo "<a href=\"spieler.php?uid=$owner\">$username</a>"; ?></b>
					who recieves the title "Winner of this era"!<br /><br />


					"<a href="spieler.php?uid=<?php echo $datas[0]['userid']; ?>" title="Total Villages: <?php echo $datas[0]['totalvillages']; echo "\n";?>Total Population: <?php echo $datas[0]['totalpop']; ?>"><?php echo $datas[0]['username']; ?></a>" was the ruler over the largest personal empire, followed closely by "<a href="spieler.php?uid=<?php echo $datas[1]['userid']; ?>" title="Total Villages: <?php echo $datas[1]['totalvillages']; echo "\n";?>Total Population: <?php echo $datas[1]['totalpop']; ?>"><?php echo $datas[1]['username']; ?></a>" and "<a href="spieler.php?uid=<?php echo $datas[2]['userid']; ?>" title="Total Villages: <?php echo $datas[2]['totalvillages']; echo "\n";?>Total Population: <?php echo $datas[2]['totalpop']; ?>"><?php echo $datas[2]['username']; ?></a>".<br />
					"<a href="spieler.php?uid=<?php echo $attacker[0]['userid']; ?>" title="Total Villages: <?php echo $attacker[0]['totalvillages']; echo "\n"; ?>Attack Points: <?php echo $attacker[0]['apall']; ?>"><?php echo $attacker[0]['username']; ?></a>" slew more than any other, and was the mightiest, most fearsome commander.<br />
					"<a href="spieler.php?uid=<?php echo $defender[0]['userid']; ?>" title="Total Villages: <?php echo $defender[0]['totalvillages']; echo "\n"; ?>Defence Points: <?php echo $defender[0]['dpall'];?>"><?php echo $defender[0]['username']; ?></a>" was the most glorious defender, slaugtering enemies at the village gates, staining the lands around those villages with their blood.
					<br /><br />
					<p>Congratulations to everyone.</p>
					<br /><br />
					Best Regards,<br />
					Your <?php echo SERVER_NAME; ?>-Team<br /><br /><br /><br />
					<small><i>(By: stratis33 v8.0.2)</i></small></p>

					<br /><br />
					<center><a href="dorf1.php">&raquo; Continue</a></center>
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
