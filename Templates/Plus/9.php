
<p><b><font face="verdana" color="Black" font size="5">Buy Resources</font></b></p>	
<br><br>
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
                if ($golds >= 20) {
                echo getButton("Buy", 'plus.php?id=traviann&action=lumber', false);
                } else {
                echo getButton("Low gold", '', true);
                }
                ?></td>	
            <td>
                <?php            
                if ($golds >= 20) {
                echo getButton("Buy", 'plus.php?id=traviann&action=clay', false);
                } else {
                echo getButton("Low gold", '', true);
                }
                ?></td>	
            <td>
                <?php           
                if ($golds >= 20) {
                echo getButton("Buy", 'plus.php?id=traviann&action=iron', false);
                } else {
                echo getButton("Low gold", '', true);
                }
                ?></td>	
            <td>
                <?php            
                if ($golds >= 20) {
                echo getButton("Buy", 'plus.php?id=traviann&action=crop', false);
                } else {
                echo getButton("Low gold", '', true);
                }
                ?></td>	
        </tr>
        </body>
</table>

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
            if ($golds >= 80) {
            echo getButton("Buy", 'plus.php?id=traviann&action=combo1', false);
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
            if ($golds >= 480) {
            echo getButton("Buy", 'plus.php?id=traviann&action=combo2', false);
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
                if ($golds >= 1920) {
                echo getButton("Buy", 'plus.php?id=traviann&action=combo3', false);
                } else {
                echo getButton("Low gold", '', true);
                }
                ?></td>	
        </tr>
    </tbody>
</table>