<?php

global $session,$village,$u1,$u2,$u3,$u4,$u5,$u6,$u7,$u8,$u9,$u10;

$romen11 = (SPEED * ((100 / 60) * (3600 / ($u1['time'] * (13.51 / 100)))));
$romen12 = (2 * SPEED * ((100 / 60) * (3600 / ($u1['time'] * (13.51 / 100)))));
$romen13 = (4 * SPEED * ((100 / 60) * (3600 / ($u1['time'] * (13.51 / 100)))));
$romen14 = (10 * SPEED * ((100 / 60) * (3600 / ($u1['time'] * (13.51 / 100)))));
$romen21 = (SPEED * ((100 / 60) * (3600 / ($u2['time'] * (13.51 / 100)))));
$romen22 = (2 * SPEED * ((100 / 60) * (3600 / ($u2['time'] * (13.51 / 100)))));
$romen23 = (4 * SPEED * ((100 / 60) * (3600 / ($u2['time'] * (13.51 / 100)))));
$romen24 = (10 * SPEED * ((100 / 60) * (3600 / ($u2['time'] * (13.51 / 100)))));
$romen31 = (SPEED * ((100 / 60) * (3600 / ($u3['time'] * (13.51 / 100)))));
$romen32 = (2 * SPEED * ((100 / 60) * (3600 / ($u3['time'] * (13.51 / 100)))));
$romen33 = (4 * SPEED * ((100 / 60) * (3600 / ($u3['time'] * (13.51 / 100)))));
$romen34 = (10 * SPEED * ((100 / 60) * (3600 / ($u3['time'] * (13.51 / 100)))));
$romen41 = (SPEED * ((100 / 60) * (3600 / ($u4['time'] * (13.51 / 100)))));
$romen42 = (2 * SPEED * ((100 / 60) * (3600 / ($u4['time'] * (13.51 / 100)))));
$romen43 = (4 * SPEED * ((100 / 60) * (3600 / ($u4['time'] * (13.51 / 100)))));
$romen44 = (10 * SPEED * ((100 / 60) * (3600 / ($u4['time'] * (13.51 / 100)))));
$romen51 = (SPEED * ((100 / 60) * (3600 / ($u5['time'] * (13.51 / 100)))));
$romen52 = (2 * SPEED * ((100 / 60) * (3600 / ($u5['time'] * (13.51 / 100)))));
$romen53 = (4 * SPEED * ((100 / 60) * (3600 / ($u5['time'] * (13.51 / 100)))));
$romen54 = (10 * SPEED * ((100 / 60) * (3600 / ($u5['time'] * (13.51 / 100)))));
$romen61 = (SPEED * ((100 / 60) * (3600 / ($u6['time'] * (13.51 / 100)))));
$romen62 = (2 * SPEED * ((100 / 60) * (3600 / ($u6['time'] * (13.51 / 100)))));
$romen63 = (4 * SPEED * ((100 / 60) * (3600 / ($u6['time'] * (13.51 / 100)))));
$romen64 = (10 * SPEED * ((100 / 60) * (3600 / ($u6['time'] * (13.51 / 100)))));
$romen71 = (SPEED * ((100 / 60) * (3600 / ($u7['time'] * (13.51 / 100)))));
$romen72 = (2 * SPEED * ((100 / 60) * (3600 / ($u7['time'] * (13.51 / 100)))));
$romen73 = (4 * SPEED * ((100 / 60) * (3600 / ($u7['time'] * (13.51 / 100)))));
$romen74 = (10 * SPEED * ((100 / 60) * (3600 / ($u7['time'] * (13.51 / 100)))));
$romen81 = (SPEED * ((100 / 60) * (3600 / ($u8['time'] * (13.51 / 100)))));
$romen82 = (2 * SPEED * ((100 / 60) * (3600 / ($u8['time'] * (13.51 / 100)))));
$romen83 = (4 * SPEED * ((100 / 60) * (3600 / ($u8['time'] * (13.51 / 100)))));
$romen84 = (10 * SPEED * ((100 / 60) * (3600 / ($u8['time'] * (13.51 / 100)))));
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
			<tr>
				<td rowspan="4">Legionnaire</br>
				<a class="hasPopup" popupImage="img/troop_dets/r1.png"><img src="section/u1-rtl.png" title="Legionnaire" width="100" height="100"></a>
				</td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($romen11),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php         
		if ($session->gold >= 100) {
			echo  getIDButton("111_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr>
<tr>
				
				<td><?=number_format(round($romen12),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php              
		if ($session->gold >= 200) {
			echo  getIDButton("112_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>
				<td><?=number_format(round($romen13),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php             
		if ($session->gold >= 400) {
			echo  getIDButton("113_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>		<tr>	
				<td><?=number_format(round($romen14),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php          
		if ($session->gold >= 1000) {
			echo  getIDButton("114_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>

</tr>
			<tr>
				<td rowspan="4">Praetorian</br>
				<a class="hasPopup" popupImage="img/troop_dets/r2.png"><img src="section/u2-rtl.png" title="Praetorian" width="100" height="100" ></a>
				</td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($romen21),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php           
		if ($session->gold >= 100) {
			echo  getIDButton("121_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr><tr>

				
				<td><?=number_format(round($romen22),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php          
		if ($session->gold >= 200) {
			echo  getIDButton("122_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>
				<td><?=number_format(round($romen23),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php          
		if ($session->gold >= 400) {
			echo  getIDButton("123_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>	<tr>		
				<td><?=number_format(round($romen24),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php           
		if ($session->gold >= 1000) {			
			echo  getIDButton("124_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
<tr>
				<td rowspan="4" class="desc">Imperian</br>
				<a class="hasPopup" popupImage="img/troop_dets/r3.png"><img src="section/u3-rtl.png" title="Imperian" width="100" height="100"/></a></td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($romen31),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php           
		if ($session->gold >= 100) {
			echo  getIDButton("131_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr><tr>

				
				<td><?=number_format(round($romen32),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php           
		if ($session->gold >= 200) {
			echo  getIDButton("132_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>
				<td><?=number_format(round($romen33),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php              
		if ($session->gold >= 400) {
			echo  getIDButton("132_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>	<tr>		
				<td><?=number_format(round($romen34),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php             
		if ($session->gold >= 1000) {
			echo  getIDButton("134_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
			<tr>
				<td rowspan="4" class="desc">Equites Legati</br>
				<a class="hasPopup" popupImage="img/troop_dets/r4.png"><img src="section/u4-rtl.png" title="Equites Legati" width="100" height="100"/></a></td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($romen41),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php         
		if ($session->gold >= 100) {
			echo  getIDButton("141_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr><tr>

				
				<td><?=number_format(round($romen42),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php        
		if ($session->gold >= 200) {
			echo  getIDButton("142_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>
				<td><?=number_format(round($romen43),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php            
		if ($session->gold >= 400) {
			echo  getIDButton("143_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>	<tr>		
				<td><?=number_format(round($romen44),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php            
		if ($session->gold >= 1000) {
			echo  getIDButton("144_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
			<tr>
				<td rowspan="4" class="desc">Equites Imperatoris</br>
				<a class="hasPopup" popupImage="img/troop_dets/r5.png"><img src="section/u5-rtl.png" title="Equites Imperatoris" width="100" height="100"/></a></td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($romen51),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php            
		if ($session->gold >= 100) {
			echo  getIDButton("151_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr><tr>

				
				<td><?=number_format(round($romen52),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php            
		if ($session->gold >= 200) {
			echo  getIDButton("152_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>
				<td><?=number_format(round($romen53),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php           
		if ($session->gold >= 400) {
			echo  getIDButton("153_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>			
				<td><?=number_format(round($romen54),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php             
		if ($session->gold >= 1000) {
			echo  getIDButton("154_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr><tr>
			<tr>
				<td rowspan="4" class="desc">Equites Caesaris</br>
				<a class="hasPopup" popupImage="img/troop_dets/r6.png"><img src="section/u6-rtl.png" title="Equites Caesaris" width="100" height="100"/></a></td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($romen61),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php            
		if ($session->gold >= 100) {
			echo  getIDButton("161_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr><tr>

				
				<td><?=number_format(round($romen62),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php          
		if ($session->gold >= 200) {
			echo  getIDButton("162_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>
				<td><?=number_format(round($romen63),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php         
		if ($session->gold >= 400) {
			echo  getIDButton("163_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>			
				<td><?=number_format(round($romen64),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php           
		if ($session->gold >= 1000) {
			echo  getIDButton("164_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
<?php /*
			<tr>
				<td rowspan="4" class="desc">Battering Ram</br>
				<a class="hasPopup" popupImage="img/troop_dets/r7.png"><img src="section/u7-rtl.png" title="Battering Ram" width="100" height="100"/></a></td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($romen71),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php         
		if ($session->gold >= 100) {
			echo  getIDButton("171_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr><tr>

				
				<td><?=number_format(round($romen72),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php             
		if ($session->gold >= 200) {
			echo  getIDButton("172_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>
				<td><?=number_format(round($romen73),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php          
		if ($session->gold >= 400) {
			echo  getIDButton("173_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>			
				<td><?=number_format(round($romen74),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php            
		if ($session->gold >= 1000) {
			echo  getIDButton("174_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
			<tr>
				<td rowspan="4" class="desc">Fire Catapult</br>
				<a class="hasPopup" popupImage="img/troop_dets/r8.png"><img src="section/u8-rtl.png" title="Fire Catapult" width="100" height="100"/></a></td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($romen81),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php           
		if ($session->gold >= 100) {
			echo  getIDButton("181_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr><tr>

				
				<td><?=number_format(round($romen82),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php
		if ($session->gold >= 200) {
			echo  getIDButton("182_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>
				<td><?=number_format(round($romen83),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php         
		if ($session->gold >= 400) {
			echo  getIDButton("183_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>	<tr>		
				<td><?=number_format(round($romen84),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php           
		if ($session->gold >= 1000) {
			echo  getIDButton("184_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonRomans");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>*/?>
			
			
</table>
<script type="text/javascript">
window.addEvent('domready', function ()
{
	if (jQuery('.buttonRomans'))
	{
		jQuery('.buttonRomans').each(function(){
			//$(jQuery(this).attr('id')).removeEventListener('click', function (){});
			$(jQuery(this).attr('id')).outerHTML = $(jQuery(this).attr('id')).outerHTML;
			$(jQuery(this).attr('id')).addEvent('click', function ()
			{
				$params = jQuery(this).attr("id").split("_");
				$feature = $params[0];
				$coins = $params[1];
				
				window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": $feature, "context": "paymentWizard"}, "title": "Buy", "coins": $coins, "id": "buttonRomans"}]);
			});
		});
	}
});
</script>