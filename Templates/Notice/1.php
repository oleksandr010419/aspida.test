<?php
$dataarray = explode(",", $all['data']);
?>
<div class="paper" id="report_surround">
    <div class="layout">
        <div class="paperTop">
            <div class="paperContent">
                <div id="subject">
                    <div class="header label"><?php echo REPORT_SUBJECT; ?></div>
                    <div class="header text"><?= $all['topic'] ?></div>
                    <div class="clear"></div>
                </div>
                <div id="time">
                    <?php $date = $generator->procMtime($all['time']); ?>
                    <div class="header label"><?php echo REPORT_SENT; ?></div>
                    <div class="header text"><?= $date[0] . " " . $date[1]; ?></div>
                </div>

                <div id="message">
                    <img src="img/x.gif" class="reportImage reportType4" alt="">					<table id="attacker" cellpadding="0" cellspacing="0">
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
                                        <div class="boxes-contents">
                                            <div class="role">
<?php echo REPORT_ATTACKER; ?></div></div></div>
                                </td>
                                <td class="troopHeadline" colspan="11"><p>
                                        <a href="spieler.php?uid=<?= $dataarray[0] ?>"><?= $dataarray[1] ?></a> <?= REPORT_FROM_VIL ?> <a href="karte.php?d=<?= $dataarray[2] . "&amp;c=" . $generator->getMapCheck($dataarray[2]); ?>"><?= $dataarray[3] ?></a></p>

                                </td>

                            </tr></thead>
                        <tbody class="units">
                            <tr><th class="coords"></th>
<?php
$start = ($dataarray[4] - 1) * 10 + 1;
$tdclass = "";
for ($i = $start; $i <= ($start + 9); $i++) {
    echo "<td class=\"uniticon\"><img src=\"img/x.gif\" class=\"unit u$i\" title=\"\" alt=\"\" /></td>";
}
echo "<td class=\"uniticon last\"><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";


echo "</tr><tr><th>" . PY8 . "</th>";
for ($i = 5; $i <= 14; $i++) {
    if ($dataarray[$i] == 0) {
        echo "<td class=\"unit none\">0</td>";
    } else {
        echo "<td class=\"unit\">" . $dataarray[$i] . "</td>";
    }
}
if (!$dataarray[15]) {
    echo "<td class=\"unit none last\">" . $dataarray[15] . "</td>";
} else {
    echo "<td class=\"unit last\">" . $dataarray[15] . "</td>";
}
echo "</tbody>";
echo "<tbody class=\"units last\">";
echo "<tr><th>" . rpts1 . "</th>";
for ($i = 16; $i <= 25; $i++) {
    if ($dataarray[$i] == 0) {
        echo "<td class=\"unit none\">0</td>";
    } else {
        echo "<td class=\"unit\">" . $dataarray[$i] . "</td>";
    }
}

if (!$dataarray[26]) {
    echo "<td class=\"unit none last\">" . $dataarray[26] . "</td>";
} else {
    echo "<td class=\"unit last\">" . $dataarray[26] . "</td>";
}

echo "</tr>";
if ($all['data1'] != '') {
    $datar = explode(',', $all['data1']);
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
	
    for ($i = 0; $i <= 9; $i++) {
        if ($datar[$i] == 0) {
            echo "<td class=\"none\">0</td>";
        } else {
            echo "<td>" . $datar[$i] . "</td>";
        }
    }

    echo "<td class=\"unit last\">" . $datar[10] . "</td>";
}
echo "</tbody>";
if ($dataarray[32]) { //ram
    ?>
                            <tbody class="goods"><tr><th><?= rpts3 ?></th><td colspan="11">
                                        <img class="unit u<?= ($dataarray[4] - 1) * 10 + 7; ?>" src="img/x.gif" alt="Ram" title="Ram" />
                                    <?= $dataarray[32]; ?>
                                    </td></tr></tbody>
                                <?php }
                                if ($all['data1'] != '' && $datar[11] != '') {
                                    ?>
                            <tbody class="goods"><tr><th><?= rpts3 ?></th><td colspan="11">
                                        <?php
                                        echo "<img src=\"" . GP_LOCATE . "img/u/98.gif\"   alt=\"Trap\" title=\"Trap\" /> " . $datar[11];
                                    }

                                    if ($dataarray[33]) { //cata
                                        ?>
                            <tbody class="goods"><tr><th><?= rpts3 ?></th><td colspan="11">
                                        <img class="unit u<?= ($dataarray[4] - 1) * 10 + 8; ?>" src="img/x.gif" alt="Catapult" title="Catapult" />
                                        <?= $dataarray[33]; ?>
                                    </td></tr></tbody>
                                    <?php
                                    }
                                    if ($dataarray[34]) { //cata
                                        ?>
                            <tbody class="goods"><tr><th><?= rpts3 ?></th><td colspan="11">
                                        <img class="unit u<?= ($dataarray[4] - 1) * 10 + 8; ?>" src="img/x.gif" alt="Catapult" title="Catapult" />
                            <?= $dataarray[34]; ?>
                                    </td></tr></tbody>
<?php
}
if ($dataarray[35]) { //chief
    ?>
                            <tbody class="goods"><tr><th><?= rpts3 ?></th><td colspan="11">
                                        <img class="unit u<?= ($dataarray[4] - 1) * 10 + 9; ?>" src="img/x.gif" alt="Chief" title="Chief"  />
                            <?= $dataarray[35]; ?>
                                    </td></tr></tbody>
                                    <?php
                                    }

                                    if ($dataarray[36]) { //hero
                                        ?>
                            <tbody class="goods"><tr><th><?= rpts3 ?></th><td colspan="11">
                                        <img class="unit uhero" src="img/x.gif" />
    <?= $dataarray[36]; ?>
                                    </td></tr></tbody>
                                    <?php } ?>
                        <tbody><tr><td class="empty" colspan="12"></td></tr></tbody>
                        <tbody class="goods">
                            <tr><th><?php echo REPORT_BOUNTY; ?></th>
                                <td colspan="11">
                                    <div class="res">
                                        <div class="rArea">
                                            <img class="r1" src="img/x.gif" title="<?php echo LUMBER; ?>"><?php echo $dataarray[27]; ?></div>
                                        <div class="rArea">
                                            <img class="r2" src="img/x.gif" title="<?php echo CLAY; ?>"><?php echo $dataarray[28]; ?></div>
                                        <div class="rArea">
                                            <img class="r3" src="img/x.gif" title="<?php echo IRON; ?>"><?php echo $dataarray[29]; ?></div>
                                        <div class="rArea">
                                            <img class="r4" src="img/x.gif" title="<?php echo CROP; ?>"><?php echo $dataarray[30]; ?></div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="carry">
<?php
if ($dataarray[29] + $dataarray[30] + $dataarray[27] + $dataarray[28] == 0) {
    echo"<img title=\"";
    echo ($dataarray[29] + $dataarray[30] + $dataarray[27] + $dataarray[28]) . "/" . $dataarray[31];
    echo"\" src=\"img/x.gif\" class=\"carry empty\">";
} elseif ($dataarray[29] + $dataarray[30] + $dataarray[27] + $dataarray[28] != $dataarray[31]) {
    echo "<img title=\"";
    echo ($dataarray[29] + $dataarray[30] + $dataarray[27] + $dataarray[28]) . "/" . $dataarray[31];
    echo"\" src=\"img/x.gif\" class=\"carry half\">";
} else {
    echo"<img title=\"";
    echo ($dataarray[29] + $dataarray[30] + $dataarray[27] + $dataarray[28]) . "/" . $dataarray[31];
    echo"\" src=\"img/x.gif\" class=\"carry full\">";
}
?>
                                        <?php echo ($dataarray[29] + $dataarray[30] + $dataarray[27] + $dataarray[28]) . "/" . $dataarray[31]; ?>
                                    </div>
                                </td>
                            </tr>
                        </tbody></table>

<?php
$targettribe = $dataarray['41'];
$l = 41;
$k = $m = 42;
for ($y = 0; $y <= MAX_TRIBE - 1; $y++) {
    $k++;
    $m++;
    $l++;
	
    if ($dataarray[$l + $y * 22] > 0 || $dataarray[41] == $y + 1) {

        $start = 1;
        ?>
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
                                                <div class="boxes-contents cf">
                                                    <div class="role"><?php echo REPORT_DEFENDER; ?></div></div></div>
                                        </td>
                                        <td class="troopHeadline" colspan="11"><p>
                                                <?php if ($dataarray[41] == $y + 1) {
                                                    echo'<a href="spieler.php?uid=' . $dataarray[37] . '">' . $dataarray[38] . '</a> ' . REPORT_FROM_VIL . ' <a href="karte.php?d=' . $dataarray[39] . '&amp;c=' . $generator->getMapCheck($dataarray[39]) . '">' . $dataarray[40] . '</a></p>';
                                                } else {
                                                    echo OTPRAV2;
                                                } ?>
                                        </td>
                                    </tr></thead>
                                <tbody class="units">
                                    <tr><th class="coords"></th>


                                        <?php
										$tribe = $y * 10 + 1;
                                        for ($i = $y * 10 + 1; $i <= $y * 10 + 10; $i++) {
                                            echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"\" alt=\"\" /></td>";
                                        }
										if ($y <= 3 || $y >= 5) {
											echo "<td class=\"uniticon last\"><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
										}
                                        echo "</tr><tr><th>" . rpts0 . "</th>";
                                        for ($i = $k; $i <= $k + 9; $i++) {
                                            if ($dataarray[$i] == 0) {
                                                echo "<td class=\"unit none\">0</td>";
                                            } else {
                                                echo "<td class=\"unit\">" . $dataarray[$i] . "</td>";
                                            }
                                        }
                                        if ($y <= 3 || $y >= 5) {
                                            if ($dataarray[$k + 10] != 0) {
                                                echo "<td class=\"unit last\">" . $dataarray[$k + 10] . "</td></tr></tbody>";
                                            } else {
                                                echo "<td class=\"unit none last\">0</td></tr></tbody>";
                                            }
                                        }
                                        $k+=11;

                                        echo "<tbody class=\"units last\"><tr><th>" . rpts1 . "</th>";

                                        for ($i = $k; $i <= $k + 9; $i++) {
                                            if ($dataarray[$i] == 0) {
                                                echo "<td class=\"unit none\">0</td>";
                                            } else {
                                                echo "<td class=\"unit\">" . $dataarray[$i] . "</td>";
                                            }
                                        }
                                        if ($y <= 3 || $y >= 5) {
                                            if ($dataarray[$k + 10] != 0) {
                                                echo "<td class=\"unit last\">" . $dataarray[$k + 10] . "</td></tr></tbody>";
                                            } else {
                                                echo "<td class=\"unit none last\">0</td></tr></tbody>";
                                            }
                                        }
                                        $k+=11;
                                        ?>
    <?php } $m+=22;
    $k = $m;
} ?>
                            </tr></tbody></table>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="paperBottom"></div>
    </div>
</div>