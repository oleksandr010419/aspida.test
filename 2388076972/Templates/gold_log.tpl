<table id="profile">
        <thead>
            <tr>
                <th colspan="6">Gold Logs:</th>
            </tr>

            <tr>
                <td>IP</td>
                <td>Function</td>
               <?php $g = '<img src="../img/admin/gold.gif" class="gold" alt="Gold" name="gold" title="Gold"/>'; ?>
                 <td>Use <?php echo $g;?></td>
                 <td>Date</td>
            </tr>
        </thead>
		<tbody>
		<?php $id= $_GET['uid'];
         $no = count($database->getPalevo(3,1,$id));
		 $log=$database->getPalevo(3,1,$id);
        $totalgold=0;
		 for($i=0;$i<$no;$i++) {
        $totalgold+=$dataarray[2];
         $dataarray = explode(",",$log[$i]['infa']);
           $name =  $dataarray[0];
           switch($name){
           	case 'plus': $func="Plus Account";break;
           	case 'b1': $func="Lamber +25%";break;
           	case 'b2': $func="Clay +25%";break;
           	case 'b3': $func="Iron +25%";break;
           	case 'b4': $func="Crop +25%";break;
           	case 'goldclub': $func="Goldclub";break;
           	case 'moment': $func="Finised job momently";break;
           	}
                 ?>

        <tr>
                <td><?php echo $dataarray[3];?></td>



                <td><?php echo $func; ?></td>


                <td><?php echo $dataarray[2];?>&nbsp;<?php echo $g; ?></td>
                <td><?php echo date("j.m.y H:i:s",$dataarray[1]); ?></td>

            </tr>
        <tr>

		<?php } ?>
        <tr><td colspan="4"><center>Amount:<?=$totalgold?></center></td></tr>
		</tbody>
        </table>
</div>
