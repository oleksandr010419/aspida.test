<?php
        if(!isset($timer)) {
        $timer = 1;
        }
        $br_tm = explode(",",$session->brewery);
		$timeleft = $br_tm[0];
		if($timeleft > Time()){
			echo '</br>';
			echo '<table cellpadding="0" cellspacing="0" id="building_contract">';
			echo '<tr><td>';
            echo 'Festival Duration:';
            echo "</td><td><span id=\"timer".$timer."\">";
            echo $generator->getTimeFormat($timeleft-time());
            echo "</span></td>";
            echo "<td>Will be completed ".date('H:i', $timeleft)."</td></tr>";
			echo "</table>";
            $timer +=1;
		}
