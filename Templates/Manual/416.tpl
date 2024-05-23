<?php
// Define the path to the buidata.php file
$buildataFilePath = '/var/www/html/x'.SPEED.'/GameEngine/Data/buidata.php';

// Include the buidata.php file to access the $bid16 array
include($buildataFilePath);

// Check if the first element of $bid16 exists
if (isset($bid16[1]['time'])) {
    // Extract the time value for the Rally Point at level 1
    $timeValue = $bid16[1]['time']/SPEED;
	
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
<h1><img src="/img/x.gif" class="gebIcon g16Icon"> Rally Point</h1><img class="building g16 gid16" src="img/x.gif" alt="Rally Point" title="Rally Point" />Your village's troops gather here. From here, you can send them out to conquer, raid or reinforce other villages.  
<br /><br />The rally point can only be built on the green grassland below and to the right of your main building.<br><br/>
If there are less attacking units than the level of the rally point, you can see the type of unit attacking. <p><br><b>Costs</b> and <b>construction time</b> for level 1:<br /><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /> 110 | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /> 160 | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /> 90 | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /> 70 | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /> 1 | <span class="dur"><img class="clock" alt="duration" title="duration" src="img/x.gif" /> <?php echo $formattedTime; ?></span></p>
	<p><b>Prerequisites</b><br />none</p>