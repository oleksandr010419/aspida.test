<?php 
global $session,$village;

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

include 'tab_header.php';
echo getHeader('buyBuildings');
?>
<div class="buyGoldContainer">
<div id="openOrders">

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
		<td class="warehouse_img"><img src="img/warehouse.png" height="50" width="50" title="Warehouse"></td>
		<td class="desc">Build a Warehouse level 20 in the village.</td>
		<td class="dur">Instant</td>
		<td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">10</td>
		<td class="act">
			<?php
			if (!empty($session->gold)) {              
				if ($session->gold >= 10) {
					echo  getIDButton("buttonma3HunU4","Build",false,"green");
				} else {
					echo getButton("Low gold", '', true);
				}
			}
			?>
			<script type="text/javascript">
				window.addEvent('domready', function ()
				{
					if ($('buttonma3HunU4'))
					{
						$('buttonma3HunU4').outerHTML = $('buttonma3HunU4').outerHTML;
						$('buttonma3HunU4').addEvent('click', function ()
						{
							window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Build", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "52", "context": "paymentWizard"}, "title": "Buy", "coins": 10, "id": "buttonma3HunU4"}]);
						});
					}
				});
			</script>

		</td>
	</tr>

	<tr>
		<td class="granary_img"><img src="img/granary.png" height="50" width="50" title="Granary"></td>
		<td class="desc">Build a Granary level 20 in the village.</td>
		<td class="dur">Instant</td>
		<td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">10</td>
		<td class="act">
			<?php
			if (!empty($session->gold)) {
				if ($session->gold >= 10) {
					echo  getIDButton("buttonma3HunU3","Build",false,"green");
				} else {
					echo getButton("Low gold", '', true);
				}
			}
			?>
			<script type="text/javascript">
				window.addEvent('domready', function ()
				{
					if ($('buttonma3HunU3'))
					{
						$('buttonma3HunU3').outerHTML = $('buttonma3HunU3').outerHTML;
						$('buttonma3HunU3').addEvent('click', function ()
						{
							window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Build", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "53", "context": "paymentWizard"}, "title": "Buy", "coins": 10, "id": "buttonma3HunU3"}]);
						});
					}
				});
			</script>
		</td>
	</tr>

	<tr>
		<td class="main_building_img"><img src="img/main_building.png" height="50" width="50" title="Main Building"></td>
		<td class="desc">Build the Main Building level 20 in the village.</td>
		<td class="dur">Instant</td>
		<td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">10</td>
		<td class="act">
			<?php
			if (!empty($session->gold)) {
				if ($village->resarray['f26'] < 20) {
					if ($session->gold >= 10) {
					   echo  getIDButton("buttongawebrE7","Build",false,"green");
					} else {
						echo getButton("Low gold", '', true);
					}
				} else {
					echo getButton("Activated", '', true);
				}
			}
			?>
			<script type="text/javascript">
				window.addEvent('domready', function ()
				{
					if ($('buttongawebrE7'))
					{
						$('buttongawebrE7').outerHTML = $('buttongawebrE7').outerHTML;
						$('buttongawebrE7').addEvent('click', function ()
						{
							window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Build", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "54", "context": "paymentWizard"}, "title": "Buy", "coins": 10, "id": "buttongawebrE7"}]);
						});
					}
				});
			</script>
		</td>
	</tr>

	<tr>
		<td class="img"><img src="img/rally_point.png" height="50" width="50" title="Rally Point"></td>
		<td class="desc">Build Rally Point at the village level 20.</td>
		<td class="dur">Instant</td>
		<td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">20</td>
		<td class="act">
			<?php
			if (!empty($session->gold)) {
				if ($village->resarray['f39'] < 20) {
					if ($session->gold >= 20) {
						echo  getIDButton("button7uqEyAst","Build",false,"green");
					} else {
						echo getButton("Low gold", '', true);
					}
				} else {
					echo getButton("Activated", '', true);
				}
			}
			?>
			<script type="text/javascript">
				window.addEvent('domready', function ()
				{
					if ($('button7uqEyAst'))
					{
						$('button7uqEyAst').outerHTML = $('button7uqEyAst').outerHTML;
						$('button7uqEyAst').addEvent('click', function ()
						{
							window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Build", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "55", "context": "paymentWizard"}, "title": "Buy", "coins": 20, "id": "button7uqEyAst"}]);
						});
					}
				});
			</script>
		</td>
	</tr>


	<tr>
		<td class="img"><img src="img/barracks.png" height="50" width="50" title="Barracks"></td>
		<td class="desc">Build a Barracks level 20 in the village.</td>
		<td class="dur">Instant</td>
		<td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">30</td>
		<td class="act">
			<?php
			if (!empty($session->gold)) {                                                                                 
				if(!isset($buildingLevels[19]) || isset($buildingLevels[19]) && $buildingLevels[19]['level']!=20){                                                     
					if ($session->gold >= 30) {
						echo  getIDButton("buttonfrukEf5R","Build",false,"green");
					} else {
						echo getButton("Low gold", '', true);
					}   
				}else{
					 echo getButton("Activated", '', true);   
				}
			}
			?>
			<script type="text/javascript">
				window.addEvent('domready', function ()
				{
					if ($('buttonfrukEf5R'))
					{
						$('buttonfrukEf5R').outerHTML = $('buttonfrukEf5R').outerHTML;
						$('buttonfrukEf5R').addEvent('click', function ()
						{
							window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Build", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "56", "context": "paymentWizard"}, "title": "Buy", "coins": 30, "id": "buttonfrukEf5R"}]);
						});
					}
				});
			</script>
		</td>
	</tr>


	<tr>
		<td class="img"><img src="img/stable.png" height="50" width="50" title="Stable"></td>
		<td class="desc">Build a Stable level 20 in the village.</td>
		<td class="dur">Instant</td>
		<td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">30</td>
		<td class="act">
			<?php
			if (!empty($session->gold)) {                                                                                 
				if(!isset($buildingLevels[20]) || isset($buildingLevels[20]) && $buildingLevels[20]['level']!=20){                                                     
					if ($session->gold >= 30) {
						echo  getIDButton("buttonWe5EmUhu","Build",false,"green");
					} else {
						echo getButton("Low gold", '', true);
					}   
				}else{
					 echo getButton("Activated", '', true);   
				}
			}
			?>
			<script type="text/javascript">
				window.addEvent('domready', function ()
				{
					if ($('buttonWe5EmUhu'))
					{
						$('buttonWe5EmUhu').outerHTML = $('buttonWe5EmUhu').outerHTML;
						$('buttonWe5EmUhu').addEvent('click', function ()
						{
							window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Build", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "57", "context": "paymentWizard"}, "title": "Buy", "coins": 30, "id": "buttonWe5EmUhu"}]);
						});
					}
				});
			</script>
		</td>
	</tr>


	<tr>
		<td class="img"><img src="img/workshop.png" height="50" width="50" title="Workshop"></td>
		<td class="desc">Build a Workshop level 20 in the village.</td>
		<td class="dur">Instant</td>
		<td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">30</td>
		<td class="act">
			<?php
			if (!empty($session->gold)) {                                                                                 
				if(!isset($buildingLevels[21]) || isset($buildingLevels[21]) && $buildingLevels[21]['level']!=20){                                                     
					if ($session->gold >= 30) {
						echo  getIDButton("buttonbRujugU2","Build",false,"green");
					} else {
						echo getButton("Low gold", '', true);
					}   
				}else{
					 echo getButton("Activated", '', true);   
				}
			}
			?>
			<script type="text/javascript">
				window.addEvent('domready', function ()
				{
					if ($('buttonbRujugU2'))
					{
						$('buttonbRujugU2').outerHTML = $('buttonbRujugU2').outerHTML;
						$('buttonbRujugU2').addEvent('click', function ()
						{
							window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Build", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "58", "context": "paymentWizard"}, "title": "Buy", "coins": 30, "id": "buttonbRujugU2"}]);
						});
					}
				});
			</script>
		</td>
	</tr>


	<tr>
		<td class="img"><img src="img/academy.png" height="50" width="50" title="Academy"></td>
		<td class="desc">Build an Academy level 20 in the village.</td>
		<td class="dur">Instant</td>
		<td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">20</td>
		<td class="act">
			<?php
			if (!empty($session->gold)) {                                                                                 
				if(!isset($buildingLevels[22]) || isset($buildingLevels[22]) && $buildingLevels[22]['level']!=20){                                                     
					if ($session->gold >= 20) {
						echo  getIDButton("buttonh5trUstu","Build",false,"green");
					} else {
						echo getButton("Low gold", '', true);
					}   
				}else{
					 echo getButton("Activated", '', true);   
				}
			}
			?>
			<script type="text/javascript">
				window.addEvent('domready', function ()
				{
					if ($('buttonh5trUstu'))
					{
						$('buttonh5trUstu').outerHTML = $('buttonh5trUstu').outerHTML;
						$('buttonh5trUstu').addEvent('click', function ()
						{
							window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Build", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "59", "context": "paymentWizard"}, "title": "Buy", "coins": 20, "id": "buttonh5trUstu"}]);
						});
					}
				});
			</script>
		</td>
	</tr>


	<tr>
		<td class="img"><img src="img/smithy.png" height="50" width="50" title="Smithy"></td>
		<td class="desc">Build a Smithy level 20 in the village.</td>
		<td class="dur">Instant</td>
		<td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">30</td>
		<td class="act">
			<?php
			if (!empty($session->gold)) {                                                                                 
				if(!isset($buildingLevels[12]) || isset($buildingLevels[12]) && $buildingLevels[12]['level']!=20){                                                     
					if ($session->gold >= 30) {
						echo  getIDButton("buttonxamAjEt2","Build",false,"green");
					} else {
						echo getButton("Low gold", '', true);
					}   
				}else{
					 echo getButton("Activated", '', true);   
				}
			}
			?>
			<script type="text/javascript">
				window.addEvent('domready', function ()
				{
					if ($('buttonxamAjEt2'))
					{
						$('buttonxamAjEt2').outerHTML = $('buttonxamAjEt2').outerHTML;
						$('buttonxamAjEt2').addEvent('click', function ()
						{
							window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Build", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "60", "context": "paymentWizard"}, "title": "Buy", "coins": 30, "id": "buttonxamAjEt2"}]);
						});
					}
				});
			</script>
		</td>
	</tr>


	<tr>
		<td class="img"><img src="img/treasury.png" height="50" width="50" title="Treasury"></td>
		<td class="desc">Build a Treasury level 20 in the village.</td>
		<td class="dur">Instant</td>
		<td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">30</td>
		<td class="act">
			<?php
			if (!empty($session->gold)) {
				if($village->resarray['f99t'] == 40){
					echo getButton("N/A for WW", '', true);
					
				}else{
					if(!isset($buildingLevels[27]) || isset($buildingLevels[27]) && $buildingLevels[27]['level']!=20){                                                     
						if ($session->gold >= 30) {
							echo  getIDButton("buttonRu4anefE","Build",false,"green");
						} else {
							echo getButton("Low gold", '', true);
						}   
					}else{
						 echo getButton("Activated", '', true);   
					}
				}
			}
			?>
			<script type="text/javascript">
				window.addEvent('domready', function ()
				{
					if ($('buttonRu4anefE'))
					{
						$('buttonRu4anefE').outerHTML = $('buttonRu4anefE').outerHTML;
						$('buttonRu4anefE').addEvent('click', function ()
						{
							window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Build", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "61", "context": "paymentWizard"}, "title": "Buy", "coins": 30, "id": "buttonRu4anefE"}]);
						});
					}
				});
			</script>
		</td>
	</tr>


	<tr>
		<td class="img"><img src="img/tournament_square.png" height="50" width="50" title="Tournament Square"></td>
		<td class="desc">Build a Tournament Square level 20 in the village.</td>
		<td class="dur">Instant</td>
		<td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">30</td>
		<td class="act">
			<?php
			if (!empty($session->gold)) {                                                                                 
				if(!isset($buildingLevels[14]) || isset($buildingLevels[14]) && $buildingLevels[14]['level']!=20){                                                     
					if ($session->gold >= 30) {
						echo  getIDButton("buttonY6dEqebR","Build",false,"green");
					} else {
						echo getButton("Low gold", '', true);
					}   
				}else{
					 echo getButton("Activated", '', true);   
				}
			}
			?>	
			<script type="text/javascript">
				window.addEvent('domready', function ()
				{
					if ($('buttonY6dEqebR'))
					{
						$('buttonY6dEqebR').outerHTML = $('buttonY6dEqebR').outerHTML;
						$('buttonY6dEqebR').addEvent('click', function ()
						{
							window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Build", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "62", "context": "paymentWizard"}, "title": "Buy", "coins": 30, "id": "buttonY6dEqebR"}]);
						});
					}
				});
			</script>
		</td>
	</tr>


	<tr>
		<td class="img"><img src="img/resources.png" height="50" width="180" title="Resources lvl 5"></td>
		<td class="desc">Upgrade all your resources fields to level 5</td>
		<td class="dur">Instant</td>
		<td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">150</td>
		<td class="act">
			<?php
			if (!empty($session->gold)) {
				if($farmLevels5plus){
					if ($session->gold >= 150) {
						echo  getIDButton("buttoncrep5edR","Build",false,"green");
					} else {
						echo getButton("Low gold", '', true);
					}
				}else{
					 echo getButton("Activated", '', true);   
				}
			}
			?>
			<script type="text/javascript">
				window.addEvent('domready', function ()
				{
					if ($('buttoncrep5edR'))
					{
						$('buttoncrep5edR').outerHTML = $('buttoncrep5edR').outerHTML;
						$('buttoncrep5edR').addEvent('click', function ()
						{
							window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Build", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "63", "context": "paymentWizard"}, "title": "Buy", "coins": 150, "id": "buttoncrep5edR"}]);
						});
					}
				});
			</script>

		</td>
	</tr>


	<tr>
		<td class="img"><img src="img/resources.png" height="50" width="180" title="Resources lvl 10"></td>
		<td class="desc">Upgrade all your resources fields to level 10</td>
		<td class="dur">Instant</td>
		<td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">300</td>
		<td class="act">
			<?php
			if (!empty($session->gold)) {
				if($farmLevels10plus){
					if ($session->gold >= 300) {
						echo  getIDButton("buttonxuB8prah","Build",false,"green");
					} else {
						echo getButton("Low gold", '', true);
					}
				}
				else{
					 echo getButton("Activated", '', true);   
				}
			}
			?>
			<script type="text/javascript">
				window.addEvent('domready', function ()
				{
					if ($('buttonxuB8prah'))
					{
						$('buttonxuB8prah').outerHTML = $('buttonxuB8prah').outerHTML;
						$('buttonxuB8prah').addEvent('click', function ()
						{
							window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Build", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "64", "context": "paymentWizard"}, "title": "Buy", "coins": 300, "id": "buttonxuB8prah"}]);
						});
					}
				});
			</script>

		</td>
	</tr>


	<tr>
		<td class="img"><img src="img/resources.png" height="50" width="180" title="Resources lvl 20"></td>
		<td class="desc"><br/>Upgrade all your resources fields to level 20</td>
		<td class="dur">Instant</td>
		<td class="cost"><img src="img/x.gif" class="gold" alt="Gold" title="Gold">500</td>
		<td class="act">
			<?php
			if (!empty($session->gold)) {
				if($farmLevels20plus){
					if ($session->gold >= 500 && $village->capital) {
						echo  getIDButton("buttonre6rePuS","Build",false,"green");
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
			<script type="text/javascript">
				window.addEvent('domready', function ()
				{
					if ($('buttonre6rePuS'))
					{
						$('buttonre6rePuS').outerHTML = $('buttonre6rePuS').outerHTML;
						$('buttonre6rePuS').addEvent('click', function ()
						{
							window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Build", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "65", "context": "paymentWizard"}, "title": "Buy", "coins": 500, "id": "buttonre6rePuS"}]);
						});
					}
				});
			</script>
		</td>
	</tr>


</tbody>
</table>
</div>	
</div>	
<?php include 'tab_info.php';
echo getTabs("buyBuildings");?>		
<?php include 'tab_footer.php';?>