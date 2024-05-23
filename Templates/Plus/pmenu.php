<h1 class="titleInHeader"><?=Aspida?> <font color="#71D000"><?=P?></font><font color="#FF6F0F"><?=L?></font><font  color="#71D000"><?=U?></font><font color="#FF6F0F"><?=S?></font></h1>
        <div class="contentNavi subNavi">
            <div title="" class="container <?php if(isset($_GET['id']) && $_GET['id'] == 3) {echo "active";}else{echo "normal";} ?>">
                <div class="background-start">&nbsp;</div>
                <div class="background-end">&nbsp;</div>
                <div class="content"><a href="plus.php?id=3"><span class="tabItem"> <?=pluss22?></span></a></div>
            </div>
              <div title="" class="container <?php if(isset($_GET['id']) && $_GET['id'] == 6) {echo "active";}else{echo "normal";} ?>">
                <div class="background-start">&nbsp;</div>
                <div class="background-end">&nbsp;</div>
                <div class="content"><a href="plus.php?id=6"><span class="tabItem"> <?php echo "Bank"; ?></span></a></div>
            </div>
            <div title="" class="container <?php if(isset($_GET['id']) && $_GET['id'] == 5) {echo "active";}else{echo "normal";} ?>">
                <div class="background-start">&nbsp;</div>
                <div class="background-end">&nbsp;</div>
                <div class="content"><a href="plus.php?id=5"><span class="tabItem"> <?=pluss23?></span></a></div>
            </div>
			
			<?php
             if(EXTRA_MENU) {?>
            <div title="" class="container <?php if(isset($_GET['id']) && $_GET['id'] == 7) {echo "active";}else{echo "normal";} ?>">
                <div class="background-start">&nbsp;</div>
                <div class="background-end">&nbsp;</div>
                <div class="content"><a href="more.php?id=7"><span class="tabItem">Extra plus</span></a></div>
            </div>
            <div title="" class="container <?php if(isset($_GET['id']) && $_GET['id'] == 8) {echo "active";}else{echo "normal";} ?>">
                <div class="background-start">&nbsp;</div>
                <div class="background-end">&nbsp;</div>
                <div class="content">
                <?php if ($village->pop > 1000) { ?>
                <a href="buytroops.php?id=8"><span class="tabItem">Buy troops</span></a>
                <?php } else { ?>
                <a href="#" onclick='alert("You need at least 1000 (<?=$village->pop?> now) population to use this function.");'><span class="tabItem">Buy troops</span></a>
                <?php } ?>
                </div>
            </div>
			<div title="" class="container <?php if(isset($_GET['id']) && $_GET['id'] == 20) {echo "active";}else{echo "normal";} ?>">
                <div class="background-start">&nbsp;</div>
                <div class="background-end">&nbsp;</div>
                <div class="content"><a href="buynature.php?id=20"><span class="tabItem"> Buy Animals</span></a></div>
            </div>
            <div title="" class="container <?php if(isset($_GET['id']) && $_GET['id'] == 9) {echo "active";}else{echo "normal";} ?>">
                <div class="background-start">&nbsp;</div>
                <div class="background-end">&nbsp;</div>
                <div class="content"><a href="buyresources.php?id=9"><span class="tabItem">Resources</span></a></div>
            </div>
			
			<?php } ?>
            <div class="clear"></div>
        </div>