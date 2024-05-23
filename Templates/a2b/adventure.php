<?php
$adv=$database->getAdventure($session->uid,$_GET['id']);
if($adv){
    $eigen = $database->getCoor($village->wid);
    $adventure = $database->getMInfo($_GET['id']);
    $from = array('x'=>$eigen['x'], 'y'=>$eigen['y']);
    $to = array('x'=>$adventure['x'], 'y'=>$adventure['y']);
    
    $speed = $session->heroD['speed'];
    $time = $database->procDistanceTime($from,$to,$speed,1);
    ?>
<div id="tileDetails" class="landscape landscape-<?=$adventure['type_of']?>">
    <div class="detailImage"></div>
    <div class="clear"></div>
   <?php $error="";
    if($village->resarray['f39']==0){
    $error=punktxuev9;
    }elseif($session->heroD['dead']==1){
    $error=punktxuev8;
    }elseif(!$village->unitarray['u11']){
    $error=punktxuev7;
        }elseif($session->heroD['revivetime']>0){
        if(!isset($timer)){$timer=0;}
        $timer++;
        $error="The hero is recovering.  Time left: ".$generator->getTimeFormat($session->heroD['revivetime'])."</span>.";
    }
        if(!empty($error)){?>
    <div class="adventureStatusMessage">

        <div class="heroStatusMessage header warning">
            <img alt="Восстанавливается" src="img/x.gif" class="<?php if($session->heroD['dead']==1){echo 'heroStatus101';}elseif($session->heroD['revivetime']>0){ echo 'heroStatus101Regenerate';}?>">
            <?=$error?></div>

    </div>

    <div class="adventureSend">
        <div class="adventureSendButton">
            <button type="button" value="Ок" name="ok" id="ok" class="green " onclick="window.location.href = 'dorf<?=$session->link?>.php'; return false;">
                <div class="button-container addHoverClick ">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content">Ок</div>
                </div>
            </button>

        </div>
        <div class="adventureBackButton">
            <a href="hero_adventure.php" class="a arrow"><?=STATISTIC34?></a>
        </div>
    </div>
        <?php }else{?>


				<form method="POST" action="a2b.php">
				<input type="hidden" name="a" value="adventure" />
				<input type="hidden" name="c" value="6" />
				<input type="hidden" name="h" value="<?php echo $_GET['id']; ?>" />
				<input type="hidden" name="id" value="39" />

                    <center>
                       <b><?=punktsb1?></b> <img class="clock" src="img/x.gif" alt="Duration" title="Duration" /> <?php echo $generator->getTimeFormat($time); ?>
                        <br />
                        <button type="submit" value="ok" name="s1" id="btn_ok" class="green">
                        <div class="button-container addHoverClick ">
                            <div class="button-background">
                                <div class="buttonStart">
                                    <div class="buttonEnd">
                                        <div class="buttonMiddle"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-content"><?= punktxuev4 ?></div>
                        </div>
                    </button>
                    </center>

                </form>
<?php }
   }
?>
    </div>