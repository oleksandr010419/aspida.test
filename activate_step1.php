<div id="content" class="activate">
	<div class="dynamicTitles">
		<div class="selectTribe active">
			<h1 class="titleInHeader">Select your tribe</h1>
		</div>

		<div class="selectSector">
			<h1 class="titleInHeader selectSector">Select Starting Position</h1>
		</div>

		<div class="confirm">
			<h1 class="titleInHeader confirm">Confirm your selection</h1>
		</div>
	</div>
	<div class="mobileCover"></div>
	<!-- <h1 class="titleInHeader">Select your tribe</h1> -->

	<div class="activationWrapper activateGameWorldAccount selectTribe">

		Great empires begin with important decisions! Are you an attacker who loves competition? Or is your time
		investment rather low? Are you a team player who enjoys building up a thriving economy to forge the anvil?
		<form method="post" action="first.php">

			<div id="presentation" class="steps">

				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 540 250">
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
				</svg>

				<div id="tribeSelectors">

					<input type="radio" name="vid" value="3" id="tribe3" checked="checked">
					<label class="selector" for="tribe3"></label>
					<div class="tribeDescription" data-text="Recommended for new players">
						<h2>Gauls</h2>
						<ul>
							<li>Low time requirements</li>
							<li>Loot protection and good defense</li>
							<li>Excellent, fast cavalry</li>
							<li>Well suited to new players</li>
						</ul>
					</div>

					<input type="radio" name="vid" value="1" id="tribe1">
					<label class="selector" for="tribe1"></label>
					<div class="tribeDescription">
						<h2>Romans</h2>
						<ul>
							<li>Moderate time requirements</li>
							<li>Can develop villages the fastest</li>
							<li>Very strong but expensive troops</li>
							<li>Hard to play for new players</li>
						</ul>
					</div>

					<input type="radio" name="vid" value="2" id="tribe2">
					<label class="selector" for="tribe2"></label>
					<div class="tribeDescription">
						<h2>Teutons</h2>
						<ul>
							<li>High time requirements</li>
							<li>Good at looting in early game</li>
							<li>Strong, cheap infantry</li>
							<li>For aggressive players</li>
						</ul>
					</div>

					<input type="radio" name="vid" value="6" id="tribe6">
					<label class="selector" for="tribe6"></label>
					<div class="tribeDescription">
						<h2>Egyptians</h2>
						<ul>
							<li>Low time requirements</li>
							<li>More resources available</li>
							<li>Excellent defensive units</li>
							<li>Well suited to new players</li>
						</ul>
					</div>

					<input type="radio" name="vid" value="7" id="tribe7">
					<label class="selector" for="tribe7"></label>
					<div class="tribeDescription">
						<h2>Huns</h2>
						<ul>
							<li>High time requirements</li>
							<li>Impressively strong cavalry</li>
							<li>Reliant on others for protection</li>
							<li>Not recommended for new players!</li>
						</ul>
					</div>

					<input type="radio" name="vid" value="8" id="tribe8">
					<label class="selector" for="tribe8"></label>
					<div class="tribeDescription">
						<h2>Spartans</h2>
						<ul>
							<li>High time requirements</li>
							<li>Impressively strong cavalry</li>
							<li>Reliant on others for protection</li>
							<li>Not recommended for new players!</li>
						</ul>
					</div>

				</div>

			</div>

			<div class="buttonContainer">

				<button type="submit" value="Confirm" id="button599547e104f2b" class="orange ">
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
					window.addEvent('domready', function () {
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
		window.addEvent('domready', function () {
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