<?php
// Define the path to the buidata.php file
$buildataFilePath = '/var/www/html/x'.SPEED.'/GameEngine/Data/buidata.php';

// Include the buidata.php file to access the $bid21 array
include($buildataFilePath);

// Check if the first element of $bid21 exists
if (isset($bid21[1]['time'])) {
    // Extract the time value for the Workshop at level 1
    $timeValue = $bid21[1]['time']/SPEED;
	
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
<h1><img src="/img/x.gif" class="gebIcon g21Icon">Workshop</h1><img class="building g21" src="img/x.gif" alt="Workshop" title="Workshop" />Siege engines, like catapults and rams, can be built in the workshop. The higher its level, the faster these units are produced.<p><br><b>Costs</b> and <b>construction time</b> for level 1:<br /><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /> 460 | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /> 510 | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /> 600 | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /> 320 | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /> 3 | <span class="dur"><img class="clock" alt="duration" title="duration" src="img/x.gif" /> <?php echo $formattedTime; ?></span></p>
	<p><b>Prerequisites</b><br /><a href="manual.php?typ=4&gid=22">Academy</a> Level 10, <a href="manual.php?typ=4&gid=15">Main Building</a> Level 5</p>