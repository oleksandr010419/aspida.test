<?php
// Define the path to the buidata.php file
$buildataFilePath = '/var/www/html/x'.SPEED.'/GameEngine/Data/buidata.php';

// Include the buidata.php file to access the $bid2 array
include($buildataFilePath);

// Check if the first element of $bid2 exists
if (isset($bid2[1]['time'])) {
    // Extract the time value for the Clay Pit Trough at level 1
    $timeValue = $bid2[1]['time']/SPEED;
	
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
<h1><img src="/img/x.gif" class="gebIcon g2Icon"> Clay Pit</h1><img class="building g2" src="img/x.gif" alt="Clay Pit" title="Clay Pit" />Here, clay is produced. By increasing its level, you increase clay production.<br><br>By constructing a brickyard, you can further increase the production.<p><br></br><b>Costs</b> and <b>construction time</b> for level 1:<br /><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /> 80 | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /> 40 | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /> 80 | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /> 50 | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /> 2 | <span class="dur"><img class="clock" alt="duration" title="duration" src="img/x.gif" /> <?php echo $formattedTime; ?></span></p>
<p><b>Prerequisites</b><br />none</p>