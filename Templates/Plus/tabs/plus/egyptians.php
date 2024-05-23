<?php

global $session,$village,$u51,$u52,$u53,$u54,$u55,$u56,$u57,$u58,$u59,$u70;

$egyptians11 = (SPEED * ((100 / 60) * (3600 / ($u51['time'] * (13.51 / 100)))));
$egyptians12 = (2 * SPEED * ((100 / 60) * (3600 / ($u51['time'] * (13.51 / 100)))));
$egyptians13 = (4 * SPEED * ((100 / 60) * (3600 / ($u51['time'] * (13.51 / 100)))));
$egyptians14 = (10 * SPEED * ((100 / 60) * (3600 / ($u51['time'] * (13.51 / 100)))));
$egyptians21 = (SPEED * ((100 / 60) * (3600 / ($u52['time'] * (13.51 / 100)))));
$egyptians22 = (2 * SPEED * ((100 / 60) * (3600 / ($u52['time'] * (13.51 / 100)))));
$egyptians23 = (4 * SPEED * ((100 / 60) * (3600 / ($u52['time'] * (13.51 / 100)))));
$egyptians24 = (10 * SPEED * ((100 / 60) * (3600 / ($u52['time'] * (13.51 / 100)))));
$egyptians31 = (SPEED * ((100 / 60) * (3600 / ($u53['time'] * (13.51 / 100)))));
$egyptians32 = (2 * SPEED * ((100 / 60) * (3600 / ($u53['time'] * (13.51 / 100)))));
$egyptians33 = (4 * SPEED * ((100 / 60) * (3600 / ($u53['time'] * (13.51 / 100)))));
$egyptians34 = (10 * SPEED * ((100 / 60) * (3600 / ($u53['time'] * (13.51 / 100)))));
$egyptians41 = (SPEED * ((100 / 60) * (3600 / ($u54['time'] * (13.51 / 100)))));
$egyptians42 = (2 * SPEED * ((100 / 60) * (3600 / ($u54['time'] * (13.51 / 100)))));
$egyptians43 = (4 * SPEED * ((100 / 60) * (3600 / ($u54['time'] * (13.51 / 100)))));
$egyptians44 = (10 * SPEED * ((100 / 60) * (3600 / ($u54['time'] * (13.51 / 100)))));
$egyptians51 = (SPEED * ((100 / 60) * (3600 / ($u55['time'] * (13.51 / 100)))));
$egyptians52 = (2 * SPEED * ((100 / 60) * (3600 / ($u55['time'] * (13.51 / 100)))));
$egyptians53 = (4 * SPEED * ((100 / 60) * (3600 / ($u55['time'] * (13.51 / 100)))));
$egyptians54 = (10 * SPEED * ((100 / 60) * (3600 / ($u55['time'] * (13.51 / 100)))));
$egyptians61 = (SPEED * ((100 / 60) * (3600 / ($u56['time'] * (13.51 / 100)))));
$egyptians62 = (2 * SPEED * ((100 / 60) * (3600 / ($u56['time'] * (13.51 / 100)))));
$egyptians63 = (4 * SPEED * ((100 / 60) * (3600 / ($u56['time'] * (13.51 / 100)))));
$egyptians64 = (10 * SPEED * ((100 / 60) * (3600 / ($u56['time'] * (13.51 / 100)))));
$egyptians71 = (SPEED * ((100 / 60) * (3600 / ($u57['time'] * (13.51 / 100)))));
$egyptians72 = (2 * SPEED * ((100 / 60) * (3600 / ($u57['time'] * (13.51 / 100)))));
$egyptians73 = (4 * SPEED * ((100 / 60) * (3600 / ($u57['time'] * (13.51 / 100)))));
$egyptians74 = (10 * SPEED * ((100 / 60) * (3600 / ($u57['time'] * (13.51 / 100)))));
$egyptians81 = (SPEED * ((100 / 60) * (3600 / ($u58['time'] * (13.51 / 100)))));
$egyptians82 = (2 * SPEED * ((100 / 60) * (3600 / ($u58['time'] * (13.51 / 100)))));
$egyptians83 = (4 * SPEED * ((100 / 60) * (3600 / ($u58['time'] * (13.51 / 100)))));
$egyptians84 = (10 * SPEED * ((100 / 60) * (3600 / ($u58['time'] * (13.51 / 100)))));
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
				<td rowspan="4"><?PHP echo U51;?></br>
				<a class="hasPopup" popupImage="img/troop_dets/e1.png"><img src="section/u51-ltr.png" title="<?PHP echo U51;?>" width="100" height="100"></a>
				</td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($egyptians11),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php         
		if ($session->gold >= 100) {
			echo  getIDButton("511_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr>
<tr>
				
				<td><?=number_format(round($egyptians12),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php              
		if ($session->gold >= 200) {
			echo  getIDButton("512_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>
				<td><?=number_format(round($egyptians13),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php             
		if ($session->gold >= 400) {
			echo  getIDButton("513_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>		<tr>	
				<td><?=number_format(round($egyptians14),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php          
		if ($session->gold >= 1000) {
			echo  getIDButton("514_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>

</tr>
			<tr>
				<td rowspan="4"><?PHP echo U52;?></br>
				<a class="hasPopup" popupImage="img/troop_dets/e2.png"><img src="section/u52-ltr.png" title="<?PHP echo U52;?>" width="100" height="100" ></a>
				</td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($egyptians21),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php           
		if ($session->gold >= 100) {
			echo  getIDButton("521_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr><tr>

				
				<td><?=number_format(round($egyptians22),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php          
		if ($session->gold >= 200) {
			echo  getIDButton("522_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>
				<td><?=number_format(round($egyptians23),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php          
		if ($session->gold >= 400) {
			echo  getIDButton("523_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>	<tr>		
				<td><?=number_format(round($egyptians24),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php           
		if ($session->gold >= 1000) {			
			echo  getIDButton("524_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
<tr>
				<td rowspan="4" class="desc"><?PHP echo U53;?></br>
				<a class="hasPopup" popupImage="img/troop_dets/e3.png"><img src="section/u53-ltr.png" title="<?PHP echo U53;?>" width="100" height="100"/></a></td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($egyptians31),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php           
		if ($session->gold >= 100) {
			echo  getIDButton("531_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr><tr>

				
				<td><?=number_format(round($egyptians32),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php           
		if ($session->gold >= 200) {
			echo  getIDButton("532_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>
				<td><?=number_format(round($egyptians33),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php              
		if ($session->gold >= 400) {
			echo  getIDButton("532_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>	<tr>		
				<td><?=number_format(round($egyptians34),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php             
		if ($session->gold >= 1000) {
			echo  getIDButton("534_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
			<tr>
				<td rowspan="4" class="desc"><?PHP echo U54;?></br>
				<a class="hasPopup" popupImage="img/troop_dets/e4.png"><img src="section/u54-ltr.png" title="<?PHP echo U54;?>" width="100" height="100"/></a></td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($egyptians41),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php         
		if ($session->gold >= 100) {
			echo  getIDButton("541_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr><tr>

				
				<td><?=number_format(round($egyptians42),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php        
		if ($session->gold >= 200) {
			echo  getIDButton("542_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>
				<td><?=number_format(round($egyptians43),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php            
		if ($session->gold >= 400) {
			echo  getIDButton("543_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>	<tr>		
				<td><?=number_format(round($egyptians44),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php            
		if ($session->gold >= 1000) {
			echo  getIDButton("544_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
			<tr>
				<td rowspan="4" class="desc"><?PHP echo U55;?></br>
				<a class="hasPopup" popupImage="img/troop_dets/e5.png"><img src="section/u55-ltr.png" title="<?PHP echo U55;?>" width="100" height="100"/></a></td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($egyptians51),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php            
		if ($session->gold >= 100) {
			echo  getIDButton("551_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr><tr>

				
				<td><?=number_format(round($egyptians52),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php            
		if ($session->gold >= 200) {
			echo  getIDButton("552_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>
				<td><?=number_format(round($egyptians53),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php           
		if ($session->gold >= 400) {
			echo  getIDButton("553_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>			
				<td><?=number_format(round($egyptians54),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php             
		if ($session->gold >= 1000) {
			echo  getIDButton("554_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
<tr>
			<tr>
				<td rowspan="4" class="desc"><?PHP echo U56;?></br>
				<a class="hasPopup" popupImage="img/troop_dets/e6.png"><img src="section/u56-ltr.png" title="<?PHP echo U56;?>" width="100" height="100"/></a></td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($egyptians61),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php            
		if ($session->gold >= 100) {
			echo  getIDButton("561_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr><tr>

				
				<td><?=number_format(round($egyptians62),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php          
		if ($session->gold >= 200) {
			echo  getIDButton("562_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>
				<td><?=number_format(round($egyptians63),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php         
		if ($session->gold >= 400) {
			echo  getIDButton("563_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>			
				<td><?=number_format(round($egyptians64),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php           
		if ($session->gold >= 1000) {
			echo  getIDButton("564_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
<?php /*
			<tr>
				<td rowspan="4" class="desc"><?PHP echo U57;?></br>
				<a class="hasPopup" popupImage="img/troop_dets/e7.png"><img src="section/u57-ltr.png" title="<?PHP echo U57;?>" width="100" height="100"/></a></td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($egyptians71),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php         
		if ($session->gold >= 100) {
			echo  getIDButton("571_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr><tr>

				
				<td><?=number_format(round($egyptians72),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php             
		if ($session->gold >= 200) {
			echo  getIDButton("572_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>
				<td><?=number_format(round($egyptians73),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php          
		if ($session->gold >= 400) {
			echo  getIDButton("573_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>			
				<td><?=number_format(round($egyptians74),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php            
		if ($session->gold >= 1000) {
			echo  getIDButton("574_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
			<tr>
				<td rowspan="4" class="desc"><?PHP echo U58;?></br>
				<a class="hasPopup" popupImage="img/troop_dets/e8.png"><img src="section/u58-ltr.png" title="<?PHP echo U58;?>" width="100" height="100"/></a></td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($egyptians81),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php           
		if ($session->gold >= 100) {
			echo  getIDButton("581_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr><tr>

				
				<td><?=number_format(round($egyptians82),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php
		if ($session->gold >= 200) {
			echo  getIDButton("582_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>
				<td><?=number_format(round($egyptians83),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php         
		if ($session->gold >= 400) {
			echo  getIDButton("583_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>	<tr>		
				<td><?=number_format(round($egyptians84),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php           
		if ($session->gold >= 1000) {
			echo  getIDButton("584_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonegyptianss");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>*/?>
			
			
</table>
<script type="text/javascript">
window.addEvent('domready', function ()
{
	if (jQuery('.buttonegyptianss'))
	{
		jQuery('.buttonegyptianss').each(function(){
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