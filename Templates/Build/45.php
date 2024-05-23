<div id="build" class="gid45">

<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th>Oasis production bonus at current level:</th>
			<td><b><?php echo $bid45[$village->resarray['f'.$id]]['attri']; ?></b> %</td>
		</tr><tr>
        <?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
        ?>
			<th>Oasis production bonus at level <?php echo $next=$village->resarray['f'.$id]+1; ?>:</th>

			<td><b><?php echo $bid45[$next]['attri']; ?></b> %</td>
            <?php
        }
            ?>
		</tr></table>

         </div>