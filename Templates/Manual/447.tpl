<?php
// Define the path to the buidata.php file
$buildataFilePath = '/var/www/html/x'.SPEED.'/GameEngine/Data/buidata.php';

// Include the buidata.php file to access the $bid47 array
include($buildataFilePath);

// Check if the first element of $bid47 exists
if (isset($bid47[1]['time'])) {
    // Extract the time value for the Defensive Wall at level 1
    $timeValue = $bid47[1]['time']/SPEED;
	
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
<h1><img src="/img/x.gif" class="gebIcon g47Icon"> Defensive Wall</h1><img class="building g47" src="/gpack/delusion_4.5/img/g/g47-ltr.png" alt="Defensive Wall" title="Defensive Wall" />By building a defensive wall, you can protect your village against the barbarian hordes of your enemies. The higher its level, the higher the bonus given to your forces' defense.</p>The defensive wall can only be built by Spartans. Its defense bonus is like the Teutonic Earth Wall, and its durability is similar to the Gaul Palisade.
<p><br><b>Costs</b> and <b>construction time</b> for level 1:<br /><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /> 160 | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /> 100 | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /> 80 | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /> 60 | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /> 0 | <span class="dur"><img class="clock" alt="duration" title="duration" src="img/x.gif" /> <?php echo $formattedTime; ?></span></p>
	<p><b>Prerequisites</b><br />None</p><map id="nav" name="nav">