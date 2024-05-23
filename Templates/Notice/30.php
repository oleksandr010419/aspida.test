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
                <div class="header text"><?php echo $date[0]."<span> ".REPORT_AT." by ".$date[1]; ?></div>


                <div class="clear"></div>
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
	<div class="boxes-contents cf"><div class="role"><?php echo REPORT_ATTACKER; ?></div>
                            </div>
                        </div>			</td>
                    <td colspan="11" class="troopHeadline">
                        <p>
                            <a href="spieler.php?uid=<?php echo $session->uid; ?>"><?php echo $session->username; ?></a> <?php echo REPORT_FROM_VIL; ?> <a href="karte.php?d=<?php echo $dataarray[0]."&amp;c=".$generator->getMapCheck($dataarray[0]); ?>"><?php echo $database->getVillageField($dataarray[0],"name"); ?></a>
                        </p>
                    </td>
                </tr>
                </thead>


                <tbody class="units ">
                <tr>
                    <td>&nbsp;</td>


                    <?php
                    $class="";
                    for($i=31;$i<=40;$i++) {
                        if($i==40){$class=' last';}
                        echo "<td class='$class'><img src=\"img/x.gif\" class=\"unit u$i\" title=\"\" alt=\"\" /></td>";
                    }
?></tbody>
                <tbody class="units last">
                <?php
                    echo "</tr><tr><th>".rpts0."</th>";
                    $class="";
                    for($i=1;$i<=10;$i++) {
                        if($i==10){$class='last';}
                        if($dataarray[$i] == 0) {
                            echo "<td class=\"none  $class\">0</td>";
                        }
                        else {
                            echo "<td class=".$class.">".$dataarray[$i]."</td>";
                        }
                    }



                    ?>
                </tr></tbody>



            </table>
        </td></tr></tbody></table>	</div>
			</div>
		</div>
		<div class="paperBottom"></div>
	</div>
</div>