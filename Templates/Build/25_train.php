<?php
$art=$database->checkArtefactsEffects($session->uid,$village->wid,5);

$slots = $database->getAvailableExpansionTraining($session->tribe,$village->wid);

if ($slots['settlers']+$slots['chiefs']>0) { ?>

    <form method="POST" name="snd" action="build.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <input type="hidden" name="ft" value="t1" />
        <div class="buildActionOverview trainUnits">
            <?php
            for ($i=9;$i<=10;$i++) {
                if($i==9 and ($technology->getTech(9))==1 or $i==10){
                    if ($slots['settlers']>0  || $slots['chiefs']>0 ) {
                        $maxunit = MIN($technology->maxUnit(($session->tribe-1)*10+$i),($i==10?$slots['settlers']:$slots['chiefs']));

                        echo "<div class=\"action first\">
			<div class=\"bigUnitSection\">
<img class=\"unitSection u".(($session->tribe-1)*10+$i)."Section\" src=\"img/x.gif\" alt=\"".$technology->getUnitName(($session->tribe-1)*10+$i)."\" title=\"".$technology->getUnitName(($session->tribe-1)*10+$i)."\" />
<a href=\"#\" class=\"zoom\" onclick=\"return Travian.Game.unitZoom(".(($session->tribe-1)*10+$i).");\">
					<img class=\"zoom\" src=\"img/x.gif\" alt=\"zoom in\">
				</a>
			</div>
			 <div class=\"details\">
				<div class=\"tit\">
							<a href=\"#\" onclick=\"return Travian.Game.iPopup(".$i.",1);\"><img class=\"unit u".$i."\" src=\"img/x.gif\" title=\"".$technology->getUnitName($i)."\"></a>
							<a href=\"#\" onclick=\"return Travian.Game.iPopup(".$i.",1);\">".$technology->getUnitName($i)."</a>
							<span class=\"furtherInfo\">(Available: ".$village->unitarray['u'.($i-($session->tribe-1)*10)].")</span>
						</div>
					<div class=\"tit\">
						<span class=\"resources \"><img class=\"att_all\" src=\"img/x.gif\" title=\"Attack\">".(${'u'.$i}['atk'])."</span>
						<span class=\"resources \"><img class=\"def_i\" src=\"img/x.gif\" title=\"Defence against infantry\">".(${'u'.$i}['di'])."</span>
						<span class=\"resources \"><img class=\"def_c\" src=\"img/x.gif\" title=\"Defence agains cavlary\">".(${'u'.$i}['dc'])."</span>
					</div>
					<div class=\"showCosts\">
					<span class=\"resources r1\"><img class=\"r1\" src=\"img/x.gif\" title=\"".WOOD."\">".${'u'.(($session->tribe-1)*10+$i)}['wood']."</span>
					<span class=\"resources r2\"><img class=\"r2\" src=\"img/x.gif\" title=\"".CLAY."\">".${'u'.(($session->tribe-1)*10+$i)}['clay']."</span>
					<span class=\"resources r3\"><img class=\"r3\" src=\"img/x.gif\" title=\"".IRON."\">".${'u'.(($session->tribe-1)*10+$i)}['iron']."</span>
					<span class=\"resources r4\"><img class=\"r4\" src=\"img/x.gif\" title=\"".CROP."\">".${'u'.(($session->tribe-1)*10+$i)}['crop']."</span>
					<div class=\"clear\"></div>
					<span class=\"clocks\"><img class=\"clock\" src=\"img/x.gif\" title=\"".DURATION."\">";
                        $dur=round((${'u'.(($session->tribe-1)*10+$i)}['time'] * (${'bid'.$village->resarray['f'.$id.'t']}[$village->resarray['f'.$id]]['attri'] / 100) / SPEED * $art),5);
                        //    $dur = 10000;
                        echo $generator->getTimeFormat($dur);
                        echo "</span>";
                 
					   if($session->gold >= 3 && $building->getTypeLevel(17) >= 1) {
							echo npcButton(${'u'.(($session->tribe-1)*10+$i)}['wood'],${'u'.(($session->tribe-1)*10+$i)}['clay'],${'u'.(($session->tribe-1)*10+$i)}['iron'],${'u'.(($session->tribe-1)*10+$i)}['crop']);
					   }
                        echo "</span><div class=\"clear\"></div></div><span class=\"value\"></span><input type=\"text\" class=\"text\" name=\"t".(($session->tribe-1)*10+$i)."\" value=\"0\" maxlength=\"".MAXLENGHT."\"><span class=\"value\"> / </span>
						<a href=\"#\" onClick=\"document.snd.t".(($session->tribe-1)*10+$i).".value=".$maxunit."; return false;\">".$maxunit."</a>
						</div></div>
						<div class=\"clear\">&nbsp;</div><br />";
                    }
                }
            } ?>
            <div class="clear">&nbsp;</div>
            <div class="clear"></div></div>
        <button type="submit" name="s1" id="btn_train" value="ok" class="green">
            <div class="button-container addHoverClick ">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div><div class="button-content"><?= RE26 ?></div>
            </div>
        </button>

    </form>
<?php
} else {
    echo '<div class="c">'.dvrc1.'</div>';
}
include ("26_progress.php");
?>