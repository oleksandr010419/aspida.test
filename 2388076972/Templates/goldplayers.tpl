

<form method="post" action="admin.php">
	<input type="hidden" name="action" value="login">
	<p class="old_p1">
		<table width="75%" cellspacing="1" cellpadding="0" id="profile">
			<thead>
				<tr>
					<th colspan="2">Server Admin Login</th>
				</td>
			</thead>
			<tbody>
				<tr>
					<td>Username</td>
					<td>
						<input class="fm fm110" type="text" name="name" value="<?php echo $_SESSION['username']?>" maxlength="15">
					</td>
				</tr>
				<tr>
					<td>Password:</td>
					<td>
						<input class="fm fm110" type="password" name="pw" value="" maxlength="20">
					</td>
				</tr>
				<tr>
					<td colspan="2">
						
					</td>
				</tr>
			</tbody>
		</table>
		<center>
							<input type="image" border="0" src="../img/admin/b/l1.gif" width="80" height="20">
						</center>
	</p>

</form>