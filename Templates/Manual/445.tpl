<?php
// Define the path to the buidata.php file
$buildataFilePath = '/var/www/html/x'.SPEED.'/GameEngine/Data/buidata.php';

// Include the buidata.php file to access the $bid45 array
include($buildataFilePath);

// Check if the first element of $bid45 exists
if (isset($bid45[1]['time'])) {
    // Extract the time value for the Waterworks at level 1
    $timeValue = $bid45[1]['time']/SPEED;
	
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
<h1><img src="/img/x.gif" class="gebIcon g45Icon"> Waterworks</h1><img class="building g45" src="img/x.gif" alt="Waterworks" title="Waterworks" />The Waterworks allows you to regulate the water flow to your oases. This not only helps to grow trees and crops, but it is also useful for quarries and mines as it supplies workers with water and resource transportation.<br></br>This building increases the bonus of all annexed oases. Its maximum effect at level 20 doubles the effect of oases.<p></br>The Waterworks can only be built by Egyptians.<br></br><b>Costs</b> and <b>construction time</b> for level 1:<br /><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /> 910 | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /> 945 | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /> 910 | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /> 340 | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /> 1 | <span class="dur"><img class="clock" alt="duration" title="duration" src="img/x.gif" /> <?php echo $formattedTime; ?></span></p>
<p><b>Prerequisites</b><br /><a href="manual.php?typ=4&gid=37">Hero's Mansion</a> Level 10</p>