<?php
// Define the path to the buidata.php file
$buildataFilePath = '/var/www/html/x'.SPEED.'/GameEngine/Data/buidata.php';

// Include the buidata.php file to access the $bid1 array
include($buildataFilePath);

// Check if the first element of $bid1 exists
if (isset($bid1[1]['time'])) {
    // Extract the time value for the Woodcutter Trough at level 1
    $timeValue = $bid1[1]['time']/SPEED;
	
    // Convert the time value to a human-readable format (hh:mm:ss)
    $hours = floor($timeValue / 3600);
    $minutes = floor(($timeValue % 3600) / 60);
    $seconds = $timeValue % 60;

    // Format the time as hh:mm:ss
    $formattedTime = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
} else {
    $formattedTime = "N/A"; // Display "N/A" if data not found
}
?>
<a class="manualBack arrow back" href="manual.php?typ=0&gid=0">to Overview</a><br><br/>
<h1><img src="/img/x.gif" class="gebIcon g1Icon"> Woodcutter</h1><img class="building g1" src="img/x.gif" alt="Woodcutter" title="Woodcutter" />The woodcutter cuts down trees in order to produce lumber. The further you extend the woodcutter, the more lumber is produced.
<br><br>By constructing a Sawmill you can increase the production further.<p><br><b>Costs</b> and <b>construction time</b> for level 1:<br /><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /> 40 | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /> 100 | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /> 50 | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /> 60 | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /> 2 | <span class="dur"><img class="clock" alt="duration" title="duration" src="img/x.gif" /> <?php echo $formattedTime; ?></span></p>
	<p><b>Prerequisites</b><br />none</p>