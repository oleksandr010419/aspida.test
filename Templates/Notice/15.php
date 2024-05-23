<div class="paperTop">
			<div class="paperContent">
				<div id="subject">
					<div class="header label"><?=rpts6?>:</div>
					<div class="header text"><?= $all['topic']?></div>
					<div class="clear"></div>
				</div>

				<div id="time">
					<?php
                $date = $generator->procMtime($all['time']); ?>
					<div class="header label"><?=rpts8?>:</div>
					<div class="header text"><?php echo $date[0]." by ".$date[1]; ?></div>
				</div>

				<div id="message">
					<img src="img/x.gif" class="reportImage reportType5" alt="">					<table id="attacker" cellpadding="0" cellspacing="0">
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
	<div class="boxes-contents cf"><div class="role"><?=rpts9?></div></div>
</div></td><td class="troopHeadline" colspan="11"><p><a href="spieler.php?uid=<?=$dataarray[0]?>"><?=$dataarray[1]?></a> <?=rpts10?> <a href="karte.php?d=<?php echo $dataarray[2]."&amp;c=".$generator->getMapCheck($dataarray[2]); ?>"><?=$dataarray[3] ?></a></p></td>
</tr>
</thead>
<tbody class="units">
<th class="coords"></th>

<?php
$tribe = $dataarray[4];
$start = ($tribe-1)*10+1;
for($i=$start;$i<=($start+9);$i++) {
	echo "<td class=\"uniticon\"><img src=\"img/x.gif\" class=\"unit u$i\" title=\"\" alt=\"\" /></td>";
}

	echo "<td class=\"uniticon last\"><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";

echo "</tr><tr><th>".rpts0."</th>";
for($i=5;$i<=14;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"none\">0</td>";
    }
    else {
    	echo "<td>".$dataarray[$i]."</td>";
    }
}
if($dataarray[15] == 0) {
    	echo "<td class=\"unit none last\">0</td>";
    }
    else {
    echo "<td class=\"unit last\">".$dataarray[15]."</td>";
    }

echo "<tbody class=\"units last\"><tr><th>".rpts1."</th>";
for($i=17;$i<=26;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"unit none\">0</td>";
    }
    else {
    	echo "<td>".$dataarray[$i]."</td>";
    }
	
}
if($dataarray[27] == 0) {
    	echo "<td class=\"unit none last\">0</td>";
    }
    else {
    	echo "<td class=\"unit last\">".$dataarray[27]."</td>";
    }

?>
</tr></tbody></table>					<div class="clear"></div>
				</div>
			</div>
		</div>