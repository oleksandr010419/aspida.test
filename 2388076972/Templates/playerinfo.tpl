<table id="profile" cellpadding="1" cellspacing="1" >
			<thead>
				<tr>
					<th colspan="2">Player <a href="admin.php?p=player&uid=<?php echo $user['id'];?>"><?php echo $user['username'];?></a></th>
				</tr>
				<tr>
					<td>Details</td>
					<td>Description</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="empty"></td><td class="empty"></td>
				</tr>
				<tr>
					<td class="details">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<th>Rank</th>
								<td><?php  echo $ranking->searchRank($user['id'], "rank"); ?></td>
							</tr>
							<tr>
								<th>Tribe</th>
								<td>
									<?php
										if($user['tribe'] == 1)
										{
											echo "Roman";
										}
										else if($user['tribe'] == 2)
										{
											echo "Teutons";
										}
										else if($user['tribe'] == 3)
										{
											echo "Gauls";
										}
										else if($user['tribe'] == 4)
										{
											echo "Natars";
										}
										else if($user['tribe'] == 5)
										{
											echo "Nature";
										}
										else if($user['tribe'] == 6)
										{
											echo "Egyptians";
										}
										else if($user['tribe'] == 7)
										{
											echo "Huns";
										}
									?>
								</td>
							</tr>
							<tr>
								<th>Alliance</th>
								<td>
									<?php
										if($user['alliance'] == 0)
										{
											echo "-";
										}
										else
										{
											echo "<a href=\"?p=alliance&aid=".$user['alliance']."\">".$database->getAllianceName($user['alliance'])."</a>";
										}
									?>
								</td>
							</tr>
							<tr>
								<th>Villages</th>
								<td><?php echo count($varray);?></td>
							</tr>
							<tr>
								<th>Population</th>
								<td><?php echo $totalpop;?> <a href="?action=recountPopUsr&uid=<?php echo $user['id'];?>"><?php echo $refreshicon; ?></a></td>
							</tr>
							<tr>
								<th>Age</td>
								<td>
									<?php
										if(isset($user['birthday']) && $user['birthday'] != 0)
										{
											$age = date("Y")-substr($user['birthday'],0,4);
											echo $age;
										}
										else
										{
											echo "<font color=\"red\">Not Available</font>";
										}
									?>
								</td>
							</tr>
							<tr>
								<th>Gender</td>
								<td>
									<?php
										if(isset($user['gender']) && $user['gender'] != 0)
										{
											$gender = ($user['gender']== 1)? "Male" : "Female";
											echo $gender;
										}
										else
										{
											echo "<font color=\"red\">Not Available</font>";
										}
									?>
								</td>
							</tr>

							<tr>

								<th>Location</th>
								<td>
									<input type="text" style="width: 80%;" disabled="disabled" class="fm" name="location" value="<?php echo $user['location']; ?>">  <a href="admin.php?p=editUser&uid=<?php echo $id; ?>"><img src="../img/admin/edit.gif" title="Edit Location"></a>
								</td>
							</tr>

							<tr>
								<?php if($_SESSION['access'] == 9){?><th>Password</th>
								<td>
									Change <a href="admin.php?p=editPassword&uid=<?php echo $id; ?>"><img src="../img/admin/edit.gif" title="Change Password"></a>
								</td>
							</tr>

							<tr>
								<?php include("playerplusbonus.tpl"); ?>
							<tr>
								<th>Email</th>
								<td>
									<input disabled="disabled" style="width: 80%;" class="fm" name="email" value="<?php echo $user['email']; ?>"> <a href="admin.php?p=editUser&uid=<?php echo $id; ?>"><img src="../img/admin/edit.gif" title="Edit Email"></a>
								</td>
							</tr>
                                   <?php }   ?>

							<tr>
								<td colspan="2" class="empty"></td>
							</tr>

							<?php
								if($_SESSION['access'] >=8)
								{
									echo '
									<tr>
										<td colspan="2">
											<a href="?p=editUser&uid='.$user['id'].'"><font color="blue">&raquo;</font> Edit User</a>
										</td>
									</tr>';
								}
								else if($_SESSION['access'] == MULTIHUNTER)
								{
									echo '';
								}
								if($_SESSION['access'] == ADMIN)
								{
									echo '
									<tr>
										<td colspan="2">
											<a class="rn3" href="?p=deletion&uid='.$user['id'].'"><font color="red">&raquo;</font> Delete User</a>
										</td>
									</tr>';
								}
								else if($_SESSION['access'] == MULTIHUNTER)
								{
									echo '';
								}
							?>

							<tr>
								<td colspan="2"><a href="?p=ban&uid=<?php echo $user['id']; ?>">&raquo; Ban User</a></td>
							</tr>

							<tr>
								<td colspan="2"><a href="?p=Newmessage&uid=<?php echo $user['id']; ?>">&raquo; Send Message</a></td>
							</tr>

							<tr>
								<?php if($_SESSION['access'] == 9){ ?><td colspan="2"><a href="?p=editPlus&uid=<?php echo $user['id']; ?>">&raquo; Edit Plus & Bonus</a></td>
							</tr>

							<tr>
								<td colspan="2"><a href="?p=editSitter&uid=<?php echo $user['id']; ?>">&raquo; Edit Sitters</a></td>  <?php  } ?>
							</tr>
                                <?php if($_SESSION['access'] == ADMIN)
								{?>
							<tr>
								<td colspan="2"><a href="?p=editWeek&uid=<?php echo $user['id']; ?>">&raquo; Edit Overall Off & Def</a></td>
							</tr>

							<tr>
								<td colspan="2"><a href="?p=editOverall&uid=<?php echo $user['id']; ?>">&raquo; Edit Weekly Off, Def, Raid</a></td>
							</tr>
                                    <?php  } ?>
							<tr>
								<td colspan="2"><a href="?p=userlogin&uid=<?php echo $user['id']; ?>">&raquo; Login's</a></td>
							</tr>



							<tr>
								<td colspan="2" class="desc2">
									<div class="desc2div">
										<center><?php echo nl2br($user['desc1']); ?></center>
									</div>
								</td>
							</tr>
						</table>
					<td class="desc1">
						<center><?php echo nl2br($user['desc2']); ?></center>
					</td>
				</tr>
			</tbody>
		</table>