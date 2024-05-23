<?php
// Define the path to the buidata.php file
$buildataFilePath = '/var/www/html/x'.SPEED.'/GameEngine/Data/buidata.php';

// Include the buidata.php file to access the $bid29 array
include($buildataFilePath);

// Check if the first element of $bid29 exists
if (isset($bid29[1]['time'])) {
    // Extract the time value for the Great Barracks at level 1
    $timeValue = $bid29[1]['time']/SPEED;
	
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
<h1><img src="/img/x.gif" class="gebIcon g29Icon"> Great Barracks</h1><img class="building g29" src="img/x.gif" alt="Great Barracks" title="Great Barracks" />The great barracks allows you to build more units at the same time but they cost thrice the original amount.   
<br /><br />
It cannot be built in the capital.<p><br><b>Costs</b> and <b>construction time</b> for level 1:<br /><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /> 630 | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /> 420 | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /> 780 | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /> 360 | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /> 4 | <span class="dur"><img class="clock" alt="duration" title="duration" src="img/x.gif" /> <?php echo $formattedTime; ?></span></p>
	<p><b>Prerequisites</b><br /><a href="manual.php?typ=4&gid=19">Barracks</a> Level 20, <strike> Capital</strike></p>