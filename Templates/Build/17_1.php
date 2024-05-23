<?php
if(isset($_GET['u'])) {
$u = $_GET['u'];
}
else {
$u=0;
}
if($session->plus) {
?>
    <div class="boxes boxesColor gray traderCount"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents"> <?php echo MERCHANTS.' '.$market->merchantAvail().' / '.$market->merchant; ?>  </div>
    </div><div class="clear"></div>
    <div class="boxes boxesColor gray search_select"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents"><table id="search_select" class="buy_select transparent" cellpadding="1" cellspacing="1">
                <thead>
                <tr>
                    <td colspan="4"><?php echo IMSEARCHING;?></td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <button type="button" value="r1Big" <?php if(isset($_GET['s']) && $_GET['s'] == 1) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = 'build.php?id=<?php echo $id; ?>&t=1&s=1<?php if(isset($_GET['v'])) echo "&v=".$_GET['v']; if(isset($_GET['b'])) echo "&b=".$_GET['b']; ?>'; return false;"><img src="img/x.gif" class="r1Big" alt="r1Big"></button>
                    </td>
                    <td>
                        <button type="button" value="r2Big" <?php if(isset($_GET['s']) && $_GET['s'] == 2) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = 'build.php?id=<?php echo $id; ?>&t=1&s=2<?php if(isset($_GET['v'])) echo "&v=".$_GET['v']; if(isset($_GET['b'])) echo "&b=".$_GET['b']; ?>'; return false;"><img src="img/x.gif" class="r2Big" alt="r2Big"></button>
                    </td>
                    <td>
                        <button type="button" value="r3Big" <?php if(isset($_GET['s']) && $_GET['s'] == 3) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = 'build.php?id=<?php echo $id; ?>&t=1&s=3<?php if(isset($_GET['v'])) echo "&v=".$_GET['v']; if(isset($_GET['b'])) echo "&b=".$_GET['b']; ?>'; return false;"><img src="img/x.gif" class="r3Big" alt="r3Big"></button>
                    </td>
                    <td>
                        <button type="button" value="r4Big" <?php if(isset($_GET['s']) && $_GET['s'] == 4) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = 'build.php?id=<?php echo $id; ?>&t=1&s=4<?php if(isset($_GET['v'])) echo "&v=".$_GET['v']; if(isset($_GET['b'])) echo "&b=".$_GET['b']; ?>'; return false;"><img src="img/x.gif" class="r4Big" alt="r4Big"></button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="boxes boxesColor gray ratio_select"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents">
            <table id="ratio_select" class="buy_select transparent" cellpadding="1" cellspacing="1">
                <tbody>
                <tr>
                    <td>
                        <button type="button" value="marketPercentage marketPercentage1_1" <?php if(isset($_GET['v'])) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = 'build.php?id=<?php echo $id; ?>&t=1&v=1:1<?php if(isset($_GET['s'])) echo "&s=".$_GET['s']; if(isset($_GET['b'])) echo "&b=".$_GET['b']; ?>'; return false;">
                            <img src="img/x.gif" class="marketPercentage marketPercentage1_1" alt="marketPercentage marketPercentage1_1"></button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button type="button" value="marketPercentage marketPercentage1_x" <?php if(!isset($_GET['v'])) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = 'build.php?id=<?php echo $id; ?>&t=1<?php if(isset($_GET['s'])) echo "&s=".$_GET['s']; if(isset($_GET['b'])) echo "&b=".$_GET['b']; ?>'; return false;">
                            <img src="img/x.gif" class="marketPercentage marketPercentage1_x" alt="marketPercentage marketPercentage1_x"></button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div></div>
    <div class="boxes boxesColor gray bid_select"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents">
            <table id="bid_select" class="buy_select transparent" cellpadding="1" cellspacing="1">
                <thead><tr>
                    <td colspan="4"><?php echo IMOFFERING;?></td>
                </tr></thead>
                <tbody>
                <tr>
                    <td>
                        <button type="button" value="r1Big" <?php if(isset($_GET['b']) && $_GET['b'] == 1) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = 'build.php?id=<?php echo $id; ?>&t=1&b=1<?php if(isset($_GET['v'])) echo "&v=".$_GET['v']; if(isset($_GET['s'])) echo "&s=".$_GET['s']; ?>'; return false;">
                            <img src="img/x.gif" class="r1Big" alt="r1Big"></button>
                    </td>
                    <td>
                        <button type="button" value="r2Big" <?php if(isset($_GET['b']) && $_GET['b'] == 2) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = 'build.php?id=<?php echo $id; ?>&t=1&b=2<?php if(isset($_GET['v'])) echo "&v=".$_GET['v']; if(isset($_GET['s'])) echo "&s=".$_GET['s']; ?>'; return false;">
                            <img src="img/x.gif" class="r2Big" alt="r2Big"></button>
                    </td>
                    <td>
                        <button type="button" value="r3Big" <?php if(isset($_GET['b']) && $_GET['b'] == 3) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = 'build.php?id=<?php echo $id; ?>&t=1&b=3<?php if(isset($_GET['v'])) echo "&v=".$_GET['v']; if(isset($_GET['s'])) echo "&s=".$_GET['s']; ?>'; return false;">
                            <img src="img/x.gif" class="r3Big" alt="r3Big"></button>
                    </td>
                    <td>
                        <button type="button" value="r4Big" <?php if(isset($_GET['b']) && $_GET['b'] == 4) { echo "class=\"iconFilter iconFilterActive\""; } else { echo "class=\"iconFilter\""; } ?> onclick="window.location.href = 'build.php?id=<?php echo $id; ?>&t=1&b=4<?php if(isset($_GET['v'])) echo "&v=".$_GET['v']; if(isset($_GET['s'])) echo "&s=".$_GET['s']; ?>'; return false;">
                            <img src="img/x.gif" class="r4Big" alt="r4Big"></button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div></div>
<?php
}
?>
<div class="clear"></div>
<h4 class="spacer"><?php echo OFFEREDONTHEMARKET;?></h4>
<table id="range" cellpadding="1" cellspacing="1">
<thead><tr>
	<th colspan="6"><a name="h2"></a><center><?=rinok1?></th>
</tr>
<tr>
	<td><center><?=rinok2?></center><br><center><?=rinok3?></center></td>
	<td><img src="img/x.gif" class="ratio" alt="ratio"></td>
	<td><center><?=rinok4?></center><br><center><?=rinok5?></center></td>
	<td><center><?=rinok6?></center></td>
	<td><center><?=rinok7?></center></td>
	<td><center><?=rinok8?></center></td>
</tr></thead>
<tbody>
<?php
if(count($market->onsale) > 0) {
for($i=0+$u;$i<=40+$u;$i++) {
if(isset($market->onsale[$i])) {
echo "<tr><td class=\"val\">";
$reqMerc = 1;
if($market->onsale[$i]['wamt'] > $market->maxcarry) {
			$reqMerc = round($market->onsale[$i]['wamt']/$market->maxcarry);
			if($market->onsale[$i]['wamt'] > $market->maxcarry*$reqMerc) {
				$reqMerc += 1;
			}
		}
switch($market->onsale[$i]['gtype']) {
    case 1: echo "<center><img src=\"img/x.gif\" class=\"r1\" alt=\"Wood\" title=\"".LUMBER."\" />&nbsp;"; break;
    case 2: echo "<center><img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"".CLAY."\" />&nbsp;"; break;
    case 3: echo "<center><img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"".IRON."\" />&nbsp;"; break;
    case 4: echo "<center><img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"".CORP."\" />&nbsp;"; break;
 	}
    echo $market->onsale[$i]['gamt'];
    echo "</td>";
	//count ratio:
	if($market->onsale[$i]['ratio'] == null){
		$gcd = gcd($market->onsale[$i]['gamt'],$market->onsale[$i]['wamt']);
		$ratio = round(($market->onsale[$i]['wamt']/$gcd)/($market->onsale[$i]['gamt']/$gcd),1);
	}else{
		$ratio = $market->onsale[$i]['ratio'];
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
    switch($market->onsale[$i]['wtype']) {
    case 1: echo "<center><img src=\"img/x.gif\" class=\"r1\" alt=\"Wood\" title=\"".LUMBER."\" />&nbsp;"; break;
    case 2: echo "<center><img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"".CLAY."\" />&nbsp;"; break;
    case 3: echo "<center><img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"".IRON."\" />&nbsp;"; break;
    case 4: echo "<center><img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"".CROP."\" />&nbsp;"; break;
    }
    echo $market->onsale[$i]['wamt'];
    echo "</td><td class=\"pla\" title=\"".$database->getVillageField($market->onsale[$i]['vref'],"name")."\">";
	
	$tribe = $database->getUserField($market->onsale[$i]['id'],'tribe');
    echo "<img src=\"img/x.gif\" class=\"nation nation".$tribe."\" alt=\"".${"TRIBE".$tribe}."\"><a href=\"karte.php?d=".$market->onsale[$i]['vref']."&c=".$generator->getMapCheck($market->onsale[$i]['vref'])."\"><center>".$database->getUserField($database->getVillageField($market->onsale[$i]['vref'],"owner"),"username",0)."</a></td>";
    echo "<td class=\"dur\">".$generator->getTimeFormat($market->onsale[$i]['duration'])."</td>";
    if(($market->onsale[$i]['wtype'] == 1 && $village->awood <= $market->onsale[$i]['wamt']) ||($market->onsale[$i]['wtype'] == 2 && $village->aclay <= $market->onsale[$i]['wamt']) ||($market->onsale[$i]['wtype'] == 3 && $village->airon <= $market->onsale[$i]['wamt']) ||($market->onsale[$i]['wtype'] == 4 && $village->acrop <= $market->onsale[$i]['wamt'])) {
    echo "<td class=\"act none\">".rinok9."</td></tr>";
    }
    else if($reqMerc > $market->merchantAvail()) {
    echo "<td class=\"act none\">".rinok10."</td></tr>";
    }
    else {
    echo "<td class=\"act\"><a href=\"build.php?id=".$id."&t=1&a=".$session->mchecker."&g=".$market->onsale[$i]['id']."\"><button type=\"button\" value=\"accept offer\" class=\"green \">
<div class=\"button-container addHoverClick \">
    <div class=\"button-background\">
        <div class=\"buttonStart\">
            <div class=\"buttonEnd\">
                <div class=\"buttonMiddle\"></div>
            </div>
        </div>
    </div><div class=\"button-content\">".rinok11."</div></div></button></a></td>";
    }
    echo"</tr>";
    }
}
}
else {
echo "<tr><td class=\"none\" colspan=\"6\">".rinok12."</td></tr>";
}
?>
</tbody><tfoot><tr><td colspan="6">
<span class="none">
<?php
if(!isset($_GET['u']) && count($market->onsale) < 40) {
    echo "<span class=\"none\"><b>&laquo;</b></span><span class=\"none\"><b>&raquo;</b></span>";
    }
    else if (!isset($_GET['u']) && count($market->onsale) > 40) {
    echo "<span class=\"none\"><b>&laquo;</b></span><a href=\"build.php?id=".$id."&t=1&u=40\">&raquo;</a>";
    }
    else if(isset($_GET['u']) && count($market->onsale) > $_GET['u']) {
    	if(count($market->onsale) > ($_GET['u']+40) && $_GET['u']-40 < count($market->onsale) && $_GET['u'] != 0) {
         echo "<a href=\"build.php?id=".$id."&t=1&u=".($_GET['u']-40)."\">&laquo;</a><a href=\"build.php?id=".$id."&t=1&u=".($_GET['u']+40)."\">&raquo;</a>";
         }
         else if(count($market->onsale) > $_GET['u']+40) {
         	echo "<span class=\"none\"><b>&laquo;</b></span><a href=\"build.php?id=".$id."&t=1&u=".($_GET['u']+40)."\">&raquo;</a>";
         }
        else {
        echo "<a href=\"build.php?id=".$id."&t=1&u=".($_GET['u']-40)."\">&laquo;</a><span class=\"none\"><b>&raquo;</b></span>";
        }
    }
?>
</td></tr>
</table>