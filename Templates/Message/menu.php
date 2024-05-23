<div class="contentNavi subNavi">
    <div title="" class="<?php if(!isset($_GET['t'])) { echo "container active"; }else{ echo "container normal"; } ?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content"><a href="nachrichten.php"><span class="tabItem"><?=MSG6?></span></a></div>
    </div>
    <div title="" class="<?php if(isset($_GET['t']) && $_GET['t'] == 1) { echo "container active"; }else{ echo "container normal"; } ?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content"><a href="nachrichten.php?t=1"><span class="tabItem"><?=MSG7?></span></a></div>
    </div>
    <div title="" class="<?php if(isset($_GET['t']) && $_GET['t'] == 2) { echo "container active"; }else{ echo "container normal"; } ?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content"><a href="nachrichten.php?t=2"><span class="tabItem"><?=MSG8?></span></a></div>
    </div>

    <div class="clear"></div>
</div>
