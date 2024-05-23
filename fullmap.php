<?php
include "GameEngine/Village.php";
if(isset($_GET['d']) && isset($_GET['c'])) {
    if($generator->getMapCheck($_GET['d']) == $_GET['c']) {
        $wref = $_GET['d'];
        $coor = $database->getCoor($wref);
        $x = $coor['x'];
        $y = $coor['y'];
    }
}
else if(isset($_GET['x']) && isset($_GET['y'])) {
    $x = $_GET['x'];
    $y = $_GET['y'];
}
else if(isset($_POST['xp']) && isset($_POST['yp'])){
    $x = $_POST['xp'];
    $y = $_POST['yp'];
}
else {
    $y = $village->coor['y'];
    $x = $village->coor['x'];
}
if(!$session->plus){die("You need Travian Plus!");}
ob_start("ob_gzhandler");
?>

<!DOCTYPE html>
<html>
<head>
    <link href="<?php echo GP_LOCATE;?>lang/en/compact.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo GP_LOCATE;?>lang/en/js/crypt.js" type="text/javascript"> </script>
    <script type="text/javascript" src="<?php echo GP_LOCATE;?>lang/en/js/jquery.js"></script>
    <script>
        var j$ = $.noConflict();
    </script>
    <script>Travian.applicationId = 'T4.2 Game';
        Travian.Game.version = '4.2';
        Travian.Game.worldId = '<?=SERVER_NAME?>';
        Travian.Game.speed = <?=SPEED?>;

        Travian.Templates = {};
        Travian.Templates.ButtonTemplate = "<button >\n\t<div class=\"button-container addHoverClick\">\n\t\t<div class=\"button-background\">\n\t\t\t<div class=\"buttonStart\">\n\t\t\t\t<div class=\"buttonEnd\">\n\t\t\t\t\t<div class=\"buttonMiddle\"><\/div>\n\t\t\t\t<\/div>\n\t\t\t<\/div>\n\t\t<\/div>\n\t\t<div class=\"button-content\"><\/div>\n\t<\/div>\n<\/button>\n";
    </script>
</head>
<body style="background: none;">



<div id="content" class="map" style="height:100%">
<div class="map2" style="height:103%">
    <div id="mapContainer" style="width:101%; height:100%">
        <div class="innerShadow">
            <div class="innerShadow-tl">
                <div class="innerShadow-tr">
                    <div class="innerShadow-tc"></div>
                </div>
            </div>
            <div class="innerShadow-ml">
                <div class="innerShadow-mr"></div>
            </div>
            <div class="innerShadow-bl">
                <div class="innerShadow-br">
                    <div class="innerShadow-bc"></div>
                </div>
            </div>
        </div>
        <div id="toolbar" class="toolbar">
            <div class="ml">
                <div class="mr">
                    <div class="mc">
                        <div class="contents">
                            <div class="iconButton zoomIn" title="zoom in"></div>
                            <div class="iconButton zoomOut" title="zoom out"></div>

                            <div class="dropdown">
                                <div class="dataContainer">
                                    <div class="entry display">100%</div>
                                    <div class="entry hide">50%</div>
                                </div>
                                <div class="iconButton dropDownImage" title="zoom level"></div>
                                <div class="clear"></div>
                            </div>



                            <div class="iconButton iconRequireGold" id="iconCropfinder">
                                <a target="_top" href="crop_finder.php" ><div class="iconButton linkCropfinder" title="<?=CROPFINDER?>"></div></a>


                            </div>



                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="bl">
                    <div class="br">
                        <div class="bc"></div>
                    </div>
                </div>  </div>

        </div>
        <form id="mapCoordEnter" action="karte.php" method="get" class="toolbar">
            <div class="ml">
                <div class="mr">
                    <div class="mc">
                        <div class="contents">


                            <div class="coordinatesInput">
                                <div class="xCoord">
                                    <label for="xCoordInputMap">X:</label>
                                    <input maxlength="4" value="<?=$coor['x']?>" name="x" id="xCoordInputMap" class="text coordinates x " />
                                </div>
                                <div class="yCoord">
                                    <label for="yCoordInputMap">Y:</label>
                                    <input maxlength="4" value="<?=$coor['y']?>" name="y" id="yCoordInputMap" class="text coordinates y " />
                                </div>
                                <div class="clear"></div>
                            </div>
                            <button  type="submit" value="OK" id="button52f7f04c27a1e" class="green small">
                                <div class="button-container addHoverClick" style="margin:1px -3px;">
                                    <div class="button-background">
                                        <div class="buttonStart">
                                            <div class="buttonEnd">
                                                <div class="buttonMiddle"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-content"><?=GO?></div>
                                </div>
                            </button>
                            <script type="text/javascript">
                                window.addEvent('domready', function()
                                {
                                    if($('button52f7f04c27a1e'))
                                    {
                                        $('button52f7f04c27a1e').addEvent('click', function ()
                                        {
                                            window.fireEvent('buttonClicked', [this, {"type":"submit","value":"OK","name":"","id":"button52f7f04c27a1e","class":"green small","title":"","confirm":"","onclick":""}]);
                                        });
                                    }
                                });
                            </script>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div id="minimapContainer">
            <div class="background"></div>
            <div class="headline">
                <div class="title"><?=MINIMAP?></div>
                <div class="iconButton small"></div>
                <div class="clear"></div>
            </div>
            <div id="miniMap">
                <img class="map" style="width: 185px; height: 114px;" src="minimap.php" alt="<?=MINIMAP?>" />
            </div>

            <div class="bl">
                <div class="br">
                    <div class="bc"></div>
                </div>
            </div>
        </div>      <div id="outline">
            <div class="tl">
                <div class="tr">
                    <div class="tc"></div>
                </div>
            </div>
            <div class="background"></div>
            <div id="mapMarks">
                <div class="headline">
                    <div class="title"><?=GO_TO?></div>
                    <div style="display:none;" class="iconButton small"></div>
                    <div class="clear"></div>
                </div>
                <div class="tabContainer">


                    <div id="tabPlayer" class="dataTab"></div>
                    <div id="tabAlliance" class="dataTab"></div>
                </div>
            </div>
        </div>  </div>
</div>
<?php $xy_sort=$xy_coor=$map_symb='';
$movements=$map_info=$sel_vil=array();

$move=$database->getmovvill2($village->wid);
if(count($move)>0){
foreach($move as $mo){
if(!in_array($mo['vref'],$sel_vil)){
array_push($sel_vil,$mo['vref']);
$xy_coor.='\''.$mo['vref'].'\',';
switch($mo['sort_type']){
case 3:
if($mo['attack_type']==1){$movements[]="spy";}elseif($mo['attack_type']==2){ $movements[]="support";}else{$movements[]="attack";}
break;
case 4:
$movements[]="back";
break;
}
}
}

$xy_coor = (substr($xy_coor, 0, -1));
$xy= $database->query("SELECT x,y  FROM wdata WHERE `id` IN (".$xy_coor.")");

foreach($movements as $key=>$m){
$map_info[$key]=array('x'=>$xy[$key]['x'],'y'=>$xy[$key]['y'],'type'=>$m);
}
foreach($map_info as $mi){//echo "{";
$map_symb.= '{"x": '.$mi['x'].', "y": '.$mi['y'].', "s": [
{"dataId": "", "x": "'.$mi['x'].'", "y": "'.$mi['y'].'", "type": "attack", "parameters": {"attackType":"'.$mi['type'].'"}, "title": "'.$mi['type'].'", "text": "{a.atm1}\u003Cbr \/\u003E{a.ad} {a.ad3}"}
]},';
}
$map_symb = (substr($map_symb, 0, -1));
}
?>
<script type="text/javascript">
    Travian.Translation.add(
        {

            'k.loadingData':    '<?=PLEASE_WAIT?>'

        });
</script>
<script type="text/javascript">
    window.addEvent('domready', function()
    {
        var containerViewSize = {
            width:   window.innerWidth,
            height: window.innerHeight
        };


        var fnDelayMe = function()
        {

            var fnInit = function()
            {
                Travian.Game.Map.Options.Rulers.steps = Object.merge({}, Travian.Game.Map.Options.Rulers.steps, {"x":{"1":1,"2":1,"3":10,"4":20},"y":{"1":1,"2":1,"3":10,"4":20}});
                Travian.Game.Map.Options.Default.dataStore = Object.merge({}, Travian.Game.Map.Options.Default.dataStore, {"cachingTimeForType":{"blocks":1800000,"symbol":600000,"tile":600000,"tooltip":300000},"persistentStorage":false,"useStorageForType":{"blocks":false,"symbol":false,"tile":false,"tooltip":false},"clearStorageForType":{"blocks":false,"symbol":false,"tile":false,"tooltip":false}});
                Travian.Game.Map.Options.Default.updater = Object.merge({}, Travian.Game.Map.Options.Default.updater, {"maxRequestCount":5,"requestDelayTime":{"multiple":100,"position":300},"url":"map_ajax.php","positionOptions":{"areaAroundPosition":{"1":{"left":-5,"top":-4,"right":5,"bottom":4},"2":{"left":-10,"top":-8,"right":10,"bottom":8},"3":{"left":-15,"top":-15,"right":15,"bottom":15},"4":{"left":-15,"top":-15,"right":15,"bottom":15}}}});
                Travian.Game.Map.Options.Default.tileDisplayInformation.type = 'dialog';


                Travian.Game.Map.Tips.tooltipHtml = '‎&#x202d;<span class=\"coordinates coordinatesWrapper\"><span class=\"coordinateX\">(&#x202d;&#x202d;{x}&#x202c;&#x202c;<\/span><span class=\"coordinatePipe\">|<\/span><span class=\"coordinateY\">&#x202d;&#x202d;{y}&#x202c;&#x202c;)<\/span><\/span>&#x202c;‎';
                Travian.Game.Map.Options.Default.block.tooltipHtml = '‎&#x202d;<span class=\"coordinates coordinatesWrapper\"><span class=\"coordinateX\">(&#x202d;&#x202d;{x}&#x202c;&#x202c;<\/span><span class=\"coordinatePipe\">|<\/span><span class=\"coordinateY\">&#x202d;&#x202d;{y}&#x202c;&#x202c;)<\/span><\/span>&#x202c;‎<br />{k.loadingData}';
                Travian.Game.Map.Options.MiniMap.tooltipHtml = '‎&#x202d;<span class=\"coordinates coordinatesWrapper\"><span class=\"coordinateX\">(&#x202d;&#x202d;{x}&#x202c;&#x202c;<\/span><span class=\"coordinatePipe\">|<\/span><span class=\"coordinateY\">&#x202d;&#x202d;{y}&#x202c;&#x202c;)<\/span><\/span>&#x202c;‎';


                new Travian.Game.Map.Container(Object.merge({}, Travian.Game.Map.Options.Default,
                    {
                        blockOverflow: 1,
                        blockSize:
                        {
                            width:  600,
                            height: 600                 },
                        containerViewSize:  containerViewSize,
                        mapInitialPosition:
                        {
                            x:  <?=$x?>,
                            y:  <?=$y?>                 },
                        transition:
                        {
                            zoomOptions:
                            {
                                level:  1,
                                sizes:  [{"x":10,"y":10},{"x":20,"y":20},{"x":120,"y":120}]                     }
                        },
                        /* check */
                        data: {"elements": [

                            <?=$map_symb?>

                        ], "blocks": {}}
                    }));
            };

           //  if ((!Browser.safari && !Browser.chrome) || $('mapContainer').getSize().y == containerViewSize.height)
           // {
                fnInit();
           // }
           // else
           // {
           //    fnDelayMe.delay(100);
          //  }
        };
        fnDelayMe();
    });
</script>
<div class="clear"></div>
</div>
</body>
</html>