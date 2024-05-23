<?php
global $session,$village,$u21,$u22,$u23,$u24,$u25,$u26,$u27,$u28,$u29,$u30;

$gool11 = (SPEED * ((100 / 60) * (3600 / ($u21['time'] * (13.51 / 100)))));
$gool12 = (2 * SPEED * ((100 / 60) * (3600 / ($u21['time'] * (13.51 / 100)))));
$gool13 = (4 * SPEED * ((100 / 60) * (3600 / ($u21['time'] * (13.51 / 100)))));
$gool14 = (10 * SPEED * ((100 / 60) * (3600 / ($u21['time'] * (13.51 / 100)))));
$gool21 = (SPEED * ((100 / 60) * (3600 / ($u22['time'] * (13.51 / 100)))));
$gool22 = (2 * SPEED * ((100 / 60) * (3600 / ($u22['time'] * (13.51 / 100)))));
$gool23 = (4 * SPEED * ((100 / 60) * (3600 / ($u22['time'] * (13.51 / 100)))));
$gool24 = (10 * SPEED * ((100 / 60) * (3600 / ($u22['time'] * (13.51 / 100)))));
$gool31 = (SPEED * ((100 / 60) * (3600 / ($u23['time'] * (13.51 / 100)))));
$gool32 = (2 * SPEED * ((100 / 60) * (3600 / ($u23['time'] * (13.51 / 100)))));
$gool33 = (4 * SPEED * ((100 / 60) * (3600 / ($u23['time'] * (13.51 / 100)))));
$gool34 = (10 * SPEED * ((100 / 60) * (3600 / ($u23['time'] * (13.51 / 100)))));
$gool41 = (SPEED * ((100 / 60) * (3600 / ($u24['time'] * (13.51 / 100)))));
$gool42 = (2 * SPEED * ((100 / 60) * (3600 / ($u24['time'] * (13.51 / 100)))));
$gool43 = (4 * SPEED * ((100 / 60) * (3600 / ($u24['time'] * (13.51 / 100)))));
$gool44 = (10 * SPEED * ((100 / 60) * (3600 / ($u24['time'] * (13.51 / 100)))));
$gool51 = (SPEED * ((100 / 60) * (3600 / ($u25['time'] * (13.51 / 100)))));
$gool52 = (2 * SPEED * ((100 / 60) * (3600 / ($u25['time'] * (13.51 / 100)))));
$gool53 = (4 * SPEED * ((100 / 60) * (3600 / ($u25['time'] * (13.51 / 100)))));
$gool54 = (10 * SPEED * ((100 / 60) * (3600 / ($u25['time'] * (13.51 / 100)))));
$gool61 = (SPEED * ((100 / 60) * (3600 / ($u26['time'] * (13.51 / 100)))));
$gool62 = (2 * SPEED * ((100 / 60) * (3600 / ($u26['time'] * (13.51 / 100)))));
$gool63 = (4 * SPEED * ((100 / 60) * (3600 / ($u26['time'] * (13.51 / 100)))));
$gool64 = (10 * SPEED * ((100 / 60) * (3600 / ($u26['time'] * (13.51 / 100)))));
$gool71 = (SPEED * ((100 / 60) * (3600 / ($u27['time'] * (13.51 / 100)))));
$gool72 = (2 * SPEED * ((100 / 60) * (3600 / ($u27['time'] * (13.51 / 100)))));
$gool73 = (4 * SPEED * ((100 / 60) * (3600 / ($u27['time'] * (13.51 / 100)))));
$gool74 = (10 * SPEED * ((100 / 60) * (3600 / ($u27['time'] * (13.51 / 100)))));
$gool81 = (SPEED * ((100 / 60) * (3600 / ($u28['time'] * (13.51 / 100)))));
$gool82 = (2 * SPEED * ((100 / 60) * (3600 / ($u28['time'] * (13.51 / 100)))));
$gool83 = (4 * SPEED * ((100 / 60) * (3600 / ($u28['time'] * (13.51 / 100)))));
$gool84 = (10 * SPEED * ((100 / 60) * (3600 / ($u28['time'] * (13.51 / 100)))));
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
				<td rowspan="4">Phalanx</br>
				<a class="hasPopup" popupImage="img/troop_dets/g1.png"><img src="section/u21-rtl.png" title="Phalanx" width="100" height="100"></a>
				</td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($gool11),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php            
		if ($session->gold >= 100) {
			echo  getIDButton("211_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr>
				<td><?=number_format(round($gool12),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php           
		if ($session->gold >= 200) {
			echo  getIDButton("212_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>
				<td><?=number_format(round($gool13),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php          
		if ($session->gold >= 400) {
			echo  getIDButton("213_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>			
				<td><?=number_format(round($gool14),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	
<td><?php          
		if ($session->gold >= 1000) {
			echo  getIDButton("214_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
			<tr>
				<td rowspan="4">Swordsman</br>
				<a class="hasPopup" popupImage="img/troop_dets/g2.png"><img src="section/u22-rtl.png" title="Swordsman" width="100" height="100"></a>
				</td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($gool21),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php         
		if ($session->gold >= 100) {
			echo  getIDButton("221_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr>
				<td><?=number_format(round($gool22),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php       
		if ($session->gold >= 200) {
			echo  getIDButton("222_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>
				<td><?=number_format(round($gool23),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php       
		if ($session->gold >= 400) {
			echo  getIDButton("223_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>			
				<td><?=number_format(round($gool24),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	
<td><?php           
		if ($session->gold >= 1000) {
			echo  getIDButton("224_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
			<tr>
				<td rowspan="4">Pathfinder</br>
				<a class="hasPopup" popupImage="img/troop_dets/g3.png"><img src="section/u23-rtl.png" title="Pathfinder" width="100" height="100"></a>
				</td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($gool31),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php             
		if ($session->gold >= 100) {
			echo  getIDButton("231_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr>
				<td><?=number_format(round($gool32),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php            
		if ($session->gold >= 200) {
			echo  getIDButton("232_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>
				<td><?=number_format(round($gool33),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php        
		if ($session->gold >= 400) {
			echo  getIDButton("233_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>			
				<td><?=number_format(round($gool34),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	
<td><?php            
		if ($session->gold >= 1000) {
			echo  getIDButton("234_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
			<tr>
				<td rowspan="4">Theutates Thunder</br>
				<a class="hasPopup" popupImage="img/troop_dets/g4.png"><img src="section/u24-rtl.png" title="Theutates Thunder" width="100" height="100"></a>
				</td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($gool41),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php           
		if ($session->gold >= 100) {
			echo  getIDButton("241_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr>
				<td><?=number_format(round($gool42),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php            
		if ($session->gold >= 200) {
			echo  getIDButton("242_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>
				<td><?=number_format(round($gool43),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php          
		if ($session->gold >= 400) {
			echo  getIDButton("243_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>			
				<td><?=number_format(round($gool44),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	
<td><?php         
		if ($session->gold >= 1000) {
			echo  getIDButton("244_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
			<tr>
				<td rowspan="4">Druidrider</br>
				<a class="hasPopup" popupImage="img/troop_dets/g5.png"><img src="section/u25-rtl.png" title="Druidrider" width="100" height="100"></a>
				</td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($gool51),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php           
		if ($session->gold >= 100) {
			echo  getIDButton("251_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr>
				<td><?=number_format(round($gool52),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php           
		if ($session->gold >= 200) {
			echo  getIDButton("252_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>
				<td><?=number_format(round($gool53),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php       
		if ($session->gold >= 400) {
			echo  getIDButton("253_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>			
				<td><?=number_format(round($gool54),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	
<td><?php         
		if ($session->gold >= 1000) {
			echo  getIDButton("254_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
			<tr>
				<td rowspan="4">Haeduan</br>
				<a class="hasPopup" popupImage="img/troop_dets/g6.png"><img src="section/u26-rtl.png" title="Haeduan" width="100" height="100"></a>
				</td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($gool61),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php           
		if ($session->gold >= 100) {
			echo  getIDButton("261_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr>
				<td><?=number_format(round($gool62),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php         
		if ($session->gold >= 200) {
			echo  getIDButton("262_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>
				<td><?=number_format(round($gool63),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php          
		if ($session->gold >= 400) {
			echo  getIDButton("263_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>			
				<td><?=number_format(round($gool64),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	
<td><?php           
		if ($session->gold >= 1000) {
			echo  getIDButton("264_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
<?php /*
			<tr>
				<td rowspan="4">Ram</br>
				<a class="hasPopup" popupImage="img/troop_dets/g7.png"><img src="section/u27-rtl.png" title="Ram" width="100" height="100"></a>
				</td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($gool71),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php           
		if ($session->gold >= 100) {
			echo  getIDButton("271_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr>
				<td><?=number_format(round($gool72),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php            
		if ($session->gold >= 200) {
			echo  getIDButton("272_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>
				<td><?=number_format(round($gool73),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php            
		if ($session->gold >= 400) {
			echo  getIDButton("273_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>			
				<td><?=number_format(round($gool74),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	
<td><?php          
		if ($session->gold >= 1000) {
			echo  getIDButton("274_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
			<tr>
				<td rowspan="4">Catapult</br>
				<a class="hasPopup" popupImage="img/troop_dets/g8.png"><img src="section/u28-rtl.png" title="Catapult" width="100" height="100"></a>
				</td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($gool81),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php              
		if ($session->gold >= 100) {
			echo  getIDButton("281_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						} 
?></td>
 </tr>
				<td><?=number_format(round($gool82),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php             
		if ($session->gold >= 200) {
			echo  getIDButton("282_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>
				<td><?=number_format(round($gool83),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php             
		if ($session->gold >= 400) {
			echo  getIDButton("283_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>			
				<td><?=number_format(round($gool84),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	
<td><?php           
		if ($session->gold >= 1000) {
			echo  getIDButton("284_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonGaul");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>*/?>
</table>
<script type="text/javascript">
window.addEvent('domready', function ()
{
	if (jQuery('.buttonGaul'))
	{
		jQuery('.buttonGaul').each(function(){
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