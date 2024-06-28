<?php
$green=$session->plus?'green':'gold';
$hero = $herodata=$session->heroD;
$art = $database->checkArtefactsEffects($session->uid,$session->wid,5);
$bonuses = $database->allHeroBonuses($database->getHeroInventory($session->uid));


            
$ttitle=constant("TRIBE".$session->tribe);
$aid = $session->alliance;
if($aid){
$allianceinfoMY = $database->getAlliance($aid);
}
if($herodata['dead']==1){
    $healtstat = '101';
    $status = HERO_DIED;
}
elseif($herodata['dead']==0 && $herodata['health']<100){
    $healtstat = '101Regenerate';
    $status = HERO_DIED;
}
elseif($herodata['dead']==0 && $herodata['health']==100){
    $healtstat = '100';
    $status = HERO_HEALTHY;
}
foreach($session->vvillages as $vi){
    if($herodata['wref']==$vi['wref']){
        $vname=$vi['name'];
        break;
    }
}
$units = $database->getUnit($herodata['wref']);
if($herodata['dead']==0){

    if($units['u11']!=0){
        $where2='The hero is in his home village «<a onclick="document.location.href=\'karte.php?z='.$vi["wref"].'\'">'.$vname.'</a>»';
        $where=HEROI42.' '.$vname.'.';
        $where2=HEROI42.' «<a onclick="document.location.href=\'karte.php?z='.$vi["wref"].'\'">'.$vname.'</a>»';
        $position = Elanat_dorf1;
    }
    elseif($units['u11']==0){
        $position = OUT_OF_HOME;
        $where='Native Village Hero «'.$vname.'».Hero is away.';
        $where2='Native Village Hero «<a onclick="document.location.href=\'karte.php?z='.$vi["wref"].'\'">'.$vname.'</a>.No Hero.»';
    }
}
else{
    $position = HERO_DIED;
    $where='The hero belongs to village «'.$vname.'».Hero is dead.';
    $where2='Hero from village <a onclick="document.location.href=\'karte.php?z='.$vi["wref"].'\'">'.$vname.'</a> is dead';
}
?>



<div id="sidebarBeforeContent" class="sidebar beforeContent">
    <div class="sidebarBoxWrapper">
        <div id="sidebarBoxHero" class="sidebarBox toggleable <?php if($_COOKIE['box']==1){echo 'expanded';}else{ echo 'collapsed';}?> ">
            <!-- <div class="sidebarBoxBaseBox">
                <div class="baseBox baseBoxTop">
                    <div class="baseBox baseBoxBottom">
                        <div class="baseBox baseBoxCenter"></div>
                    </div>
                </div>
            </div> -->
            <div class="sidebarBoxInnerBox">
                <div class="innerBox header ">
                    <div class="buttonsWrapper">
                        <button id="heroImageButton" onclick="window.location.href='hero_inventory.php';"
                            class="heroImageButton " type="button" title="Hero overview||<?=$where?>">
                            <img class="heroImage" src="<?=$database->herface();?>" width="64px" height="83px"
                                style="margin-left:10px;margin-top:5px;" alt="">
                        </button>
                        <!-- <?php
                            $availiblepoint = $hero['level'] * 4;
                            $freepoints = $availiblepoint - ($hero['power'] + $hero['offBonus'] + $hero['defBonus'] + $hero['product']+1);
                            if($session->heroD['dead']==1){
                        ?>
                            <div class="bigSpeechBubble dead">
                                <img src="img/x.gif" alt="">
                            </div>
                        <?php }elseif($freepoints>0){?>
                            <div class="bigSpeechBubble levelUp">
                                <img src="img/x.gif" alt="">
                            </div>
                        <?php    } ?> -->
                        <button type="button" id="button5225ee283b159" class="layoutButton auctionWhite green  "
                            onclick="return false;" title="">
                            <div class="button-container addHoverClick ">
                                <img src="img/x.gif" alt="">
                            </div>
                        </button>

                        <script type="text/javascript">
                            
                            
                            if ($('button5225ee283b159')) {
                                $('button5225ee283b159').addEvent('click', function () {
                                    window.fireEvent('buttonClicked', [this, { "type": "green", "onclick": "return false;", "loadTitle": true, "boxId": "hero", "disabled": false, "speechBubble": "", "class": "", "id": "button5225ee283b159", "redirectUrl": "hero_auction.php", "redirectUrlExternal": "" }]);
                                });
                            }
                            </script>
                            <button type="button" id="button5225ee283b28a" class="layoutButton adventureWhite green  "
                                title="Adventure:||Available adventures: <?php echo count($adventures); ?>"
                                onclick="return false;">
                                <div class="button-container addHoverClick ">
                                    <img src="img/x.gif" alt="">
                                </div>
                                <?php if(count($adventures) > 0){ ?>
                                <div class="speechBubbleContainer ">
                                    <div class="speechBubbleBackground">
                                        <div class="start">
                                            <div class="end">
                                                <div class="middle"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="speechBubbleContent">
                                        <?php echo count($adventures); ?>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="clear"></div>
                            </button>
        
                            <script type="text/javascript">
        
                                if ($('button5225ee283b28a')) {
                                    $('button5225ee283b28a').addEvent('click', function () {
                                        window.fireEvent('buttonClicked', [this, { "type": "green", "onclick": "return false;", "loadTitle": true, "boxId": "hero", "disabled": false, "speechBubble": "<?php echo count($adventures); ?>", "class": "", "id": "button5225ee283b28a", "redirectUrl": "hero_adventure.php", "redirectUrlExternal": "" }]);
                                    });
                                }
                            </script>
                    </div>
                </div>

                <div class="innerBox content">
                    <div class="playerName boxTitle">
                        <img src="img/x.gif" class="nation nation<?php echo $session->tribe; ?>" alt="<?=$ttitle?>"
                            title="<?=$ttitle?>">
                        <?php echo $session->username; ?>
                    </div>
                    <?php $adventures = $database->query("SELECT end FROM adventure WHERE `uid`='".$session->uid."' AND `end` = 0 and `time` > '".time()."'"); ?>
                    <ul>
                        <li class="heroStatusMessage">
                            <img alt="<?php echo $status; ?>" src="img/x.gif" class="heroStatus<?php echo $healtstat; ?>">
                            <?php echo $position; ?>
                        </li>

                        <li class="progressBars">
                            <div class="heroHealthBarBox alive" title="Health: <?php echo round($herodata['health']); ?>%">
                                <a href="hero_inventory.php">
                                    <img src="img/x.gif" class="injury" alt="Health">
                                </a>
                                <div class="bar" style="width:<?php echo $herodata['health']; ?>%">&nbsp;</div>
                            </div>

                            <div class="heroXpBarBox" title="Experience: <?=$hero['experience']?>">
                                <a href="hero_inventory.php"><img src="img/x.gif" class="iExperience"></a>
                                <div class="bar"
                                    style="width:<?php echo round(100 * (($hero['experience'] - $hero_levels[$hero['level']]) / ($hero_levels[$hero['level'] + 1] - $hero_levels[$hero['level']])), 1); ?>%">
                                    &nbsp;</div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="innerBox footer expanded toggle"> <!-- Added the 'expanded' class here -->
                    <button type="button" class="toggleBox" onclick="" title="Hide information">
                        <!-- <div class="button-container addHoverClick "> -->
                            <?php echo getsvgicon();?>
                        <!-- </div> -->
                    </button>

                    <script type="text/javascript">
                        window.addEvent('domready', function () {
                            Travian.Translation.add({
                                'hero_collapsed': 'Show additional information',
                                'hero_expanded': 'Hide additional information'
                            });

                            var box = $('sidebarBoxHero');

                            // Check if the cookie for the box state is not set or is set to '1' (expanded)
                            if (document.cookie.indexOf('box=') === -1 || document.cookie.indexOf('box=1') !== -1) {
                                box.addClass('expanded');
                            }

                            box.down('button.toggleBox').addEvent('click', function (e) {
                                if (box.toggleClass('expanded').hasClass('expanded')) {
                                    document.cookie = 'box=1; expires=Wed, 1 Jan 2025 00:00:00 GMT'; // Adjusted the expiration date
                                } else {
                                    document.cookie = 'box=0; expires=Thu, 01-Jan-1970 00:00:01 GMT';
                                }
                                Travian.Game.Layout.toggleBox(box, 'travian_toggle', 'hero');
                            });
                        });
                    </script>
                </div>

            </div>
        </div>
        <div id="sidebarBoxAlliance" class="sidebarBox   ">
            <!-- <div class="sidebarBoxBaseBox">
                <div class="baseBox baseBoxTop">
                    <div class="baseBox baseBoxBottom">
                        <div class="baseBox baseBoxCenter"></div>
                    </div>
                </div>
            </div> -->
            <?php
                $villmas=implode(',',$session->villages);
                $fff = array();
                $posolstvo=0;
                $fdata=$database->query("SELECT * FROM `fdata` WHERE vref IN (".$villmas.")");
                $link='';
                foreach($fdata as $f){
                    $fff[$f['vref']]=$f;
                    for($i=19;$i<40;$i++){
                        if($f['f'.$i.'t']==18){
                            $new=$database->getTypeLevel(18,$f['vref'],$f);
                            $posolstvo=$posolstvo<$new?$new:$posolstvo;
                            $link="window.location.href='build.php?id=".$i."&newdid=".$f['vref']."';";
                            break;
                        }
                    }


                }
            ?>
            <div class="sidebarInnerBox">
                <div class="innerBox header ">
                    <!-- <div class="buttonsWrapper"> -->

                        <button type="button" id="button5225ee283d5ac" class="layoutButton embassyWhite green <?php if(!$posolstvo){ echo " disabled";}?>"
                            <?php if($posolstvo>0){echo "title='Embassy || Highest embassy level: ".$posolstvo."'";} ?>
                            onclick="
                            <?php echo $link;?> return false;">
                            <div class="button-container addHoverClick">
                                <img src="img/x.gif" alt="">
                            </div>
                        </button>
    
    
                        <button type="button" id="button5225ee283d8f8" title="Alliance Review" class="layoutButton overviewWhite green <?php if(!$session->alliance) echo " disabled"; ?> "
                            onclick="return false;">
                            <div class="button-container addHoverClick ">
                                <img src="img/x.gif" alt="">
                            </div>
                        </button>
                        <script type="text/javascript">

                            if ($('button5225ee283d8f8')) {
                                $('button5225ee283d8f8').addEvent('click', function () {
                                    window.fireEvent('buttonClicked', [this, { "type": "green", "onclick": "return false;", "loadTitle": false, "boxId": "alliance", "disabled": true, "speechBubble": "", "class": "", "id": "button5225ee283d8f8", "redirectUrl": "allianz.php?s=4", "redirectUrlExternal": "" }]);
                                });
                            }
                        </script>
                    <!-- </div> -->
                </div>
                <div class="innerBox content">
                    <div class="boxTitle">
                        <?php
                            if($session->alliance == 0){
                                echo Ally_dorf1;
                            }
                            else{
                                echo "<div class='sideInfoAlly'><a class='signLink' href='allianz.php' title='".SIDEINFO_ALLIANCE."'><span class='wrap'>".$allianceinfoMY['tag']."</span></a><a href='allianz.php?s=2' class='crest' title='".SIDEINFO_ALLY_FORUM."'><img src='img/x.gif'></a></div>";
                            }
                        ?>
                    </div>
                </div>
                <div class="innerBox footer">
                </div>
            </div>
        </div>
        <?php
$i = 0;
$timestamp = $session->deleting;
$first = '';
if($session->protect > time()){
    $i++;
    if($first == ''){
        $first = 'protect';
    }
}
elseif($timestamp) {
    $i++;
    if($first == ''){
        $first = 'delete';
    }
}


$i+=1;
    
    $infa='<a href="/nachrichten.php?t=1&id=6">Report a problem</a>';
$art_info=$plan='';
if(!isset($timer)){$timer=3;}
$serverStatus = $database->getServerStatus();
$isFinished =  $serverStatus['isFinished'];
if(!$isFinished && OPENING>time()) {


    $time=$generator->getTimeFormat((OPENING-time()));
    $start= "<br /><b>The server will be started in: <span id=\"timer".$timer."\">".$time."</span> </b><br /><br />";
    $timer++;
    $i++;
}
if(!$isFinished && ARTEFACTS>time()) {


    $time=$generator->getTimeFormat((ARTEFACTS-time()));
    $art_info= "<br /><b>Artifact will be released in: <span id=\"timer".$timer."\">".$time."</span> </b><br /><br />";
    $timer++;
    $i++;
}
if(!$isFinished && WW_PLAN>time()) {


    $time=$generator->getTimeFormat((WW_PLAN-time()));
    $plan= "<br /><b>Building plan will be released in: <span id=\"timer".$timer."\">".$time."</span> </b><br />";
    $timer++;
    $i++;
}


if(!$isFinished && NATARS_TIME>time()) {


    $time=$generator->getTimeFormat((NATARS_TIME-time()));
    $natar= "<br /><b>Natars will start building in: <span id=\"timer".$timer."\">".$time."</span> </b><br /><br />";
    $timer++;
    $i++;
}


if($isFinished!=false){
    $now = time();
    $restartDate = $serverStatus['restartTime'];
    
    $date1 = new DateTime();$date1->setTimestamp($now);
    $date2 = new DateTime();$date2->setTimestamp($restartDate);
    $diff = $date2->diff($date1);
    if($diff->y > 0 || $diff->d > 0 || $diff->h > 0 && $diff->invert){  
        $disabled = true;
        $duration = $generator->getTimeFormat($restartDate-time());
        $restart= "<br /><b>Server will restart in: <span id=\"timer".$timer."\">".$duration."</span> </b><br /><br />";
        $timer++;   
    }
}


if($i > 0){
    ?>
        <div id="sidebarBoxInfobox" class="sidebarBox toggleable expanded">
            <div class="sidebarBoxBaseBox">
                <div class="baseBox baseBoxTop">
                    <div class="baseBox baseBoxBottom">
                        <div class="baseBox baseBoxCenter"></div>
                    </div>
                </div>
            </div>
            <div class="sidebarBoxInnerBox">
                <div class="innerBox header ">

                    <span class="messageShortInfo">
                        <?php
echo $i;
?>
                        ‎‭‭‬×‬‎<img class="messages" src="img/x.gif" alt="Total messages: <?php echo $i;?>">
                    </span>
                </div>
                <div class="innerBox content">
                    <div class="boxTitle">
                        <?php echo infobox_desc_text_1; ?>
                    </div>
                    <ul>
                        <li><b>KIND REMINDER - MULTIACCOUNT IS FORBIDDEN</b> and results in ban</li>
                    </ul>
                    <ul>
                        <li>From now on - accounts inactive for more than 7 days will be removed.</li>
                    </ul>

                    <ul>
                        <?php
                    $k = 0;
                    if(PROTECTION > $session->protection-time() && $session->protection-time()>0  && $session->protect==1){
                        $k++;

                        $uurover=$generator->getTimeFormat($session->protection-time());
                        ?>
                        <li id="infoID_<?php echo $i; ?>" <?php if($first=='protect' ){ echo "  class=\"
                            firstElement\""; }?>>
                            <?php echo sprintf(PROTECTION_TIME,$uurover);?>
                        </li>
                        <?php
                    }
                    elseif($timestamp) {
                        $k++;
                        $time=$generator->getTimeFormat(($timestamp-time()));
                        ?>
                        <li id="infoID_<?php echo $i; ?>" <?php if($first=='delete' ){ echo "  class=\" firstElement\"";
                            }?>
                            >
                            <?php echo sprintf(ACCOUNT_DELETION,$time);?>
                        </li>
                        <?php
                    }

                    ?>
                    <li>
                        <?php echo $infa;?>
                    </li>
                    <li>
                        <?php echo $art_info;
                    ?>
                    </li>
                    <li>
                        <?php echo $plan;
                    ?>
                    </li>
                    <li>
                        <?php 
                    echo $natar;
                    ?>
                    </li>
                    <li>
                        <?php echo $restart; ?>
                    </li>
                    </ul>

                    <!-- <head>
                        <title>+1 Aspida: Basic page</title>
                        <link rel="canonical" href="https://www.aspidanetwork.com" />

                        </html> -->
                </div>

                <div class="innerBox footer toggle">
                    <button type="button" class="toggleBox" onclick="" title="Hide information">
                        <div class="button-container addHoverClick ">
                            <?php echo getsvgicon();?>
                        </div>
                    </button>
                    <script type="text/javascript">
                        window.addEvent('domready', function () {
                            Travian.Translation.add(
                                {
                                    'infobox_collapsed': 'نشان دادن پیام',
                                    'infobox_expanded': 'نشان ندادن پیام'
                                });

                            var box = $('sidebarBoxInfobox');
                            box.down('button.toggleBox').addEvent('click', function (e) {
                                Travian.Game.Layout.toggleBox(box, 'travian_toggle', 'infobox');
                            });
                        });
                    </script>

                    <script type="text/javascript">
                        window.addEvent('domready', function () {
                            Travian.Game.Layout.setInfoboxItemsRead();
                        });
                    </script>
                </div>
            </div>
        </div>
        <?php } ?>
        <!-- New add start-->
        <div class="sidebarBox   " id="sidebarBoxQuestachievements">
            <div class="sidebarBoxBaseBox">
                <div class="baseBox baseBoxTop">
                    <div class="baseBox baseBoxBottom">
                        <div class="baseBox baseBoxCenter"></div>
                    </div>
                </div>
            </div>
            <div id="vote-box" class="sidebarBoxInnerBox">
                <div class="innerBox header ">
                    <div class="travianBirthdayRibbon">
                        </div>
                    </div>
                    <div class="innerBox content">
                        <div class="headline boxTitle">
                            Get free Gold
                        </div>
                    <div class="boxTitle">Vote</div>
                    <form>
                        <div class="questAchievementContainer share_buttons">
                            <button questbuttonoverviewachievements="1"
                                class="green questButtonOverviewAchievements goldVote disabled large"
                                value="Подробности" data-id="vote1" data-set="<?=$session->vote1_link?>">
                                <div class="button-container addHoverClick ">
                                    <div class="button-background">
                                        <div class="buttonStart">
                                            <div class="buttonEnd">
                                                <div class="buttonMiddle"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-content" id="vote1">Vote 1</div>
                                </div>
                            </button><br />
                            <button questbuttonoverviewachievements="1"
                                class="green questButtonOverviewAchievements goldVote disabled large"
                                value="Подробности" data-id="vote2" data-set="<?=$session->vote2_link?>">
                                <div class="button-container addHoverClick ">
                                    <div class="button-background">
                                        <div class="buttonStart">
                                            <div class="buttonEnd">
                                                <div class="buttonMiddle"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-content" id="vote2">Vote 2</div>
                                </div>
                            </button><br />
                            <button questbuttonoverviewachievements="1"
                                class="green questButtonOverviewAchievements goldVote disabled large"
                                value="Подробности" data-id="vote3" data-set="<?=$session->vote3_link?>">
                                <div class="button-container addHoverClick ">
                                    <div class="button-background">
                                        <div class="buttonStart">
                                            <div class="buttonEnd">
                                                <div class="buttonMiddle"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-content" id="vote3">Vote 3</div>
                                </div>
                            </button><br />
                            <button class="green questButtonOverviewAchievements disabled share_button" id="fbShareBtn">
                                <div class="button-container addHoverClick ">
                                    <div class="button-background">
                                        <div class="buttonStart">
                                            <div class="buttonEnd">
                                                <div class="buttonMiddle"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-content" id="share1" data-str="Share with FB"><img
                                            src="/<?php echo GP_LOCATE; ?>/img/Facebook-Share-Button.png"
                                            alt="Share with FB" /></div>
                                </div>
                                <script src="https://connect.facebook.net/en_US/all.js" type="text/javascript"></script>
                                <script type="text/javascript">
                                    jQuery(document).ready(function () {
                                        FB.init({
                                            appId: 298703407189076,
                                            status: true,
                                            init: true,
                                            autoRun: false,
                                            viewMode: "website"
                                        });
                                        document.getElementById('fbShareBtn').onclick = function () {
                                            FB.ui(
                                                {
                                                    method: 'share',
                                                    name: 'Join the battle with me!',
                                                    href: 'https://www.aspidanetwork.com/',//https://www.facebook.com/aspidanetwork/posts/1656823734627700',
                                                    picture: 'http://fbrell.com/f8.jpg', //image to be replaced here
                                                    caption: 'JOIN TRAVIAN TODAY!',
                                                    description: 'Come and play Travian with me! Be my ally and help me be one of the best warriors!',
                                                    message: 'This is going to be fun!'
                                                },
                                                function (response) {
                                                    var responseData = new Object();
                                                    responseData.name = "facebook";
                                                    responseData.data = response;
                                                    sendCallbackResult(responseData);
                                                }
                                            );
                                        }
                                    });
                                </script>
                            </button>
                            <script type="text/javascript">
                                /*window.addEvent('domready', function()
                                {
                                if ($('.questButtonOverviewAchievements'))
                                {
                                $('.questButtonOverviewAchievements').addEvent('click', function ()
                                {
                                window.fireEvent('buttonClicked', [this, {"type":"submit", "value":"\u041f\u043e\u0434\u0440\u043e\u0431\u043d\u043e\u0441\u0442\u0438", "name":"", "id":"button545dec96b3573", "class":"green questButtonOverviewAchievements", "title":"", "confirm":"", "onclick":"", "questButtonOverviewAchievements":true, "onClick":"return false;"}]);
                                });
                                }
                                });    */
                            </script>
                            <script>
                                jQuery(document).ready(function () {

                                    function initializeClock(id, endtime) {
                                        var clock = document.getElementById(id);
                                        var timeinterval = setInterval(function () {
                                            var t = getTimeRemainingV(endtime);
                                            clock.innerHTML = '' + t.days + ' : ' +
                                                '' + t.hours + ' : ' +
                                                '' + t.minutes + ' : ' +
                                                '' + t.seconds;

                                            if (t.total <= 0) {
                                                clearInterval(timeinterval);
                                            }
                                        }, 1000);
                                        var t1 = getTimeRemainingV(endtime);
                                        jQuery('#' + id).parent().parent().addClass('disabled');
                                        if (t1.days == 0 && t1.hours == 0 && t1.minutes == 0 && t1.seconds == 0) {
                                            setTimeout(function () {
                                                if (id == 'vote1') {
                                                    var str = 'Vote 1'
                                                } else if (id == 'vote2') {
                                                    var str = 'Vote 2'
                                                } else if (id == 'vote3') {
                                                    var str = 'Vote 3'
                                                }
                                                jQuery('#' + id).html(str);
                                            }, 1000);
                                            jQuery('#' + id).parent().parent().removeClass('disabled');

                                            jQuery('.goldVote[data-id="' + id + '"]').on('click', function (e) {
                                                e.preventDefault();
                                                var sethref = jQuery(this).data('set');
                                                //setTimeout(function(){
                                                window.open(sethref, '_blank');
                                                var newDate = new Date();
                                                var id = jQuery(this).data('id');
                                                /*if(id == 'vote2'){
                                                   newDate.setHours(newDate.getHours() + 3);
                                                }else if(id == 'vote1'){
                                                   newDate.setHours(newDate.getHours() + 12);
                                                }else{
                                                   newDate.setHours(newDate.getHours() + 24);
                                                }*/
                                                /*if(id == 'vote3'){
                                                   newDate.setHours(newDate.getHours() + 24);
                                                }else{
                                                   newDate.setHours(newDate.getHours() + 3);
                                                }*/
                                                newDate.setHours(newDate.getHours() + 3);
                                                newDate.setMinutes(newDate.getMinutes() + 5);
                                                initializeClock(id, newDate);
                                                jQuery(this).off('click');
                                                jQuery('#' + id).parent().parent().addClass('disabled');
                                                //},300);
                                            });

                                        }
                                    }
                                    var vote1 = '<?php echo date('Y-m - d H: i:s',$session->vote1);?>';
                                    var vote2 = '<?php echo date('Y-m - d H: i:s',$session->vote2);?>';
                                    var vote3 = '<?php echo date('Y-m - d H: i:s',$session->vote3);?>';
                                    function getTimeRemainingV(endtime) {
                                        var now = new Date;
                                        var utcDate = (now.getTime() + (now.getTimezoneOffset() * 60000)) / 1000;
                                        //alert(new Date(utcDate*1000));
                                        //var utcDate = new Date().toLocaleString('en-US', { timeZone: 'Europe/Warsaw' });
                                        var offset = 1;//Math.abs(now.getTimezoneOffset()/60);
                                        utcDate = (utcDate - (5 * 60) + (offset * 3600)) * 1000;//(offset*3600)
                                        var t = (Date.parse(endtime) - utcDate);//
                                        var seconds = Math.floor((t / 1000) % 60);
                                        var minutes = Math.floor((t / 1000 / 60) % 60);
                                        var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
                                        var days = Math.floor(t / (1000 * 60 * 60 * 24));

                                        if (seconds < 0) {
                                            seconds = 0;
                                        }
                                        if (minutes < 0) {
                                            minutes = 0;
                                        }
                                        if (hours < 0) {
                                            hours = 0;
                                        }
                                        if (days < 0) {
                                            days = 0;
                                        }


                                        return {
                                            'total': t,
                                            'days': days,
                                            'hours': hours,
                                            'minutes': minutes,
                                            'seconds': seconds
                                        };
                                    }

                                    initializeClock('vote1', vote1);
                                    initializeClock('vote2', vote2);
                                    initializeClock('vote3', vote3);
                                });
                            </script>
                            <script type="text/javascript">
                                function sendCallbackResult(responseData) {
                                    responseData.speed = "<?php echo SPEED ?>";
                                    responseData.sname = "x<?php echo SPEED ?>"
                                    responseData.timestamp = Math.round(new Date().getTime() / 1000);
                                    responseData.uid = <?php echo $session -> uid; ?>;
                                    jQuery.ajax({
                                        method: "POST",
                                        url: "http://aspidanetwork.com/scripts/share/index.php?cmd=shareTheNews&sname=" + responseData.sname,
                                        crossDomain: false,
                                        async: true,
                                        data: {
                                            name: responseData.name,
                                            speed: responseData.speed,
                                            timestamp: responseData.timestamp,
                                            uid: responseData.uid,
                                            data: responseData.data
                                        },
                                        success: function (data) {
                                            if (data) {
                                                data = JSON.parse(data);
                                                if (data.status === true) {
                                                    result = data.response;
                                                    location.reload();
                                                }
                                            }
                                        }
                                    });
                                }


                                function initializeShareClock(id, endtime) {
                                    endtime = endtime - Math.round(new Date().getTime() / 1000);
                                    var seconds = Math.floor((endtime) % 60);
                                    var minutes = Math.floor((endtime / 60) % 60);
                                    var hours = Math.floor((endtime / (60 * 60)) % 24);
                                    var days = Math.floor(endtime / (60 * 60 * 24));
                                    var clock = document.getElementById(id);
                                    var timer = 1;
                                    while (document.getElementById("timer" + timer) != null) {
                                        timer++;
                                    }

                                    if (hours <= 0 && minutes <= 0 && seconds <= 0) {
                                        //jQuery('#' + id).html(jQuery('#' + id).attr('data-str'));
                                        jQuery('#' + id).parent().parent().removeClass('disabled');
                                        jQuery('#' + id).parent().parent().removeClass('green');
                                    }
                                    else {
                                        if (!jQuery('#' + id).parent().parent().hasClass('green')) {
                                            jQuery('#' + id).parent().parent().addClass('green');
                                            jQuery('#' + id).parent().parent().addClass('disabled');
                                        }
                                        clock.innerHTML = "<span id=\"timer" + timer + "\">" + hours + ':' +
                                            '' + minutes + ':' +
                                            '' + seconds + "</span>";
                                        resetCounterForAjax();
                                    }
                                }

                                jQuery(document).ready(function () {
                                    jQuery('.share_buttons button').on('click', function () {
                                        return false;
                                    });

                                    var share1 = '<?php echo $uservote['share_fb']; ?>';

                                    initializeShareClock('share1', share1);
                                });
                            </script>
                            <style>
                                #vote-box button,
                                #vote-box button:hover,
                                #vote-box button:focus {
                                    margin: 5px;
                                }
                            </style>
                        </div>
                    </form>

                    <script type="text/javascript">
                        window.addEvent('domready', function () {
                            Travian.Game.Quest.addListData(
                                { "achievementquests": { "questsTotal": 8, "questsCompleted": 1, "name": "\u0415\u0436\u0435\u0434\u043d\u0435\u0432\u043d\u044b\u0435 \u0437\u0430\u0434\u0430\u043d\u0438\u044f", "quests": { "AchievementQuest_01": { "id": "AchievementQuest_01", "name": "achievementQuests.achQuest_01_name", "category": "achievementquests", "stepType": "achievementtask", "currentStep": 0, "stepCount": 1, "steps": [{ "stepId": 0, "type": "achievementtask", "stepDescription": null }], "answersLink": "http:\/\/t4.answers.travian.ru\/index.php?aid=%%achievementQuests.achQuest_01_answer (ru)%%#go2answer" }, "AchievementQuest_02": { "id": "AchievementQuest_02", "name": "achievementQuests.achQuest_02_name", "category": "achievementquests", "stepType": "achievementtask", "currentStep": 0, "stepCount": 3, "steps": [{ "stepId": 0, "type": "achievementtask", "stepDescription": null }, { "stepId": 1, "type": "achievementtask", "stepDescription": null }, { "stepId": 2, "type": "achievementtask", "stepDescription": null }], "answersLink": "http:\/\/t4.answers.travian.ru\/index.php?aid=%%achievementQuests.achQuest_02_answer (ru)%%#go2answer" }, "AchievementQuest_03": { "id": "AchievementQuest_03", "name": "achievementQuests.achQuest_03_name", "category": "achievementquests", "stepType": "achievementtask", "currentStep": 0, "stepCount": 3, "steps": [{ "stepId": 0, "type": "achievementtask", "stepDescription": null }, { "stepId": 1, "type": "achievementtask", "stepDescription": null }, { "stepId": 2, "type": "achievementtask", "stepDescription": null }], "answersLink": "http:\/\/t4.answers.travian.ru\/index.php?aid=%%achievementQuests.achQuest_03_answer (ru)%%#go2answer" }, "AchievementQuest_04": { "id": "AchievementQuest_04", "name": "achievementQuests.achQuest_04_name", "category": "achievementquests", "stepType": "achievementtask", "currentStep": 0, "stepCount": 1, "steps": [{ "stepId": 0, "type": "achievementtask", "stepDescription": null }], "answersLink": "http:\/\/t4.answers.travian.ru\/index.php?aid=%%achievementQuests.achQuest_04_answer (ru)%%#go2answer" }, "AchievementQuest_05": { "id": "AchievementQuest_05", "name": "achievementQuests.achQuest_05_name", "category": "achievementquests", "stepType": "achievementtask", "currentStep": 0, "stepCount": 3, "steps": [{ "stepId": 0, "type": "achievementtask", "stepDescription": null }, { "stepId": 1, "type": "achievementtask", "stepDescription": null }, { "stepId": 2, "type": "achievementtask", "stepDescription": null }], "answersLink": "http:\/\/t4.answers.travian.ru\/index.php?aid=%%achievementQuests.achQuest_05_answer (ru)%%#go2answer" }, "AchievementQuest_07": { "id": "AchievementQuest_07", "name": "achievementQuests.achQuest_07_name", "category": "achievementquests", "stepType": "achievementtask", "currentStep": 0, "stepCount": 3, "steps": [{ "stepId": 0, "type": "achievementtask", "stepDescription": null }, { "stepId": 1, "type": "achievementtask", "stepDescription": null }, { "stepId": 2, "type": "achievementtask", "stepDescription": null }], "answersLink": "http:\/\/t4.answers.travian.ru\/index.php?aid=%%achievementQuests.achQuest_07_answer (ru)%%#go2answer" }, "AchievementQuest_08": { "id": "AchievementQuest_08", "name": "achievementQuests.achQuest_08_name", "category": "achievementquests", "stepType": "achievementtask", "currentStep": 0, "stepCount": 3, "steps": [{ "stepId": 0, "type": "achievementtask", "stepDescription": null }, { "stepId": 1, "type": "achievementtask", "stepDescription": null }, { "stepId": 2, "type": "achievementtask", "stepDescription": null }], "answersLink": "http:\/\/t4.answers.travian.ru\/index.php?aid=%%achievementQuests.achQuest_08_answer (ru)%%#go2answer" }, "AchievementQuest_09": { "id": "AchievementQuest_09", "name": "achievementQuests.achQuest_09_name", "category": "achievementquests", "stepType": "achievementtask", "currentStep": 0, "stepCount": 3, "steps": [{ "stepId": 0, "type": "achievementtask", "stepDescription": null }, { "stepId": 1, "type": "achievementtask", "stepDescription": null }, { "stepId": 2, "type": "achievementtask", "stepDescription": null }], "answersLink": "http:\/\/t4.answers.travian.ru\/index.php?aid=%%achievementQuests.achQuest_09_answer (ru)%%#go2answer" }, "AchievementQuest_10": { "id": "AchievementQuest_10", "name": "achievementQuests.achQuest_10_name", "category": "achievementquests", "stepType": "achievementtask", "currentStep": 0, "stepCount": 3, "steps": [{ "stepId": 0, "type": "achievementtask", "stepDescription": null }, { "stepId": 1, "type": "achievementtask", "stepDescription": null }, { "stepId": 2, "type": "achievementtask", "stepDescription": null }], "answersLink": "http:\/\/t4.answers.travian.ru\/index.php?aid=%%achievementQuests.achQuest_10_answer (ru)%%#go2answer" } } } });
                        });                </script>
                </div>



                <div class="innerBox footer">
                </div>
            </div>
        </div>
        <!-- New add end-->
        <div id="sidebarBoxLinklist" class="sidebarBox   ">
            <div class="sidebarBoxBaseBox">
                <div class="baseBox baseBoxTop">
                    <div class="baseBox baseBoxBottom">
                        <div class="baseBox baseBoxCenter"></div>
                    </div>
                </div>
            </div>
            <div class="sidebarBoxInnerBox">
                <div class="innerBox header ">
                    <button type="button" id="button5225ee283eff4" title="Edit List"
                        class="layoutButton edit<?php if($session->plus){echo 'White';}else{ echo 'Black';}?> <?=$green?>  "
                        onclick="<?php if($session->plus){echo " window.location='spieler.php?s=2' ;";}?> return
                        false;">
                        <div class="button-container addHoverClick ">
                            <img src="img/x.gif" alt="">
                        </div>
                    </button>
                    <div class="clear"></div>
                </div>
                <div class="innerBox content">
                    <div class="boxTitle">
                        <?php echo dorf1_links; ?>
                    </div>
                    <div class="linklistNotice">
                        <?php
                if($session->plus) {
                    $links = $database->getLinks($session->uid);
                    $query = count($links);
                    if($query>0){
                        echo '<div id="linkList" class="listing"><div class="list none">';
                        foreach($links as $link) {
                            echo '<ul><li class="entry">';
                            echo '<a href="'.$link['url'].'" title="'.$link['name'].'">'.$link['name'].'</a></li></ul>';
                        }
                        echo '<div class="pager"><a href="#" class="back" style="display: none; "></a><a href="#" class="next" style="display: none; "></a></div></div></div>';
                    }
                }else{
                    echo Link_desc_text_1;
                }
                ?>
                    </div>
                </div>
                <div class="innerBox footer">
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>