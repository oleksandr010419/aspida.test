<?php

global $session,$village,$u61,$u62,$u63,$u64,$u65,$u66,$u67,$u68,$u69,$u70;

$hun11 = (SPEED * ((100 / 60) * (3600 / ($u61['time'] * (13.51 / 100)))));
$hun12 = (2 * SPEED * ((100 / 60) * (3600 / ($u61['time'] * (13.51 / 100)))));
$hun13 = (4 * SPEED * ((100 / 60) * (3600 / ($u61['time'] * (13.51 / 100)))));
$hun14 = (10 * SPEED * ((100 / 60) * (3600 / ($u61['time'] * (13.51 / 100)))));
$hun21 = (SPEED * ((100 / 60) * (3600 / ($u62['time'] * (13.51 / 100)))));
$hun22 = (2 * SPEED * ((100 / 60) * (3600 / ($u62['time'] * (13.51 / 100)))));
$hun23 = (4 * SPEED * ((100 / 60) * (3600 / ($u62['time'] * (13.51 / 100)))));
$hun24 = (10 * SPEED * ((100 / 60) * (3600 / ($u62['time'] * (13.51 / 100)))));
$hun31 = (SPEED * ((100 / 60) * (3600 / ($u63['time'] * (13.51 / 100)))));
$hun32 = (2 * SPEED * ((100 / 60) * (3600 / ($u63['time'] * (13.51 / 100)))));
$hun33 = (4 * SPEED * ((100 / 60) * (3600 / ($u63['time'] * (13.51 / 100)))));
$hun34 = (10 * SPEED * ((100 / 60) * (3600 / ($u63['time'] * (13.51 / 100)))));
$hun41 = (SPEED * ((100 / 60) * (3600 / ($u64['time'] * (13.51 / 100)))));
$hun42 = (2 * SPEED * ((100 / 60) * (3600 / ($u64['time'] * (13.51 / 100)))));
$hun43 = (4 * SPEED * ((100 / 60) * (3600 / ($u64['time'] * (13.51 / 100)))));
$hun44 = (10 * SPEED * ((100 / 60) * (3600 / ($u64['time'] * (13.51 / 100)))));
$hun51 = (SPEED * ((100 / 60) * (3600 / ($u65['time'] * (13.51 / 100)))));
$hun52 = (2 * SPEED * ((100 / 60) * (3600 / ($u65['time'] * (13.51 / 100)))));
$hun53 = (4 * SPEED * ((100 / 60) * (3600 / ($u65['time'] * (13.51 / 100)))));
$hun54 = (10 * SPEED * ((100 / 60) * (3600 / ($u65['time'] * (13.51 / 100)))));
$hun61 = (SPEED * ((100 / 60) * (3600 / ($u66['time'] * (13.51 / 100)))));
$hun62 = (2 * SPEED * ((100 / 60) * (3600 / ($u66['time'] * (13.51 / 100)))));
$hun63 = (4 * SPEED * ((100 / 60) * (3600 / ($u66['time'] * (13.51 / 100)))));
$hun64 = (10 * SPEED * ((100 / 60) * (3600 / ($u66['time'] * (13.51 / 100)))));
$hun71 = (SPEED * ((100 / 60) * (3600 / ($u67['time'] * (13.51 / 100)))));
$hun72 = (2 * SPEED * ((100 / 60) * (3600 / ($u67['time'] * (13.51 / 100)))));
$hun73 = (4 * SPEED * ((100 / 60) * (3600 / ($u67['time'] * (13.51 / 100)))));
$hun74 = (10 * SPEED * ((100 / 60) * (3600 / ($u67['time'] * (13.51 / 100)))));
$hun81 = (SPEED * ((100 / 60) * (3600 / ($u68['time'] * (13.51 / 100)))));
$hun82 = (2 * SPEED * ((100 / 60) * (3600 / ($u68['time'] * (13.51 / 100)))));
$hun83 = (4 * SPEED * ((100 / 60) * (3600 / ($u68['time'] * (13.51 / 100)))));
$hun84 = (10 * SPEED * ((100 / 60) * (3600 / ($u68['time'] * (13.51 / 100)))));
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
				<td rowspan="4"><?PHP echo U61;?></br>
				<a class="hasPopup" popupImage="img/troop_dets/h1.png"><img src="section/u61-ltr.png" title="<?PHP echo U61;?>" width="100" height="100"></a>
				</td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($hun11),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php         
		if ($session->gold >= 100) {
			echo  getIDButton("611_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr>
<tr>
				
				<td><?=number_format(round($hun12),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php              
		if ($session->gold >= 200) {
			echo  getIDButton("612_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>
				<td><?=number_format(round($hun13),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php             
		if ($session->gold >= 400) {
			echo  getIDButton("613_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>		<tr>	
				<td><?=number_format(round($hun14),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php          
		if ($session->gold >= 1000) {
			echo  getIDButton("614_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>

</tr>
			<tr>
				<td rowspan="4"><?PHP echo U62;?></br>
				<a class="hasPopup" popupImage="img/troop_dets/h2.png"><img src="section/u62-ltr.png" title="<?PHP echo U62;?>" width="100" height="100" ></a>
				</td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($hun21),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php           
		if ($session->gold >= 100) {
			echo  getIDButton("621_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr><tr>

				
				<td><?=number_format(round($hun22),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php          
		if ($session->gold >= 200) {
			echo  getIDButton("622_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>
				<td><?=number_format(round($hun23),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php          
		if ($session->gold >= 400) {
			echo  getIDButton("623_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>	<tr>		
				<td><?=number_format(round($hun24),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php           
		if ($session->gold >= 1000) {			
			echo  getIDButton("624_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
<tr>
				<td rowspan="4" class="desc"><?PHP echo U63;?></br>
				<a class="hasPopup" popupImage="img/troop_dets/h3.png"><img src="section/u63-ltr.png" title="<?PHP echo U63;?>" width="100" height="100"/></a></td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($hun31),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php           
		if ($session->gold >= 100) {
			echo  getIDButton("631_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr><tr>

				
				<td><?=number_format(round($hun32),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php           
		if ($session->gold >= 200) {
			echo  getIDButton("632_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>
				<td><?=number_format(round($hun33),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php              
		if ($session->gold >= 400) {
			echo  getIDButton("632_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>	<tr>		
				<td><?=number_format(round($hun34),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php             
		if ($session->gold >= 1000) {
			echo  getIDButton("634_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
			<tr>
				<td rowspan="4" class="desc"><?PHP echo U64;?></br>
				<a class="hasPopup" popupImage="img/troop_dets/h4.png"><img src="section/u64-ltr.png" title="<?PHP echo U64;?>" width="100" height="100"/></a></td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($hun41),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php         
		if ($session->gold >= 100) {
			echo  getIDButton("641_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr><tr>

				
				<td><?=number_format(round($hun42),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php        
		if ($session->gold >= 200) {
			echo  getIDButton("642_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>
				<td><?=number_format(round($hun43),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php            
		if ($session->gold >= 400) {
			echo  getIDButton("643_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>	<tr>		
				<td><?=number_format(round($hun44),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php            
		if ($session->gold >= 1000) {
			echo  getIDButton("644_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
			<tr>
				<td rowspan="4" class="desc"><?PHP echo U65;?></br>
				<a class="hasPopup" popupImage="img/troop_dets/h5.png"><img src="section/u65-ltr.png" title="<?PHP echo U65;?>" width="100" height="100"/></a></td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($hun51),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php            
		if ($session->gold >= 100) {
			echo  getIDButton("651_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr><tr>

				
				<td><?=number_format(round($hun52),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php            
		if ($session->gold >= 200) {
			echo  getIDButton("652_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>
				<td><?=number_format(round($hun53),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php           
		if ($session->gold >= 400) {
			echo  getIDButton("653_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>			
				<td><?=number_format(round($hun54),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php             
		if ($session->gold >= 1000) {
			echo  getIDButton("654_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr><tr>
			<tr>
				<td rowspan="4" class="desc"><?PHP echo U66;?></br>
				<a class="hasPopup" popupImage="img/troop_dets/h6.png"><img src="section/u66-ltr.png" title="<?PHP echo U66;?>" width="100" height="100"/></a></td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($hun61),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php            
		if ($session->gold >= 100) {
			echo  getIDButton("661_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr><tr>

				
				<td><?=number_format(round($hun62),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php          
		if ($session->gold >= 200) {
			echo  getIDButton("662_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>
				<td><?=number_format(round($hun63),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php         
		if ($session->gold >= 400) {
			echo  getIDButton("663_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>			
				<td><?=number_format(round($hun64),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php           
		if ($session->gold >= 1000) {
			echo  getIDButton("664_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
<?php /*
			<tr>
				<td rowspan="4" class="desc"><?PHP echo U67;?></br>
				<a class="hasPopup" popupImage="img/troop_dets/h7.png"><img src="section/u67-ltr.png" title="<?PHP echo U67;?>" width="100" height="100"/></a></td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($hun71),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php         
		if ($session->gold >= 100) {
			echo  getIDButton("671_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr><tr>

				
				<td><?=number_format(round($hun72),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php             
		if ($session->gold >= 200) {
			echo  getIDButton("672_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>
				<td><?=number_format(round($hun73),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php          
		if ($session->gold >= 400) {
			echo  getIDButton("673_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>			
				<td><?=number_format(round($hun74),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php            
		if ($session->gold >= 1000) {
			echo  getIDButton("674_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>
			<tr>
				<td rowspan="4" class="desc"><?PHP echo U68;?></br>
				<a class="hasPopup" popupImage="img/troop_dets/h8.png"><img src="section/u68-ltr.png" title="<?PHP echo U68;?>" width="100" height="100"/></a></td>
				<td rowspan="4" class="dur">5 seconds</td>
				<td> <?=number_format(round($hun81),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 100</td>
<td><?php           
		if ($session->gold >= 100) {
			echo  getIDButton("681_100",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">100</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
 </tr><tr>

				
				<td><?=number_format(round($hun82),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 200</td>
<td><?php
		if ($session->gold >= 200) {
			echo  getIDButton("682_200",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">200</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr><tr>
				<td><?=number_format(round($hun83),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 400</td>
<td><?php         
		if ($session->gold >= 400) {
			echo  getIDButton("683_400",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">400</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>	
</tr>	<tr>		
				<td><?=number_format(round($hun84),0,'.','.')?></td>
				<td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1000</td>	

<td><?php           
		if ($session->gold >= 1000) {
			echo  getIDButton("684_1000",'Buy<img src="img/x.gif" class="goldIcon" alt=""><span class="goldValue">1000</span>',false,"gold buttonHuns");
				} else {
						echo getButton("Low gold", '', true);
						}
?></td>
</tr>*/?>
			
			
</table>
<script type="text/javascript">
window.addEvent('domready', function ()
{
	if (jQuery('.buttonHuns'))
	{
		jQuery('.buttonHuns').each(function(){
			//$(jQuery(this).attr('id')).removeEventListener('click', function (){});
			$(jQuery(this).attr('id')).outerHTML = $(jQuery(this).attr('id')).outerHTML;
			$(jQuery(this).attr('id')).addEvent('click', function ()
			{
				$params = jQuery(this).attr("id").split("_");
				$feature = $params[0];
				$coins = $params[1];
				
				window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": $feature, "context": "paymentWizard"}, "title": "Buy", "coins": $coins, "id": "buttonHuns"}]);
			});
		});
	}
});
</script>