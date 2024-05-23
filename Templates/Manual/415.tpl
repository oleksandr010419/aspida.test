<?php
// Define the path to the buidata.php file
$buildataFilePath = '/var/www/html/x'.SPEED.'/GameEngine/Data/buidata.php';

// Include the buidata.php file to access the $bid15 array
include($buildataFilePath);

// Check if the first element of $bid15 exists
if (isset($bid15[1]['time'])) {
    // Extract the time value for the Main Building at level 1
    $timeValue = $bid15[1]['time']/SPEED;
	
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
<h1><img src="/img/x.gif" class="gebIcon g15Icon"> Main Building</h1><img class="building g15" src="img/x.gif" alt="Main Building" title="Main Building" />The village's master builders live in the main building. The higher its level the faster your master builders complete the construction of new buildings.<p><br><b>Costs</b> and <b>construction time</b> for level 1:<br /><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /> 70 | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /> 40 | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /> 60 | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /> 20 | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /> 2 | <span class="dur"><img class="clock" alt="duration" title="duration" src="img/x.gif" /> <?php echo $formattedTime; ?></span></p>
<p><b>Prerequisites</b><br />none</p>