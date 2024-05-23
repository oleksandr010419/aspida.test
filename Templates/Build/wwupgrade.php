<br />
<?php
$bid = $village->resarray['f'.$id.'t'];
$bindicate = $building->canBuild($id,$bid);
$wwlevel = $village->resarray['f'.$id];
if($wwlevel > 50){
$needed_plan = 1;
}else{
$needed_plan = 0;
}

$wwbuildingplan = 0;
$plan=$database->checkArtefactsEffects($session->uid,$village->wid,11);
if($plan > 0){
$wwbuildingplan = 1;
}

if($session->alliance != 0){
$alli_users = $database->getUserByAlliance($session->alliance);
foreach($alli_users as $users){

$plan = $database->checkArtefactsEffects($users['id'],0,11);
if($plan > 0){
$wwbuildingplan += 1;
}


}
}

if($wwbuildingplan>$needed_plan){

$bid = $village->resarray['f'.$id.'t'];
$bindicate = $building->canBuild($id,$bid);

if($bindicate == 1) {
    echo "<p><span class=\"none\">".UPG0."</span></p>";
} else if($bindicate == 10) {
    echo "<p><span class=\"none\">".ww5."</span></p>";
} else if($bindicate == 11) {
    echo "<p><span class=\"none\">The building is on demolition.</span></p>";
} else {
$uprequire = $building->resourceRequired($id,$village->resarray['f'.$id.'t'],1+$loopsame+$doublebuild+$master);

$time=time();
?>

<div id="contract" class="contractWrapper">
    <div class="contractText"><b><?=ww6?></b> <?=ww7?> <?php echo $village->resarray['f'.$id]+($loopsame > 0 ? 2:1)+$doublebuild+$master; ?> </div>
    <div class="contractCosts">
        <div class="showCosts">
            <span class="resources r1"><img class="r1" src="img/x.gif" title="Wood"><?php echo $uprequire['wood']; ?></span>
            <span class="resources r2"><img class="r2" src="img/x.gif" title="Clay"><?php echo $uprequire['clay']; ?></span>
            <span class="resources r3"><img class="r3" src="img/x.gif" title="Iron"><?php echo $uprequire['iron']; ?></span>
            <span class="resources r4"><img class="r4" src="img/x.gif" title="Wheat"><?php echo $uprequire['crop']; ?></span>
            <span class="resources r5"><img class="r5" src="img/x.gif" title="Consumption"><?php echo $uprequire['pop']; ?></span>
            <div class="clear"></div>
<span class="clocks">
<img class="clock" src="img/x.gif" title="duration">
    <?php
    echo $generator->getTimeFormat($uprequire['time']*2);

    $wood = round($village->awood);
    $clay = round($village->aclay);
    $iron = round($village->airon);
    $crop = round($village->acrop);

    $totalres = $uprequire['wood']+$uprequire['clay']+$uprequire['iron']+$uprequire['crop'];
    $availres = $wood+$clay+$iron+$crop;
    if($availres >= $totalres){ $style = "npc"; } else { $style = "npc_inactive"; $disable = "disabled=\"disabled\""; }
?></span>
            <div class="clear"></div>
        </div></div>
    <?php
    if($bindicate == 2) {
        echo "<span class=\"none\">".UPG5."</span>";
        ?>
    <?php

    }
    else if($bindicate == 3) {
        echo "<span class=\"none\">".UPG6."</span>";

        ?>
    <?php

    }
    else if($bindicate == 4) {
        echo "<span class=\"none\">Food Shortage: Expand Cropland.</span>";
    }
    else if($bindicate == 5) {
        echo "<span class=\"none\">Upgrade Warehouse.</span>";
    }
    else if($bindicate == 6) {
        echo "<span class=\"none\">Upgrade Granary.</span>";
    }
    else if($bindicate == 7) {
        $neededtime = $building->calculateAvaliable($id,$village->resarray['f'.$id.'t'],1+$loopsame+$doublebuild+$master);
        if($neededtime==0){echo "<span class=\"none\">Never Enough Resources</span>";}else{
            echo "<span class=\"none\">Enough resources  ".$neededtime[0]." at  ".$neededtime[1]."</span>";}
    }
    else if($bindicate == 8) {
            echo "<button type=\"submit\" value=\"Upgrade level\" class=\"green small\" onclick=\"window.location.href = 'dorf2.php?а=$id&c=$session->checker'; return false;\">
     <div class=\"button-container addHoverClick\" style=\"margin:1px -3px;\">
    <div class=\"button-background\">
        <div class=\"buttonStart\">
            <div class=\"buttonEnd\">
                <div class=\"buttonMiddle\"></div>
            </div>
        </div>
    </div><div class=\"button-content\">".UPG11." ";

        echo $village->resarray['f'.$id]+1;
        echo " </div></div></button></div>";
    }
    else if($bindicate == 9) {

        echo "<button type=\"submit\" value=\"Upgrade level\" class=\"green small\" onclick=\"window.location.href = 'dorf2.php?а=$id&c=$session->checker'; return false;\">
     <div class=\"button-container addHoverClick\" style=\"margin:1px -3px;\">
    <div class=\"button-background\">
        <div class=\"buttonStart\">
            <div class=\"buttonEnd\">
                <div class=\"buttonMiddle\"></div>
            </div>
        </div>
    </div><div class=\"button-content\">".UPG11." ";

        echo $village->resarray['f'.$id]+($loopsame > 0 ? 2:1);
        echo "</div></div></button> <span class=\"none\">".upgra7."</span></div>";
    }
    if($bindicate == 88 || $session->goldclub && $building->master==0 && $bindicate < 8) {
        if($bindicate != 88){echo "</br>";}
        if($id <= 18) {
            echo "<button type=\"button\" value=\"Upgrade level\" class=\"green\" onclick=\"window.location.href = 'dorf1.php?а=$id&c=$session->checker'; return false;\">
    	<div class=\"button-container addHoverClick\" style=\"margin:1px -3px;\">
    <div class=\"button-background\">
        <div class=\"buttonStart\">
            <div class=\"buttonEnd\">
                <div class=\"buttonMiddle\"></div>
            </div>
        </div>
    </div><div class=\"button-content\">".C6." ";
        }
        else {
            echo "<button type=\"button\" value=\"Upgrade level\" class=\"green\" onclick=\"window.location.href = 'dorf2.php?а=$id&c=$session->checker'; return false;\">
            <div class=\"button-container addHoverClick\" style=\"margin:1px -3px;\">
    <div class=\"button-background\">
        <div class=\"buttonStart\">
            <div class=\"buttonEnd\">
                <div class=\"buttonMiddle\"></div>
            </div>
        </div>
    </div><div class=\"button-content\">".C6." ";
        }
        echo $village->resarray['f'.$id]+($loopsame > 0 ? 2:1)+$doublebuild;
        echo "</div></div></button> <span class=\"none\">".upgra8." <font color='#B3B3B3'>(costs: <img src='img/x.gif' alt='' class='gold' />0)</font></span></div>";
    }elseif($bindicate < 8){echo "</div>";}
    }

	}else{
	if($needed_plan == 0){
    	echo "<span class=\"none\">".ww9."</span>";
	}else{
    	echo "<span class=\"none\">".ww8."</span>";
	}
	}

?>
