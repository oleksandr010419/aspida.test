<table cellpadding="1" cellspacing="1" class="build_details">
	<thead>
		<tr>
			<td>Celebrations</td>
			<td>Action</td>
		</tr>
	</thead>
	<tbody>

		<tr>
		<?php
		$level = $village->resarray['f'.$id];
		$br_tm = explode(",",$session->brewery);
		$inuse = $br_tm[0];
		$time = Time();
		$i = 1;
			echo "<tr><td class=\"desc\"><div class=\"tit\">Cost for celebration:</div>
					<div class=\"details\"><img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"Lumber\" />38700|<img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />16800|<img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />59400|<img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />13400|<img class=\"clock\" src=\"img/x.gif\" alt=\"duration\" title=\"duration\" />";
                    echo $generator->getTimeFormat(round(3600*6));
                    if($session->gold >= 3 && $building->getTypeLevel(17) >= 1) {
                   $cost['wood']=38700;
						$cost['clay']=16800;
						$cost['iron']=59400;
						$cost['crop']=13400;
						echo npcButton($cost['wood'],$cost['clay'],$cost['iron'],$cost['crop']);
						
					}
				if($inuse > $time){
					echo "<td class=\"act\">
					<div class=\"none\">Celebration</br>in process</div>
					</td></tr>";
					}
                  else if(38700 > $village->awood || 16800 > $village->aclay || 59400 > $village->airon || 13400 > $village->acrop) {
					if($village->getProd("crop")>0){
						$res=array(38700,16800,59400,13400);
	                   	$time = $technology->calculateAvaliable(24,$res);
		                echo "<br><span class=\"none\">Resources will be enough ".$time[0]." by ".$time[1]."</span></div></td>";
					} else {
						echo "<br><span class=\"none\">Not enough resources.</span></div></td>";
					}
                    echo "<td class=\"act\"><div class=\"none\">Not enough<br>resources</div></td></tr>";
                }
                else {
					echo "</td>";
                    echo "<td class=\"act\">";

					echo "<a class=\"research\" href=\"dorf2.php?pivo&wid=$village->wid\">Celebrate</a></td></tr>";
                }

?>
	</tbody>
</table>

