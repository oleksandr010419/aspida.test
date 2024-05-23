<?php
// Define the path to the buidata.php file
$buildataFilePath = '/var/www/html/x'.SPEED.'/GameEngine/Data/buidata.php';

// Include the buidata.php file to access the $bid40 array
include($buildataFilePath);

// Check if the first element of $bid40 exists
if (isset($bid40[1]['time'])) {
    // Extract the time value for the Wonder Of The World at level 1
    $timeValue = $bid40[1]['time']/SPEED;
	
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
<h1><img src="/img/x.gif" class="gebIcon g40Icon"> Wonder Of The World</h1><img class="building g40 gid40" src="img/x.gif" alt="Wonder Of The World" title="Wonder Of The World" />The Wonder of the World represents the pride of all architecture. Only the mightiest and richest are able to build such a master work and defend it against envious enemies. 
<br /><br />Wonders of the World can only be erected in one of the old Natarian villages. However, a construction plan is also necessary. Starting with level 50, an additional plan is needed for its completion. The second plan one has to be owned by another player in the same alliance.<p><BR><b>Costs</b> and <b>construction time</b> for level 1:<br /><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /> 66700 | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /> 69050 | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /> 72200 | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /> 13200 | <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /> 1 | <span class="dur"><img class="clock" alt="duration" title="duration" src="img/x.gif" /> <?php echo $formattedTime; ?></span></p>
	<p><b>Prerequisites</b><br />ancient construction plan</p><map id="nav" name="nav">