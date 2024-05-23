        <table id="show_artefacts" cellpadding="1" cellspacing="1">
    		<thead>
    			<tr>
			    	<th colspan="4"><?=sokr20?></th>
    			</tr>
    			<tr>
    				<td></td>
                    <td><?=sokr11?></td>
                    <td><?=sokr14?></td>
                    <td><?=sokr2?></td>
    			</tr>
    		</thead>
    		<tbody>
            <?php
       $arts=$database->getOwnArtsizetype("2 or size = 3","type ASC,size ASC");
$type=1;
        if(count($arts) == 0) {
            echo '<td colspan="4" class="none">'.sokr19.'</td>';
        } else {
        	foreach($arts as $artefact) {
				$list_all = TRUE;
				include ('27_artefact_table.php');
        	}
        	}
?>
    	</tbody></table>