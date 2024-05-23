<div class="contentNavi subNavi ">
    <div class="container <?php if(!isset($_GET['s'])){echo 'active';}else{ echo 'normal';}?>" title="">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content favor favorKey0">

            <a class="tabItem" href="<?php if($session->plus){ echo 'dorf3.php';}?>" id="villageOverViewTab1">
                <?=dorf0?>											<img ="Эта вкладка установлена избранной" class="favorIcon" src="img/x.gif">
            </a>
        </div>
    </div>

    <div class="container  <?php if(!$session->plus){ echo 'gold';}?> <?php if($_GET['s'] == 2){echo 'active';}else{ echo 'normal';}?> ">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content favor favorKey2">

            <a class="tabItem" href="<?php if($session->plus){ echo 'dorf3.php?s=2';}?>" id="villageOverViewTab2">
                <?=dorf1?>											<img ="Эта вкладка установлена избранной" class="favorIcon" src="img/x.gif">
            </a>
        </div>
    </div>

    <div class="container  <?php if(!$session->plus){ echo 'gold';}?> <?php if($_GET['s'] == 3){echo 'active';}else{ echo 'normal';}?> ">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content favor favorKey3">

            <a class="tabItem" href="<?php if($session->plus){ echo 'dorf3.php?s=3';}?>" id="villageOverViewTab3">
                <?=dorf2?>											<img ="Эта вкладка установлена избранной" class="favorIcon" src="img/x.gif">
            </a>
        </div>
    </div>

    <div class="container  <?php if(!$session->plus){ echo 'gold';}?> <?php if($_GET['s'] == 4){echo 'active';}else{ echo 'normal';}?> ">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content favor favorKey4">

            <a class="tabItem" href="<?php if($session->plus){ echo 'dorf3.php?s=4';}?>" id="villageOverViewTab4">
                <?=dorf3?>											<img ="Эта вкладка установлена избранной" class="favorIcon" src="img/x.gif">
            </a>
        </div>
    </div>


    <div class="container  <?php if(!$session->plus){ echo 'gold';}?> <?php if($_GET['s'] == 5){echo 'active';}else{ echo 'normal';}?> ">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content favor favorKey5">

            <a class="tabItem" href="<?php if($session->plus){ echo 'dorf3.php?s=5';}?>" id="villageOverViewTab5">
                <?=dorf4?>											<img ="Эта вкладка установлена избранной" class="favorIcon" src="img/x.gif">
            </a>
        </div>
    </div>

    <div class="clear"></div>
</div>
