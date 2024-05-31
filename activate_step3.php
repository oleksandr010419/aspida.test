<div id="content" class="activate">
    <h1 class="titleInHeader">Ready to rule the world?</h1>
    <div class="activationWrapper activateGameWorldAccount isEditing confirm">
        <form method="post" action="first.php">
        <div class="steps">

            <div class="selection confirm">


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
                        <path class="outer" d="M10 10 V310 H530 V10 Z"></path>
                        <path class="inner" filter="url(#inset)" d="M10 10 V310 H530 V10 Z"></path>
                    </g>
                </svg> -->
                    <!-- 
                <div id="mapContainer">

                    <div id="map" class="">

                        <input type="radio" name="sector" value="nw" id="sector_nw" disabled="disabled" <?php echo
                                ($location==4)?'checked="checked"':"";?>>
                        <label for="sector_nw">North - West</label>

                        <input type="radio" name="sector" value="ne" id="sector_no" disabled="disabled" <?php echo ($location==3)?'
                                checked="checked"':"";?>>
                        <label for="sector_no">North - East</label>

                        <input type="radio" name="sector" value="sw" id="sector_sw" disabled="disabled" <?php echo ($location==1)?'
                                checked="checked"':"";?>>
                        <label for="sector_sw">South - West</label>

                        <input type="radio" name="sector" value="se" id="sector_so" disabled="disabled" <?php echo ($location==2)?'
                                checked="checked"':"";?>>
                        <label for="sector_so">South - East</label>

                    </div>

                </div> -->



                    <input type="hidden" name="vid" value="<?php echo $tribe;?>">
                    <input type="hidden" name="final" value="1">

                    <div class="confirmTribe tribe1 <?php echo ($tribe==1) ? 'selected' : ''?>">
                        <h2>Romans</h2>
                        <a class="change backToTribe" href="first.php?step=1">Change</a>
                    </div>
                    <div class="confirmTribe tribe2 <?php echo ($tribe==2) ? 'selected' : ''?>">
                        <h2>Teutons</h2>
                        <a class="change backToTribe" href="first.php?step=1">Change</a>
                    </div>
                    <div class="confirmTribe tribe3 <?php echo ($tribe==3) ? 'selected' : ''?>">
                        <h2>Gauls</h2>
                        <a class="change backToTribe" href="first.php?step=1">Change</a>
                    </div>
                    <div class="confirmTribe tribe6 <?php echo ($tribe==6) ? 'selected' : ''?>">
                        <h2>Egyptians</h2>
                        <a class="change backToTribe" href="first.php?step=1">Change</a>
                    </div>
                    <div class="confirmTribe tribe7 <?php echo ($tribe==7) ? 'selected' : ''?>">
                        <h2>Huns</h2>
                        <a class="change backToTribe" href="first.php?step=1">Change</a>
                    </div>
                    <div class="confirmTribe tribe8 <?php echo ($tribe==8) ? 'selected' : ''?>">
                        <h2>Spartans</h2>
                        <a class="change backToTribe" href="first.php?step=1">Change</a>
                    </div>

                    <div class="confirmSector nw <?php echo ($location==4) ? 'selected' : ''?>">
                        <h2>North - West</h2>
                        <a class="change backToSector" href="first.php?step=2">Change</a>
                    </div>
                    <div class="confirmSector no <?php echo ($location==3) ? 'selected' : ''?>">
                        <h2>North - East</h2>
                        <a class="change backToSector" href="first.php?step=2">Change</a>
                    </div>
                    <div class="confirmSector sw <?php echo ($location==1) ? 'selected' : ''?>">
                        <h2>South - West</h2>
                        <a class="change backToSector" href="first.php?step=2">Change</a>
                    </div>
                    <div class="confirmSector so <?php echo ($location==2) ? 'selected' : ''?>">
                        <h2>South - East</h2>
                        <a class="change backToSector" href="first.php?step=2">Change</a>
                    </div>
            </div>

            <div class="stepDescription confirm">Your selection is complete. One more click to accept the challenge! </div>

            <div class="buttonWrapper confirm">

                <button type="submit" value="PLAY NOW" id="button59954826514da" class="textButtonV2 green withLoadingIndicator buttonFramed withText rectangle">
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
                    window.addEvent('domready', function () {
                        if ($('button59954826514da')) {
                            $('button59954826514da').addEvent('click', function () {
                                window.fireEvent('buttonClicked', [this, { "type": "submit", "value": "PLAY NOW", "name": "", "id": "button59954826514da", "class": "green ", "title": "", "confirm": "", "onclick": "" }]);
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
        </div>
    </form>
    </div>
    <div class="clear"></div>
</div>