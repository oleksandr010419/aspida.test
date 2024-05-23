
    <div class="clear"></div>
    <?php if ($building->getTypeLevel(19) > 0) { ?>
        <form method="POST" name="snd" action="build.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <input type="hidden" name="ft" value="t1"/>
            <div class="buildActionOverview trainUnits">
                <?php
                include("19_train.php");
                ?>
            <div class="clear"></div></div>
            <button type="submit"  class="green small">
                <div class="button-container addHoverClick ">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div><div class="button-content"><?= mastr1 ?></div>
                </div>
            </button>
</form>
    <?php
    } else {
        echo "<b>". KA3." </b><br>\n";
    }
    $trainlist = $technology->getTrainingList(1);
	$totalTime = 0;
    if (count($trainlist) > 0) {

        echo "
            <h4 class=\"round spacer\">Training</h4>
    <table cellpadding=\"1\" cellspacing=\"1\" class=\"under_progress\">
        <thead><tr>
            <td>" . TRA4 . "</td>
            <td>" . TRA2 . "</td>
            <td>" . TRA3 . "</td>
        </tr></thead>
        <tbody>";
        $TrainCount = 0;
        if(!isset($timer)){ $timer=1;}
        foreach ($trainlist as $train) {
            $TrainCount++;
            echo "<tr><td class=\"desc\">";
            echo "<img class=\"unit u" . $train['unit'] . "\" src=\"img/x.gif\" alt=\"\" title=\"\" />";
            echo $train['amt'] . " " . $train['name'] . "</td><td class=\"dur\">";
            if ($TrainCount == 1) {
                echo $generator->getMilisecFormat($train['eachtime'] * 1000 * $train['amt']);
            } else {
                echo $generator->getMilisecFormat($train['eachtime'] * 1000 * $train['amt']);
            }
            echo "</td><td class=\"fin\">";
			$totalTime += $train['eachtime'] * $train['amt'];
            $time = $generator->procMTime($train['timestamp']);
            if ($time[0] != "today") {
                echo " $time[0]";
            }
            echo " " . $time[1];
        } ?>
        </tr>
        </tbody></table>
    <?php
    }
	$instantTime = $generator->getGoldForTime($totalTime);
	if ($instantTime != '?') {
    ?>
		<button value="Instant train" id="btn_itrain" class="gold <?=$session->gold > $instantTime ? '' : 'disabled'?>" onclick="window.location.href='finish_train.php';"><div class="button-container addHoverClick "><div class="button-background"><div class="buttonStart"><div class="buttonEnd"><div class="buttonMiddle"></div></div></div></div><div class="button-content">Complete training <img alt="" class="goldIcon" src="img/x.gif"><span class="goldValue"><?=$instantTime?></span></div></div></button>
	<?php
	}
	?>
    </p>

    <div class="clear"></div>