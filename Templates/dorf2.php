<div id="village_map">
    <?php
    if($building->walling()) {
        $wtitle = $building->procResType($building->walling())." Level ".$village->resarray['f40'];
    }
    else {
        $wtitle = ($village->resarray['f40'] == 0)? "Outer building site" : $building->procResType($village->resarray['f40t'],0)." Level ".$village->resarray['f40'];
    }
    ?>
    <map name="clickareas" id="clickareas">
        <?php
        $coords = array(19=>"110,135,132,120,132,121,160,122,179,136,179,151,158,163,128,163,109,149",
            "202,93,223,79,223,79,251,80,271,95,271,109,249,121,220,121,200,108",
            "290,76,311,61,311,62,339,63,359,77,359,92,337,104,308,104,289,90",
            "384,105,406,91,406,91,434,92,453,106,453,121,432,133,402,133,383,120",
            "458,147,479,133,479,133,507,134,527,149,527,164,505,175,476,175,457,162",
            "71,184,92,170,92,171,120,172,140,186,139,201,118,213,88,213,69,199",
            "516,196,538,182,538,182,566,183,585,198,585,212,564,224,534,224,515,211",
            "280,113,301,98,301,99,329,100,349,114,348,169,327,181,298,181,278,168",
            "97,320,118,306,118,307,146,308,166,322,165,337,144,349,114,349,95,335",
            "59,244,80,230,80,230,108,231,128,246,128,260,106,272,77,272,57,259",
            "477,249,498,235,498,235,526,236,546,251,545,265,524,277,494,277,475,264",
            "181,259,202,245,202,245,230,246,250,261,250,275,228,287,199,287,180,274",
            "182,189,203,175,203,175,231,176,251,190,251,205,229,217,200,217,181,204",
            "254,308,276,294,276,294,304,295,324,309,323,324,302,336,272,336,253,323",
            "505,317,526,303,526,303,554,304,574,319,573,333,552,345,522,345,503,332",
            "182,379,204,365,204,365,232,366,251,380,251,395,230,407,200,407,181,394",
            "324,370,345,356,345,357,373,358,393,372,392,387,371,398,341,398,322,385",
            "433,334,454,320,454,321,482,322,502,336,502,351,480,362,451,362,432,349",
            "271,412,292,398,292,399,320,400,340,414,339,429,318,440,289,440,269,427",
            "396,396,417,381,417,382,445,383,465,397,464,412,443,424,413,424,394,410",
            "398,212,412,250,369,301,394,323,445,286,453,233,427,183",
            "71,450,2,374,3,374,-10,243,13,142,120,81,214,34,340,18,500,43,615,130,641,239,643,350,601,425,534,494,358,534,282,532,180,526,77,456,117,378,163,413,242,442,331,454,425,443,499,417,576,344,596,304,598,221,571,157,481,90,385,61,313,56,217,72,135,113,77,165,46,217,44,269,65,326,119,379");
       $iso_cor= array(1=>'style="left:81px; top:57px; z-index:19"','style="left:174px; top:15px; z-index:17"','style="left:261px; top:-3px; z-index:15"',
           'style="left:354px; top:26px; z-index:17"','style="left:428px; top:69px; z-index:20"','style="left:42px; top:107px; z-index:23"',
           'style="left:485px; top:119px; z-index:24"','style="left:249px; top:71px; z-index:20"','style="left:68px; top:241px; z-index:32"',
           'style="left:31px; top:167px; z-index:27"','style="left:448px; top:170px; z-index:27"','style="left:153px; top:183px; z-index:28"',
           'style="left:155px; top:110px; z-index:23"','style="left:227px; top:230px; z-index:32"','style="left:476px; top:238px; z-index:32"',
           'style="left:153px; top:300px; z-index:36"','style="left:295px; top:291px; z-index:36"',
           'style="left:404px; top:254px; z-index:33"','style="left:241px; top:333px; z-index:39"','style="left:365px; top:318px; z-index:38"','style="z-index:28"'
           );
        $levels=array(1=>'left:132px; top:108px','left:225px; top:66px','left:312px; top:48px','left:405px; top:77px',
            'left:479px; top:120px','left:93px; top:158px','left:536px; top:170px','left:300px; top:122px','left:119px; top:292px',
            'left:82px; top:218px','left:499px; top:221px','left:204px; top:234px','left:206px; top:161px','left:278px; top:281px','left:527px; top:289px','left:204px; top:351px',
            'left:346px; top:342px','left:455px; top:305px','left:292px; top:384px','left:416px; top:369px','left:406px; top:225px');
        //print_r($levels);
        $canornot=array();
        $ll=0;
        $demolition = $database->getDemolition($village->wid);
        for($t=19;$t<=40;$t++) {
            $ll++;

            if(($village->resarray['f99t'] == 40 AND ($t)=='26') or ($village->resarray['f99t'] == 40 AND ($t)=='30') or ($village->resarray['f99t'] == 40 AND ($t)=='31') or ($village->resarray['f99t'] == 40 AND ($t)=='32')) {
                echo "<area href=\"build.php?id=99\" title=\"<div style=color:#FFF><b>".$building->procResType(40)."</b></div> ".LVL." ".$village->resarray['f99']."\" coords=\"$coords[$t]\" shape=\"poly\"/>";
            } else {
                $bindicate = $canornot[$ll]= $building->canBuild($t,$village->resarray['f'.$t.'t'],$demolition);
                if($village->resarray['f'.$t.'t'] != 0 && !$building->isMax($village->resarray['f'.$t.'t'],$t)) {
                    $loopsame = $building->isCurrent($t)?1:0;
                    $doublebuild = 0;
                    if ($loopsame>0 && $building->isLoop($t)) {$doublebuild = 1;}
                    $uprequire = $building->resourceRequired($t,$village->resarray['f'.$t.'t'],($loopsame > 0 ? 2:1)+$doublebuild);

                    
                    $title = '<div style=\'color:#FFF\'><b>'.$building->procResType($village->resarray['f'.$t.'t']).' '.LVL.' '.$village->resarray['f'.$t].'</b></div>';
                    if($bindicate!=10 && $bindicate!=1)
                        $title .= sprintf(UPGRADECOST,($village->resarray['f'.$t]+($loopsame > 0 ? 2:1)+$doublebuild)).':<br/>
 <span class=\'resources r1\' style=\'margin-right: 20px;\'> <img src=\'../gpack/delusion_4.5/img/g/lumber_small.png\' > '.$uprequire['wood'].' </span>
<span class=\'resources r2\' style=\'margin-right: 20px;\'> <img src=\'../gpack/delusion_4.5/img/g/clay_small.png\' > '.$uprequire['clay'].' </span>
<span class=\'resources r3\' style=\'margin-right: 20px;\'> <img src=\'../gpack/delusion_4.5/img/g/iron_small.png\' > '.$uprequire['iron'].' </span>
<span class=\'resources r4\' style=\'margin-right: 20px;\'> <img src=\'../gpack/delusion_4.5/img/g/crop_small.png\' > '.$uprequire['crop'].' </span><br>
<span class=\'clocks\'> <img  src=\'../gpack/delusion_4.5/img/g/clock_medium.png\' > '.gmdate("H:i:s", $uprequire['time']).' </span>';
                } else {
                    $title = CS;
                    if(($t == 39) && ($village->resarray['f'.$t] == 0)) {
                        $title = CS;
                    }
                }
                if($_COOKIE['builder']=="Off" || !$village->resarray['f'.$t.'t'] || $bindicate==1 || $bindicate==10){
                echo '<area coords="'.$coords[$t].'" href="build.php?id='.$t.'" alt="" title="'.$title.'" shape="poly"/>';
            }else{
                    echo '<area coords="'.$coords[$t].'" href="dorf2.php?а='.$t.'&c='.$session->checker.'" alt= "" title="'.$title.'" shape="poly"/>';
                }
            }
        }
        ?>
        <?php

        if($village->resarray['f40'] != 0  || $building->walling()) {

            echo "<img src=\"img/x.gif\" class=\"wall g".$building->getWallID()."Top \" alt=\"$wtitle level ".$village->resarray['f40']."\">";
            echo "<img src=\"img/x.gif\" class=\"wall g".$building->getWallID()."Bottom \" alt=\"$wtitle level ".$village->resarray['f40']."\">";
        }
        ?>
    </map>

    <?php

    for ($i=1;$i<=20;$i++) {
        $onconstr[$i]=0;
        if(($village->resarray['f99t'] == 40 AND ($i+18)=='26') or ($village->resarray['f99t'] == 40 AND ($i+18)=='30') or ($village->resarray['f99t'] == 40 AND ($i+18)=='31') or ($village->resarray['f99t'] == 40 AND ($i+18)=='32')) {
        } else {
            $text = "Construction Site";
            $img = "iso";
            if($village->resarray['f'.($i+18).'t'] != 0) {
                $text = $building->procResType($village->resarray['f'.($i+18).'t'])." Level ".$village->resarray['f'.($i+18)];
                $img = "g".$village->resarray['f'.($i+18).'t'];
            }
            foreach($building->buildArray as $job) {
                if($job['field'] == ($i+18)) {
                    $onconstr[$i]=1;
                    $img = 'g'.$job['type'].'b';
                    $text = $building->procResType($job['type'])." Level ".$village->resarray['f'.$job['field']];
                }
            }
            echo "<img ".$iso_cor[$i]." src=\"img/x.gif\" class=\"building  $img\" alt=\"$text\" />";
        }
    }
    if($village->natar){
     foreach($building->buildArray as $job) {
        if($job['field'] == 99) {
            $onconstr[99]=1;
        }
    }
    $canornot[99]= $building->canBuild(99,$village->resarray['f99t'],$demolition);
    }
    if($village->resarray['f39'] == 0) {
        if($building->rallying()) {
            echo "<img src=\"img/x.gif\" style=\"z-index:31\" class=\"dx1 g16b".(($village->natar)?'_ww':'')."\" alt=\"Rally Point ".$village->resarray['f39']."\" />";
        }
        else {
            echo "<img src=\"img/x.gif\" style=\"z-index:31\" class=\"dx1 g16e".(($village->natar)?'_ww':'')."\" alt=\"Rally Point \" />";
        }
    }
    else {
        echo "<img src=\"img/x.gif\" style=\"z-index:31\" class=\"dx1 g16".(($village->natar)?'_ww':'')."\" alt=\"Rally Point ".$village->resarray['f39']."\" />";
    }
    ?>
    <?php
    if($village->resarray['f99t'] == 40) {
        if($village->resarray['f99'] >= 0 && $village->resarray['f99'] <= 9) {
            echo '<img class="ww g40 g40_0" src="img/x.gif" style="z-index:30" alt="Wonder of the World">'; }
        if($village->resarray['f99'] >= 10 && $village->resarray['f99'] <= 19) {
            echo '<img class="ww g40 g40_1" src="img/x.gif" style="z-index:30" alt="Wonder of the World">'; }
        if($village->resarray['f99'] >= 20 && $village->resarray['f99'] <= 29) {
            echo '<img class="ww g40 g40_2" src="img/x.gif" style="z-index:30" alt="Wonder of the World">'; }
        if($village->resarray['f99'] >= 30 && $village->resarray['f99'] <= 39) {
            echo '<img class="ww g40 g40_3" src="img/x.gif" style="z-index:30" alt="Wonder of the World">'; }
        if($village->resarray['f99'] >= 40 && $village->resarray['f99'] <= 49) {
            echo '<img class="ww g40 g40_4" src="img/x.gif" style="z-index:30" alt="Wonder of the World">'; }
        if($village->resarray['f99'] >= 50 && $village->resarray['f99'] <= 59) {
            echo '<img class="ww g40 g40_5" src="img/x.gif" style="z-index:30" alt="Wonder of the World">'; }
        if($village->resarray['f99'] >= 60 && $village->resarray['f99'] <= 69) {
            echo '<img class="ww g40 g40_6" src="img/x.gif" style="z-index:30" alt="Wonder of the World">'; }
        if($village->resarray['f99'] >= 70 && $village->resarray['f99'] <= 79) {
            echo '<img class="ww g40 g40_7" src="img/x.gif" style="z-index:30" alt="Wonder of the World">'; }
        if($village->resarray['f99'] >= 80 && $village->resarray['f99'] <= 89) {
            echo '<img class="ww g40 g40_8" src="img/x.gif" style="z-index:30" alt="Wonder of the World">'; }
        if($village->resarray['f99'] >= 90 && $village->resarray['f99'] <= 94) {
            echo '<img class="ww g40 g40_9" src="img/x.gif" style="z-index:30" alt="Wonder of the World">'; }
        if($village->resarray['f99'] >= 95 && $village->resarray['f99'] <= 99) {
            echo '<img class="ww g40 g40_10" src="img/x.gif" style="z-index:30" alt="Wonder of the World">'; }
        if($village->resarray['f99'] == 100) {
            echo '<img class="ww g40 g40_11" src="img/x.gif" style="z-index:30" alt="Wonder of the World">'; }
    }

    ?>

    <div id="levels" <?php if(isset($_COOKIE['t4level'])) { echo "class=\"on\""; } ?>>
        <?php
        for($i=1;$i<=20;$i++) {
            if ($village->resarray['f'.($i+18)] != 0) {
                echo "<div style=\"".$levels[$i]."\" class=\"colorLayer ".(($onconstr[$i]!=0)?'underConstruction':'')." ".(($canornot[$i]==8 || $canornot[$i]==9)?'good':(($canornot[$i]==10 || $canornot[$i]==1)?'maxLevel':'notNow'))." aid$i\"><div class=\"labelLayer\">".$village->resarray['f'.($i+18)]."</div></div>";
            }
        }
        if($village->resarray['f39'] != 0) {
            echo "<div style=\"".$levels[21]."\" class=\"aid39 ".($building->rallying()>0?'underConstruction':'')." colorLayer ".(($canornot[21]==8 || $canornot[21]==9)?'good':(($canornot[21]==10 || $canornot[21]==1)?'maxLevel':'notNow'))."\"><div class=\"labelLayer\">".$village->resarray['f39']."</div></div>";
        }
        if($village->resarray['f40'] != 0) {
            echo "<div style=\"".$levels[22]."\" class=\"".($building->walling()>0?'underConstruction':'')." colorLayer ".(($canornot[22]==8 || $canornot[22]==9)?'good':(($canornot[22]==10 || $canornot[22]==1)?'maxLevel':'notNow'))." aid40\"><div class=\"labelLayer\">".$village->resarray['f40']."</div></div>";

        }
        if($village->resarray['f99'] != 0) {
            echo "<div style=\"".$levels[23]."\" class=\"".(($onconstr[99]!=0)?'underConstruction':'')." colorLayer ".(($canornot[99]==8 || $canornot[99]==9)?'good':(($canornot[99]==10 || $canornot[99]==1)?'maxLevel':'notNow'))." aid99\"><div class=\"labelLayer\">".$village->resarray['f99']."</div></div>";

        }
        ?>

    </div>

    <img src="img/x.gif" id="lswitch" class="lswitchMinus" onclick="
    $('lswitch').toggleClass('lswitchMinus');
    $('lswitch').toggleClass('lswitchPlus');
    if ($('levels').toggleClass('on').hasClass('on')) {
        document.cookie = 't4level=1; expires=Wed, 1 Jan 2030 00:00:00 GMT'; // Extend the expiration date
    } else {
        document.cookie = 't4level=1; expires=Thu, 01-Jan-1970 00:00:01 GMT';
    }
" />
<img class="clickareas" usemap="#clickareas" src="img/x.gif" alt="" />



</div>
<div class="clear">&nbsp;</div>