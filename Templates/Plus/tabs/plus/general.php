<?php
$today = time();
$disabl = (!$session->right['s4']) ? 'disabled' : '';
$datetimep = $session->plust;
$datetime1 = $session->bonus1;
$datetime2 = $session->bonus2;
$datetime3 = $session->bonus3;
$datetime4 = $session->bonus4;
?>
<div class="paymentWizardMenu " id="generalOptions">
<span id="plushour" style="display: none;" ><?= PLUS_TIME / 3600 ?></span>
<span id="offdefhour" style="display: none;" ><?= OFF_DEF_TIME / 3600 ?></span>
<div class="feature featureBooking ">
	<input type="hidden" class="premiumFeatureName hide" name="featureName" value="buyAdventure">
	<div class="featureContent">
		<h3 class="featureTitle">Buy an adventure</h3>
		<div class="featureRemainingTime featureSubtitle subtitle">
			<span class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" alt="Gold" title="Gold"/>2</span>
		</div>
		<div class="featureButton">
			<?php
			if (!empty($session->gold)) {
				if ($session->gold >= 2) {
					echo  getIDButton("buttonpa5reTHe","Buy",false,"green");
				} else {
					echo getButton("Low gold", '', true);
				}
			}
			?>
			<script type="text/javascript">
				window.addEvent('domready', function ()
				{
					if ($('buttonpa5reTHe'))
					{
						$('buttonpa5reTHe').outerHTML = $('buttonpa5reTHe').outerHTML;
						$('buttonpa5reTHe').addEvent('click', function ()
						{
							window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "51", "context": "paymentWizard"}, "title": "Buy", "coins": 2, "id": "buttonpa5reTHe"}]);
						});
					}
				});
			</script>
		</div>
		<div class="featureDuration featureRenewal featureButtonSubtitle subtitle">Duration: <span class="bold">
			<span class="dur">Instant</span>
		</div>
	</div>
</div>
<div class="feature featureBooking ">
	<input type="hidden" class="premiumFeatureName hide" name="featureName" value="buyOffence">
	<div class="featureContent">
		<h3 class="featureTitle">+<b><?php echo OFFENSE1_BONUS;?></b>% <img class="iReport iReport3" src="img/x.gif" alt="Offence bonus" title="Offence bonus"/> <?= pluss39 ?></h3>
		<div class="featureRemainingTime featureSubtitle subtitle">
			<span class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" alt="Gold" title="Gold"/><?php echo OFFENSE1_COST;?></span>
			<span class="">
			<?php 
				$tl_o1 = $session->offbonus;
				if ($tl_o1 > $today) {
					$holdtotmino1 = (($tl_o1 - $today) / 60);
					$holdtothro1 = (($tl_o1 - $today) / 3600);
					$holdtotdayo1 = intval(($tl_o1 - $today) / 86400);
					$holdhro1 = intval($holdtothro1 - ($holdtotdayo1 * 24));
					$holdmro1 = intval($holdtotmino1 - (($holdhro1 * 60) + ($holdtotdayo1 * 1440)));
				}

				if ($tl_o1 < $today) {
					print "<font color='#B3B3B3' size='1'><span id='ost21'></span><b><span id='time21'></span></b><span id='hour21'></span></font>";
				} else {

					echo "<font color='#B3B3B3' size='1'>" . pluss28 . ": <b> " . $holdtotdayo1 . "</b> " . pluss29 . " ";
					echo "<b>  <span id='time21'>" . ($holdhro1) . "</span></b> " . pluss30 . " ";
					echo "<b>  " . ($holdmro1) . "</b> " . pluss31 . "</font>";
				}
			?>
			</span>
		</div>
		<div class="featureButton">
			<?php
			if ($session->gold > OFFENSE1_COST) { 
				echo  getIDButton("buttonze4weTrU",(($tl_o1 < $today)?pluss25:pluss26),$disabl,"green");
			} else {
				echo noGoldButton(pluss27);
			}
			?>
			<script type="text/javascript">
				window.addEvent('domready', function ()
				{
					if ($('buttonze4weTrU'))
					{
						$('buttonze4weTrU').outerHTML = $('buttonze4weTrU').outerHTML;
						$('buttonze4weTrU').addEvent('click', function ()
						{
							window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "21", "context": "paymentWizard"}, "title": "Buy", "coins": <?php echo OFFENSE1_COST;?>, "id": "buttonze4weTrU"}]);
						});
					}
				});
			</script>
		</div>
		<div class="featureDuration featureRenewal featureButtonSubtitle subtitle">Duration: <span class="bold">
			<span class="dur">
			<?php 
			if (OFF_DEF_TIME >= 86400) {
				echo '' . (OFF_DEF_TIME / 86400) . ' ' . PLUS8 . '';
			} else if (OFF_DEF_TIME < 86400) {
				echo '' . (OFF_DEF_TIME / 3600) . ' ' . PLUS9 . ' ';
			}?>
			</span>
		</div>
	</div>
</div>
<div class="feature featureBooking ">
	<input type="hidden" class="premiumFeatureName hide" name="featureName" value="buyDefence">
	<div class="featureContent">
		<h3 class="featureTitle">+<b><?php echo DEFENCE1_BONUS;?></b>% <img class="iReport iReport5" src="img/x.gif" alt="Defence bonus" title="Defence bonus"/> <?= pluss40 ?></h3>
		<div class="featureRemainingTime featureSubtitle subtitle">
			<span class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" alt="Gold" title="Gold"/><?php echo OFFENSE1_COST;?></span>
			<span class="">
			<?php 
				$tl_d1 = $session->defbonus;
				if ($tl_d1 > $today) {
					$holdtotmind1 = (($tl_d1 - $today) / 60);
					$holdtothrd1 = (($tl_d1 - $today) / 3600);
					$holdtotdayd1 = intval(($tl_d1 - $today) / 86400);
					$holdhrd1 = intval($holdtothrd1 - ($holdtotdayd1 * 24));
					$holdmrd1 = intval($holdtotmind1 - (($holdhrd1 * 60) + ($holdtotdayd1 * 1440)));
				}

				if ($tl_d1 < $today) {
					print "<font color='#B3B3B3' size='1'><span id='ost21'></span><b><span id='time21'></span></b><span id='hour21'></span></font>";
				} else {

					echo "<font color='#B3B3B3' size='1'>" . pluss28 . ": <b> " . $holdtotdayd1 . "</b> " . pluss29 . " ";
					echo "<b>  <span id='time21'>" . ($holdhrd1) . "</span></b> " . pluss30 . " ";
					echo "<b>  " . ($holdmrd1) . "</b> " . pluss31 . "</font>";
				}
			?>
			</span>
		</div>
		<div class="featureButton">
			<?php
			if ($session->gold > DEFENCE1_COST) { 
				echo  getIDButton("buttonswuHah6F",(($tl_d1 < $today)?pluss25:pluss26),$disabl,"green");
			} else {
				echo noGoldButton(pluss27);
			}
			?>
			<script type="text/javascript">
				window.addEvent('domready', function ()
				{
					if ($('buttonswuHah6F'))
					{						
						$('buttonswuHah6F').outerHTML = $('buttonswuHah6F').outerHTML;
						$('buttonswuHah6F').addEvent('click', function ()
						{
							window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "31", "context": "paymentWizard"}, "title": "Buy", "coins": <?php echo DEFENCE1_COST;?>, "id": "buttonswuHah6F"}]);
						});
					}
				});
			</script>
		</div>
		<div class="featureDuration featureRenewal featureButtonSubtitle subtitle">Duration: <span class="bold">
			<span class="dur">
			<?php 
			if (OFF_DEF_TIME >= 86400) {
				echo '' . (OFF_DEF_TIME / 86400) . ' ' . PLUS8 . '';
			} else if (OFF_DEF_TIME < 86400) {
				echo '' . (OFF_DEF_TIME / 3600) . ' ' . PLUS9 . ' ';
			}?>
			</span>
		</div>
	</div>
</div>
<div class="feature featureBooking ">
	<input type="hidden" class="premiumFeatureName hide" name="featureName" value="npc">
	<div class="featureContent">
		<h3 class="featureTitle"><?= PLUS19 ?></h3>
		<div class="featureRemainingTime featureSubtitle subtitle">
			<span class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" alt="Gold" title="Gold"/>3</span>
			<span class="">
			
			</span>
		</div>
		<div class="featureButton">
			<?php
			if ($session->gold > 2) { 
				echo  getAjaxButton(PLUS21,"window.location.href = 'build.php?gid=17&t=3';",$disabl,"green","action");
			} else {
				echo noGoldButton(pluss27);
			}
			?>
		</div>
		<div class="featureDuration featureRenewal featureButtonSubtitle subtitle">Duration: <span class="bold">
			<span class="dur"><?= PLUS20 ?></span>
		</div>
	</div>
</div>
<div class="feature featureBooking ">
	<input type="hidden" class="premiumFeatureName hide" name="featureName" value="completeResearch">
	<div class="featureContent">
		<h3 class="featureTitle"><?= PLUS24 ?></h3>
		<div class="featureRemainingTime featureSubtitle subtitle">
			<span class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" alt="Gold" title="Gold"/>2</span>
			<span class="">
			
			</span>
		</div>
		<div class="featureButton">
			<?php
			if ($session->gold > 1) { 
				echo  getIDButton("buttonstaBU3ux",pluss25,$disabl,"green");
			} else {
				echo noGoldButton(pluss27);
			}
			?>
			<script type="text/javascript">
				window.addEvent('domready', function ()
				{
					if ($('buttonstaBU3ux'))
					{
						$('buttonstaBU3ux').outerHTML = $('buttonswuHah6F').outerHTML;
						$('buttonstaBU3ux').addEvent('click', function ()
						{
							window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "7", "context": "paymentWizard"}, "title": "Buy", "coins": 2, "id": "buttonstaBU3ux"}]);
						});
					}
				});
			</script>
		</div>
		<div class="featureDuration featureRenewal featureButtonSubtitle subtitle">Duration: <span class="bold">
			<span class="dur"><?= PLUS20 ?></span>
		</div>
	</div>
</div>
<?php if (SELL_RES) { ?>
<div class="feature featureBooking ">
	<input type="hidden" class="premiumFeatureName hide" name="featureName" value="buyRes">
	<div class="featureContent">
		<h3 class="featureTitle"><?= PLUS28 ?> <?= HOWRES ?> <?= PLUS29 ?></h3>
		<div class="featureRemainingTime featureSubtitle subtitle">
			<span class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" alt="Gold" title="Gold"/><?= COSTRES ?></span>
			<span class="">
			
			</span>
		</div>
		<div class="featureButton">
			<?php
			if ($session->gold > COSTRES) { 
				 echo  getIDButton("buttonhe4ugUSw",PLUS26,$disabl,"green");
			} else {
				echo noGoldButton(pluss27);
			}
			?>
			<script type="text/javascript">
				window.addEvent('domready', function ()
				{
					if ($('buttonhe4ugUSw'))
					{
						$('buttonhe4ugUSw').outerHTML = $('buttonhe4ugUSw').outerHTML;
						$('buttonhe4ugUSw').addEvent('click', function ()
						{
							window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "13", "context": "paymentWizard"}, "title": "Buy", "coins": <?php echo COSTRES;?>, "id": "buttonhe4ugUSw"}]);
						});
					}
				});
			</script>
		</div>
		<div class="featureDuration featureRenewal featureButtonSubtitle subtitle">Duration: <span class="bold">
			<span class="dur"><?= PLUS20 ?></span>
		</div>
	</div>
</div>
<?php } ?>
<?php if (SELL_CP) { ?>
<div class="feature featureBooking ">
	<input type="hidden" class="premiumFeatureName hide" name="featureName" value="buyCP">
	<div class="featureContent">
		<h3 class="featureTitle"><?= PLUS26 ?> <?= HOWCP ?> <?= PLUS27 ?></h3>
		<div class="featureRemainingTime featureSubtitle subtitle">
			<span class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" alt="Gold" title="Gold"/><?= COSTCP ?></span>
			<span class="">
			
			</span>
		</div>
		<div class="featureButton">
			<?php
			if ($session->gold > COSTCP) { 
				 echo  getIDButton("buttoncRuD4eku",PLUS20,$disabl,"green");
			} else {
				echo noGoldButton(pluss27);
			}
			?>
			<script type="text/javascript">
				window.addEvent('domready', function ()
				{
					if ($('buttoncRuD4eku'))
					{
						$('buttoncRuD4eku').outerHTML = $('buttoncRuD4eku').outerHTML;
						$('buttoncRuD4eku').addEvent('click', function ()
						{
							window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "6", "context": "paymentWizard"}, "title": "Buy", "coins": <?php echo COSTCP;?>, "id": "buttoncRuD4eku"}]);
						});
					}
				});
			</script>
		</div>
		<div class="featureDuration featureRenewal featureButtonSubtitle subtitle">Duration: <span class="bold">
			<span class="dur"><?= PLUS20 ?></span>
		</div>
	</div>
</div> 
<?php } ?>
</div> 
 