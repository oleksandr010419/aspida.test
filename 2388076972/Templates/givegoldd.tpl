                     	<?php $user = $database->getUserArray($_GET['uid'],1); ?>
                     	<tr>
					<td>Gold</td>
					<td><img src="../img/admin/gold.gif"> <?php echo $user['gold']; ?>
				</tr>
				<?php
					if($_SESSION['access'] >= 8)
					{

							 ?>
								<form action="../GameEngine/Admin/Mods/gold_1.php" method="POST">
									<input type="hidden" name="id" value="<?php echo $_GET['uid']; ?>">
									<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['access']; ?>">
									<tr>
										<td>Give how much Gold?</td>
										<td>
											<input class="give_gold" name="gold" value="0">
											<input type="image" src="../<?php echo GP_LOCATE; ?>img/new/tick.png" value="submit">
											<a href="admin.php?p=player&uid=<?php echo $id; ?>"><img src="../img/admin/del.gif" title="Cancel"></a></td>
									</tr>
								</form><?php


					}
				?>
