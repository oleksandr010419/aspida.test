<div class="clear"></div>
		<?php
		$level = $village->resarray['f'.$id];
		$inuse = $village->currentcel;
		$time = time();
		$i = 1;
        echo "
<div class=\"build_details researches\">
	<div class=\"research\">
		<div class=\"information\">
			<div class=\"title\">
                <a>
                <img class=\"celebration celebrationSmall\" src=\"img/x.gif\" alt=\"".ratusha14."\">
                </a>
                <a>".ratusha14."</a>
                <span class=\"points\">(500 ".ratusha11.")</span>
            </div>
            <div class=\"costs\">
				<div class=\"showCosts\">
                    <span class=\"resources r1 little_res\"><img class=\"r1\" src=\"img/x.gif\" alt=\"".WOOD."\">".$cel[$i]['wood']."</span>
                    <span class=\"resources r2 little_res\"><img class=\"r2\" src=\"img/x.gif\" alt=\"".CLAY."\">".$cel[$i]['clay']."</span>
                    <span class=\"resources r3 little_res\"><img class=\"r3\" src=\"img/x.gif\" alt=\"".IRON."\">".$cel[$i]['iron']."</span>
                    <span class=\"resources r4 little_res\"><img class=\"r4\" src=\"img/x.gif\" alt=\"".CROP."\">".$cel[$i]['crop']."</span>
                    <div class=\"clear\"></div>
                    <span class=\"clocks\"><img class=\"clock\" src=\"img/x.gif\" alt=\"".HRS."\">";
        echo $generator->getTimeFormat(round($cel[$i]['time'] * ($bid24[$building->getTypeLevel(24)]['attri'] / 100)/SPEED));
        echo "</span>";
                
				   if($session->gold >= 3 && $building->getTypeLevel(17) >= 1) {
					   echo npcButton($cel[$i]['wood'],$cel[$i]['clay'],$cel[$i]['iron'],$cel[$i]['crop']);
					}
        echo "<div class=\"clear\"></div></div></div>";
				if($inuse > $time){
                    echo "<div class=\"contractLink\"><span class=\"none\">".ratusha3." ".ratusha4."</span></div>";
					}
                  else if($cel[$i]['wood'] > $village->awood || $cel[$i]['clay'] > $village->aclay || $cel[$i]['iron'] > $village->airon || $cel[$i]['crop'] > $village->acrop) {
					if($village->getProd("crop")>0){
	                   	$time = $technology->calculateAvaliable(24,$cel[$i]);
		                echo "<div class=\"contractLink\"><span class=\"none\">".ratusha11." ".$time[0]." at ".$time[1]."</span></div></td>";
					} else {
						echo "<div class=\"contractLink\"><span class=\"none\">".ratusha5."</span></div></td>";
					}
                    echo "<td class=\"act\"><div class=\"none\">".ratusha6." ".ratusha7."</div></td></tr>";
                }
                else {

                    echo "
                	<button type=\"button\" value=\"\" class=\"green\" onclick=\"window.location.href = 'build.php?id=$id&type=1'; return false;\">
						<div class=\"button-container addHoverClick\">
  <div class=\"button-background\">
   <div class=\"buttonStart\">
    <div class=\"buttonEnd\">
     <div class=\"buttonMiddle\"></div>
    </div>
   </div>
  </div>
  <div class=\"button-content\">".ratusha8."</div>
						</div>
					</button>";
                }
        echo "</div><div class=\"clear\"></div></div></div>";
			if($level >= 10){
                $i=2;
		$level = $village->resarray['f'.$id];
                echo "
<div class=\"build_details researches\">
<div class=\"research\">
<div class=\"information\">
<div class=\"title\">
<a>
<img class=\"celebration celebrationSmall\" src=\"img/x.gif\" alt=\"".ratusha9."\">
</a>
<a>".ratusha9."</a>
<span class=\"points\">(2000 ".ratusha11.")</span>
</div>
<div class=\"costs\">
				<div class=\"showCosts\">
                <span class=\"resources r1 little_res\"><img class=\"r1\" src=\"img/x.gif\" alt=\"Fa\">".$cel[$i]['wood']."</span>
                <span class=\"resources r2 little_res\"><img class=\"r2\" src=\"img/x.gif\" alt=\"Agyag\">".$cel[$i]['clay']."</span>
                <span class=\"resources r3 little_res\"><img class=\"r3\" src=\"img/x.gif\" alt=\"Vasérc\">".$cel[$i]['iron']."</span>
                <span class=\"resources r4 little_res\"><img class=\"r4\" src=\"img/x.gif\" alt=\"Búza\">".$cel[$i]['crop']."</span>
                <div class=\"clear\"></div>
                <span class=\"clocks\"><img class=\"clock\" src=\"img/x.gif\" alt=\"Időtartam\">";
                echo $generator->getTimeFormat(round($cel[$i]['time'] * ($bid24[$building->getTypeLevel(24)]['attri'] / 100)/SPEED));
                echo "</span>";
                    if($session->gold >= 3 && $building->getTypeLevel(17) > 1) {                            
					   echo npcButton($cel[$i]['wood'],$cel[$i]['clay'],$cel[$i]['iron'],$cel[$i]['crop']); 
					   }
        echo "<div class=\"clear\"></div></div></div>";
        if($inuse > $time){
            echo "<div class=\"contractLink\"><span class=\"none\">".ratusha3." ".ratusha4."</span></div>";
        }
        else if($cel[$i]['wood'] > $village->awood || $cel[$i]['clay'] > $village->aclay || $cel[$i]['iron'] > $village->airon || $cel[$i]['crop'] > $village->acrop) {
            if($village->getProd("crop")>0){
                $time = $technology->calculateAvaliable(24,$cel[$i]);
                echo "<div class=\"contractLink\"><span class=\"none\">".ratusha11." ".$time[0]." at ".$time[1]."</span></div></td>";
            } else {
                echo "<div class=\"contractLink\"><span class=\"none\">".ratusha5."</span></div></td>";
            }
            echo "<td class=\"act\"><div class=\"none\">".ratusha6." ".ratusha7."</div></td></tr>";
        }
        else {

            echo "
                	<button type=\"button\" value=\"\" class=\"green\" onclick=\"window.location.href = 'build.php?id=$id&type=2'; return false;\">
						<div class=\"button-container addHoverClick\">
  <div class=\"button-background\">
   <div class=\"buttonStart\">
    <div class=\"buttonEnd\">
     <div class=\"buttonMiddle\"></div>
    </div>
   </div>
  </div>
  <div class=\"button-content\">".ratusha8."</div>
						</div>
					</button>";
        }
        echo "</div><div class=\"clear\"></div></div></div>";
            }
?>

