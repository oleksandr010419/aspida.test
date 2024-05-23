			<?php
				$tribe = $session->tribe;
                  echo "<tr><th>&nbsp;</th>";
                  for($i=1;$i<=10;$i++) {
                 $uni=($tribe-1)*10+$i;
                  	echo "<td><img src=\"img/x.gif\" class=\"unit u".$uni."\" title=\"".$technology->getUnitName($uni)."\" alt=\"".$technology->getUnitName($uni)."\" /></td>";
                  }
                  $coolspan=10;
				  if($village->unitarray['u11'] != 0) {
                  echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
                   $coolspan=11;
				  }

			?>
			</tr><tr><th><?=ot4m1?></th>
            <?php
            for($i=1;$i<=$coolspan;$i++) {
            	if($village->unitarray['u'.$i] == 0) {
                	echo "<td class=\"none\">";
                }
                else {
                echo "<td>";
                }
                echo $village->unitarray['u'.$i]."</td>";
            }



            ?>
           </tr></tbody>
            <tbody class="infos"><tr><th><?=PY9?></th>
            <td colspan="<?php echo $coolspan; ?>"><?php echo $database->getUpkeep($village->unitarray,$tribe,$village->resarray,1); ?><img class="r4" src="img/x.gif" title="<?=CROP?>" alt="Crop" /><?=PY10?></td></tr>
