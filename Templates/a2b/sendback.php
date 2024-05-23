<?php
$to = $database->getUserVillInfoByVillageID($enforce['from']);
$tocoor = $database->getCoor($enforce['vref']);
	$fromCor = array('x'=>$tocoor['x'], 'y'=>$tocoor['y']);
	$toCor = array('x'=>$to['vx'], 'y'=>$to['vy']);
	$att_tribe = $to['tribe'];
	if($att_tribe==0)$att_tribe=4;
    $tr=($att_tribe-1);
$start=($tr*10)+1;
$end=(($tr+1)*10);
?>
<h1><?=punktxuev10?></h1>
<form id="snd" method="POST" name="snd" action="a2b.php">
    <table class="troop_details" cellpadding="1" cellspacing="1">
        <thead>
        <tr>
            <td class="role"><?php echo $to['name']; ?></td>
            <td colspan="11"><?=punktxuev11?></td>
        </tr>
        </thead>
        <tbody class="units">
        <tr>
            <th>&nbsp;</th>
            <?php
            for($i=$start;$i<=$end;$i++) {
                echo '<td><img src="img/x.gif" class="unit u'.$i.'" title="" alt=""></td>';
            }
                echo '<td><img src="img/x.gif" class="unit uhero" title="" alt=""></td>';

            ?>
        </tr>
        <tr>
            <th><?=punktxuev12?></th>
            <?php
            $t = 1;
            for($i=$start;$i<=$end;$i++) {
                if ($enforce['u'.($i-($tr*10))]>0){
                    echo "<td><input class=\"text\" name=\"t".$t."\" value=\"".$enforce['u'.($i-($tr*10))]."\" maxlength=\"5\" type=\"text\"></td>";
                }else{
                    echo "<td class=\"none\">0</td>";
                }
                $t++;
            }
            if ($enforce['u11']>0){
                echo "<td><input class=\"text\" name=\"t11\" value=\"".$enforce['u11']."\" maxlength=\"5\" type=\"text\"></td>";
            }else{
                echo "<td class=\"none\">0</td>";
            }
            ?>


        </tr>
        </tbody>


	<tbody class="infos">
		<tr>
			<th><?=punktxuev13?>:</th>

			<?php

            $speeds = array();
                //find slowest unit.
                for($i=$start;$i<=$end;$i++)
                {

                        if($enforce['u'.($i-($tr*10))]>0)
                        {
							global ${'u'.$i};
                            $speeds[] = ${'u'.$i}['speed'];
                        }

                }
            $bon=$bon2=$bon3=$bon4=1;
            $bonuses=$database->allHeroBonuses($database->getHeroInventory($to['owner']));
			if ($enforce['u11']>0){
                $result = $database->getHeroData($to['owner']);
                $speeds[] = $result['speed'];

                $tally=$database->getUserAllianceID($to['owner']);
                if($session->alliance>0 && $session->alliance==$tally){$bon=$bonuses['ally'];}
                if($session->uid==$to['owner']){$bon2=$bonuses['own'];}
				$bon3=$bonuses['speedb'];
                $bon4=$bonuses['back'];
            }

      		$fastertroops = $database->checkArtefactsEffects($session->uid,$village->wid,2);
            if(!count($speeds)){
				$speeds=array(1);
            }
			$time = round($database->procDistanceTime($fromCor,$toCor,(min($speeds)*$bon*$bon2*$bon4*$bon3),1,$village->wid)/$fastertroops);

			?>

			<td colspan="11">
			<div class="in">in <?php echo $generator->getTimeFormat($time); ?></div>
			<div class="at">at <span id="tp2"> <?php echo date("H:i:s",time()+$time)?></span></div>
                <div class="clear"></div>
            </td>
        </tr>
    </tbody>
    </table>


<input name="ckey" value="<?php echo $ckey; ?>" type="hidden">
<input name="q" value="<?php echo generateHiddenKey(time()); ?>" type="hidden">
<input name="id" value="39" type="hidden">
<input name="a" value="533374" type="hidden">
<input name="c" value="8" type="hidden">

        <button type="submit" value="ok" name="s1" id="btn_ok"
                onclick="if (this.disabled==false) {document.getElementById('snd').submit();} this.disabled=true;"
                class="green">
            <div class="button-container addHoverClick ">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div><div class="button-content"><?= punktxuev3 ?></div>
            </div>
        </button>
    </form>
