<?php
// Define the path to the buidata.php file
$buildataFilePath = '/var/www/html/x'.SPEED.'/GameEngine/Data/buidata.php';

// Include the buidata.php file to access the $bid8 array
include($buildataFilePath);

// Check if the first element of $bid8 exists
if (isset($bid8[1]['time'])) {
    // Extract the time value for the Grain Mill at level 1
    $timeValue = $bid8[1]['time']/SPEED;
	
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
<h1><img src="/img/x.gif" class="gebIcon g8Icon"> Grain Mill</h1><img class="building g8" src="img/x.gif" alt="Grain Mill" title="Grain Mill" />The grain mill grinds grain into flour. Based on its level, your grain mill can increase your crop production by up to 25 percent.<p><br></br><b>Costs</b> and <b>construction time</b> for level 1:<br /><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /> 500 | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /> 440 | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /> 380 | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /> 1240 | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /> 3 | <span class="dur"><img class="clock" alt="duration" title="duration" src="img/x.gif" /> <?php echo $formattedTime; ?></span></p>
<p><b>Prerequisites</b><br /><a href="manual.php?typ=4&gid=4">Cropland</a> Level 5</p>