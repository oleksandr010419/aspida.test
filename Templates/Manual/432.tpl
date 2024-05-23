<?php
// Define the path to the buidata.php file
$buildataFilePath = '/var/www/html/x'.SPEED.'/GameEngine/Data/buidata.php';

// Include the buidata.php file to access the $bid32 array
include($buildataFilePath);

// Check if the first element of $bid32 exists
if (isset($bid32[1]['time'])) {
    // Extract the time value for the Earth Wall at level 1
    $timeValue = $bid32[1]['time']/SPEED;
	
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
<h1><img src="/img/x.gif" class="gebIcon g32Icon"> Earth Wall</h1><img class="building g32" src="/gpack/delusion_4.5/img/g/g32-ltr.png" alt="Earth Wall" title="Earth Wall" />By building an earth wall, you can protect your village against the barbarian hordes of your enemies. The higher its level, the higher is the bonus given to your forces' defense. <br></br>
The earth wall can only be built by Teutons. <br></br>
The earth wall offers the lowest defence bonus but it is almost impossible to destroy it.<p><br><b>Costs</b> and <b>construction time</b> for level 1:<br /><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /> 120 | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /> 200 | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /> 0 | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /> 80 | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /> 0 | <span class="dur"><img class="clock" alt="duration" title="duration" src="img/x.gif" /> <?php echo $formattedTime; ?></span></p>
<p><b>Prerequisites</b><br />None</p>