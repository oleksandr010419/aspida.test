<?php
$units = $database->getMovement("34", $village->wid, 1) ?? [];
$total_for = is_array($units) ? count($units) : 0;

$send = $database->getMovement("1", $village->wid, 1) ?? [];
$total_for2 = is_array($send) ? count($send) : 0;

$total_artefact = $database->checkArtefactsEffects($session->uid, $village->wid, 3);
if (!isset($timer)) {
    $timer = 1;
}

for ($y = 0; $y < $total_for; $y++) {
    $res = $units[$y];

	
if ($units[$y]['sort_type']==3){
	if ($units[$y]['attack_type']==3){
		$actionType = "".normal_attack_1."";
	} else if ($units[$y]['attack_type']==4){
		$actionType = "".normal_attack_2."";
	}else if ($units[$y]['attack_type']==2){
		$actionType = "Reinforcements for ";
	}
	$info=$database->getUserVillInfoByVillageID($units[$y]['from']);
	$reinfowner = $info['id'];
	if($units[$y]['attack_type'] != 1){
	if($units[$y]['from'] != 0){
				  if($units[$y]['t11'] != 0 && $reinfowner == $session->uid) {
                  $colspan = 11;
				  }else{
				  $colspan = 10;
				  }
		echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td  style=\"background-color:#fcd1d1;\"class=\"role ".$units[$y]['moveid']."\">
                  <a href=\"karte.php?d=".$units[$y]['from']."&c=".$generator->getMapCheck($units[$y]['from'])."\">".$info['name']."</a></td>
                  <td  style=\"background-color:#fcd1d1;\"colspan=\"".$colspan."\">";
                  echo "<b>$actionType</b><a href=\"karte.php?d=".$units[$y]['from']."\">".$village->vname."</a>";
                  echo "</td></tr></thead><tbody class=\"units\">";
                  $tribe = $info['tribe'];
                  $start = ($tribe-1)*10+1;
				  $end = ($tribe*10);
                  echo "<tr><th> &nbsp;</th>";
                  for($i=$start;$i<=($end);$i++) {
                  	echo "<td><img src=\"img/x.gif\" class=\"unit u".$i."\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
                  }

                    if($units[$y]['t11'] != 0 && $reinfowner == $session->uid) {
                  	echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
                  }
                  echo "</tr><tr><th>".ot4m1."</th>";
                  $totalunits = $units[$y]['t1']+$units[$y]['t2']+$units[$y]['t3']+$units[$y]['t4']+$units[$y]['t5']+$units[$y]['t6']+$units[$y]['t7']+$units[$y]['t8']+$units[$y]['t9']+$units[$y]['t10']+$units[$y]['t11'];

                  for($i=1;$i<=$colspan;$i++) {
				  if($units[$y]['attack_type'] == 2){
				  if($reinfowner != $session->uid){
						echo "<td class=\"none\" >?</td>";
				  }else{



            	if($units[$y]['t'.$i] == 0) {
                	echo "<td class=\"none\">0</td>";
                }
                else {
                echo "<td>";
                echo $units[$y]['t'.$i]."</td>";
				}
				  }}else{

				  if($totalunits > $building->getTypeLevel(16) && $total_artefact == 1){
                 		echo "<td class=\"none\">?</td>";
                  }else{
				  if($units[$y]['t'.$i] == 0) {
                    echo "<td class=\"none\">0</td>";
				  }else{
					echo "<td>?</td>";
                  }
				  }
				  }
				  }
                  echo "</tr></tbody>";
                  echo '
                  <tbody class="infos">
									<tr>
										<th>'.build38.'</th>
										<td colspan="'.$colspan.'">
										<div class="in small"><span id=timer'.$timer.'>'.$generator->getTimeFormat($units[$y]['endtime']-time()).'</span></div>';
										    $datetime = $generator->procMtime($units[$y]['endtime']);
										    echo "<div class=\"at small\">";
										    if($datetime[0] != "today") {
										    echo "".$datetime[0]." ";
										    }
										    echo "at ".$datetime[1]."</div>
											</div>
										</td>
									</tr>
								</tbody>";
		echo "</table>";
		}
	}
}else if ($units[$y]['sort_type']==4){
	if ($units[$y]['attack_type']==1){
		$actionType = "".build30."";
	} else if ($units[$y]['attack_type']==2){
		$actionType = "Reinforcements for ";
	} else if ($units[$y]['attack_type']==3){
		$actionType = "".build30."";
	} else if ($units[$y]['attack_type']==4){
		$actionType = "".build30."";
	}
    $actionType = "Return from prison ";

$to = $database->getMInfo($units[$y]['vref']);
$tryv=$database->checkOasisExist($units[$y]['from']);

if($tryv==true){
	$vname="Oasis";
	}elseif ($units[$y]['attack_type']==88){
    $vname = "Prisoners ";
}else{$vname=$database->getVillageField($units[$y]['from'],"name");}
?>
<table class="troop_details" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<td class="role <?= $units[$y]['moveid'];?>" style="background-color:#daeeb9;"><a href="karte.php?d=<?php echo $village->wid."&c=".$generator->getMapCheck($village->wid); ?>"><?php echo  $village->vname; ?></a></td>
			<td colspan="<?php if($units[$y]['t11'] != 0) {echo"11";}else{echo"10";}?>" style="background-color:#daeeb9;"><a href="karte.php?d=<?php echo $units[$y]['from']."&c=".$generator->getMapCheck($units[$y]['from']); ?>"><?php echo build30 .$vname; ?></a></td>
		</tr>
	</thead>
	<tbody class="units">
			<?php

				  $tribe = $session->tribe;
				  if($tribe==0)$tribe=4;
                  $start = ($tribe-1)*10+1;
                  $end = ($tribe*10);
                  echo "<tr><th>&nbsp;</th>";
                  for($i=$start;$i<=($end);$i++) {
                  	echo "<td><img src=\"img/x.gif\" class=\"unit u".$i."\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
                  }
                  if($units[$y]['t11'] != 0 ) {
                   echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
                  }
			?>
			</tr>
      <tr><th><?=ot4m1?></th>
            <?php
            for($i=1;$i<($units[$y]['t11'] != 0?12:11);$i++) {
            	if($units[$y]['t'.$i] == 0) {
                	echo "<td class=\"none\">0</td>";
                }
                else {
                echo "<td>";
                echo $units[$y]['t'.$i]."</td>";
                }
			}
            ?>
           </tr>
            <?php
			$totalres = $res['wood']+$res['clay']+$res['iron']+$res['crop'];
			if($units[$y]['attack_type']!=2 and $units[$y]['attack_type']!=1 and $totalres != ""){?>
       <tr><th>raid</th>

			<td colspan="<?php if($units[$y]['t11'] == 0) {echo"10";}else{echo"11";}?>">
			<?php
			$totalcarry = $units[$y]['t1']*${'u'.$start.''}['cap']+$units[$y]['t2']*${'u'.($start+1).''}['cap']+$units[$y]['t3']*${'u'.($start+2).''}['cap']+$units[$y]['t4']*${'u'.($start+3).''}['cap']+$units[$y]['t5']*${'u'.($start+4).''}['cap']+$units[$y]['t6']*${'u'.($start+5).''}['cap']+$units[$y]['t7']*${'u'.($start+6).''}['cap']+$units[$y]['t8']*${'u'.($start+7).''}['cap']+$units[$y]['t9']*${'u'.($start+8).''}['cap']+$units[$y]['t10']*${'u'.($start+9).''}['cap'];
			echo "<div class=\"in small\"><img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"Lumber\" />".$res['wood']."<img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".$res['clay']."<img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".$res['iron']."<img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".$res['crop']."</div>";
			echo "<div class=\"in small\"><img class=\"car\" src=\"gpack/travian_default/img/a/car.gif\" alt=\"carry\" title=\"carry\"/>".$totalres."/".$totalcarry."</div>";
            ?>
           </tr>
		   <?php } ?>
    </tbody>
		<tbody class="infos">
			<tr>
				<th><?=build26?></th>
				<td colspan="<?php if($units[$y]['t11'] == 0) {echo"10";}else{echo"11";}?>">
				<?php
				    echo "<div class=\"in small\"><span id=timer".$timer.">".$generator->getTimeFormat($units[$y]['endtime']-time())."</span></div>";
				    $datetime = $generator->procMtime($units[$y]['endtime']);
				    echo "<div class=\"at small\">";
				    if($datetime[0] != "today") {
				    echo " ".$datetime[0]." ";
				    }
				    echo "at ".$datetime[1]."</div>";
    		?>
					</div>
				</td>
			</tr>
		</tbody>
          </table>



<?php        }
$timer++;
}

		$oasis = $village->oasisowned ?? [];
$total_for33 = 0;
$iatt = 1;

foreach ($oasis as $oa) {
    $oasistroo[$iatt] = $database->getMovement("33", $oa['wref'], 1) ?? [];
    $iatt++;
    $total_for33 += is_array($oasistroo[$iatt]) ? count($oasistroo[$iatt]) : 0;
}

for($t=1;$t <=3;$t++){
	if(is_array($oasistroo[$t]) && count($oasistroo[$t])>0){
		foreach ($oasistroo[$t] as $oasistroop){
$vname=$database->getVillageField($oasistroop['from'],"name");
		echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">
                  <a href=\"karte.php?d=".$oasistroop['from']."&c=".$generator->getMapCheck($oasistroop[$t]['from'])."\">".$vname."</a></td>
                  <td colspan=\"10\">";
                  echo "<b>Attack against </b><a href=\"karte.php?d=".$oasistroop['from']."\">Oasis</a>";
                  echo "</td></tr></thead><tbody class=\"units\">";
                  $tribe = $database->getUserTribeByOasisID($oasistroop['to']);
                  $start = ($tribe-1)*10+1;
				  $end = ($tribe*10);
                  echo "<tr><th>&nbsp;</th>";
                  for($i=$start;$i<=($end);$i++) {
                  	echo "<td><img src=\"img/x.gif\" class=\"unit u".$i."\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
                  }

                  echo "</tr><tr><th>".ot4m1."</th>"; 
                  for($i=1;$i<=10;$i++) {


						echo "<td class=\"none\">?</td>";
				  }

				?>
           </tr>

		<tbody class="infos">
			<tr>
				<th>Arrival</th>
				<td colspan="10">
				<?php
				    echo "<div class=\"in small\"><span id=timer".$timer.">".$generator->getTimeFormat($oasistroop['endtime']-time())."</span></div>";
				    $datetime = $generator->procMtime($oasistroop['endtime']);
				    echo "<div class=\"at small\">";
				    if($datetime[0] != "today") {
				    echo $datetime[0]." ";
				    }
				    echo "в ".$datetime[1]."</div>";
			          ?>
					</div>
				</td>
			</tr>
		</tbody>
</table>
	 <?php
	 }
	 }
    $timer++;
				    }

    		?>
