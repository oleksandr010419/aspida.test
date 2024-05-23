<h4 class="round"><?php echo STATISTIC_COUNTRY; ?></h4>
<table cellpadding="1" cellspacing="1" id="country" class="row_table_data">
    <thead>
    <tr>
        <td></td>
        <td><?php echo OVERVIEW_CN; ?></td>
        <td><?php echo STATISTIC_FLAG; ?></td>
        <td><?php echo STATISTIC38; ?></td>
        <td><?php echo STATISTIC_TOTAL_POPULATION; ?></td>
    </tr>
    </thead>
    <tbody>
<?php

if(isset($_GET['rank'])){
    $multiplier = 1;
    if(is_numeric($_GET['rank'])) {
        if($_GET['rank'] > count($ranking->getRank())) {
            $_GET['rank'] = count($ranking->getRank()) - 1;
        }
        while($_GET['rank'] > (20 * $multiplier)) {
            $multiplier += 1;
        }
        $start = 20 * $multiplier - 19;
    } else {
        $start = 1;
    }
} else {
    $start = 1;
}

if(count($ranking->getRank()) > 0) {
    $ranking = $ranking->getRank();
    for($i = $start; $i < ($start + 20); $i++) {
        if (!empty($ranking[$i]) && $ranking[$i] != "pad") {
            // Check if IsoCountryCode is "-", empty or null and set a default value if it is
            $isoCountryCode = (!empty($ranking[$i]['IsoCountryCode']) && $ranking[$i]['IsoCountryCode'] != '-' && $ranking[$i]['IsoCountryCode'] != '- Select Country -') ? $ranking[$i]['IsoCountryCode'] : 'XA';
            echo '<tr>
                <td>' . $i . '.</td>
                <td class="pla">' . $ranking[$i]['Country'] . '</td>
                <td><img src="img/flags-iso/shiny/16/' . $isoCountryCode . '.png"></td>
                <td>' . $ranking[$i]['Users'] . '</td>
                <td>' . $ranking[$i]['TotalPop'] . '</td>
                </tr>';
        }
    }
} else {
    echo '<td class="none" colspan="5">No data available</td>';
}
?>
    </tbody>
</table>
<?php include("ranksearch.php"); ?>
