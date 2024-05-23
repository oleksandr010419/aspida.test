<map name="rx" id="rx">
    <?php
	$coorarray = array(1=>"137,92,25","227,93,25","295,105,25","79,131,25","192,144,25","249,151,25","334,149,25","19,182,25","100,183,25","290,183,25","377,183,25","27,243,25","100,233,25","236,269,25","358,238,25",
	"131,323,25","222,328,25","312,305,25");
	$stylecoorarray = array(1=>array(180,80),array(269,81),array(338,93),array(122,119),array(235,132),array(292,139),array(377,137),array(62,170),array(143,171),array(333,171),array(420,171),array(70,231),array(143,221),array(279,257),array(401,226),array(174,311),array(265,316),array(355,293));
	$canornot=array();
    $demolition = $database->getDemolition($village->wid);
    for($i=1;$i<=18;$i++) {
        $loopsame = $building->isCurrent($i)?1:0;
        $doublebuild = 0;
        $canornot[$i]=$building->canBuild($i,$village->resarray['f'.$i.'t'],$demolition);
        if($canornot[$i]!=1 && $canornot[$i]!=10){
        if ($loopsame>0 && $building->isLoop($i)) {$doublebuild = 1;}
        $uprequire  = $building->resourceRequired($i,$village->resarray['f'.$i.'t'],($loopsame > 0 ? 2:1)+$doublebuild);
        $level_b= $village->resarray['f'.$i]+($loopsame > 0 ? 2:1)+$doublebuild;
            if($_COOKIE['builder']=="Off" || $building->isMax($village->resarray['f'.$i.'t'],$i)){
        echo '<area href="build.php?id='.$i.'" coords="'.$coorarray[$i].'" shape="circle" title="<div style=\'color:#FFF; font-size: 13px;\'><b>'.constant('B'.$village->resarray['f'.$i.'t']).' '.LVL.' '.$village->resarray['f'.$i].'</b></div> ';
            }else{
                echo '<area href="dorf1.php?а='.$i.'&c='.$session->checker.'" coords="'.$coorarray[$i].'" shape="circle" title="<div style=\'color:#FFF; font-size: 13px;\'><b>'.constant('B'.$village->resarray['f'.$i.'t']).' '.LVL.' '.$village->resarray['f'.$i].'</b></div> ';

            }
                if($level_b) echo sprintf(UPGRADECOST,($village->resarray['f'.$i]+($loopsame > 0 ? 2:1)+$doublebuild)).':<br/>
<span class=\'resources r1\' style=\'margin-right: 20px;\'> <img src=\'../gpack/delusion_4.5/img/g/lumber_small.png\' > '.$uprequire['wood'].' </span>
<span class=\'resources r2\' style=\'margin-right: 20px;\'> <img src=\'../gpack/delusion_4.5/img/g/clay_small.png\' > '.$uprequire['clay'].' </span>
<span class=\'resources r3\' style=\'margin-right: 20px;\'> <img src=\'../gpack/delusion_4.5/img/g/iron_small.png\' > '.$uprequire['iron'].' </span>
<span class=\'resources r4\' style=\'margin-right: 20px;\'> <img src=\'../gpack/delusion_4.5/img/g/crop_small.png\' > '.$uprequire['crop'].' </span><br>
<span class=\'clocks\'> <img  src=\'../gpack/delusion_4.5/img/g/clock_medium.png\' > '.gmdate("H:i:s", $uprequire['time']).' </span>';


 
        echo '"/>';
        }elseif($canornot[$i]==1){
            echo '<area href="build.php?id='.$i.'" coords="'.$coorarray[$i].'" shape="circle" title="<div style=\'color:#FFF\'><b>The field is in the maximum level</div>"/>';
        }elseif($canornot[$i]==10){
            echo '<area href="build.php?id='.$i.'" coords="'.$coorarray[$i].'" shape="circle" title="<div style=\'color:#FFF\'><b>Construct to the maximum level</div>"/>';
        }
    }
    ?>
	
    <area href="dorf2.php" coords="185,201,34" shape="circle" title="<?php echo BUILDINGS; ?>">
</map>
<img id="resfeld" usemap="#rx" src="img/x.gif" alt="">
<div id="village_map" class="f<?php echo $village->type; ?>">

    <?php
    for($i=1;$i<=18;$i++) {
        if($village->resarray['f'.$i.'t'] != 0) {
            $text = "";
            $onconstr=$building->isCurrent($i)+$building->isLoop($i);
            $style = 'left:'.($stylecoorarray[$i][0]-1).'px;top:'.($stylecoorarray[$i][1]-2).'px;';

            //if($village->resarray['f'.$i] != 0) {
            echo "<div class='level colorLayer ".(($onconstr>0)?'underConstruction':'')." ".(($canornot[$i]==8 || $canornot[$i]==9)?'good':(($canornot[$i]==10 || $canornot[$i]==1)?'maxLevel':'notNow'))."' style=\"".$style." \"><div class=\"labelLayer\">".($village->resarray['f'.$i]==0?'':$village->resarray['f'.$i])."</div></div> ";
            //}
        }
    }
    ?>
    <img id="resfeld" usemap="#rx" src="img/x.gif" alt="">
</div>
