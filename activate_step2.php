<div id="content" class="activate">
    <h1 class="titleInHeader">Select your starting position</h1>
    <!-- <a id="backButton" class="contentTitleButton" href="/first.php?step=1"></a> -->
    <div class="activationWrapper activateGameWorldAccount selectSector">
        <div class="stepDescription selectSector">
            Where do you want to start building up your empire? Use the "recommended" area for the most ideal location.
            Or select the area where your friends are located and team up!
        </div>

        <form method="post" action="first.php">
            <div id="presentation" class="selectSector mapWrapper">

                <div id="activationMapContainer">

                    <div id="map" class="">

                        <input type="radio" name="sector" value="nw" id="sector_nw">
                        <label for="sector_nw">North - West</label>

                        <input type="radio" name="sector" value="ne" id="sector_no">
                        <label for="sector_no">North - East</label>

                        <input type="radio" name="sector" value="sw" id="sector_sw" checked="checked">
                        <label for="sector_sw" data-text="RECOMMENDED">South - West</label>

                        <input type="radio" name="sector" value="se" id="sector_so">
                        <label for="sector_so">South - East</label>

                    </div>

                </div>


            </div>

            <div class="buttonWrapper selectSector">

                <button type="submit" value="Confirm" id="button59954817e81ae"
                    class="textButtonV2 orange  buttonFramed withText rectangle">
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
                <script type="text/javascript" id="button59954817e81ae_script">
                    window.addEvent('domready', function () {
                        if ($('button59954817e81ae')) {
                            $('button59954817e81ae').addEvent('click', function () {
                                window.fireEvent('buttonClicked', [this, { "type": "submit", "value": "Confirm", "name": "", "id": "button59954817e81ae", "class": "orange ", "title": "", "confirm": "", "onclick": "" }]);
                            });
                        }
                    });
                </script>

            </div>
        </form>

        <div class="clear"></div>
    </div>
</div>