<div class="contentNavi tabNavi">
				<div class="container <?php if(isset($_GET['action']) && $_GET['action'] == 'buy') { echo "active"; } else { echo "normal"; } ?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_auction.php?action=buy"><span class="tabItem"><?=HEROAC30?></span></a></div>
				</div>
				<div class="container <?php if(isset($_GET['action']) && $_GET['action'] == 'sell') { echo "active"; } else { echo "normal"; } ?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_auction.php?action=sell"><span class="tabItem"><?=HEROAC31?></span></a></div>
				</div>
				<div class="container <?php if(isset($_GET['action']) && $_GET['action'] == 'bids') { echo "active"; } else { echo "normal"; } ?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_auction.php?action=bids"><span class="tabItem"><?=HEROAC32?></span></a></div>
				</div>
				<div class="container <?php if(isset($_GET['action']) && $_GET['action'] == 'delete') { echo "active"; } else { echo "normal"; } ?>">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_auction.php?action=delete"><span class="tabItem"><?=HEROAC45?></span></a></div>
				</div><div class="clear"></div>
</div>