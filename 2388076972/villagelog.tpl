<?php
$id = $_GET['did'];
if(isset($id))
{
	$village = $database->getVillage($id);
	?>
	<br /><br />
	<table id="profile">
		<thead>
		<tr>
				<th colspan="5" class="on">To the village</th>
			</tr>
			<tr>
				<td class="on">Village</td>
                <td>Lumber</td>
                <td>Clay</td>
                <td>Iron</td>
                <td>Crop</td>
			</tr>
		</thead>
			<?php
				$sql = "SELECT * FROM movement WHERE `to` = ".$_GET['did']." and `sort_type`='0' LIMIT 20";
				$result = $database->query($sql);
				foreach($result as $row)
				{
					$name=$database->getVillageField($row['from'],"name");
					echo '
					<tr>
						<td class="on"><a href="?p=village&did='.$row['from'].'">'.$name.'</a></td>
                        <td>'.$row['wood'].'</td>
                        <td>'.$row['clay'].'</td>
                        <td>'.$row['iron'].'</td>
                        <td>'.$row['crop'].'</td>
					</tr>';
				}
			?>
		</thead>
	</table>

		<table id="profile">
		<thead>
		<tr>
				<th colspan="5" class="on">From the village</th>
			</tr>
			<tr>
				<td class="on">Village</td>
                <td>Lumber</td>
                <td>Clay</td>
                <td>Iron</td>
                <td>Crop</td>
			</tr>
		</thead>
			<?php
				$sql = "SELECT * FROM movement WHERE `from` = ".$_GET['did']." and `sort_type`='0' LIMIT 20";
				$result = $database->query($sql);
				foreach($result as $row)
				{
					$name=$database->getVillageField($rowt['to'],"name");
					echo '
					<tr>
						<td class="on"><a href="?p=village&did='.$rowt['to'].'">'.$name.'</a></td>
                        <td>'.$rowt['wood'].'</td>
                        <td>'.$rowt['clay'].'</td>
                        <td>'.$rowt['iron'].'</td>
                        <td>'.$rowt['crop'].'</td>
					</tr>';
				}
			?>
		</thead>
	</table>
	<?php
}
else
{
	include("404.tpl");
}
?>