<div class="boxes boxesColor gray traderCount">
    <div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div>
    <div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div>
    <div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div>
    <div class="boxes-contents"><?php echo MERCHANTS.' '.$market->merchantAvail().' / '.$market->merchant; ?></div>
</div>
<div class="clear"></div>
<form method="POST" action="build.php">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="ft" value="mk2" />

<table id="sell" cellpadding="1" cellspacing="1">
<tr>
	<th><?=rinok27?></th>
	<td class="val"><input class="text" tabindex="1" name="m1" value="" maxlength="6" /></td>
	<td class="res">
		<select name="rid1" tabindex="2" class="dropdown">
			<option value="1" selected="selected"><?=TVRN12?></option>
			<option value="2"><?=TVRN13?></option>
			<option value="3"><?=TVRN14?></option>
			<option value="4"><?=TVRN15?></option>
		</select>
	</td>
	<td class="tra"><input class="check" type="checkbox" tabindex="5" name="d1" value="1" /> <?=rinok29?> <input class="text" tabindex="6" name="d2" value="2" maxlength="2" /> <?=rinok30?></td>
</tr>
<tr>
	<th><?=rinok28?></th>
	<td class="val"><input class="text" tabindex="3" name="m2" value="" maxlength="6" /></td>
	<td class="res">
		<select name="rid2" tabindex="4" class="dropdown">
			<option value="1"><?=TVRN12?></option>
			<option value="2" selected="selected"><?=TVRN13?></option>
            <option value="3"><?=TVRN14?></option>
            <option value="4"><?=TVRN15?></option>
		</select>
	</td>
	<td class="al">
    <?php
    if($session->alliance != 0) {
    echo "<input class=\"check\" type=\"checkbox\" tabindex=\"7\" name=\"ally\" value=\"1\" /> ".rinok31>"";
    }
    ?>
    </td>
</tr>
</table>
    <button type="submit" value="ok" name="s1" id="btn_train" value="ok" class="green">
        <div class="button-container addHoverClick">
            <div class="button-background">
                <div class="buttonStart">
                    <div class="buttonEnd">
                        <div class="buttonMiddle"></div>
                    </div>
                </div>
            </div>
            <div class="button-content"><?=rinok32?></div>
        </div>
    </button>
</form>
<?php
if(count($market->onmarket) > 0) {
	echo "<table id=\"sell_overview\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"7\">".rinok33."</th></tr>
	<tr>
	<td>&nbsp;</td>
	<td>".rinok34."</td>
	<td><img src=\"img/x.gif\" class=\"ratio\" alt=\"ratio\"></td>
	<td>".rinok35."</td>
	<td>".MERCHANTS."</td>
	<td>".rinok36."</td>
	<td>".rinok7."</td></tr></thead><tbody>";
	foreach($market->onmarket as $offer) {

        echo "<tr><td class=\"abo\"><a href=\"build.php?id=$id&t=2&a=".$session->mchecker."&del=".$offer['id']."\"><img class=\"del\"src=\"img/x.gif\" alt=\"Delete\" title=\"Delete\" /></a></td>";
		echo "<td class=\"val\">";

        switch($offer['gtype']) {
        case 1: echo "<img src=\"img/x.gif\" class=\"r1\" alt=\"Wood\" title=\"".LUMBER."\" />"; break;
        case 2: echo "<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"".CLAY."\" />"; break;
        case 3: echo "<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"".IRON."\" />"; break;
        case 4: echo "<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"".CROP."\" />"; break;
        }
        echo $offer['gamt'];
        echo "</td>";
		if($offer['ratio'] == null){
			$gcd = gcd($offer['gamt'],$offer['wamt']);
			$ratio = round(($offer['wamt']/$gcd)/($offer['gamt']/$gcd),1);
		}else{
			$ratio = $offer['ratio'];
		}
		//if($ratio!=0)die(print_r($ratio));
		
		echo "<td class=\"ratio\">
			<div class=\"boxes boxesColor ".($ratio>1?(($ratio>1.6)?"red":"orange"):"green")."\">
				<div class=\"boxes-tl\"></div>
				<div class=\"boxes-tr\"></div>
				<div class=\"boxes-tc\"></div>
				<div class=\"boxes-ml\"></div>
				<div class=\"boxes-mr\"></div>
				<div class=\"boxes-mc\"></div>
				<div class=\"boxes-bl\"></div>
				<div class=\"boxes-br\"></div>
				<div class=\"boxes-bc\"></div>
				<div class=\"boxes-contents cf\">".$ratio."</div>
			</div>				
		</td>";
		
		
		echo "<td class=\"val\">";
        switch($offer['wtype']) {
        case 1: echo "<img src=\"img/x.gif\" class=\"r1\" alt=\"Wood\" title=\"".LUMBER."\" />"; break;
        case 2: echo "<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"".CLAY."\" />"; break;
        case 3: echo "<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"".IRON."\" />"; break;
        case 4: echo "<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"".CROP."\" />"; break;
        }
        echo $offer['wamt'];
        echo "</td><td class=\"tra\">1</td><td class=\"al\">";
        echo ($offer['alliance'] == 0)? ACC17 : ACC18 ;
        echo "</td><td class=\"dur\">";
        if($offer['maxtime'] != 0) {
        echo $offer['maxtime']/3600;
        echo rinok37;
        }
        else {
        echo rinok38;
        }
        echo "</td></tr>";
    }
    echo "</table>";
}

?>
