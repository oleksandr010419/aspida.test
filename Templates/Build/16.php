<div id="build" class="gid16">
<br />
		<div class="contentNavi tabNavi">
				<div class="container <?php if(!isset($_GET['t'])){ echo "active";}?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="build.php?id=<?php echo $id; ?>"><span class="tabItem"><?=PY2?></span></a></div>
				</div>
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="a2b.php"><span class="tabItem"><?=PY3?></span></a></div>
				</div>
                <div class="container <?php if($session->goldclub!=1){ ?>gold<?php }?> <?php if(isset($_GET['t']) && $_GET['t']==99){ echo "active";}?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content">
					<?php if($session->goldclub==1){ ?>
					<a href="build.php?id=39&amp;t=99"><span class="tabItem"><?=PY17?></span></a>
					<?php }else{?>					
					<a href="#" onclick="window.fireEvent('startPaymentWizard', {}); this.blur(); return false;"><span class="tabItem"><?=PY17?></span></a>
					<?php }?>
					</div>
				</div>
				<?php if($session->goldclub==1){ ?>
                <div class="container <?php if(isset($_GET['t']) && $_GET['t']==100){ echo "active";}?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="build.php?id=39&amp;t=100"><span class="tabItem"><?=GOLDC?></span></a></div>
				</div>
				<?php } ?>
</div>

<?php
if(!(isset($_GET['t']) && ($_GET['t']==99 || $_GET['t']==100) && $session->goldclub==1)){
$units_type = $database->getMovement("34",$village->wid,1);
		$oasis = $village->oasisowned;
		$oas_incoming=0;
		foreach($oasis as $oa){
$oas_incoming += count($database->getMovement("33",$oa['wref'],1));
}
$units_incoming = count($units_type)+$oas_incoming;
for($i=0;$i<$units_incoming;$i++){
	if($units_type[$i]['attack_type'] == 1 && $units_type[$i]['sort_type'] == 3)
		$units_incoming -= 1;
}
if($units_incoming > 0){
?>
<h4><?=PY1?> (<?php echo $units_incoming; ?>)</h4>
	<?php include("16_incomming.php");
	}
?>

<h4><?=PY5;?></h4>
        <table class="troop_details" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<td class="role"><a href="karte.php?d=<?php echo $village->wid; ?>"><?php echo $village->vname; ?></a></td><td colspan="<?php if($village->unitarray['u11'] == 0) {echo"10";}else{echo"11";}?>">
            <a href="spieler.php?uid=<?php echo $session->uid; ?>"><?=PY7;?></a></td></tr></thead>
            <tbody class="units">
           <?php include("16_troops.php");

           ?>
            </tbody></table>

            <?php      $enforcetome=$database->getEnforceVillage($village->wid,0); //подкрепы у меня
            if(count($enforcetome) > 0) {
            foreach($enforcetome as $enforce) {
            $info=$database->getUserVillInfoByVillageID($enforce['from']);
			if ($info == FALSE) {
				$info = array(
					'id'	=> $session->uid,
					'username' => $session->username,
					'tribe' => 4,
				);
			}
			$colspan = 10+$enforce['u11'];
			if($enforce['from']!=0){
                  echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">
                  <a href=\"karte.php?d=".$enforce['from']."\">".$info['name']."</a></td>
                  <td colspan=\"".$colspan."\">";
                  echo "<a href=\"spieler.php?uid=".$info['id']."\">".$info['username']." ".PY8."</a>";
                  echo "</td></tr></thead><tbody class=\"units\">";

                  $tribe = $info['tribe'];
				  if($tribe==0)$tribe=4;
                  echo "<tr><th>&nbsp;</th>";
                  for($i=1;$i<=10;$i++) {
                  	$uni=($tribe-1)*10+$i;
                  	echo "<td><img src=\"img/x.gif\" class=\"unit u".$uni."\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
                  }
				  if($enforce['u11']!=0){
					echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
				  }
                  echo "</tr><tr><th>".PY8."</th>";
                  for($i=1;$i<=10;$i++) {
                  if($enforce['u'.$i] == 0) {
                	echo "<td class=\"none\">";
                       }
                      else {
                     echo "<td>";
                        }
                        echo $enforce['u'.$i]."</td>";
                  }
				  if($enforce['u11']!=0){
					echo "<td>".$enforce['u11']."</td>";
				  }
                  echo "</tr></tbody>
            <tbody class=\"infos\"><tr><th>".PY9."</th><td colspan=\"$colspan\"><div class='sup'>".$database->getUpkeep($enforce,$tribe,$village->resarray,1)."<img class=\"r4\" src=\"img/x.gif\" title=\"Crop\" alt=\"Crop\" />".PY10."</div><div class='sback'><a href='a2b.php?w=".$enforce['id']."'>".PY11."</a></div></td></tr>";

                  echo "</tbody></table>";
			}
            }
            }
            $enforcetoyou = $database->getEnforceVillage($village->wid,1); //подкрепы от меня
            if(count($enforcetoyou) > 0) {

            echo "<h4>".PY12."</h4>";
            foreach($enforcetoyou as $enforce) {
               // echo $enforce['vref']."<br />";
                $fr=!$database->isVillageExist($enforce['from']);
                $vr=!$database->isVillageExist($enforce['vref']);
                if ($vr && $fr) {
                    if($vr){echo 'from ';}else{ echo 'vref ';}
                    echo 'Деревня с подкрепом не найдена.Напишите Админу ид ' . $enforce[$vr] . '<br /> Village with reinforce not found,please,write this id ' . $enforce[$vr] . ' to administrator';
                } else {
               //     $info = $database->getUserVillInfoByVillageID($enforce['from']);
                    $isoasis = $database->isVillageOases($enforce['vref']);
                    if ($isoasis == 0) {
                        $to = $database->getMInfo($enforce['vref']);
                        $database->starvationReinf($to);
                        $vname = $to['name'];
                    } else {
                        $to = $database->getOMInfo($enforce['vref']);
                        $database->starvationReinf($database->getVillage($to['conqured']));
                        $vname = PY18 . " (" . $to['x'] . "|" . $to['y'] . ")";
                    }
                    $colspan = 10 + $enforce['u11'];
                    echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">

                  <td colspan=\"" . $colspan . "\">";
                    echo "<a href=\"karte.php?d=" . $enforce['vref'] . "\">" . PY13 . $vname . "</a>";
                    echo "</td></tr></thead><tbody class=\"units\">";
                    $tribe = $session->tribe;

                    echo "<tr><th>&nbsp;</th>";
                    for ($i = 1; $i <= 10; $i++) {
                        $uni = ($tribe - 1) * 10 + $i;
                        echo "<td><img src=\"img/x.gif\" class=\"unit u" . $uni . "\" title=\"" . $technology->getUnitName($uni) . "\" alt=\"" . $technology->getUnitName($uni) . "\" /></td>";
                    }
                    if ($enforce['u11'] != 0) {
                        echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
                    }
                    echo "</tr><tr><th>" . ot4m1 . "</th>";
                    for ($i = 1; $i <= 10; $i++) {
                        if ($enforce['u' . $i] == 0) {
                            echo "<td class=\"none\">";
                        } else {
                            echo "<td>";
                        }
                        echo $enforce['u' . $i] . "</td>";
                    }
                    if ($enforce['u11'] != 0) {
                        echo "<td>" . $enforce['u11'] . "</td>";
                    }
                    echo "</tr></tbody><tbody class=\"infos\"><tr><th>" . PY9 . "</th><td colspan=\"" . $colspan . "\"><div class='sup'>" . $database->getUpkeep($enforce, $tribe, $village->resarray) . "<img class=\"r4\" src=\"img/x.gif\" title=\"Crop\" alt=\"Crop\" />" . PY10 . "</div><div class='sback'><a href='a2b.php?r=" . $enforce['id'] . "'>" . PY14 . "</a></div></td></tr>";

                    echo "</tbody></table>";
                }
            }
            }
    $prisoner3=$database->getPrisoners3($village->wid);
    if(count($prisoner3) > 0) {
        echo "<h4>".PRISONERS."</h4>";
        foreach($prisoner3 as $prisoners) {
            $colspan = 10+$prisoners['t11'];
            echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">
</td>
<td colspan=\"$colspan\">";
            echo "<a href=\"karte.php?d=".$prisoners['wref']."&c=".$generator->getMapCheck($prisoners['wref'])."\">".PRISONERSIN." ".$database->getVillageField($prisoners['wref'],"name")."</a>";
            echo "</td></tr></thead><tbody class=\"units\">";
            $uinf=$database->getUserTribeByVillageID($prisoners['from']);
            $tribe = $uinf['tribe'];
            $start = ($tribe-1)*10+1;
            $end = ($tribe*10);
            echo "<tr><th>&nbsp;</th>";
            for($i=$start;$i<=($end);$i++) {
                echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
            }
            if($prisoners['t11']!=0){
                echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
            }
            echo "</tr><tr><th>".TROOPS_DORF."</th>";
            for($i=1;$i<=10;$i++) {
                if($prisoners['t'.$i] == 0) {
                    echo "<td class=\"none\">";
                }
                else {
                    echo "<td>";
                }
                echo $prisoners['t'.$i]."</td>";
            }
            if($prisoners['t11']!=0){
                echo "<td>".$prisoners['t11']."</td>";
            }
            echo "</tr></tbody>
<tbody class=\"infos\"><tr><td colspan=\"".($colspan+1)."\"><div class='sback'><a href='build.php?id=39&delprisoners=".$prisoners['id']."'>Kill</a></div></td></tr>";
            echo "</tbody></table>";
        }
    }
   $prison= $database->getPrisoners($village->wid);
    if(count($prison) > 0) {
        echo "<h4>".PRISONERS."</h4>";
        foreach($prison as $prisoners) {
            $colspan = 10+$prisoners['t11'];
            $colspan2 = 11+$prisoners['t11'];
            echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\"></td>
<td colspan=\"$colspan\">";
            echo "<a href=\"karte.php?d=".$prisoners['from']."&c=".$generator->getMapCheck($prisoners['from'])."\">".PRISONERSFROM." ".$database->getVillageField($prisoners['from'],"name")."</a>";
            echo "</td></tr></thead><tbody class=\"units\">";
            $uinf=$database->getUserTribeByVillageID($prisoners['from']);
            $tribe = $uinf['tribe'];
            $start = ($tribe-1)*10+1;
            $end = ($tribe*10);
            echo "<tr><th>&nbsp;</th>";
            for($i=$start;$i<=($end);$i++) {
                echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
            }
            if($prisoners['t11']!=0){
                echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
            }
            echo "</tr><tr><th>".TROOPS_DORF."</th>";
            for($i=1;$i<=10;$i++) {
                if($prisoners['t'.$i] == 0) {
                    echo "<td class=\"none\">";
                }
                else {
                    echo "<td>";
                }
                echo $prisoners['t'.$i]."</td>";
            }
            if($prisoners['t11']!=0){
                echo "<td>".$prisoners['t11']."</td>";
            }
            echo "</tr></tbody>
			<tbody class=\"infos\"><tr><td colspan=\"".($colspan+1)."\"><div class='sback'><a href='build.php?id=39&delprisoners=".$prisoners['id']."'>".PY11."</a></div></td></tr></tbody>
			<tbody class=\"infos\"><tr><td colspan=\"".($colspan+1)."\"><div class='sback'><a href='build.php?id=39&killprisoners&delprisoners=".$prisoners['id']."'>Kill</a></div></td></tr>";
            echo "</tbody></table>";
        }
    }

    if(count($village->oasisowned)>0){

        foreach($village->oasisowned as $oasid){
    $enforcetome=$database->getEnforceVillage($oasid['wref'],0); //подкрепы в оазе
    if(count($enforcetome) > 0) {
        echo "<h4>".PY19."</h4>";
        foreach($enforcetome as $enforce) {
            $info=$database->getUserVillInfoByVillageID($enforce['from']);
          //  $isoasis = $database->isVillageOases($enforce['vref']);

                $to = $database->getOMInfo($enforce['vref']);
                $database->starvationReinf($database->getVillage($to['conqured']));
                $vname=PY18." (".$to['x']."|".$to['y'].")";
            $colspan = 10+$enforce['u11'];

                echo "<table class=\"troop_details\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><td class=\"role\">
                  <a href=\"karte.php?d=".$enforce['from']."\">".$info['name']."</a></td>
                  <td colspan=\"".$colspan."\">";
               echo "<a href=\"karte.php?d=".$enforce['vref']."\">".PY13.$vname."</a>";
                echo "</td></tr></thead><tbody class=\"units\">";
                $tribe = $info['tribe'];
                echo "<tr><th>&nbsp;</th>";
                for($i=1;$i<=10;$i++) {
                    $uni=($tribe-1)*10+$i;
                    echo "<td><img src=\"img/x.gif\" class=\"unit u".$uni."\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
                }
                if($enforce['u11']!=0){
                    echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
                }
                echo "</tr><tr><th>".PY8."</th>";
                for($i=1;$i<=10;$i++) {
                    if($enforce['u'.$i] == 0) {
                        echo "<td class=\"none\">";
                    }
                    else {
                        echo "<td>";
                    }
                    echo $enforce['u'.$i]."</td>";
                }
                if($enforce['u11']!=0){
                    echo "<td>".$enforce['u11']."</td>";
                }
                echo "</tr></tbody>
            <tbody class=\"infos\"><tr><th>".PY9."</th><td colspan=\"$colspan\"><div class='sup'>".$database->getUpkeep($enforce,$tribe,$village->resarray)."<img class=\"r4\" src=\"img/x.gif\" title=\"Crop\" alt=\"Crop\" />".PY10."</div><div class='sback'><a href='a2b.php?w=".$enforce['id']."'>".PY11."</a></div></td></tr>";

                echo "</tbody></table>";

        }
    }
        }
    }





$units_type = $database->getMovement("3",$village->wid,0);
$units_incoming = count($units_type);
for($i=0;$i<$units_incoming;$i++){
	if($units_type[$i]['vref'] != $village->wid)
		$units_incoming -= 1;
}
//$units_incoming += count($settlers);

if($units_incoming >= 1){
	echo "<h4>".PY15."</h4>";
	include("16_walking.php");
}
}elseif($_GET['t']==99){?>
<div id="raidList">
	<?php if(!$session->goldclub) { ?>
    <div class="options">
        <div id="spaceUsed">
            <div class="boxes boxesColor gray"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents">				The farm list is free, but only when the gold club available.					</div>
            </div>
            <div class="clear"></div>
        </div>

        <a class="arrow" href="plus.php?id=3><?=GOLDC?></a>
    </div>
<?php
}else{
        if($_GET['action'] == 'addList') {
            include("Templates/goldClub/farmlist_add.php");
        }
        if($_GET['action'] == 'showSlot' && $_GET['lid']) {
            include("Templates/goldClub/farmlist_addraid.php");
        }elseif($_GET['action'] == 'showSlot' && $_GET['eid']) {
            include("Templates/goldClub/farmlist_editraid.php");
        }
        if($_GET['action'] == 'deleteList') {
            $database->delFarmList($_GET['lid'], $session->uid);
            header("Location: build.php?id=39&t=99");
        }elseif($_GET['action'] == 'deleteSlot') {
            $database->delSlotFarm($_GET['eid']);
            header("Location: build.php?id=39&t=99");
        }
        if($_POST['action'] == 'startRaid'){
                include ("Templates/a2b/startRaid.php");

        }
        if(!isset($_GET['action'])){
        include "Templates/goldClub/farmlist.php"; }
    }

            ?>
</div>
    <?php
}elseif($_GET['t']==100){
    include "16_100.php";
}
?>
    </div>
