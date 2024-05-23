<?php
			$art=$database->checkArtefactsEffects($session->uid,$village->wid,5);
$success = 0;
if($session->heroD['wref']!=$village->wid){
    $bonuses['stable']=1;
}else{
    $bonuses=$database->allHeroBonuses($database->getHeroInventory($session->uid));
}
if($session->tribe==1){$uniq=4;}
elseif($session->tribe==2){$uniq=15;}
elseif($session->tribe==3){$uniq=23;}
elseif($session->tribe==6){$uniq=54;}
elseif($session->tribe==7){$uniq=63;}
else{$uniq=($session->tribe-1)*10+4;}

$drinking=array(1=>10,2=>15,3=>20);
$drink=0;
for($i=$uniq;$i<=($session->tribe-1)*10+6;$i++) {
    $drink++;
	if($technology->getTech(($i-($session->tribe-1)*10))) {
        echo "<div class=\"action first\">
                	<div class=\"bigUnitSection\">
						<a href=\"#\" onclick=\"return Travian.Game.iPopup(".$i.",1);\">
							<img class=\"unitSection u".$i."Section\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\">
						</a>
						<a href=\"#\" class=\"zoom\" onclick=\"return Travian.Game.unitZoom(".$i.");\">
							<img class=\"zoom\" src=\"img/x.gif\" alt=\"zoom in\">
						</a>
					</div>
					<div class=\"details\">
						<div class=\"tit\">
							<a href=\"#\" onclick=\"return Travian.Game.iPopup(".$i.",1);\"><img class=\"unit u".$i."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\"></a>
							<a href=\"#\" onclick=\"return Travian.Game.iPopup(".$i.",1);\">".$technology->getUnitName($i)."</a>
							<span class=\"furtherInfo\">(Available: ".$village->unitarray['u'.($i-($session->tribe-1)*10)].")</span>
						</div>
						<div class=\"tit\">
							<span class=\"resources \"><img class=\"att_all\" src=\"img/x.gif\" alt=\"Attack\">".(${'u'.$i}['atk'])."</span>
							<span class=\"resources \"><img class=\"def_i\" src=\"img/x.gif\" alt=\"Defence against infantry\">".(${'u'.$i}['di'])."</span>
							<span class=\"resources \"><img class=\"def_c\" src=\"img/x.gif\" alt=\"Defence agains cavlary\">".(${'u'.$i}['dc'])."</span>
						</div>
                        <div class=\"showCosts\">
                                                <span class=\"resources r1\"><img class=\"r1\" src=\"img/x.gif\" alt=\"Fa\">".${'u'.$i}['wood']."</span>
                        <span class=\"resources r2\"><img class=\"r2\" src=\"img/x.gif\" alt=\"Agyag\">".${'u'.$i}['clay']."</span>
                        <span class=\"resources r3\"><img class=\"r3\" src=\"img/x.gif\" alt=\"Vasérc\">".${'u'.$i}['iron']."</span>
                        <span class=\"resources r4\"><img class=\"r4\" src=\"img/x.gif\" alt=\"Búza\">".${'u'.$i}['crop']."</span>";


		if($session->tribe==1 &&  $drinking[$drink]<= $building->getTypeLevel(41)) {
           echo " <span class=\"resources r5\"><img class=\"r5\" src=\"img/x.gif\" alt=\"Búzafogyasztás\">".(${'u'.$i}['pop']-1)."</span>";}else{
            echo " <span class=\"resources r5\"><img class=\"r5\" src=\"img/x.gif\" alt=\"Búzafogyasztás\">".(${'u'.$i}['pop'])."</span>";}
        echo "<div class=\"clear\"></div>
                        <span class=\"clocks\"><img class=\"clock\" src=\"img/x.gif\" alt=\"óra\">";
        $dur=round((${'u'.$i}['time'] * (($bid20[$village->resarray['f'.$id]]['attri']) / 100) * (($building->getTypeLevel(41)>=1 and $session->tribe==1)?(1/$bid41[$building->getTypeLevel(41)]['attri']):1) / SPEED * $art*$bonuses['stable']),5);

					$dur=$generator->getMilisecFormat($dur * 1000);
		echo $dur;
       
		if($session->gold >= 3 && $building->getTypeLevel(17) >= 1) {			
			echo npcButton(${'u'.$i}['wood']*$technology->maxUnitPlus($i),${'u'.$i}['clay']*$technology->maxUnitPlus($i),${'u'.$i}['iron']*$technology->maxUnitPlus($i),${'u'.$i}['crop']*$technology->maxUnitPlus($i));
		}
        echo "</span><div class=\"clear\"></div></div><span class=\"value\"></span>
						<input type=\"text\" class=\"text\" name=\"t$i\" value=\"0\" maxlength=\"".MAXLENGHT."\">
                        <span class=\"value\"> / </span>
						<a href=\"#\" onClick=\"document.snd.t$i.value=".$technology->maxUnit($i)."; return false;\">".$technology->maxUnit($i)."</a>
					</div></div>
					<div class=\"clear\"></div><br />";
          $success += 1;
    }
}
if($success == 0) {
	echo "<tr><td colspan=\"3\"><div class=\"none\" align=\"center\">".KO2."</div></td></tr>";
}

