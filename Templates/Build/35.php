
<div id="build" class="gid35">

	<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th>Brewery:</th>
			<td><b><?php echo $bid35[$village->resarray['f'.$id]]['attri']; ?></b> %</td>
		</tr>
		<tr>
		<?php
        $cur=$building->isCurrent($id);
        $loop=$building->isLoop($id);
        $master=$building->isMaster($id);
        if($cur+$loop+$master>0){
            foreach($building->buildArray as $bu){
                echo "<tr class=\"underConstruction\"><th>Current improvement to the level ".$bu['level'].":</th> <td><span class=\"number\">".${'bid'.$bu['type']}[$bu['level']]['attri']." ".PERC."</span> </td></tr>";
            }

        }
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {

        ?>
			<th>Bonus at the level <?php echo $next; ?>:</th>
			<td><b><?php echo $bid35[$next]['attri']; ?></b> %</td>
            <?php
            }
			include("35_1.php");
			include("35_2.php");
            ?>
		</tr>
	</table>
</div>