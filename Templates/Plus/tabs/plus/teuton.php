<?php

global $session,$village,$u11,$u12,$u13,$u14,$u15,$u16,$u17,$u18,$u19,$u20;

$toten11 = (SPEED * ((100 / 60) * (3600 / ($u11['time'] * (13.51 / 100)))));
$toten12 = (2 * SPEED * ((100 / 60) * (3600 / ($u11['time'] * (13.51 / 100)))));
$toten13 = (4 * SPEED * ((100 / 60) * (3600 / ($u11['time'] * (13.51 / 100)))));
$toten14 = (10 * SPEED * ((100 / 60) * (3600 / ($u11['time'] * (13.51 / 100)))));
$toten21 = (SPEED * ((100 / 60) * (3600 / ($u12['time'] * (13.51 / 100)))));
$toten22 = (2 * SPEED * ((100 / 60) * (3600 / ($u12['time'] * (13.51 / 100)))));
$toten23 = (4 * SPEED * ((100 / 60) * (3600 / ($u12['time'] * (13.51 / 100)))));
$toten24 = (10 * SPEED * ((100 / 60) * (3600 / ($u12['time'] * (13.51 / 100)))));
$toten31 = (SPEED * ((100 / 60) * (3600 / ($u13['time'] * (13.51 / 100)))));
$toten32 = (2 * SPEED * ((100 / 60) * (3600 / ($u13['time'] * (13.51 / 100)))));
$toten33 = (4 * SPEED * ((100 / 60) * (3600 / ($u13['time'] * (13.51 / 100)))));
$toten34 = (10 * SPEED * ((100 / 60) * (3600 / ($u13['time'] * (13.51 / 100)))));
$toten41 = (SPEED * ((100 / 60) * (3600 / ($u14['time'] * (13.51 / 100)))));
$toten42 = (2 * SPEED * ((100 / 60) * (3600 / ($u14['time'] * (13.51 / 100)))));
$toten43 = (4 * SPEED * ((100 / 60) * (3600 / ($u14['time'] * (13.51 / 100)))));
$toten44 = (10 * SPEED * ((100 / 60) * (3600 / ($u14['time'] * (13.51 / 100)))));
$toten51 = (SPEED * ((100 / 60) * (3600 / ($u15['time'] * (13.51 / 100)))));
$toten52 = (2 * SPEED * ((100 / 60) * (3600 / ($u15['time'] * (13.51 / 100)))));
$toten53 = (4 * SPEED * ((100 / 60) * (3600 / ($u15['time'] * (13.51 / 100)))));
$toten54 = (10 * SPEED * ((100 / 60) * (3600 / ($u15['time'] * (13.51 / 100)))));
$toten61 = (SPEED * ((100 / 60) * (3600 / ($u16['time'] * (13.51 / 100)))));
$toten62 = (2 * SPEED * ((100 / 60) * (3600 / ($u16['time'] * (13.51 / 100)))));
$toten63 = (4 * SPEED * ((100 / 60) * (3600 / ($u16['time'] * (13.51 / 100)))));
$toten64 = (10 * SPEED * ((100 / 60) * (3600 / ($u16['time'] * (13.51 / 100)))));
$toten71 = (SPEED * ((100 / 60) * (3600 / ($u17['time'] * (13.51 / 100)))));
$toten72 = (2 * SPEED * ((100 / 60) * (3600 / ($u17['time'] * (13.51 / 100)))));
$toten73 = (4 * SPEED * ((100 / 60) * (3600 / ($u17['time'] * (13.51 / 100)))));
$toten74 = (10 * SPEED * ((100 / 60) * (3600 / ($u17['time'] * (13.51 / 100)))));
$toten81 = (SPEED * ((100 / 60) * (3600 / ($u18['time'] * (13.51 / 100)))));
$toten82 = (2 * SPEED * ((100 / 60) * (3600 / ($u18['time'] * (13.51 / 100)))));
$toten83 = (4 * SPEED * ((100 / 60) * (3600 / ($u18['time'] * (13.51 / 100)))));
$toten84 = (10 * SPEED * ((100 / 60) * (3600 / ($u18['time'] * (13.51 / 100)))));
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
				<td rowspan="4">Clubswinger</br>
				<a class="hasPopup" popupImage="img/troop_dets/t1.png"><img src="section/u11-rtl.png" title="Clubswinger" width="100" height="100"></a>
				</td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($toten11),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php       
		if ($session->gold >= 100) {
			echo  getIDButton("311_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr>
<tr>
				
				<td><?=number_format(round($toten12),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php     
		if ($session->gold >= 200) {
			echo  getIDButton("312_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>
				<td><?=number_format(round($toten13),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php          
		if ($session->gold >= 400) {
			echo  getIDButton("313_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>			
				<td><?=number_format(round($toten14),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php         
		if ($session->gold >= 1000) {
			echo  getIDButton("314_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>

</tr>
			<tr>
				<td rowspan="4">Spearman</br>
				<a class="hasPopup" popupImage="img/troop_dets/t2.png"><img src="section/u12-rtl.png" title="Spearman" width="100" height="100"></a>
				</td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($toten21),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php      
		if ($session->gold >= 100) {
			echo  getIDButton("321_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr>

				
				<td><?=number_format(round($toten22),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php         
		if ($session->gold >= 200) {
			echo  getIDButton("322_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>
				<td><?=number_format(round($toten23),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php           
		if ($session->gold >= 400) {
			echo  getIDButton("323_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>			
				<td><?=number_format(round($toten24),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php         
		if ($session->gold >= 1000) {
			echo  getIDButton("324_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
			<tr>
				<td rowspan="4">Axeman</br>
				<a class="hasPopup" popupImage="img/troop_dets/t3.png"><img src="section/u13-rtl.png" title="Axeman" width="100" height="100"></a>
				</td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($toten31),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php       
		if ($session->gold >= 100) {
			echo  getIDButton("331_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr>

				
				<td><?=number_format(round($toten32),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php         
		if ($session->gold >= 200) {
			echo  getIDButton("332_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>
				<td><?=number_format(round($toten33),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php          
		if ($session->gold >= 400) {
			echo  getIDButton("332_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>			
				<td><?=number_format(round($toten34),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php         
		if ($session->gold >= 1000) {
			echo  getIDButton("334_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
			<tr>
				<td rowspan="4">Scout</br>
				<a class="hasPopup" popupImage="img/troop_dets/t4.png"><img src="section/u14-rtl.png" title="Scout" width="100" height="100"></a>
				</td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($toten41),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php         
		if ($session->gold >= 100) {
			echo  getIDButton("341_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr>

				
				<td><?=number_format(round($toten42),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php           
		if ($session->gold >= 200) {
			echo  getIDButton("342_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>
				<td><?=number_format(round($toten43),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php           
		if ($session->gold >= 400) {
			echo  getIDButton("343_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>			
				<td><?=number_format(round($toten44),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php         
		if ($session->gold >= 1000) {
			echo  getIDButton("344_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
			<tr>
				<td rowspan="4">Paladin</br>
				<a class="hasPopup" popupImage="img/troop_dets/t5.png"><img src="section/u15-rtl.png" title="Paladin" width="100" height="100"></a>
				</td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($toten51),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php             
		if ($session->gold >= 100) {
			echo  getIDButton("351_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr>

				
				<td><?=number_format(round($toten52),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php           
		if ($session->gold >= 200) {
			echo  getIDButton("352_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>
				<td><?=number_format(round($toten53),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php             
		if ($session->gold >= 400) {
			echo  getIDButton("353_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>			
				<td><?=number_format(round($toten54),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php           
		if ($session->gold >= 1000) {
			echo  getIDButton("354_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
			<tr>
				<td rowspan="4">Teutonic Knight</br>
				<a class="hasPopup" popupImage="img/troop_dets/t6.png"><img src="section/u16-rtl.png" title="Teutonic Knight" width="100" height="100"></a>
				</td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($toten61),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php         
		if ($session->gold >= 100) {
			echo  getIDButton("361_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr>

				
				<td><?=number_format(round($toten62),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php        
		if ($session->gold >= 200) {
			echo  getIDButton("362_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>
				<td><?=number_format(round($toten63),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php           
		if ($session->gold >= 400) {
			echo  getIDButton("363_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>			
				<td><?=number_format(round($toten64),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php           
		if ($session->gold >= 1000) {
			echo  getIDButton("364_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
<?php /*
			<tr>
				<td rowspan="4">Ram</br>
				<a class="hasPopup" popupImage="img/troop_dets/t7.png"><img src="section/u17-rtl.png" title="Ram" width="100" height="100"></a>
				</td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($toten71),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php        
		if ($session->gold >= 100) {
			echo  getIDButton("371_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr>

				
				<td><?=number_format(round($toten72),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php         
		if ($session->gold >= 200) {
			echo  getIDButton("372_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>
				<td><?=number_format(round($toten73),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php          
		if ($session->gold >= 400) {
			echo  getIDButton("373_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>			
				<td><?=number_format(round($toten74),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php        
		if ($session->gold >= 1000) {
			echo  getIDButton("374_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
			<tr>
				<td rowspan="4">Catapult</br>
				<a class="hasPopup" popupImage="img/troop_dets/t8.png"><img src="section/u18-rtl.png" title="Catapult" width="100" height="100"></a>
				</td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($toten81),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php            
		if ($session->gold >= 100) {
			echo  getIDButton("381_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr>

				
				<td><?=number_format(round($toten82),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php          
		if ($session->gold >= 200) {
			echo  getIDButton("382_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>
				<td><?=number_format(round($toten83),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php           
		if ($session->gold >= 400) {
			echo  getIDButton("383_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>			
				<td><?=number_format(round($toten84),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php           
		if ($session->gold >= 1000) {
			echo  getIDButton("384_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonTeutons");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>*/?>
			
			
</table>
<script type="text/javascript">
window.addEvent('domready', function ()
{
	if (jQuery('.buttonTeutons'))
	{
		jQuery('.buttonTeutons').each(function(){
			$(jQuery(this).attr('id')).outerHTML = $(jQuery(this).attr('id')).outerHTML;
			$(jQuery(this).attr('id')).addEvent('click', function ()
			{
				$params = jQuery(this).attr("id").split("_");
				$feature = $params[0];
				$coins = $params[1];
				
				window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": $feature, "context": "paymentWizard"}, "title": "Buy", "coins": $coins, "id": "buttonTeutons"}]);
			});
		});
	}
});
</script>