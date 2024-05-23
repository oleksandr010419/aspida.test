<?php
$ranking->procARankArray();
if(isset($_GET['aid'])) {
$aid = $database->FilterIntValue($database->FilterVar($_GET['aid']));
}
else {
$aid = $session->alliance;
}
$varmedal = $database->getProfileMedalAlly($aid);


$members = $database->getAllMemO($aid);
$totalpop = $members['pop'];
$memberlist = $database->getAllMember($aid);



$profiel="".$allianceinfo['notice']."".md5("skJkev3")."".$allianceinfo['desc']."";
require("medal.php");
$profiel=explode("".md5("skJkev3")."", $profiel);

include("alli_menu.php");

?>
<div id="details">
    <h4 class="round small"><?=ally4?>:</h4>
    <table cellpadding="1" cellspacing="1" class="transparent">
        <tbody>
        <tr>
                <th><?php echo NAME; ?></th>
                <td><?php echo $tag; ?></td>
            </tr>
            <tr>
                <th><?php echo OVERVIEW17; ?></th>
                <td><?php echo $aname; ?></td>
            </tr>
                <tr>
                <td colspan="2" class="empty"></td>
            </tr>
            <tr>
                <th><?php echo OVERVIEW4; ?></th>
                <td><?php echo $ranking->getAllianceRank($aid); ?>.</td>
            </tr>
            <tr>
                <th><?php echo OVERVIEW18; ?></th>
                <td><?php echo $totalpop; ?></td>
            </tr>
            <tr>
                <th><?php echo STATISTIC28; ?></th>
                <td><?php echo $members['user']; ?></td>
            </tr>
        </tbody>
    </table>
</div>
<div id="memberTitles">
    <h4 class="round small"><?=ally5?></h4>
    <table cellpadding="1" cellspacing="1" class="transparent">
        <tbody>
                <?php
                foreach($memberlist as $member) {

                //rank name
                $rank = $database->getAlliancePermission($member['id'],"rank",0);

                //username
                $name = $member['username'];

                if(!empty($rank)){
                echo "<tr>";
                echo "<th>".stripslashes($database->RemoveXSS($rank))."</th>";
                echo "<td><a href='spieler.php?uid=".$member['id']."'>".$database->RemoveXSS($name)."</td>";
                echo "</tr>";
                }
				}

			?>
        </tbody>
    </table>
</div>

<div class="clear"></div>
<h4 class="round"><?=OVERVIEW3?></h4>
<div class="description description1">
    <?php echo nl2br($profiel[1]); ?>
</div>
<div class="description description2">
    <?php echo nl2br($profiel[0]); ?>
</div>
<div class="clear"></div>


<h4 class="round"><?=ally6?></h4>
<table cellpadding="1" cellspacing="1" id="member">
    <thead>
    <tr>
<th><?php echo OVERVIEW1; ?></th>
<th><?php echo OVERVIEW8; ?></th>
<th><?php echo MULTI_V_HEADER; ?></th>
    </tr>
    </thead>
<tbody>
<?php
// Alliance Member list loop
$rank=0;
foreach($memberlist as $member) {

    $rank = $rank+1;
  $TotalUserPop = $database->getVSumField($member['id'],"pop");
    $TotalVillages = $database->getProfileVillages($member['id']);

    echo "<tr>";
    echo "<td class=pla>";


    if($aid == $session->alliance){
        if ((time()-600) < $member['timestamp']){ // 0 Min - 10 Min
            echo "    <img class='online online1' src=img/x.gif  title='".oweronline0."' alt='".oweronline0."' />";
        }elseif ((time()-86400) < $member['timestamp'] && (time()-600) > $member['timestamp']){ // 10 Min - 1 Days
            echo "    <img class='online online2' src=img/x.gif title='".oweronline1."' alt='".oweronline1."' />";
            }elseif ((time()-259200) < $member['timestamp'] && (time()-86400) > $member['timestamp']){ // 1-3 Days
            echo "    <img class='online online3' src=img/x.gif title='".oweronline2."' alt='".oweronline2."' />";
        }elseif ((time()-604800) < $member['timestamp'] && (time()-259200) > $member['timestamp']){
            echo "    <img class='online online4' src=img/x.gif title='".oweronline3."' alt='".oweronline3."' />";
        }else{
             echo "    <img class='online online5' src=img/x.gif title=now online alt=now online />";
        }
    }
    echo "<a href=spieler.php?uid=".$member['id'].">".$database->RemoveXSS($member['username'])."</a>";
    echo "<td class=hab>".$TotalUserPop."</td>";
    echo "<td class=vil>".count($TotalVillages)."</td>";
    echo "</tr>";
}

?>
</tbody>
</table>