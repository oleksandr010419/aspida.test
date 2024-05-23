<div class="clear"></div><?php

define("DEMOLISH_FULL",5); //цена сноса
if($_REQUEST["cancel"] == "1") {
	$database->delDemolition($village->wid);
	$database->DeleteQueue("`if1`='".$village->wid."' and `type`='9'");
	header("Location: build.php?gid=15");

}

if(!empty($_REQUEST["demolish"]) && $_REQUEST["c"] == $session->mchecker) {

	if($_REQUEST["type"] != null && $_REQUEST["type"] > 0 && !isset($_REQUEST['tozero']) || $_REQUEST['tozero']==0) 	{
		$type = $_REQUEST['type'];
		$infa=$database->addDemolition($village->wid,$type,$village->resarray);
		$session->changeChecker();
		$database->insertQueue($infa[0],9,time(),$infa[1],$village->wid);
		header("Location: build.php?gid=15");
	}elseif($_REQUEST['tozero']==1){
        $_REQUEST['type']=$database->FilterIntValue($_REQUEST['type']);
        if($_REQUEST['type']>=19 && $_REQUEST['type']<=40 && $session->gold>=DEMOLISH_FULL){
$database->query("UPDATE fdata SET `f".$_REQUEST['type']."`=0,`f".$_REQUEST['type']."t`=0 WHERE `vref`='".$village->wid."'");
            $database->recountPop($village->wid);
            $database->UpdateAchievU($session->uid,"`a5`=a5+".DEMOLISH_FULL);
            $database->modifyGold($session->uid,DEMOLISH_FULL,0,"Demolish a building");
        }
        header("Location: build.php?gid=15");
    }

}

if($village->resarray['f'.$id] >= 10) {
	echo "<h2>".gz0."</h2><p>".gz1."</p>";
	$VillageResourceLevels = $village->resarray;
	$DemolitionProgress = $database->getDemolition($village->wid);
	if (!empty($DemolitionProgress)) {
		$Demolition = $DemolitionProgress[0];
		echo "<b>";
		echo "<a href='build.php?id=".$id."&cancel=1'><img src='img/x.gif' class='del' title='cancel' alt='cancel'></a> ";
		echo "".gz2." ".$building->procResType($VillageResourceLevels['f'.$Demolition['buildnumber'].'t']).": <span id=timer".$timer.">".$generator->getTimeFormat($Demolition['timetofinish']-time())."</span>";
		?>
		<a href="?buildingFinish=1" onclick="return confirm <?=gz3?>;" title="Finish all construction and research orders in this village immediately for 2 Gold?"><img class="clock" alt="Finish all construction and research orders in this village immediately for 2 Gold?" src="img/x.gif"/></a>
			<?php
		echo "</b>";
	} else {
		echo "
		<form action=\"build.php?gid=15&amp;demolish=1&amp;cancel=0&amp;c=".$session->mchecker."\" method=\"POST\" style=\"display:inline\">
		<select name=\"type\" class=\"dropdown\">";
		for ($i=19; $i<=41; $i++) {
			if ($VillageResourceLevels['f'.$i] >= 1 && !$building->isCurrent($i) && !$building->isLoop($i)) {
				echo "<option value=".$i.">".$i.". ".$building->procResType($VillageResourceLevels['f'.$i.'t'])." (".sokr8." ".$VillageResourceLevels['f'.$i].")</option>";
			}
		}
		echo "</select>";
        echo "<br /><input type=\"checkbox\" name='tozero' value='1'/> <b>".gz5." <img src=\"img/x.gif\" class=\"gold\" title=\"Gold\"></b>";
        echo "<br />";
        echo "<button type=\"submit\"  id=\"btn_demolish\" class=\"green\"> <div class=\"button-container addHoverClick\">
  <div class=\"button-background\">
   <div class=\"buttonStart\">
    <div class=\"buttonEnd\">
     <div class=\"buttonMiddle\"></div>
    </div>
   </div>
  </div>
  <div class=\"button-content\">" . gz4 . "</div></div></button></form>";
    }
}
?>
