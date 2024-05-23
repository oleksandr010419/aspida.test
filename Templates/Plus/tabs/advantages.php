<?php 
global $session;
$disabl = (!$session->right['s4']) ? 'disabled' : '';
$datetimep = $session->plust;
$datetime1 = $session->bonus1;
$datetime2 = $session->bonus2;
$datetime3 = $session->bonus3;
$datetime4 = $session->bonus4;
include 'tab_header.php';
echo getHeader('pros');
?>
<div class="contentBorder infoArea">
    <div class="contentBorder-tl">
    </div>
    <div class="contentBorder-tr">
    </div>
    <div class="contentBorder-tc">
    </div>
    <div class="contentBorder-ml">
    </div>
    <div class="contentBorder-mr">
    </div>
    <div class="contentBorder-mc">
    </div>
    <div class="contentBorder-bl">
    </div>
    <div class="contentBorder-br">
    </div>
    <div class="contentBorder-bc">
    </div>
    <div class="contentBorder-contents cf">
        <div class="premiumFeature Goldclub " style="display: block;">
            <h4>Gold club </h4>
            <div class="premiumFeatureDescription">
                <p>Gives advantages for the whole game round!</p>
                <p>Enable your merchants to automatically send resources multiple times, find slots with increased crop production faster on the map and archive your messages and reports. Use the farm list to manage your attacks and allow your troops to evade in case of an attack on your capital!</p>
            </div>
            <img class="prosGoldclubImage" src="img/x.gif">
        </div>
        <div class="premiumFeature Plus hide" style="display: none;">
            <h4>Plus </h4>
            <div class="premiumFeatureDescription">
                <p>Provides a better overview and other advantages for the time displayed!</p>
                <p>Adjust the game to your playing style with direct links and use the superior overview of the large map. Receive attack warnings and detailed information in the village overview. Order your merchants to automatically repeat a shipment for a second time around and queue an additional construction order!</p>
            </div>
            <img class="prosPlusImage" src="img/x.gif">
        </div>
        <div class="premiumFeature ProductionboostWood hide"
             style="display: none;">
            <h4>+25% lumber production </h4>
            <div class="premiumFeatureDescription">
                <p>Grants a 25% increase in production of the selected resource in all your villages for the duration displayed.</p>
                <p>The 25% bonus does not only apply to the base production of the resource, but it does apply to all other bonuses</p>
            </div>
            <img class="prosProductionboostWoodImage" src="img/x.gif">
        </div>
        <div class="premiumFeature ProductionboostClay hide"
             style="display: none;">
            <h4>+25% clay production </h4>
            <div class="premiumFeatureDescription">
                <p>Grants a 25% increase in production of the selected resource in all your villages for the duration displayed.</p>
                <p>The 25% bonus does not only apply to the base production of the resource, but it does apply to all other bonuses!</p>
            </div>
            <img class="prosProductionboostClayImage" src="img/x.gif">
        </div>
        <div class="premiumFeature ProductionboostIron hide"
             style="display: none;">
            <h4>+25% iron production</h4>
            <div class="premiumFeatureDescription">
                <p>Grants a 25% increase in production of the selected resource in all your villages for the duration displayed.</p>
                <p>The 25% bonus does not only apply to the base production of the resource, but it does apply to all other bonuses!</p>
            </div>
            <img class="prosProductionboostIronImage" src="img/x.gif">
        </div>
        <div class="premiumFeature ProductionboostCrop hide"
             style="display: none;">
            <h4>+25% crop production</h4>
            <div class="premiumFeatureDescription">
                <p>Grants a 25% increase in production of the selected resource in all your villages for the duration displayed.</p>
                <p>The 25% bonus does not only apply to the base production of the resource, but it does apply to all other bonuses!</p>
            </div>
            <img class="prosProductionboostCropImage" src="img/x.gif">
        </div>
    </div>
</div>
<div class="contentBorder contentArea">
    <div class="contentBorder-tl">
    </div>
    <div class="contentBorder-tr">
    </div>
    <div class="contentBorder-tc">
    </div>
    <div class="contentBorder-ml">
    </div>
    <div class="contentBorder-mr">
    </div>
    <div class="contentBorder-mc">
    </div>
    <div class="contentBorder-bl">
    </div>
    <div class="contentBorder-br">
    </div>
    <div class="contentBorder-bc">
    </div>
    <div class="contentBorder-contents cf">
        <div class="paymentPopupDialogWrapper">
            <h4 class="subHeadline">Please choose which advantage you would like to unlock::</h4>            
            <div class="featureCollection" id="featureCollectionWrapper">
				<div class="feature featureBooking ">
					<div class="dynamicContent hide" style="display: block;">
						<img src="img/x.gif" class="highlightArrow" alt="">
					</div>
					<input type="hidden" class="premiumFeatureName hide"
						   name="featureName" value="Goldclub">
					<div class="featureContent">
						<h3 class="featureTitle"><?= PLUS31 ?></h3>
						<div class="featureRemainingTime featureSubtitle subtitle">
								<span class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" alt="Gold" title="Gold"/>250</span>
						</div>
						<div class="featureButton">
							<?php
							if ($session->gold > 250) { 
								if (!$session->goldclub) {
									echo  getIDButton("buttonzEstawA5",PLUS12,$disabl,"gold");
								}
								else{
									echo noGoldButton(PLUS41);			
								}
							} else {
								echo noGoldButton(pluss27);
							}
							?>
							<script type="text/javascript">
								window.addEvent('domready', function ()
								{
									if ($('buttonzEstawA5'))
									{
										$('buttonzEstawA5').outerHTML = $('buttonzEstawA5').outerHTML;
										$('buttonzEstawA5').addEvent('click', function ()
										{
											window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "15", "context": "paymentWizard"}, "title": "Buy", "coins": 250, "id": "buttonzEstawA5"}]);
										});
									}
								});
							</script>
						</div>
						<div
							class="featureDuration featureRenewal featureButtonSubtitle subtitle">Bonus duration: <span class="bold">Whole game round!</span>
						</div>
					</div>
				</div>
							
				<div class="feature featureBooking premiumFeatureProductionBoost">
					<div class="dynamicContent hide" style="display: none;">
						<img src="img/x.gif" class="highlightArrow" alt="">
					</div>
					<input type="hidden" class="premiumFeatureName hide" name="featureName" value="Plus">
					<div class="featureContent">
						<h3 class="featureTitle"> <b><font color="#71D000"><?= P ?></font><font color="#FF6F0F"><?= L ?></font><font color="#71D000"><?= U ?></font><font
									color="#FF6F0F"><?= S ?></font></b> <?= pluss11 ?></h3>
						<div class="featureRemainingTime featureSubtitle subtitle">
							<span class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" alt="Gold" title="Gold"/>20</span>
							<span class="">
							<?php 
							$date2 = strtotime("NOW");

							if ($datetimep > time()) {
								$holdtotmin = (($datetimep - $date2) / 60);
								$holdtothr = (($datetimep - $date2) / 3600);
								$holdtotday = intval(($datetimep - $date2) / 86400);
								echo "<font color='#B3B3B3' size='1'>" . pluss28 . ": <b>" . $holdtotday . "</b> " . pluss29 . " ";

								$holdhr = intval(($holdtothr) - ($holdtotday * 24));
								echo " <b><span id='time8'>" . ($holdhr) . "</span></b> " . pluss30 . " ";

								$holdmr = intval(($holdtotmin) - (($holdhr * 60) + ($holdtotday * 1440)));
								echo "<b> " . ($holdmr) . "</b> " . pluss31 . "</font>";
							} else {
								print "<font color='#B3B3B3' size='1'><span id='ost8'></span><b><span id='time8'></span></b><span id='hour8'></span></font>";			
							}					
							?>
							</span>
						</div>
						<div class="featureButton">
							<?php
							if ($session->gold > 19) { 
								echo  getIDButton("buttondOLjuAy1Rt5QD",(($datetimep < $date2)?pluss25:pluss26),$disabl,"gold prosButton goldclub");
							} else {
								echo noGoldButton(pluss27);
							}
							?>
							<script type="text/javascript">
								window.addEvent('domready', function ()
								{
									if ($('buttondOLjuAy1Rt5QD'))
									{
										$('buttondOLjuAy1Rt5QD').outerHTML = $('buttondOLjuAy1Rt5QD').outerHTML;
										$('buttondOLjuAy1Rt5QD').addEvent('click', function ()
										{
											window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "8", "context": "paymentWizard"}, "title": "Buy", "coins": 20, "id": "buttondOLjuAy1Rt5QD"}]);
										});
									}
								});
							</script>
						</div>
						<div class="featureDuration featureRenewal featureButtonSubtitle subtitle">Duration: <span class="bold">
							<span class="dur">
							<?php 
							if (PLUS_TIME >= 86400) {
								echo '' . (PLUS_TIME / 86400) . ' ' . PLUS8 . '';
							} else if (PLUS_TIME < 86400) {
								echo '' . (PLUS_TIME / 3600) . ' ' . PLUS9 . ' ';
							}?>
							</span>
						</div>
					</div>
				</div>
				<div class="feature featureBooking premiumFeatureProductionBoost">
					<div class="dynamicContent hide" style="display: none;">
						<img src="img/x.gif" class="highlightArrow" alt="">
					</div>
					<input type="hidden" class="premiumFeatureName hide"
						   name="featureName" value="ProductionboostWood">
					<div class="featureContent">
						<h3 class="featureTitle">+<b>25</b>% <img class="r1" src="img/x.gif" alt="Lumber" title="Lumber"/> <?= pluss34 ?></h3>
						<div class="featureRemainingTime featureSubtitle subtitle">
							<span class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" alt="Gold" title="Gold"/>5</span>
							<span class="">
							<?php 
								$tl_b1 = $datetime1;
								if ($tl_b1 > $date2) {
									$holdtotmin1 = (($tl_b1 - $date2) / 60);
									$holdtothr1 = (($tl_b1 - $date2) / 3600);
									$holdtotday1 = intval(($tl_b1 - $date2) / 86400);
									$holdhr1 = intval($holdtothr1 - ($holdtotday1 * 24));
									$holdmr1 = intval($holdtotmin1 - (($holdhr1 * 60) + ($holdtotday1 * 1440)));
								}

								if ($tl_b1 < $date2) {
									print "<font color='#B3B3B3' size='1'><span id='ost9'></span><b><span id='time9'></span></b><span id='hour9'></span></font>";
								} else {

									echo "<font color='#B3B3B3' size='1'> " . pluss28 . " : <b> " . $holdtotday1 . "</b> " . pluss29 . " ";
									echo "<b>  <span id='time9'>" . ($holdhr1) . "</span></b> " . pluss30 . " ";
									echo "<b>  " . ($holdmr1) . "</b> " . pluss31 . "</font> ";
								}
							?>
							</span>
						</div>
						<div class="featureButton">
							<?php
							if ($session->gold > 4) { 
								echo  getIDButton("buttondtReswat8",(($tl_b1 < $date2)?pluss25:pluss26),$disabl,"gold");
							} else {
								echo noGoldButton(pluss27);
							}
							?>
							<script type="text/javascript">
								window.addEvent('domready', function ()
								{
									if ($('buttondtReswat8'))
									{
										$('buttondtReswat8').outerHTML = $('buttondtReswat8').outerHTML;
										$('buttondtReswat8').addEvent('click', function ()
										{
											window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "9", "context": "paymentWizard"}, "title": "Buy", "coins": 5, "id": "buttondtReswat8"}]);
										});
									}
								});
							</script>
						</div>
						<div class="featureDuration featureRenewal featureButtonSubtitle subtitle">Duration: <span class="bold">
							<span class="dur">
							<?php 
							if (PLUS_PRODUCTION >= 86400) {
								echo '' . (PLUS_PRODUCTION / 86400) . ' ' . PLUS8 . '';
							} else if (PLUS_PRODUCTION < 86400) {
								echo '' . (PLUS_PRODUCTION / 3600) . ' ' . PLUS9 . ' ';
							}?>
							</span>
						</div>
					</div>
				</div>
				<div class="feature featureBooking premiumFeatureProductionBoost">
					<div class="dynamicContent hide" style="display: none;">
						<img src="img/x.gif" class="highlightArrow" alt="">
					</div>
					<input type="hidden" class="premiumFeatureName hide"
						   name="featureName" value="ProductionboostClay">
					<div class="featureContent">
						<h3 class="featureTitle">+<b>25</b>% <img class="r2" src="img/x.gif" alt="Clay" title="Clay"/> <?= pluss35 ?></h3>
						<div class="featureRemainingTime featureSubtitle subtitle">
							<span class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" alt="Gold" title="Gold"/>5</span>
							<span class="">
							<?php 
								$tl_b2 = $datetime2;
								if ($tl_b2 > $date2) {
									$holdtotmin2 = (($tl_b2 - $date2) / 60);
									$holdtothr2 = (($tl_b2 - $date2) / 3600);
									$holdtotday2 = intval(($tl_b2 - $date2) / 86400);
									$holdhr2 = intval($holdtothr2 - ($holdtotday2 * 24));
									$holdmr2 = intval($holdtotmin2 - (($holdhr2 * 60) + ($holdtotday2 * 1440)));
								}

								if ($tl_b2 < $date2) {
									print "<font color='#B3B3B3' size='1'><span id='ost10'></span><b><span id='time10'></span></b><span id='hour10'></span></font>";
								} else {

									echo "<font color='#B3B3B3' size='1'>" . pluss28 . ": <b> " . $holdtotday2 . "</b> " . pluss29 . " ";
									echo "<b>  <span id='time10'>" . ($holdhr2) . "</span></b> " . pluss30 . " ";
									echo "<b>  " . ($holdmr2) . "</b> " . pluss31 . "<font>";
								}
							?>
							</span>
						</div>
						<div class="featureButton">
							<?php
							if ($session->gold > 4) { 
								echo  getIDButton("buttonf2jestAD",(($tl_b2 < $date2)?pluss25:pluss26),$disabl,"gold");
							} else {
								echo noGoldButton(pluss27);
							}
							?>
							<script type="text/javascript">
								window.addEvent('domready', function ()
								{
									if ($('buttonf2jestAD'))
									{
										$('buttonf2jestAD').outerHTML = $('buttonf2jestAD').outerHTML;
										$('buttonf2jestAD').addEvent('click', function ()
										{
											window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "10", "context": "paymentWizard"}, "title": "Buy", "coins": 5, "id": "buttonf2jestAD"}]);
										});
									}
								});
							</script>
						</div>
						<div class="featureDuration featureRenewal featureButtonSubtitle subtitle">Duration: <span class="bold">
							<span class="dur">
							<?php 
							if (PLUS_PRODUCTION >= 86400) {
								echo '' . (PLUS_PRODUCTION / 86400) . ' ' . PLUS8 . '';
							} else if (PLUS_PRODUCTION < 86400) {
								echo '' . (PLUS_PRODUCTION / 3600) . ' ' . PLUS9 . ' ';
							}?>
							</span>
						</div>
					</div>
				</div>
				<div class="feature featureBooking premiumFeatureProductionBoost">
					<div class="dynamicContent hide" style="display: none;">
						<img src="img/x.gif" class="highlightArrow" alt="">
					</div>
					<input type="hidden" class="premiumFeatureName hide" name="featureName" value="ProductionboostIron">
					<div class="featureContent">
						<h3 class="featureTitle">+<b>25</b>% <img class="r3" src="img/x.gif" alt="Iron" title="Iron"/><?= pluss36 ?></h3>
						<div class="featureRemainingTime featureSubtitle subtitle">
							<span class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" alt="Gold" title="Gold"/>5</span>
							<span class="">
							<?php 
								$tl_b3 = $datetime3;
								if ($tl_b3 > $date2) {
									$holdtotmin3 = (($tl_b3 - $date2) / 60);
									$holdtothr3 = (($tl_b3 - $date2) / 3600);
									$holdtotday3 = intval(($tl_b3 - $date2) / 86400);
									$holdhr3 = intval($holdtothr3 - ($holdtotday3 * 24));
									$holdmr3 = intval($holdtotmin3 - (($holdhr3 * 60) + ($holdtotday3 * 1440)));
								}

								if ($tl_b3 < $date2) {
									print "<font color='#B3B3B3' size='1'><span id='ost11'></span><b><span id='time11'></span></b><span id='hour11'></span></font>";
								} else {

									echo "<font color='#B3B3B3' size='1'>" . pluss28 . ": <b> " . $holdtotday3 . "</b> " . pluss29 . " ";
									echo "<b><span id='time11'>" . ($holdhr3) . "</span></b> " . pluss30 . " ";
									echo "<b>  " . ($holdmr3) . "</b> " . pluss31 . "</font>";
								}
							?>
							</span>
						</div>
						<div class="featureButton">
							<?php
							if ($session->gold > 4) { 
								echo  getIDButton("button2ecREsWu",(($tl_b3 < $date2)?pluss25:pluss26),$disabl,"gold");
							} else {
								echo noGoldButton(pluss27);
							}
							?>
							<script type="text/javascript">
								window.addEvent('domready', function ()
								{
									if ($('button2ecREsWu'))
									{
										$('button2ecREsWu').outerHTML = $('button2ecREsWu').outerHTML;
										$('button2ecREsWu').addEvent('click', function ()
										{
											window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "11", "context": "paymentWizard"}, "title": "Buy", "coins": 5, "id": "button2ecREsWu"}]);
										});
									}
								});
							</script>
						</div>
						<div class="featureDuration featureRenewal featureButtonSubtitle subtitle">Duration: <span class="bold">
							<span class="dur">
							<?php 
							if (PLUS_PRODUCTION >= 86400) {
								echo '' . (PLUS_PRODUCTION / 86400) . ' ' . PLUS8 . '';
							} else if (PLUS_PRODUCTION < 86400) {
								echo '' . (PLUS_PRODUCTION / 3600) . ' ' . PLUS9 . ' ';
							}?>
							</span>
						</div>
					</div>
				</div>
				<div class="feature featureBooking premiumFeatureProductionBoost">
					 <div class="dynamicContent hide" style="display: none;">
						<img src="img/x.gif" class="highlightArrow" alt="">
					</div>
					<input type="hidden" class="premiumFeatureName hide"
						   name="featureName" value="ProductionboostCrop">
					<div class="featureContent">
						<h3 class="featureTitle">+<b>25</b>% <img class="r4" src="img/x.gif" alt="Crop" title="Crop"/> <?= pluss37 ?></h3>
						<div class="featureRemainingTime featureSubtitle subtitle">
							<span class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" alt="Gold" title="Gold"/>5</span>
							<span class="">
							<?php 
								$tl_b4 = $datetime4;
								if ($tl_b4 > $date2) {
									$holdtotmin4 = (($tl_b4 - $date2) / 60);
									$holdtothr4 = (($tl_b4 - $date2) / 3600);
									$holdtotday4 = intval(($tl_b4 - $date2) / 86400);
									$holdhr4 = intval($holdtothr4 - ($holdtotday4 * 24));
									$holdmr4 = intval($holdtotmin4 - (($holdhr4 * 60) + ($holdtotday4 * 1440)));
								}

								if ($tl_b4 < $date2) {
									print "<font color='#B3B3B3' size='1'><span id='ost12'></span><b><span id='time12'></span></b><span id='hour12'></span></font>";
								} else {

									echo "<font color='#B3B3B3' size='1'>" . pluss28 . ": <b> " . $holdtotday4 . "</b> " . pluss29 . " ";
									echo "<b>  <span id='time12'>" . ($holdhr4) . "</span></b> " . pluss30 . " ";
									echo "<b>  " . ($holdmr4) . "</b> " . pluss31 . "</font>";
								}
							?>
							</span>
						</div>
						<div class="featureButton">
							<?php
							if ($session->gold > 4) { 
								echo  getIDButton("buttonspEyUs8a",(($tl_b4 < $date2)?pluss25:pluss26),$disabl,"gold");
							} else {
								echo noGoldButton(pluss27);
							}
							?>
							<script type="text/javascript">
								window.addEvent('domready', function ()
								{
									if ($('buttonspEyUs8a'))
									{
										$('buttonspEyUs8a').outerHTML = $('buttonspEyUs8a').outerHTML;
										$('buttonspEyUs8a').addEvent('click', function ()
										{
											window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "12", "context": "paymentWizard"}, "title": "Buy", "coins": 5, "id": "buttonspEyUs8a"}]);
										});
									}
								});
							</script>
						</div>
						<div class="featureDuration featureRenewal featureButtonSubtitle subtitle">Duration: <span class="bold">
							<span class="dur">
							<?php 
							if (PLUS_PRODUCTION >= 86400) {
								echo '' . (PLUS_PRODUCTION / 86400) . ' ' . PLUS8 . '';
							} else if (PLUS_PRODUCTION < 86400) {
								echo '' . (PLUS_PRODUCTION / 3600) . ' ' . PLUS9 . ' ';
							}?>
							</span>
						</div>
					</div>
				</div>
			</div>	
        </div>
    </div>
</div>
<?php include 'tab_info.php';
echo getTabs("pros");?>		
<?php include 'tab_footer.php';?>