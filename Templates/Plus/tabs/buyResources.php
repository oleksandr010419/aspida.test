<?php 
global $session;
include 'tab_header.php';
echo getHeader('buyResources');
?>
<div class="buyGoldContainer">
<div id="openOrders">
<p><b><font face="verdana" color="Black" font size="3">Buy Resources Individually</font></b></p>	
<table cellspacing="1" id="res_tab">

    <thead>
        <tr>
            <td>Lamber</td>
            <td>Clay</td>
            <td>Iron</td>
            <td>Crop</td>

        </tr>
    </thead>
    <tbody>
        <tr>
            <td><a class="resources" ><img src="img/Buy_resources/lumber.png" title="Buy Lumber Individually" width="100" height="100"></a></td>
            <td><a class="resources" ><img src="img/Buy_resources/clay.png" title="Buy Clay Individually" width="100" height="100"></a></td>
            <td><a class="resources" ><img src="img/Buy_resources/iron.png" title="Buy Iron Individually" width="100" height="100"></a></td>
            <td><a class="resources" ><img src="img/Buy_resources/crop.png" title="Buy Crop Individually" width="100" height="100"></a></td>
        </tr>
        <tr>

            <?php 	$production_lvl_20= "2450";
            $production_level_20_x_server=(($production_lvl_20 * SPEED) * 4);
            ?>
            <td> <img src="img/x.gif" class="r1">&nbsp;&nbsp;<?=number_format(round($production_level_20_x_server),0,'.','.')?></td>
            <td> <img src="img/x.gif" class="r2">&nbsp;&nbsp;<?=number_format(round($production_level_20_x_server),0,'.','.')?></td>
            <td> <img src="img/x.gif" class="r3">&nbsp;&nbsp;<?=number_format(round($production_level_20_x_server),0,'.','.')?></td>
            <td> <img src="img/x.gif" class="r4">&nbsp;&nbsp;<?=number_format(round($production_level_20_x_server),0,'.','.')?></td>
        </tr>		
        <tr>
            <td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 20</td>
            <td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 20</td>
            <td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 20</td>
            <td><img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 20</td>
        </tr>

        <tr>
            <td>
                <?php          
                if ($session->gold >= 20) {
                echo  getIDButton("buttonzaHaYuz5","Buy",false,"gold");
                } else {
                echo getButton("Low gold", '', true);
                }
                ?></td>	
            <td>
                <?php            
                if ($session->gold >= 20) {
                echo  getIDButton("buttondeprUyu5","Buy",false,"gold");
                } else {
                echo getButton("Low gold", '', true);
                }
                ?></td>	
            <td>
                <?php           
                if ($session->gold >= 20) {
                echo  getIDButton("buttonnuWruqu7","Buy",false,"gold");
                } else {
                echo getButton("Low gold", '', true);
                }
                ?></td>	
            <td>
                <?php            
                if ($session->gold >= 20) {
                echo  getIDButton("buttonstewar5W","Buy",false,"gold");
                } else {
                echo getButton("Low gold", '', true);
                }
                ?></td>	
        </tr>
        </body>
</table>
<script type="text/javascript">
	window.addEvent('domready', function ()
	{
		if ($('buttonzaHaYuz5'))
		{
			$('buttonzaHaYuz5').outerHTML = $('buttonzaHaYuz5').outerHTML;
			$('buttonzaHaYuz5').addEvent('click', function ()
			{
				window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "41", "context": "paymentWizard"}, "title": "Buy", "coins": 20, "id": "buttonzaHaYuz5"}]);
			});
		}
		if ($('buttondeprUyu5'))
		{
			$('buttondeprUyu5').outerHTML = $('buttondeprUyu5').outerHTML;
			$('buttondeprUyu5').addEvent('click', function ()
			{
				window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "42", "context": "paymentWizard"}, "title": "Buy", "coins": 20, "id": "buttondeprUyu5"}]);
			});
		}
		if ($('buttonnuWruqu7'))
		{
			$('buttonnuWruqu7').outerHTML = $('buttonnuWruqu7').outerHTML;
			$('buttonnuWruqu7').addEvent('click', function ()
			{
				window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "43", "context": "paymentWizard"}, "title": "Buy", "coins": 20, "id": "buttonnuWruqu7"}]);
			});
		}
		if ($('buttonstewar5W'))
		{
			$('buttonstewar5W').outerHTML = $('buttonstewar5W').outerHTML;
			$('buttonstewar5W').addEvent('click', function ()
			{
				window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "44", "context": "paymentWizard"}, "title": "Buy", "coins": 20, "id": "buttonstewar5W"}]);
			});
		}
	});
</script>


<br><br>

<p><b><font face="verdana" color="Black" font size="3">Buy one of our Combo Packages</font></p>	
<table cellspacing="1" id="res_tab_x4_1">

    <thead>
        <tr>
            <td colspan="4"><b>Small Combo Package</b></td>
        </tr>
    </thead>
    <body>
    <tr>
        <td center colspan="4"><a class="resources" ><img src="img/Buy_resources/combo.png" title="Buy our small combo pack" width="530" height="110"></a></td>
    </tr>
    <tr>
        <td><?php 	$production_lvl_20= "2450";
            $production_level_20_x_server=(($production_lvl_20 * SPEED) * 4);
            ?>
            <img src="img/x.gif" class="r1" title="Lumber">&nbsp;&nbsp;<?=number_format(round($production_level_20_x_server),0,'.','.')?></td>
        <?php 	$production_lvl_20= "2450";
        $production_level_20_x_server=(($production_lvl_20 * SPEED) * 4);
        ?>
        <td><img src="img/x.gif" class="r2" title="Clay">&nbsp;&nbsp;<?=number_format(round($production_level_20_x_server),0,'.','.')?></td>
        <?php 	$production_lvl_20= "2450";
        $production_level_20_x_server=(($production_lvl_20 * SPEED) * 4);
        ?>
        <td> <img src="img/x.gif" class="r3" title="Iron">&nbsp;&nbsp;<?=number_format(round($production_level_20_x_server),0,'.','.')?></td>
        <?php 	$production_lvl_20= "2450";
        $production_level_20_x_server=(($production_lvl_20 * SPEED) * 4);
        ?>
        <td><img src="img/x.gif" class="r4" title="Crop">&nbsp;&nbsp;<?=number_format(round($production_level_20_x_server),0,'.','.')?></td>
    </tr>

    <tr>
        <td center colspan="4">	The small combination of resources is an hour of village production and it costs <img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 80</td>
    </tr>
    <tr>
        <td center colspan="4">
            <?php             
            if ($session->gold >= 80) {
            //echo getButton("Buy", 'plus.php?id=traviann&action=combo1', false);
			echo  getIDButton("buttonb5WuseJe","Buy",false,"gold");
            } else {
            echo getButton("Low gold", '', true);
            }
            ?></td>	
    </tr>
</body>

</table>

<br><br>
<table cellspacing="1" id="res_tab_x4_2">

    <thead>
        <tr>
            <td colspan="4"><b>Medium Combo Package</b></td>
        </tr>
    </thead>
    <body>
    <tr>
        <td center colspan="4"><a class="resources" ><img src="img/Buy_resources/combo.png" title="Buy our medium combo pack" width="530" height="110"></a></td>
    </tr>
    <tr>
        <td><?php 	$production_lvl_20= "2450";
            $production_level_20_x_server=((($production_lvl_20 * SPEED) * 4) * 6);
            ?>
            <img src="img/x.gif" class="r1" title="Lumber">&nbsp;&nbsp;<?=number_format(round($production_level_20_x_server),0,'.','.')?></td>
        <?php 	$production_lvl_20= "2450";
        $production_level_20_x_server=((($production_lvl_20 * SPEED) * 4) * 6);
        ?>
        <td><img src="img/x.gif" class="r2" title="Clay">&nbsp;&nbsp;<?=number_format(round($production_level_20_x_server),0,'.','.')?></td>
        <?php 	$production_lvl_20= "2450";
        $production_level_20_x_server=((($production_lvl_20 * SPEED) * 4) * 6);
        ?>
        <td> <img src="img/x.gif" class="r3" title="Iron">&nbsp;&nbsp;<?=number_format(round($production_level_20_x_server),0,'.','.')?></td>
        <?php 	$production_lvl_20= "2450";
        $production_level_20_x_server=((($production_lvl_20 * SPEED) * 4) * 6);
        ?>
        <td><img src="img/x.gif" class="r4" title="Crop">&nbsp;&nbsp;<?=number_format(round($production_level_20_x_server),0,'.','.')?></td>
    </tr>

    <tr>
        <td center colspan="4">	The midioum combination of resources is 6 hour's of village production and it costs <img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 480</td>
    </tr>
    <tr>
        <td center colspan="4">
            <?php          
            if ($session->gold >= 480) {
            echo  getIDButton("buttonTraF8ace","Buy",false,"gold");
            } else {
            echo getButton("Low gold", '', true);
            }
            ?></td>	
    </tr>
</body>
</table>

<br><br>
<table cellspacing="1" id="res_tab_x4_3">

    <thead>
        <tr>
            <td colspan="4"><b>Large Combo Package</b></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td center colspan="4"><a class="resources" ><img src="img/Buy_resources/combo.png" title="Buy our large combo pack" width="530" height="110"></a></td>
        </tr>
        <tr>
            <td><?php 	$production_lvl_20= "2450";
                $production_level_20_x_server=((($production_lvl_20 * SPEED) * 4) * 24);
                ?>
                <img src="img/x.gif" class="r1" title="Lumber">&nbsp;&nbsp;<?=number_format(round($production_level_20_x_server),0,'.','.')?></td>
            <?php 	$production_lvl_20= "2450";
            $production_level_20_x_server=((($production_lvl_20 * SPEED) * 4) * 24);
            ?>
            <td><img src="img/x.gif" class="r2" title="Clay">&nbsp;&nbsp;<?=number_format(round($production_level_20_x_server),0,'.','.')?></td>
            <?php 	$production_lvl_20= "2450";
            $production_level_20_x_server=((($production_lvl_20 * SPEED) * 4) * 24);
            ?>
            <td> <img src="img/x.gif" class="r3" title="Iron">&nbsp;&nbsp;<?=number_format(round($production_level_20_x_server),0,'.','.')?></td>
            <?php 	$production_lvl_20= "2450";
            $production_level_20_x_server=((($production_lvl_20 * SPEED) * 4) * 24);
            ?>
            <td><img src="img/x.gif" class="r4" title="Crop">&nbsp;&nbsp;<?=number_format(round($production_level_20_x_server),0,'.','.')?></td>
        </tr>

        <tr>
            <td center colspan="4">	The large combination of resources is 24 hour's of village production and it costs <img src="img/x.gif" class="gold" title="Gold" alt="Dew"> 1920</td>
        </tr>
        <tr>
            <td center colspan="4">
                <?php          
                if ($session->gold >= 1920) {
                echo  getIDButton("buttonf2swEdru","Buy",false,"gold");
                } else {
                echo getButton("Low gold", '', true);
                }
                ?></td>	
        </tr>
    </tbody>
</table>
<script type="text/javascript">
	window.addEvent('domready', function ()
	{
		if ($('buttonb5WuseJe'))
		{
			$('buttonb5WuseJe').outerHTML = $('buttonb5WuseJe').outerHTML;
			$('buttonb5WuseJe').addEvent('click', function ()
			{
				window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "45", "context": "paymentWizard"}, "title": "Buy", "coins": 80, "id": "buttonb5WuseJe"}]);
			});
		}
		if ($('buttonTraF8ace'))
		{
			$('buttonTraF8ace').outerHTML = $('buttonTraF8ace').outerHTML;
			$('buttonTraF8ace').addEvent('click', function ()
			{
				window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "46", "context": "paymentWizard"}, "title": "Buy", "coins": 480, "id": "buttonTraF8ace"}]);
			});
		}
		if ($('buttonf2swEdru'))
		{
			$('buttonf2swEdru').outerHTML = $('buttonf2swEdru').outerHTML;
			$('buttonf2swEdru').addEvent('click', function ()
			{
				window.fireEvent('buttonClicked', [this, {"type": "button", "value": "Buy", "confirm": "", "onclick": "", "wayOfPayment": {"featureKey": "47", "context": "paymentWizard"}, "title": "Buy", "coins": 1920, "id": "buttonf2swEdru"}]);
			});
		}
	});
</script>
</div>	
</div>	
<?php include 'tab_info.php';
echo getTabs("buyResources");?>		
<?php include 'tab_footer.php';?>