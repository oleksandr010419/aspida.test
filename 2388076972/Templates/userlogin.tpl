<?php
$id = $_GET['uid'];
if(isset($id))
{
	$player = $database->query("SELECT * FROM users WHERE id = $id");
	?>
	<table cellpadding="1" cellspacing="1" id="member">
		<thead>
			<tr>
				<th colspan="10"><a href="admin.php?p=player&uid=<?php echo $player['id']; ?>"><?php echo $player['username']; ?></a> Login Log</th>
			</tr>
			<tr>
				<td>Browser</td>
				<td>Proxy-check</td>
				<td>IP</td>
				<td>Sitter</td>
				<td>Time</td>
			</tr>
		</thead>
		<tbody>
			<?php
				$sql = "SELECT * FROM palevo WHERE `uid` = '$id' and `type` = '0'";
				$result = $database->query($sql);
				foreach($result as $row)
				{

					echo '
					<tr>
						<td>'.$row['browser'].'</td>
						<td>'.$row['from'].'</td>
						<td>'.$row['infa'].'</td>
						<td>'.$row['sit'].'</td>
						<td>'.date('m.d H:i',$row['time']).'</td>
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