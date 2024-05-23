<?php if($session->alliance == $aid) {
    ?>
    <div class="contentNavi subNavi">
        <div title="" class="container <?php if(!isset($_GET['ss']) && !isset($_GET['s'])) { echo "active"; }else{ echo "normal"; } ?>">
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div class="content"><a href="allianz.php"><span class="tabItem"><?=PROFM1?></span></a></div>
        </div>
        <div title="" class="container <?php if(isset($_GET['s'])  && $_GET['s'] == 4) { echo "active"; }else{ echo "normal"; } ?>">
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div class="content"><a href="allianz.php?s=4"><span class="tabItem"><?=ally8?></span></a></div>
        </div>
        <div title="" class="container <?php if(isset($_GET['s']) && $_GET['s'] == 3) { echo "active"; }else{ echo "normal"; } ?>">
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div class="content"><a href="allianz.php?s=3"><span class="tabItem"><?=ally9?></span></a></div>
        </div>
        <?php if($session->sit == 0){?>
        <div title="" class="container <?php if(isset($_GET['ss']) || isset($_GET['s']) && $_GET['s'] == 5) { echo "active"; }else{ echo "normal"; } ?>">
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div class="content"><a href="allianz.php?s=5"><span class="tabItem"><?=ally10?></span></a></div>
        </div><?php } ?><div class="clear"></div>
    </div>

<?php
}
?>