<?php /*die(print_r($dataarray));*/?>
<div class="paper" id="report_surround">
	<div class="layout">
		<div class="paperTop">
			<div class="paperContent">
				<div id="subject">
				<div class="header label"><?=rpts6?></div>
					<div class="header text"><?=$all['topic']?></div>
				<div class="clear"></div>
				</div>
				
                <?php
                $date = $generator->procMtime($all['time']); ?>
				<div id="time">
					<div class="header label"><?=rpts8?></div>
					<div class="header text"><?php echo $date[0]."<span> by ".$date[1]; ?></div>
				
				</div>
							<div id="message">
					<img src="img/x.gif" class="reportImage reportType1" alt="">					<table cellspacing="0" cellpadding="0" class="tbg support">
	<tbody>
	<tr>
	<td class="s7"><div class="boxes boxesColor gray trade">
	<div class="boxes-tl"></div>
	<div class="boxes-tr"></div>
	<div class="boxes-tc"></div>
	<div class="boxes-ml"></div>
	<div class="boxes-mr"></div>
	<div class="boxes-mc"></div>
	<div class="boxes-bl"></div>
	<div class="boxes-br"></div>
	<div class="boxes-bc"></div>
	<div class="boxes-contents cf">	<div class="headline"><?=rpts15?></div><a href="spieler.php?uid=<?=$dataarray[0]?>"><?=$dataarray[1]?> </a> &nbsp;<?=rpts4?> <br>
	<?php echo "<a href='karte.php?d=".$dataarray[2]."&amp;c=".$generator->getMapCheck($dataarray[2])."'>".$dataarray[3]."</a>"; ?>	</div>
</div></td><td class="f16"><img src="img/x.gif" class="bigArrow" alt=""></td><td class="s7"><div class="boxes boxesColor gray trade">
	<div class="boxes-tl"></div>
	<div class="boxes-tr"></div>
	<div class="boxes-tc"></div>
	<div class="boxes-ml"></div>
	<div class="boxes-mr"></div>
	<div class="boxes-mc"></div>
	<div class="boxes-bl"></div>
	<div class="boxes-br"></div>
	<div class="boxes-bc"></div>
	<div class="boxes-contents cf">	<div class="headline"><?=MSG12?></div><a href="spieler.php?uid=<?=$dataarray[20]?>"><?=$dataarray[21]?></a>&nbsp; <?=REPORT_FROM_VIL?><br>
	<a href="karte.php?d=<?=$dataarray[18]?>"><?=$dataarray[19]?></a>	</div>
</div></td>
	</tr>
	</tbody>
	</table>

<table cellpadding="0" cellspacing="0">
<thead><tr>
<td class="role"><?=rpts15?></td><td colspan="11"><a href="spieler.php?uid=<?=$dataarray[0]?>"><?=$dataarray[1]?></a>&nbsp; <?=rpts4?>
 <?php echo "<a href='karte.php?d=".$dataarray[2]."&amp;c=".$generator->getMapCheck($dataarray[2])."'>".$dataarray[3]."</a>"; ?></td></tr></thead>
<tbody class="units"><tr>
<td>&nbsp;</td>
<?php
$tribe = $dataarray[6];
$start = ($tribe-1)*10+1;
for($i=$start;$i<=($start+9);$i++) {
	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"\" alt=\"\" /></td>";
}
echo "<td class=\"uniticon last\"><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
echo "<tbody class=\"units last\"><tr><th>".rpts0."</th>";
for($i=7;$i<=16;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"none\">0</td>";
    }
    else {
    echo "<td>".$dataarray[$i]."</td>";
    }
}
if($dataarray[17] == 0) {
    	echo "<td class=\"none last\">0</td>";
    }
	else {
	echo "<td class=\"unit last\">".$dataarray[17]."</td>";
	}

?></tr></tbody></table>					<div class="clear"></div>
				</div>
			</div>
		</div>
		<div class="paperBottom"></div>
	</div>
</div>