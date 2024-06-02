<?php
if(!isset($id)){$id=0;}
$buildcostr=$database->getJobs1($village->wid);
$category = $_GET['category'];
if(!in_array($category,array(1,2,3))){
	$category = 1;
}
?>
<h1 class="titleInHeader"><?=build437?></h1>
<div id="build" class="gid0">
<div class="contentNavi subNavi tabWrapper">
                    <div class="container infrastructure <?php echo ($category==1 || !isset($category))?"active":"normal";?>">
                <div class="background-start">&nbsp;</div>
                <div class="background-end">&nbsp;</div>
                <div class="content">

                                        <a id="button59a98e78ab50d" href="build.php?id=<?php echo $id;?>&amp;category=1" class="tabItem">
					Infrastructure                                                					</a>
				                </div>
            </div>

                            <script type="text/javascript">
                    if ($('button59a98e78ab50d')) {
                        $('button59a98e78ab50d').addEvent('click', function () {
                            window.fireEvent('tabClicked', [this, {"class":"infrastructure active","title":"Infrastructure","target":false,"id":"button59a98e78ab50d","href":"build.php?id=<?php echo $id;?>&amp;category=1","onclick":false,"enabled":true,"text":"Infrastructure","dialog":false,"plusDialog":false,"goldclubDialog":false,"containerId":"","buttonIdentifier":"button59a98e78ab50d"}]);

                        });
                    }
                </script>
            
                    <div class="container military <?php echo ($category==2)?"active":"normal";?>">
                <div class="background-start">&nbsp;</div>
                <div class="background-end">&nbsp;</div>
                <div class="content">

                                        <a id="button59a98e78ab55d" href="build.php?id=<?php echo $id;?>&amp;category=2" class="tabItem">
					Military                                                					</a>
				                </div>
            </div>

                            <script type="text/javascript">
                    if ($('button59a98e78ab55d')) {
                        $('button59a98e78ab55d').addEvent('click', function () {
                            window.fireEvent('tabClicked', [this, {"class":"military normal","title":"Military","target":false,"id":"button59a98e78ab55d","href":"build.php?id=<?php echo $id;?>&amp;category=2","onclick":false,"enabled":true,"text":"Military","dialog":false,"plusDialog":false,"goldclubDialog":false,"containerId":"","buttonIdentifier":"button59a98e78ab55d"}]);

                        });
                    }
                </script>
            
                    <div class="container resources <?php echo ($category==3)?"active":"normal";?>">
                <div class="background-start">&nbsp;</div>
                <div class="background-end">&nbsp;</div>
                <div class="content">

                                        <a id="button59a98e78ab5a7" href="build.php?id=<?php echo $id;?>&amp;category=3" class="tabItem">
					Resources                                                					</a>
				                </div>
            </div>

                            <script type="text/javascript">
                    if ($('button59a98e78ab5a7')) {
                        $('button59a98e78ab5a7').addEvent('click', function () {
                            window.fireEvent('tabClicked', [this, {"class":"resources normal","title":"Resources","target":false,"id":"button59a98e78ab5a7","href":"build.php?id=<?php echo $id;?>&amp;category=3","onclick":false,"enabled":true,"text":"Resources","dialog":false,"plusDialog":false,"goldclubDialog":false,"containerId":"","buttonIdentifier":"button59a98e78ab5a7"}]);

                        });
                    }
                </script>
            
                
        <div class="clear"></div>
    </div>
	<script type="text/javascript">
        window.addEvent('domready', function () {
            $$('.subNavi').each(function (element) {
                new Travian.Game.Menu(element);
            });
        });
    </script>
	
	
	

	
	
<?php
$category_1 = array(10,11,15,16,17,18,24,25,26,27,28,34,35,36,37,38,39,40,44);
$category_2 = array(12,14,19,20,21,22,23,29,30,31,32,33,41,42,43,47);
$category_3 = array(5,6,7,8,9,45);

if($id == 39){
	$category_1 = array(16);
	$category_2 = array();
	$category_3 = array();
	
}else if($id==40){
	$category_2 = array();
	$category_1 = array(31,32,33,42,43,47);
	$category_3 = array();
}

//for($i=5;$i<=50;$i++){
foreach(${'category_'.$category} as $i){
    $true[$i]=$building->AvalibleBuilds($i,$buildcostr);
if($true[$i]){// && ($id!=39 && $id!=40 || ($id==39 && $i==16 || $id==40 && ($i==31 || $i==32 || $i == 33 || $i == 42 || $i == 43)))){
    ?>
<h2><?=$lang['buildings'][$i]?></h2>
    <div class="build_desc">
        <a  class="build_logo">
            <img class="building big white g<?=$i;?>" src="img/x.gif" alt="">
        </a>
        <?=$lang['desc'][$i][0]?></div>


        <?php
        $bid = $i;
        include("availupgrade.php");
        ?>
        <div class="clear"></div><hr>
<?php
}
}



if($id != 39 && $id != 40) {
?>

    <h4 class="round spacer"><?=build438?></h4>

<?php
//for($i=5;$i<=50;$i++){
foreach(${'category_'.$category} as $i){
if($building->soonBuilds($i,$buildcostr) && !$true[$i]){
?><h2><?=$lang['buildings'][$i]?></h2>
        <div class="build_desc">
            <a class="build_logo">
                <img class="building big white g<?=$i?>" src="img/x.gif" alt="Academy"> </a>
            <?=$lang['desc'][$i][0]?> </div>
        <div id="contract" class="contract contractNew contractWrapper">
        <div class="contractLink">
            <div class="contractText"><?=build439?>:</div>
    <span class="buildingCondition">

            <?php
            $need ='';
            $to= count($lang['descs'][$i]);
            $j=0;
            if(!empty($lang['descs'][$i])){
             foreach($lang['descs'][$i] as $llang){
                 $j++;
                 $need.= " <a>".$lang['buildings'][$llang[0]]."</a> ".build440." ".$llang[1];
                 if($j!=$to){$need.=",";}
                 }
            }
            echo $need;
            ?>    </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div><hr>

<?php }
    }

   ?>
    </div>

<?php
}else{
    echo "</div>";
}
?>

