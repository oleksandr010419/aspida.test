<?php

   $tribe1 = $database->getUserByTribe(1);
   $tribe2 = $database->getUserByTribe(2);
   $tribe3 = $database->getUserByTribe(3);
   $tribe4 = $database->getUserByTribe(6);
   $tribe5 = $database->getUserByTribe(7);
   $tribes = array($tribe1,$tribe2,$tribe3,$tribe4,$tribe5);
   $users = $tribe1+$tribe2+$tribe3+$tribe4+$tribe5; ?>
<h4 class="round"><?php echo STATISTIC19;?></h4>
<table  id="world_player" class="transparent">
        <tbody>
            <tr>
                <th><?=STATISTIC20;?></th>
                <td><?=$users; ?></td>
            </tr>

            <tr>
                <th><?php echo STATISTIC21;?></th>

                <td><?php
                   $active = $database->ActiveAndOnline((3600*24));
                   echo $active; ?></td>
            </tr>

            <tr>
                <th><?php echo STATISTIC22;?></th>

                <td><?php
                   $online = $database->ActiveAndOnline((60*10));
                   echo $online; ?></td>
            </tr>
        </tbody>
</table>
<h4 class="round spacer"><?php echo STATISTIC23;?></h4>
    <table cellpadding="1" cellspacing="1" id="world_tribes" class="world">
        <thead>

        <tr class="hover">
                <td><?php echo STATISTIC24;?></td>

                <td><?php echo STATISTIC25;?></td>

                <td><?php echo STATISTIC26;?></td>
        </tr>
        </thead>
        <tbody>
        <tr class="hover">
                <td><?php echo TRIBE1;?></td>

                <td><?php
                   echo $tribes[0] ; ?></td>

                <td><?php
                   $percents = (($tribes[0] * 100) / $users);
                   echo number_format($percents , 2, '.', ',' ) ;
                   echo "%"; ?></td>
            </tr>

            <tr>
                <td><?php echo TRIBE2;?></td>

                <td><?php
                   echo $tribes[1]; ?></td>

                <td><?php
                   $percents = (($tribes[1] * 100) / $users);
                   echo number_format($percents , 2, '.', ',' ) ;
                   echo "%"; ?></td>
            </tr>

            <tr>
                <td><?php echo TRIBE3;?></td>

                <td><?php
                   echo $tribes[2]; ?></td>

                <td><?php
                   $percents = (($tribes[2] * 100) / $users);
                   echo number_format($percents , 2, '.', ',' ) ;
                   echo "%"; ?></td>
            </tr>
			
			<tr class="hover">
                <td><?php echo TRIBE6;?></td>

                <td><?php
                   echo $tribes[3] ; ?></td>

                <td><?php
                   $percents = (($tribes[3] * 100) / $users);
                   echo number_format($percents , 2, '.', ',' ) ;
                   echo "%"; ?></td>
            </tr>
			
			<tr class="hover">
                <td><?php echo TRIBE7;?></td>

                <td><?php
                   echo $tribes[4] ; ?></td>

                <td><?php
                   $percents = (($tribes[4] * 100) / $users);
                   echo number_format($percents , 2, '.', ',' ) ;
                   echo "%"; ?></td>
            </tr>
        </tbody>
    </table>



