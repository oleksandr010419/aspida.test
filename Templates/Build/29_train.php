<?php
			$art=$database->checkArtefactsEffects($session->uid,$village->wid,5);
if($session->heroD['wref']!=$village->wid){
    $bonuses['barrack']=1;
}else{
    $bonuses=$database->allHeroBonuses($database->getHeroInventory($session->uid));
}

	$start = ($session->tribe-1)*10+1;
	$end = ($session->tribe-1)*10+3;
	if($session->tribe == 7 || $session->tribe == 3){
		$end = ($session->tribe-1)*10+2;
	}elseif($session->tribe==2){
		$end = ($session->tribe-1)*10+4;
	}
    for ($i=$start;$i<=$end;$i++) {
        if ($i <> 4 && $i <> 23 && $i <> 24 && $i <> 54 && $i <> 63 && $i <> 64 &&($technology->getTech((($i)-(( $session->tribe-1)*10))) || $i%10 == 1)) {

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
                        <div class=\"title\">
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
                        <span class=\"resources r1\"><img class=\"r1\" src=\"img/x.gif\" alt=\"Fa\">".(${'u'.$i}['wood']*3)."</span>
                        <span class=\"resources r2\"><img class=\"r2\" src=\"img/x.gif\" alt=\"Agyag\">".(${'u'.$i}['clay']*3)."</span>
                        <span class=\"resources r3\"><img class=\"r3\" src=\"img/x.gif\" alt=\"Vasérc\">".(${'u'.$i}['iron']*3)."</span>
                        <span class=\"resources r4\"><img class=\"r4\" src=\"img/x.gif\" alt=\"Búza\">".(${'u'.$i}['crop']*3)."</span>
                        <span class=\"resources r5\"><img class=\"r5\" src=\"img/x.gif\" alt=\"Búzafogyasztás\">".${'u'.$i}['pop']."</span>
                        <div class=\"clear\"></div>
                        <span class=\"clocks\"><img class=\"clock\" src=\"img/x.gif\" alt=\"óra\">";$dur=round((${'u'.$i}['time'] * ($bid29[$village->resarray['f'.$id]]['attri'] / 100) / SPEED * $art*$bonuses['barrack']),5);


					$dur=$generator->getTimeFormat($dur);
echo $dur;
if($session->gold >= 3 && $building->getTypeLevel(17) >= 1) {
    echo npcButton(${'u'.$i}['wood']*$technology->maxUnitPlus($i),${'u'.$i}['clay']*$technology->maxUnitPlus($i),${'u'.$i}['iron']*$technology->maxUnitPlus($i),${'u'.$i}['crop']*$technology->maxUnitPlus($i));
}
            echo "</span><div class=\"clear\"></div></div><span class=\"value\"> </span>
                        <input type=\"text\" class=\"text\" name=\"t".$i."\" value=\"0\" maxlength=\"".MAXLENGHT."\">
                        <span class=\"value\"> / </span>
                        <a href=\"#\" onClick=\"document.snd.t".$i.".value=".$technology->maxUnit($i,true)."; return false;\">".$technology->maxUnit($i,true)."</a>
                    </div></div>
                    <div class=\"clear\"></div><br />";
        }
    }

