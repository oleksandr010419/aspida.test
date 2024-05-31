<div id="content" class="activate">
	<?php $tribe=isset($_GET['tribe']) ? $_GET['tribe'] : 3?>
	<h1 class="titleInHeader">Select your tribe</h1>
	<div class="mobileCover"></div>
	<!-- <h1 class="titleInHeader">Select your tribe</h1> -->

	<div class="activationWrapper activateGameWorldAccount selectTribe">

		<form method="post" action="first.php" id="activate">
				<div class="stepDescription selectTribe">
					Great empires begin with important decisions! Are you an attacker who loves competition? Or is your
					time
					investment rather low? Are you a team player who enjoys building up a thriving economy to forge the
					anvil?
				</div>
				<!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 540 250">
					<filter id="inset" x="0" y="0">
						<fegaussianblur stdDeviation="20" result="blur"></fegaussianblur>
						<fecomposite in2="SourceAlpha" operator="arithmetic" k2="-1" k3="1" result="shadowDiff">
						</fecomposite>
						<feflood flood-color="#bb8050"></feflood>
						<fecomposite in2="shadowDiff" operator="in"></fecomposite>
						<fecomposite in2="SourceGraphic" operator="over" result="firstfilter"></fecomposite>
						<feflood flood-color="#bb8050"></feflood>
						<fecomposite in2="shadowDiff" operator="in"></fecomposite>
						<fecomposite in2="firstfilter" operator="over" result="secondfilter"></fecomposite>
						<feflood flood-color="#bb8050"></feflood>
						<fecomposite in2="shadowDiff" operator="in"></fecomposite>
						<fecomposite in2="secondfilter" operator="over"></fecomposite>
					</filter>

					<g class="descriptionBoxWithArrow">
						<path class="outer" d="M10 10 V230 H157.20028200282002 l20 20 l20 -20 H530 V10 Z"
							data-original="M10 10 V230 H20 l20 20 l20 -20 H530 V10 Z"></path>
						<path class="inner" filter="url(#inset)"
							d="M10 10 V230 H157.20028200282002 l20 20 l20 -20 H530 V10 Z"
							data-original="M10 10 V230 H20 l20 20 l20 -20 H530 V10 Z"></path>
					</g>
				</svg> -->

				<div class="selection selectTribe">
					<!-- <div class="ornamentStart"></div> -->
					<input type="radio" name="vid" value="3" id="tribe_3" <?php echo ($tribe==3) ? 'checked=checked' : ''?> class="option0">
					<label class="tribe3" for="tribe_3"></label>
					<!-- <div class="tribeDescription" data-text="Recommended for new players">
						<h2>Gauls</h2>
						<ul>
							<li>Low time requirements</li>
							<li>Loot protection and good defense</li>
							<li>Excellent, fast cavalry</li>
							<li>Well suited to new players</li>
						</ul>
					</div> -->

					<input type="radio" name="vid" value="1" id="tribe_1" <?php echo ($tribe==1) ? 'checked=checked' : ''?> class="option1">
					<label class="tribe1" for="tribe_1"></label>
					<!-- <div class="tribeDescription">
						<h2>Romans</h2>
						<ul>
							<li>Moderate time requirements</li>
							<li>Can develop villages the fastest</li>
							<li>Very strong but expensive troops</li>
							<li>Hard to play for new players</li>
						</ul>
					</div> -->

					<input type="radio" name="vid" value="2" id="tribe_2" <?php echo ($tribe==2) ? 'checked=checked' : ''?> class="option2">
					<label class="tribe2" for="tribe_2"></label>
					<!-- <div class="tribeDescription">
						<h2>Teutons</h2>
						<ul>
							<li>High time requirements</li>
							<li>Good at looting in early game</li>
							<li>Strong, cheap infantry</li>
							<li>For aggressive players</li>
						</ul>
					</div> -->

					<input type="radio" name="vid" value="6" id="tribe_6" <?php echo ($tribe==6) ? 'checked=checked' : ''?> class="option3">
					<label class="tribe6" for="tribe_6"></label>
					<!-- <div class="tribeDescription">
						<h2>Egyptians</h2>
						<ul>
							<li>Low time requirements</li>
							<li>More resources available</li>
							<li>Excellent defensive units</li>
							<li>Well suited to new players</li>
						</ul>
					</div> -->

					<input type="radio" name="vid" value="7" id="tribe_7" <?php echo ($tribe==7) ? 'checked=checked' : ''?> class="option4">
					<label class="tribe7" for="tribe_7"></label>
					<!-- <div class="tribeDescription">
						<h2>Huns</h2>
						<ul>
							<li>High time requirements</li>
							<li>Impressively strong cavalry</li>
							<li>Reliant on others for protection</li>
							<li>Not recommended for new players!</li>
						</ul>
					</div> -->

					<input type="radio" name="vid" value="8" id="tribe_8" <?php echo ($tribe==8) ? 'checked=checked' : ''?> class="option5">
					<label class="tribe8" for="tribe_8"></label>
					<!-- <div class="tribeDescription">
						<h2>Spartans</h2>
						<ul>
							<li>High time requirements</li>
							<li>Impressively strong cavalry</li>
							<li>Reliant on others for protection</li>
							<li>Not recommended for new players!</li>
						</ul>
					</div> -->
					<div class="ornametEnd"></div>
					<div class="description tribeDescription">
						<div class="optionDescription option0 tribe3">
							<div class="recommended">
								<span class="text">Recommended for new players </span>
							</div>
							<h2>Gauls</h2>

							<ul>
								<li>Low time requirements</li>
								<li>Loot protection and good defense</li>
								<li>Excellent, fast cavalry</li>
								<li>Well suited to new players</li>
							</ul>
						</div>
						<div class="optionDescription option1 tribe1">
							<h2>Romans</h2>

							<ul>
								<li>Moderate time requirements</li>
								<li>Can develop villages the fastest</li>
								<li>Very strong but expensive troops</li>
								<li>Hard to play for new players</li>
							</ul>
						</div>
						<div class="optionDescription option2 tribe2">
							<h2>Teutons</h2>

							<ul>
								<li>High time requirements</li>
								<li>Good at looting in early game</li>
								<li>Strong, cheap infantry</li>
								<li>For aggressive players</li>
							</ul>
						</div>
						<div class="optionDescription option3 tribe6">
							<h2>Egyptians</h2>

							<ul>
								<li>Low time requirements</li>
								<li>More resources available</li>
								<li>Excellent defensive units</li>
								<li>Well suited to new players</li>
							</ul>
						</div>
						<div class="optionDescription option4 tribe7">
							<h2>Huns</h2>

							<ul>
								<li>High time requirements</li>
								<li>Impressively strong cavalry</li>
								<li>Reliant on others for protection</li>
								<li>Not recommended for new players!</li>
							</ul>
						</div>
						<div class="optionDescription option5 tribe8">
							<h2>Spartans</h2>
							<ul>
								<li>High time requirements</li>
								<li>Impressively strong cavalry</li>
								<li>Reliant on others for protection</li>
								<li>Not recommended for new players!</li>
							</ul>
						</div>
					</div>
					<!-- <div id="selectionIndicator" style="left: 92px;"></div> -->
					
				</div>
				<div class="buttonWrapper selectTribe">
	
					<button type="submit" value="Confirm" id="button599547e104f2b" class="textButtonV2 green  buttonFramed withText rectangle">
						<div class="button-container addHoverClick">
							<div class="button-background">
								<div class="buttonStart">
									<div class="buttonEnd">
										<div class="buttonMiddle"></div>
									</div>
								</div>
							</div>
							<div class="button-content">Confirm</div>
						</div>
					</button>
					<script type="text/javascript" id="button599547e104f2b_script">
						jQuery(document).ready(function () {
							if ($('button599547e104f2b')) {
								$('button599547e104f2b').addEvent('click', function () {
									window.fireEvent('buttonClicked', [this, { "type": "submit", "value": "Confirm", "name": "", "id": "button599547e104f2b", "class": "orange ", "title": "", "confirm": "", "onclick": "" }]);
								});
							}
						});
					</script>
	
				</div>


		</form>

	</div>

	<script type="text/javascript">
		jQuery(document).ready(function () {
			new Travian.Game.Activation();
		});
	</script>


	<div id="tpixeliframe_loading"
		style="display: none; z-index: 1000; position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; background-color: rgb(0, 0, 0); opacity: 0.4;">
	</div>
	<script type="text/javascript">
		//<!--
		var tg_load_handler = function () {
			document.getElementById("tpixeliframe_loading").style.display = "none";
		};
		tg_load_handler.delay(1000);

		window.onload = function () {
			tg_iframe = document.getElementById("tpixeliframe");
			tg_iframe.onload = tg_load_handler;
		};
		document.getElementById("tpixeliframe_loading").style.display = "block";
		//-->
	</script>
	<div class="clear"></div>
</div>