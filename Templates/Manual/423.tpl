<?php
// Define the path to the buidata.php file
$buildataFilePath = '/var/www/html/x'.SPEED.'/GameEngine/Data/buidata.php';

// Include the buidata.php file to access the $bid23 array
include($buildataFilePath);

// Check if the first element of $bid23 exists
if (isset($bid23[1]['time'])) {
    // Extract the time value for the Cranny at level 1
    $timeValue = $bid23[1]['time']/SPEED;
	
    // Convert the time value to a human-readable format (hh:mm:ss)
    $hours = floor($timeValue / 3600);
    $minutes = floor(($timeValue % 3600) / 60);
    $seconds = $timeValue % 60;

    // Format the time as hh:mm:ss
    $formattedTime = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
} else {
    $formattedTime = "N/A"; // Display "N/A" if data not found
}
?><a class="manualBack arrow back" href="manual.php?typ=0&gid=0">to Overview</a><br><br/>
<h1><img src="/img/x.gif" class="gebIcon g23Icon"> Cranny</h1><img class="building g23" src="img/x.gif" alt="Cranny" title="Cranny" />The cranny is used to hide at least some of your resources when the village is attacked. These resources cannot be stolen. 
<br /><br />
At level 1 the cranny can hold 200 of each resource. The capacity of Gallic crannies is 1.5 times larger. 
<br /><br />
If a Teutonic hero attacks a village, crannies can hide only 80% of their normal capacity.<p><br><b>Costs</b> and <b>construction time</b> for level 1:<br /><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /> 40 | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /> 50 | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /> 30 | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /> 10 | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /> 0 | <span class="dur"><img class="clock" alt="duration" title="duration" src="img/x.gif" /> <?php echo $formattedTime; ?></span></p>
	<p><b>Prerequisites</b><br />none</p>