<div class="clear"></div>
<?php
$fail = $success = 0;
$acares = $technology->grabAcademyRes();
$unitstart = ($session->tribe-1)*10+2;
$unitend =  ($session->tribe-1)*10+9;
for($i=$unitstart;$i<=$unitend;$i++) {
	if($technology->meetRRequirement($i) && !$technology->getTech($i-(($session->tribe-1)*10)) && !$technology->isResearch($i-(($session->tribe-1)*10),1)) {
        echo "<div class=\"build_details researches\">
        <div>
			<div class=\"bigUnitSection\">
			 <a href=\"#\" onclick=\"return Travian.Game.iPopup(".$i.",1);\">
					<img class=\"unitSection u".$i."Section\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\">
				</a>
				<a href=\"#\" class=\"zoom\" onclick=\"return Travian.Game.unitZoom(".$i.");\">
					<img class=\"zoom\" src=\"img/x.gif\" alt=\"zoom in\">
				</a>
			</div>
			<div class=\"information\">
<div class=\"title\">
<a href=\"#\" onclick=\"return Travian.Game.iPopup(".$i.",1);\">
<img class=\"unit u".$i."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\"></a>
<a href=\"#\" onclick=\"return Travian.Game.iPopup(".$i.",1);\">".$technology->getUnitName($i)."</a>
</div>
<div class=\"costs\">
<div class=\"showCosts\"> <span class=\"resources r1 little_res\"><img class=\"r1\" src=\"img/x.gif\" alt=\"".WOOD."\">".${'r'.$i}['wood']."</span>
                    <span class=\"resources r2 little_res\"><img class=\"r2\" src=\"img/x.gif\" alt=\"".CLAY."\">".${'r'.$i}['clay']."</span>
                    <span class=\"resources r3 little_res\"><img class=\"r3\" src=\"img/x.gif\" alt=\"".IRON."\">".${'r'.$i}['iron']."</span>
                    <span class=\"resources r4 little_res\"><img class=\"r4\" src=\"img/x.gif\" alt=\"".CROP."\">".${'r'.$i}['crop']."</span>
                    <div class=\"clear\"></div>
                    <span class=\"clocks\"><img class=\"clock\" src=\"img/x.gif\" alt=\"".HRS."\">";
						echo $generator->getTimeFormat(round(${'r'.$i}['time'] * ($bid22[$village->resarray['f'.$id]]['attri'] / 100)/SPEED));
					echo "</span>";
					if(${'r'.$i}['wood'] > $village->awood || ${'r'.$i}['clay'] > $village->aclay || ${'r'.$i}['iron'] > $village->airon || ${'r'.$i}['crop'] > $village->acrop) {
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
						echo '</div></div></div></div><div class="clear">&nbsp;</div></div></div>';
					}
                else if (count($acares) > 0) {
                    echo "<br><div class=\"contractLink\"><span class=\"none\">
					Research in Process</span></div></div></div></div>
                    <div class=\"clear\">&nbsp;</div>
                    </div></div>";
                }
				else {
                    echo "<div class=\"contractLink\"><button type=\"button\"  class=\"green\" onclick=\"window.location.href = 'build.php?id=$id&amp;a=$i&amp;c=".$session->mchecker."'; return false;\">
 <div class=\"button-container addHoverClick\">
  <div class=\"button-background\">
   <div class=\"buttonStart\">
    <div class=\"buttonEnd\">
     <div class=\"buttonMiddle\"></div>
    </div>
   </div>
  </div>
  <div class=\"button-content\">".AK8."</div></div></button></div>
</div>
<div class=\"clear\">&nbsp;</div>
</div></div><div class=\"clear\">&nbsp;</div></div></div>";
                }
                $success += 1;
    }
    else {
    $fail += 1;
    }
}
if($success == 0) {
    echo "<div class=\"buildActionOverview trainUnits\"><td colspan=\"2\"><div class=\"none\" align=\"center\">".AK3."</div></td></div>";
}
?>

<?php
if($fail > 0) {
    echo "<p class=\"switch\"><a class=\"openedClosedSwitch switchClosed\" id=\"researchFutureLink\" href=\"#\" onclick=\"Travian.toggleSwitch($('researchFuture'), this);\">".AK6."</a></p>
    <div id=\"researchFuture\" class=\"researches hide \">";
	for($uc=$unitstart;$uc<=$unitend;$uc++) {
		if(!$technology->meetRRequirement($uc) && !$technology->getTech($uc-(($session->tribe-1)*10))) {
			echo"<div><div class=\"bigUnitSection\"><a href=\"#\" onclick=\"return Travian.Game.iPopup(".$uc.",1);\"><img class=\"unitSection u".$uc."Section\" src=\"img/x.gif\" alt=\"".constant('U'.$uc)."\"></a><a href=\"#\" class=\"zoom\" onclick=\"return Travian.Game.unitZoom(".$uc.");\"><img class=\"zoom\" src=\"img/x.gif\" alt=\"zoom in\"></a></div><div class=\"information\"><div class=\"title\"><a href=\"#\" onclick=\"return Travian.Game.iPopup(".$uc.",1);\"><img class=\"unit u".$uc."\" src=\"img/x.gif\" alt=\"".constant('U'.$uc)."\"></a><a href=\"#\" onclick=\"return Travian.Game.iPopup(".$uc.",1);\">".constant('U'.$uc)."</a></div><div class=\"costs\"><div class=\"showCosts\"><span class=\"resources r1 little_res\"><img class=\"r1\" src=\"img/x.gif\" alt=\"".WOOD."\">".${'r'.$uc}['wood']."</span><span class=\"resources r2 little_res\"><img class=\"r2\" src=\"img/x.gif\" alt=\"".clay."\">".${'r'.$uc}['clay']."</span><span class=\"resources r3 little_res\"><img class=\"r3\" src=\"img/x.gif\" alt=\"".IRON."\">".${'r'.$uc}['iron']."</span><span class=\"resources r4 little_res\"><img class=\"r4\" src=\"img/x.gif\" alt=\"".CROP."\">".${'r'.$uc}['crop']."</span><div class=\"clear\"></div><span class=\"clocks\"><img class=\"clock\" src=\"img/x.gif\" alt=\"".HRS."\">";
			echo $generator->getTimeFormat(round(${'r'.$uc}['time'] * ($bid22[$village->resarray['f'.$id]]['attri'] / 100)/SPEED));
			echo '</span><div class="clear"></div></div></div>';
			switch($uc-(($session->tribe-1)*10)){
				case 2: echo"<div class=\"contractLink\"><a href=\"#\">".$building->procResType(22)."</a><span class=\"level\"> ".LVL." 1</span>, <a href=\"#\"> ".$building->procResType(12)." </a><span class=\"level\"> ".LVL." 1</span></div><hr>";break;
				case 3: echo"<div class=\"contractLink\"><a href=\"#\">".$building->procResType(22)."</a><span class=\"level\"> ".LVL." 5</span>, <a href=\"#\"> ".$building->procResType(12)." </a><span class=\"level\"> ".LVL." 1</span></div><hr>";break;
				case 4: 
					if($session->tribe==2){
						echo"<div class=\"contractLink\"><a href=\"#\">".$building->procResType(22)."</a><span class=\"level\"> ".LVL." 1</span>, <a href=\"#\"> ".$building->procResType(15)." </a><span class=\"level\"> ".LVL." 5</span></div><hr>";
					}else{
						echo"<div class=\"contractLink\"><a href=\"#\">".$building->procResType(22)."</a><span class=\"level\"> ".LVL." 5</span>, <a href=\"#\"> ".$building->procResType(20)." </a><span class=\"level\"> ".LVL." 1</span></div><hr>";
					}
					break;
				case 5: 
					if($session->tribe==2){
						echo"<div class=\"contractLink\"><a href=\"#\">".$building->procResType(22)."</a><span class=\"level\"> ".LVL." 5</span>, <a href=\"#\"> ".$building->procResType(20)." </a><span class=\"level\"> ".LVL." 3</span></div><hr>";break;				
					}else{
						echo"<div class=\"contractLink\"><a href=\"#\">".$building->procResType(22)."</a><span class=\"level\"> ".LVL." 5</span>, <a href=\"#\"> ".$building->procResType(20)." </a><span class=\"level\"> ".LVL." 5</span></div><hr>";
					}
					break;
				case 6: 
					if($session->tribe==2){
						echo"<div class=\"contractLink\"><a href=\"#\">".$building->procResType(22)."</a><span class=\"level\"> ".LVL." 15</span>, <a href=\"#\"> ".$building->procResType(20)." </a><span class=\"level\"> ".LVL." 10</span></div><hr>";break;				
					}else{
						echo"<div class=\"contractLink\"><a href=\"#\">".$building->procResType(22)."</a><span class=\"level\"> ".LVL." 5</span>, <a href=\"#\"> ".$building->procResType(20)." </a><span class=\"level\"> ".LVL." 10</span></div><hr>";break;				
					}
					break;
				case 7: echo"<div class=\"contractLink\"><a href=\"#\">".$building->procResType(22)."</a><span class=\"level\"> ".LVL." 15</span>, <a href=\"#\"> ".$building->procResType(21)." </a><span class=\"level\"> ".LVL." 1</span></div><hr>";break;
				case 8: echo"<div class=\"contractLink\"><a href=\"#\">".$building->procResType(22)."</a><span class=\"level\"> ".LVL." 15</span>, <a href=\"#\"> ".$building->procResType(21)." </a><span class=\"level\"> ".LVL." 10</span></div><hr>";break;
				case 9: echo"<div class=\"contractLink\"><a href=\"#\">".$building->procResType(22)."</a><span class=\"level\"> ".LVL." 20</span>, <a href=\"#\"> ".$building->procResType(16)." </a><span class=\"level\"> ".LVL." 10</span></div>";break;
			}
			echo '</div><div class="clear"></div></div>';
		}
	}
     echo "<script type=\"text/javascript\">
	 window.addEvent('domready', function()
     {
		$(\"researchFuture\").toggle = (function()
		{
			this.toggleClass(\"hide\");
			$(\"researchFutureLink\").text = this.hasClass(\"hide\")?\"".AK6."\":\"".AK7."\";
			return false;
		}).bind($(\"researchFuture\"));
	});
		</script>";
    echo "<div class=\"clear\"></div></div>";
}
//$acares = $technology->grabAcademyRes();
if(count($acares) > 0) {
	echo "<table cellpadding=\"1\" cellspacing=\"1\" class=\"under_progress\"><thead><tr><td>Researching</td><td>Duration</td><td>Complete</td></tr>
	</thead><tbody>";
    if(!isset($timer)){$timer = 1;}
	foreach($acares as $aca) {
		$unit = substr($aca['tech'],1,2) + (($session->tribe-1)*10);
		echo "<tr><td class=\"desc\"><img class=\"unit u$unit\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($unit)."\" title=\"".$technology->getUnitName($unit)."\" />".$technology->getUnitName($unit)."</td>";
			echo "<td class=\"dur\"><span id=\"timer$timer\">".$generator->getTimeFormat($aca['timestamp']-time())."</span></td>";
			$date = $generator->procMtime($aca['timestamp']);
		    echo "<td class=\"fin\"><span>".$date[1]."</span><span> hrs</span></td>";
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
