<?php
// Define the path to the buidata.php file
$buildataFilePath = '/var/www/html/x'.SPEED.'/GameEngine/Data/buidata.php';

// Include the buidata.php file to access the $bid37 array
include($buildataFilePath);

// Check if the first element of $bid37 exists
if (isset($bid37[1]['time'])) {
    // Extract the time value for the Hero's Mansion at level 1
    $timeValue = $bid37[1]['time']/SPEED;
	
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
<h1><img src="/img/x.gif" class="gebIcon g37Icon"> Hero's Mansion</h1><img class="building g37" src="img/x.gif" alt="Hero's Mansion" title="Hero's Mansion" />The hero's mansion is the home of your glorious hero. 
<br /><br />At building levels 10, 15 and 20, you can use your hero to annex an unoccupied oasis to your village, one per each of these levels respectively. Depending on the oasis, you will get a production increase for a certain type of resource (or even two resources, from some oases).<p><br><b>Costs</b> and <b>construction time</b> for level 1:<br /><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /> 700 | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /> 670 | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /> 700 | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /> 240 | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /> 2 | <span class="dur"><img class="clock" alt="duration" title="duration" src="img/x.gif" /> <?php echo $formattedTime; ?></span></p>
	<p><br><b>Prerequisites</b><br /><a href="manual.php?typ=4&gid=15">Main Building</a> Level 3, <a href="manual.php?typ=4&gid=16">Rally Point</a> Level 1</p><map id="nav" name="nav">
 