<?php if(!$session->sit){ ?>
    <div class="contentNavi subNavi">
        <div title="" class="container <?php if(isset($_GET['uid'])) { echo "active"; }else{ echo "normal"; } ?>">
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div class="content"><a href="spieler.php?uid=<?php if(isset($_GET['uid'])) { echo $_GET['uid']; } else { echo $session->uid; } ?>"><span class="tabItem"><?=PROFM1?></span></a></div>
        </div>
        <div title="" class="container <?php if(isset($_GET['s']) && $_GET['s'] == 1) { echo "active"; }else{ echo "normal"; } ?>">
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div class="content"><a href="spieler.php?s=1"><span class="tabItem"><?=OVERVIEW14?></span></a></div>
        </div>
        <div class="clear"></div>
    </div>
<?php } ?>