<?php

if(!is_numeric($_SESSION['search']) && !empty($_SESSION['search'])) {
	$igrok=OVERVIEW1;
	$nenaiden= STATISTIC3;

	echo "<p class=\"error\">".$igrok." <b>".$_SESSION['search']."</b> ".$nenaiden."</p>";

    $search = 0;
} else {
    $search = $database->FilterVar($_SESSION['search']);
}

include("player_menu.php");

?>

<h4 class="round"><?php echo STATISTIC1; ?></h4>
    <table cellpadding="1" cellspacing="1" id="player" class="row_table_data">
        <thead>
		<tr><td></td><td><?php echo OVERVIEW1; ?></td><td><?php echo OVERVIEW_CN; ?></td><td><?php echo OVERVIEW6; ?></td><td><?php echo OVERVIEW8; ?></td><td><?php echo OVERVIEW7; ?></td></tr>
		</thead>
        <tbody>

        <?php

        if(isset($_GET['rank'])){

        $multiplier = 1;

        if(is_numeric($_GET['rank'])) {

        if($_GET['rank'] > count($ranking->getRank())) {
            $_GET['rank'] = count($ranking->getRank())-1;
        }

        while($_GET['rank'] > (20*$multiplier)) {

        $multiplier +=1;

        }

        $start = 20*$multiplier-19;

        } else { $start = ($_SESSION['start']+1); }

        } else { $start = ($_SESSION['start']+1); }

        if(count($ranking->getRank()) > 0) {

        $ranking = $ranking->getRank();
		
		$i=$start;
        //for($i=$start;$i<($start+20);$i++) {
		while($i < ($start+20) && $i < count($ranking)){

        if(isset($ranking[$i]['username']) && $ranking[$i] != "pad") {

			if($i == $search) {

			echo "<tr class=\"hl\"><td class=\"ra fc\" >";

				}

				else {

				echo "<tr><td class=\"ra \" >";

				}

				echo $i.".</td><td class=\"pla \" >";

				if($ranking[$i]['access'] > 2){

				echo"<u><a href=\"spieler.php?uid=".$ranking[$i]['userid']."\">".$database->RemoveXSS($ranking[$i]['username'])."</a></u>";

				} else {

				echo"<a href=\"spieler.php?uid=".$ranking[$i]['userid']."\">".$database->RemoveXSS($ranking[$i]['username'])."</a>";

				}
				
				echo '</td><td><img src="img/flags-iso/shiny/16/' . $ranking[$i]['IsoCountryCode'] . '.png">';

				echo"</td><td class=\"al\" >";

					if($ranking[$i]['allitag'] != "") {

					echo "<a href=\"allianz.php?aid=".$ranking[$i]['alliance']."\">".$database->RemoveXSS($ranking[$i]['allitag'])."</a>";

					}

					else {

					echo "-";

					}

					echo "</td><td class=\"pop\" >".$ranking[$i]['totalpop']."</td><td class=\"vil\">".$ranking[$i]['totalvillages']."</td></tr>";

			}
			$i++;
        }

        }

        else {

        ?><td class="none" colspan="5"><?php echo STATISTIC2; ?></td>

        <?php }

?>

 </tbody>

</table>

<?php

include("ranksearch.php");

?>
