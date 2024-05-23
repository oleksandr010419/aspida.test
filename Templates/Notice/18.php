<?php
$dataarray = explode(",",$all['data']);
//print_r($dataarray);
?>
<div class="paper" id="report_surround">
	<div class="layout">
		<div class="paperTop">
			<div class="paperContent">
				<div id="subject">
					<div class="header label"><?=rpts6?>:</div>
					<div class="header text"><?=$all['topic']?> </div>
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
</div></td><td class="troopHeadline" colspan="11"><p><a href="spieler.php?uid=<?=$dataarray[0]?>"><?=$dataarray[1]?></a> <?=rpts4?> <a href="karte.php?d=<?php echo $dataarray[2]."&amp;c=".$generator->getMapCheck($dataarray[2]); ?>"><?=$dataarray[3]?></a></p></td>
</tr>
</thead>
<tbody class="units">
<tr><th class="coords"></th>
<?php
$tribe = $dataarray[4];
$start = ($tribe-1)*10+1;
for($i=$start;$i<($start+9);$i++) {
	echo "<td class=\"uniticon\"><img src=\"img/x.gif\" class=\"unit u$i\" title=\"\" alt=\"\" /></td>";
}
echo "<td class=\"uniticon last\"><img src=\"img/x.gif\" class=\"unit u$i\" title=\"\" alt=\"\" /></td>";
echo "</tr><tr><th>".rpts0."</th>";
for($i=5;$i<14;$i++) {//героя не включаем(15)
	if($dataarray[$i] == 0) {
    	echo "<td class=\"unit none\">0</td>";
    }
    else {
    	echo "<td class=\"unit\">".$dataarray[$i]."</td>";
    }
}
if($dataarray[14] == 0) {
    	echo "<td class=\"unit none last\">0</td>";
    }
    else {
    	echo "<td class=\"unit last\">".$dataarray[14]."</td>";
    }
echo "<tr><tbody class=\"units last\"><th>".rpts1."</th>";
for($i=16;$i<25;$i++) { //героя не включаем(26)
	if($dataarray[$i] == 0) {
    	echo "<td class=\"unit none\">0</td>";
    }
    else {
    	echo "<td class=\"unit\">".$dataarray[$i]."</td>";
    }
}
if($dataarray[25] == 0) {
    	echo "<td class=\"unit none last\">0</td>";
    }
    else {
    	echo "<td class=\"unit last\">".$dataarray[25]."</td>";
    }

echo "</tr></tbody>";

if($dataarray[27]==1){

//spy
?>
    <tbody class="goods"><tr><th><?=rpts3?></th><td colspan="10">
        <div class="res"><div class="rArea"><img class="r1" src="img/x.gif"  /><?=$dataarray[28] ?> </div><div class="rArea"> <img class="r2" src="img/x.gif" /><?=$dataarray[29] ?> </div><div class="rArea"> <img class="r3" src="img/x.gif"  /><?=$dataarray[30] ?> </div><div class="rArea"> <img class="r4" src="img/x.gif"  /><?=$dataarray[31] ?></div></div>

    </td></tr></tbody>
<?php }elseif($dataarray[27]==2){?>
            <tbody class="goods"><tr><th><?=rpts3?></th><td colspan="10">
			<?php 

echo "<img src=\"".GP_LOCATE."img/g/g26-ltr.gif\" height=\"20\" width=\"20\" alt=\"Palace\" title=\"Palace\" /> ".$dataarray[28];
echo "<br/><img src=\"".GP_LOCATE."img/g/g23-ltr.gif\" height=\"20\" width=\"20\" alt=\"Cranny\" title=\"Cranny\" />".$dataarray[29]."<br>".$dataarray[30];

} ?>
</table>

<?php

$tribe_id = 37;
if(is_int($dataarray[$tribe_id-3]) || empty($dataarray[$tribe_id-3])){
	$tribe_id = 32;
}
$targettribe=$dataarray[$tribe_id];
//die(print_r($dataarray));
$l=$tribe_id;
$k=$m=$tribe_id+1;
for($y=0;$y<=MAX_TRIBE-1;$y++) {
    $k++;
    $l++;
    $m++;
    if ($dataarray[$l+$y*11]>0){
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
	<div class="boxes-contents cf"><div class="role"><?=rpts9?></div>	</div>
                </div></td><td class="troopHeadline" colspan="11"><p>
				<?php if($dataarray[$tribe_id]==$y+1){ 
					echo'<a href="spieler.php?uid='.$dataarray[$tribe_id-4].'">'.$dataarray[$tribe_id-3].'</a> '.rpts4.' <a href="karte.php?d='.$dataarray[$tribe_id-2].'&amp;c='.$generator->getMapCheck($dataarray[$tribe_id-2]).'">'.$dataarray[$tribe_id-1].'</a>'; 
				} 
				else { 
				echo rpts5 ; } ?></p></td>
            </tr></thead>
            <tbody class="units">
			<tr><th class="coords"></th>


                <?php
                for($i=$y*10+1;$i<=$y*10+10;$i++) {
                    echo "<td class=\"uniticon\"><img src=\"img/x.gif\" class=\"unit u$i\" title=\"\" alt=\"\" /></td>";
                }
                echo "<td class=\"uniticon last\"><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";

                echo "</tr><tr><th>".rpts0."</th>";
                for($i=$k;$i<$k+10;$i++) {
                    if($dataarray[$i] == 0) {
                        echo "<td class=\"none\">0</td>";
                    }
                    else {
                        echo "<td>".$dataarray[$i]."</td>";
                    }
                }
				if($dataarray[$i++] == 0) {
    	echo "<td class=\"unit none last\">0</td>";
    }
    else {
    	echo "<td class=\"unit last\">".$dataarray[$i--]."</td>";
    }
				
                echo "<tr><tbody class=\"units last\"><th>".rpts1."</th>";
                for($i=0;$i<10;$i++) {
                        echo "<td class=\"unit none\">0</td>";

                }
				echo "<td class=\"unit none last\">0</td>";
                ?>
            </tr></tbody></table>
    <?php } $m+=11; $k=$m; }  ?>
                    	</div>
			</div>
		</div>
		<div class="paperBottom"></div>
	</div>
</div>