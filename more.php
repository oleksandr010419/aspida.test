<?php
include("GameEngine/Protection.php");

include("GameEngine/Village.php");
include "Templates/html.php";

$golds = $database->getUserGold($session->uid);
$today = date("mdHi");

if ($_GET['action'] == FinishBuilding) {    
    $MyVilId = $database->query("SELECT * FROM bdata WHERE `wid`='" . $village->wid . "'");
    $MyVilId2 = $database->query("SELECT * FROM research WHERE `vref`='" . $village->wid . "'");
    
    $buildnum = count($MyVilId);
    $resnum = count($MyVilId2);

    $goldlog = $database->query("SELECT * FROM gold_fin_log");

    if ($session->gold >= 2) {

        if (count($MyVilId) || count($MyVilId2)) {

            $database->query("UPDATE bdata set timestamp = '1' where wid = " . $village->wid . " AND type != '25' OR type != '26'");
            $database->query("UPDATE research set timestamp = '1' where vref = '" . $village->wid . "'");



            $done1 = "Construction <b>" . $buildnum . "</b> Building <b>" . $resnum . "</b> Research completed.";
			$database->modifyGold($session->uid,2,0,"Complete construction and research");
            $database->query("INSERT INTO gold_fin_log VALUES ('" . (count($goldlog) + 1) . "', '" . $village->wid . "', 'Finish construction and research with gold')");
        } else {
            $database->query("INSERT INTO gold_fin_log VALUES ('" . (count($goldlog) + 1) . "', '" . $village->wid . "', 'Failed construction and research with gold')");
        }
    } else {
        $done1 = "Not enough gold!";
    }
} else if ($_GET['action'] == 'Training') {
    //$golds = $database->getUserArray($session->username, 0);

    $uuVilid = $database->query("SELECT * FROM training WHERE `vref`='" . $village->wid . "'");
    
    $buildnum = count($MyVilId);

    $goldlog = $database->query("SELECT * FROM gold_fin_log");

    if ($session->gold >= 10) {

        if (count($MyVilId)) {

            $database->query("UPDATE training set eachtime = '1', timestamp = '1', commence = '1' where `vref` = " . $village->wid . "");

            $done1 = "Construction <b>" . $buildnum . "</b> Soldiers finished.";
			$database->modifyGold($session->uid,10,0,"Complete training");
            $database->query("INSERT INTO gold_fin_log VALUES ('" . (count($goldlog) + 1) . "', '" . $village->wid . "', 'Finish training with gold')");
        } else {
            $database->query("INSERT INTO gold_fin_log VALUES ('" . (count($goldlog) + 1) . "', '" . $village->wid . "', 'Failed training with gold')");
        }
    } else {
        $done1 = "Not enough gold coin";
    }
} elseif ($_GET['action'] == 'buyAdventure') {
    $error = true;
    if ($session->gold >= 2) {
        $database->addAdventure($village->wid, $session->uid, 1);
        $database->modifyGold($session->uid, 2, 0, "Bought Adventure");
        $done1 = "Your purchace is successful.";
        $error = false;
    } else {
        $done1 = "Not enough gold coin";
    }
}

$buildingLevels = array();
$farmLevels5plus = false;
$farmLevels10plus = false;
$farmLevels20plus = false;
//$build = $database->row("SELECT * FROM fdata WHERE vref = ".$village->wid."");
for($i=19;$i<=38;$i++){
    $buildLevel = $village->resarray['f'.$i];
    $buildType = $village->resarray['f'.$i.'t'];

    if($buildLevel!=0 && $buildType!=0){
        //if exists but level is lower than last max
        if((isset($buildingLevels[$buildType]) && $buildingLevels[$buildType]['level']>$buildLevel) || !isset($buildingLevels[$buildType])) {
            $buildingLevels[$buildType] = array('level'=>$buildLevel,'pos'=>$i);
        }
    }
}
for($i=1;$i<=18;$i++){
    $buildLevel = $village->resarray['f'.$i];
    $buildType = $village->resarray['f'.$i.'t'];

    if($buildLevel<5){
        $farmLevels5plus = true;
    }
    if($buildLevel<10){
        $farmLevels10plus = true;
    }
    if($buildLevel<20){
        $farmLevels20plus = true;
    }
}

?>
<body class="v35 webkit chrome statistics">
    <script type="text/javascript">
        window.ajaxToken = 'de3768730d5610742b5245daa67b12cd';
    </script>
    <div id="background"> 
        <div id="headerBar"></div>
        <div id="bodyWrapper"> 
            <img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" /> 
            <div id="header"> 

<?php
include("Templates/topheader.php");
include("Templates/toolbar.php");
?>

            </div>
            <div id="center">
                <a id="ingameManual" href="help.php">
                    <img class="question" alt="Help" src="img/x.gif">
                </a>

                <?php include("Templates/sideinfo.php"); ?>

                <div id="contentOuterContainer" class="size1">

<?php include("Templates/res.php"); ?>
                    <div class="contentTitle">&nbsp;</div> 
                    <div class="contentContainer"> 
                        <div id="content" class="statistics">
                            <script type="text/javascript">
                                window.addEvent('domready', function ()
                                {
                                    $$('.subNavi').each(function (element)
                                    {
                                        new Travian.Game.Menu(element);
                                    });
                                });
                            </script>	
<?php
include("Templates/Plus/pmenu.php");
?>					
                            <h2>Buy buildings and Adventure</h2>	

                            <script type="text/javascript">
                                Travian.Translation.add(
                                        {
                                            'allgemein.anleitung': 'Instructions',
                                            'allgemein.cancel': 'Cancellation',
                                            'allgemein.ok': 'Confirmed',
                                            'cropfinder.keine_ergebnisse': 'It was found matching your search.'
                                        });
                                Travian.applicationId = 'T4.0 Game';
                                Travian.Game.version = '4.0';
                                Travian.Game.worldId = 'ir1010';
                            </script>		


                            </table>
                            <table class="plusFunctions" cellspacing="1">


                                <br/>
                                <thead>
                                    <tr>
                                        <td>Image</td>
                                        <td>Description</td>
                                        <td>Duration</td>
                                        <td>Price</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr>
                                        <td class="adv_img"><img src="img/x.gif" title="Buy an adventure"></td>
                                        <td class="desc">Buy an adventure</td>
                                        <td class="dur">Instant</td>
                                        <td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">2</td>
                                        <td class="act">
											<?php
											if (!empty($golds)) {
												if ($golds >= 2) {
													echo getButton("Buy", 'more.php?action=buyAdventure', false);
												} else {
													echo getButton("Low gold", '', true);
												}
											}
											?>
											</td>
											<tr/>
									
									
									
                                    <tr>
                                        <td class="warehouse_img"><img src="img/x.gif" title="Warehouse"></td>
                                        <td class="desc">Build a Warehouse level 20 in the village.</td>
                                        <td class="dur">Instant</td>
                                        <td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">10</td>
                                        <td class="act">
                                            <?php
                                            if (!empty($golds)) {              
                                                if ($golds >= 10) {
													echo getButton("Build", 'plus.php?id=pbuild&action=warehouse20', false);
												} else {
													echo getButton("Low gold", '', true);
												}
                                            }
                                            ?>


                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="granary_img"><img src="img/x.gif" title="Granary"></td>
                                        <td class="desc">Build a Granary level 20 in the village.</td>
                                        <td class="dur">Instant</td>
                                        <td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">10</td>
                                        <td class="act">
                                            <?php
                                            if (!empty($golds)) {
                                                if ($golds >= 10) {
                                                    echo getButton("Build", 'plus.php?id=pbuild&action=granary20', false);
												} else {
													echo getButton("Low gold", '', true);
												}
                                            }
                                            ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="main_building_img"><img src="img/x.gif" title="Main Building"></td>
                                        <td class="desc">Build the Main Building level 20 in the village.</td>
                                        <td class="dur">Instant</td>
                                        <td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">10</td>
                                        <td class="act">
                                            <?php
                                            if (!empty($golds)) {
                                                if ($village->resarray['f26'] < 20) {
                                                    if ($golds >= 10) {
                                                       echo getButton("Build", 'plus.php?id=pbuild&action=main20', false);
													} else {
														echo getButton("Low gold", '', true);
													}
                                                } else {
                                                    echo getButton("Activated", '', true);
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="img"><img src="img/rally_point.png" height="50" width="50" title="Rally Point"></td>
                                        <td class="desc">Build Rally Point at the village level 20.</td>
                                        <td class="dur">Instant</td>
                                        <td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">20</td>
                                        <td class="act">
                                            <?php
                                            if (!empty($golds)) {
                                                if ($village->resarray['f39'] < 20) {
                                                    if ($golds >= 20) {
														echo getButton("Build", 'plus.php?id=pbuild&action=ordoogah', false);
													} else {
														echo getButton("Low gold", '', true);
													}
                                                } else {
                                                    echo getButton("Activated", '', true);
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td class="img"><img src="img/barracks.png" height="50" width="50" title="Barracks"></td>
                                        <td class="desc">Build a Barracks level 20 in the village.</td>
                                        <td class="dur">Instant</td>
                                        <td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">30</td>
                                        <td class="act">
											<?php
											if (!empty($golds)) {                                                                                 
                                                if(!isset($buildingLevels[19]) || isset($buildingLevels[19]) && $buildingLevels[19]['level']!=20){                                                     
                                                    if ($golds >= 30) {
                                                        echo getButton("Build", 'plus.php?id=pbuild&action=barracks20', false);
                                                    } else {
                                                        echo getButton("Low gold", '', true);
                                                    }   
                                                }else{
                                                     echo getButton("Activated", '', true);   
                                                }
											}
											?>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td class="img"><img src="img/stable.png" height="50" width="50" title="Stable"></td>
                                        <td class="desc">Build a Stable level 20 in the village.</td>
                                        <td class="dur">Instant</td>
                                        <td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">30</td>
                                        <td class="act">
                                            <?php
                                            if (!empty($golds)) {                                                                                 
                                                if(!isset($buildingLevels[20]) || isset($buildingLevels[20]) && $buildingLevels[20]['level']!=20){                                                     
                                                    if ($golds >= 30) {
                                                        echo getButton("Build", 'plus.php?id=pbuild&action=stable20', false);
                                                    } else {
                                                        echo getButton("Low gold", '', true);
                                                    }   
                                                }else{
                                                     echo getButton("Activated", '', true);   
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td class="img"><img src="img/workshop.png" height="50" width="50" title="Workshop"></td>
                                        <td class="desc">Build a Workshop level 20 in the village.</td>
                                        <td class="dur">Instant</td>
                                        <td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">30</td>
                                        <td class="act">
                                            <?php
                                            if (!empty($golds)) {                                                                                 
                                                if(!isset($buildingLevels[21]) || isset($buildingLevels[21]) && $buildingLevels[21]['level']!=20){                                                     
                                                    if ($golds >= 30) {
                                                        echo getButton("Build", 'plus.php?id=pbuild&action=workshop20', false);
                                                    } else {
                                                        echo getButton("Low gold", '', true);
                                                    }   
                                                }else{
                                                     echo getButton("Activated", '', true);   
                                                }
                                            }
                                            ?>
										</td>
                                    </tr>


                                    <tr>
                                        <td class="img"><img src="img/academy.png" height="50" width="50" title="Academy"></td>
                                        <td class="desc">Build an Academy level 20 in the village.</td>
                                        <td class="dur">Instant</td>
                                        <td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">20</td>
                                        <td class="act">
                                            <?php
                                            if (!empty($golds)) {                                                                                 
                                                if(!isset($buildingLevels[22]) || isset($buildingLevels[22]) && $buildingLevels[22]['level']!=20){                                                     
                                                    if ($golds >= 30) {
                                                        echo getButton("Build", 'plus.php?id=pbuild&action=academy20', false);
                                                    } else {
                                                        echo getButton("Low gold", '', true);
                                                    }   
                                                }else{
                                                     echo getButton("Activated", '', true);   
                                                }
                                            }
                                            ?>
										</td>
                                    </tr>


                                    <tr>
                                        <td class="img"><img src="img/smithy.png" height="50" width="50" title="Smithy"></td>
                                        <td class="desc">Build a Smithy level 20 in the village.</td>
                                        <td class="dur">Instant</td>
                                        <td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">30</td>
                                        <td class="act">
											<?php
											if (!empty($golds)) {                                                                                 
                                                if(!isset($buildingLevels[12]) || isset($buildingLevels[12]) && $buildingLevels[12]['level']!=20){                                                     
                                                    if ($golds >= 30) {
                                                        echo getButton("Build", 'plus.php?id=pbuild&action=smithy20', false);
                                                    } else {
                                                        echo getButton("Low gold", '', true);
                                                    }   
                                                }else{
                                                     echo getButton("Activated", '', true);   
                                                }
											}
											?>
										</td>
                                    </tr>


                                    <tr>
                                        <td class="img"><img src="img/treasury.png" height="50" width="50" title="Treasury"></td>
                                        <td class="desc">Build a Treasury level 20 in the village.</td>
                                        <td class="dur">Instant</td>
                                        <td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">30</td>
                                        <td class="act">
											<?php
											if (!empty($golds)) {
												if($village->resarray['f99t'] == 40){
													echo getButton("N/A for WW", '', true);
													
												}else{
													if(!isset($buildingLevels[27]) || isset($buildingLevels[27]) && $buildingLevels[27]['level']!=20){                                                     
														if ($golds >= 30) {
															echo getButton("Build", 'plus.php?id=pbuild&action=treasury20', false);
														} else {
															echo getButton("Low gold", '', true);
														}   
													}else{
														 echo getButton("Activated", '', true);   
													}
												}
											}
											?>
										</td>
                                    </tr>


                                    <tr>
                                        <td class="img"><img src="img/tournament_square.png" height="50" width="50" title="Tournament Square"></td>
                                        <td class="desc">Build a Tournament Square level 20 in the village.</td>
                                        <td class="dur">Instant</td>
                                        <td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">30</td>
                                        <td class="act">
											<?php
											if (!empty($golds)) {                                                                                 
                                                if(!isset($buildingLevels[14]) || isset($buildingLevels[14]) && $buildingLevels[14]['level']!=20){                                                     
                                                    if ($golds >= 30) {
                                                        echo getButton("Build", 'plus.php?id=pbuild&action=tournament_square20', false);
                                                    } else {
                                                        echo getButton("Low gold", '', true);
                                                    }   
                                                }else{
                                                     echo getButton("Activated", '', true);   
                                                }
											}
											?>	
                                        </td>
                                    </tr>


                                    <tr>
                                        <td class="img"><img src="img/resources.png" height="50" width="180" title="Resources lvl 5"></td>
                                        <td class="desc">Upgrade all your resources fields to level 5</td>
                                        <td class="dur">Instant</td>
                                        <td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">150</td>
                                        <td class="act">
                                            <?php
                                            if (!empty($golds)) {
                                                if($farmLevels5plus){
                                                    if ($golds >= 150) {
                                                        echo getButton("Build", 'plus.php?id=traviann&action=manba2', false);
    												} else {
    													echo getButton("Low gold", '', true);
    												}
                                                }else{
                                                     echo getButton("Activated", '', true);   
                                                }
                                            }
                                            ?>

                                        </td>
                                    </tr>


                                    <tr>
                                        <td class="img"><img src="img/resources.png" height="50" width="180" title="Resources lvl 10"></td>
                                        <td class="desc">Upgrade all your resources fields to level 10</td>
                                        <td class="dur">Instant</td>
                                        <td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">300</td>
                                        <td class="act">
                                            <?php
                                            if (!empty($golds)) {
                                                if($farmLevels10plus){
                                                    if ($golds >= 300) {
    													echo getButton("Build", 'plus.php?id=traviann&action=manba', false);
    												} else {
    													echo getButton("Low gold", '', true);
    												}
                                                }
                                                else{
                                                     echo getButton("Activated", '', true);   
                                                }
                                            }
                                            ?>

                                        </td>
                                    </tr>


                                    <tr>
                                        <td class="img"><img src="img/resources.png" height="50" width="180" title="Resources lvl 20"></td>
                                        <td class="desc"><br/>Upgrade all your resources fields to level 20</td>
                                        <td class="dur">Instant</td>
                                        <td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">500</td>
                                        <td class="act">
											<?php
											if (!empty($golds)) {
                                                if($farmLevels20plus){
    												if ($golds >= 500 && $village->capital) {
    													echo getButton("Build", 'plus.php?id=traviann&action=manba3', false);
    												}else if(!$village->capital){
														echo getButton("Only for capital village", '', true);
													} 													
													else {
    													echo getButton("Low gold", '', true);
    												}
                                                }
                                                else{
                                                     echo getButton("Activated", '', true);   
                                                }
											}
											?>
                                        </td>
                                    </tr>


                                </tbody>
                            </table><br/>
                            <?php /*<font size=2>Quick construction, the population will not be added. <br/> If construct troops in  more than one barracks, stables or workshop, you do not construct more troops quicker. The troops are just lined up in a queue.</font>*/?>
                            <div class="clear">&nbsp;</div>



                            <div class="clear">&nbsp;</div>




                            <div class="clear">&nbsp;</div>
                        </div>
                        <div class="clear"></div>


                    </div>
                    <div class="contentFooter">&nbsp;</div>

                </div>
                                            <?php
                                            include("Templates/rightsideinfor.php");
                                            ?>
                <div class="clear"></div>
            </div>
                                            <?php
                                            include("Templates/footer.php");
                                            include("Templates/header.php");
                                            ?>
        </div>
        <div id="ce"></div>
    </div>
</body>
</html>
