<div id="build" class="gid20">

    <div class="clear"></div>
    <?php if ($building->getTypeLevel(20) > 0) { ?>
        <form method="POST" name="snd" action="build.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <input type="hidden" name="ft" value="t1"/>
            <div class="buildActionOverview trainUnits">
                <?php
                include("20_1.php");
                ?>
                <div class="clear"></div></div>
            <?php if($success) {?>
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
            <?php } ?>
        </form>
    <?php
    } else {
        echo "<b>". KA3." </b><br>\n";
    }
    $trainlist = $technology->getTrainingList(2);
	$totalTime = 0;

    if(count($trainlist) > 0) {
    //$timer = 2*count($trainlist);
    	echo "
    <table cellpadding=\"1\" cellspacing=\"1\" class=\"under_progress\">
		<thead><tr>
			<td>".TRA4."</td>
			<td>".TRA2."</td>
			<td>".TRA3."</td>
		</tr></thead>
		<tbody>";
		$TrainCount = 0;
        if(!isset($timer)){ $timer=1;}
        foreach($trainlist as $train) {
			$TrainCount++;
			echo "<tr><td class=\"desc\">";
			echo "<img class=\"unit u".$train['unit']."\" src=\"img/x.gif\" alt=\"".$train['name']."\" title=\"".$train['name']."\" />";
			echo $train['amt']." ".$train['name']."</td><td class=\"dur\">";			
				echo $generator->getMilisecFormat(round($train['eachtime']*1000*$train['amt']));
			echo "</span></td><td class=\"fin\">";
			$totalTime += $train['eachtime'] * $train['amt'];
			$time = $generator->procMTime($train['timestamp']);
			if($time[0] != "today") {
				echo " $time[0] ";
            }
            echo $time[1];
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
    </div>
    <div class="clear">&nbsp;</div>
    <div class="clear"></div>