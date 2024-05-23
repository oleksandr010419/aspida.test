<?php
$bindicator = $building->canBuild($id,$bid);
$uprequire = $building->resourceRequired($id,$bid);
?>
<div id="contract" class="contract contractNew contractWrapper">
    <div class="contractText"><?=upgra0?></div>
    <div class="contractCosts">
        <div class="showCosts">
            <span class="resources r1 little_res"><img class="r1" src="img/x.gif" title="Wood"><?php echo $uprequire['wood']; ?></span>
            <span class="resources r2 little_res"><img class="r2" src="img/x.gif" title="Clay"><?php echo $uprequire['clay']; ?></span>
            <span class="resources r3 little_res"><img class="r3" src="img/x.gif" title="Iron"><?php echo $uprequire['iron']; ?></span>
            <span class="resources r4"><img class="r4" src="img/x.gif" title="Crop"><?php echo $uprequire['crop']; ?></span>
            <span class="resources r5"><img class="r5" src="img/x.gif" title="Crop consumption"><?php echo $uprequire['pop']; ?></span>
            <div class="clear"></div>
    <span class="clocks"><img class="clock" src="img/x.gif" title="Duration">

        <?php echo $generator->getTimeFormat($uprequire['time']);
        echo "</span>";
		
		if($uprequire['wood'] > $village->awood || $uprequire['clay'] > $village->aclay || $uprequire['iron'] > $village->airon || $uprequire['crop'] > $village->acrop) {
			if($session->gold >= 3 && $building->getTypeLevel(17) >= 1) {
				echo npcButton($uprequire['wood'],$uprequire['clay'],$uprequire['iron'],$uprequire['crop']);
			}
		}
	 ?>
        <div class="clear"></div>
        </div></div>
<div class="contractLink">
    <?php
    if($bindicator == 2) {
        echo "<span class=\"none\">".upgra1."</span>";
    }
    else if($bindicator == 3) {
        echo "<span class=\"none\">".upgra1."</span>";
    }
    else if($bindicator == 4) {
        echo "<span class=\"none\">".upgra2."</span>";
    }

    else if($bindicator == 5) {
        echo "<span class=\"none\">".upgra3."</span>";
    }
    else if($bindicator == 6) {
        echo "<span class=\"none\">".upgra4."</span>";
    }
    else if($bindicator == 7) {
        $neededtime = $building->calculateAvaliable($id,$bid);
        echo "<span class=\"none\">".upgra5." ".$neededtime[1]."</span>";
    }
    else if($bindicator == 8) {
        echo "<button type=\"button\" value=\"Upgrade level\" class=\"green new\" onclick=\"window.location.href = 'dorf2.php?а=$bid&id=$id&c=".$session->checker."'; return false;\">
<div class=\"button-container addHoverClick\" style=\"margin:1px -3px;\">
<div class=\"button-background\">
    <div class=\"buttonStart\">
        <div class=\"buttonEnd\">
            <div class=\"buttonMiddle\"></div>
        </div>
    </div>
</div><div class=\"button-content\">".upgra6."</div></button>";
    }
    else if($bindicator == 9) {
        echo "<button type=\"button\" value=\"Upgrade level\" class=\"green new\" onclick=\"window.location.href = 'dorf2.php?а=$bid&id=$id&c=".$session->checker."'; return false;\">
<div class=\"button-container addHoverClick\" style=\"margin:1px -3px;\">
<div class=\"button-background\">
    <div class=\"buttonStart\">
        <div class=\"buttonEnd\">
            <div class=\"buttonMiddle\"></div>
        </div>
    </div>
</div><div class=\"button-content\">".upgra6."</div></button> <span class=\"none\">".upgra7."</span>";
    }
    if($bindicator == 88 || $session->goldclub && $building->master==0 && $bindicator < 8) {
        if($bindicate != 88){echo "</br>";}
            echo "<button type=\"button\" value=\"Upgrade level\" class=\"green new\" onclick=\"window.location.href = 'dorf2.php?а=$bid&id=$id&c=".$session->checker."'; return false;\">
<div class=\"button-container addHoverClick\" style=\"margin:1px -3px;\">
<div class=\"button-background\">
    <div class=\"buttonStart\">
        <div class=\"buttonEnd\">
            <div class=\"buttonMiddle\"></div>
        </div>
    </div>
</div><div class=\"button-content\">Build ";


        echo "</div></div></button> <span class=\"none\">".upgra8." <font color='#B3B3B3'>".upgra9." <img src='img/x.gif' alt='' class='gold' />0)</font></span>";
    }
    ?>

</div>

    <div class="clear"></div></div>