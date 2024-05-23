<div id="content" class="activate">
								<h1 class="titleInHeader">Ready to rule the world?</h1>
	<a id="backButton" class="contentTitleButton" href="/first.php?step=2"></a>

<div class="activationScreen">
	<form method="post" action="first.php">

        <div id="presentation" class="confirmation">

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 540 250">
                <filter id="inset" x="0" y="0">
                    <fegaussianblur stdDeviation="20" result="blur"></fegaussianblur>
                    <fecomposite in2="SourceAlpha" operator="arithmetic" k2="-1" k3="1" result="shadowDiff"></fecomposite>
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
                    <path class="outer" d="M10 10 V310 H530 V10 Z"></path>
                    <path class="inner" filter="url(#inset)" d="M10 10 V310 H530 V10 Z"></path>
                </g>
            </svg>

            <div id="mapContainer">

                <div id="map" class="">

                    <input type="radio" name="sector" value="nw" id="sector_nw" disabled="disabled" <?php echo ($location==4)?'checked="checked"':"";?>>
                    <label for="sector_nw">North - West</label>

                    <input type="radio" name="sector" value="ne" id="sector_no" disabled="disabled" <?php echo ($location==3)?'checked="checked"':"";?>>
                    <label for="sector_no">North - East</label>

                    <input type="radio" name="sector" value="sw" id="sector_sw" disabled="disabled" <?php echo ($location==1)?'checked="checked"':"";?>>
                    <label for="sector_sw">South - West</label>

                    <input type="radio" name="sector" value="se" id="sector_so" disabled="disabled" <?php echo ($location==2)?'checked="checked"':"";?>>
                    <label for="sector_so">South - East</label>

                </div>

            </div>

            <div id="selectedTribe" class="tribe<?php echo $tribe;?>">

                <input type="hidden" name="vid" value="<?php echo $tribe;?>">
                <input type="hidden" name="final" value="1">

                <div class="character"></div>
                <h2 class="tribeName"><?php echo ${'TRIBE'.$tribe};?></h2>

            </div>


        </div>

        <div class="acceptChallenge">
            Your selection is complete. One more click to accept the challenge!        </div>

        <div class="buttonContainer">

            <button type="submit" value="PLAY NOW" id="button59954826514da" class="green ">
	<div class="button-container addHoverClick">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content">PLAY NOW</div>
	</div>
</button>
<script type="text/javascript" id="button59954826514da_script">
	window.addEvent('domready', function() {
        if($('button59954826514da')) {
            $('button59954826514da').addEvent('click', function () {
                window.fireEvent('buttonClicked', [this, {"type":"submit","value":"PLAY NOW","name":"","id":"button59954826514da","class":"green ","title":"","confirm":"","onclick":""}]);
            });
        }
	});
</script>

            <div id="sparkles">
                <div class="sparkles1"></div>
                <div class="sparkles2"></div>
                <div class="sparkles3"></div>
                <div class="sparkles4"></div>
                <div class="sparkles5"></div>
                <div class="sparkles6"></div>
            </div>

        </div>

    </form>

</div>								<div class="clear"></div>
							</div>