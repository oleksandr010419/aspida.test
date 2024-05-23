<?php
// Define the path to the buidata.php file
$buildataFilePath = '/var/www/html/x'.SPEED.'/GameEngine/Data/buidata.php';

// Include the buidata.php file to access the $bid9 array
include($buildataFilePath);

// Check if the first element of $bid9 exists
if (isset($bid9[1]['time'])) {
    // Extract the time value for the Bakery at level 1
    $timeValue = $bid9[1]['time']/SPEED;
	
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
<h1><img src="/img/x.gif" class="gebIcon g9Icon"> Bakery</h1><img class="building g9" src="img/x.gif" alt="Bakery" title="Bakery" />The bakery changes flour into bread. In conjunction to the grain mill the increase in crop production can go up to 50 percent in total.<p><br></br><b>Costs</b> and <b>construction time</b> for level 1:<br /><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /> 1200 | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /> 1480 | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /> 870 | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /> 1600 | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /> 4 | <span class="dur"><img class="clock" alt="duration" title="duration" src="img/x.gif" /> <?php echo $formattedTime; ?></span></p>
<p><b>Prerequisites</b><br /><a href="manual.php?typ=4&gid=4">Cropland</a> Level 10, <a href="manual.php?typ=4&gid=15">Main Building</a> Level 5, <a href="manual.php?typ=4&gid=8">Grain Mill</a>&nbsp;Level&nbsp;5</p>