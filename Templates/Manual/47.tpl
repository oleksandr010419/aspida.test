<?php
// Define the path to the buidata.php file
$buildataFilePath = '/var/www/html/x'.SPEED.'/GameEngine/Data/buidata.php';

// Include the buidata.php file to access the $bid7 array
include($buildataFilePath);

// Check if the first element of $bid7 exists
if (isset($bid7[1]['time'])) {
    // Extract the time value for the Iron Foundry at level 1
    $timeValue = $bid7[1]['time']/SPEED;
	
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
<h1><img src="/img/x.gif" class="gebIcon g7Icon"> Iron Foundry</h1><img class="building g7" src="img/x.gif" alt="Iron Foundry" title="Iron Foundry" />The iron foundry melts iron. Based on its level your iron foundry can increase your iron production by up to 25 percent.<p><br></br><b>Costs</b> and <b>construction time</b> for level 1:<br /><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /> 200 | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /> 450 | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /> 510 | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /> 120 | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /> 6 | <span class="dur"><img class="clock" alt="duration" title="duration" src="img/x.gif" /> <?php echo $formattedTime; ?></span></p>
<p><b>Prerequisites</b><br /><a href="manual.php?typ=4&gid=3">Iron Mine</a> Level 10, <a href="manual.php?typ=4&gid=15">Main Building</a> Level 5</p>