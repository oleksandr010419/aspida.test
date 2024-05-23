<div id="build" class="gid30">

    <?php
    if ($building->getTypeLevel(30) > 0) { ?>
        <div class="clear"></div>
<form method="POST" name="snd" action="build.php">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <input type="hidden" name="ft" value="t3" />
    <div class="buildActionOverview trainUnits">
                <?php
                    include("30_train.php");
                ?>        </div>
    <div class="clear"></div>
    <?php if($success) {?>
    <button type="submit"  class="green small">
        <div class="button-container addHoverClick ">
            <div class="button-background">
                <div class="buttonStart">
                    <div class="buttonEnd">
                        <div class="buttonMiddle"></div>
                    </div>
                </div>
            </div><div class="button-content"><?=mastr1?></div>
        </div>
    </button>
    <?php } ?>
</form>
    <?php
    } else {
        echo "<b>".KO3."</b><br>\n";
    }
    $trainlist = $technology->getTrainingList(6);
	$totalTime = 0;
    if(count($trainlist) > 0) {
        echo "
    <table cellpadding=\"1\" cellspacing=\"1\" class=\"under_progress\">
        <thead><tr>
            <td>".mastr2."</td>
            <td>".mastr3."</td>
            <td>".mastr4."</td>
        </tr></thead>
        <tbody>";
        $TrainCount = 0;
        if(!isset($timer)){ $timer=1;}
        foreach($trainlist as $train) {
            $TrainCount++;
            echo "<tr><td class=\"desc\">";
            echo "<img class=\"unit u".($train['unit']-200)."\" src=\"img/x.gif\" alt=\"".$train['name']."\" title=\"".$train['name']."\" />";
            echo $train['amt']." ".$train['name']."</td><td class=\"dur\">";
            if ($TrainCount == 1 ) {

                echo "<span id=timer".$timer.">".$generator->getTimeFormat(round($train['eachtime']*$train['amt']))."</span>";
            } else {
                echo $generator->getTimeFormat(round($train['eachtime']*$train['amt']));
            }
            echo "</td><td class=\"fin\">";
			$totalTime += $train['eachtime'] * $train['amt'];
            $time = $generator->procMTime($train['timestamp']);
            if($time[0] != "today") {
                echo "on ".$time[0]." at ";
            }
            echo $time[1];
        } ?>
        </tr>
        </tbody></table>
    <?php }

	$instantTime = $generator->getGoldForTime($totalTime);
	if ($instantTime != '?') {
    ?>
		<button value="Instant train" id="btn_itrain" class="gold <?=$session->gold > $instantTime ? '' : 'disabled'?>" onclick="window.location.href='finish_train.php';"><div class="button-container addHoverClick "><div class="button-background"><div class="buttonStart"><div class="buttonEnd"><div class="buttonMiddle"></div></div></div></div><div class="button-content">Complete training <img alt="" class="goldIcon" src="img/x.gif"><span class="goldValue"><?=$instantTime?></span></div></div></button>
	<?php
	}
	?>
</p></div>