
<div class="paper" id="report_surround">
	<div class="layout">
		<div class="paperTop">
			<div class="paperContent">
				<div id="subject">
					<div class="header label"><?=rpts6?>:</div>
					<div class="header text"><?=rpts7?> <?php echo $database->getVillageField($dataarray[1],"name"); ?>  </div>
	<div class="clear"></div>

				<div id="time">
					<?php
                 $date = $generator->procMtime($all['time']);?>
        <div class="header label"><?php echo REPORT_SENT; ?></div>
        <div class="header text"><?= $date[0]." ".$date[1]; ?></div>
             </div>
			 	<div id="message">
					<img src="img/x.gif" class="reportImage reportType2" alt="">					<table cellspacing="0" cellpadding="0" class="tbg support">
	<tbody>
	<tr>
	<td class="s7"><div class="boxes boxesColor gray">
	<div class="boxes-tl"></div>
	<div class="boxes-tr"></div>
	<div class="boxes-tc"></div>
	<div class="boxes-ml"></div>
	<div class="boxes-mr"></div>
	<div class="boxes-mc"></div>
	<div class="boxes-bl"></div>
	<div class="boxes-br"></div>
	<div class="boxes-bc"></div>
	<div class="boxes-contents cf">	<div class="headline"><?=rpts15?></div><a href="spieler.php?uid=<?php echo $database->getUserField($dataarray[0],"id",0); ?>"><?php echo $database->getUserField($dataarray[0],"username",0); ?>
	 </a> <?=rpts4?> <br>

 <a href="karte.php?d=<?php echo $dataarray[1]."&amp;c=".$generator->getMapCheck($dataarray[1]); ?>"><?php echo $database->getVillageField($dataarray[1],"name"); ?></a></div>
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
	<div class="boxes-contents cf">	<div class="headline"><?=MSG12?></div><a href="spieler.php?uid=<?=$dataarray[8]?>"><?=$dataarray[9]?></a> <?=REPORT_FROM_VIL?><br>
	<a href="karte.php?d=<?=$dataarray[6]?>"><?=$dataarray[7]?></a>	</div>
</div></td>
	</tr>
	</tbody>
	</table>

		<table cellpadding="0" cellspacing="0" id="trade">
	<thead>
		<tr>
			<td colspan="2" class="troopHeadline">

<a href="spieler.php?uid=<?php echo $database->getUserField($dataarray[0],"id",0); ?>"><?php echo $database->getUserField($dataarray[0],"username",0); ?></a> <?=rpts4?> <a href="karte.php?d=<?php echo $dataarray[1]."&amp;c=".$generator->getMapCheck($dataarray[1]); ?>"><?php echo $database->getVillageField($dataarray[1],"name"); ?></a></td>
</tr></thead>

<tbody>
		<tr>
			<td class="empty" colspan="2"></td>
		</tr>
		<tr>
			<th>
				Сырье			</th>
			<td>
									<div class="rArea">
	<img class="r1" src="img/x.gif" alt="Wood" title="Wood" /><?php echo $dataarray[2]; ?>
	</div>
	<div class="rArea">
	<img class="r2" src="img/x.gif" alt="Clay" title="Clay" /><?php echo $dataarray[3]; ?>
		</div>
	<div class="rArea">
	<img class="r3" src="img/x.gif" alt="Iron" title="Iron" /><?php echo $dataarray[4]; ?>
		</div>
	<div class="rArea">
	<img class="r4" src="img/x.gif" alt="Crop" title="Crop" /><?php echo $dataarray[5]; ?>
		</div>

	</td>
		</tr>
		<tr>
			<td class="empty" colspan="2"></td>
		</tr>
		<tr>


		</tr>
	</tbody>
</table>					<div class="clear"></div>
				</div>
			</div>
		</div>
		<div class="paperBottom"></div>
	</div>
</div>
</div>
