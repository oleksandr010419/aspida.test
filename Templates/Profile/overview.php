<?php

$uid=$user['id'];



$displayarray = $user;

$ranking->procRankArray();

$varmedal = $database->getProfileMedal($uid);



$profiel="".$displayarray['desc1']."".md5('skJkev3')."".$displayarray['desc2']."";

require("medal.php");

$profiel=explode("".md5("skJkev3")."", $profiel);



$varray = $database->getProfileVillages($uid);



$totalpop = 0;

foreach($varray as $vil) {

	$totalpop += $vil['pop'];

}

?>



<h4 class="round"><?=PROFM1?></h4>

<?php

if($_GET['uid']!=2){

    echo '<img class="heroImage" style="width:160px;height:205px;" src="'.$database->heroBody($uid).'" alt="hero">';

}



?>

<table cellpadding="1" cellspacing="1" id="details" class="transparent">



			<tr>



                <th><?php echo OVERVIEW4; ?></th>

                <td><?php echo $ranking->getUserRank($displayarray['id']); ?></td>

            </tr>
            

			<tr>
            <th><?php echo OVERVIEW13; ?></th>
            <td><?php echo '<img src="img/flags-iso/shiny/16/' . $displayarray['IsoCountryCode'] . '.png" title="' . $displayarray['Country'] . '">'; ?></td>
            </tr>

            <tr>

                <th><?php echo OVERVIEW5; ?></th>

                <td><?=constant('TRIBE'.$displayarray['tribe'])?></td>

            </tr>



            <tr>

                <th><?php echo OVERVIEW6; ?></th>

                <td><?php if($displayarray['alliance'] == 0) {

                echo "-";

                }

                else {

                $displayalliance = $database->RemoveXSS($database->getAllianceName($displayarray['alliance']));

                echo "<a href=\"allianz.php?aid=".$displayarray['alliance']."\">".$database->RemoveXSS($displayalliance)."</a>";

                } ?></td>

            </tr>

            <tr>

                <th><?php echo OVERVIEW7; ?></th>

                <td><?php echo count($varray);?></td>



            </tr>

            <tr>

                <th><?php echo OVERVIEW8; ?></th>

                <td><?php echo $totalpop; ?></td>

            </tr>

            <?php

			//Date of Birth

            if(isset($displayarray['birthday']) && $displayarray['birthday'] != 0) {

			$age = date('Y') - substr($displayarray['birthday'],0,4);

				if ((date('m') - substr($displayarray['birthday'],5,2)) < 0){$age --;}

				elseif ((date('m') - substr($displayarray['birthday'],5,2)) == 0){

					if(date('d') < substr($displayarray['birthday'],8,2)){$age --;}

				}

            ?><tr><th><?php echo OVERVIEW9; ?></th><td><?php echo $age; ?></td></tr><?php

            }

			//Gender

            if(isset($displayarray['gender']) && $displayarray['gender'] != 0) {

            if($displayarray['gender']== 1){ $gender = OVERVIEW10; }else{ $gender=OVERVIEW11;}

            ?><tr><th><?php echo OVERVIEW12; ?></th><td><?php echo $gender; ?></td></tr><?php

            }

			//Location

            if($displayarray['location'] != "") {

            ?><tr><th><?php echo OVERVIEW13; ?></th><td> <?php echo $database->RemoveXSS($displayarray['location']);?></td></tr>

           <?php }

            ?>

            <tr>

                <td colspan="2" class="empty"></td>

            </tr>

            <tr>

                <?php

                if($uid == $session->uid) {

                    if($session->sit){

                        echo "<td colspan=\"2\"> <span class=\"a arrow disabled\">".OVERVIEW14."</span></td>";

                    }else{

                        echo "<td colspan=\"2\"> <a class=\"arrow\" href=\"spieler.php?s=1\">".OVERVIEW14."</a></td>";

                    }

                } else {

                    echo "<td colspan=\"2\"> <a class=\"message messageStatus messageStatusUnread\" href=\"nachrichten.php?t=1&id=".$_GET['uid']."\">".sendmsg."</a></td>";

                }

                ?>

            </tr>

            </table>





            <div class="clear"></div>

            <br />



            <h4 class="round"><?=OVERVIEW3?></h4>



            <div class="description description1"><?php echo nl2br($profiel[1]); ?></div>

            <div class="description description2"><?php echo nl2br($profiel[0]); ?></div>



            <div class="clear"></div>

            <h4 class="round"><?php echo OVERVIEW7; ?></h4>

            <table cellpadding="1" cellspacing="1" id="villages">

    <thead>

    <tr>

        <th class="name"><?php echo OVERVIEW17; ?></th>

        <th><?=FINDER12?></th>

        <th><?php echo OVERVIEW18; ?></th>

        <th><?php echo OVERVIEW19; ?></th>

    </tr>

    </thead><tbody>

    <?php

    $name = 0;

    foreach($varray as $vil) {

        $oasis=$database->getOasis($vil['wref']);



        $imgs="";

        foreach($oasis as $o){

        switch($o['type']) {

            case 1:

                $tt =  "

<img class=\"r1\" src=\"img/x.gif\" title=\"".LUMBER."\">";

                break;

            case 2:

                $tt =  "

<img class=\"r1\" src=\"img/x.gif\" title=\"".LUMBER."\">";

                break;

            case 3:

                $tt =  "

<img class=\"r1\" src=\"img/x.gif\" title=\"".LUMBER."\">

<img class=\"r4\" src=\"img/x.gif\" title=\"".CROP."\">";

                break;

            case 4:

                $tt =  "

<img class=\"r2\" src=\"img/x.gif\" title=\"".CLAY."\">";

                break;

            case 5:

                $tt =  "

<img class=\"r2\" src=\"img/x.gif\" title=\"".CLAY."\">";

                break;

            case 6:

                $tt =  "

<img class=\"r2\" src=\"img/x.gif\" title=\"".CLAY."\">

<img class=\"r4\" src=\"img/x.gif\" title=\"".CROP."\">";

                break;

            case 7:

                $tt =  "

<img class=\"r3\" src=\"img/x.gif\" title=\"".IRON."\">";

                break;

            case 8:

                $tt =  "

<img class=\"r3\" src=\"img/x.gif\" title=\"".IRON."\">";

                break;

            case 9:

                $tt =  "

<img class=\"r3\" src=\"img/x.gif\" title=\"".IRON."\">

<img class=\"r4\" src=\"img/x.gif\" title=\"".CROP."\">";

                break;

            case 10:

            case 11:

                $tt =  "

<img class=\"r4\" src=\"img/x.gif\" title=\"".CROP."\">";

                break;

            case 12:

                $tt =  "

<img class=\"r4\" src=\"img/x.gif\" title=\"".CROP."\">";

                break;

        }

            $imgs.=$tt;

        }

    $capital= OVERVIEW20;

    	echo "<tr><td class=\"name\"><a href='karte.php?d=".$vil['wref']."'>".$vil['name']."</a>";



        if($vil['capital'] == 1) {

        echo "<span class=\"mainVillage\"> (".$capital.")</span>";

        }

        echo "</td><td class=\"oases\">";

echo $imgs;

        echo "</td>";

        echo "<td class=\"inhabitants\">".$vil['pop']."</td><td class=\"coords\"><a href=\"karte.php?x=".$vil['vx']."&y=".$vil['vy']."\"><span class=\"coordinates coordinatesAligned\"><span class=\"coordinatesWrapper\">";

        echo "<span class=\"coordinates coordinatesAligned\"><span class=\"coordinatesWrapper\">

        <span class=\"coordinateX\">(".$vil['vx']."</span>

        <span class=\"coordinatePipe\">|</span>

        <span class=\"coordinateY\">".$vil['vy'].")</span>

        </span><span class=\"clear\">‎</span>

        </td></tr>";

    $name++;

    }

    ?>

        </tbody></table>
