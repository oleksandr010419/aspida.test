<?php
if ($tribe == 1) {
    $tp = 100;
} else {
    $tp = 80;
}


ob_start();
$availiblepoint = $session->heroD['level'] * 4;

$freepoints = $availiblepoint - ($session->heroD['power'] + $session->heroD['offBonus'] + $session->heroD['defBonus'] + $session->heroD['product']);
$rp = 3 * SPEED * $session->heroD['product'];
?>

<div id="attributes" class="hero-alive">
<?php if ($session->heroD['dead'] == 0) { ?>
<div class="boxes boxesColor gray">
<div class="boxes-tl"></div>
<div class="boxes-tr"></div>
<div class="boxes-tc"></div>
<div class="boxes-ml"></div>
<div class="boxes-mr"></div>
<div class="boxes-mc"></div>
<div class="boxes-bl"></div>
<div class="boxes-br"></div>
<div class="boxes-bc" ></div>
    <div class="boxes-contents cf">

        <div class="attribute heroStatus">
            <div class="heroStatusMessage ">
                <img alt ="В родной деревне" src="img/x.gif" class="heroStatus100" />
                <?=$where2?>
               	</div>

        </div>

        <div class="attribute heroStatus">
            <?php if($session->heroD['hide']==0){ echo HEROI39;}else{ echo HEROI40;}?></div>

        <div class="attribute health tooltip" title="<?php echo HEROI25?>||<?php echo HEROI44;?>">
            <div class="element attribName"><?php echo HEROI25?></div>
            <div class="element current powervalue"><span class="value"><b><?php echo round($session->heroD['health']); ?></b></span>%</div>
            <div class="element progress">
                <div class="bar-bg">
                    <?php
                    if ($session->heroD['health'] <= 10) {
                        $color = '#F00';
                    } elseif ($session->heroD['health'] <= 25) {
                        $color = '#F0B300';
                    } elseif ($session->heroD['health'] <= 50) {
                        $color = '#FFFF00';
                    } elseif ($session->heroD['health'] <= 90) {
                        $color = '#99C01A';
                    } else {
                        $color = '#006900';
                    }
                    ?>
                    <div class="bar"
                         style="width:<?php echo $session->heroD['health']; ?>%;background-color:<?php echo $color; ?>"></div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="clear"></div>

        <div class="attribute experience tooltip"   title="<?php if($session->heroD['level']!=100){  ?><?=HEROI33?>||<?php echo HEROI31.' '; echo($hero_levels[$session->heroD['level'] + 1]
            - $session->heroD['experience']); 
       ?> <?=HEROI32?> <?php echo($session->heroD['level'] + 1); ?> <?php  }else{ echo 'Max level'; } ?>">
            <div class="element attribName"><?php echo HEROI33;?></div>
            <div class="element current powervalue experience points"><b><?=$session->heroD['experience']?></b></div>
            <div class="element progress">
                <div class="bar-bg">
                    <div class="bar" style="width:<?php
                    if($session->heroD['level']!=100){
                    echo round(100 * (($hero_levels[$session->heroD['level']] - $session->heroD['experience']) /
                            ($hero_levels[$session->heroD['level']] - $hero_levels[$session->heroD['level'] + 1])), 1); }else { echo '100';} ?>%;background-color:#006900"></div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <div class="attribute">

            <div class="speed tooltip" title="<?php echo HEROI45?>||<?php echo HEROI46?>&lt;br /&gt;&lt;span class=&quot;
            heroAttributeInformation&quot;&gt;<?php echo HEROI37;echo '&nbsp;'; echo $session->heroD['speed'] * INCREASE_SPEED;  echo '&nbsp;'; echo HEROI38;?> &lt;/span&gt;">
                <div class="element attribName"><?php echo HEROI37;?></div>
                <div class="element powervalue">
                    <span class="current"><b><?php echo $session->heroD['speed'] * INCREASE_SPEED; ?></b></span> <?php echo HEROI38;?>   		</div>
            </div>
            <div class="production tooltip" title="<?php echo HEROI43?>||<?php echo HEROI47;?>&lt;br /&gt;&lt;span class=&quot;
            heroAttributeInformation&quot;&gt;<?php echo HEROI43?>&lt;img title=&quot;Все ресурсы&quot; alt=&quot;
            Все ресурсы&quot; class=<?php if($session->heroD['r0'] != 0)
            { echo 'r0';} elseif($session->heroD['r1'] != 0)
            { echo 'r1';} elseif($session->heroD['r2'] != 0)
            { echo 'r2';} elseif($session->heroD['r3'] != 0)
            { echo 'r3';} else {echo 'r4';}?> src=&quot;img/x.gif&quot; /&gt;<?php if ($session->heroD['r0'] != 0) { echo $rp;} else{ echo $session->heroD['product']* 10 * SPEED;}?>
             &lrm;&amp;#x202d;&amp;#x202d;&amp;#x202c;&amp;#x202c;&lrm;&lt;/span&gt;">
			<span>
				<?php echo HEROI43;?>&nbsp;	<img title="Все ресурсы" alt="Все ресурсы" class=<?php if($session->heroD['r0'] != 0)
                { echo 'r0';} elseif($session->heroD['r1'] != 0)
                { echo 'r1';} elseif($session->heroD['r2'] != 0)
                { echo 'r2';} elseif($session->heroD['r3'] != 0)
                { echo 'r3';} else {echo 'r4';}?> src="img/x.gif" />
                <span class="value"><?php if ($session->heroD['r0'] != 0) { echo $rp;} else{ echo $session->heroD['product']* 10 * SPEED;}?>
                </span>
							</span>
									<span>
				+ <img title="Зерно" alt="Зерно" class="r4" src="img/x.gif" />				<span class="current">6</span>
			</span>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>		</div>

</div>
<?php }?>
<?php if ($session->heroD['dead'] == 1) { ?>
<div class="boxes boxesColor red-border">
    <div class="boxes-tl"></div>
    <div class="boxes-tr"></div>
    <div class="boxes-tc"></div>
    <div class="boxes-ml"></div>
    <div class="boxes-mr"></div>
    <div class="boxes-mc"></div>
    <div class="boxes-bl"></div>
    <div class="boxes-br"></div>
    <div class="boxes-bc" ></div>
    <div class="boxes-contents">
		
        <div class="attribute health tooltip"
             title="<?=HEROI23?> <?php echo $session->heroD['autoregen'] * INCREASE_SPEED; ?>% <?=HEROI24?></font>">

       
				
                <div class="clear"></div>

                <?php
                $vRes = ($village->awood + $village->aclay + $village->airon + $village->acrop);
                $hRes = ($hero_t[$session->heroD['level']]['wood'] + $hero_t[$session->heroD['level']]['clay'] + $hero_t[$session->heroD['level']]['iron'] + $hero_t[$session->heroD['level']]['crop']);
                $checkT = $session->heroD['revivetime'] != 0;

                if (!$checkT) {
                    if ($village->awood < $hero_t[$session->heroD['level']]['wood'] || $village->aclay < $hero_t[$session->heroD['level']]['clay'] || $village->airon < $hero_t[$session->heroD['level']]['iron'] || $village->acrop < $hero_t[$session->heroD['level']]['crop']) {
                        echo '<span class="none"> '.HEROI27.'</span>';
                    } else { ?>
					   <div class="heroStatusMessage header error">
	<img alt="Погиб" src="img/x.gif" class="heroStatus101">
			<?=$where2?></a>.	</div>
                        				</br>
				<b><div class="element resourceDemandCaption"><?=HEROI53?></div></b>
                 <?php   }
                } else {
                    if(!isset($timer)){ $timer=1;}
                    echo "".HEROI29." <span id='timer".$timer."'>" . $generator->getTimeFormat($session->heroD['revivetime'] - time()) . "</span></br>";
                }
                if (!$checkT) {
                    ?>
					</br>
					</br>
					
                    <div class="regenerateCosts">
					
                        <div class="showCosts">
            	<span class="resources r1 little_res" title="Wood">
                	<img class="r1" src="img/x.gif" title="Wood"/>
                    <?php echo $hero_t[$session->heroD['level']]['wood']; ?>
                </span>
                <span class="resources r2 little_res" title="Clay">
                	<img class="r2" src="img/x.gif" title="Clay"/>
                    <?php echo $hero_t[$session->heroD['level']]['clay']; ?>
                </span>
                <span class="resources r3 little_res" title="Iron">
                	<img class="r3" src="img/x.gif" title="Iron"/>
                    <?php echo $hero_t[$session->heroD['level']]['iron']; ?>
                </span>
                <span class="resources r4 little_res" title="Crop">
                	<img class="r4" src="img/x.gif" title="Crop"/>
                    <?php echo $hero_t[$session->heroD['level']]['crop']; ?>
                </span>
                <span class="resources r5" title="Crop Consumption">
                	<img class="r5" src="img/x.gif" title="Crop Consumption"/>
                    6
                </span>

                            <div class="clear"></div>
                <span class="clock">
                	<img class="clock" src="img/x.gif" title="<?=HEROI30?>">
                    <?php echo $generator->getTimeFormat(($hero_t[$session->heroD['level']]['time'] / SPEED * 1.5)); ?>
                </span>
				<button type="submit" style="left:300px" value="Revive" name="save" id="save" class="green" onclick="window.location.href = 'hero_inventory.php?revive=1'; return false;">
                                            <div class="button-container addHoverClick ">
                                                <div class="button-background">
                                                    <div class="buttonStart">
                                                        <div class="buttonEnd">
                                                            <div class="buttonMiddle"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="button-content"><?=HEROI28?></div>
                                            </div>
                                        </button>
										<?php if ($hero_t[$session->heroD['level']]['wood'] > $village->awood ||
												  $hero_t[$session->heroD['level']]['clay'] > $village->aclay ||
												  $hero_t[$session->heroD['level']]['iron'] > $village->airon ||
												  $hero_t[$session->heroD['level']]['crop'] > $village->acrop) { ?>
										
                            <button type="button" value="" class="icon"
                                    onclick="window.location.href = 'build.php?gid=17&amp;t=3&amp;r1=<?php echo $hero_t[$session->heroD['level']]['wood']; ?>&amp;r2=<?php echo $hero_t[$session->heroD['level']]['clay']; ?>&amp;r3=<?php echo $hero_t[$session->heroD['level']]['iron']; ?>&amp;r4=<?php echo $hero_t[$session->heroD['level']]['crop']; ?>'; return false;">
                                <img src="img/x.gif" class="npc" alt="npc"></button>
                            <div class="clear"></div>
							<?php }?>
                        </div>
                    </div>
                    <div class="clear"></div>
                <?php }
            ?>
        </div>

        <div class="clear"></div>
    </div>
</div>
<?php } ?>	

<div class="boxes boxesColor gray">

<div class="boxes-tl"></div>
<div class="boxes-tr"></div>
<div class="boxes-tc"></div>
<div class="boxes-ml"></div>
<div class="boxes-mr"></div>
<div class="boxes-mc"></div>
<div class="boxes-bl"></div>
<div class="boxes-br"></div>
<div class="boxes-bc"></div>
<div class="boxes-contents cf">
<div class="openCloseSwitchBar">
    <img alt="Параметры героя" src="img/x.gif" class="openedClosedSwitch switchOpened">
    <span class="title"><?=HEROI48?></span>
    <span class="heroAttributesFormMessage notice hide"><?=HEROI49?></span>
    <div class="clear"></div>
</div>
<div class="heroPropertiesContent <?php if($freepoints<=0){echo 'hide';}?>">
<div class="attribute res" id="setResource">
            <div class="changeResourcesHeadline"><?=HEROI21?></div>
            <div class="clear"></div>
            <div class="resource r0">
                <input type="radio"   name="resource" value="0"
                       id="resourceHero0" <?php if ($session->heroD['r0'] != 0) {
                    echo $checked = "checked";
                } ?>>
                <label for="resourceHero0">
                    <img title="<?=HEROI22?>" class="r0" src="img/x.gif">
                    <span class="current"> <?php if($rp > 10000){echo $rp/1000;echo 'k'; }else {echo $rp;}  ?></span>
                </label>
            </div>


            <div class="resource r1">
                <input type="radio" name="resource" value="1"
                       id="resourceHero1" <?php if ($session->heroD['r1'] != 0) {
                    echo $checked = "checked";
                } ?> <?php echo $form->getRadio('resource', 1); ?>>
                <label for="resourceHero1">
                    <img title="Wood" class="r1" src="img/x.gif">
                    <span class="current"> <?php if(($session->heroD['product']*10*SPEED) > 10000){echo ($session->heroD['product']* 10
                            * SPEED)/1000;echo 'k'; }else {echo $session->heroD['product']* 10 * SPEED;}  ?></span>
                </label>
            </div>
            <div class="resource r2">
                <input type="radio"  name="resource" value="2"
                       id="resourceHero2" <?php if ($session->heroD['r2'] != 0) {
                    echo $checked = "checked";
                } ?> <?php echo $form->getRadio('resource', 2); ?>>
                <label for="resourceHero2">
                    <img title="Clay" class="r2" src="img/x.gif">
                    <span class="current"> <?php if(($session->heroD['product']*10*SPEED) > 10000){echo ($session->heroD['product']* 10
                            * SPEED)/1000;echo 'k'; }else {echo $session->heroD['product']* 10 * SPEED;}  ?></span>
                </label>
            </div>
            <div class="resource r3">
                <input type="radio"  name="resource" value="3"
                       id="resourceHero3" <?php if ($session->heroD['r3'] != 0) {
                    echo $checked = "checked";
                } ?> <?php echo $form->getRadio('resource', 3); ?>>
                <label for="resourceHero3">
                    <img title="Iron" class="r3" src="img/x.gif">
                    <span class="current"> <?php if(($session->heroD['product']*10*SPEED) > 10000){echo ($session->heroD['product']* 10
                            * SPEED)/1000;echo 'k'; }else {echo $session->heroD['product']* 10 * SPEED;}  ?></span>
                </label>
            </div>
            <div class="resource r4" >
                <input type="radio"  name="resource" value="4"
                       id="resourceHero4" <?php if ($session->heroD['r4'] != 0) {
                    echo $checked = "checked";
                } ?> <?php echo $form->getRadio('resource', 4); ?>>
                <label for="resourceHero4">
                    <img title="Crop" class="r4" src="img/x.gif">
                    <span class="current"> <?php if(($session->heroD['product']*10*SPEED) > 10000){echo ($session->heroD['product']* 10
                            * SPEED)/1000;echo 'k'; }else {echo $session->heroD['product']* 10 * SPEED;}  ?></span>
                </label>
            </div>
        </div>
    <div class="clear"></div>

            <div class="attribute attackBehaviour">
                <div class="changeResourcesHeadline"><?=HEROI41?></div>
                <div class="options">
		<input type="radio" class="radio" name="attackBehaviour" id="attackBehaviour" value="hide"  <?php if($session->heroD['hide']==1){ echo 'checked="checked"'; }?>> <label for="attackBehaviourHide"><?=HEROI40?> </label><br />
		<input type="radio" class="radio" name="attackBehaviour" id="attackBehaviour" value="fight"  <?php if($session->heroD['hide']==0){ echo 'checked="checked"'; }?>> <label for="attackBehaviourFight"><?=HEROI39?></label>
</div>

            </div>
<div class="clear"></div>


    <table id="attributesOfHero" cellspacing="0" cellpadding="0" class="transparent attributes">
        <thead>
        <tr>
        <th class="headline"><?=HEROI0?></th>
            <?php if($freepoints>0){?>
            <th class="pointsText" colspan="3">
                <?=HEROI50?>			</th>
            <th class="pointsValue">
                <span id="availablePoints"><?=$freepoints?></span>/<?=$freepoints?>				</th>
            <th></th>
            <?php } ?>
        </tr>
        </thead>

        <tbody>


        <tr id="attributepower" class="attribute power" title="<?=HEROI8?>||<?=HEROI7?>">
            <td class="element attribName tooltip"><?=HEROI8?></td>
    <td class="element current powervalue tooltip">
        <span class="value"><?php echo 100 + $tp * $session->heroD['power'] + $session->heroD['itempower']; ?></span>
    </td>
    <td class="element progress tooltip">
        <div class="bar-bg">
            <div class="bar" style="width:<?php echo $session->heroD['power']; ?>%;"></div>
            <div class="bar setted" style="width: 0%;"></div>
            <div class="clear"></div>
        </div>
					<?php if($freepoints <= 0) { ?> <td class="element points"><?php echo $session->heroD['power']; }?></td>
    </td>



    <?php if ($session->heroD['power'] < 100 AND $freepoints > 0) {
        ?>
        <td class="element pointsValueSetter sub">
            <a class="setPoint disabled" href="#"></a>
        </td>
        <td class="element points">
            <input type="text" class="text" value="<?php echo $session->heroD['power'];?>" name="attributepower">
        </td>
        <td class="element pointsValueSetter add">
            <a class="setPoint" href="#"></a>
        </td>
    <?php } ?>
    <tr id="attributeoffBonus" class="attribute offBonus" title="<?=HEROI14?>||<?=HEROI13?>">
        <td class="element attribName tooltip">
            <?=HEROI14?>					</td>
        <td class="element current powervalue tooltip">
            <span class="value"><?php echo round($session->heroD['offBonus'])/5; ?></span>%
        </td>
        <td class="element progress tooltip">
            <div class="bar-bg">
                <div class="bar" style="width:<?php echo $session->heroD['offBonus']; ?>%;"></div>
                <div class="bar setted" style="width: 0%;"></div>
                <div class="clear"></div>
            </div>
			<?php if($freepoints <= 0) { ?> <td class="element points"><?php echo $session->heroD['offBonus']; }?></td>
        </td>
        <?php if ($session->heroD['offBonus'] < 100 AND $freepoints > 0) {
            ?>
            <td class="element pointsValueSetter sub">
                <a class="setPoint disabled" href="#"></a>
            </td>
            <td class="element points">
                <input type="text" class="text" value="<?php echo $session->heroD['offBonus'];?>" name="attributeoffBonus">
            </td>
            <td class="element pointsValueSetter add">
                <a class="setPoint" href="#"></a>
            </td>
        <?php } ?>
       </tr>
    <tr id="attributedefBonus" class="attribute defBonus" title="<?=HEROI16?>||<?=HEROI15?>">
        <td class="element attribName tooltip">
            <?=HEROI16?>					</td>
        <td class="element current powervalue tooltip">
            <span class="value"><?php echo round($session->heroD['defBonus'])/5; ?></span>%
        </td>
        <td class="element progress tooltip">
            <div class="bar-bg">
                <div class="bar" style="width:<?php echo $session->heroD['defBonus']; ?>%;"></div>
                <div class="bar setted" style="width: 0%;"></div>
                <div class="clear"></div>
            </div>
			<?php if($freepoints <= 0) { ?> <td class="element points"><?php echo $session->heroD['defBonus']; }?></td>
        </td>
        <?php if ($session->heroD['defBonus'] < 100 AND $freepoints > 0) {
            ?>
            <td class="element pointsValueSetter sub">
                <a class="setPoint disabled" href="#"></a>
            </td>
            <td class="element points">
                <input type="text" class="text" value="<?php echo $session->heroD['defBonus'];?>" name="attributedefBonus">
            </td>
            <td class="element pointsValueSetter add">
                <a class="setPoint" href="#"></a>
            </td>
        <?php } ?>
        </tr>
    <tr id="attributeproductionPoints" class="attribute productionPoints" title="<?=HEROI19?>||<?=HEROI17?>.">
        <td class="element attribName tooltip">
            <?=HEROI19?>				</td>
        <td class="element current powervalue tooltip">
            <span class="value"><?php echo $session->heroD['product']; ?></span>
        </td>
        <td class="element progress tooltip">
            <div class="bar-bg">
                <div class="bar" style="width:<?php echo $session->heroD['product']; ?>%;"></div>
                <div class="bar setted" style="width: 0%;"></div>
                <div class="clear"></div>
            </div>
			<?php if($freepoints <= 0) { ?> <td class="element points"><?php echo $session->heroD['product']; }?></td>
        </td>
        <?php if ($session->heroD['product'] < 100 AND $freepoints > 0) {
            ?>
            <td class="element pointsValueSetter sub">
                <a class="setPoint disabled" href="#"></a>
            </td>
            <td class="element points">
                <input type="text" class="text" value="<?php echo $session->heroD['product'];?>" name="attributeproductionPoints">
            </td>
            <td class="element pointsValueSetter add">
                <a class="setPoint" href="#"></a>
            </td>
        <?php } ?>

</table>
<div class="saveHeroAttributes">
    <button type="button" value="save changes" name="saveHeroAttributes" id="saveHeroAttributes"   class="green disabled" disabled="">
        <div class="button-container addHoverClick">
            <div class="button-background">
                <div class="buttonStart">
                    <div class="buttonEnd">
                        <div class="buttonMiddle"></div>
                    </div>
                </div>
            </div>
            <div class="button-content"><?=HEROI51?></div>
        </div>
    </button>
    <script type="text/javascript">
        window.addEvent('domready', function()
        {
            if($('saveHeroAttributes'))
            {
                $('saveHeroAttributes').addEvent('click', function ()
                {
                    window.fireEvent('buttonClicked', [this, {"type":"button","value":"save changes","name":"saveHeroAttributes","id":"saveHeroAttributes","class":"green disabled","title":"","confirm":"","onclick":""}]);
                });
            }
        });
    </script>
</div>
<script type="text/javascript">
    window.addEvent('domready', function()
    {
        $$('.hero_inventory #attributes .openCloseSwitchBar').addEvent('click', function(e)
        {
            Travian.toggleSwitch($$('.hero_inventory #attributes .heroPropertiesContent'), $$('.hero_inventory #attributes .openCloseSwitchBar .openedClosedSwitch'));
            $$('.hero_inventory #attributes .openCloseSwitchBar .availablePoints').toggleClass('hide');
        });

        var attributeForm = new Travian.Game.Hero.Properties.PropertyForm();
        attributeForm.addInputElementByName('saveHeroAttributes');
        attributeForm.addInputElementByName('resource');
        attributeForm.addInputElementByName('attackBehaviour');
<?php if($freepoints>0){?>
        var propertySetterElement = new Travian.Game.Hero.PropertySetter(attributeForm,
            {
                element: 'attributesOfHero',
                elementAvailablePoints: 'availablePoints',
                availablePoints: <?=$freepoints?>,
                attributes:
                    [
                     <?php   if($session->heroD['power']<100){ ?>
                        new Travian.Game.Hero.PropertySetter.Attribute.Power(
                            {
                                id: 'power',
                                element: 'attributepower',
                                value: <?=$session->heroD['power']*100?>,
                                usedPoints: <?=$session->heroD['power']?>,
                                maxPoints: 100,
                                valueOfItems: <?=$session->heroD['itempower']?>,
                                valueBonus: 0    					})<?php  } if($session->heroD['offBonus']<100){ ?>
                        ,
                        new Travian.Game.Hero.PropertySetter.Attribute.OffBonus(
                        {
                            id: 'offBonus',
                            element: 'attributeoffBonus',
                            value: <?=round($session->heroD['offBonus'])/5?>,
                            usedPoints: <?=$session->heroD['offBonus']?>,
                            maxPoints: 100,
                            valueOfItems: 0,
                            valueBonus: 0    					})
                        <?php  } if($session->heroD['defBonus']<100){ ?>
                        ,    				    					new Travian.Game.Hero.PropertySetter.Attribute.DefBonus(
                        {
                            id: 'defBonus',
                            element: 'attributedefBonus',
                            value: <?=round($session->heroD['defBonus'])/5?>,
                            usedPoints: <?=$session->heroD['defBonus']?>,
                            maxPoints: 100,
                            valueOfItems: 0,
                            valueBonus: 0    					})
                        <?php  } if($session->heroD['product']<100){ ?>
                        ,
                        new Travian.Game.Hero.PropertySetter.Attribute.ProductionPoints(
                        {
                            id: 'productionPoints',
                            element: 'attributeproductionPoints',
                            value: <?=$rp?>,
                            usedPoints: <?=$session->heroD['product']?>,
                            maxPoints: 100,
                            valueOfItems: 0,
                            valueBonus: 0    					})  <?php }?>  				    			]
            });

        attributeForm.addElement('properties', propertySetterElement);
        attributeForm.onDirty(false);
        <?php } ?>
    });
</script>


</div>
</div>

</div>
</div>



