<?php
// Define the path to the unit data file
$unitDataFilePath = '/var/www/html/x' . SPEED . '/GameEngine/Data/unitdata.php';
$unit_number = 63;

if (file_exists($unitDataFilePath)) {
    include($unitDataFilePath);

    // Check if the array $u1 is defined in the included file
    if (isset(${"u" . $unit_number})) {
        $unit = ${"u" . $unit_number};
        $atk = $unit['atk'];
        $di = $unit['di'];
        $dc = $unit['dc'];
        $wood = $unit['wood'];
        $clay = $unit['clay'];
        $iron = $unit['iron'];
        $crop = $unit['crop'];
        $pop = $unit['pop'];
        $speed = $unit['speed'] * INCREASE_SPEED;
        $time = $unit['time'] / SPEED;
        $cap = $unit['cap'];

        // Display time in seconds, minutes, hours, etc. if >= 1 second
        if ($time >= 1) {
            $formattedTime = gmdate("H:i:s", $time);
        }
        // Display time in milliseconds if < 1 second and >= 1 ms
        elseif ($time >= 0.001) {
            $formattedTime = number_format($time * 1000, 0) . ' ms';
        }
        // Display time in microseconds if < 1 ms and >= 1 μs
        elseif ($time >= 0.000001) {
            $formattedTime = number_format($time * 1000000, 0) . ' μs';
        }
        // Display time in nanoseconds if < 1 μs
        else {
            $formattedTime = number_format($time * 1000000000, 0) . ' ns';
        }
    } else {
        echo "Unit data not found in the included file for unit number $unit_number";
    }
} else {
    echo "Unit data file not found at the specified path";
}
?>

<!DOCTYPE html>
<html>

<head>
  <!-- Your head content here -->
</head>

<body>
  <!-- Your HTML content here -->

  <div class="dialog manual">
    <div class="dialogContainer">
      <div class="dialogContents">
        <form action="?" method="get" accept-charset="UTF-8">
          <div class="dialogDragBar"></div>
          <div class="iconButton small info" style="display: none;"></div>
          <div class="dialogCancelButton iconButton small cancel"></div>
          <div class="content" id="dialogContent">
            <p>
              <a class="manualBack arrow back" href="manual.php?typ=0&gid=0">to Overview</a>
            </p>
            <h1 class="titleInHeader">
              <img class="unit u<?php echo $unit_number; ?>" src="/img/x.gif" alt="Spotter">
              Spotter <span class="tribe">(Huns)</span> 
            </h1>
            <div class="bigUnitSection" style="width: 160px; height: 260px;">
    <img class="unitSection u<?php echo $unit_number; ?>Section" src="/img/x.gif" alt="Spotter"; title="Spotter"; >
</div>

            <div class="troopInfoWrapper">
              <table id="troop_info" cellpadding="1" cellspacing="1"
                style="background-color: #e7e7e7; border-radius: 5px; margin: 20px; padding: 10px; margin-left: 0px;">
                <tbody>
                  <tr>
                    <td>
                      <div class="inlineIconList resourceWrapper">
                        <div class="inlineIcon resources"><img class="r1" src="img/x.gif" title="Lumber"><i class="r1"></i><span
                            class="value "><?php echo $wood; ?></span></div>
                      </div>
                    </td>
                    <td>
                      <div class="inlineIconList resourceWrapper">
                        <div class="inlineIcon resources"><img class="r2" src="img/x.gif" title="Clay"><i class="r2"></i><span
                            class="value "><?php echo $clay; ?></span></div>
                      </div>
                    </td>
                    <td>
                      <div class="inlineIconList resourceWrapper">
                        <div class="inlineIcon resources"><img class="r2" src="img/x.gif" title="Iron"><i class="r3"></i><span
                            class="value "><?php echo $iron; ?></span></div>
                      </div>
                    </td>
                    <td>
                      <div class="inlineIconList resourceWrapper">
                        <div class="inlineIcon resources"><img class="r2" src="img/x.gif" title="Crop"><i class="r4"></i><span
                            class="value "><?php echo $crop; ?></span></div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <img class="att_all" src="/img/x.gif" title="attack value"><?php echo $atk; ?>
                    </td>
                    <td>
                      <img class="def_i" src="/img/x.gif" title="defence against infantry"><?php echo $di; ?>
                    </td>
                    <td>
                      <img class="def_c" src="/img/x.gif" title="defence against cavalry"><?php echo $dc; ?>
                    </td>
                    <td>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="troopDataWrapper">
              <table id="troopData" cellpadding="1" cellspacing="1"
                style="background-color: #e7e7e7; border-radius: 5px; margin: 20px; margin-left: 0px; padding: 5px; width: 288px;">
                <tbody>
                  <tr>
                    <th style="vertical-align: middle;">Velocity</th>
                    <td>
                      <div class="inlineIconList resourceWrapper" style="display: flex; align-items: center;">
                        <img src="../gpack/delusion_4.5/img/g/boots.png" title="Velocity"
                          style="vertical-align: middle; margin-right: 10px; width: 20px; height: 20px;">
                        <span class="value" style="vertical-align: middle;"><?php echo $speed; ?></span>
                        <span style="margin-left: 5px;">fields/hour</span>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th style="vertical-align: middle;">Can carry</th>
                    <td>
                      <div class="inlineIconList resourceWrapper" style="display: flex; align-items: center;">
                        <img src="../gpack/delusion_4.5/img/g/pouch.png" title="Can carry">
                        <i class="r5" style="vertical-align: middle; margin-right: 10px;"></i>
                        <span class="value" style="vertical-align: middle;"><?php echo $cap; ?></span>
                        <span style="margin-left: 5px;">resources</span>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th style="vertical-align: middle;">Upkeep</th>
                    <td>
                      <div class="inlineIconList resourceWrapper" style="display: flex; align-items: center;">
                        <img src="../gpack/delusion_4.5/img/g/freeCrop_small.png" title="free crop">
                        <i class="r5" style="vertical-align: middle; margin-right: 10px;"></i>
                        <span class="value" style="vertical-align: middle;"><?php echo $pop; ?></span>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th style="vertical-align: middle;">Duration of training</th>
                    <td>
                      <div class="inlineIcon clocks" style="display: flex; align-items: center;">
                        <img src="../gpack/delusion_4.5/img/g/infantryBonusTime_medium.png" style="margin-right: 5px;" title="Duration of training";>
                        <i class="clock" style="vertical-align: middle; margin-right: 10px;"></i>
                        <span class="value"> <?php echo $formattedTime; ?></span>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="clear"></div>
            </div>
            <div id="t_desc">The Spotter is a lightning-fast scout unit who detects the military and economic secrets of your enemies‘ villages and relays them back to you.</div>
            <div id="prereqs"><strong><br>Prerequisites</strong><br><a href="manual.php?typ=4&gid=22;">Academy</a> Level 5, <a href="manual.php?typ=4&gid=20;">Stable</a> Level 1</div>
            <div class="buttons" style="display: none;"><button class="green dialogButtonOk ok textButtonV1" type="submit"></button></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>