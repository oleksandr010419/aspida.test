﻿<?php
if($_SESSION['access'] < 8) die("Access Denied: You are not Admin!");
$id = $_SESSION['id']; ?>

<form action="../GameEngine/Admin/Mods/gold_2.php" method="POST">
	<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
	<table id="member" style="width:300px;">
		<thead>
			<tr>
				<th colspan="2">Get Gold from a player</th>
			</tr>
			<tr>
				<td>Amount</td>
				<td></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<center>
						<b>How much to remove</b>
					</center>
				</td>
				<td>
					<center>
						<input class="give_gold" name="gold" value="20" >&nbsp;
						<img src="../img/admin/gold.gif" class="gold" alt="Gold" name="gold" title="Gold"/>
					</center>
				</td>
			</tr>
			<tr>
				<td>
					<center>
						<b>Players ID that you remove the gold (id)?</b>
					</center>
				</td>
				<td>
					<center>
						<input class="give_gold" name="id" value="">&nbsp;
					</center>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<center>
						<input type="image" src="../img/admin/b/ok1.gif" value="submit" title="Remove the gold">
					</center>
				</td>
			</tr>
		</tbody>
	</table>
</form>

<?php
	if(isset($_GET['g']))
	{
		echo '<br /><br /><font color="Red"><b>Gold Added</font></b>';
	}
?>