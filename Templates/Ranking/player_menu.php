<div class="contentNavi tabNavi">
    <div class="container <?php if(!isset($_GET) || $_GET['id']==1) {echo "active";}else{echo "normal";} ?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content"><a href="statistiken.php?id=1"><span class="tabItem"><?=PROFM1?></span></a></div>
    </div>
    <div class="container <?php if($_GET['id']==31) {echo "active";}else{echo "normal";} ?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content"><a href="statistiken.php?id=31"><span class="tabItem"><?=OTPRAV3?></span></a></div>
    </div>
    <div class="container <?php if($_GET['id']==32) {echo "active";}else{echo "normal";} ?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content"><a href="statistiken.php?id=32"><span class="tabItem"><?=STATISTIC37?></span></a></div>
    </div>
    <div class="container <?php if($_GET['id']==7) {echo "active";}else{echo "normal";} ?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content"><a href="statistiken.php?id=7"><span class="tabItem"><?=STATISTIC9?> 10</span></a></div>
    </div><div class="clear"></div>
</div>