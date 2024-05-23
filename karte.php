<?php
include_once "GameEngine/Village.php";
if(isset($_GET['d']) && !is_numeric($_GET['d'])) die('Hacking Attemp');
if(isset($_GET['c']) && !is_string($_GET['c']) || strlen($_GET['c'])>2){die('Hacking Attemp');}
else if(isset($_GET['c'])){
$c=$_GET['c'];}

ob_start("ob_gzhandler");

?>
<!DOCTYPE html>
<html>
<?php include("Templates/html.php");?>


<body class="v35 <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> map <?php if($dorf1==''){echo 'perspectiveBuildings';}else{ echo 'perspectiveResources';} ?>">
<script type="text/javascript">
    window.ajaxToken = 'de3768730d5610742b5245daa67b12cd';
</script>
<div id="background">
    <div id="headerBar"></div>
    <div id="bodyWrapper">



        <div id="header">
            <?php
            include("Templates/topheader.php");
            include("Templates/toolbar.php");
            ?>
        </div>
        <div id="center">


            <?php include("Templates/sideinfo.php"); ?>

            <div id="contentOuterContainer" class="size1">

                <?php include("Templates/res.php"); ?>
                <div class="contentTitle">
                    <a id="closeContentButton" class="contentTitleButton" href="dorf<?=$session->link?>.php" title="Close window">&nbsp;</a>
                    <a id="answersButton" class="contentTitleButton" href="http://t4.answers.travian.com/index.php?aid=106#go2answer" target="_blank" title="Travian Answers">&nbsp;</a>						</div>
                <div class="contentContainer">
                <?php

if($_SESSION['lowres']==1 || isset($_GET['lowres'])){?>
	<div class="map" id="content">
		<h1 class="titleInHeader"><?=MAP?></h1>
		<div class="map2 lowRes">
				<div class="lowRes" id="mapContainer">
					<div class="mapContainerData">
						<?php 
						$is_ajax=false;
						include("lowresmap.php");?>
					</div>
					
					<a class="moveLeft" href="/karte.php?x=<?php echo $x-1;?>&amp;y=<?php echo $y;?>" id="navigationMoveLeft"><img alt="move left" src="/img/x.gif"></a> 
					<a class="moveRight" href="/karte.php?x=<?php echo $x+1;?>&amp;y=<?php echo $y;?>" id="navigationMoveRight"><img alt="move right" src="/img/x.gif"></a> 
					<a class="moveUp" href="/karte.php?x=<?php echo $x;?>&amp;y=<?php echo $y+1;?>" id="navigationMoveUp"><img alt="move up" src="/img/x.gif"></a> 
					<a class="moveDown" href="/karte.php?x=<?php echo $x;?>&amp;y=<?php echo $y-1;?>" id="navigationMoveDown"><img alt="move down" src="/img/x.gif"></a>
					<?php if($session->plus){?>
					<a href="karte.php?fullscreen=1&amp;x=<?php echo $x;?>&amp;y=<?php echo $y-1;?>" id="navigationFullScreen" class="viewFullScreen full"><img src="/img/x.gif" alt="fullscreen"></a>
					<?php }?>
					<form id="mapCoordEnter" action="karte.php" method="get" class="toolbar">
						<div class="ml">
							<div class="mr">
								<div class="mc">
									<div class="contents">
										<div class="iconButton iconRequire<?php if(!$session->goldclub){echo 'Gold';}?>" id="iconCropfinder">
											<div class="iconButton linkCropfinder"></div>
										</div>
										<div class="separator"></div>										
										<div class="coordinatesInput">
											<div class="xCoord">
												<label for="xCoordInputMap">X:</label>
												<input value="0" name="x" id="xCoordInputMap" class="text coordinates x ">
											</div>
											<div class="yCoord">
												<label for="yCoordInputMap">Y:</label>
												<input value="0" name="y" id="yCoordInputMap" class="text coordinates y ">
											</div>
											<div class="clear"></div>
										</div>
										<button type="submit" value="OK" id="button59f1c35dd0c28" class="green small">
											<div class="button-container addHoverClick">
												<div class="button-background">
													<div class="buttonStart">
														<div class="buttonEnd">
															<div class="buttonMiddle"></div>
														</div>
													</div>
												</div>
												<div class="button-content">OK</div>
											</div>
										</button>
										<script type="text/javascript" id="button59f1c35dd0c28_script">
											window.addEvent('domready', function() {
												if($('button59f1c35dd0c28')) {
													$('button59f1c35dd0c28').addEvent('click', function () {
														window.fireEvent('buttonClicked', [this, {"type":"submit","value":"OK","name":"","id":"button59f1c35dd0c28","class":"green small","title":"","confirm":"","onclick":""}]);
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
				</div>
			</div>
			<script type="text/javascript">
				<?php if(isset($_GET['fullscreen']) && $session->plus){?>
				window.addEvent('domready', function()
				{
					if ($('betaBox'))
					{
						$('betaBox').dispose();
					}

					var fullScreenSize = $(window.document).getCoordinates();
					var body = $(document.body).addClass('fullScreen');
					var mapContainer = $('mapContainer').dispose();

					var containerViewSize = {
						width:	fullScreenSize.width - 25, // rulers Y left || right,
						height: fullScreenSize.height - 20// rulers X
					};

					mapContainer.inject(body).setStyles(
					{
						position:	'absolute',
						left:		fullScreenSize.left,
						top:		fullScreenSize.top,
						width:		Math.floor(containerViewSize.width / 60) *  60,
						height:		Math.floor(containerViewSize.height / 60) *  60			});
					
					Travian.Game.Map.LowRes.Options.Default.tileDisplayInformation.type = 'dialog';
					new Travian.Game.Map.LowRes.Container(Object.merge({}, Travian.Game.Map.LowRes.Options.Default,
					{
						fullScreen:	true,
						mapInitialPosition:
						{
							x:	<?=$x?>,
							y:	<?=$y?>		}
					}));
				});<?php } else {?>
				window.addEvent('domready', function()
				{
					Travian.Game.Map.LowRes.Options.Default.tileDisplayInformation.type = 'dialog';
					new Travian.Game.Map.LowRes.Container(Object.merge({}, Travian.Game.Map.LowRes.Options.Default,
					{
						fullScreen:	false,
						mapInitialPosition:
						{
							x:	<?=$x?>,
							y:	<?=$y?>
						},			
					}));
				}
				);
				<?php } ?>
			</script>
		</div>
					<?php
}else{
	if(!isset($_GET['d'])){
		include("Templates/Map/newmap.php");
	}else{
		include("Templates/Map/vilview.php");
	}
}

?>

                </div>
                <div class="clear">&nbsp;</div>

                <div class="contentFooter"></div>
            </div>
            <?php
            include("Templates/rightsideinfor.php");
            ?>
            <div class="clear"></div>
        </div>
        <?php

        include("Templates/header.php");
        ?>
    </div>
    <div id="ce"></div>
</div>
</body>
</html>
