<?php
// Define the path to the buidata.php file
$buildataFilePath = '/var/www/html/x'.SPEED.'/GameEngine/Data/buidata.php';

// Include the buidata.php file to access the $bid42 array
include($buildataFilePath);

// Check if the first element of $bid42 exists
if (isset($bid42[1]['time'])) {
    // Extract the time value for the Stone Wall at level 1
    $timeValue = $bid42[1]['time']/SPEED;
	
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
<h1><img src="/img/x.gif" class="gebIcon g42Icon"> Stone Wall</h1><img class="building g42" src="img/x.gif" alt="Stone Wall" title="Stone Wall" />By building a Stone Wall, you can protect your village against the barbarian hordes of your enemies. The higher its level, the higher is the bonus given to your forces' defense. <br /><br />The Stone Wall can only be built by Egyptians; its defense bonus is like the Gaulish Palisade, and its durability is almost as great as the Teutonic Earth Wall.<p><br><b>Costs</b> and <b>construction time</b> for level 1:<br /><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /> 110 | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /> 160 | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /> 70 | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /> 60 | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /> 0 | <span class="dur"><img class="clock" alt="duration" title="duration" src="img/x.gif" /> <?php echo $formattedTime; ?></span></p>
<p><b>Prerequisites</b><br />None</p>