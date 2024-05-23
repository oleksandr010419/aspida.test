<div class="contentNavi subNavi tabFavorWrapper">
				<div <?php if(!isset($_GET['t'])) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content favor"><a href="build.php?id=<?php echo $id; ?>"><span class="tabItem"><img src="img/x.gif" class="favorIcon" alt="This tab is set as favourite."><?php echo SendResouces; ?></span></a></div>
				</div>
				<div <?php if(isset($_GET['t']) && $_GET['t'] == 1) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content favor"><a href="build.php?id=<?php echo $id; ?>&amp;t=1"><span class="tabItem"><img src="img/x.gif" class="favorIcon" alt="This tab is set as favourite."><?php echo Buyma; ?></span></a></div>
				</div>
				<div <?php if(isset($_GET['t']) && $_GET['t'] == 2) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content favor"><a href="build.php?id=<?php echo $id; ?>&amp;t=2"><span class="tabItem"><img src="img/x.gif" class="favorIcon" alt="This tab is set as favourite."><?php echo Offerma; ?></span></a></div>
				</div>
                <?php if($session->gold >= 3) { ?>
                <div <?php if(isset($_GET['t']) && $_GET['t'] == 3) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content favor"><a href="build.php?id=<?php echo $id; ?>&amp;t=3"><span class="tabItem"><img src="img/x.gif" class="favorIcon" alt="This tab is set as favourite."><?php echo ONPCtrading; ?></span></a></div>
				</div>
                <?php } ?>
				<?php if($session->goldclub == 1 && count($database->getProfileVillages($session->uid)) > 1) {
				?>
				<div <?php if(isset($_GET['t']) && $_GET['t'] == 4) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content favor"><a href="build.php?id=<?php echo $id; ?>&amp;t=4"><span class="tabItem"><img src="img/x.gif" class="favorIcon" alt="This tab is set as favourite."><?=rinok0?></span></a></div>
				</div>
				<?php
				}
				?>
        <div class="clear"></div>
</div>