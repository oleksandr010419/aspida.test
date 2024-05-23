<?php
// Define the path to the buidata.php file
$buildataFilePath = '/var/www/html/x'.SPEED.'/GameEngine/Data/buidata.php';

// Include the buidata.php file to access the $bid41 array
include($buildataFilePath);

// Check if the first element of $bid41 exists
if (isset($bid41[1]['time'])) {
    // Extract the time value for the Horse Drinking Trough at level 1
    $timeValue = $bid41[1]['time']/SPEED;
	
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
<h1><img src="/img/x.gif" class="gebIcon g41Icon"> Horse Drinking Trough</h1><img class="building g41" src="img/x.gif" alt="Horse Drinking Trough" title="Horse Drinking Trough" />The horse drinking trough cares for the well-being of your horses and therefore increases the speed of their training.<br /><br />The horse drinking trough reduces the crop usage for the following soldiers: Equites Legati from level 10, Equites Imperatoris from level 15 and Equites Caesaris from level 20.<br /><br />The horse drinking trough can only be built by Romans.<p><br><b>Costs</b> and <b>construction time</b> for level 1:<br /><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /> 780 | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /> 420 | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /> 660 | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /> 540 | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /> 5 | <span class="dur"><img class="clock" alt="duration" title="duration" src="img/x.gif" /> <?php echo $formattedTime; ?></span></p>
<p><b>Prerequisites</b><br /><a href="manual.php?typ=4&gid=20">Stable</a> Level 20, <a href="manual.php?typ=4&gid=16">Rally Point</a> Level 10</p>