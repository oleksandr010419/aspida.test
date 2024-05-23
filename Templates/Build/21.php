<div id="build" class="gid21">
<?php

    if ($building->getTypeLevel(21) > 0) { ?>
        <div class="clear"></div>
        <form method="POST" name="snd" action="build.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <input type="hidden" name="ft" value="t1" />
            <div class="buildActionOverview trainUnits">
                <?php
                $art = $database->checkArtefactsEffects($session->uid, $village->wid, 5);
                $success = 0;
                $start = ($session->tribe-1)*10+7;
				
                for ($i = $start; $i <= ($start + 1); $i++) {
                    $ava = $i - (($session->tribe - 1) * 10);
                    if ($technology->getTech($ava)) {
                        echo "<div class=\"action first\">
                	<div class=\"bigUnitSection\">
						<a href=\"#\" onclick=\"return Travian.Game.iPopup($i,1);\">
							<img class=\"unitSection u".$i."Section\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\">
						</a>
						<a href=\"#\" class=\"zoom\" onclick=\"return Travian.Game.unitZoom($i);\">
							<img class=\"zoom\" src=\"img/x.gif\" alt=\"zoom in\">
						</a>
					</div>
					<div class=\"details\">
						<div class=\"tit\">
							<a href=\"#\" onclick=\"return Travian.Game.iPopup($i,1);\"><img class=\"unit u$i\" src=\"img/x.gif\" alt=\"Paladin\"></a>
							<a href=\"#\" onclick=\"return Travian.Game.iPopup($i,1);\">".$technology->getUnitName($i)."</a>
							<span class=\"furtherInfo\">(Avalaible: ".$village->unitarray['u'.$ava].")</span>
						</div>
                        <div class=\"showCosts\">
                        <span class=\"resources r1\"><img class=\"r1\" src=\"img/x.gif\" alt=\"Fa\">".${'u'.$i}['wood']."</span>
                        <span class=\"resources r2\"><img class=\"r2\" src=\"img/x.gif\" alt=\"Agyag\">".${'u'.$i}['clay']."</span>
                        <span class=\"resources r3\"><img class=\"r3\" src=\"img/x.gif\" alt=\"Vasérc\">".${'u'.$i}['iron']."</span>
                        <span class=\"resources r4\"><img class=\"r4\" src=\"img/x.gif\" alt=\"Búza\">".${'u'.$i}['crop']."</span>
                        <span class=\"resources r5\"><img class=\"r5\" src=\"img/x.gif\" alt=\"Búzafogyasztás\">".${'u'.$i}['pop']."</span>
                        <div class=\"clear\"></div>
                        <span class=\"clocks\"><img class=\"clock\" src=\"img/x.gif\" alt=\"duration\">";
                        $dur = round((${'u' . $i}['time'] * (($bid21[$village->resarray['f' . $id]]['attri']) / 100) / SPEED * $art), 5);

                        $dur = $generator->getMilisecFormat($dur * 1000);
                        echo $dur;
                        if($session->gold >= 3 && $building->getTypeLevel(17) >= 1) {
							echo npcButton(${'u'.$i}['wood']*$technology->maxUnitPlus($i),${'u'.$i}['clay']*$technology->maxUnitPlus($i),${'u'.$i}['iron']*$technology->maxUnitPlus($i),${'u'.$i}['crop']*$technology->maxUnitPlus($i));
						}
                        echo "</span><div class=\"clear\"></div></div><span class=\"value\">".mastr5."</span>
						<input type=\"text\" class=\"text\" name=\"t$i\" value=\"0\" maxlength=\"".MAXLENGHT."\">
                        <span class=\"value\"> / </span>
						<a href=\"#\" onClick=\"document.snd.t$i.value=".$technology->maxUnit($i)."; return false;\">".$technology->maxUnit($i)."</a>
					</div></div>
					<div class=\"clear\"></div><br />";
                        $success += 1;
                    }
                }
                if($success == 0) {
                    echo "<tr><td colspan=\"3\"><div class=\"none\"><center>".mastr0."</center></div></td></tr>";
                }
                ?>
            </div><div class="clear"></div>
            <?php if($success) {?><button type="submit"  class="green small">
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
            <?php }?>
        </form>
    <?php
    } else {
        echo "<b>".mastr0."</b><br>\n";
    }

    $trainlist = $technology->getTrainingList(3);
	$totalTime = 0;
    if(count($trainlist) > 0) {
        //$timer = 2*count($trainlist);
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
        foreach ($trainlist as $train) {
            $TrainCount++;
            echo "<tr><td class=\"desc\">";
            echo "<img class=\"unit u" . $train['unit'] . "\" src=\"img/x.gif\" alt=\"" . $train['name'] . "\" title=\"" . $train['name'] . "\" />";
            echo $train['amt'] . " " . $train['name'] . "</td><td class=\"dur\">";						echo $generator->getMilisecFormat(round($train['eachtime'] * 1000 * $train['amt']));
            echo "</td><td class=\"fin\">";
			$totalTime += $train['eachtime'] * $train['amt'];
            $time = $generator->procMTime($train['timestamp']);
            if ($time[0] != "today") {
                echo "on " . $time[0] . " at ";
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
    </div>

<div class="clear">&nbsp;</div>
<div class="clear"></div>