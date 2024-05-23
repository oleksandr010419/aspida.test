<?php
$dataarray = explode(",",$all['data']);
$outputList='';
?>
<div class="paper" id="report_surround">
	<div class="layout">
		<div class="paperTop">
			<div class="paperContent">
				<div id="subject">
								<div class="header label"><?php echo REPORT_SUBJECT; ?></div>
								<div class="header text"><?=$all['topic']?></div>
								<div class="clear"></div>
							</div>

							<div id="time">
                            <?php $date = $generator->procMtime($all['time']); ?>
								<div class="header label"><?php echo REPORT_SENT; ?></div>
								<div class="header text"><?php echo $date[0]."<span> ".REPORT_AT." ".$date[1]; ?></span></div>
                                
                                <div class="toolList">
<?php if($session->plus){ ?>
    <form method="post" action="berichte.php">
        <input name="n1" value="<?php echo $_GET['id']; ?>"  type="hidden">

        <button name="del_x" type="submit" value="reportButton delete" class="icon" title="<?php echo REPORT_DEL_BTN; ?>" >
                        <img src="img/x.gif" class="reportButton delete" alt="reportButton delete" /></button>
    </form>
<?php } ?>
					<div class="clear"></div></div>
                                
                                <div class="clear"></div>
							</div>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>

<div id="message">
										<img src="img/x.gif" class="adventureReportImage adventureForestVictory " alt="Adventure 2"><table cellspacing="0" cellpadding="0" id="attacker">
	<thead>
		<tr>
			<td class="role">
				<div class="boxes boxesColor red">
	<div class="boxes-tl"></div>
	<div class="boxes-tr"></div>
	<div class="boxes-tc"></div>
	<div class="boxes-ml"></div>
	<div class="boxes-mr"></div>
	<div class="boxes-mc"></div>
	<div class="boxes-bl"></div>
	<div class="boxes-br"></div>
	<div class="boxes-bc"></div>
	<div class="boxes-contents cf">					<div class="role"><?php echo REPORT_ATTACKER; ?></div>
					</div>
				</div>			</td>
			<td colspan="11" class="troopHeadline">
				<p>
					<a href="spieler.php?uid=<?php echo $session->uid; ?>"><?php echo $session->username; ?></a> <?php echo REPORT_FROM_VIL; ?> <a href="karte.php?d=<?php echo $dataarray[0]."&amp;c=".$generator->getMapCheck($dataarray[0]); ?>"><?php echo $database->getVillageField($dataarray[0],"name"); ?></a>
				</p>
			</td>
		</tr>
	</thead>

	<tbody class="units">
		<tr>
			<th class="coords"></th>
<?php
$owntribe = $session->tribe;
$start = ($owntribe-1)*10+1;
$end = ($owntribe*10);
for($i=$start;$i<=$end;$i++) {
	echo '<td class="unit"><img src="img/x.gif" class="unit u'.$i.'" title=""></td>';
}
?>
						<td class="unit last">
				<img title="Hero" class="unit uhero" src="img/x.gif">
			</td>
		</tr>
	</tbody>
	<tbody class="units last">
		<tr>
			<th><?=REPORT_TROOPS?></th>
	<?php
	for($i=1;$i<=10;$i++){
echo"<td class=\"unit none\">0</td>";}?>
	<td class="unit  last">1</td>
</tr>
	</tbody>

	<tbody class="infos">
		<tr><td class="empty" colspan="12"></td></tr>
		<tr>
			<th><?=REPORT_INFORMATION?></th>
			<td class="dropItems" colspan="11">
            <?php if($dataarray[1]!='dead'){ ?>
				<img src="img/x.gif" class="iExperience" alt="Experience:">
				+<?php echo $dataarray[5]; ?>
				<img src="img/x.gif" class="injury" alt="Injury:">
				-<?php echo round($dataarray[4]); ?>%
            <?php }else{
            		echo '<img src="img/x.gif" class="adventureDifficulty0" title="'.punktxuev8.'">'.$dataarray[2];
                  }
            ?>
            	
			</td>
		</tr>
			</tbody>
<?php if($dataarray[1]!='dead'){ ?>
	<tbody class="goods">
		<tr><td class="empty" colspan="12"></td></tr>
		<tr>
			<th><?=REPORT_BOUNTY?></th>
			<td colspan="11">
            <?php
           	if($dataarray[1]){
            	$typeArray = array("","helmet","body","leftHand","rightHand","shoes","horse","bandage25","bandage33","cage","scroll","ointment","bucketOfWater","bookOfWisdom","lawTables","artWork");
                $btype = $dataarray[1];
                $type = $dataarray[2];
				if($btype < 16){
				include "GameEngine/Data/alt.php";
				$typeArray = array("","helmet","body","leftHand","rightHand","shoes","horse","bandage25","bandage33","cage","scroll","ointment","bucketOfWater","bookOfWisdom","lawTables","artWork");
            	include "GameEngine/Data/alt.php";
				echo '<img src="img/x.gif" class="reportInfo itemCategory itemCategory_'.$typeArray[$btype].'" title="'.$title.'">';
				echo ' '.$name.' ('.$dataarray[3].'x)';
				}else if($btype == 16){
				echo '<img src="img/x.gif" class="unit u'.(($session->tribe-1)*10+$type).'" title="">';
				echo ' ('.$dataarray[3].'x)';
							$outputList .= "<div class=\"reportInfoIcon\"><img title=\"(".$dataarray[3]."x)\" src=\"img/x.gif\" class=\"unit u".(($session->tribe-1)*10+$type)."\"\"></div>";
				}else{
				echo '<img src="img/x.gif" class="silver" title="silver">';
				echo ' Silver ('.$dataarray[3].'x)';
				}
            }else{		
            	echo $dataarray[2];
				//TODO: УБРАТЬ ЭТУ ХУЙНЮ!!!!
            }
            ?>
			</td>
		</tr>
	</tbody>
<?php } ?>
</table>					<div class="clear"></div>
				</div>
			</div>
		</div>
		<div class="paperBottom"></div>
	</div>
</div>