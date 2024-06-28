<div class="boxes villageInfobox units">
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
        <table id="troops" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <th colspan="3">
                    <?php echo TROOPS_DORF; ?>
                </th>
            </tr>
            </thead>
            <tbody>
<?php
$troops = $village->unitsInVillage();
$TroopsPresent = False;
for($i=1;$i<=80;$i++) {
if(isset($troops['u'.$i])){
	if($troops['u'.$i] > 0) {
        $troop_num = number_format($troops['u'.$i],0,'.','.');
        echo "<tr><td class=\"ico\"><a href=\"build.php?id=39\"><img class=\"unit u".$i."\" src=\"img/x.gif\" alt=\"\" title=\"\" /></a></td>";
		echo "<td class=\"num\">".$troop_num."</td><td class=\"un\">".constant('U'.$i)."</td></tr>";
		$TroopsPresent = True;
	}
}
}

if($troops['hero'] > 0) {
		echo "<tr><td class=\"ico\"><a href=\"build.php?id=39\"><img class=\"unit uhero\" src=\"img/x.gif\" alt=\"Hero\" title=\"Hero\" /></a></td>";
		echo "<td class=\"num\">".$troops['hero']."</td><td class=\"un\">".U0."</td></tr>";
		$TroopsPresent = True;
}

if(!$TroopsPresent) {
    echo "<tr><td>None</td></tr>";
}
?>
            </tbody>
        </table>
    </div>
</div>

