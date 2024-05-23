<?php
// Define the path to the buidata.php file
$buildataFilePath = '/var/www/html/x'.SPEED.'/GameEngine/Data/buidata.php';

// Include the buidata.php file to access the $bid34 array
include($buildataFilePath);

// Check if the first element of $bid34 exists
if (isset($bid34[1]['time'])) {
    // Extract the time value for the Stonemason's Lodge at level 1
    $timeValue = $bid34[1]['time']/SPEED;
	
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
<h1><img src="/img/x.gif" class="gebIcon g34Icon"> Stonemason's Lodge</h1><img class="building g34" src="img/x.gif" alt="Stonemason's Lodge" title="Stonemason's Lodge" />The stonemason's lodge is an expert at cutting stone. The further the building is extended the higher the stability of the village's buildings.<br /><br />It can only be built in the capital<p><br><br><br/><b>Costs</b> and <b>construction time</b> for level 1:<br /><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /> 155 | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /> 130 | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /> 125 | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /> 70 | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /> 2 | <span class="dur"><img class="clock" alt="duration" title="duration" src="img/x.gif" /> <?php echo $formattedTime; ?></span></p>
<p><b>Prerequisites</b><br /><a href="manual.php?typ=4&gid=15">Main Building</a> Level 5, <a href="manual.php?typ=4&gid=26">Palace</a> Level 3, Capital</p>