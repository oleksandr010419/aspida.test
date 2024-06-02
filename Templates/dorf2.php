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
        $coords = array(19=>"110,135,132,120,132,121,160,122,179,136,179,151,158,163,128,163,109,149",//19
							"202,113,223,99,223,99,251,100,271,115,271,129,249,141,220,141,200,128",//20
							"290,106,311,91,311,92,339,93,359,107,359,122,337,134,308,134,289,120",//21
							"404,105,426,91,426,91,454,92,473,106,473,121,472,133,422,133,403,120",//22
							"498,147,519,133,519,133,547,134,567,149,567,164,545,175,516,175,497,162",//23
							"56,204,77,190,77,191,105,192,125,206,124,221,103,233,73,233,54,219",//24
							"526,206,548,192,548,192,576,193,595,208,595,222,574,234,544,234,525,221",//25
							"157,204,178,190,178,190,206,191,226,205,226,220,204,232,175,232,156,219",//26
							"77,340,98,326,98,327,126,328,146,342,145,357,124,369,94,369,75,355",//27
							"29,264,50,250,50,250,78,251,98,266,98,280,76,292,47,292,27,279",//28
							"367,159,388,145,388,145,416,146,436,161,435,175,414,187,384,187,365,174",//29
							"166,279,187,265,187,265,215,266,235,281,235,295,213,307,184,307,165,294",//30
							"289,220,310,206,310,207,338,208,358,222,357,237,336,248,306,248,287,235",//31
							"254,330,275,316,275,317,303,318,323,332,322,347,301,358,271,358,252,345",//32
							"515,297,536,283,536,283,564,284,584,299,583,313,562,325,532,325,513,312",//33
							"162,379,184,365,184,365,212,366,231,380,231,395,210,407,180,407,161,394",//34
							"359,330,380,316,380,317,408,318,428,332,427,347,406,358,376,358,357,345",//35
							"483,354,504,340,504,341,532,342,552,356,552,371,530,382,501,382,482,369",//36
							"271,412,292,398,292,399,320,400,340,414,339,429,318,440,289,440,269,427",//37
							"366,396,387,381,387,382,415,383,435,397,434,412,413,424,383,424,364,410",//38
							"438,212,452,250,409,301,434,323,485,286,493,233,467,183",//39
							"71,450,2,374,3,374,-10,243,13,142,120,81,214,34,340,18,500,43,615,130,641,239,643,350,601,425,534,494,358,534,282,532,180,526,77,456,117,378,163,413,242,442,331,454,425,443,499,417,576,344,596,304,598,221,571,157,481,90,385,61,313,56,217,72,135,113,77,165,46,217,44,269,65,326,119,379");
$iso_cor= array(1=>	'style=	"left:81px; top:77px; z-index:19"',//19
							'style="left:165px; top:45px; z-index:17"',//20
							'style="left:261px; top:31px; z-index:15"',//21
							'style="left:379px; top:41px; z-index:17"',//22
							'style="left:485px; top:77px; z-index:20"',//23
							'style="left:23px; top:134px; z-index:23"',//24
							'style="left:516px; top:159px; z-index:24"',//25
							'style="left:121px; top:136px; z-index:28"',//26
							'style="left:48px; top:276px; z-index:32"',//27
							'style="left:6px; top:202px; z-index:27"',//28
							'style="left:334px; top:93px; z-index:27"',//29
							'style="left:132px; top:217px; z-index:28"',//30
							'style="left:275px; top:149px; z-index:23"',//31
							'style="left:227px; top:270px; z-index:32"',//32
							'style="left:507px; top:225px; z-index:32"',//33
							'style="left:133px; top:318px; z-index:36"',//34
							'style="left:345px; top:259px; z-index:36"',//35
							'style="left:467px; top:287px; z-index:33"',//36
							'style="left:241px; top:340px; z-index:39"',//37
							'style="left:337px; top:337px; z-index:38"',//38
							'style="z-index:28"'
           );
        $levels=array(1=>'left:127px; top:121px',//19
						'left:208px; top:95px',//20
						'left:305px; top:78px',//21
						'left:422px; top:90px',//22
						'left:529px; top:126px',//23
						'left:67px; top:181px',//24
						'left:559px; top:208px',//25
						'left:166px; top:185px',//26
						'left:90px; top:323px',//27
						'left:49px; top:251px',//28
						'left:378px; top:142px',//29
						'left:175px; top:266px',//30
						'left:320px; top:200px',//31
						'left:270px; top:319px',//32
						'left:552px; top:277px',//33
						'left:177px; top:369px',//34
						'left:389px; top:310px',//35
						'left:510px; top:336px',//36
						'left:285px; top:389px',//37
						'left:380px; top:385px',//38
						'left:458px; top:241px');//39
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