
<table id="overview" cellpadding="1" cellspacing="1">
<thead>
<tr><td><?=dorf5?></td><td><?=dorf6?></td><td><?=dorf7?></td><td><?=dorf8?></td><td><?=dorf9?></td></tr>
</thead>
<tbody>
<?php

	foreach($session->villages as $vid){
		$vdata = $database->getVillagedorf31($vid);
		$jobs = $database->getJobstype($vid);
		$unit = $database->getTraining($vid);
		$totalmerchants = $building->getTypeLevel(17,$vid);
		$availmerchants = $totalmerchants - $database->totalMerchantUsed($vid);
		$incoming_attacks = $database->getMovement(3,$vid,1);
		$bui = '';
		$tro = '';
		$att = '';
$coinat=count($incoming_attacks);
		if ($coinat > 0) {
			$inc_atts = $coinat;
			for($i=0;$i<$coinat;$i++){
				if($incoming_attacks[$i]['attack_type'] == 2) {
					$inc_atts -= 1;
				}
			}
			if($inc_atts > 0) {
				$att = '<a href="build.php?newdid='.$vid.'&id=39"><img class="att1" src="img/x.gif" title="'.$coinat.' incoming attack'.($coinat>1?'s':'').'" alt="'.$coinat.' incoming attack'.($coinat>1?'s':'').'"></a>';
			}
		}
		foreach($jobs as $b){
			$bui .= '<a href="build.php?newdid='.$vid.'&id='.$b['field'].'"><img class="bau" src="img/x.gif" title="'.$building->procResType($b['type']).'" alt="'.$building->procResType($b['type']).'"></a>';
		}	
		foreach($unit as $c){
			$gid = in_array($c['unit'],$unitsbytype['infantry'])?19:(in_array($c['unit'],$unitsbytype['cavalry'])?20:(in_array($c['unit'],$unitsbytype['siege'])?21:(in_array(($c['unit']-200),$unitsbytype['infantry'])?29:(in_array(($c['unit']-200),$unitsbytype['cavalry'])?30:($building->getTypeLevel(26)>0?26:$building->getTypeLevel(25)>0?25:44)))));
			if($c['unit'] > 200) { $c['unit'] -= 200; }
			$tro .= '<a href="build.php?newdid='.$vid.'&gid='.$gid.'"><img class="unit u'.$c['unit'].'" src="img/x.gif" title="'.$c['amt'].'x '.constant('U'.$c['unit']).'" alt="'.$c['amt'].'x '.constant('U'.$c['unit']).'"></a>';
		}
		if($vdata['capital'] == 1) { $class = 'hl'; } else {$class = ''; }

echo '
<tr class="'.$class.'">
<td class="vil fc"><a href="dorf1.php?newdid='.$vid.'">'.$vdata['name'].'</a></td>
<td class="att">'.$att.'</td>
<td class="bui">'.$bui.'</td>
<td class="tro">'.$tro.'</td>
<td class="tra lc">'.($totalmerchants>0?'<a href="build.php?newdid='.$vid.'&amp;gid=17">':'').$availmerchants.'/'.$totalmerchants.'</a></td>
</tr>';

	}
?>
</tbody></table>
