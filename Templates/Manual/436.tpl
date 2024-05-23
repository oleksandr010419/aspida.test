<?php
// Define the path to the buidata.php file
$buildataFilePath = '/var/www/html/x'.SPEED.'/GameEngine/Data/buidata.php';

// Include the buidata.php file to access the $bid36 array
include($buildataFilePath);

// Check if the first element of $bid36 exists
if (isset($bid36[1]['time'])) {
    // Extract the time value for the Trapper at level 1
    $timeValue = $bid36[1]['time']/SPEED;
	
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
<h1><img src="/img/x.gif" class="gebIcon g36Icon"> Trapper</h1><img class="building g36" src="img/x.gif" alt="Trapper" title="Trapper" />The trapper protects your village with well hidden traps. This means that unwary enemies can be imprisoned and won't be able to harm your village any more. 
<br /><br />Troops cannot be freed with a raid. If the owner of the traps release the captives all of the traps will be repaired automatically. 
<br /><br />The trapper can only be constructed by Gauls.<p><br><b>Costs</b> and <b>construction time</b> for level 1:<br /><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" />80 | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /> 120 | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /> 70 | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /> 90 | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /> 4 | <span class="dur"><img class="clock" alt="duration" title="duration" src="img/x.gif" /> <?php echo $formattedTime; ?></span></p
	<p><b>Prerequisites</b><br /><a href="manual.php?typ=4&gid=16">Rally Point</a> Level 1</p><map id="nav" name="nav">
 