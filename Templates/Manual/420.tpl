<?php
// Define the path to the buidata.php file
$buildataFilePath = '/var/www/html/x'.SPEED.'/GameEngine/Data/buidata.php';

// Include the buidata.php file to access the $bid20 array
include($buildataFilePath);

// Check if the first element of $bid20 exists
if (isset($bid20[1]['time'])) {
    // Extract the time value for the Stable at level 1
    $timeValue = $bid20[1]['time']/SPEED;
	
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
<h1><img src="/img/x.gif" class="gebIcon g20Icon"> Stable</h1><img class="building g20" src="img/x.gif" alt="Stable" title="Stable" />Cavalry can be trained in the stable. The higher its level, the faster the troops are trained..<p><br><b>Costs</b> and <b>construction time</b> for level 1:<br /><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /> 260 | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /> 140 | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /> 220 | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /> 100 | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /> 5 | <span class="dur"><img class="clock" alt="duration" title="duration" src="img/x.gif" /> <?php echo $formattedTime; ?></span></p>
	<p><b>Prerequisites</b><br /><a href="manual.php?typ=4&gid=12">Smithy</a> Level 3, <a href="manual.php?typ=4&gid=22">Academy</a> Level 5</p>