<div class="paper" id="report_surround">
	<div class="layout">
		<div class="paperTop">
			<div class="paperContent">
				<div id="subject">
					<div class="header label"><?=rpts6?>:</div>
					<div class="header text"><?=$all['topic'];?></div>
					<div class="clear"></div>
				</div>

				<div id="time">
					<?php
                $date = $generator->procMtime($all['time']); ?>
					<div class="header label"><?=rpts8?>:</div>
					<div class="header text"><?php echo $date[0]." by ".$date[1]; ?></div>
				</div>
			<div id="message">
					<img src="img/x.gif" class="reportImage reportType6" alt="">					<table id="attacker" cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<td class="role"><div class="boxes boxesColor red">
	<div class="boxes-tl"></div>
	<div class="boxes-tr"></div>
	<div class="boxes-tc"></div>
	<div class="boxes-ml"></div>
	<div class="boxes-mr"></div>
	<div class="boxes-mc"></div>
	<div class="boxes-bl"></div>
	<div class="boxes-br"></div>
	<div class="boxes-bc"></div>
	<div class="boxes-contents cf"><div class="role"><?=rpts11?></div>	</div>
</div></td><td class="troopHeadline" colspan="11"><p><a href="spieler.php?uid=<?=$dataarray[0]?>"><?=$dataarray[1] ?></a> <?=rpts4?> <a href="karte.php?d=<?php echo $dataarray[2]."&amp;c=".$generator->getMapCheck($dataarray[2]); ?>"><?=$dataarray[3] ?></a></p></td>
</tr>
</thead>

<tbody class="units">
<tr>
<td>&nbsp;</td>
<?php
$start = ($dataarray[4]-1)*10+1;
for($i=$start;$i<=($start+9);$i++) {
	echo "<td class=\"uniticon\"><img src=\"img/x.gif\" class=\"unit u$i\" title=\"\" alt=\"\" /></td>";
}
	echo "<td class=\"uniticon last\"><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";

echo "</tr></tbody><tbody class=\"units\"><tr><th>".rpts0."</th>";
for($i=5;$i<15;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"unit none\">0</td>";
    }
    else {
    	echo "<td class=\"unit\">".$dataarray[$i]."</td>";
    }
}
if($dataarray[15] == 0) {
    	echo "<td class=\"unit none last\">0</td>";
    }
    else {
    	echo "<td class=\"unit last\">".$dataarray[15]."</td>";
    }


echo "</tr></tbody><tbody class=\"units last\"><tr><th>".rpts1."</th>";
for($i=16;$i<26;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"unit none\">0</td>";
    }
    else {
    	echo "<td class=\"unit\">".$dataarray[$i]."</td>";
    }
}
if($dataarray[26] == 0) {
    	echo "<td class=\"unit none last\">0</td>";
    }
    else {
    	echo "<td class=\"unit last\">".$dataarray[26]."</td>";
    }
if($all['data1']!=''){
    $datar=explode(',',$all['data1']);
	if(isset($datar[11])){
		if(isset($datar[12])){
			echo "<tr><th>" . PRISONERS . "</th>";
			for ($i = 12; $i <= 21; $i++) {
				if ($datar[$i] == 0) {
					echo "<td class=\"none\">0</td>";
				} else {
					echo "<td>" . $datar[$i] . "</td>";
				}
			}
			echo "<td class=\"unit last\">" . $datar[22] . "</td>";
		}
		
		echo "<tr><th>" . rpts16 . "</th>";
	}else{		
		echo "<tr><th>" .  rpts2. "</th>";
	}
    for($i=0;$i<=10;$i++) {
        if($datar[$i] == 0) {
            echo "<td class=\"unit none\">0</td>";
        }
        else {
           echo "<td class=\"unit\">".$datar[$i]."</td>";
        }
    }

}


if ($dataarray[32]){ //ram
?>
	<tbody class="goods"><tr><th><?=rpts3?></th><td colspan="11">
	<img class="unit u<?=($dataarray[4]-1)*10+7; ?>" src="img/x.gif" alt="Ram" title="Ram" />
	<?php echo $dataarray[32]; ?>
    </td></tr></tbody>
<?php }
if ($dataarray[33]){ //cata
?>
	<tbody class="goods"><tr><th><?=rpts3?></th><td colspan="11">
	<img class="unit u<?=($dataarray[4]-1)*10+8; ?>" src="img/x.gif" alt="Catapult" title="Catapult" />
	<?php echo $dataarray[33]; ?>
    </td></tr></tbody>
<?php }
if ($dataarray[34]){ //cata
?>
	<tbody class="goods"><tr><th><?=rpts3?></th><td colspan="11">
	<img class="unit u<?=($dataarray[4]-1)*10+8; ?>" src="img/x.gif" alt="Catapult" title="Catapult" />
	<?php echo $dataarray[34]; ?>
    </td></tr></tbody>
<?php }
if ($dataarray[35]){ //герой
?>
	<tbody class="goods"><tr><th><?=rpts3?></th><td colspan="11">
	<img class="unit uhero" src="img/x.gif" alt="hero" title="hero" />
	<?php echo $dataarray[35]; ?>
    </td></tr></tbody>
<?php } ?>
<?php
echo "</tr></tbody>"; ?>

 </table>

	<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<td class="role"><div class="boxes boxesColor green">
	<div class="boxes-tl"></div>
	<div class="boxes-tr"></div>
	<div class="boxes-tc"></div>
	<div class="boxes-ml"></div>
	<div class="boxes-mr"></div>
	<div class="boxes-mc"></div>
	<div class="boxes-bl"></div>
	<div class="boxes-br"></div>
	<div class="boxes-bc"></div>
	<div class="boxes-contents cf"><div class="role"><?=rpts9?></div>	</div>
	<td class="troopHeadline" colspan="11"><p><?php  echo'<a href="spieler.php?uid='.$dataarray[27].'">'.$dataarray[28].'</a> from the village <a href="karte.php?d='.$dataarray[29].'&amp;c='.$generator->getMapCheck($dataarray[29]).'">'.$dataarray[30].'</a>'; ?><p></td>
	</tr></thead>
	<tbody class="units">
<tr><th class="coords"></th>


	<?php
    $start = ($dataarray[31]-1)*10+1;
for($i=$start;$i<($start+9);$i++) {
	echo "<td class=\"uniticon\"><img src=\"img/x.gif\" class=\"unit u$i\" title=\"\" alt=\"\" /></td>";
}

echo "<td class=\"uniticon last\"><img src=\"img/x.gif\" class=\"unit u$i\" title=\"\" alt=\"\" /></td>";
echo "</tr><tr><th>".rpts0."</th>";
for($i=1;$i<10;$i++) {
        echo "<td class=\"unit none\">?</td>";

}
echo "<td class=\"unit last none\">?</td>";
echo "<tbody class=\"units last\"><th>".rpts1."</th>";
for($i=1;$i<10;$i++) {
        echo "<td class=\"none\">?</td>";
}
echo "<td class=\"unit last none\">?</td>";

?>
</tr></tbody></table>					<div class="clear"></div>
				</div>
			</div>
		</div>
		<div class="paperBottom"></div>
	</div>
</div>