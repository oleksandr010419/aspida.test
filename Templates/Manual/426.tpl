<?php
// Define the path to the buidata.php file
$buildataFilePath = '/var/www/html/x'.SPEED.'/GameEngine/Data/buidata.php';

// Include the buidata.php file to access the $bid26 array
include($buildataFilePath);

// Check if the first element of $bid26 exists
if (isset($bid26[1]['time'])) {
    // Extract the time value for the Palace at level 1
    $timeValue = $bid26[1]['time']/SPEED;
	
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
<h1><img src="/img/x.gif" class="gebIcon g26Icon"> Palace</h1><img class="building g26" src="img/x.gif" alt="Palace" title="Palace" />The palace building is unique. You can only build one in your whole realm and you can proclaim that village as your capital. It also protects the village against enemy conquests. Units that can found a new village or conquer existing villages can be trained here. 
<br /><br />Additionally, the palace provides an expansion slot at levels 10, 15 and 20 each.<p><br><b>Costs</b> and <b>construction time</b> for level 1:<br /><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" />550 | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" />800 | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" />750 | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" />250 | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" />1 | <span class="dur"><img class="clock" alt="duration" title="duration" src="img/x.gif" /> <?php echo $formattedTime; ?></span></p>
	<p><b>Prerequisites</b><br /><a href="manual.php?typ=4&gid=18">Embassy</a> Level 1, <a href="manual.php?typ=4&gid=15">Main Building</a> Level 5, <a href="manual.php?typ=4&gid=25"><strike>Residence, Command Center</strike></a></p>