<?php
$id = $_GET['did'];
$village = $database->getVillage($id);
?>
<table id="profile">
		<thead>
		<tr>
				<th colspan="3" class="on">From the Village (reinforce)</th>
			</tr>
			<tr>

                <td>Where to</td>
                <td>How much</td>
                <td>When</td>

			</tr>
		</thead>

			<?php

				$sql = "SELECT * FROM `palevo` WHERE `browser` = '".$id."' AND `type` = '5'  GROUP BY `time` HAVING COUNT(`time`) > 1";
				$result = $database->query($sql);
				foreach($result as $row)
				{
				$unitarray = explode(",",$row['infa']);
                      $start = ($row['sit']-1)*10+1;
					 $end = ($row['sit']*10);
                       $name=$database->getVillageField($row['from'],"name");
					?>
					<tr>

						<td><a href="?p=village&did=<?php echo $row['from'];?>"><?php echo $name; ?></a></td>
						<td><?php
						$j=0;
						 for($i=$start;$i<=$end;$i++){
							?>
						  <img class="unit u<?php echo $i;?>" src="img/x.gif" title="" alt=""><?php echo $unitarray[$j];
                          $j++;

							 } ?> </td>
						<td><?php echo date('d.m H:i:s',$row['time']); ?></td>
					</tr>
				<?php }
			?>

		</thead>
	</table>
	<table id="profile">
		<thead>
		<tr>
				<th colspan="3" class="on">In the Village (reinforce)</th>
			</tr>
			<tr>

                <td>Location</td>
                <td>How much</td>
                <td>When</td>

			</tr>
		</thead>

			<?php

				$sql = "SELECT * FROM `palevo` WHERE `from` = '".$id."' AND `type` = '5'  GROUP BY `time` HAVING COUNT(`time`) > 1";
				$result = $database->query($sql);
				foreach($result as $row)
				{
				$unitarray = explode(",",$row['infa']);
                      $start = ($row['sit']-1)*10+1;
					 $end = ($row['sit']*10);
                       $name=$database->getVillageField($row['browser'],"name");
					?>
					<tr>

						<td><a href="?p=village&did=<?php echo $row['from'];?>"><?php echo $name; ?></a></td>
						<td><?php
						$j=0;
						 for($i=$start;$i<=$end;$i++){
							?>
						  <img class="unit u<?php echo $i;?>" src="img/x.gif" title="" alt=""><?php echo $unitarray[$j];
                          $j++;

							 } ?> </td>
						<td><?php echo date('d.m H:i:s',$row['time']); ?></td>
					</tr>
				<?php }
			?>

		</thead>
	</table>
<table id="profile">
		<thead>
		<tr>
				<th colspan="3" class="on">Return to the Village</th>
			</tr>
			<tr>


                <td>How much</td>
                <td>When</td>

			</tr>
		</thead>


			<?php
				$sql = "SELECT * FROM `palevo` WHERE `browser` = '".$id."' AND `type` = '55' GROUP BY `time` HAVING COUNT(`time`) > 1";
				$result = $database->query($sql);
				foreach($result as $row)
				{
                       	$owntribe = $database->getUserField($database->getVillageField($row['browser'],"owner"),"tribe",0);
                      $start = ($owntribe-1)*10+1;
					 $end = ($owntribe*10);

					?>
					<tr>


						<td><?php
						$unitarray = explode(",",$row['infa']);
                         $j=0;
						 for($i=$start;$i<=$end;$i++){
							?>
						  <img class="unit u<?php echo $i;?>" src="img/x.gif" title="" alt="">
						  <?php echo $unitarray[$j];

                          $j++;

							 } ?> </td>
						<td><?php echo date('d.m H:i:s',$row['time']); ?></td>
					</tr>
				<?php }
			?>

		</thead>
	</table>
