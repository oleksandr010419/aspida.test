<br/><br/><div class="contentNavi tabNavi">
<div <?php if(!isset($_GET['t'])) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
<div class="background-start">&nbsp;</div>
<div class="background-end">&nbsp;</div>
<div class="content"><a href="build.php?id=<?php echo $id; ?>"><span class="tabItem"><?php echo RE4; ?></span></a></div>
</div>
<div <?php if(isset($_GET['t']) && $_GET['t'] == 2) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
<div class="background-start">&nbsp;</div>
<div class="background-end">&nbsp;</div>
<div class="content"><a href="build.php?id=<?php echo $id; ?>&amp;t=2"><span class="tabItem"><?php echo RE5; ?></span></a></div>
</div>
<div <?php if(isset($_GET['t']) && $_GET['t'] == 3) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
<div class="background-start">&nbsp;</div>
<div class="background-end">&nbsp;</div>
<div class="content"><a href="build.php?id=<?php echo $id; ?>&amp;t=3"><span class="tabItem"><?php echo RE6; ?></span></a></div>
</div>
<div <?php if(isset($_GET['t']) && $_GET['t'] == 4) { echo "class=\"container active\""; } else { echo "class=\"container normal\""; } ?>>
<div class="background-start">&nbsp;</div>
<div class="background-end">&nbsp;</div>
<div class="content"><a href="build.php?id=<?php echo $id; ?>&amp;t=4"><span class="tabItem"><?php echo RE7; ?></span></a></div>
</div><div class="clear"></div>
</div>