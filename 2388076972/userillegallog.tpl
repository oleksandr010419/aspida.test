<?php
$id = $_GET['uid'];
if(isset($id))
{
	$player = $database->single("SELECT * FROM users WHERE id = $id");
	?>
	<table cellpadding="1" cellspacing="1" id="member">
		<thead>
			<tr>
				<th colspan="10"><a href="admin.php?p=player&uid=<?php echo $player['id']; ?>"><?php echo $player['username']; ?></a>'s Illegals Log</th>
			</tr>
			<tr>
				<td>Offence</td>
				<td>ID</td>
				<td>Description</td>
			</tr>
		</thead>
		<tbody>
			<?php
				$sql = "SELECT * FROM illegal_log WHERE user = $id";
				$result = $database->query($sql);
				foreach($result as $row)
				{
					$i++;
					echo '
					<tr>
						<td>'.$i.'</td>
						<td>'.$row['id'].'</td>
						<td>'.$row['log'].'</td>
					</tr>';
				}
			?>
		</tbody>
	</table><?php
}
else
{
	include("404.tpl");
}
?>