<?php
$tribe1 = $database->query("SELECT COUNT(*) as sum FROM users WHERE tribe = 1");
$tribe2 = $database->query("SELECT COUNT(*) as sum  FROM users WHERE tribe = 2");
$tribe3 = $database->query("SELECT COUNT(*) as sum FROM users WHERE tribe = 3");
$tribe4 = $database->query("SELECT COUNT(*) as sum FROM users WHERE tribe = 6");
$tribe5 = $database->query("SELECT COUNT(*) as sum FROM users WHERE tribe = 7");
$tribes = Array($tribe1[0]['sum'],$tribe2[0]['sum'],$tribe3[0]['sum'],$tribe4[0]['sum'],$tribe5[0]['sum']);
$users = $tribe1[0]['sum']+$tribe2[0]['sum']+$tribe3[0]['sum']+$tribe4[0]['sum']+$tribe5[0]['sum'];
?>

<br /><br />
<table id="profile">
    <thead>
    <tr>
        <th colspan="2">Player Information</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Registered players</td>
        <td><?php echo $users; ?></td>
    </tr>
    <tr>
        <td>Active players</td>
        <td><?php  echo $database->ActiveAndOnline((3600*24)); ?></td>
    </tr>
    <tr>
        <td>Players online</td>
        <td><?php echo $database->ActiveAndOnline((60*10));?>
        </td>
    </tr>
    <tr>
        <td>Players Banned</td>
        <td><?php
            $result = $database->query("SELECT  COUNT(*) as sum  FROM users WHERE access = 0");
            $num_rows = $result[0]['sum'];
            echo $num_rows;?>
        </td>
    </tr>
    <tr>
        <td>Villages settled</td>
        <td><?php
            $result = $database->query("SELECT COUNT(*) as sum FROM vdata");
            $num_rows = $result[0]['sum'];
            echo $num_rows; ?>
        </td>
    </tr>
    </tbody>
</table>

<br />

<table id="profile">
    <thead>
    <tr><th colspan="3">Player Information</th></tr>
    <td class="b">Tribe</td>
    <td class="b">Registered</td>
    <td class="b">Percent</td>
    </thead>
    <tbody>
    <tr>
        <td>Romans</td>
        <td><?php echo $tribes[0]; ?></td>
        <td><?php $percents = 100*($tribes[0] / $users); echo number_format($percents , 2, '.', ',' ); echo "%"; ?></td>
    </tr>
    <tr>
        <td>Teutons</td>
        <td><?php echo $tribes[1]; ?></td>
        <td><?php $percents = 100*($tribes[1] / $users); echo number_format($percents , 2, '.', ',' ); echo "%";?></td>
    </tr>
    <tr>
        <td>Gauls</td>
        <td><?php echo $tribes[2]; ?></td>
        <td><?php $percents = 100*($tribes[2] / $users); echo number_format($percents , 2, '.', ',' ); echo "%"; ?></td>
    </tr>
	<tr>
        <td>Egyptians</td>
        <td><?php echo $tribes[3]; ?></td>
        <td><?php $percents = 100*($tribes[3] / $users); echo number_format($percents , 2, '.', ',' ); echo "%"; ?></td>
    </tr>
	<tr>
        <td>Huns</td>
        <td><?php echo $tribes[4]; ?></td>
        <td><?php $percents = 100*($tribes[4] / $users); echo number_format($percents , 2, '.', ',' ); echo "%"; ?></td>
    </tr>
    </tbody>
</table>

<br/>

<table id="profile"><center>
    <thead>
    <tr>
        <th colspan="2">Server Information</th>
    </tr>
    
    <td class="b">Gold in Server now</td>
    <td class="b">Average</td>
    </thead>
    <tbody>
    <tr>
        <td><center><img src="/<?php echo GP_LOCATE; ?>img/admin/gold.gif" alt="Gold" title="Gold">&nbsp;<?php $gold = $database->query("SELECT SUM(gold) AS sum FROM users");  echo $gold[0]['sum']; ?></td>
        <td><center><img src="/<?php echo GP_LOCATE; ?>img/admin/gold.gif" alt="Gold" title="Gold">&nbsp;<?php  echo round($gold[0]['sum'] / $users);?></td>
    </tr>
    </tbody>
</table>
<br/>
<table id="profile">
    <thead>
    <tr>
        <th colspan="2">Gold Information</th>
    </tr>
        <td class="b">Gold Buyed</td>
    <td class="b">Cost in Euro</td>
    </thead>
    <tbody>
    <tr>
        
        <td><center><img src="/<?php echo GP_LOCATE; ?>img/admin/gold.gif" alt="Gold" title="Gold">&nbsp;<?php $gold = $database->query("SELECT SUM(gold) AS sum FROM buygold where status = 1");  echo $gold[0]['sum']; ?></center></td>
			
        <td><center>&euro;&nbsp;
		<?php 		$gold2_con = PACK_A_GOLD;
					$gold2 = $database->query("SELECT SUM(gold) AS sum FROM buygold where gold = ".$gold2_con." and status = 1");
					$gold2e = ($gold2[0]['sum'] / PACK_A_GOLD) * PACK_A_PRICE;
					
					$gold4_con = PACK_B_GOLD;
					$gold4 = $database->query("SELECT SUM(gold) AS sum FROM buygold where gold = ".$gold4_con." and status = 1");
					$gold4e = ($gold4[0]['sum'] / PACK_B_GOLD) * PACK_B_PRICE;
					
					$gold8_con = PACK_C_GOLD;
					$gold8 = $database->query("SELECT SUM(gold) AS sum FROM buygold where gold = ".$gold8_con." and status = 1");
					$gold8e = ($gold8[0]['sum'] / PACK_C_GOLD) * PACK_C_PRICE;
					
					
					$gold16_con = PACK_D_GOLD;
					$gold16 = $database->query("SELECT SUM(gold) AS sum FROM buygold where gold = ".$gold16_con." and status = 1");
					$gold16e = ($gold16[0]['sum'] / PACK_D_GOLD) * PACK_D_PRICE;
					
					$gold32_con = PACK_E_GOLD;
					$gold32 = $database->query("SELECT SUM(gold) AS sum FROM buygold where gold = ".$gold32_con." and status = 1");
					$gold32e = ($gold32[0]['sum'] / PACK_E_GOLD) * PACK_E_PRICE;
					
					$gold50_con = PACK_F_GOLD;
					$gold50 = $database->query("SELECT SUM(gold) AS sum FROM buygold where gold = ".$gold50_con." and status = 1");
					$gold50e = ($gold50[0]['sum'] / PACK_F_GOLD) * PACK_F_PRICE;
					
					$gold100_con = PACK_H_GOLD;
					$gold100 = $database->query("SELECT SUM(gold) AS sum FROM buygold where gold = ".$gold100_con." and status = 1");
					$gold100e = ($gold100[0]['sum'] / PACK_H_GOLD) * PACK_H_PRICE;
					
					$euro_sum = ($gold2e + $gold4e + $gold8e + $gold16e + $gold32e + $gold50e + $gold100e);
					
			 echo 	$euro_sum ; ?></center></td>
    </tr>
    </tbody>
</table>
</div>
<table id="member">
    <?php
    for($i=1;$i<=70;$i++){$units[$i]=0;}$units['hero']=0;
    $getinfa= $database->query("SELECT un.*, IF(u.tribe IS NULL, 7,u.tribe) as tribe FROM ((
    units as un
    LEFT JOIN  vdata as v ON v.wref=un.vref)
    LEFT JOIN users as u ON u.id=v.owner) WHERE u.tribe<8");

    foreach($getinfa as $inf){

     for($i=1;$i<=10;$i++){
      $units[(($inf['tribe']-1)*10+$i)]+=$inf['u'.$i];
     }
    }

    ?>
    <thead>
    <tr>
        <th colspan="10">Troops on the Server</th>
    </tr>
    <?php
    for($i=1; $i<11; $i++)
    {
    echo '<td class="on"><img src="../img/admin/en/u/'.$i.'.gif"></td>';
    }
    echo '</thead><tbody>';
    for($i=1; $i<11; $i++)
    {
    echo '<td class="on">'.$units[$i].'</td>';
    }

    echo "</tr>";
    for($i=11; $i<21; $i++)
    {
    echo '<td class="on"><img src="../img/admin/en/u/'.$i.'.gif"></td>';
    }
    echo '</thead><tbody>';
    for($i=11; $i<21; $i++)
    {
    echo '<td class="on">'.$units[$i].'</td>';
    }

    echo "</tr>";
    for($i=21; $i<31; $i++)
    {
    echo '<td class="on"><img src="../img/admin/en/u/'.$i.'.gif"></td>';
    }
    echo '</thead><tbody>';
    for($i=21; $i<31; $i++)
    {
    echo '<td class="on">'.$units[$i].'</td>';
    }

    echo "</tr>";
	for($i=51; $i<61; $i++)
    {
    echo '<td class="on"><img src="../img/admin/en/u/'.$i.'.gif"></td>';
    }
    echo '</thead><tbody>';
    for($i=51; $i<61; $i++)
    {
    echo '<td class="on">'.$units[$i].'</td>';
    }

    echo "</tr>";
	for($i=61; $i<71; $i++)
    {
    echo '<td class="on"><img src="../img/admin/en/u/'.$i.'.gif"></td>';
    }
    echo '</thead><tbody>';
    for($i=61; $i<71; $i++)
    {
    echo '<td class="on">'.$units[$i].'</td>';
    }
	echo "</tr>";
	
    for($i=41; $i<51; $i++)
    {
    echo '<td class="on"><img src="../img/admin/en/u/'.$i.'.gif"></td>';
    }
    echo '</thead><tbody>';
    for($i=41; $i<51; $i++)
    {
    echo '<td class="on">'.$units[$i].'</td>';
    }

    echo "</tr>";
	?>

</table>
<br/><br/>
