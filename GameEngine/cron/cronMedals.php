<?php

include ("../config.php");
include ("../DB.php");
include ("../Database/db_MYSQL.php");
include ("../Model/Medal.php");

if (file_exists((dirname(__FILE__)) . "/../autoinstall.txt")) {
    addToLog("cron", "Install in progress - break;");
    die();
}
if (OPENING > time()) {
    exit;
}

$database->setArtefactOfTheFoolEffect();
include("../Ranking.php");
$ranking->PlayerClimber();
$database->RestartAchiev();
$medal = new Medal();

//bepaal welke week we zitten
$q = "SELECT max(week) as max FROM medal where allycheck=0";
$result = $database->query($q);
if (count($result)) {
    $row = $result[0];
    $week = ($row['max'] + 1);
} else {
    $week = 1;
}
//we mogen de lintjes weggeven
//Aanvallers v/d Week
$result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY ap DESC Limit 10");
$i = 0;
foreach ($result as $row) {
    $i++;
    $img = "t2_" . ($i) . "";
    $medal->addMedal($row['id'], 1, $i, $week, $row['ap'], $img);
}
//Verdediger v/d Week
$result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY dp DESC Limit 10");
$i = 0;
foreach ($result as $row) {
    $i++;
    $img = "t3_" . ($i) . "";
    $medal->addMedal($row['id'], 2, $i, $week, $row['dp'], $img);
}
//Rank climbers of the week
$result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY clp DESC Limit 10");
$i = 0;
foreach ($result as $row) {
    $i++;
    $img = "t1_" . ($i) . "";
    $medal->addMedal($row['id'], 10, $i, $week, $row['clp'], $img);
}
//Overvallers v/d Week
$result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY RR DESC Limit 10");
$i = 0;
foreach ($result as $row) {
    if ($row['RR'] >= 0) {
        $i++;
        $img = "t4_" . ($i) . "";
        $medal->addMedal($row['id'], 4, $i, $week, $row['RR'], $img);
    }
}
//geroi
$result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY herxp DESC Limit 10");
$i = 0;
foreach ($result as $row) {
    if ($row['herxp'] >= 0) {
        $i++;
        $img = "t6_" . ($i) . "";
        $medal->addMedal($row['id'], 17, $i, $week, $row['herxp'], $img);
    }
}
//torgashi
$result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY merch DESC Limit 10");
$i = 0;
foreach ($result as $row) {
    if ($row['herxp'] >= 0) {
        $i++;
        $img = "t5_" . ($i) . "";
        $medal->addMedal($row['id'], 18, $i, $week, $row['merch'], $img);
    }
}
//deel de bonus voor aanval+defence top 10 uit
//Pak de top10 aanvallers
$result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY ap DESC Limit 10");
foreach ($result as $row) {
    //Pak de top10 verdedigers
    $result2 = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY dp DESC Limit 10");
    foreach ($result2 as $row2) {
        if ($row['id'] == $row2['id']) {
            $query3 = "SELECT count(*) as sum FROM medal WHERE userid='" . $row['id'] . "' AND categorie = 5";
            $result3 = $database->query($query3);
            $row3 = $result3[0];
            //kijk welke kleur het lintje moet hebben
            if ($row3['sum'] <= '2') {
                $img = "t22" . $row3['sum'] . "_1";
                switch ($row3['sum']) {
                    case "0":
                        $tekst = "";
                        break;
                    case "1":
                        $tekst = "2 ";
                        break;
                    case "2":
                        $tekst = "3";
                        break;
                }
                $quer = "INSERT into medal(userid, categorie, plaats, week, points, img) values('" . $row['id'] . "', '5', '0', '" . $week . "', '" . $tekst . "', '" . $img . "')";
                $database->query($quer);
            }
        }
    }
}
//je staat voor 3e / 5e / 10e keer in de top 3 aanvallers
//Pak de top10 aanvallers
$result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY ap DESC Limit 10");
foreach ($result as $row) {
    $query1 = "SELECT count(*) FROM medal WHERE userid='" . $row['id'] . "' AND categorie = 1 AND plaats<=3";
    $result1 = $database->query($query1);
    $row1 = $result1[0];
    //2x in gestaan, dit is 3e dus lintje (brons)
    if ($row1[0] == '3') {
        $img = "t120_1";
        $medal->addMedal($row['id'], 6, 0, $week, 3, $img);
    }
    //4x in gestaan, dit is 5e dus lintje (zilver)
    if ($row1[0] == '5') {
        $img = "t121_1";
        $medal->addMedal($row['id'], 6, 0, $week, 5, $img);
    }
    //9x in gestaan, dit is 10e dus lintje (goud)
    if ($row1[0] == '10') {
        $img = "t122_1";
        $medal->addMedal($row['id'], 6, 0, $week, 10, $img);
    }
}
//je staat voor 3e / 5e / 10e keer in de top 10 aanvallers
//Pak de top10 aanvallers
$result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY ap DESC Limit 10");
foreach ($result as $row) {
    $query1 = "SELECT count(*) as sum FROM medal WHERE userid='" . $row['id'] . "' AND categorie = 1 AND plaats<=10";
    $result1 = $database->query($query1);
    $row1 = $result1[0];
    //2x in gestaan, dit is 3e dus lintje (brons)
    if ($row1['sum'] == '3') {
        $img = "t130_1";
        $medal->addMedal($row['id'], 12, 0, $week, 3, $img);
    }
    //4x in gestaan, dit is 5e dus lintje (zilver)
    if ($row1['sum'] == '5') {
        $img = "t131_1";
        $medal->addMedal($row['id'], 12, 0, $week, 5, $img);
    }
    //9x in gestaan, dit is 10e dus lintje (goud)
    if ($row1['sum'] == '10') {
        $img = "t132_1";
        $medal->addMedal($row['id'], 12, 0, $week, 10, $img);
    }
}
//je staat voor 3e / 5e / 10e keer in de top 3 verdedigers
//Pak de top10 verdedigers
$result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY dp DESC Limit 10");
foreach ($result as $row) {
    $query1 = "SELECT count(*) as sum FROM medal WHERE userid='" . $row['id'] . "' AND categorie = 2 AND plaats<=3";
    $result1 = $database->query($query1);
    $row1 = $result1[0];
    //2x in gestaan, dit is 3e dus lintje (brons)
    if ($row1['sum'] == '3') {
        $img = "t140_1";
        $medal->addMedal($row['id'], 7, 0, $week, 3, $img);
    }
    //4x in gestaan, dit is 5e dus lintje (zilver)
    if ($row1['sum'] == '5') {
        $img = "t141_1";
        $medal->addMedal($row['id'], 7, 0, $week, 5, $img);
    }
    //9x in gestaan, dit is 10e dus lintje (goud)
    if ($row1['sum'] == '10') {
        $img = "t142_1";
        $medal->addMedal($row['id'], 7, 0, $week, 10, $img);
    }
}
//je staat voor 3e / 5e / 10e keer in de top 3 verdedigers
//Pak de top10 verdedigers
$result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY dp DESC Limit 10");
foreach ($result as $row) {
    $query1 = "SELECT count(*) as sum FROM medal WHERE userid='" . $row['id'] . "' AND categorie = 2 AND plaats<=10";
    $result1 = $database->query($query1);
    $row1 = $result1[0];
    //2x in gestaan, dit is 3e dus lintje (brons)
    if ($row1['sum'] == '3') {
        $img = "t150_1";
        $medal->addMedal($row['id'], 13, 0, $week, 3, $img);
    }
    //4x in gestaan, dit is 5e dus lintje (zilver)
    if ($row1['sum'] == '5') {
        $img = "t151_1";
        $medal->addMedal($row['id'], 13, 0, $week, 5, $img);
    }
    //9x in gestaan, dit is 10e dus lintje (goud)
    if ($row1['sum'] == '10') {
        $img = "t152_1";
        $medal->addMedal($row['id'], 13, 0, $week, 10, $img);
    }
}
//je staat voor 3e / 5e / 10e keer in de top 3 klimmers
//Pak de top10 klimmers
$result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY Rc DESC Limit 10");
foreach ($result as $row) {
    $query1 = "SELECT count(*) as sum FROM medal WHERE userid='" . $row['id'] . "' AND categorie = 3 AND plaats<=3";
    $result1 = $database->query($query1);
    $row1 = $result1[0];
    //2x in gestaan, dit is 3e dus lintje (brons)
    if ($row1['sum'] == '3') {
        $img = "t100_1";
        $medal->addMedal($row['id'], 8, 0, $week, 3, $img);
    }
    //4x in gestaan, dit is 5e dus lintje (zilver)
    if ($row1['sum'] == '5') {
        $img = "t101_1";
        $medal->addMedal($row['id'], 8, 0, $week, 5, $img);
    }
    //9x in gestaan, dit is 10e dus lintje (goud)
    if ($row1['sum'] == '10') {
        $img = "t102_1";
        $medal->addMedal($row['id'], 8, 0, $week, 10, $img);
    }
}//je staat voor 3e / 5e / 10e keer in de top 3 klimmers
//Pak de top10 klimmers
$result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY Rc DESC Limit 10");
foreach ($result as $row) {
    $query1 = "SELECT count(*) as sum FROM medal WHERE userid='" . $row['id'] . "' AND categorie = 3 AND plaats<=10";
    $result1 = $database->query($query1);
    $row1 = $result1[0];
    //2x in gestaan, dit is 3e dus lintje (brons)
    if ($row1['sum'] == '3') {
        $img = "t110_1";
        $medal->addMedal($row['id'], 14, 0, $week, 3, $img);
    }
    //4x in gestaan, dit is 5e dus lintje (zilver)
    if ($row1['sum'] == '5') {
        $img = "t111_1";
        $medal->addMedal($row['id'], 14, 0, $week, 5, $img);
    }
    //9x in gestaan, dit is 10e dus lintje (goud)
    if ($row1['sum'] == '10') {
        $img = "t112_1";
        $medal->addMedal($row['id'], 14, 0, $week, 10, $img);
    }
}
//je staat voor 3e / 5e / 10e keer in de top 3 klimmers
//Pak de top3 rank climbers
$result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY clp DESC Limit 10");
foreach ($result as $row) {
    $query1 = "SELECT count(*) as sum FROM medal WHERE userid='" . $row['id'] . "' AND categorie = 10 AND plaats<=3";
    $result1 = $database->query($query1);
    $row1 = $result1[0];
    //2x in gestaan, dit is 3e dus lintje (brons)
    if ($row1['sum'] == '3') {
        $img = "t200_1";
        $medal->addMedal($row['id'], 11, 0, $week, 3, $img);
    }
    //4x in gestaan, dit is 5e dus lintje (zilver)
    if ($row1['sum'] == '5') {
        $img = "t201_1";
        $medal->addMedal($row['id'], 11, 0, $week, 5, $img);
    }
    //9x in gestaan, dit is 10e dus lintje (goud)
    if ($row1['sum'] == '10') {
        $img = "t202_1";
        $medal->addMedal($row['id'], 11, 0, $week, 10, $img);
    }
}
//je staat voor 3e / 5e / 10e keer in de top 10klimmers
//Pak de top3 rank climbers
$result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY clp DESC Limit 10");
foreach ($result as $row) {
    $query1 = "SELECT count(*) as sum FROM medal WHERE userid='" . $row['id'] . "' AND categorie = 10 AND plaats<=10";
    $result1 = $database->query($query1);
    $row1 = $result1[0];
    //2x in gestaan, dit is 3e dus lintje (brons)
    if ($row1['sum'] == '3') {
        $img = "t210_1";
        $medal->addMedal($row['id'], 16, 0, $week, 3, $img);
    }
    //4x in gestaan, dit is 5e dus lintje (zilver)
    if ($row1['sum'] == '5') {
        $img = "t211_1";
        $medal->addMedal($row['id'], 16, 0, $week, 5, $img);
    }
    //9x in gestaan, dit is 10e dus lintje (goud)
    if ($row1['sum'] == '10') {
        $img = "t212_1";
        $medal->addMedal($row['id'], 16, 0, $week, 10, $img);
    }
}
//je staat voor 3e / 5e / 10e keer in de top 10 overvallers
//Pak de top10 overvallers
$result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY RR DESC Limit 10");
foreach ($result as $row) {
    $query1 = "SELECT count(*) as sum FROM medal WHERE userid='" . $row['id'] . "' AND categorie = 4 AND plaats<=3";
    $result1 = $database->query($query1);
    $row1 = $result1[0];
    //2x in gestaan, dit is 3e dus lintje (brons)
    if ($row1['sum'] == '3') {
        $img = "t160_1";
        $medal->addMedal($row['id'], 9, 0, $week, 3, $img);
    }
    //4x in gestaan, dit is 5e dus lintje (zilver)
    if ($row1['sum'] == '5') {
        $img = "t161_1";
        $medal->addMedal($row['id'], 9, 0, $week, 5, $img);
    }
    //9x in gestaan, dit is 10e dus lintje (goud)
    if ($row1['sum'] == '10') {
        $img = "t162_1";
        $medal->addMedal($row['id'], 9, 0, $week, 10, $img);
    }
} //je staat voor 3e / 5e / 10e keer in de top 10 overvallers
//Pak de top10 overvallers
$result = $database->query("SELECT * FROM users WHERE id > 5 ORDER BY RR DESC Limit 10");
foreach ($result as $row) {
    $query1 = "SELECT count(*) as sum FROM medal WHERE userid='" . $row['id'] . "' AND categorie = 4 AND plaats<=10";
    $result1 = $database->query($query1);
    $row1 = $result1[0];
    //2x in gestaan, dit is 3e dus lintje (brons)
    if ($row1['sum'] == '3') {
        $img = "t170_1";
        $medal->addMedal($row['id'], 15, 0, $week, 3, $img);
    }
    //4x in gestaan, dit is 5e dus lintje (zilver)
    if ($row1['sum'] == '5') {
        $img = "t171_1";
        $medal->addMedal($row['id'], 15, 0, $week, 5, $img);
    }
    //9x in gestaan, dit is 10e dus lintje (goud)
    if ($row1['sum'] == '10') {
        $img = "t172_1";
        $medal->addMedal($row['id'], 15, 0, $week, 10, $img);
    }
}
//Zet alle waardens weer op 0
$database->query("UPDATE users SET ap=0, dp=0,Rc=0,clp=0, RR=0 ,herxp=0,merch=0 WHERE id >5");
//Start alliance Medals wooot
//Aanvallers v/d Week
$result = $database->query("SELECT * FROM alidata ORDER BY ap DESC Limit 10");
$i = 0;
foreach ($result as $row) {
    $i++;
    $img = "a2_" . ($i) . "";
    $medal->addMedal($row['id'], 1, $i, $week, $row['ap'], $img,1);
}
//Verdediger v/d Week
$result = $database->query("SELECT * FROM alidata ORDER BY dp DESC Limit 10");
$i = 0;
foreach ($result as $row) {
    $i++;
    $img = "a3_" . ($i) . "";
    $medal->addMedal($row['id'], 2, $i, $week, $row['dp'], $img,1);
}
//Overvallers v/d Week
$result = $database->query("SELECT * FROM alidata ORDER BY RR DESC Limit 10");
$i = 0;
foreach ($result as $row) {
    if ($row['RR'] >= 0) {
        $i++;
        $img = "a4_" . ($i) . "";
        $medal->addMedal($row['id'], 4, $i, $week, $row['RR'], $img,1);
    }
}
//Rank climbers of the week
$result = $database->query("SELECT * FROM alidata ORDER BY clp DESC Limit 10");
$i = 0;
foreach ($result as $row) {
    $i++;
    $img = "a1_" . ($i) . "";
    $medal->addMedal($row['id'], 3, $i, $week, $row['clp'], $img,1);
}

$database->query("UPDATE alidata SET ap=0, dp=0, RR=0, clp=0 WHERE id >0");
$prizers = $database->query("SELECT `userid` FROM `medal` WHERE `allycheck`='0' and `week`='" . $week . "'");
foreach ($prizers as $p) {
    $database->UpdateAchievU($p['userid'], "`a2`='1'");
}
$database->PerformClose();
$medal->PerformClose();
