
<div class="boxes buildingList">
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
        <h5><?php
        echo BUILDING_UPGRADING;?></h5>
     <?php   if($session->gold >= 2) {?>
        <div class="finishNow"><button onclick="document.location.href='<?=$_SERVER['PHP_SELF'];?>?buildingFinish=1'" type="button" value="<?php echo INSTANTCMLT; ?>" id="button526f68b2930cf" class="gold ">
                <div class="button-container addHoverClick ">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content"><?php echo INSTANTCMLT; ?></div>
                </div>
            </button>

        </div>

        <?php } ?>


        <?php
        $timer = 1;
        $mas=array();
        $j=0;
        foreach($building->buildArray as $jobss) {
            $mas[$jobss['type']]=$j;
            $j++;
        }

		$BuildingList = array();
        $jj=0;
        foreach($building->buildArray as $jobs) {
            echo '<ul>';
            echo "<li>";
if($mas[$jobs['type']]==$jj){        	echo "<a href=\"?d=".$jobs['id']."&а=0&c=$session->checker\">";
            echo "<img src=\"img/x.gif\" class=\"del\" title=\"cancel\" alt=\"cancel\" /></a><div class=\"name\">";}else{
    echo "<a style='cursor:default'><img src=\"img/x.gif\" class=\"del inactive\"/></a><div class=\"name\">";

}
        if($jobs['master'] == 0){

			echo $building->procResType($jobs['type'])." <span class=\"lvl\">level ".$jobs['level']."</span>";
			if($jobs['loopcon'] == 0) { $BuildingList[] = $jobs['field']; }
            if($jobs['loopcon'] == 1) {
            	echo " (Waiting loop)";
            }
            echo "</div><div class=\"buildDuration\"><span id=\"timer".$timer."\">";
            echo $generator->getTimeFormat($jobs['timestamp']-time());

            echo "</span> hours.  done at ".date('H:i', $jobs['timestamp'])."</div><div class=\"clear\"></div></li>";
            $timer +=1;

      	}else{
            echo "<span class=\"none\">".$building->procResType($jobs['type'])."</span> <span class=\"lvl\"> Level ".$jobs['level']."</span> <small><span class=\"none\">Construct with Architect <font color=\"#B3B3B3\">(costs: <img src=\"img/x.gif\" alt=\"\" class=\"gold\">2)</font></span></small></div><div class=\"clear\"></div></li>";
        }
            $jj++;
            echo '</ul>';
        }
        ?>


    </div>
</div>
<script type="text/javascript">var bld=[{"stufe":1,"gid":"1","aid":"3"}]</script>
