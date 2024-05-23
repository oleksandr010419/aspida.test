<?php
$artefacts = $database->getOwnArtefactInfo2($village->wid);
$result = count($artefacts);
?>
<div class="gid27">
    <body>
        <table id="own" cellpadding="1" cellspacing="1">
            <thead>
                <tr>
                    <th colspan="4"><?= sokr10 ?></th>
                </tr>
                <tr>
                    <td></td>
                    <td><?= sokr11 ?></td>
                    <td><?= sokr1 ?></td>
                    <td><?= sokr9 ?></td>
                </tr>
            </thead>

            <tbody>
                <tr>
<?php
if ($result == 0) {
    echo '<td colspan="4" class="none">' . sokr12 . '</td>';
} else {
    foreach ($artefacts as $artefact) {
        include ('27_artefact_table.php');
    }
}
?>

            </tbody>
        </table>

        <table id="near" cellpadding="1" cellspacing="1">
            <thead>
                <tr>
                    <th colspan="4"><?= sokr13 ?></th>
                </tr>

                <tr>
                    <td></td>

                    <td><?= sokr11 ?></td>

                    <td><?= sokr14 ?></td>

                    <td><?= sokr15 ?></td>
                </tr>
            </thead>

            <tbody>
<?php
$arts = $database->getAllArtefacts();

$coarts = count($arts);
if ($coarts == 0) {
    echo '<td colspan="4" class="none">' . sokr16 . '</td>';
} else {

    $rows = array();
    $coor = $village->coor;
    $numeric = 0;
    $ids = '';
    foreach ($arts as $row) {
        $numeric++;
        if ($coarts > $numeric) {
            $ids .= $row['vref'] . ',';
        } else {
            $ids .= $row['vref'];
        }
    }

    foreach ($arts as $row) {

        $xdistance = ABS($coor['x'] - $row['x']);
        if ($xdistance > WORLD_MAX) {
            $xdistance = (2 * WORLD_MAX + 1) - $xdistance;
        }
        $ydistance = ABS($coor['y'] - $row['y']);
        if ($ydistance > WORLD_MAX) {
            $ydistance = (2 * WORLD_MAX + 1) - $ydistance;
        }
        $dist = round(SQRT(POW($xdistance, 2) + POW($ydistance, 2)), 1);

        array_push($row, $dist);
        $rows[$dist] = $row;
    }
    ksort($rows, SORT_DESC);
    foreach ($rows as $artefact) {
        include ('27_artefact_table.php');
    }
}
?>
            </tbody>
        </table>
</div>
