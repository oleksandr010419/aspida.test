<?php
$start_time = time();
$timelimit = 2;

$troopStarvesEvery = 1;
$ncrop = 0;

// Calculate percentage of resource storage
$wood = round(($village->awood * 100) / $village->maxstore);
$clay = round(($village->aclay * 100) / $village->maxstore);
$iron = round(($village->airon * 100) / $village->maxstore);
$crop = round(($village->acrop * 100) / $village->maxcrop);

function formatTimeToFull($currentAmount, $productionRate, $maxStorage) {
    if ($currentAmount >= $maxStorage) {
        // If storage is full, return "FULL" with an ID for JavaScript targeting
        return "<span id='fullStatus'>FULL</span>";
    } else {
        $secondsToFull = (($maxStorage - $currentAmount) / $productionRate) * 3600;
        $hoursToFull = floor($secondsToFull / 3600);
        $minutesToFull = floor(($secondsToFull % 3600) / 60);
        $secondsToFull = $secondsToFull % 60;
        return sprintf("%02d:%02d:%02d", $hoursToFull, $minutesToFull, $secondsToFull);
    }
}

function formatTimeToEmptyGranary($currentCrop, $cropConsumption) {
    $secondsToEmpty = ($currentCrop / abs($cropConsumption)) * 3600;
    $hoursToEmpty = floor($secondsToEmpty / 3600);
    $minutesToEmpty = floor(($secondsToEmpty % 3600) / 60);
    $secondsToEmpty = $secondsToEmpty % 60;
    return sprintf("%02d:%02d:%02d", $hoursToEmpty, $minutesToEmpty, $secondsToEmpty);
}

$netCropProduction = $village->getProd("crop"); // This is net crop production after upkeep

if ($netCropProduction == 0) {
    $cropStatus = "Full in: Never";
} elseif ($netCropProduction < 0) {
    // Crop is depleting, calculate time to empty granary
    $timeToEmptyGranary = formatTimeToEmptyGranary($village->acrop, $netCropProduction);
    $cropStatus = "Granary will be empty in: <span style='color: red;'>" . $timeToEmptyGranary . "</span>";
} else {
    // Crop is accumulating, calculate time to full granary
    $timeToFullGranary = formatTimeToFull($village->acrop, $netCropProduction, $village->maxcrop);
    $cropStatus = "Full in: " . $timeToFullGranary;
}

?>
<style>
    #fullStatus {
        visibility: hidden;
    }
</style>
<script>
    setInterval(function() {
        var fullStatus = document.getElementById('fullStatus');
        if (fullStatus) {
            fullStatus.style.visibility = (fullStatus.style.visibility == 'visible' ? 'hidden' : 'visible');
        }
    }, 500); // Blink every 500 milliseconds
</script>

<span id="warehouse" style="display: none;" ><?=$village->maxstore ?></span>
<span id="granary" style="display: none;" ><?=$village->maxcrop ?></span>
<ul id="stockBar">
    <li id="stockBarWarehouseWrapper" class="stock" title="<?=WAREHOUSE?>">
        <img class="warehouse" src="/img/x.gif" alt="<?=WAREHOUSE?>" />
        <span class="value" id="stockBarWarehouse"><?php echo $village->maxstore; ?></span>
    </li>
    <li id="stockBarResource1" class="stockBarButton" title="<b><?=WOOD?></b>||<?=PROD_HEADER?>: <?php echo $village->getProd("wood"); ?><br><?=FULL_IN?> <?php echo formatTimeToFull($village->awood, $village->getProd("wood"), $village->maxstore); ?></br><?=CLICK_FOR_MORE?>">
        <div class="begin"></div>
        <div class="middle">
            <img class="res r1Big" src="/img/x.gif" alt="<?=WOOD?>"/>
            <span id="l1" class="value"><?php echo round($village->awood); ?></span>
            <div class="barBox">
                <div id="lbar1" class="bar" style="width:<?php echo $wood;?>%;"></div>
            </div>
            <a href="dorf3.php" title="<?=WOOD?>||<?=PROD_HEADER?> : <?php echo $village->getProd("wood"); ?>"><img src="/img/x.gif" alt="" /></a>
        </div>
        <div class="end"></div>
    </li>
    <li id="stockBarResource2" class="stockBarButton" title="<b><?=CLAY?></b>||<?=PROD_HEADER?>: <?php echo $village->getProd("clay"); ?><br><?=FULL_IN?> <?php echo formatTimeToFull($village->aclay, $village->getProd("clay"), $village->maxstore); ?></br><?=CLICK_FOR_MORE?>">
        <div class="begin"></div>
        <div class="middle">
            <img class="res r2Big" src="/img/x.gif" alt="<?=CLAY?>"/>
            <span id="l2" class="value"><?php echo round($village->aclay); ?></span>
            <div class="barBox">
                <div id="lbar2" class="bar" style="width:<?php echo $clay;?>%;"></div>
            </div>
            <a href="dorf3.php" title="<?=CLAY?>||<?=PROD_HEADER?> : <?php echo $village->getProd("clay"); ?>"><img src="/img/x.gif" alt="" /></a>
        </div>
        <div class="end"></div>
    </li>
    <li id="stockBarResource3" class="stockBarButton" title="<b><?=IRON?></b>||<?=PROD_HEADER?>: <?php echo $village->getProd("iron"); ?><br><?=FULL_IN?> <?php echo formatTimeToFull($village->airon, $village->getProd("iron"), $village->maxstore); ?></br><?=CLICK_FOR_MORE?>">
        <div class="begin"></div>
        <div class="middle">
            <img class="res r3Big" src="/img/x.gif" alt="<?=IRON?>"/>
            <span id="l3" class="value"><?php echo round($village->airon); ?></span>
            <div class="barBox">
                <div id="lbar3" class="bar" style="width:<?php echo $iron;?>%;"></div>
            </div>
            <a href="dorf3.php" title="<?=IRON?>||<?=PROD_HEADER?> : <?php echo $village->getProd("iron"); ?>"><img src="/img/x.gif" alt="" /></a>
        </div>
        <div class="end"></div>
    </li>
    <li id="stockBarGranaryWrapper" class="stock" title="<?=CROP?>">
        <img class="granary" src="/img/x.gif" alt="<?=CROP?>" />
        <span class="value" id="stockBarGranary"><?php echo $village->maxcrop; ?></span>
    </li>
    <li id="stockBarResource4" class="stockBarButton" title="<b><?=CROP?></b>||<?=PRODUCTION_MINES_THRESHOLD?>: <?php echo $netCropProduction; ?><br><?= $cropStatus ?></br><?=CLICK_FOR_MORE?>">
        <div class="begin"></div>
        <div class="middle">
            <img class="res r4Big" src="/img/x.gif" alt="<?=CROP?>"/>
            <span id="l4" class="value"><?php echo round($village->acrop); ?></span>
            <div class="barBox">
                <div id="lbar4" class="bar" style="width:<?php echo $crop;?>%;"></div>
            </div>
            <a href="dorf3.php" title="<?=CROP?>||<?=PROD_HEADER?> : <?php echo $village->getProd("crop"); ?>"><img src="/img/x.gif" alt="" /></a>
        </div>
        <div class="end"></div>
    </li>
    <li id="stockBarFreeCropWrapper" class="stockBarButton r5">
		<div class="begin"></div>
		<div class="middle">
			<img class="res r5Big" src="img/x.gif" alt="Free crop">
			<span id="stockBarFreeCrop" class="value"><?php echo $village->getProd("crop"); ?></span>
			<a href="dorf3.php"><img src="img/x.gif" alt=""></a>
		</div>
		<div class="end"></div>
	</li>
    <li class="clear">&nbsp;</li>
</ul>


<?php
$totalproduction = $village->allcrop; // all crops + bakery + grain mill
$crop = floor($village->acrop);
?>


<script type="text/javascript">
    var resources = new Object();

    resources.production = {
        "l1": <?php echo $village->getProd("wood"); ?>,"l2": <?php echo $village->getProd("clay"); ?>,"l3": <?php echo $village->getProd("iron"); ?>,"l4": <?php echo $village->getProd("crop"); ?>,"l5": <?php echo ($village->allcrop); ?>	};
    resources.storage = {
        "l1": <?php echo $village->awood; ?>,"l2": <?php echo $village->aclay; ?>,"l3": <?php echo $village->airon; ?>,"l4": <?php echo $village->acrop; ?>	};
    resources.maxStorage = {
        "l1": <?php echo $village->maxstore; ?>,"l2": <?php echo $village->maxstore; ?>,"l3": <?php echo $village->maxstore; ?>,"l4": <?php echo $village->maxcrop; ?>	};

    $$('li.stockBarButton').each(function(element)
    {
        Travian.addMouseEvents(element, element);
    });

    var stockBarWarehouse   = $('stockBarWarehouse');
    var stockBarGranary     = $('stockBarGranary');
    var stockBarFreeCrop = $('stockBarFreeCrop');
    var numberFormatter = new Travian.Formatter({forceDecimal:false});

    stockBarWarehouse.set('html', numberFormatter.getFormattedNumber(parseInt(stockBarWarehouse.get('html'))));
    stockBarGranary.set('html', numberFormatter.getFormattedNumber(parseInt(stockBarGranary.get('html'))));

</script>
