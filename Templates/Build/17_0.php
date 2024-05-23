<script language="JavaScript">
    var haendler = <?php echo $market->merchantAvail(); ?>;
    var carry = <?php echo $market->maxcarry; ?>;
</script>
<div class="boxes boxesColor gray traderCount"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents"><?=MERCHANTS?>   <?php echo $market->merchantAvail(); ?> / <?php echo $market->merchant; ?></div>
</div><div class="clear"></div>
<?php
$checkexist=false;
if(isset($_POST['x']) && $_POST['x']!="" && $_POST['y']!="" && is_numeric($_POST['x']) && is_numeric($_POST['y'])){
    $allres = $_POST['r1']+$_POST['r2']+$_POST['r3']+$_POST['r4'];
	$getwref = $database->getBaseID($_POST['x'],$_POST['y']);
	$checkexist = $database->checkVilExist($getwref);
}

if($checkexist){
$villageOwner = $database->getVillageField($getwref,'owner');
$userAccess = $database->getUserField($villageOwner,'access',0);
}
$maxcarry = $market->maxcarry;
$maxcarry *= $market->merchantAvail();

if(isset($_POST['ft'])=='check' && $allres!=0 && $allres <= $maxcarry && $_POST['x']!="" && $_POST['y']!="" && $checkexist && $session->right['s3']){
?>
<form method="POST" name="snd" action="build.php">
    <input type="hidden" name="ft" value="mk1">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="send3" value="<?php echo $_POST['send3']; ?>">
    <table id="send_select" class="send_res" cellpadding="1" cellspacing="1">
    <tr>
    <td class="ico"><img class="r1" src="img/x.gif" alt="Lumber" title="<?=LUMBER?>" /></td>
<td class="nam"> <?=TVRN12?></td>
<td class="val"><input class="text disabled" type="text" name="r1" id="r1" value="<?php echo $_POST['r1']; ?>" readonly="readonly"></td>
<td class="max"> / <span class="none"><B><?php echo $market->maxcarry; ?></B></span> </td>
</tr>
    <tr>
<td class="ico"><img class="r2" src="img/x.gif" alt="Clay" title="<?=CLAY?>" /></td>
<td class="nam"> <?=TVRN13?></td>
<td class="val"><input class="text disabled" type="text" name="r2" id="r2" value="<?php echo $_POST['r2']; ?>" readonly="readonly"></td>
<td class="max"> / <span class="none"><b><?php echo$market->maxcarry; ?></b></span> </td>
</tr>
    <tr>
<td class="ico"><img class="r3" src="img/x.gif" alt="Iron" title="<?=IRON?>" /></td>
<td class="nam"> <?=TVRN14?></td>
<td class="val"><input class="text disabled" type="text" name="r3" id="r3" value="<?php echo $_POST['r3']; ?>" readonly="readonly">
    </td>
<td class="max"> / <span class="none"><b><?php echo $market->maxcarry; ?></b></span> </td>
</tr>
    <tr>
<td class="ico"><img class="r4" src="img/x.gif" alt="Crop" title="<?=CROP?>" /></td>
<td class="nam"> <?=TVRN15?></td>
<td class="val"> <input class="text disabled" type="text" name="r4" id="r4" value="<?php echo $_POST['r4']; ?>" readonly="readonly">
    </td>
<td class="max"> / <span class="none"><B><?php echo $market->maxcarry; ?></B></span></td>
</tr>
        <tr>
            <td colspan="4">
                <hr>
            </td>
        </tr>
    </table>
<table id="target_validate" class="res_target" cellpadding="1" cellspacing="1">
    <tbody><tr>
    <th><?=TVRN5?>:</th>
    <?php
    if($_POST['x']!="" && $_POST['y']!="" && is_numeric($_POST['x']) && is_numeric($_POST['y'])){
    $getwref = $database->getBaseID($_POST['x'],$_POST['y']);
    $getvilname = $database->getVillageField($getwref, "name");
    $getvilowner = $database->getVillageField($getwref, "owner");
    $getvilcoor['y'] = $_POST['y'];
    $getvilcoor['x'] = $_POST['x'];
    $time = $database->procDistanceTime($getvilcoor,$village->coor,$session->tribe,0,$village->wid);
    }


    ?>
        <td class="vil"><a href="karte.php?d=<?php echo $getwref; ?>&c=<?php echo $generator->getMapCheck($getwref); ?>"><?php echo $getvilname; ?>(<?php echo $getvilcoor['x']; ?>|<?php echo $getvilcoor['y']; ?>)<span class="clear"></span></a></td>
</tr>
    <tr>
    <th><?=OVERVIEW1?>:</th>
    <td><a href="spieler.php?uid=<?php echo $getvilowner; ?>"><?php echo $database->getUserField($getvilowner,'username',0); ?></a></td>
</tr>
    <tr>
    <th><?=ratusha12?>:</th>
    <td><?php echo $generator->getTimeFormat($time); ?></td>
</tr>
    <tr>
    <th><?=MERCHANTS?>:</th>
    <td><?php
        $resource = array($_POST['r1'],$_POST['r2'],$_POST['r3'],$_POST['r4']);
        echo ceil((array_sum($resource)-0.1)/$market->maxcarry); ?></td>
</tr>

    <tr>
<td colspan="2">
    </td>
</tr>

</tbody></table>
<input type="hidden" name="getwref" value="<?php echo $getwref; ?>">
    <div class="clear"></div>
    <p>
        <button type="submit" value="ok" name="s1" id="btn_ok" class="green" tabindex="8">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content"><?=rinok13?></div>
            </div>
        </button>
    </p></form>
<?php }else{

?>
<form method="POST" name="snd" action="build.php">
    <input type="hidden" name="ft" value="check">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <table id="send_select" class="send_res" cellpadding="1" cellspacing="1">

    <tr>

    <td class="ico">
    <a href="#" onClick="upd_res(1,1); return false;"><img class="r1" src="img/x.gif" alt="Wood" title="<?=WOOD?>" /></a>
</td>
<td class="nam">
    <?=TVRN12?>
    </td>
<td class="val">
    <input class="text" type="text" name="r1" id="r1" value="<?php echo $_POST['r1']; ?>" maxlength="9" onKeyUp="upd_res(1)" tabindex="1">
    </td>
<td class="max">
    / <a href="#" onMouseUp="add_res(1);" onClick="return false;"><?php echo $market->maxcarry; ?></a>
</td>
</tr><tr>
<td class="ico">
    <a href="#" onClick="upd_res(2,1); return false;"><img class="r2" src="img/x.gif" alt="Clay" title="<?=CLAY?>" /></a>

</td>
<td class="nam">
    <?=TVRN13?>
    </td>
<td class="val">
    <input class="text" type="text" name="r2" id="r2" value="<?php echo $_POST['r2']; ?>" maxlength="9" onKeyUp="upd_res(2)" tabindex="2">
    </td>
<td class="max">
    / <a href="#" onMouseUp="add_res(2);" onClick="return false;"><?php echo$market->maxcarry; ?></a>
</td>
</tr><tr>
<td class="ico">
    <a href="#" onClick="upd_res(3,1); return false;"><img class="r3" src="img/x.gif" alt="Iron" title="<?=IRON?>" /></a>

</td>
<td class="nam">
    <?=TVRN14?>
    </td>
<td class="val">
    <input class="text" type="text" name="r3" id="r3" value="<?php echo $_POST['r3']; ?>" maxlength="9" onKeyUp="upd_res(3)" tabindex="3">
    </td>
<td class="max">
    / <a href="#" onMouseUp="add_res(3);" onClick="return false;"><?php echo $market->maxcarry; ?></a>
</td>
</tr><tr>
<td class="ico">
    <a href="#" onClick="upd_res(4,1); return false;"><img class="r4" src="img/x.gif" alt="Crop" title="<?=CROP?>" /></a>

</td>
<td class="nam">
    <?=TVRN15?>
    </td>
<td class="val">
    <input class="text" type="text" name="r4" id="r4" value="<?php echo $_POST['r4']; ?>" maxlength="9" onKeyUp="upd_res(4)" tabindex="4">
    </td>
<td class="max">
    / <a href="#" onMouseUp="add_res(4);" onClick="return false;"><?php echo $market->maxcarry; ?></a>

</td>
</tr>
        <tr>
            <td colspan="4">
                <hr>
            </td>
        </tr>
    </table>



<div class="destination"><div class="boxes boxesColor gray"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents">

    <table cellpadding="0" cellspacing="0" class="transparent compact">
    <tbody>
    <tr>
    <td>
    <span class="or"><?=COORDIANTES?></span>
<?php
if(isset($_GET['z'])){
$coor = $database->getCoor($database->filterintvalue($_GET['z']));
}
elseif(isset($_GET['forres'])){

$coor = $database->getCoor($database->filterintvalue($_GET['forres']));
}
else{
$coor['x'] = "";
$coor['y'] = "";
}

?>		<div class="coordinatesInput">

<div class="yCoord">
    <label for="yCoordInput">X:</label>
<input class="text coordinates x " type="text" name="x" value="<?=$coor['x']?>" maxlength="4" tabindex="7">
    </div>
            <div class="xCoord">
                <label for="xCoordInput">Y:</label>
                <input class="text coordinates y " type="text" name="y" value="<?=$coor['y']?>" maxlength="4" tabindex="6">
            </div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</td>
</tr>
</tbody>
</table>
</div></div>
<div class="clear"></div>
    <?php if($session->goldclub == 1){?>
    <p><select class="markgos" name="send3"><option value="1" selected="selected">1x</option><option value="2">2x</option><option value="3">3x</option></select><?php echo markgo;?></p>
<?php
}else{
?>
<input type="hidden" name="send3" value="1">
    <?php
    }
    ?>
    </div>
    <div class="clear"></div>
    <p><?=rinok14?> <b><?php echo $market->maxcarry; ?></b> <?=rinok15?></p>
    <p>
        <button type="submit"  value="ok" name="s1" id="btn_ok" class="green <?php if(!$session->right['s3']){ echo 'disabled';}?>" tabindex="8">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content"><?=rinok13?></div>
            </div>
        </button>
</form>
<?php
$error = '';
if(isset($_POST['ft'])=='check'){

	if(!$checkexist){
		$error = '<span class="error"><b>'.rinok16.'</b></span>';
	}elseif($getwref == $village->wid){
		$error = '<span class="error"><b>'.rinok17.'</b></span>';
	}elseif($userAccess == '0' or $userAccess == '8' or $userAccess == '9'){
		$error = '<span class="error"><b>'.rinok18.'</b></span>';
    }elseif($_POST['r1']==0 && $_POST['r2']==0 && $_POST['r3']==0 && $_POST['r4']==0){
		$error = '<span class="error"><b>'.rinok19.'</b></span>';
    }elseif(!$_POST['x'] && !$_POST['y'] && !$_POST['dname']){
		$error = '<span class="error"><b>'.rinok20.'</b></span>';
    }elseif($allres > $maxcarry){
		$error = '<span class="error"><b>'.rinok21.'</b></span>';
    }
    echo $error;
}
?>
<script type="text/javascript">
    window.addEvent('domready', function()
    {
        $('r1').focus();
    });
        var haendler = <?php echo $market->merchantAvail(); ?>;
        var carry = <?php echo $market->maxcarry; ?>;
        var merchantRes = new Array(0,0,0,0,0);
        function add_res(resNr)
        {
            currentRes = resources['l' + resNr].value;
            merchantMax = haendler * carry;
            merchantRes[resNr] = res_max(merchantRes[resNr], currentRes , merchantMax , carry);
            $('r' + resNr).value = merchantRes[resNr];
        }
        function upd_res(resNr, max)
        {
            currentRes = resources['l' + resNr].value;
            merchantMax = haendler * carry;
            if (max)
            {
                inputRes = currentRes;
            }
            else
            {
                inputRes = parseInt($('r' + resNr).value);
            }
            if (isNaN(inputRes))
            {
                inputRes = 0;
            }
            merchantRes[resNr] = res_max(parseInt(inputRes), currentRes , merchantMax , 0);
            $('r' + resNr).value = merchantRes[resNr];
        }
        function res_max(_merchantRes, _actualRes , _merchantMax , _carry)
        {
            var res = Number(_merchantRes) + _carry;
            if (res > _actualRes)
            {
                res = _actualRes;
            }
            if (res > _merchantMax)
            {
                res = _merchantMax;
            }
            if (res == 0)
            {
                res = '';
            }
            return res;
        }
    </script>
    <script language="JavaScript" type="text/javascript">
        //<!--
        document.snd.r1.focus();
        //-->
    </script>
<p>
<?php }
if(!isset($timer)){
$timer = 1;
}
if(count($market->recieving) > 0) {
    echo "<h4>".rinok22.":</h4>";
    foreach($market->recieving as $recieve) {
        echo "<table class=\"traders\" cellpadding=\"1\" cellspacing=\"1\">";
        $villageowner = $database->getVillageField($recieve['from'],"owner");
        echo "<thead><tr><td><a href=\"spieler.php?uid=$villageowner\">".$database->getUserField($villageowner,"username",0)."</a></td>";
        echo "<td><a href=\"karte.php?d=".$recieve['from']."&c=".$generator->getMapCheck($recieve['from'])."\">Transport from ".$database->getVillageField($recieve['from'],"name")."</a> <div style='float:right;'>x".$send['send']."</div></td>";
        echo "</tr></thead><tbody><tr><th>".rinok23."</th><td>";
        echo "<div class=\"in\"><span id=timer$timer>".$generator->getTimeFormat($recieve['endtime']-time())."</span> h</div>";
        $datetime = $generator->procMtime($recieve['endtime']);
        echo "<div class=\"at\">";
        if($datetime[0] != "today") {
            echo "on ".$datetime[0]." ";
        }
        echo "at ".$datetime[1]."</div>";
        echo "</td></tr></tbody> <tr class=\"res\"> <th>".rinok24."</th> <td colspan=\"2\"><span class=\"f10\">";
        echo "<img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"".LUMBER."\" />".$recieve['wood']." | <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"".CLAY."\" />".$recieve['clay']." | <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"".IRON."\" />".$recieve['iron']." | <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"".CROP."\" />".$recieve['crop']."</td></tr></tbody>";
        echo "</table>";
        $timer +=1;
    }
}
if(count($market->sending) > 0) {
    echo "<h4>".rinok25."</h4>";
    foreach($market->sending as $send) {
        $villageowner = $database->getVillageField($send['to'],"owner");
        $ownername = $database->getUserField($villageowner,"username",0);
        echo "<table class=\"traders\" cellpadding=\"1\" cellspacing=\"1\">";
        echo "<thead><tr> <td><a href=\"spieler.php?uid=$villageowner\">$ownername</a></td>";
        echo "<td><a href=\"karte.php?d=".$send['to']."&c=".$generator->getMapCheck($send['to'])."\">Transport to ".$database->getVillageField($send['to'],"name")."</a> <div style='float:right;'>x".$send['send']."</div></td>";
        echo "</tr></thead> <tbody><tr> <th>".rinok23."</th> <td>";
        echo "<div class=\"in\"><span id=timer$timer>".$generator->getTimeFormat($send['endtime']-time())."</span></div>";
        $datetime = $generator->procMtime($send['endtime']);
        echo "<div class=\"at\">";
        if($datetime[0] != "today") {
            echo "on ".$datetime[0]." ";
        }
        echo "at ".$datetime[1]."</div>";
        echo "</td> </tr> <tr class=\"res\"> <th>".rinok24."</th><td>";
        echo "<img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"".LUMBER."\" />".$send['wood']." | <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"".CLAY."\" />".$send['clay']." | <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"".IRON."\" />".$send['iron']." | <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"".CROP."\" />".$send['crop']."</td></tr></tbody>";
        echo "</table>";
        $timer += 1;
    }
}
if(count($market->return) > 0) {
    echo "<h4>".rinok26.":</h4>";
    foreach($market->return as $return) {
        $villageowner = $database->getVillageField($return['from'],"owner");
        $ownername = $database->getUserField($villageowner,"username",0);
        echo "<table class=\"traders\" cellpadding=\"1\" cellspacing=\"1\">";
        echo "<thead><tr> <td><a href=\"spieler.php?uid=$villageowner\">$ownername</a></td>";
        echo "<td><a href=\"karte.php?d=".$return['from']."&c=".$generator->getMapCheck($return['from'])."\">Return from ".$database->getVillageField($return['from'],"name")."</a> <div style='float:right;'>x".$send['send']."</div></td>";
        echo "</tr></thead> <tbody><tr> <th>".rinok23."</th> <td>";
        echo "<div class=\"in\"><span id=timer".$timer.">".$generator->getTimeFormat($return['endtime']-time())."</span></div>";
        $datetime = $generator->procMtime($return['endtime']);
        echo "<div class=\"at\">";
        if($datetime[0] != "today") {
            echo "on ".$datetime[0]." ";
        }
        echo "at ".$datetime[1]."</div>";
        echo "</td> </tr> <tr class=\"res\"> <th>".rinok24."</th>";
        echo "<td class=\"none\"><img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"".LUMBER."\" />".$return['wood']." | <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"".CLAY."\" />".$return['clay']." | <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"".IRON."\" />".$return['iron']." | <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"".CROP."\" />".$return['crop']."</td></tr>";

        echo "</tbody></table>";
        $timer += 1;
    }
}