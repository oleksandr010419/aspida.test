<?php 
global $session,$village;

include 'tab_header.php';
echo getHeader('buyTroops');
?>
<div class="contentBorder infoArea">
    <div class="contentBorder-tl">
    </div>
    <div class="contentBorder-tr">
    </div>
    <div class="contentBorder-tc">
    </div>
    <div class="contentBorder-ml">
    </div>
    <div class="contentBorder-mr">
    </div>
    <div class="contentBorder-mc">
    </div>
    <div class="contentBorder-bl">
    </div>
    <div class="contentBorder-br">
    </div>
    <div class="contentBorder-bc">
    </div>
    <div class="contentBorder-contents cf">
        <a href="#"
           onclick="$$('.paymentWizardMenu').addClass('hide');$$('.buyGoldInfoStep').removeClass('active');$$('.buyGoldInfoStep#1').addClass('active');$$('.paymentWizardMenu#buyTroopers').removeClass('hide');">
            <div
                class="buyGoldInfoStep active"
                id="1">
                <div
                    class="buyGoldInfoStepNumber">1
                </div>
                <div
                    class="buyGoldInfoStepLabel">Troops
                    :
                </div>
                <div
                    class="buyGoldInfoStepContent">Buy infantry
                </div>
            </div>
        </a>
        <a href="#"
           onclick="$$('.paymentWizardMenu').addClass('hide');$$('.buyGoldInfoStep').removeClass('active');$$('.buyGoldInfoStep#2').addClass('active');$$('.paymentWizardMenu#buyAnimal').removeClass('hide');">
            <div
                class="buyGoldInfoStep "
                id="2">
                <div
                    class="buyGoldInfoStepNumber">2
                </div>
                <div
                    class="buyGoldInfoStepLabel">Troops
                    :
                </div>
                <div
                    class="buyGoldInfoStepContent">Buy animal
                </div>
            </div>
        </a>  		
    </div>
</div>
<div class="contentBorder contentArea">
    <div class="contentBorder-tl">
    </div>
    <div class="contentBorder-tr">
    </div>
    <div class="contentBorder-tc">
    </div>
    <div class="contentBorder-ml">
    </div>
    <div class="contentBorder-mr">
    </div>
    <div class="contentBorder-mc">
    </div>
    <div class="contentBorder-bl">
    </div>
    <div class="contentBorder-br">
    </div>
    <div class="contentBorder-bc">
    </div>
    <div class="contentBorder-contents cf">
        <div class="paymentPopupDialogWrapper">
			<div class="troopCount">
			<table id="troops" cellpadding="1" cellspacing="1">
				<thead>
				<tr>
					<th colspan="3">
						<?php echo TROOPS_DORF; ?>
					</th>
				</tr>
				</thead>
				<tbody>
					<?php
					$troops = $village->unitsInVillage();
					$TroopsPresent = False;
					for($i=1;$i<=70;$i++) {
					if(isset($troops['u'.$i])){
						if($troops['u'.$i] > 0) {
							$troop_num = number_format($troops['u'.$i],0,'.','.');
							echo "<tr><td class=\"ico\"><a href=\"build.php?id=39\"><img class=\"unit u".$i."\" src=\"img/x.gif\" alt=\"\" title=\"\" /></a></td>";
							echo "<td class=\"num\">".$troop_num."</td><td class=\"un\">".constant('U'.$i)."</td></tr>";
							$TroopsPresent = True;
						}
					}
					}

					if($troops['hero'] > 0) {
							echo "<tr><td class=\"ico\"><a href=\"build.php?id=39\"><img class=\"unit uhero\" src=\"img/x.gif\" alt=\"Hero\" title=\"Hero\" /></a></td>";
							echo "<td class=\"num\">".$troops['hero']."</td><td class=\"un\">".U0."</td></tr>";
							$TroopsPresent = True;
					}

					if(!$TroopsPresent) {
						echo "<tr><td>None</td></tr>";
					}
					?>
				</tbody>
			</table>
		</div>
		
		
			<?php include 'plus/buyTroops.php';?>
			<?php include 'plus/buyAnimals.php';?>
			
			<style>
			#troop_tab td{
				position: relative; 
			}
			table, th, td {
				border: 1px solid grey;
			}
			.popup {
				display: none;
				border: 4px solid #a1a1a1;
				padding: 0px;
				position:absolute;
				z-index:10;
				border-radius: 5px 5px;
				
			}
			.troopCount{
				margin-left: -365px;
				width: 200px;
				margin-top: 165px;
				float: left;
			}
			</style>
			<script type="text/javascript">
			<!--
				jQuery(function($){
					$('.hasPopup').mouseover(function(){
						showPopup($(this),$(this).attr('popupImage'));
					});
					$('.hasPopup').mouseleave(function(){
						hidePopup($(this));
					});
				});
				
				function showPopup(anchor, img_src) {
					var x = 0;
					var y = anchor.find('img').height();
					var popup = anchor.parent().append("<div class=\"popup\"></div>").find('.popup');
					// add image
					
					popup.html("<img src='" + img_src + "' alt='' />");		
					// position popup
					popup.css({"left": x - 350, "bottom":y - 70});
					popup.show();
				}
				
				function hidePopup(anchor) {
					anchor.parent().find('.popup').remove();
				}
				-->
			</script>
        </div>
	</div>
</div>
<?php include 'tab_info.php';
echo getTabs("buyTroops");?>		
<?php include 'tab_footer.php';?>