<?php

global $session,$village,$u51,$u52,$u53,$u54,$u55,$u56,$u57,$u58,$u59,$u70;

$egyptians11 = (SPEED * ((100 / 60) * (3600 / ($u51['time'] * (13.51 / 100)))));
$egyptians12 = (2 * SPEED * ((100 / 60) * (3600 / ($u51['time'] * (13.51 / 100)))));
$egyptians13 = (4 * SPEED * ((100 / 60) * (3600 / ($u51['time'] * (13.51 / 100)))));
$egyptians14 = (10 * SPEED * ((100 / 60) * (3600 / ($u51['time'] * (13.51 / 100)))));
$amountarray = array(1=>1,2=>2,3=>4,4=>10,5=>50,6=>100);
$goldarray = array(1=>100,2=>200,3=>400,4=>1000,5=>5000,6=>10000);
?>
<table cellspacing="1" id="troop_tab">
					<thead>
				<tr>
				<td>Kind of Troops</td>
				<td>Time to process</td>
				<td>Amount</td>
				<td>Price</td>
				<td>Action</td>
			</tr>
</thead>
<tbody>			
	<?php 
	$unit_prefix = ($session->tribe>1)?$session->tribe-1:"";	
	$tribes = array(1=>"r",2=>"g",3=>"t",6=>"e",7=>"h");
	$tribe = ($session->tribe>1)?$session->tribe-1:1;	
	for($i=1;$i<7;$i++){	
		for($j=1;$j<=6;$j++){
		global ${"u".$unit_prefix.$i};
		$amount = $amountarray[$j];
		$gold = $goldarray[$j];
		$troop = ((SPEED/5) * $amount * ((100 / 60) * (3600 / (${"u".$unit_prefix.$i}['time'] * (13.51 / 100)))));
	?>
	<tr style="border-bottom:1px solid black;">
		<?php if($j==1){?>
		<td rowspan="6"><?PHP echo ${"U".$unit_prefix.$i};?></br>
		<a class="hasPopup" popupImage="img/troop_dets/<?php echo $tribes[$tribe].$i;?>.png"><img src="<?php echo GP_LOCATE;?>img/u/section/u<?php echo $unit_prefix.$i;?>-ltr.png" title="<?PHP echo ${"U".$unit_prefix.$i};?>" width="100" height="100"></a>
		</td>
		<td rowspan="6" class="dur">5 seconds</td>
		<?php }else{ ?>

		<?php } ?>
		<td> <?=number_format(round($troop),0,'.','.')?></td>
		<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> <?php echo $gold;?></td>
		<td><?php         
			if ($session->gold >= $gold) {
				echo  getIDButton($tribe.$i.$j."_".$gold,'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">'.$gold.'</span>',false,"gold "."buttonU".$tribe);
			} 
			else {
				echo getButton("Low gold", '', true);
			}
		?>
		</td>
		<?php } ?>
	</tr>
	<?php } ?>
</table>
<script type="text/javascript">
window.addEvent('domready', function ()
{
	if (jQuery('.button<?PHP echo "U".$tribe;?>'))
	{
		jQuery('.button<?PHP echo "U".$tribe;?>').each(function(){
			//$(jQuery(this).attr('id')).removeEventListener('click', function (){});
			$(jQuery(this).attr('id')).outerHTML = $(jQuery(this).attr('id')).outerHTML;
			$(jQuery(this).attr('id')).addEvent('click', function ()
			{
				$params = jQuery(this).attr("id").split("_");
				$feature = $params[0];
				$coins = $params[1];
				
				window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": $feature, "context": "paymentWizard"}, "title": "Buy", "coins": $coins, "id": "buttonegyptianss"}]);
			});
		});
	}
});
</script>