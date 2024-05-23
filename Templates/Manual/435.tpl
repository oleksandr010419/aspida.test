<?php
// Define the path to the buidata.php file
$buildataFilePath = '/var/www/html/x'.SPEED.'/GameEngine/Data/buidata.php';

// Include the buidata.php file to access the $bid35 array
include($buildataFilePath);

// Check if the first element of $bid35 exists
if (isset($bid35[1]['time'])) {
    // Extract the time value for the Brewery at level 1
    $timeValue = $bid35[1]['time']/SPEED;
	
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
<h1><img src="/img/x.gif" class="gebIcon g35Icon"> Brewery</h1><img class="building g35" src="img/x.gif" alt="Brewery" title="Brewery" />Tasty mead is brewed in the brewery and later quaffed by the soldiers during the celebrations.  
<br /><br />
These drinks make your soldiers braver and stronger when attacking others (1% per level). Unfortunately, the chiefs’ power of persuasion is decreased and catapults can only do random hits.
<br /><br />
It can only be built by Teutons and only in their capital. It affects the whole empire.<p><br><b>Costs</b> and <b>construction time</b> for level 1:<br /><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /> 3210 | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /> 2050 | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /> 2750 | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /> 3830 | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /> 6 | <span class="dur"><img class="clock" alt="duration" title="duration" src="img/x.gif" /> <?php echo $formattedTime; ?></span></p>
<p><b>Prerequisites</b><br /><a href="manual.php?typ=4&gid=11">Granary</a> Level 20, <a href="manual.php?typ=4&gid=16">Rally Point</a> Level 10, Capital</p>

