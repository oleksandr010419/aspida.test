<?php
// Define the path to the buidata.php file
$buildataFilePath = '/var/www/html/x'.SPEED.'/GameEngine/Data/buidata.php';

// Include the buidata.php file to access the $bid31 array
include($buildataFilePath);

// Check if the first element of $bid31 exists
if (isset($bid31[1]['time'])) {
    // Extract the time value for the City Wall at level 1
    $timeValue = $bid31[1]['time']/SPEED;
	
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
<h1><img src="/img/x.gif" class="gebIcon g31Icon"> City Wall</h1><img class="building g31" src="/gpack/delusion_4.5/img/g/g31-ltr.png" alt="City Wall" title="City Wall" />By building a city wall, you can protect your village against the barbarian hordes of your enemies. The higher its level, the higher is the bonus given to your forces' defense.<br></br>
The city wall can only be built by Romans. <br></br>
The city wall offers the biggest defence bonus, but it is easier to destroy than the Gaulish palisade or the Teutonic earth wall.<p><br><b>Costs</b> and <b>construction time</b> for level 1:<br /><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /> 70 | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /> 90 | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /> 170 | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /> 70 | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /> 0 | <span class="dur"><img class="clock" alt="duration" title="duration" src="img/x.gif" /> <?php echo $formattedTime; ?></span></p>
	<p><b>Prerequisites</b><br />None</p>
