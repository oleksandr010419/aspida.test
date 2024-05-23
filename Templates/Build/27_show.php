<?php
    $artefact = $database->getArtefactDetails($database->FilterIntValue($_GET['show']));
                   if($artefact['activated']==0){$active=sokr21;}else{$active=sokr22;}

				   

					if($artefact['type']==8){
						$tmp = $artefact;
						
						
						$effect = $artefact['effect'];
						$effect_elements = explode('_',$effect);
						
						$artefact['type']=$effect_elements[1];
						$artefact['size']=$effect_elements[2];
						$fsign=$effect_elements[0];
						
						include ('27_artefact.php');
						$frange=$range;
						$fname=$name;
						$fdesc=$desc;
						$fbonus='<span style="color:red;font-weight:bolder;font-size: 15px;">'.$fsign.'</span>'.$bonus;
						$artefact =$tmp;
					}
				   
				   include ('27_artefact.php');
				   $alli="";
                   if($artefact['owner']==3){ $user=TRIBE5;}else{
                   $ui=$database->getUserforsoc($artefact['owner']);
                   if($ui['id']){
                   $alli='<a href="allianz.php?aid='.$ui['id'].'">'.$ui['tag'];
                   $user=$ui['username'];
                   }
                   }
?>
<table id="art_details" cellpadding="1" cellspacing="1">
                <thead>
                    <tr>
                        <th colspan="2"><?php echo $name;?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2" class="desc">

                            <span class="detail"><?php echo $desc;?></span>
                        </td>
                    </tr>
                    <tr>
                        <th><?=sokr0?></th>
                        <td>
                            <a href="spieler.php?uid=<?php echo $artefact['owner'];?>"><?php echo $user;?></a>
                        </td>
                    </tr>
                    <tr>
                        <th><?=sokr1?></th>
                        <td>
                            <a href="karte.php?d=<?php echo $artefact['vref'];?>&c=<?php echo $generator->getMapCheck($artefact['vref']);?>"><?php echo $database->getVillageField($artefact['vref'], "name");?> </a>
                        </td>
                    </tr>
                    <tr>
                        <th><?=sokr2?></th>
                        <td><?php echo $alli; ?></a></td>
                    </tr>
					
					<?php if($artefact['type']==8){?>
                    <tr>
                        <td class="fool">
							<?=sokr23?>
						</td>
						<td class="fool">
							<table>
								<tr>
									<td colspan="2" class="fool_name">
										<?php echo $fname;?>
									</td>
								</tr>
								<tr>
									<td colspan="2" class="fool_desc">

										<span class="detail"><?php echo $fdesc;?></span>
									</td>
								</tr>
							</table>
							</td>
                    </tr>
					<?php } ?>
                    <tr>
                        <th><?=sokr3?></th>
                        <td>
						<?php if($artefact['type']==8){
							echo $frange;
						}else{
							echo $range;
						}?>
						</td>
                    </tr>

                <tr>
                    <th><?=sokr4?></th>
                    <td>
					<?php if($artefact['type']==8){
						echo $fbonus;
					}else{
						echo $bonus;
					}?>
					</td>
                </tr>
                               <tr>
                    <th><?=sokr5?></th>
                    <td><b><?php echo $active; ?></b><br/>
					
					<?php 
						
						$date2 = time()-(60*60*ARTIFACT_COOLDOWN);
						$datetimep = $artefact['cooldown'];
						if ($artefact['activated']==1 && $datetimep > $date2) {
							$holdtotmin = (($datetimep-$date2) / 60);
							$holdtothr = (($datetimep-$date2) / 3600);
							$holdtotday = intval(($datetimep-$date2) / 86400);
							echo "<font color='#B3B3B3' size='1'>Fully active in: <b>" . $holdtotday . "</b> " . pluss29 . " ";

							$holdhr = intval(($holdtothr) - ($holdtotday * 24));
							echo " <b><span id='time18'>" . ($holdhr) . "</span></b> " . pluss30 . " ";

							$holdmr = intval(($holdtotmin) - (($holdhr * 60) + ($holdtotday * 1440)));
							echo "<b> " . ($holdmr) . "</b> " . pluss31 . "</font>";
						}					
					
						if($session->uid == $artefact['owner']){
							if($artefact['activated']==1){
								echo getButton("Deactivate","build.php?id=". $id . "&activate=0&show=" . $artefact['id'],false,'green');
							}else{
								echo getButton("Activate","build.php?id=" . $id . "&activate=1&show=" . $artefact['id'],false,'gold'); 
							}
						}
					?>					
					</td>
                </tr>

            <tr>
                <th><?=sokr6?></th>
                <td><?=sokr7?> <b><?php echo $reqlvl; ?> </b><?=sokr8?></td>
            </tr>

                <tr>
                    <th><?=sokr9?></th>
                    <td><?php echo date("Y-m-d H:i:s",$artefact['conquered']);?></td>
                </tr>




            </tbody></table>
