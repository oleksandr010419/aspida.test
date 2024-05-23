<div class="clear"></div>
<div class="build_details researches">
    <?php
    $abdata = $database->getABTech($village->wid);
    $ABups = $technology->getABUpgrades('a');

	$start = ($session->tribe-1)*10+1;
	$end = ($session->tribe-1)*10+8;
    for($i=$start;$i<=$end;$i++) {
        $j = $i % 10 ;

        if ( $technology->getTech(($i-(($session->tribe-1)*10))) || $j == 1 ) {
            if(count($ABups) && $ABups[0]['tech']=="a".($i-(($session->tribe-1)*10))){$abdata['a'.$j]+=1;}
            echo "<div class=\"research\">
		<div class=\"bigUnitSection\">
			<a class=\"unitSection\" href=\"#\" onclick=\"return Travian.Game.iPopup(".$i.",1);\">
				<img class=\"unitSection u".$i."Section\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\">
			</a>
			<a href=\"#\" class=\"zoom\" onclick=\"return Travian.Game.unitZoom(".$i.");\">
				<img class=\"zoom\" src=\"img/x.gif\" alt=\"Zoom\">
			</a>
		</div>
		<div class=\"information\">
<div class=\"title\">
<a href=\"#\" onclick=\"return Travian.Game.iPopup(".$i.",1);\">
<img class=\"unit u".$i."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\"></a>
<a href=\"#\" onclick=\"return Travian.Game.iPopup(".$i.",1);\">".$technology->getUnitName($i)."</a>
<span class=\"level\">".LVL." ".$abdata['a'.$j]."</span>
</div>";
            if($abdata['a'.$j] != 20) {
                echo "<div class=\"costs\">
<div class=\"showCosts\">
<span class=\"resources r1 little_res\"><img class=\"r1\" src=\"img/x.gif\" alt=\"fa\">".${'ab'.$i}[$abdata['a'.$j]+1]['wood']."</span>
<span class=\"resources r2 little_res\"><img class=\"r2\" src=\"img/x.gif\" alt=\"agyag\">".${'ab'.$i}[$abdata['a'.$j]+1]['clay']."</span>
<span class=\"resources r3\"><img class=\"r3\" src=\"img/x.gif\" alt=\"vasérc\">".${'ab'.$i}[$abdata['a'.$j]+1]['iron']."</span>
<span class=\"resources r4\"><img class=\"r4\" src=\"img/x.gif\" alt=\"búza\">".${'ab'.$i}[$abdata['a'.$j]+1]['crop']."</span>
<div class=\"clear\"></div>

<span class=\"clocks\">
<img class=\"clock\" src=\"img/x.gif\" alt=\"Idő\">";
                echo $generator->getTimeFormat(round(${'ab'.$i}[$abdata['a'.$j]+1]['time']*($bid12[$building->getTypeLevel(12)]['attri'] / 100)/SPEED));
                echo "</span>";
                
				/*if($session->gold >= 3 && $building->getTypeLevel(17) >= 1) {
					echo npcButton(${'ab'.$i}[$abdata['a'.$j]+1]['wood'],${'ab'.$i}[$abdata['a'.$j]+1]['clay'],${'ab'.$i}[$abdata['a'.$j]+1]['iron'],${'ab'.$i}[$abdata['a'.$j]+1]['crop']);					
				}*/
				if (${'ab'.$i}[$abdata['a'.$j]+1]['wood'] > $village->awood || ${'ab'.$i}[$abdata['a'.$j]+1]['clay'] > $village->aclay || ${'ab'.$i}[$abdata['a'.$j]+1]['iron'] > $village->airon || ${'ab'.$i}[$abdata['a'.$j]+1]['crop'] > $village->acrop) {
					echo '<div class="sections"><div class="section1">';
					if($village->getProd("crop")>0){
						$time = $technology->calculateAvaliable(22,${'r'.$i});
						echo "<div class=\"contractLink\"><span class=\"none\">Enough resources ".$time[0]." at ".$time[1]."</span></div>
						<div class=\"clear\">&nbsp;</div>";
					} else {
						echo "<div class=\"contractLink\"><span class=\"none\">Crop production is negative so you will never reach the required resources</span></div>
						<div class=\"clear\">&nbsp;</div>";
					}
					echo '</div>';
					if($session->gold >= 3 && $building->getTypeLevel(17) >= 1) {
						echo npcButton(${'r'.$i}['wood'],${'r'.$i}['clay'],${'r'.$i}['iron'],${'r'.$i}['crop']);
					}
					echo '</div>';
				}
                echo "<div class=\"clear\"></div></div></div>";
            }
            if (${'ab'.$i}[$abdata['a'.$j]+1]['wood'] > $village->awood || ${'ab'.$i}[$abdata['a'.$j]+1]['clay'] > $village->aclay || ${'ab'.$i}[$abdata['a'.$j]+1]['iron'] > $village->airon || ${'ab'.$i}[$abdata['a'.$j]+1]['crop'] > $village->acrop) {
                /*if($village->getProd("crop")>0){
                    $time = $technology->calculateAvaliable(12,${'ab'.$i}[$abdata['a'.$j]+1]);
                    echo "<div class=\"contractLink\"><span class=\"none\">Enough Resources: ".$time[0]." ".$time[1]."</span></div>";
                } else {
                    echo "<div class=\"contractLink\"><span class=\"none\">Wheat production is negative, there will never be enough resources</span></div>";
                }
                //echo "<div class=\"contractLink\"><span class=\"none\">few resources</span></div>";*/
            }
            else if ($building->getTypeLevel(12) <= $abdata['a'.$j]) {
                if ($abdata['a'.$j] == 20)
                {
                    echo "<div class=\"contractLink\"><span class=\"none\">".kuzupg0." </span></div>";
                }
                else
                {
                    echo "<div class=\"contractLink\"><span class=\"none\">".kuzupg1."</span></div>";
                }
            }
            else if (count($ABups) > 1) {
                echo "<div class=\"contractLink\"><span class=\"none\">".kuzupg2."</span></div>";
            }
            else {

                echo "<div class=\"contractLink\"><span class=\"none\">
                    <button type=\"button\" value=\"Upgrade level\" class=\"green\" onclick=\"window.location.href = 'build.php?id=$id&amp;a=$j&amp;c=$session->mchecker'; return false;\">
<div class=\"button-container addHoverClick\">
  <div class=\"button-background\">
   <div class=\"buttonStart\">
    <div class=\"buttonEnd\">
     <div class=\"buttonMiddle\"></div>
    </div>
   </div>
  </div>
  <div class=\"button-content\">".KZ2."</div></div></button>
                    </span></div>";
            }
            echo "</div>
<div class=\"clear\"></div>
</div><hr>";
        }
    }
    ?>

</div>

<?php
if(count($ABups) > 0) {
    echo "<table cellpadding=\"1\" cellspacing=\"1\" class=\"under_progress\"><thead><tr><td>".KZ5."</td><td>".KZ6."</td><td>".KZ7."</td></tr>
</thead><tbody>";
    if(!isset($timer)) {
        $timer = 1;
    }
    foreach($ABups as $black) {
        $unit = ($session->tribe-1)*10 + substr($black['tech'],1,2);
        echo "<tr><td class=\"desc\"><img class=\"unit u$unit\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($unit)."\" title=\"".$technology->getUnitName($unit)."\" />".$technology->getUnitName($unit)."</td>";
        echo "<td class=\"dur\"><span id=\"timer$timer\">".$generator->getTimeFormat($black['timestamp']-time())."</span></td>";
        $date = $generator->procMtime($black['timestamp']);
        echo "<td class=\"fin\"><span>".$date[1]."</span><span> </span></td>";
        echo "</tr>";
        $timer +=1;
    }
    echo "</tbody></table>";
	
	echo '<div class="finishNow"><button onclick="document.location.href=\'dorf2.php?buildingFinish=1\'" type="button" value="'.INSTANTCMLT.'" id="button526f68b2930cf" class="gold ">
                <div class="button-container addHoverClick ">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content">'.INSTANTCMLT.'</div>
                </div>
            </button>

        </div>';
}
?>