<?php
$bid = $village->resarray['f'.$id.'t'];
$bindicate = $building->canBuild($id,$bid);
$dorf = ($id<=18)? "dorf1.php": "dorf2.php";

if($bindicate == 1) {
	echo "<p><span class=\"none\">".UPG0."</span></p>";
} else if($bindicate == 10) {
	echo "<p><span class=\"none\">".UPG1."</span></p>";
} else if($bindicate == 11) {
	echo "<p><span class=\"none\">".UPG2."</span></p>";
} else {
	$uprequire = $building->resourceRequired($id,$village->resarray['f'.$id.'t'],1+$loopsame+$doublebuild+$master);

	$time=time();
	?>
	<div id="contract" class="contractWrapper">
		<?php /*<div class="contractText"><b><?=UPG3?></b> <?=UPG4?> <?php echo $village->resarray['f'.$id]+($loopsame > 0 ? 2:1)+$doublebuild+$master; ?> </div>*/?>
		<div class="contractCosts">
			<div class="showCosts centeredText">
				<span class="resources r1"><img class="r1" src="img/x.gif" title="<?=LUMBER?>"><?php echo $uprequire['wood']; ?></span>
				<span class="resources r2"><img class="r2" src="img/x.gif" title="<?=CLAY?>"><?php echo $uprequire['clay']; ?></span>
				<span class="resources r3"><img class="r3" src="img/x.gif" title="<?=IRON?>"><?php echo $uprequire['iron']; ?></span>
				<span class="resources r4"><img class="r4" src="img/x.gif" title="<?=CROP?>"><?php echo $uprequire['crop']; ?></span>
				<span class="resources r5"><img class="r5" src="img/x.gif" title="<?=build45?>"><?php echo $uprequire['pop']; ?></span>
				<div class="clear"></div>
				<div class="sections">
					<div class="section1">					
					<?php 
						if($bindicate == 2) {
							echo "<span class=\"errorMessage\">".UPG5."</span>";
						}
						else if($bindicate == 3) {
							echo "<span class=\"errorMessage\">".UPG6."</span>";
						}
						else if($bindicate == 4) {
							echo "<span class=\"errorMessage\">".UPG7."</span>";
						}
						else if($bindicate == 5) {
							echo "<span class=\"errorMessage\">".UPG8."</span>";
						}
						else if($bindicate == 6) {
							echo "<span class=\"errorMessage\">".UPG9."</span>";
						}
						else if($bindicate == 7) {
							$neededtime = $building->calculateAvaliable($id,$village->resarray['f'.$id.'t'],1+$loopsame+$doublebuild+$master);
							if($neededtime==0){echo "<span class=\"errorMessage\">".UPG10."</span>";}else{
							echo "<span class=\"errorMessage\"><div class=\"statusMessage\">Enough resources  ".$neededtime[0]." at  ".$neededtime[1]."</div></span>";}
						}?>
					</div>
					<?php
						/*<img class="clock" src="img/x.gif" title="<?=punktsb1?>">					
						echo $generator->getTimeFormat($uprequire['time']);*/
						if($bindicate == 7) {
						$wood = round($village->awood);
						$clay = round($village->aclay);
						$iron = round($village->airon);
						$crop = round($village->acrop);

						$totalres = $uprequire['wood']+$uprequire['clay']+$uprequire['iron']+$uprequire['crop'];
						$availres = $wood+$clay+$iron+$crop;
						if($availres >= $totalres){ $style = "npc"; } else { $style = "npc_inactive"; $disable = "disabled=\"disabled\""; }
						if($session->gold >= 3 && $building->getTypeLevel(17) >= 1) {
						echo npcButton($uprequire['wood'],$uprequire['clay'],$uprequire['iron'],$uprequire['crop']);
						}
					}?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	<?php
		if($bindicate == 8 || $bindicate == 9){ ?>
			<div class="upgradeButtonsContainer">
				<div class="section1">
					<button type="button" value="Upgrade to level <?php echo $village->resarray['f'.$id]+1; ?>" class="green build" onclick="window.location.href = '<?php echo $dorf;?>?а=<?php echo $id;?>&c=<?php echo $session->checker;?>'; return false;">
						<div class="button-container addHoverClick">
							<div class="button-background">
								<div class="buttonStart">
									<div class="buttonEnd">
										<div class="buttonMiddle"></div>
									</div>
								</div>
							</div>
							<div class="button-content"><?php echo UPG11 . (($bindicate==8)? $village->resarray['f'.$id]+1: ($village->resarray['f'.$id]+($loopsame > 0 ? 2:1))); ?></div>
						</div>
					</button>
					<?php echo ($bindicate == 9)?"<span class=\"none\">(Waiting loop)</span>":"";?>
					<div class="clear"></div>
					<span class="clocks"><img class="clock" src="img/x.gif" alt="duration"><?php echo $generator->getTimeFormat($uprequire['time']);?></span>    
				</div>
				<div class="section2">
					<?php 
					if($bindicate == 88 || ($session->goldclub && $building->master==0 && $bindicate < 8)) {?>
						
					<?php }
					?>
				</div>
				<div class="clear"></div>
			</div>
	<?php }
	if($bindicate == 88 || ($session->goldclub && $building->master==0 && $bindicate < 8)) {?>
		<button type="button" value="Upgrade to level <?php echo $village->resarray['f'.$id]+($loopsame > 0 ? 2:1)+$doublebuild+$master; ?>" class="gold builder" onclick="window.location.href = '<?php echo $dorf;?>?а=<?php echo $id;?>&c=<?php echo $session->checker;?>'; return false;">
			<div class="button-container addHoverClick">
				<div class="button-background">
					<div class="buttonStart">
						<div class="buttonEnd">
							<div class="buttonMiddle"></div>
						</div>
					</div>
				</div>
				<div class="button-content"><?php echo master_build_1;?></div>
			</div>
		</button>
	<?php }?>
	</div>
<?php } ?>