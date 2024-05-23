<?php
ini_set('memory_limit', '-1');
if(isset($_GET['x']) && isset($_GET['y'])) {
$x = $_GET['x'];
$y = $_GET['y'];
}
else {
$y = $village->coor['y'];
$x = $village->coor['x'];
}
if (time() - filemtime("minimap2.gif") >= 3600) {
$ww=WORLD_MAX*2;
$img = imagecreatetruecolor($ww,$ww);
//imagecopyresized($img, imagecreatefromgif('minimap.gif'), 0, 0, 0, 0, $ww, $ww, 100, 100); //обводка
$wdata=$database->query("SELECT x,y,occupied,oasistype FROM wdata WHERE oasistype>0 or occupied>0");
    //$wdata=$database->query("SELECT x,y FROM wdata WHERE occupied>0 or type_of='lake'");
$lgreen = imagecolorallocate($img, 112,186,28);
imagefill($img, 0, 0, $lgreen);
foreach($wdata as $w){
    if($w['occupied']!=0 && $w['oasistype']==0){
   $color = imagecolorallocate($img, 255,0,0);
  //  }elseif($w['type_of']=='lake'){
   //     $color = imagecolorallocate($img, 0,0,255);
    }else
    if($w['oasistype']==3 || $w['oasistype']==6 || $w['oasistype']==9){
        $color = imagecolorallocate($img, 200,224,13);
    }elseif($w['oasistype']==0 && $w['occupied']==0){
        $color = imagecolorallocate($img, 112,186,28);
    }elseif($w['oasistype']>0 && $w['oasistype']<10){
        $color = imagecolorallocate($img, 170,186,20);
    }
    imagestring($img, 1, WORLD_MAX+$w['x'], WORLD_MAX+$w['y'],'.',$color);
}
imagejpeg($img,'minimap2.gif',IMGQUALITY);
imagedestroy($img);
}

?>
<span id="lol" style="display: none;" >1</span>
<div id="content" class="map">
<h1 class="titleInHeader"><?=MAP?></h1>
<div class="map2">
<div id="mapContainer">
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
                        <div class="iconButton zoomIn" title="<?=zoom_in?>"></div>
                        <div class="iconButton zoomOut" title="<?=zoom_out?>"></div>

                        <div class="dropdown">
                            <div class="dataContainer">
                                <div class="entry display">100%</div>
                                <div class="entry hide">50%</div>
                            </div>
                            <div class="iconButton dropDownImage" title="<?=zoom_level?>"></div>
                            <div class="clear"></div>
                        </div>

                        <div  class="iconButton iconRequire<?php if(!$session->plus){echo 'Gold';}?>" style="left:-5px;" id="iconFullscreen">
                            <div onclick="Travian.Game.iPopupMap()" class="iconButton viewFull" title="<?=ITEM29?>||" ></div>
                        </div>

                        <div class="iconButton iconRequire<?php if(!$session->goldclub){echo 'Gold';}?>" id="iconCropfinder">
                            <a href="crop_finder.php"><div class="iconButton linkCropfinder" title="<?=CROPFINDER?>||"></div></a>


                        </div>



                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bl">
            <div class="br">
                <div class="bc"></div>
            </div>
        </div> </div>
		<form id="mapCoordEnter" action="karte.php" method="get" class="toolbar">
        <div class="ml">
            <div class="mr">
                <div class="mc">
                    <div class="contents">


                        <div class="coordinatesInput">
                            <div class="xCoord">
                                <label for="xCoordInputMap">X:</label>
                                <input maxlength="4" value="0" name="x" id="xCoordInputMap" class="text coordinates x " />
                            </div>
                            <div class="yCoord">
                                <label for="yCoordInputMap">Y:</label>
                                <input maxlength="4" value="0" name="y" id="yCoordInputMap" class="text coordinates y " />
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
            <img class="map" style="width: 185px; height: 109px;" src="minimap.php" alt="<?=MINIMAP?>" />
        </div>

        <div class="bl">
            <div class="br">
                <div class="bc"></div>
            </div>
        </div>
    </div>		<div id="outline">
        <div class="tl">
            <div class="tr">
                <div class="tc"></div>
            </div>
        </div>
        <div class="background"></div>
        <div id="mapMarks">
            <div class="headline">
                <div class="title"><?=GO_TO?></div>

            </div>

        </div>
    </div>	</div>
</div>

<script type="text/javascript">
    Travian.Translation.add(
            {

                'k.loadingData':	'<?=PLEASE_WAIT?>'

            });
</script>
<?php


$xy_sort=$xy_coor=$map_symb='';
$movements=$map_info=$sel_vil=array();
if($session->plus){

    $move=$database->getmovvill2($village->wid);
    if(count($move)>0) {
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

	//die(print_r($move));
	foreach($movements as $key=>$m){
		if(isset($xy[$key]) && !empty($xy[$key])){
			$map_info[$key]=array('x'=>$xy[$key]['x'],'y'=>$xy[$key]['y'],'type'=>$m);
		}
	}
    foreach($map_info as $mi){
        $map_symb.= '{"x": '.$mi['x'].', "y": '.$mi['y'].', "s": [
                                            {"dataId": "", "x": "'.$mi['x'].'", "y": "'.$mi['y'].'", "type": "attack", "parameters": {"attackType":"'.$mi['type'].'"}, "title": "'.$mi['type'].'", "text": "{a.atm1}\u003Cbr \/\u003E{a.ad} {a.ad3}"}
                                        ]},';
    }
    $map_symb = (substr($map_symb, 0, -1));
    }
}

?>
<script type="text/javascript">
    window.addEvent('domready', function()
    {
        var containerViewSize = {
            width:	540,
            height: 401
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
                                        width:	600,
                                        height:	600					},
                                    containerViewSize:	containerViewSize,
                                    mapInitialPosition:
                                            {
                                                x:	<?=$x?>,
                                y:	<?=$y?>					},
                    transition:
            {
                zoomOptions:
                {
                    level:  1,
                            sizes:	[{"x":10,"y":10},{"x":20,"y":20}]		                }
            },
            /* check */
                                    data: {"elements": [

<?=$map_symb?>

                                    ], "blocks":[]}

                                }));
                    };

                    if ((!Browser.safari && !Browser.chrome) || $('mapContainer').getSize().y == containerViewSize.height)
                    {
                        fnInit();
                    }
                    else
                    {
                        fnDelayMe.delay(100);
                    }
                };
                fnDelayMe();
            });
</script>

<div class="clear"></div>
</div>