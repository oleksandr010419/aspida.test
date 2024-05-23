<?php
// Define the path to the buidata.php file
$buildataFilePath = '/var/www/html/x'.SPEED.'/GameEngine/Data/buidata.php';

// Include the buidata.php file to access the $bid3 array
include($buildataFilePath);

// Check if the first element of $bid3 exists
if (isset($bid3[1]['time'])) {
    // Extract the time value for the Iron Mine Trough at level 1
    $timeValue = $bid3[1]['time']/SPEED;
	
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
<h1><img src="/img/x.gif" class="gebIcon g3Icon"> Iron Mine</h1><img class="building g3" src="img/x.gif" alt="Iron Mine" title="Iron Mine" />Here, miners gather the precious resource of iron. By increasing the mine's level, you increase its iron production. <br><br>By constructing an iron foundry, you can further increase the production.<p><br></br><b>Costs</b> and <b>construction time</b> for level 1:<br /><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /> 100 | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /> 80 | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /> 30 | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /> 60 | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /> 3 | <span class="dur"><img class="clock" alt="duration" title="duration" src="img/x.gif" /> <?php echo $formattedTime; ?></span></p>
<p><b>Prerequisites</b><br />none</p>