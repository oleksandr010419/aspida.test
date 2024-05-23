<?php

require_once("Data/unitdata.php");
class Att {

    function researchComplete($id) {
        global $database,$hero_model;
        $q = "SELECT tech,vref,id FROM research where `id` ='" . $id . "'";
        $tech = $database->query($q);
        if (!count($tech)) {
            $this->DelTrash($id, 6);
            return true;
        }
        if (count($tech) > 0) {
            $data = $tech[0];
            $sort_type = substr($data['tech'], 0, 1);
            switch ($sort_type) {
                case "t":
                    $q = "UPDATE tdata set " . $data['tech'] . " = 1 where vref = '" . $data['vref'] . "'";
                    break;
                case "a":
                case "b":
                    $q = "UPDATE abdata set " . $data['tech'] . " = " . $data['tech'] . " + 1 where vref = '" . $data['vref'] . "'";
                    break;
            }

            $database->query($q);
            $database->query("DELETE FROM research where id = '" . $data['id'] . "'");
            return true;
        }
    }

    function Builder() {
        global $database,$hero_model, $bid18;
        $q = "SELECT * FROM bdata where `master`='0' and `timestamp` <= '" . time() . "' ORDER BY loopcon ASC, timestamp ASC";
        //$q = "SELECT * FROM bdata";
        $buil = $database->query($q);

        foreach ($buil as $b) {

            $q = "UPDATE fdata set f" . $b['field'] . " = '" . $b['level'] . "', f" . $b['field'] . "t = '" . $b['type'] . "' where `vref` = '" . $b['wid'] . "'";
            $database->query($q);
            $level = $b['level'];
            $pop = $database->getPop($b['type'], ($level - 1));

            $builder = $database->getUserInfoByVillageID($b['wid']);
            if($builder){                   
                $leader = $builder['id'];
                $ally = $builder['alliance'];


                require_once __DIR__ . '/DailyQuest.php';
                $dailyQuest = new DailyQuest($leader);
                $dailyQuest->incrementQuest($b['field'] < 19 ? QUEST_UPGRADE_RESOURCE : QUEST_UPGRADE_BUILDING);
                unset($dailyQuest);


                if ($pop > 0) {
                    $database->addCPop($b['wid'], $pop[1], $pop[0]);
                    $database->addclimberrankpopAlly($ally, $pop[0]);
                }
                if ($b['type'] == 18) {

                    if ($ally != 0) {
                        $qlok = $database->query("SELECT leader,max FROM alidata where `id` = '" . $ally . "'");
                        $alhel = $qlok[0];
                        if ($alhel['leader'] == $leader && $alhel['max'] < 60) {
                            $newmax = $bid18[$b['level']]['attri'];
                            if ($alhel['max'] < $newmax) {
                                $database->UpdateMaxAlly($ally, $newmax);
                            }
                        }
                    }
                }
                if ($builder['tribe'] != 1) {
                    $q4 = "UPDATE bdata set loopcon = 0 where loopcon = 1  and wid = '" . $b['wid'] . "'";
                    $database->query($q4);
                } else {
                    if ($b['field'] > 18) {
                        $q4 = "UPDATE bdata set loopcon = 0 where loopcon = 1  and wid = '" . $b['wid'] . "' and id > 18";
                        $database->query($q4);
                    } else {
                        $q4 = "UPDATE bdata set loopcon = 0 where loopcon = 1  and wid = '" . $b['wid'] . "' and field < 19";
                        $database->query($q4);
                    }
                }
            }


            $q = "DELETE FROM bdata where `id` = '" . $b['id'] . "'";
            $database->query($q);
            $raaray = array(5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 96, 97, 98, 99);
            if ($b['field'] == 99 && in_array($b['level'], $raaray)) {
                $battle = new Battle();
				$battle->NatarAttack($b['wid'], $b['level']);
            }
            unset($pop, $level, $builder, $q, $q4, $alhel, $newmax, $ally, $leader, $qlok);
        }
    }

    function MasterBuilder() {
        global $database,$hero_model;
        $q = "SELECT * FROM bdata WHERE master = 1";
        $array = $database->query($q);
        foreach ($array as $master) {
            $infa = $database->getMasterBuilder($master['wid']);
            $tribe = $infa['tribe'];
            $type = $master['type'];
            $level = $master['level'];
            // $usergold=$infa['gold'];
            $buildarray = $GLOBALS["bid" . $type];

            $dorf1 = $database->getDorf1Building($master['wid']);
            $dorf2 = $database->getDorf2Building($master['wid']);
            if ($tribe == 1) {
                if ($master['field'] < 19) {
                    $bdata = count($dorf1);
                    $bbdata = count($dorf2);
                    $bdata1 = $dorf1;
                } else {
                    $bdata = count($dorf2);
                    $bbdata = count($dorf1);
                    $bdata1 = $dorf2;
                }
            } else {
                $bdata1 = $database->getJobsnoM($master['wid']);
                $bbdata = $bdata = count($dorf1) + count($dorf2);
            }
            if ($infa['plus'] > time()) {
                if ($bbdata < 2) {
                    $inbuild = 2;
                } else {
                    $inbuild = 1;
                }
            } else {
                $inbuild = 1;
            }
            if ($bdata < $inbuild && $database->modifyResource($master['wid'], $buildarray[$level]['wood'], $buildarray[$level]['clay'], $buildarray[$level]['iron'], $buildarray[$level]['crop'], 0) //&& $usergold > 0){
            ) {

                $time = $master['timestamp'] + time();
                if ($bdata && is_array($bdata1)) {
                    foreach ($bdata1 as $master1) {
                        $time += ($master1['timestamp'] - time());
                    }
                }

                if ($bdata < 1) {
                    $database->updateBuildingWithMaster($master['id'], $time, 0);
                } else {
                    $database->updateBuildingWithMaster($master['id'], $time, 1);
                }
                // $gold = $usergold-1;
                //$database->updateUserField($infa['owner'],'gold',$gold,1);
            }
        }
    }

    function sendAdventuresComplete($id) {
        global $database,$hero_model;
        $ntype = time();
        $time = time();
        $nntype = $num = 0;
        $helmet = array();
        $q = "SELECT * FROM movement where `proc` = '0' and `sort_type` = '9' and `ref` = '" . $id . "'";
        $data = $database->query($q);
        if (!count($data)) {
            $this->DelTrash($id, 13);
            return true;
        }
        $data = $data[0];
        $from = $database->getMInfo($data['from']);
        if(!isset($from['owner'])){
         return;
        }
        $to = $database->getMInfo($data['to']);
        $ally = $database->getUserField($from['owner'], 'alliance', 0);
        $tribe = $database->getUserField($from['owner'], 'tribe', 0);
        $ownerID = $from['owner'];
        require_once __DIR__ . '/DailyQuest.php';
        $dailyQuest = new DailyQuest($ownerID);
        $dailyQuest->incrementQuest(QUEST_ADVENTURE);
        unset($dailyQuest);
        $database->setMovementProc($data['moveid']);
        $database->UpdateAchievU($ownerID, "`a1`=a1+1"); //для ачивок                        
        $coor = $database->getCoor($data['to']);
        $getHero = $database->getHeroData($ownerID);
        $getAdv = $database->getAdventure($ownerID, $data['to']);
        if (empty($getAdv)) {
            //завершаем прикл если инфа на него отсутствует
            $bonuses = $database->allHeroBonuses($database->getHeroInventory($ownerID));
            $ref = $database->addAttack($from['wref'], 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 3, 0, 0, 0);
            $speeds = array();
            $speeds[] = $getHero['speed'];
            $endtime = $database->procDistanceTime($from, $to, (min($speeds) * $bonuses['back'] * $bonuses['speedb']), 1) + $data['endtime'];
            $database->addMovement(4, $data['to'], $data['from'], $ref, $data['endtime'], $endtime);
            $database->insertQueue($ref, 2, $data['endtime'], $endtime);
            //выходим с функции в стиле js
            return;
        }
        $helmetID = $database->getHeroItemID($ownerID, 1);
        if ($helmetID != 0) {
            $helmet = $database->getItemData($helmetID);
        }
        //что-то считаем и бьем героя и начисляем ему опыт.
        if ($getAdv['dif'] == 0) {
            $exp = rand(0, 40);
            $sgh = 1000;
        } else {
            $exp = rand(10, 80);
            $sgh = 2000;
        }

        if ($tribe == 1) {
            $tp = 100;
        } else {
            $tp = 80;
        }
        $health = round((3.007 / ((100 + $tp * $getHero['power']) + $getHero['itempower'])) * $sgh);
        if (count($helmet)) {
            if ($helmet['proc'] == 1 && $helmet['type'] <= 3) {
                $exp += $exp * (10 + $helmet['type'] * 5) / 100;
            }
        }
        $database->modifyHeroXp('experience', $exp, $ownerID, 1);
        $database->modifyPoints($ownerID, 'herxp', $exp);
        if (($getHero['health'] - $health) <= 0) {
            $database->modifyHero2('dead', 1, $ownerID, 0);
            $database->modifyHero2('health', $health, $ownerID, 2);
            $datainf = '' . $from['wref'] . ',dead,REP_С46,,' . $health . ',' . $exp . '';
        } else {
            $database->modifyHero2('health', $health, $ownerID, 2); //отнимаем здоровье

            $notroops = rand(0, 3);
            //   $notroops=3;
            if ($notroops > 0) {
                $nosilver = rand(0, 3);
                //$nosilver=3;
                if ($nosilver > 0) {
                    $btype = rand(0, 15);
                    //  $btype = 9;
                    if ($btype == 10) {
                        $btype = 9;
                    }
                    switch ($btype) {
                        case 1:
                            // $ntype = array(1=>1,2,3,4,5,6,7,8,9,10,11,12,13,14,15);
                            if ($time >= (ARTEFACTS)) {
                                $ntype = array(1 => 1, 2, 4, 5, 7, 8, 10, 11, 13, 14);
                            } elseif ($time >= (round((ARTEFACTS + WW_PLAN) / 2))) {
                                $ntype = array(1 => 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15);
                            } else {
                                $ntype = array(1 => 1, 4, 7, 10, 13);
                            }
                            break;
                        case 2:
                            // $ntype = array(1=>82,83,84,85,86,87,88,89,90,91,92,93);
                            if ($time >= (ARTEFACTS)) {
                                $ntype = array(1 => 82, 83, 85, 86, 88, 89, 91, 92);
                            } elseif ($time >= (round((ARTEFACTS + WW_PLAN) / 2))) {
                                $ntype = array(1 => 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93);
                            } else {
                                $ntype = array(1 => 82, 85, 88, 91);
                            }
                            break;
                        case 3:
                            //    $ntype = array(1=>61,62,63,64,65,66,67,68,69,73,74,75,76,77,78,79,80,81);
                            if ($time >= (ARTEFACTS)) {
                                $ntype = array(1 => 61, 62, 64, 65, 67, 68, 73, 74, 79, 80);
                            } elseif ($time >= (round((ARTEFACTS + WW_PLAN) / 2))) {

                                $ntype = array(1 => 61, 62, 63, 64, 65, 66, 67, 68, 69, 73, 74, 75, 76, 77, 78, 79, 80, 81);
                            } else {
                                $ntype = array(1 => 61, 64, 67, 73, 79);
                            }
                            break;
                        case 4:
                            if ($time >= (ARTEFACTS)) {
                                if ($tribe == 1) {
                                    $ntype = array(1 => 16, 17, 19, 20, 22, 23, 25, 26, 28, 29);
                                } elseif ($tribe == 2) {
                                    $ntype = array(1 => 46, 47, 49, 50, 52, 53, 55, 56, 58, 59);
                                } elseif ($tribe == 3) {
                                    $ntype = array(1 => 31, 32, 34, 35, 37, 38, 40, 41, 43, 44);
                                }elseif ($tribe == 6) {
                                    $ntype = array(1 => 115, 116, 118, 119, 121, 122, 124, 125, 127, 128);
                                }elseif ($tribe == 7) {
                                    $ntype = array(1 => 130, 131, 133, 134, 136, 137, 139, 140, 142,143 );
                                }
                            } elseif ($time >= (round((ARTEFACTS + WW_PLAN) / 2))) {
                                if ($tribe == 1) {
                                    $ntype = array(1 => 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30);
                                } elseif ($tribe == 2) {
                                    $ntype = array(1 => 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60);
                                } elseif ($tribe == 3) {
                                    $ntype = array(1 => 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45);
                                }elseif ($tribe == 6) {
                                    $ntype = array(1 => 115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126, 127, 128, 129);
                                }elseif ($tribe == 7) {
                                    $ntype = array(1 => 130, 131, 132, 133, 134, 135, 136, 137, 138, 139, 140, 141, 142,143, 144 );
                                }
                            } else {
                                if ($tribe == 1) {
                                    $ntype = array(1 => 16, 19, 22, 25, 28);
                                } elseif ($tribe == 2) {
                                    $ntype = array(1 => 46, 49, 52, 55, 58);
                                } elseif ($tribe == 3) {
                                    $ntype = array(1 => 31, 34, 37, 40, 43);
                                }elseif ($tribe == 6) {
                                    $ntype = array(1 => 115, 118, 121, 124, 127);
                                }elseif ($tribe == 7) {
                                    $ntype = array(1 => 130, 133, 136, 139, 142);
                                }
                            }
                            break;
                        case 5:
                            //  $ntype = array(1=>94,95,96,98,99,100,101,102);
                            if ($time >= (ARTEFACTS)) {
                                $ntype = array(1 => 94, 95, 97, 98, 100, 101);
                            } elseif ($time >= (round((ARTEFACTS + WW_PLAN) / 2))) {
                                $ntype = array(1 => 94, 95, 96, 98, 99, 100, 101, 102);
                            } else {
                                $ntype = array(1 => 94, 97, 100);
                            }
                            break;
                        case 6:
                            //$ntype = array(1=>103,104,105);
                            if ($time >= (ARTEFACTS)) {
                                if ($hero_model->checkIfHeroHasHorse(104, $ownerID)) {
                                    $btype = 0;
                                } else {
                                    $ntype = array(1 => 104);
                                }
                            } elseif ($time >= (round((ARTEFACTS + WW_PLAN) / 2))) {
                                if ($hero_model->checkIfHeroHasHorse(105, $ownerID)) {
                                    $btype = 0;
                                } else {
                                    $ntype = array(1 => 105);
                                }
                            } else {
                                if ($hero_model->checkIfHeroHasHorse(103, $ownerID)) {
                                    $btype = 0;
                                } else {
                                    $ntype = array(1 => 103);
                                }
                            }
                            break;
                    }



                    if ($btype >= 7) {
                        $nntype = 0;
                        if ($btype == 9) {
                            if ($time >= (ARTEFACTS)) {
                                $num = rand(12, 20);
                            } elseif ($time >= (round((ARTEFACTS + WW_PLAN) / 2))) {
                                $num = rand(18, 20);
                            } else {
                                $num = rand(6, 15);
                            }
                        } elseif ($btype == 12 or $btype == 13 or $btype == 15) {
                            $num = 1;
                        } else {
                            if ($time >= (ARTEFACTS)) {
                                $num = rand(35, 50);
                            } elseif ($time >= (round((ARTEFACTS + WW_PLAN) / 2))) {
                                $num = rand(45, 55);
                            } else {
                                $num = rand(20, 30);
                            }
                        }
                        if ($btype <= 11 or $btype >= 14) {
                            $id = $database->checkHeroItem($ownerID, $btype);
                            if ($id) {
                                $database->editHeroNum($id, $num, 1);
                            } else {
                                $database->addHeroItem($ownerID, $btype, $nntype, $num);
                            }
                        } else {
                            $database->addHeroItem($ownerID, $btype, $nntype, $num);
                        }
                    } else {
                        if ($btype) {
                            $num = 1;
                            $s2 = rand(1, count($ntype));
                            $nntype = $ntype[$s2];
                            $database->addHeroItem($ownerID, $btype, $nntype, $num);
                        }
                    }
                    if ($btype == 0) {
                        $datainf = '' . $from['wref'] . ',,REP_С31,,' . $health . ',' . $exp . '';
                    } else {
                        $datainf = '' . $from['wref'] . ',' . $btype . ',' . $nntype . ',' . $num . ',' . $health . ',' . $exp . '';
                    }
                } else {
                    $amt = rand(300, 1000);
                    $datainf = $from['wref'] . ',17,0,' . $amt . ',' . $health . ',' . $exp;

                    $database->setSilver($ownerID, $amt, 1);
                }
            } else {

                //если войска взяли
                $unit = rand(1, 6);
                if (($tribe != 3 && $unit < 4) or ( $tribe == 3 && $unit < 3)) {
                    $amt = rand(20, 40) * SPEED / 8;
                } else if (($tribe != 3 && $unit == 4) or ( $tribe == 3 && $unit == 3)) {
                    $amt = rand(10, 20) * SPEED / 8;
                } else {
                    $amt = rand(5, 10) * SPEED / 8;
                }
                $datainf = '' . $from['wref'] . ',16,' . $unit . ',' . $amt . ',' . $health . ',' . $exp . '';


                //забираем войска с собой

                $ref = $database->addAttack($from['wref'], 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 0, 0);
                $database->modifyAttack2($ref, array($unit), array(-$amt));
                $speeds1 = array();
                $unitarray = $GLOBALS["u" . (($tribe - 1) * 10 + $unit)];
                $speeds1[] = $unitarray['speed'];
                $endtime = $database->procDistanceTime($from, $to, min($speeds1), 1) + $data['endtime'];
                $database->addMovement(4, $data['to'], $data['from'], $ref, $data['endtime'], $endtime);
                $database->insertQueue($ref, 2, $data['endtime'], $endtime);
            }
            //  $database->editTableField('adventure', 'end', 1, 'wref', $data['to']);
            $database->query("UPDATE adventure SET `end`='1' WHERE `id`='" . $getAdv['id'] . "'");
            //герой идет домой
            $bonuses = $database->allHeroBonuses($database->getHeroInventory($ownerID));
            $ref = $database->addAttack($from['wref'], 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 3, 0, 0, 0);
            $speeds = array();
            $speeds[] = $getHero['speed'];
            $endtime = $database->procDistanceTime($from, $to, (min($speeds) * $bonuses['back'] * $bonuses['speedb']), 1) + $data['endtime'];
            $database->addMovement(4, $data['to'], $data['from'], $ref, $data['endtime'], $endtime);
            $database->insertQueue($ref, 2, $data['endtime'], $endtime);
        }
        //выкидываем конечный отчет
        $database->addNotice($ownerID, $data['to'], $ally, 21, $datainf, $data['endtime'], '' . addslashes($from['name']) . ' REP_С48 (' . addslashes($coor['x']) . '|' . addslashes($coor['y']) . ')');
        $database->query("UPDATE adventure SET `end`='2' WHERE `time`<='" . time() . "'");
        return true;
    }

    function ReturnCom($id) {
        global $database,$hero_model;

        $q = "SELECT * FROM movement as m INNER JOIN  attacks as a ON
     a.id = m.ref
      WHERE
     m.proc = '0' and
     m.ref='" . $id . "'";
        $data = $database->query($q);
        if (count($data) > 0) {
            $data = $data[0];
            //возврат
            $database->setMovementProc($data['moveid']);
            $database->modifyUnit(
                    $data['to'], array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11), array($data['t1'], $data['t2'], $data['t3'], $data['t4'], $data['t5'], $data['t6'], $data['t7'], $data['t8'], $data['t9'], $data['t10'], $data['t11']), 1,"Units returning...");
            $evasion = $database->getEvasion($data['to']);
            if ($evasion['capital'] == 1 && $evasion['evasion'] == 1) {
                $q = "UPDATE `users` SET `evasiontime`='" . $data['endtime'] . "' WHERE `id`='" . $evasion['id'] . "'";
                $database->query($q);
            }
            if ($data['wood'] != 0 || $data['clay'] != 0 || $data['iron'] != 0 || $data['crop'] != 0) {
                $database->modifyResource($data['to'], $data['wood'], $data['clay'], $data['iron'], $data['crop'], 1);
            }
            return true;
        }
        if (!count($data)) {
            $this->DelTrash($id, 2);
            return true;
        }
    }

    function SettCom($id) {
        global $database,$hero_model;

        $q = "SELECT * FROM movement as m
      WHERE
     m.proc = '0' and
     m.ref='" . $id . "'";

        $data = $database->query($q);

        if (count($data) > 0) {
            $data = $data[0];
            $database->setMovementProc($data['moveid']);

            $AtInf = $database->getUserInfoByVillageID($data['from']);
            $taken = $database->getVillageState($data['to']);
            $varray1 = $database->getVilKol($AtInf['id']);
            $mode = CP;
            global ${'cp' . $mode};
            $cp_mode = ${'cp' . $mode};
            $need_cps = $cp_mode[$varray1 + 1];
            $user_cps = $AtInf['cp'];
            if ($taken != 1 && $user_cps >= $need_cps) {
                $database->setFieldTaken($data['to']);
                $database->addVillage($data['to'], $AtInf['id'], "", 0);
                $database->addResourceFields($data['to'], $database->getVillageType($data['to']));
                $database->addUnits($data['to']);
                $database->addTech($data['to']);
                $database->addABTech($data['to']);
                $exp = $database->ThreeExp($data['from']);
                $exp1 = $exp['exp1'];
                $exp2 = $exp['exp2'];

                if ($exp1 == 0) {
                    $exp = 'exp1';
                } elseif ($exp2 == 0) {
                    $exp = 'exp2';
                } else {
                    $exp = 'exp3';
                }
                $database->setVillageField($data['from'], $exp, $data['to']);
                $database->UpdateAchievU($AtInf['id'], "`a4`=1");
                //ачивка за основание деры
            } else {
                // here must come movement from returning settlers
                $database->insertQueue($data['ref'], 2, $data['endtime'], ($data['endtime'] + ($data['endtime'] - $data['starttime'])));
                $database->addMovement(4, $data['to'], $data['from'], $data['ref'], $data['endtime'], $data['endtime'] + ($data['endtime'] - $data['starttime']));
            }
            return true;
        }
        if (!count($data)) {
            $this->DelTrash($id, 4);
            return true;
        }
    }

    function reiCom($id) {
        global $database,$hero_model;
        $q = "SELECT * FROM movement as m INNER JOIN  attacks as a ON
     a.id = m.ref
      WHERE
     m.proc = '0' and
     m.ref=" . $id;

        $data = $database->query($q);
        if (!count($data)) {
            $this->DelTrash($id, 3);
            return true;
        }
        $data = $data[0];
        $totalR = 0;
        $database->setMovementProc($data['moveid']);
        $AtInf = $database->getUserInfoByVillageID($data['from']);
        $def = $database->getUserInfoByVIDDR($data['to']);

        if ($data['t11'] > 0) {
            if ($AtInf['id'] == $def['owner'] && $def['oasistype'] == 0 && $data['add'] == 1) {
                $data['t11']-=1;

                $database->modifyUnit($data['to'], array(11), array(1), 1,"Hero returning");
                $database->modifyHeroByOwner("wref", $data['to'], $AtInf['id'], 0);
            }
        }
        if ($def['oasistype'] > 0) {
            $def['vname'] = 'REP_С30';
        }

        for ($i = 1; $i <= 11; $i++) {
            $totalR+=$data['t' . $i];
        }
        if ($totalR > 0) {
            $check = $database->getEnforceId($data['to'], $data['from']);
            if (!isset($check['id'])) {
                $database->addEnforce($data);
            } else {

                $database->modifyEnforce($check['id'], array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11), array($data['t1'], $data['t2'], $data['t3'], $data['t4'], $data['t5'], $data['t6'], $data['t7'], $data['t8'], $data['t9'], $data['t10'], $data['t11']), 1);
            }
        }
        //reports for reinforcements 
        $AtInf['vname'] = preg_replace("/[,]/", "", $AtInf['vname']);
        if(empty($AtInf['vname'])){$AtInf['vname'] = "Oasis";}
        $topic = "REP_С29 " . $def['vname'];
        //send rapport
        $unitssend_att = '' . $data['t1'] . ',' . $data['t2'] . ',' . $data['t3'] . ',' . $data['t4'] . ',' . $data['t5'] . ',' . $data['t6'] . ',' . $data['t7'] . ',' . $data['t8'] . ',' . $data['t9'] . ',' . $data['t10'] . ',' . $data['t11'] . '';
        $data_fail = $AtInf['id'] . ',' . $AtInf['username'] . ',' . $data['from'] . ',' . $AtInf['vname'] . ',' . $AtInf['id'] . ',' . $AtInf['username'] . ',' . $AtInf['tribe'] . ',' . $unitssend_att . '';
        $data_fail .=',' . $data['to'] . ',' . $def['vname'] . ',' . $def['id'] . ',' . $def['username'];
        $database->addNotice($AtInf['id'], $data['from'], 0, 8, $data_fail, $data['endtime'], $topic);
        
        if ($AtInf['id'] != $def['owner'] && $def['owner'] > 3) {
            $topic = "REP_С28 " . $AtInf['vname'];
            
            $database->addNotice($def['owner'], $data['to'], 0, 8, $data_fail, $data['endtime'], $topic);
        }
        return true;
    }

    private $data = array();
    private $att = array();
    private $def = array();
    private $units = array();
    private $build = array();
    private $en = array();
    private $art = array();
    private $bonusR = array();
    private $heroa = array('speedb' => 1, 'health' => 0, 'u1' => 0, 'u2' => 0, 'u3' => 0, 'u4' => 0, 'u5' => 0, 'u6' => 0, 'u7' => 0, 'u8' => 0, 'back' => 1, 'own' => 1, 'ally' => 1, 'plunder' => 1, 'natarf' => 1, 'mhealth' => 0,
        'exp' => 1, 'culture' => 0, 'barrack' => 1, 'stable' => 1);
    private $herod = array('speedb' => 1, 'health' => 0, 'u1' => 0, 'u2' => 0, 'u3' => 0, 'u4' => 0, 'u5' => 0, 'u6' => 0, 'u7' => 0, 'u8' => 0, 'back' => 1, 'own' => 1, 'ally' => 1, 'plunder' => 1, 'natarf' => 1, 'mhealth' => 0,
        'exp' => 1, 'culture' => 0, 'barrack' => 1, 'stable' => 1);

    function traiCom(){
        global $database,$hero_model;
        $trainings = $database->getAllTrainings();
        if (count($trainings) > 0) {
            foreach($trainings as $training){
                $database->trainingComplete($training['vref']);
            }
        }
    }
        
    function attCom($id) {
        global $bid23, $database;

        $q = "SELECT * FROM movement as m INNER JOIN  attacks as a ON
a.id = m.ref
WHERE
m.proc = '0' and
m.ref='" . $id . "' and m.sort_type='3'";// and m.endtime<=" . time()
        $data = $database->query($q);
        if (!count($data)) {
            $this->DelTrash($id, 1);
            return true;
        }

        $this->data = $data[0];
        $database->setMovementProc($this->data['moveid']);
        $this->att = $database->getUserInfoByVID($this->data['from']);
        $this->def = $database->getUserInfoByVIDD($this->data['to']);

        //attack on Nature`s oasis
        if ($this->def['oasistype'] && $this->def['owner'] == 2) {

            require_once __DIR__ . '/DailyQuest.php';

            $dailyQuest = new DailyQuest($this->att['owner']);

            $dailyQuest->incrementQuest(QUEST_RAID_OASIS);

            unset($dailyQuest);
        }

        //attack on other players oasis
        if (!$this->def['oasistype'] && $this->def['owner'] && $this->def['owner'] == 3) {

            require_once __DIR__ . '/DailyQuest.php';

            $dailyQuest = new DailyQuest($this->att['owner']);

            $dailyQuest->incrementQuest(QUEST_RAID_ATTACK_NATARS);

            unset($dailyQuest);
        }

        if (!$this->def['oasistype'] && !$this->def['owner'] || $database->Winnerkills() || !$this->def['occupied'] && !$this->def['oasistype']) {
            $this->sendBack();
            return false;
        }


        $heroall = $rams = $rand = $crannycap = $rplevel = $ref2 = $tokill = $unum = $destroy_vil = $unitwas = $totaltraped_att = $minusart = $attplus = $defminus = $totalsend_att = $cranny_eff = $cranny = $attxp = $stonemason = $walllevel = $brewery = $totaldead_att = $scout = $totaldead_alldef = $catapult_num = $xpfixed = $totalsend_alldef = $dead1 = $dead2 = $dead3 = $dead4 = $dead5 = $dead6 = $dead7 = $dead8 = $dead9 = $dead10 = $nochiefing = $xp = $residence = $dead11 = $dvil = $heroxp = $cranny = $chiefing_village = $deadh = $bintused = 0;

        $Defender = $Attacker = $deadheros = $tribes = $unittokill = $deadr = $enforceowner = $dead = $speeds = $unitarray = $unitssend_def = $unitsdead_def = $revive = $defbandages = array();
        $info_spy = $info_hero = $unitssend_att = $unitsdead_att = $info_cat = $info_chief = $info_ram = $info_cat2 = $toq = $trap_info = $unitsdead_att_t = '';

        $Nikolas = $bint = false;

        //setup unit arrays
        for ($i = 1; $i <= MAX_UNIT; $i++) {
            $Defender['u' . $i] = 0;
            $dead[$i] = 0;
            global ${'u' . $i};
        }
        for ($i = 1; $i <= MAX_TRIBE; $i++) {
            $Defender['hero'][$i] = $tribes[$i] = $deadheros[$i] = 0;
            $unitssend_def[$i] = $unitsdead_def[$i] = "";
        }

        $tribes[$this->def['tribe']] = 1;
        $this->en = $database->getEnforcementsWithUpgradeData($this->data['to']);
        if ($this->data['attack_type'] == 1) {
            $scout = 1;
        }

        //add reinforcements present in def village + count inventory bonus
        if (count($this->en)) {
            foreach ($this->en as $enforce) {

                if ($enforce['u11'] > 0 && $enforce['owner'] != 2) {
                    $enforceinv = $database->getHeroInventory($enforce['owner']);
                    $bandagesE[$enforce['from']] = $database->getItemData($enforceinv['bag']);
                    $this->bonusR[$enforce['from']] = $database->allHeroBonuses($enforceinv);
                } else {
                    $this->bonusR[$enforce['from']] = array('speedb' => 1, 'health' => 0, 'u1' => 0, 'u2' => 0, 'u3' => 0, 'u4' => 0, 'u5' => 0, 'u6' => 0, 'u7' => 0, 'u8' => 0, 'u9' => 0, 'u10' => 0, 'back' => 1, 'own' => 1, 'ally' => 1, 'plunder' => 1, 'natarf' => 1, 'mhealth' => 0,
                        'exp' => 1, 'culture' => 0, 'barrack' => 1, 'stable' => 1);
                }
                $tribe = $enforce['tribe'];
                if($tribe == null)$tribe = 4;
                $un = ($tribe - 1) * 10;

                for ($i = 1; $i <= 10; $i++) {
                    $Defender['u' . ($un + $i)] += $enforce['u' . $i];
                }
                if (isset($enforce['u11'])) {
                    $Defender['hero'][$tribe]+=$enforce['u11'];
                    $heroall+=$enforce['u11'];
                }
                $tribes[$tribe] = 1;
                $totalsend_alldef+=$enforce['u' . $i];
            }
        }


        if (!$this->def['oasistype']) {
            $this->art = $database->getArteInf($this->data['to']);
            $dvil = $database->getProfileVillages($this->def['owner']);
            $this->build = $database->getResourceLevel($this->data['to']);
            $database->trainingComplete($this->data['to']);
            $wallid = $this->build['f40t'];
            $walllevel = $this->build['f40'];
            $wallbonus = 0;
            if($wallid!=0){
                global ${'bid'.$wallid};
                $wallbonus = ${'bid'.$wallid}[$this->build['f40']]['attri'];
            }
            $reside = $database->getTypeLevel(25, $this->data['to'], $this->build);
            $palac = $database->getTypeLevel(26, $this->data['to'], $this->build);
            $commandcenter = $database->getTypeLevel(44, $this->data['to'], $this->build);
            $stonemason = $database->getTypeLevel(34, $this->data['to'], $this->build);
            $residence = ($reside == 0) ? (($palac == 0) ? ($commandcenter==0)?0:$commandcenter : $palac) : $reside;
            $br_tm = explode(",", $this->att['brewery']);
            if ($this->att['tribe'] == 2 && $br_tm[0] >= $this->data['endtime']) {
                $brewery = $br_tm[1];
            }
            $database->starvationReinf($database->getVillage($this->data['to']));
        } else {
            $this->def['pop'] = 500;
            $this->def['vname'] = "REP_С45";
            if ($this->def['oasistype'] == 88) {
                $this->build = $database->getResourceLevel($this->data['to']);
            }
        }
        
        //if evasion is on then move def units out
        $this->def['vname'] = preg_replace("/[,]/", "", $this->def['vname']);
        $this->att['vname'] = preg_replace("/[,]/", "", $this->att['vname']);
        $this->units = $database->getUnit($this->data['to']);
        if ($this->def['capital'] == 1 && $this->def['evasion'] == 1 && $database->getTypeLevel(16, $this->data['to'], $this->build) > 0 && !$scout) {
            // && $this->def['evasiontime'] <= $this->data['endtime'] + 10
            if($this->units['u1']+$this->units['u2']+$this->units['u3']+$this->units['u4']+$this->units['u5']+$this->units['u6']+$this->units['u7']+$this->units['u8']+$this->units['u9']+$this->units['u10']>0){
                $ref = $database->addAttack($this->data['to'], $this->units['u1'], $this->units['u2'], $this->units['u3'], $this->units['u4'], $this->units['u5'], $this->units['u6'], $this->units['u7'], $this->units['u8'], $this->units['u9'], $this->units['u10'], $this->units['u11'], 88, 0, 0, 0, 0);
                $database->modifyUnit(
                        $this->data['to'], array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11), array($this->units['u1'], $this->units['u2'], $this->units['u3'], $this->units['u4'], $this->units['u5'], $this->units['u6'], $this->units['u7'], $this->units['u8'], $this->units['u9'], $this->units['u10'], $this->units['u11']), 0
                ,"Units evading an incomming attack...");
                $database->addMovement(4, $this->data['to'], $this->data['to'], $ref, $this->data['endtime'], ($this->data['endtime'] + 180));
                $database->insertQueue($ref, 2, $this->data['endtime'], ($this->data['endtime'] + 180));                
            }
            $this->units['u1'] = $this->units['u2'] = $this->units['u3'] = $this->units['u4'] = $this->units['u5'] = $this->units['u6'] = $this->units['u7'] = $this->units['u8'] = $this->units['u9'] = $this->units['u10'] = $this->units['u11'] = 0;
            
            addToLog("general","Evasion triggered for village ".$this->data['to']);
        }else{
            if($this->def['capital'] == 1 && $this->def['evasion'] == 0){
                addToLog("general","Evasion is off in village ".$this->data['to']);
            }
            else if($this->def['capital'] == 0 && $this->def['evasion'] == 1){
                addToLog("general","Village is not capital ".$this->data['to']);
            }
            if($database->getTypeLevel(16, $this->data['to'], $this->build)==0){
                addToLog("general","Village has no RP ".$this->data['to']);
            }
            if ($this->def['capital'] == 1 && $this->def['evasion'] == 1 && $database->getTypeLevel(16, $this->data['to'], $this->build) > 0){
                addToLog("general","Just scouting");
            }
        }
        //hide hero
        $heroif = $database->getHeroData($this->def['owner']); //прячем героя
        if ($heroif['hide']) {
            $this->units['u11'] = 0;
        }

        //count attack hero bonus
        $Defender['hero'][$this->def['tribe']]+=$this->units['u11'];
        for ($i = 1; $i <= 10; $i++) {
            $Defender['u' . ((($this->def['tribe'] - 1) * 10) + $i)] += $this->units['u' . $i];
        }
        $heroall+=$this->units['u11'];
        if ($this->data['t11']) {
            $attinv = $database->getHeroInventory($this->att['owner']);
            $NikolasCages = $database->getItemData($attinv['bag']);
            if ($NikolasCages['btype'] == 9 && $NikolasCages['type'] > 0) {
                $Nikolas = true;
            }
            if (($NikolasCages['btype'] == 8 || $NikolasCages['btype'] == 7) && $NikolasCages['type'] > 0) {
                $bint = true;
            }
            $this->heroa = $database->allHeroBonuses($attinv);
        }
        
        if (!($Nikolas && $this->def['oasistype'])) {
            if ($this->units['u11']) {
                //add def hero bonus
                $definv = $database->getHeroInventory($this->def['owner']);
                $defbandages = $database->getItemData($definv['bag']);
                $this->herod = $database->allHeroBonuses($definv);
            }
            //setup attack troops
            $trappable_attackers = 0;
            $initial_groups = 6;
            $attackers = array();
            for ($i = 1; $i <= 11; $i++) {
                $unitsdead_att_t.=$i != 11 ? "0," : 0;
                $totalsend_att+=$this->data['t' . $i];
                $unitssend_att.=$i == 11 ? $this->data['t' . $i] : $this->data['t' . $i] . ",";
                if($i < 7){
                    $trappable_attackers+=$this->data['t' . $i];
                    if($this->data['t' . $i] <= 0){
                        $initial_groups--;
                    }
                }
                //$attackers['t' . $i] = $this->data['t' . $i];
                ${'traped' . $i} = 0;
            }
            //engage traps if gauls
            if (!$scout && $this->def['tribe'] == 3) {
                
                $retries = 0;
                $traps = $this->units['u99'] - $this->units['o99'];
                $max_trap_by_group = floor($traps / max(1,$initial_groups));
                $additional_traps = 0;
                $retries = 0;
                $groups = $initial_groups;
                
                for ($i = 1; $i <= 6; $i++) {
                    $trapped = 0;
                    $max_trap = $max_trap_by_group + $additional_traps;
                    
                    //no more traps - break off
                    if($traps<=0){
                        break;
                    }
                    //are there troops?
                    if($this->data['t' . $i] > 0){
                        //is the group by traps higher than available trap number?
                        if($max_trap >= $traps && $this->data['t' . $i] >= $max_trap){
                            $trapped = $traps;
                        }
                        //are there less soldiers than trap by group?
                        else if($max_trap >= $this->data['t' . $i]){
                            //trapp all
                            $trapped = $this->data['t' . $i];
                        }else{
                            //trap as much as possible
                            $trapped = $max_trap;
                        }
                        
                        ${'traped' . $i} += $trapped;
                        $traps -= $trapped;
                        $this->data['t' . $i] -= $trapped;
                        $trappable_attackers -= $trapped;
                        $database->modifyTraps($this->data['to'], $trapped, 0);
                        $totaltraped_att+= $trapped;
                    }else{
                        $groups--;
                    }
                    
                    //in case we still have traps and not all catchable troops are cought - retry
                    if($i==6 && $traps>0 && $trappable_attackers>0 && $retries<=3){
                        $i=0;
                        $retries++;
                        $max_trap_by_group = floor($traps / max(1,$groups));
                        $groups = $initial_groups;
                    }
                }
                //report data
                for ($i = 1; $i <= 11; $i++) {                
                    $trap_info.=${'traped' . $i} . ',';
                }
                

                if ($totaltraped_att > 0) {
                    $prisoners2 = $database->getPrisoners2($this->data['to'], $this->data['from']);
                    if (!count($prisoners2)) {
                        $database->addPrisoners($this->data['to'], $this->data['from'], $traped1, $traped2, $traped3, $traped4, $traped5, $traped6, $traped7, $traped8, $traped9, $traped10, $traped11);
                    } else {
                        $database->updatePrisoners($this->data['to'], $this->data['from'], $traped1, $traped2, $traped3, $traped4, $traped5, $traped6, $traped7, $traped8, $traped9, $traped10, $traped11);
                    }
                }
            }
            
            $battlepart = $this->calculateBattle($residence, $stonemason, $walllevel,$wallbonus, $brewery);
            //$this->addToFileLog(print_r($battlepart,true));       
        
            for ($i = 1; $i <= 11; $i++) {
                ${'dead' . $i} = $battlepart['casualties_attacker'][$i];
                $totaldead_att += ${'dead' . $i};
                $unitsdead_att.=$i != 11 ? ${'dead' . $i} . "," : ${'dead' . $i};
                if (${'dead' . $i} > 0 && $i != 11) {
                    $unum++;
                }
            }

//перенес на послесмертие
            //when all troops are trapped
            if ($totalsend_att - $totaltraped_att <= 0) {
                $n = 1;
                $t = 10;
                for ($i = 1; $i <= MAX_UNIT; $i++) {

                    if ($i > $t) {
                        $n+=1;
                        $t+=10;
                    }
                    $coef = $i / 10;
                    $unitssend_def[$n].=is_integer($coef) ? $Defender['u' . $i] : $Defender['u' . $i] . ","; //было
                    $unitsdead_def[$n].=is_integer($coef) ? $dead[$i] : $dead[$i] . ","; //убито
                    $heroxp += $dead[$i] * ${'u' . $i}['pop']; //бочкиубдеф
                    $totaldead_alldef += $dead[$i];
                    $totalsend_alldef+= $Defender['u' . $i];
                }
                $topic = $this->att['vname'] . " REP_С27 " . $this->def['vname'];
                $data_fail = '' . $this->att['owner'] . ',' . $this->att['username'] . ',' . $this->data['from'] . ',' . $this->att['vname'] . ',' . $this->att['tribe'] . ',' . $unitssend_att . ',' . $unitsdead_att_t . ',' . $this->def['owner'] . ',' . $this->def['username'] . ',' . $this->data['to'] . ',' . $this->def['vname'] . ',' . $this->def['tribe'] . ',' . $info_ram . ',' . $info_cat . ',' . $info_cat2 . ',' . $info_hero;
                
                $database->addNotice($this->att['owner'], $this->data['to'], $this->att['alliance'], 3, $data_fail, $this->data['endtime'], $topic, $trap_info);
                $data2 = $this->att['owner'] . ',' . $this->att['username'] . ',' . $this->data['from'] . ',' . $this->att['vname'] . ',' . $this->att['tribe'] . ',' . $unitssend_att . ',' . $unitsdead_att . ',0,0,0,0,0,' . $info_ram . ',' . $info_cat . ',' . $info_cat2 . ',' . $info_chief . ',' . $info_hero . ',' . $this->def['owner'] . ',' . $this->def['username'] . ',' . $this->data['to'] . ',' . $this->def['vname'] . ',' . $this->def['tribe'] . ',' . $tribes[1] . ',' . $unitssend_def[1] . ',' . $Defender['hero'][1] . ',' . $unitsdead_def[1] . ',' . $deadheros[1] . ',' . $tribes[2] . ',' . $unitssend_def[2] . ',' . $Defender['hero'][2] . ',' . $unitsdead_def[2] . ',' . $deadheros[2] . ',' . $tribes[3] . ',' . $unitssend_def[3] . ',' . $Defender['hero'][3] . ',' . $unitsdead_def[3] . ',' . $deadheros[3] . ',' . $tribes[4] . ',' . $unitssend_def[4] . ',' . $Defender['hero'][4] . ',' . $unitsdead_def[4] . ',' . $deadheros[4] . ',' . $tribes[5] . ',' . $unitssend_def[5] . ',' . $Defender['hero'][5] . ',' . $unitsdead_def[5] . ',' . $deadheros[5] . ',' . $tribes[6] . ',' . $unitssend_def[6] . ',' . $Defender['hero'][6] . ',' . $unitsdead_def[6] . ',' . $deadheros[6];

                if ($totalsend_alldef == 0) {
                    $ref2 = 7;
                } else if ($totaldead_alldef == 0) {
                    $ref2 = 4;
                } else if ($totalsend_alldef > $totaldead_alldef) {
                    $ref2 = 5;
                } else if ($totalsend_alldef == $totaldead_alldef || $totalsend_alldef < $totaldead_alldef) {
                    $ref2 = 6;
                }
               
                $database->addNotice($this->def['owner'], $this->data['to'], $this->def['alliance'], $ref2, $data2, $this->data['endtime'], $topic, $trap_info);



                return true;
            }




            if ($bint) {
                if ($NikolasCages['btype'] == 7) {
                    $binttyped = 0.25;
                } else {
                    $binttyped = 0.33;
                }
                $maxbints = $NikolasCages['type'] * ((SPEED / 10)+1);

                if ($maxbints < $totaldead_att) {
                    $unitwk = $maxbints; //unit was killed
                } else {
                    $unitwk = $totaldead_att;
                }
                $maxtohill = $unitwk / $totalsend_att; //скок % убито
                $reviveall = false;
                if ($maxtohill > $binttyped) {
                    $maxtohill = $binttyped;
                } elseif ($maxbints >= $totaldead_att) {
                    $reviveall = true;
                }

                $speeds = array();

                for ($i = 1; $i <= 10; $i++) {
                    $revive[$i] = 0;
                    if (${'dead' . $i} > 0) {
                        if (!$reviveall) {
                            $maxnow = floor($this->data['t' . $i] * $maxtohill);
                            if ($maxnow >= ${'dead' . $i}) {
                                $maxnow = ${'dead' . $i};
                            }
                        } else {
                            $maxnow = ${'dead' . $i};
                        }
                        $revive[$i] = $maxnow;
                        $bintused+=$revive[$i];
                        global ${"u" . (($this->att['tribe'] - 1) * 10 + $i)};
                        $speeds[] = ${"u" . (($this->att['tribe'] - 1) * 10 + $i)}['speed'];
                    }
                }
                if ($bintused > 0) {
                    $bintused = ceil($bintused / ((SPEED / 10)+1));

                    $newtype0 = $NikolasCages['type'] - $bintused;
                    $newnum0 = $NikolasCages['num'] - $bintused;
                    if ($newtype0 < 0) {
                        $newtype0 = 0;
                    }
                    $database->editHeroType($NikolasCages['id'], $newtype0, 2); //убираем использованные клетки
                    $database->editHeroNum2($NikolasCages['id'], $bintused);
                    if ($newtype0 == 0) {
                        $database->setHeroInventory($this->att['owner'], "bag", 0);
                        $database->editProcItem($NikolasCages['id'], 0, $this->att['owner']);
                    }
                    if (!$newnum0 && !$newtype0) {
                        $q = "DELETE FROM heroitems where id = '" . $NikolasCages['id'] . "'";
                        $database->query($q);
                    }
                    $fromCor = array('x' => $this->def['x'], 'y' => $this->def['y']);
                    $toCor = array('x' => $this->att['vx'], 'y' => $this->att['vy']);
                    $endt = round($database->procDistanceTime($fromCor, $toCor, min($speeds), 1, $this->data['from']));
                    $ref = $database->addAttack($this->data['to'], $revive['1'], $revive['2'], $revive['3'], $revive['4'], $revive['5'], $revive['6'], $revive['7'], $revive['8'], $revive['9'], $revive['10'], 0, 2, 0, 0, 0, 0);
                    $database->addMovement(4, $this->data['to'], $this->data['from'], $ref, $this->data['endtime'], ($this->data['endtime'] + $endt));
                    $database->insertQueue($ref, 2, $this->data['endtime'], ($this->data['endtime'] + $endt));
                }
            }

//kill own defence


            for ($i = 1; $i <= 10; $i++) {
                $unitbat = round($battlepart[2] * $this->units['u' . $i]);
                $unitwas+=$this->units['u' . $i];
                if ($unitbat > $this->units['u' . $i]) {
                    $unitbat = $this->units['u' . $i];
                }
                $dead[(($this->def['tribe'] - 1) * 10 + $i)]+=$unitbat;
                $unittokill['u' . $i] = $unitbat;
                $tokill+=$unitbat;
            }

            if ($this->units['u11'] > 0 && count($defbandages) > 0 && $defbandages['type'] > 0 && $unitwas > 0 && $tokill > 0 && ($defbandages['btype'] == 7 || $defbandages['btype'] == 8)) {
                $bintused = 0;
                if ($defbandages['btype'] == 7) {
                    $binttyped = 0.25;
                } else {
                    $binttyped = 0.33;
                }
                $maxbints = $defbandages['type'] * ((SPEED / 10)+1);
                if ($maxbints < $tokill) {
                    $unitwk = $maxbints; //unit was killed
                } else {
                    $unitwk = $tokill;
                }
                $maxtohill = $unitwk / $unitwas; //скок % убито
                $reviveall = false;
                if ($maxtohill > $binttyped) {
                    $maxtohill = $binttyped;
                } elseif ($maxbints >= $tokill) {
                    $reviveall = true;
                }
                $speeds = array();

                for ($i = 1; $i <= 10; $i++) {
                    $revive[$i] = 0;
                    if ($unittokill['u' . $i] > 0) {

                        if (!$reviveall) {
                            $maxnow = floor($this->units['u' . $i] * $maxtohill);
                            if ($maxnow >= $unittokill['u' . $i]) {
                                $maxnow = $unittokill['u' . $i];
                            }
                        } else {
                            $maxnow = $unittokill['u' . $i];
                        }
                        $revive[$i] = $maxnow;
                        $bintused+=$revive[$i];
                        global ${"u" . (($this->def['tribe'] - 1) * 10 + $i)};
                        $speeds[] = ${"u" . (($this->def['tribe'] - 1) * 10 + $i)}['speed'];
                    }
                }
                if ($bintused > 0) {
                    $bintused = ceil($bintused / ((SPEED / 10)+1));
                    $newtype0 = $defbandages['type'] - $bintused;
                    $newnum0 = $defbandages['num'] - $bintused;
                    if ($newtype0 < 0) {
                        $newtype0 = 0;
                    }
                    $database->editHeroType($defbandages['id'], $newtype0, 2); //убираем использованные бинты
                    $database->editHeroNum2($defbandages['id'], $bintused);
                    if ($newtype0 == 0) {
                        $database->setHeroInventory($this->def['owner'], "bag", 0);
                        $database->editProcItem($defbandages['id'], 0, $this->def['owner']);
                    }
                    if (!$newnum0 && !$newtype0) {
                        $q = "DELETE FROM heroitems where id = '" . $defbandages['id'] . "'";
                        $database->query($q);
                    }
                    $fromCor = array('x' => $this->def['x'], 'y' => $this->def['y']);
                    $toCor = array('x' => $this->att['vx'], 'y' => $this->att['vy']);
                    $endt = round($database->procDistanceTime($fromCor, $toCor, min($speeds), 1, $this->data['from']));
                    $ref = $database->addAttack($this->data['to'], $revive['1'], $revive['2'], $revive['3'], $revive['4'], $revive['5'], $revive['6'], $revive['7'], $revive['8'], $revive['9'], $revive['10'], 0, 2, 0, 0, 0, 0);
                    //а тут типо от атакера возвращаемся
                    $database->addMovement(4, $this->data['from'], $this->data['to'], $ref, $this->data['endtime'], ($this->data['endtime'] + $endt));
                    $database->insertQueue($ref, 2, $this->data['endtime'], ($this->data['endtime'] + $endt));
                }
            }

            $deadheros[$this->def['tribe']]+=$battlepart['deadherodef'];
            $tokill+=$battlepart['deadherodef'];
            if ($tokill) {
                $database->modifyUnit($this->data['to'], array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11), array($unittokill['u1'], $unittokill['u2'], $unittokill['u3'], $unittokill['u4'], $unittokill['u5'], $unittokill['u6'], $unittokill['u7'], $unittokill['u8'], $unittokill['u9'], $unittokill['u10'], $battlepart['deadherodef']), 0, "Units dying off");
            }


//kill other defence in village

            if (count($this->en)) {
                foreach ($this->en as $enforce) {
                    $tribe = $enforce['tribe'];
                    if($tribe == null)$tribe = 4;
                    $life = $notlife = '';
                    $life1 = $notlife1 = $bintused = 0;
                    for ($i = 1; $i <= 10; $i++) {
                        $units = round($battlepart[2] * $enforce['u' . $i]);
                        if ($units > $enforce['u' . $i]) {
                            $units = $enforce['u' . $i];
                        }
                        $dead[(($tribe - 1) * 10 + $i)]+=$units;
                        $deadr[$i] = $units;
                        $life1+=$enforce['u' . $i];
                        $notlife1+=$units;
                        $life.=$enforce['u' . $i] . ",";
                        $notlife.=$units . ",";
                    }

                    if ($enforce['u11'] > 0 && count($bandagesE[$enforce['from']]) > 0 && $bandagesE[$enforce['from']]['type'] > 0 && $notlife1 > 0 && $life1 > 0 && ($bandagesE[$enforce['from']]['btype'] == 7 || $bandagesE[$enforce['from']]['btype'] == 8)) {
                        if ($bandagesE[$enforce['from']]['btype'] == 7) {
                            $binttyped = 0.25;
                        } else {
                            $binttyped = 0.33;
                        }
                        $maxbints = $bandagesE[$enforce['from']]['type'] * ((SPEED / 10)+1);

                        if ($maxbints < $notlife1) {
                            $unitwk = $maxbints; //unit was killed
                        } else {
                            $unitwk = $notlife1;
                        }
                        $maxtohill = $unitwk / $life1; //скок % убито
                        $reviveall = false;
                        if ($maxtohill > $binttyped) {
                            $maxtohill = $binttyped;
                        } elseif ($maxbints >= $notlife1) {
                            $reviveall = true;
                        }

                        $speeds = array();

                        for ($i = 1; $i <= 10; $i++) {
                            $revive[$i] = 0;
                            if ($deadr[$i] > 0) {
                                if (!$reviveall) {
                                    $maxnow = floor($enforce['u' . $i] * $maxtohill);
                                    if ($maxnow >= $deadr[$i]) {
                                        $maxnow = $deadr[$i];
                                    }
                                } else {
                                    $maxnow = $deadr[$i];
                                }
                                $revive[$i] = $maxnow;
                                $bintused+=$revive[$i];
                                global ${"u" . (($tribe - 1) * 10 + $i)};
                                $speeds[] = ${"u" . (($tribe - 1) * 10 + $i)}['speed'];
                            }
                        }

                        if ($bintused > 0) {
                            $bintused = ceil($bintused / ((SPEED / 10)+1));

                            $newtype0 = $bandagesE[$enforce['from']]['type'] - $bintused;
                            $newnum0 = $bandagesE[$enforce['from']]['num'] - $bintused;
                            if ($newtype0 < 0) {
                                $newtype0 = 0;
                            }
                            $database->editHeroType($bandagesE[$enforce['from']]['id'], $newtype0, 2); //убираем использованные бинты
                            $database->editHeroNum2($bandagesE[$enforce['from']]['id'], $bintused);
                            if ($newtype0 == 0) {
                                $database->setHeroInventory($enforce['owner'], "bag", 0);
                                $database->editProcItem($bandagesE[$enforce['from']]['id'], 0, $enforce['owner']);
                            }
                            if (!$newnum0 && !$newtype0) {
                                $q = "DELETE FROM heroitems where id = '" . $bandagesE[$enforce['from']]['id'] . "'";
                                $database->query($q);
                            }
                            $fromCor = array('x' => $this->def['x'], 'y' => $this->def['y']);
                            $toCor = $database->getCoor($enforce['from']);
                            $endt = round($database->procDistanceTime($fromCor, $toCor, min($speeds), 1, $this->data['from']));
                            $ref = $database->addAttack($this->data['to'], $revive['1'], $revive['2'], $revive['3'], $revive['4'], $revive['5'], $revive['6'], $revive['7'], $revive['8'], $revive['9'], $revive['10'], 0, 2, 0, 0, 0, 0);
                            //а тут типо от атакера возвращаемся
                            $database->addMovement(4, $this->data['to'], $enforce['from'], $ref, $this->data['endtime'], ($this->data['endtime'] + $endt));
                            $database->insertQueue($ref, 2, $this->data['endtime'], ($this->data['endtime'] + $endt));
                        }
                    }

                    if ($notlife1) {
                        $database->modifyEnforce($enforce['id'], array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10), array($deadr['1'], $deadr['2'], $deadr['3'], $deadr['4'], $deadr['5'], $deadr['6'], $deadr['7'], $deadr['8'], $deadr['9'], $deadr['10']), 0);
                    }
                    if ($enforce['u11'] > 0) {
                        $enforceowner[]+= $enforce['owner'];


                        $database->modifyEnforce($enforce['id'], array(11), array($battlepart['deadheroref'][$enforce['id']]), 0);
                        $deadh = $battlepart['deadheroref'][$enforce['id']];
                        $deadheros[$tribe]+=$battlepart['deadheroref'][$enforce['id']];
                    }
                    $life.=$enforce['u11'] . ",";
                    $notlife.=$deadh . ",";
                    $life1+=$enforce['u11'];
                    $notlife1+=$deadh;


                    $data2 = $enforce['owner'] . ',' . $enforce['username'] . ',' . $this->data['to'] . ',' . $this->def['vname'] . ',' . $tribe . ',' . $life . ',' . $notlife . '';
                    $topic = "REP_С26 " . $this->def['vname'];
                    if (!$scout || $enforce['owner'] == $this->att['owner'] && $this->def['owner'] == $this->att['owner']) {
                        if ($notlife1 == 0) {
                            
                           $database->addNotice($enforce['owner'], $this->data['from'], $this->att['alliance'], 25, $data2, $this->data['endtime'], $topic);
                        } else
                        if ($life1 > $notlife1) {
                            
                            $database->addNotice($enforce['owner'], $this->data['from'], $this->att['alliance'], 26, $data2, $this->data['endtime'], $topic);
                        } else {
                            
                            $database->addNotice($enforce['owner'], $this->data['from'], $this->att['alliance'], 27, $data2, $this->data['endtime'], $topic);
                        }

                        $database->checkReinf($enforce['id']);
                    }
                }
            }


            $n = 1;
            $t = 10;
            for ($i = 1; $i <= MAX_UNIT; $i++) {

                if ($i > $t) {
                    $n+=1;
                    $t+=10;
                }
                $coef = $i / 10;
                $unitssend_def[$n].=is_integer($coef) ? $Defender['u' . $i] : $Defender['u' . $i] . ","; //было
                $unitsdead_def[$n].=is_integer($coef) ? $dead[$i] : $dead[$i] . ","; //убито
                $heroxp += $dead[$i] * ${'u' . $i}['pop']; //бочкиубдеф
                $totaldead_alldef += $dead[$i];
                $totalsend_alldef+= $Defender['u' . $i];
            }

            //умножаем опыт на эфф предмета
            $heroxp*=$this->heroa['exp'];
            //предмет*ресо-вместимость войск
            $battlepart['bounty']*=$this->heroa['plunder'];
            if ($totaldead_att + $totaltraped_att > 0) {
                $database->modifyAttack2($this->data['ref'], array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11), array($dead1 + $traped1, $dead2 + $traped2, $dead3 + $traped3, $dead4 + $traped4, $dead5 + $traped5, $dead6 + $traped6, $dead7 + $traped7, $dead8 + $traped8, $dead9 + $traped9, $dead10 + $traped10, $dead11 + $traped11)
                );
            }


//top 10 attack && defence update

            for ($i = 1; $i <= 10; $i++) {
                $attxp += ${'dead' . $i} * ${'u' . (($this->att['tribe'] - 1) * 10 + $i)}['pop'];
            }


            if ($this->data['t11']) {
                $database->modifyHeroXp("experience", $heroxp, $this->att['owner']);
                $database->modifyPoints($this->att['owner'], 'herxp', $heroxp);
            }
            if ($heroall) {
                $xpfixed = round($attxp / $heroall);
                if ($xpfixed < 0) {
                    $xpfixed = 0;
                }
                foreach ($enforceowner as $whoneedxp) {
                    $database->modifyHeroXp("experience", $xpfixed, $whoneedxp);
                }
            }
            if ($this->def['owner'] > 3) {
                if ($this->units['u11']) {
                    $database->modifyHeroXp("experience", ($xpfixed * $this->herod['exp']), $this->def['owner']);
                }
                if ($this->def['alliance']) {
                    $database->modifyPointsAllyd($this->def['alliance'], $attxp);
                }

                $database->modifyPoints($this->def['owner'], 'herxp', $xpfixed);
                $database->modifyPointsdef($this->def['owner'], $attxp);
            }
            if ($this->att['alliance']) {
                $database->modifyPointsAllya($this->att['alliance'], $heroxp);
            }

            $database->modifyPointsatt($this->att['owner'], $heroxp);


            if (!$this->def['oasistype']) {

                $crannyart = $database->checkArtefactsEffects($this->att['owner'], $this->data['from'], 7);
                for ($i = 19; $i < 39; $i++) {
                    if ($this->build['f' . $i . 't'] == 23) {
                        $cranny += ($bid23[$this->build['f' . $i . '']]['attri'] * CRANNY_CAP);
                    }
                }
                $cranny=round($cranny*$crannyart);
//cranny efficiency
                $atk_bonus = ($this->att['tribe'] == 2) ? (4 / 5) : 1;
                $def_bonus = ($this->def['tribe'] == 3) ? 2 : 1;
                $cranny_eff = (($cranny * $atk_bonus) * $def_bonus);
// work out available resources.
                $bountyres = $database->query("SELECT wood,clay,iron,crop,maxstore,maxcrop from vdata where wref = '" . $this->data['to'] . "'");
                $totwood = $bountyres[0]['wood'];
                $totclay = $bountyres[0]['clay'];
                $totiron = $bountyres[0]['iron'];
                $totcrop = $bountyres[0]['crop'];
                $totcrop = $totcrop < 0 ? 0 : $totcrop;
            } else {
// work out available resources.
                $database->bountyprocessOProduction($this->data['to']);
                $allres = $database->getResOasisField($this->data['to']);
                $totwood = $allres['wood'];
                $totclay = $allres['clay'];
                $totiron = $allres['iron'];
                $totcrop = $allres['crop'];
            }
            $avclay = $totclay - $cranny_eff;
            $aviron = $totiron - $cranny_eff;
            $avwood = $totwood - $cranny_eff;
            $avcrop = $totcrop - $cranny_eff;
            $avclay = ($avclay < 0) ? 0 : $avclay;
            $aviron = ($aviron < 0) ? 0 : $aviron;
            $avwood = ($avwood < 0) ? 0 : $avwood;
            $avcrop = ($avcrop < 0) ? 0 : $avcrop;
            $avtotal = array($avwood, $avclay, $aviron, $avcrop);

// resources (wood,clay,iron,crop)
            $steal = array(0, 0, 0, 0);
//bounty variables

            $btotal = $battlepart['bounty'];
            $bmod = 0;
            for ($i = 0; $i < 5; $i++) {
                for ($j = 0; $j < 4; $j++) {
                    if (isset($avtotal[$j])) {
                        if ($avtotal[$j] < 1)
                            unset($avtotal[$j]);
                    }
                }
                if (!$avtotal) {
// echo 'array empty'; *no resources left to take.
                    break;
                }
                if ($btotal < 1 && $bmod < 1)
                    break;
                if ($btotal < 1) {
                    while ($bmod) {
//random select
                        $rs = array_rand($avtotal);
                        if (isset($avtotal[$rs])) {
                            $avtotal[$rs] -= 1;
                            $steal[$rs] += 1;
                            $bmod -= 1;
                        }
                    }
                }
// handle unballanced amounts.
                $btotal +=$bmod;
                $bmod = $btotal % count($avtotal);
                $btotal -=$bmod;
                $bsplit = $btotal / count($avtotal);
                $max_steal = (min($avtotal) < $bsplit) ? min($avtotal) : $bsplit;
                for ($j = 0; $j < 4; $j++) {
                    if (isset($avtotal[$j])) {
                        $avtotal[$j] -= $max_steal;
                        $steal[$j] += $max_steal;
                        $btotal -= $max_steal;
                    }
                }
            }
            for ($i = 0; $i <= 3; $i++) {
                $steal[$i] = floor($steal[$i]);
            }
            if (!$this->def['oasistype']) {

                $database->modifyResource($this->data['to'], $steal[0], $steal[1], $steal[2], $steal[3], false);
            } else {
                $database->modifyOasisResource($this->data['to'], $steal[0], $steal[1], $steal[2], $steal[3], false);
            }

//find slowest unit.
            $speeds = array();
            for ($i = 1; $i <= 10; $i++) {
                if ($this->data['t' . $i] > ${'dead' . $i}) {
                    global ${"u" . (($this->att['tribe'] - 1) * 10 + $i)};
                    $speeds[] = ${"u" . (($this->att['tribe'] - 1) * 10 + $i)}['speed'];
                }
            }
            if ($this->data['t11'] > ${'dead11'}) {
                $getHero = $database->getHeroData($this->att['owner']);
                $speeds[] = ($this->att['tribe']==7? $getHero['speed']+($getHero['speed']*2/10):$getHero['speed']);
            }
// cat

            if ($this->data['attack_type'] == 3 && (!$this->def['oasistype'] || $this->def['oasistype'] == 88)) {

                if ($this->data['t7']) {
                    if (!$walllevel) {
                        $info_ram = "REP_С25";
                    } else {
                        if ($battlepart['wallafter']<=0) {
                            $info_ram = "REP_С24";
                            $database->DeleteBuldingCata(40, $this->data['to']);
                            $database->setVillageLevelBoth($this->data['to'], 40);
                        } elseif ($battlepart['wallbefore'] == $battlepart['wallafter']) {
                            $info_ram = "REP_С23";
                        } else {
                            if ($database->CheckbuildBeforeUPDATE(40, $this->data['to']) > 0) {
                                $database->UPDATEBuildingCata($battlepart['wallafter'] + 1, 40, $this->data['to'], getWallID($this->def['tribe']));
                            }
                            $info_ram = "REP_С19  <b>" . $battlepart['wallbefore'] . "</b> REP_С8 <b>" . $battlepart['wallafter'] . "</b>. REP_С21";
                            $database->setVillageLevel($this->data['to'], "f40", $battlepart['wallafter']);
                        }
                    }
                }
                $this->build = $database->getResourceLevel($this->data['to']);
                $this->def['pop'] = $database->recountPop($this->data['to'], $this->build);
                if ($this->data['t8']) {

                    if ($this->def['pop'] <= 0 && !$this->def['oasistype']) {
                        $info_cat = "REP_С18";
                    } else {
                        $info_cat = 'Bd_' . $battlepart['tbgid1'] . '_Bd' . $battlepart['info1'];

                        if ($this->data['ctar2'] != 0) {
                            $info_cat2 = 'Bd_' . $battlepart['tbgid2'] . '_Bd' . $battlepart['info2'];
                        }
                    }
                }
                if (($dvil > 1 && !$this->def['oasistype'] && !$this->def['natar'] && !$this->def['pop'] && !count($this->art))) {
                    $destroy_vil = 1;
                }
//chiefing village
//there are senators

                if ($this->data['t9'] - ($dead9 + $traped9) > 0 && !$destroy_vil) {
                    $varray = $database->getVilKol($this->att['owner']);
                    global ${'cp' . CP};

                    if ($this->att['cp'] >= ${'cp' . CP}[$varray + 1] || $this->att['owner'] == $this->def['owner']) {
                        if ($dvil > 1 && !$this->def['capital']) {
                            $reside = $database->getTypeLevel(25, $this->data['to'], $this->build);
                            $palac = $database->getTypeLevel(26, $this->data['to'], $this->build);
                            $commandcenter = $database->getTypeLevel(44, $this->data['to'], $this->build);
                            $residence = ($reside == 0) ? (($palac == 0) ? ($commandcenter==0)?0:$commandcenter : $palac) : $reside;
                            if ($residence > 0) {
                                $nochiefing = 1;
                                $info_chief = "REP_С17";
                            }

                            if (!$nochiefing) {
                                $rand = 0;
                                if (!$brewery) {
                                    if ($this->att['celebration'] == 2) {
                                        $attplus = 5;
                                    }
                                    if ($this->def['celebration'] == 2) {
                                        $defminus = 5;
                                    }
                                    for ($i = 0; $i < ($this->data['t9'] - $dead9); $i++) {
                                        if ($this->att['tribe'] == 1) {
                                            $rand+=rand((20 + $attplus - $defminus), (30 + $attplus - $defminus));
                                        } elseif ($this->att['tribe'] == 7) {
                                            $rand+=rand((10 + $attplus - $defminus), (15 + $attplus - $defminus));
                                        }else {
                                            $rand+=rand((20 + $attplus - $defminus), (25 + $attplus - $defminus));
                                        }
                                    }
                                } else {
                                    for ($i = 0; $i < ($this->data['t9'] - $dead9); $i++) {
                                        $rand+=rand((5 + $attplus - $defminus), (15 + $attplus - $defminus));
                                    }
                                }
//loyalty is more than 0 or has no other villages

                                if ($this->def['loyalty'] - $rand > 0) {
                                    $info_chief = "REP_С42 <b>" . floor($this->def['loyalty']) . "</b> REP_С8 <b>" . floor($this->def['loyalty'] - $rand) . "</b>.";
                                    $database->setVillageField($this->data['to'], 'loyalty', ($this->def['loyalty'] - $rand));
                                } else {
//  you took over the village
                                    $database->UpdateAchievU($this->att['owner'], "`a4`=1");
                                    //ачивка захватчику

                                    $info_chief = "REP_С14 " . $this->def['vname'] . " REP_С15";
                                    if (!empty($this->art)) {
                                        foreach ($this->art as $artifact) {
//                   можно забирать арты у самого себя не теряя их активность.
                                            /*if ($database->getOwnArtNumOwner($this->att['owner']) < 3 || $this->att['owner'] == $this->def['owner']) {// || $artifact['type'] == 11
                                                $database->claimArtefact($this->data['to'], $this->data['to'], $this->att['owner'], 1);
                                            } else {*/
                                                $database->claimArtefact($this->data['to'], $this->data['to'], $this->att['owner'], 0);
                                            //}
                                        }
                                    }

                                    $database->ClaimVillage($this->data['to'], $this->att['owner']);

//  check buildings

                                    if ($this->att['pop'] > $this->def['pop']) {

                                        for ($i = 1; $i <= 39; $i++) {
                                            if ($this->build['f' . $i]) {
                                                $leveldown = $this->build['f' . $i] - 1;
                                                if ($this->build['f' . $i . "t"] != 35 && $this->build['f' . $i . "t"] != 36 && $this->build['f' . $i . "t"] != 41 && $leveldown || $i < 19) {

                                                    $toq.=" f" . $i . "=" . $leveldown . ",";
                                                } elseif ($this->build['f' . $i . 't'] == 35 || $this->build['f' . $i . 't'] == 36 || $this->build['f' . $i . 't'] == 41) {
                                                    $toq.=" f" . $i . "=0,f" . $i . "t=0,";
                                                } else {

                                                    $toq.=" f" . $i . "=" . $leveldown . ",f" . $i . "t=" . $leveldown . ",";
                                                }
                                            }
                                        }
                                        $toq.=" `f40`='0', `f40t`='0'";
                                        $database->query("UPDATE fdata set" . $toq . " WHERE vref='" . $this->data['to'] . "'");
                                        if ($this->build['f99']) {
                                            $leveldown = $this->build['f99'] - 1;
                                            $database->setVillageLevel($this->data['to'], "f99", $leveldown);
                                        }
                                    } else {
                                        for ($i = 19; $i <= 39; $i++) {
                                            if ($this->build['f' . $i]) {

                                                if ($this->build['f' . $i . 't'] == 35 || $this->build['f' . $i . 't'] == 36 || $this->build['f' . $i . 't'] == 41) {
                                                    $toq.=" f" . $i . "=0,f" . $i . "t=0,";
                                                }
                                            }
                                        }
                                        $toq.=" `f40`='0', `f40t`='0'";
                                        $database->query("UPDATE fdata set" . $toq . " WHERE vref='" . $this->data['to'] . "'");
                                    }

                                    $database->clearExpansionSlot($this->data['to']);
                                    $exp = $database->ThreeExp($this->data['from']);

                                    if ($exp['exp1'] == 0) {
                                        $exp = 'exp1';
                                    } elseif ($exp['exp2'] == 0) {
                                        $exp = 'exp2';
                                    } else {
                                        $exp = 'exp3';
                                    }

                                    $database->setVillageField($this->data['from'], $exp, $this->data['to']);
                                    $chiefing_village = 1;
                                }
                            }
                        } else {
                            $info_chief = "REP_С12";
                        }
                    } else {
                        $info_chief = "REP_С13";
                    }
                }
            }

            if ($this->data['t11']) {
                $info_hero = "REP_С6 " . $heroxp . " XP.";
                if ($this->def['oasistype'] && ($this->data['t11'] - $dead11) > 0) {

                    if ($this->data['from'] != $this->def['conqured']) {
                        $myoas = $database->VillageOasisCount($this->data['from']);

                        $ican = $this->Usercantake($this->data['from'], $this->data['to'], $myoas);

                        if ($ican) {
                            if (($totalsend_alldef - $totaldead_alldef) <= 0) {
                                $database->conquerOasis($this->data['from'], $this->data['to'], $this->att['owner']);
                                $info_hero = "REP_С10 " . $heroxp . " XP.";
                                $database->UpdateAchievU($this->att['owner'], "`a6`=1"); //ачивка за оаз
                            }
                        } else {
                            if ($this->def['conqured'] != 0 && $ican) {
                                $Oloyaltybefore = $this->def['loyalty'];
                                $LoyaltyAmendment = floor(100 / min(3, (4 - $myoas)));
                                $Oloyaltynow = $this->def['loyalty'] - $LoyaltyAmendment;
                                if ($Oloyaltynow <= 0) {
                                    $database->conquerOasis($this->data['from'], $this->data['to'], $this->att['owner']);
                                    $info_hero = "REP_С10 " . $heroxp . " XP.";
                                    $database->UpdateAchievU($this->att['owner'], "`a6`=1"); //ачивка за оаз
                                } else {
                                    $database->modifyOasisLoyalty($this->data['to'], $Oloyaltynow);
                                    $info_hero = "REP_С7 " . $Oloyaltybefore . " REP_С8 " . $Oloyaltynow . " REP_С9 " . $heroxp . " XP.";
                                }
                            } else {
                                if ($heroxp == 0) {
                                    $info_hero = "REP_С5";
                                } else {
                                    $info_hero = "REP_С6 " . $heroxp . " XP.";
                                }
                            }
                        }
                    }
                } elseif ($this->data['attack_type'] == 3 && ($this->data['t11'] - $dead11) > 0) {

                    foreach ($this->art as $artifact) {
                        if ($this->data['artefact'] == $artifact['id']) {
                            $smallart = $bigart = 0;
                            $myart = $database->getOwnedArtefacts($this->att['owner']);
                            $ownart = count($myart);
                            foreach ($myart as $my) {
                                if ($myart['type'] == 11) {
                                    $ownart--;
                                }
                                if ($this->data['from'] == $my['vref']) {
                                    switch ($my['size']) {
                                        case 1: $smallart+=1;
                                            break;
                                        case 2:
                                        case 3: $bigart+=1;
                                            break;
                                    }
                                }
                            }

                            if (($smallart < 2 && $artifact['size'] == 1) || ($artifact['size'] != 1 && $bigart == 0)) {
                                if (($totalsend_att - $totaldead_att) > 0) {

                                    if ($this->canClaimArtifact($this->data['from'], $artifact['size'])) {
                                        /*if ($ownart < 3 || ($this->att['owner'] == $this->def['owner'] && $ownart <= 3)) {// || $artifact['type'] == 11
                                            $database->claimArtefactById($this->data['from'], $this->data['to'], $this->att['owner'], 1, $artifact['id']);
                                            $minusart++;
                                            $info_hero = "REP_С33 " . $heroxp . " XP.";
                                        } else {*/
                                            $database->claimArtefactById($this->data['from'], $this->data['to'], $this->att['owner'], 0, $artifact['id']);
                                            $info_hero = "REP_С34 " . $heroxp . " XP.";
                                        //}
                                    } else {
                                        $info_hero = "REP_С35 " . $heroxp . " XP.";
                                    }
                                }
                            } elseif ($myart) {
                                $info_hero = "REP_С36 " . $heroxp . " XP.";
                            }
                        }
                    }
                }
            }
            if ($scout) {
                if ($this->data['spy'] == 1) {
                    $info_spy = "1," . round($totwood) . "," . round($totclay) . "," . round($totiron) . "," . round($totcrop) . "," . round($totwood + $totclay + $totiron + $totcrop);
                } else if ($this->data['spy'] == 2) {
                    if (!$this->def['oasistype']) {

                        $rplevel = $residence;
                        $crannycap+=$cranny;

                        $info_spy = "2," . "REP_С2 : " . $rplevel . ",
                         REP_С3: " . $crannycap . ",REP_С4 : " . $walllevel . ",,";
                    }
                }
                $data2 = $this->att['owner'] . ',' . $this->att['username'] . ',' . $this->data['from'] . ',' . $this->att['vname'] . ',' . $this->att['tribe'] . ',' . $unitssend_att . ',' . $unitsdead_att . ',' . $info_spy . ',' . $this->def['owner'] . ',' . $this->def['username'] . ',' . $this->data['to'] . ',' . $this->def['vname'] . ',' . $this->def['tribe'] . ',' . $tribes[1] . ',' . $unitssend_def[1] . ',' . $Defender['hero'][1] . ',' . $tribes[2] . ',' . $unitssend_def[2] . ',' . $Defender['hero'][2] . ',' . $tribes[3] . ',' . $unitssend_def[3] . ',' . $Defender['hero'][3] . ',' . $tribes[4] . ',' . $unitssend_def[4] . ',' . $Defender['hero'][4] . ',' . $tribes[5] . ',' . $unitssend_def[5] . ',' . $Defender['hero'][5] . ',' . $tribes[6] . ',' . $unitssend_def[6] . ',' . $Defender['hero'][7]. ',' . $tribes[7] . ',' . $unitssend_def[7] . ',' . $Defender['hero'][7];;
            } else {
                $data2 = $this->att['owner'] . ',' . $this->att['username'] . ',' . $this->data['from'] . ',' . $this->att['vname'] . ',' . $this->att['tribe'] . ',' . $unitssend_att . ',' . $unitsdead_att . ',' . round($steal[0]) . ',' . round($steal[1]) . ',' . round($steal[2]) . ',' . round($steal[3]) . ',' . $battlepart['bounty'] . ',' . $info_ram . ',' . $info_cat . ',' . $info_cat2 . ',' . $info_chief . ',' . $info_hero . ',' . $this->def['owner'] . ',' . $this->def['username'] . ',' . $this->data['to'] . ',' . $this->def['vname'] . ',' . $this->def['tribe'] . ',' . $tribes[1] . ',' . $unitssend_def[1] . ',' . $Defender['hero'][1] . ',' . $unitsdead_def[1] . ',' . $deadheros[1] . ',' . $tribes[2] . ',' . $unitssend_def[2] . ',' . $Defender['hero'][2] . ',' . $unitsdead_def[2] . ',' . $deadheros[2] . ',' . $tribes[3] . ',' . $unitssend_def[3] . ',' . $Defender['hero'][3] . ',' . $unitsdead_def[3] . ',' . $deadheros[3] . ',' . $tribes[4] . ',' . $unitssend_def[4] . ',' . $Defender['hero'][4] . ',' . $unitsdead_def[4] . ',' . $deadheros[4] . ',' . $tribes[5] . ',' . $unitssend_def[5] . ',' . $Defender['hero'][5] . ',' . $unitsdead_def[5] . ',' . $deadheros[5] . ',' . $tribes[6] . ',' . $unitssend_def[6] . ',' . $Defender['hero'][6] . ',' . $unitsdead_def[6] . ',' . $deadheros[6]. ',' . $tribes[7] . ',' . $unitssend_def[7] . ',' . $Defender['hero'][7] . ',' . $unitsdead_def[7] . ',' . $deadheros[7];
            }

//Undetected && detected in here.
            //scout reports
            if ($scout) {
                $topic = $this->att['vname'] . " REP_С37 " . $this->def['vname'];
                for ($i = 3; $i <= 4; $i++) {
                    if (${'dead' . $i}) {
                        if ($unitsdead_att == $unitssend_att) {
                            
                            $database->addNotice($this->def['owner'], $this->data['to'], $this->def['alliance'], 18, $data2, $this->data['endtime'], $topic);
                            break;
                        } else {
                            
                            $database->addNotice($this->def['owner'], $this->data['to'], $this->def['alliance'], 19, $data2, $this->data['endtime'], $topic);
                            break;
                        }
                    }
                }
            } else {
                $topic = $this->att['vname'] . " REP_С27 " . $this->def['vname'];
                if ($this->att['owner'] != $this->def['owner']) {
                    if ($totalsend_alldef == 0) {
                        $ref2 = 7;
                    } else if ($totaldead_alldef == 0) {
                        $ref2 = 4;
                    } else if ($totalsend_alldef > $totaldead_alldef) {
                        $ref2 = 5;
                    } else if ($totalsend_alldef == $totaldead_alldef || $totalsend_alldef < $totaldead_alldef) {
                        $ref2 = 6;
                    }
                    //defender
                $database->addNotice($this->def['owner'], $this->data['to'], $this->def['alliance'], $ref2, $data2, $this->data['endtime'], $topic, $trap_info);
                }
            }

//to here
// If the dead units not equal the ammount sent they will return && report
            if ($totalsend_att - ($totaldead_att + $totaltraped_att) > 0) {
                if ($this->data['attack_type'] == 3 && $totalsend_att - ($totaldead_att + $totaltraped_att) > 0) {
                    
                    $prisoners = $database->getPrisoners($this->data['to']);
                    //release prisoners
                    if (count($prisoners) > 0) {
                        foreach ($prisoners as $prisoner) {
                            $p_owner = $database->getVillageField($prisoner['from'], "owner");


                            $p_from = array('x' => $this->def['x'], 'y' => $this->def['y']);
                            $p_ander = $database->getCoor($prisoner['from']);
                            $p_to = array('x' => $p_ander['x'], 'y' => $p_ander['y']);
                            $p_tribe = $database->getUserField($p_owner, "tribe", 0);


                            $p_speeds = array();
                            $prison_info = "";
                            $trap_info = "";
                            //find slowest unit.
                            $trap_count = 0;
                            for ($i = 1; $i <= 10; $i++) {
                                if ($prisoner['t' . $i] != '' && $prisoner['t' . $i] > 0) {
                                    $before = $prisoner['t' . $i];
                                    $prisoner['t' . $i] = ceil($prisoner['t' . $i] * 0.75);
                                    $p_unitarray = $GLOBALS["u" . (($p_tribe - 1) * 10 + $i)];
                                    $p_speeds[] = $p_unitarray['speed'];
                                    $trap_info.=($before-$prisoner['t' . $i]) . ',';
                                    $prison_info.=$prisoner['t' . $i] . ',';
                                    $trap_count+=$before;
                                }else{
                                    $trap_info.= '0 ,';
                                    $prison_info.= '0 ,';
                                }
                            }

                            if ($prisoner['t11'] > 0) {
                                $p_qh = "SELECT * FROM hero WHERE uid = '" . $p_owner . "'";
                                $p_resulth = $database->query($p_qh);
                                $p_speeds[] = $p_resulth[0]['speed'];
                                
                                $prison_info.= '1';//hero - always free
                                $trap_info.= '0';//hero - always not dying
                            }else{
                                $trap_info.= '0';
                                $prison_info.= '0';
                            }


                            $p_time = round($database->procDistanceTime($p_to, $p_from, min($p_speeds), 1));
                            $p_reference = $database->addAttack($prisoner['from'], $prisoner['t1'], $prisoner['t2'], $prisoner['t3'], $prisoner['t4'], $prisoner['t5'], $prisoner['t6'], $prisoner['t7'], $prisoner['t8'], $prisoner['t9'], $prisoner['t10'], $prisoner['t11'], 3, 0, 0, 0, 0);
                            $database->addMovement(4, $prisoner['wref'], $prisoner['from'], $p_reference, time(), ($p_time + time()));
                            $database->insertQueue($p_reference, 2, time(), ($p_time + time()));
                            
                            $database->modifyTraps($this->data['to'], $trap_count, 2);
                            //destroy all traps used by troops
                            $database->query("UPDATE `units` SET `u99`= u99 - " . $trap_count . " WHERE `vref` =:V", array('V' => $prisoner['wref']));

                            $database->deletePrisoners($prisoner['id']);
                            $trap_info.= ",REP_С1,".$prison_info;
                        }
                        //released all troops
                        //$trap_info= "REP_С1";
                    }
                }

                if ($this->data['attack_type'] == 1) {
                    $rep3 = 16;
                } else {
                    if ($totaldead_att == 0) {
                        $rep3 = 1;
                    } else {
                        $rep3 = 2;
                    }
                }

        //attacker
                $database->addNotice($this->att['owner'], $this->data['to'], $this->att['alliance'], $rep3, $data2, $this->data['endtime'], $topic, $trap_info);

                if ($chiefing_village != 1) {
                    $bon = $bon2 = 1;
                    if ($this->att['alliance'] > 0 && $this->att['alliance'] == $this->def['alliance']) {
                        $bon = $this->heroa['ally'];
                    }
                    if ($this->att['owner'] == $this->def['owner']) {
                        $bon2 = $this->heroa['own'];
                    }
                    $fastertroops = $database->checkArtefactsEffects($this->att['owner'], $this->data['from'], 2);

                    $fromCor = array('x' => $this->def['x'], 'y' => $this->def['y']);
                    $toCor = array('x' => $this->att['vx'], 'y' => $this->att['vy']);
                    if (!count($speeds)) {
                        $speeds = array(1);
                        //file_put_contents('GameEngine/queue2/error_speeds.txt', var_export(array($data, $this->att, $this->units, $this->def), true) . "\r\n\r\n", FILE_APPEND);
                    }
                    $endt = round($database->procDistanceTime($fromCor, $toCor, (min($speeds) * $bon * $bon2 * $this->heroa['back'] * $this->heroa['speedb']), 1, $this->data['from']) / $fastertroops);
                    $database->addMovement(4, $this->data['to'], $this->data['from'], $this->data['ref'], $this->data['endtime'], ($this->data['endtime'] + $endt), 1, $steal[0], $steal[1], $steal[2], $steal[3]);
                    $database->insertQueue($this->data['ref'], 2, $this->data['endtime'], ($this->data['endtime'] + $endt));


                    if ($this->data['attack_type'] != 1 && $this->att['owner'] != $this->def['owner']) {
                        $totalstolengain = $steal[0] + $steal[1] + $steal[2] + $steal[3];
                        $totalstolentaken = (0 - $totalstolengain);
                        $database->modifyPoints($this->att['owner'], 'RR', $totalstolengain);
                        $database->modifyPoints($this->def['owner'], 'RR', $totalstolentaken);
                        $database->modifyPointsAlly($this->def['alliance'], 'RR', $totalstolentaken);
                        $database->modifyPointsAlly($this->att['alliance'], 'RR', $totalstolengain);
                    }
                } else if ($chiefing_village == 1) {
                    $database->addEnforce2($this->data, $dead1, $dead2, $dead3, $dead4, $dead5, $dead6, $dead7, $dead8, $dead9 + 1, $dead10, $dead11);
                }
            } else { //else they die && don't return || report.
                $rt = ($this->data['attack_type'] == 1) ? 17 : 3;

                $data_fail = '' . $this->att['owner'] . ',' . $this->att['username'] . ',' . $this->data['from'] . ',' . $this->att['vname'] . ',' . $this->att['tribe'] . ',' . $unitssend_att . ',' . $unitsdead_att . ',' . $this->def['owner'] . ',' . $this->def['username'] . ',' . $this->data['to'] . ',' . $this->def['vname'] . ',' . $this->def['tribe'] . ',' . $info_ram . ',' . $info_cat . ',' . $info_cat2 . ',' . $info_hero;
               
                $database->addNotice($this->att['owner'], $this->data['to'], $this->att['alliance'], $rt, $data_fail, $this->data['endtime'], $topic, $trap_info);
            }
            
            //если взяли арт                    
            if ($this->data['attack_type'] == 3){
                if ($dvil > 1 && //has other vil
                    $this->def['oasistype'] == 0 && //not an oasis
                    $this->def['owner'] != 3 && //NON-NATAR
                    $this->def['pop'] == 0  && // 0 pop
                    (count($this->art) - $minusart) == 0)  { //no artifacts in town
                        $destroy_vil = 1;
                }else{
                    addToLog("general","Village is ok[".$this->data['to']."] - no need to destroy it. Params: dvil:".$dvil.', oasistype:'.$this->def['oasistype'].', owner'.$this->def['owner'].', population:'.$this->def['pop'].', artefacts'.(count($this->art) - $minusart));
                }
            }
            if ($destroy_vil ){
                //destroy this village if player has at least one other village to be set as capital
                $database->DelVillageGlobal($this->data['to']);
            }
        } else {

            $animals = $anim = $usedcages = $total_captured = 0;
            $captured = array();

            for ($i = 1; $i <= 10; $i++) {
                if ($this->data['t' . $i] > ${'dead' . $i}) {
                    global ${"u" . (($this->att['tribe'] - 1) * 10 + $i)};
                    $speeds[] = ${"u" . (($this->att['tribe'] - 1) * 10 + $i)}['speed'];
                }
            }
            if ($this->data['t11'] > ${'dead11'}) {
                $getHero = $database->getHeroData($this->att['owner']);
                $speeds[] = ($this->att['tribe']==7?$getHero['speed']+($getHero['speed']*2/10) : $getHero['speed']);
            }
            $bon = $bon2 = 1;
            if ($this->att['alliance'] > 0 && $this->att['alliance'] == $this->def['alliance']) {
                $bon = $this->heroa['ally'];
            }
            if ($this->att['owner'] == $this->def['owner']) {
                $bon2 = $this->heroa['own'];
            }
            $fastertroops = $database->checkArtefactsEffects($this->att['owner'], $this->data['from'], 2);

            $fromCor = array('x' => $this->def['x'], 'y' => $this->def['y']);
            $toCor = array('x' => $this->att['vx'], 'y' => $this->att['vy']);
            $endt = round($database->procDistanceTime($fromCor, $toCor, (min($speeds) * $bon * $bon2 * $this->heroa['back'] * $this->heroa['speedb']), 1, $this->data['from']) / $fastertroops);
            $database->addMovement(4, $this->data['to'], $this->data['from'], $this->data['ref'], $this->data['endtime'], ($this->data['endtime'] + $endt), 1, 0, 0, 0, 0);
            $database->insertQueue($this->data['ref'], 2, $this->data['endtime'], ($this->data['endtime'] + $endt));

//сверху возврат напа с клетками в деру короч


            if ($this->data['t11'] > 0) {
                $getHero = $database->getHeroData($this->att['owner']);
                $speeds[] = $getHero['speed'];
            }
            for ($i = 1; $i <= 10; $i++) {
                if ($this->data['t' . $i] > 0) {
                    $speeds[] = ${"u" . (($this->att['tribe'] - 1) * 10 + $i)}['speed'];
                }

                $captured[$i] = 0;
                if ($this->units['u' . $i] > 0) {
                    $animals += $this->units['u' . $i];
                    $anim++;
                }
            }
            $cagesdef = $NikolasCages['type'] * ((SPEED / 10)+1);
            if ($NikolasCages['type'] >= $animals) { //если клеток больше чем зверья-забираем все
                for ($i = 1; $i <= 10; $i++) {
                    $usedcages+=$this->units['u' . $i];
                    $captured[$i] = $this->units['u' . $i];
                }
            } else {

                for ($i = 1; $i <= 10; $i++) {
                    if ($this->units['u' . $i] > 0) {
                        $getanim = round($cagesdef / $anim);


                        if ($this->units['u' . $i] < $getanim) {
                            $cagesdef-=$this->units['u' . $i];
                            $usedcages+=$this->units['u' . $i];
                            $anim--;
                            $captured[$i] = $this->units['u' . $i];
                        } else {
                            $cagesdef-=$getanim;
                            $usedcages+=$getanim;
                            $captured[$i] = $getanim;
                            $anim--;
                        }
                    }
                }
            }

            $usedcages = ceil($usedcages / ((SPEED / 10)+1));
            $newtype = $NikolasCages['type'] - $usedcages;

            $database->editHeroType($NikolasCages['id'], $newtype, 2); //убираем использованные клетки
            $database->editHeroNum2($NikolasCages['id'], $usedcages);
            if ($newtype == 0) {
                $database->setHeroInventory($this->att['owner'], "bag", 0);
                $database->editProcItem($NikolasCages['id'], 0, $this->att['owner']);
            }
            if (!($NikolasCages['num'] - $usedcages) && !$newtype) {
                $q = "DELETE FROM heroitems where id = '" . $NikolasCages['id'] . "'";
                $database->query($q);
            }
            for ($i = 1; $i <= 10; $i++) {
                $total_captured += $captured[$i];
            }
            $datainf = $this->data['from'] . "," . $captured['1'] . "," . $captured['2'] . "," . $captured['3'] . "," . $captured['4'] . "," . $captured['5'] . "," . $captured['6'] . "," . $captured['7'] . "," . $captured['8'] . "," . $captured['9'] . "," . $captured['10'];
            
            $database->addNotice($this->att['owner'], $this->data['to'], $this->att['alliance'], 20, $datainf, $this->data['endtime'], 'REP_С43');

            if ($total_captured > 0) {

                $speeds = array();


                $database->modifyUnit($this->data['to'], array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10), array($captured['1'], $captured['2'], $captured['3'], $captured['4'], $captured['5'], $captured['6'], $captured['7'], $captured['8'], $captured['9'], $captured['10']), 0, "Units captured");


                //find slowest unit.
                for ($i = 1; $i <= 10; $i++) {
                    if ($captured[$i] > 0) {
                        $speeds[] = ${"u" . (30 + $i)}['speed'];
                    }
                }

                $time = round($database->procDistanceTime($fromCor, $toCor, min($speeds), 1, 0, 1));

                $reference = $database->addAttack($this->data['to'], $captured['1'], $captured['2'], $captured['3'], $captured['4'], $captured['5'], $captured['6'], $captured['7'], $captured['8'], $captured['9'], $captured['10'], 0, 2, 0, 0, 0, 0);
                $database->addMovement(3, $this->data['to'], $this->data['from'], $reference, $this->data['endtime'], ($time + $this->data['endtime']));
                $database->insertQueue($reference, 3, $this->data['endtime'], ($time + $this->data['endtime']));
            }
        }

        return true;
    }

    function sendBack() {
        global $database,$hero_model;
        $time2 = $this->data['endtime'] - $this->data['starttime'];
        $database->addMovement(4, $this->data['to'], $this->data['from'], $this->data['ref'], $this->data['endtime'], ($this->data['endtime'] + $time2));
        $database->insertQueue($this->data['ref'], 2, $this->data['endtime'], ($this->data['endtime'] + $time2));
    }

    //1 raid 0 normal
    private function calculateBattle($residence, $stonemason, $walllevel, $wallbonus, $brewery) {
        global $database,$hero_model;
        $battle = new Battle();

        // Definieer de array met de eenheden

        $calvary = array(4, 5, 6, 15, 16, 23, 24, 25, 26, 45, 46,54,55,56,63,64,65,66,75,76);
        $catapult = array(8, 18, 28, 48,58,68,78);
        $rams = array(7, 17, 27, 47,57,67,77);
        $catapult_num = $ram = 0;
        // Array om terug te keren met het resultaat van de berekening
        $result = $atkhero = $defenderhero = $retribe = $units = $defhero = array();

        $total_troops_involved = 0;
        // bij 0 alle deelresultaten
        $cap = $ap = $dp = $cdp = $rap = $rdp = $k = $tbgid1 = $tbgid2 = $wctp = 0;

        //add artefact bonus
        $attacker_artefact = $database->checkArtefactsEffects($this->att['owner'], $this->data['from'],3);
        $defender_artefact = $database->checkArtefactsEffects($this->def['owner'], $this->data['to'],3);

        //?
        if (!$this->def['oasistype']) {
            for ($i = 1; $i <= 8; $i++) {
                ${'def_ab' . $i} = $this->def['a' . $i];
            }
        } else {
            for ($i = 1; $i <= 8; $i++) {
                ${'def_ab' . $i} = 0;
            }
        }

        //add hero bonus
        if ($this->data['t11'] != 0) {
            $atkhero = $database->getBattleHer($this->att['owner']);
        }
        if ($this->units['u11'] != 0) {
            $defenderhero = $database->getBattleHer($this->def['owner']);
        }

        //add enforcements heroes
        if (count($this->en)) {
            foreach ($this->en as $def) {
                $retribe[$def['from']] = $def['tribe'];
                $defhero[$def['from']] = $database->getBattleHer($def['owner']);
            }
        }

        // Berekenen het totaal aantal punten van Aanvaller
        $start = ($this->att['tribe'] - 1) * 10 + 1;
        $end = ($this->att['tribe'] * 10);
        $abcount = ($this->att['tribe'] == 3) ? 3 : 4;


        //count attack points
        if ($this->data['attack_type'] == 1) {
            $jj = 0;
            for ($i = $start; $i <= $end; $i++) {
                $jj++;
                if ($i == 14 || $i == 4 || $i == 23 || $i == 54 || $i == 63) {
                    global ${'u' . $i};

                    if ($abcount <= 8 && $this->att['a' . $abcount] > 0) {
                        $ap += ((35 + ( 35 + 300 * ${'u' . $i}['pop'] / 7) * (pow(1.007, $this->att['a' . $abcount]) - 1)) * $this->data['t' . $jj]) * $attacker_artefact;
                    } else {
                        $ap += ($this->data['t' . $jj] * 35) * $attacker_artefact;
                    }
                }
                $total_troops_involved += $this->data['t' . $jj];
                $units['Att_unit'][$i] = $this->data['t' . $jj];
            }
        } else {
            $abcount = 1;
            $jj = 0;
            for ($i = $start; $i <= $end; $i++) {
                $jj++;

                global ${'u' . $i};
                
                if ($this->data['t' . $jj] > 0) {
                    if ($abcount <= 8 && $this->att['a' . $abcount] > 0) {
                        if (in_array($i, $calvary)) {
                            $cap += $this->heroa['u' . $jj] + (${'u' . $i}['atk'] + (${'u' . $i}['atk'] + 300 * ${'u' . $i}['pop'] / 7) * (pow(1.007, $this->att['a' . $abcount]) - 1)) * $this->data['t' . $jj];
                        } else {
                            $ap += $this->heroa['u' . $jj] + (${'u' . $i}['atk'] + (${'u' . $i}['atk'] + 300 * ${'u' . $i}['pop'] / 7) * (pow(1.007, $this->att['a' . $abcount]) - 1)) * $this->data['t' . $jj];
                        }
                    } else {
                        if (in_array($i, $calvary)) {
                            $cap += $this->heroa['u' . $jj] + $this->data['t' . $jj] * ${'u' . $i}['atk'];
                        } else {
                            $ap += $this->heroa['u' . $jj] + $this->data['t' . $jj] * ${'u' . $i}['atk'];
                        }
                    }
                }
                $abcount +=1;
                // Punten van de catavult van de aanvaller
                if (in_array($i, $catapult)) {
                    $catapult_num += $this->data['t' . $jj];
                }
                // Punten van de Rammen van de aanvaller
                if (in_array($i, $rams)) {
                    $ram_num += $this->data['t' . $jj];
                }
                $total_troops_involved += $this->data['t' . $jj];
                $units['Att_unit'][$i] = $this->data['t' . $jj];
            }
            if ($this->data['t11']) {
                $units['Att_unit']['hero'] = $this->data['t11'];
                //$cap += $atkhero['atk'];
                $ap += $atkhero['atk'];
                $ap = $ap * $atkhero['ob'];
                //$cap = $cap * $atkhero['ob'];
            }
        }

        // Berekent het totaal aantal punten van de Defender
        //

        if (count($this->en) > 0) {
            $k = 0;
            foreach ($this->en as $enforce) {
                $deffvreff = $enforce['from'];
                $ReTr = $retribe[$deffvreff];
                if($ReTr == null){
                    $ReTr = 4;
                    $retribe[$deffvreff] = 4;
                }
                $k+=1;
                for ($i = 1; $i <= 10; $i++) {
                    ${'Defender' . $k}['u' . (($ReTr - 1) * 10 + $i)] = $enforce['u' . $i];
                }
                ${'Defender' . $k}['owner'] = $enforce['owner'];
                ${'Defender' . $k}['from'] = $enforce['from'];
                ${'Defender' . $k}['ab'] = array('a1' => $enforce['a1'], 'a2' => $enforce['a2'], 'a3' => $enforce['a3'], 'a4' => $enforce['a4'], 'a5' => $enforce['a5'], 'a6' => $enforce['a6'], 'a7' => $enforce['a7'], 'a8' => $enforce['a8']);
                ${'Defender' . $k}['hero'] = $enforce['u11'];
            }
        }

        //count defence points
        $start = ($this->def['tribe'] - 1) * 10 + 1;
        $end = ($this->def['tribe'] * 10);
        if ($this->data['attack_type'] == 1) {

            $abcount = ($this->def['tribe'] == 3) ? 3 : 4;
            for ($y = 4; $y <= 70; $y++) {
                $dp_temp = 0;    
                if ($y == 4 || $y == 14 || $y == 23 || $y == 44 || $i == 54 || $i == 63) {
                    global ${'u' . $y};
                    if ($y >= $start && $y <= ($end - 2) && ${'def_ab' . $abcount} > 0) {
                        $dp_temp += ((20 + (20 + 300 * ${'u' . $y}['pop'] / 7) * (pow(1.007, ${'def_ab' . $abcount}) - 1)) * $this->units['u' . $abcount]) * $defender_artefact;
                    } else {
                        $dp_temp += ($this->units['u' . $abcount] * 20) * $defender_artefact;
                    }
                }
                $total_troops_involved+=$this->units['u' . $abcount];
                //add defence bonus for main troop
                $dp_temp *= $database->hasFightBonus($this->def['owner'],'d1',DEFENCE1_BONUS);     
                $dp += $dp_temp;    
            }
            for ($l = 1; $l <= $k; $l++) {
                $dp_temp = 0;
                $cdp_temp = 0;
                $deffvref = ${'Defender' . $l}['from'];
                $ReTr = $retribe[$deffvref];
                $start = ($ReTr - 1) * 10 + 1;
                $end = ($ReTr * 10);
                if ($ReTr == 3) {
                    $abcount = 3;
                } else {
                    $abcount = 4;
                }
                ${'def_ab' . $abcount} = ${'Defender' . $l}['ab']['a' . $abcount . ''];
                for ($y = 4; $y <= 70; $y++) {

                    if ($y == 4 || $y == 14 || $y == 23 || $i == 54 || $i == 63) {
                        global ${'u' . $y};
                        if ($y >= $start && $y <= ($end - 2) && ${'def_ab' . $abcount} > 0) {
                            $dp_temp += (20 + (20 + 300 * ${'u' . $y}['pop'] / 7) * (pow(1.007, ${'def_ab' . $abcount}) - 1)) * ${'Defender' . $l}['u' . $y];
                        } else {
                            $dp_temp += ${'Defender' . $l}['u' . $y] * 20;
                        }
                        $total_troops_involved+=${'Defender' . $l}['u' . $y];
                    }
                }
                
                //add defence bonus for reinforcements
                $dp_temp *= $database->hasFightBonus(${'Defender' . $l}['owner'],'d1',DEFENCE1_BONUS);     
                $cdp_temp *= $database->hasFightBonus(${'Defender' . $l}['owner'],'d1',DEFENCE1_BONUS);     
                
                $dp += $dp_temp;    
                $cdp += $cdp_temp; 
            }
        } else {
            $abcount = 1;
            $jj = 0;
            for ($y = $start; $y <= $end; $y++) {
                $dp_temp = 0;
                $cdp_temp = 0;
                $jj++;
                global ${'u' . $y};
                if ($this->units['u' . $jj] > 0) {
                    if ($abcount <= 8 && ${'def_ab' . $abcount} > 0) {
                        $dp_temp += $this->herod['u' . $jj] + (${'u' . $y}['di'] + (${'u' . $y}['di'] + 300 * ${'u' . $y}['pop'] / 7) * (pow(1.007, ${'def_ab' . $abcount}) - 1)) * $this->units['u' . $jj];
                        $cdp_temp += $this->herod['u' . $jj] + (${'u' . $y}['dc'] + (${'u' . $y}['dc'] + 300 * ${'u' . $y}['pop'] / 7) * (pow(1.007, ${'def_ab' . $abcount}) - 1)) * $this->units['u' . $jj];
                    } else {
                        $dp_temp += $this->herod['u' . $jj] + $this->units['u' . $jj] * ${'u' . $y}['di'];
                        $cdp_temp += $this->herod['u' . $jj] + $this->units['u' . $jj] * ${'u' . $y}['dc'];
                    }
                }
                $total_troops_involved += $this->units['u' . $jj];
                $abcount +=1;

                //add defence bonus for main force
                $dp_temp *= $database->hasFightBonus($this->def['owner'],'d1',DEFENCE1_BONUS);     
                $cdp_temp *= $database->hasFightBonus($this->def['owner'],'d1',DEFENCE1_BONUS);   
                $dp += $dp_temp;    
                $cdp += $cdp_temp;    
            }
            if ($this->units['u11'] != 0) {

                //$cdp += $defenderhero['dc'];
                $dp += $defenderhero['di'];
                $dp = $dp * $defenderhero['db'];
                //$cdp = $cdp * $defenderhero['db'];
            }


            for ($l = 1; $l <= $k; $l++) {
                $dp_temp = 0;
                $cdp_temp = 0;
                $abcount = 1;
                $deffvref = ${'Defender' . $l}['from'];
                $ReTr = $retribe[$deffvref];
                $start = ($ReTr - 1) * 10 + 1;
                $end = ($ReTr * 10);
                $fromvillage = $deffvref;
                if (${'Defender' . $l}['hero'] == 1) {

                    //$cdp += $defhero[$fromvillage]['dc'];
                    $dp += $defhero[$fromvillage]['di'];
                    $herodp = $herocdp = $defhero[$fromvillage]['db'];
                } else {
                    $herodp = $herocdp = 1;
                }
                for ($i = 1; $i <= 8; $i++) {
                    ${'def_ab' . $i} = ${'Defender' . $l}['ab']['a' . $i . ''];
                }
                for ($y = $start; $y <= $end; $y++) {
                    global ${'u' . $y};
                    if ($abcount <= 8 && ${'def_ab' . $abcount} > 0) {

                        $dp_temp += $this->bonusR[$fromvillage]['u' . $abcount] + ((${'u' . $y}['di'] + (${'u' . $y}['di'] + 300 * ${'u' . $y}['pop'] / 7) * (pow(1.007, ${'def_ab' . $abcount}) - 1)) * ${'Defender' . $l}['u' . $y]) * $herodp;
                        $cdp_temp += $this->bonusR[$fromvillage]['u' . $abcount] + ((${'u' . $y}['dc'] + (${'u' . $y}['dc'] + 300 * ${'u' . $y}['pop'] / 7) * (pow(1.007, ${'def_ab' . $abcount}) - 1)) * ${'Defender' . $l}['u' . $y]) * $herocdp;
                    } else {
                        $dp_temp += $this->bonusR[$fromvillage]['u' . $abcount] + (${'Defender' . $l}['u' . $y] * ${'u' . $y}['di']) * $herodp;
                        $cdp_temp += $this->bonusR[$fromvillage]['u' . $abcount] + (${'Defender' . $l}['u' . $y] * ${'u' . $y}['dc']) * $herocdp;
                    }
                    $total_troops_involved += ${'Defender' . $l}['u' . $y];
                    $abcount +=1;
                }
                //add defence bonus for reinforcements
                $dp_temp *= $database->hasFightBonus(${'Defender' . $l}['owner'],'d1',DEFENCE1_BONUS);     
                $cdp_temp *= $database->hasFightBonus(${'Defender' . $l}['owner'],'d1',DEFENCE1_BONUS);    
                $dp += $dp_temp;    
                $cdp += $cdp_temp;    
            }
        }


        $pop_ratio = $this->att['pop'] / $this->def['pop'];
        $no_morale = ($this->build['f99t']==40);
        $morale = $no_morale ? 1 : $battle->limit(0.333, pow($pop_ratio, -0.3), 1);

        $strongerbuildings = $database->checkArtefactsEffects($this->def['owner'], $this->data['to'], 1);
        $coefofstone = 1 + ($stonemason / 10);
        $durability = $coefofstone * $strongerbuildings;

        //rams,catapults morale etc all calculations:
        // Formule voor de berekening van de bonus verdedigingsmuur "en" Residence ";
        $wall_durability = array(1 => 1, 5, 2, 1, 1, 5, 1);
        $wall_base = array(1 => 1.03, 1.02, 1.025, 1, 1.03,1.035,1.020);
        $wall_extra = array(1 => 10, 6, 8, 0, 10, 8, 6);

        $wall_bonus = round(pow($wall_base[$this->def['tribe']], $walllevel), 3);
        $wall_durability = $wall_durability[$this->def['tribe']];


        //add attack bonus for infantry and cavalry        
        $ap *= $database->hasFightBonus($this->att['owner'],'a1',OFFENSE1_BONUS);
        $cap *= $database->hasFightBonus($this->att['owner'],'a1',OFFENSE1_BONUS);

        $rap = ($ap + $cap) + (($ap + $cap) / 100 * $brewery);
        if ($rap == 0){
            $rdp = ($dp) + ($cdp) + 10;
        }
        else{
            $rdp = ($dp * ($ap / $rap)) + ($cdp * ($cap / $rap)) + 10;
        }
        $rdp = $rdp * $morale;


        if ($walllevel > 0) {
            if ($ram_num > 0) {
                $result['wallbefore'] = $walllevel;                
                $ram_upgrade = $this->att['a7'];

                $pts_ratio = $battle->remorale($rap, $rdp, $no_morale ? 1 : $pop_ratio, $wall_bonus);
                $siege_percent = $battle->sigma(pow($pts_ratio, 1.5));
                $ram_with_bonus = $ram_num * $siege_percent * $morale;

                $walllevel = $battle->getBuildingLevelAfterCatas($walllevel, $ram_with_bonus, $ram_upgrade, $wall_durability, $durability);
                $wall_bonus = round(pow($wall_base[$this->def['tribe']], $walllevel), 3);

                $result['wallafter'] = $walllevel;
                $result[7] = 0;
                $result[8] = 0;
            }

            // Berekening van de Basic defence bonus "Residence"
            if ($this->data['attack_type'] != 1) {
                $dp += (2 * (pow($residence, 2)));
                $cdp += (2 * (pow($residence, 2)));
            }
            $dp += ($wall_extra[$this->def['tribe']] * $walllevel); // wall
            $cdp += ($wall_extra[$this->def['tribe']] * $walllevel); // wall
            
        } elseif ($this->data['attack_type'] != 1) {
            // Berekening van de Basic defence bonus "Residence"
            $dp += (2 * (pow($residence, 2)));
            $cdp += (2 * (pow($residence, 2)));
        }
        
        $rap = ($ap + $cap) + (($ap + $cap) / 100 * $brewery);
        if ($rap == 0){
            $rdp = ($dp) + ($cdp) + 10;
        }
        else{
            $rdp = ($dp * ($ap / $rap)) + ($cdp * ($cap / $rap)) + 10;
        }
        $rdp = $rdp * $morale;
        if ($this->def['owner'] == 3) {
            $rap*=$this->heroa['natarf'];
        }

        $result['Attack_points'] = $rap;
        $result['Defend_points'] = $rdp;                
        $winner = ($rap > $rdp);


        $immensity = $battle->calc_diffusion($total_troops_involved);
        // Formule voor het berekenen verloren drives
        // type = 1 Raid, 0 Normal
        if ($this->data['attack_type'] == 1) {
            $holder = pow(($rdp / $rap), $immensity);
            // Attacker
            $result[1] = $holder;
            // Defender
            $result[2] = 0;
        } else if ($this->data['attack_type'] == 4) {
            $holder = ($winner) ? pow(($rdp / $rap), $immensity) : pow(($rap / $rdp), $immensity);
            $holder = $holder / (1 + $holder);
            // Attacker
            $result[1] = $winner ? $holder : 1 - $holder;
            // Defender
            $result[2] = $winner ? 1 - $holder : $holder;

            $catapult_num = 0;//catas do not work in raid
            $ram_num = 0;//rams do not work in raid
        } else if ($this->data['attack_type'] == 3) {
            // Attacker
            $result[1] = ($winner) ? pow(($rdp / $rap), $immensity) : 1;
            $result[1] = round($result[1], 8);

            // Defender
            $result[2] = (!$winner) ? pow(($rap / $rdp), $immensity) : 1;
            $result[2] = round($result[2], 8);
        }
        // Formule voor de berekening van katapulten nodig
        if ($catapult_num > 0 && $this->data['attack_type'] == 3 && $this->data['ctar1'] && (!$this->def['oasistype'] || $this->def['oasistype'] == 88)) {

            if($this->data['ctar2']!=0){
                $catapult_num = $catapult_num/2;
            }            

            $catapult_upgrade = $this->att['a8'];
            $pts_ratio = $battle->remorale($rap, $rdp, $no_morale ? 1 : $pop_ratio, $wall_bonus);
            $siege_percent = $battle->sigma(pow($pts_ratio, 1.5));
            $catapult_with_bonus = $catapult_num * $siege_percent * $morale;


            $target1 = $this->getCatapultTarget($this->buildingsArray($this->build),$this->data['ctar1']);
            if($target1 != 0){
            
                $old_level = $target1['level'];
                $tbgid1 = $target1['type'];
                $field_id = $target1['field_id'];

                $new_level = $battle->getBuildingLevelAfterCatas($old_level,$catapult_with_bonus,$catapult_upgrade,1,$durability);
                $result['info1'] = $this->finalizeCatapultInfo($this->data['to'],$new_level,$old_level,$field_id);
                    
                if ($this->data['ctar2'] != 0) {
                    $this->build = $database->getResourceLevel($this->data['to']);
                    $target2 = $this->getCatapultTarget($this->buildingsArray($this->build),$this->data['ctar2']);
                    if($target2 != 0){
                        $old_level = $target2['level'];
                        $tbgid2 = $target2['type'];
                        $field_id = $target2['field_id'];
                        
                        $new_level = $battle->getBuildingLevelAfterCatas($old_level,$catapult_with_bonus,$catapult_upgrade,1,$durability);
                        $result['info2'] = $this->finalizeCatapultInfo($this->data['to'],$new_level,$old_level,$field_id);
                    }
                }

                checkVillageStatus($this->data['to']);
            }
        }


        $result['deadherodef'] = 0;
        $result['casualties_attacker']['11'] = 0;
        // Aantal katapulten om het gebouw neer te halen
        $result['tbgid1'] = $tbgid1;
        $result['tbgid2'] = $tbgid2;

        // Aantal Katapulten die handeling
        $result[4] = 0;
        $result[5] = $morale;

        $result[6] = pow($rap / $rdp * $morale, $immensity);


        for ($i = ($this->att['tribe'] - 1) * 10 + 1; $i <= ($this->att['tribe'] * 10); $i++) {
            $dead = round($result[1] * $units['Att_unit'][$i]);
            $dead = ($dead < 0) ? 0 : $dead;
            $y = ($i) - (($this->att['tribe'] - 1) * 10);
            $result['casualties_attacker'][$y] = ($dead > $units['Att_unit'][$i]) ? $units['Att_unit'][$i] : $dead;
        }

        if ($this->data['t11']) {
            $hero_id = $atkhero['heroid'];
            $hero_health = $atkhero['health'] + $this->heroa['health'] + $this->heroa['mhealth']; //здоровье гера от предметов атака
            $damage_health = round(100 * $result[1]);

            //exit($damage_health."|".$hero_health."|".$atkhero['heroid']);
            if ($hero_health <= $damage_health || $damage_health > 90) {
                //hero die

                $result['casualties_attacker']['11'] = 1;
                $database->KillHero($hero_id, 0, 1);
            } else {
                $database->KillHero($hero_id, $damage_health, 0);
            }
        }



        if ($this->units['u11']) {

            $hero_id = $defenderhero['heroid'];
            $hero_health = $defenderhero['health'] + $this->herod['health'] + $this->herod['mhealth']; //здоровье гера от предметов защита
            $damage_health = round(100 * $result[2]);
            if ($hero_health <= $damage_health || $damage_health > 90) {
                //hero die
                $result['deadherodef'] = 1;
                $database->KillHero($hero_id, 0, 1);
            } else {
                $result['deadherodef'] = 0;
                $database->KillHero($hero_id, $damage_health, 0);
            }
        }



        if (count($this->en)) {
            foreach ($this->en as $defenders) {
                if ($defenders['u11'] > 0) {
                    $fdb = $defhero[$defenders['from']];
                    $hero_id = $fdb['heroid'];
                    $hero_health = $fdb['health'] + $this->bonusR[$defenders['from']]['health'] + $this->bonusR[$defenders['from']]['mhealth']; //здоровье гера подкреп

                    $damage_health = round(100 * $result[2]);

                    if ($hero_health <= $damage_health || $damage_health > 99) {
                        //hero die
                        $result['deadheroref'][$defenders['id']] = 1;
                        $database->KillHero($hero_id, 0, 1);
                    } elseif ($hero_health > $damage_health) {
                        $result['deadheroref'][$defenders['id']] = 0;
                        $database->KillHero($hero_id, $damage_health, 0);
                    }
                }
            }
        }


        // Work out bounty
        $max_bounty = 0;
        $start = ($this->att['tribe'] - 1) * 10 + 1;
        $end = ($this->att['tribe'] * 10);
        for ($i = $start; $i <= $end; $i++) {

            $y = ($i) - (($this->att['tribe'] - 1) * 10);
            $max_bounty += ($this->data['t' . $y] - $result['casualties_attacker'][$y]) * ${'u' . $i}['cap'];
        }

        $result['bounty'] = $max_bounty;


        return $result;
    }

    function finalizeCatapultInfo($vref,$new_level,$old_level,$field_id){
        global $database;

        if($new_level == $old_level){
            $info_cat = " REP_С41";        
        }else if ($new_level == 0) {
            $info_cat = " <b>REP_С40</b>.";
            if ($field_id >= 19 && $field_id != 99) {
                $database->setVillageLevel($this->data['to'], "f" . $field_id . "t", '0');
            }
            $database->DeleteBuldingCata($field_id, $vref);
            $database->setVillageLevel($vref, "f" . $field_id . "", 0);
        }else{
            $info_cat = " REP_С19 <b>" . $old_level . "</b> REP_С8 REP_С21 <b>" . $new_level . "</b>.";
            if ($old_level > $new_level) {
                if ($database->CheckbuildBeforeUPDATE($field_id, $vref) > 0) {
                    $database->UPDATEBuildingCata($new_level + 1, $field_id, $vref, $tbgid2);
                }
            }
            if ($new_level < 1 && $field_id >= 19 && $field_id != 99) {
                $database->setVillageLevel($vref, "f" . $field_id . "t", '0');
                $database->DeleteBuldingCata($field_id, $vref);
            }
            $database->setVillageLevel($vref, "f" . $field_id . "", $new_level);
        }
        return $info_cat;
    }

    function buildingsArray($buildings){
        $rearranged = array();
        for ($i = 1; $i <= 40; $i++) {
            if ($buildings['f' . $i . 't'] >0 && $buildings['f' . $i] > 0) {
                $rearranged[$i]['type'] = $buildings['f' . $i . 't'];
                $rearranged[$i]['level'] = $buildings['f' . $i];
                $rearranged[$i]['field'] = 'f' . $i;
                $rearranged[$i]['field_id'] = $i;
            }
        }

        $i = 99;
        if ($buildings['f' . $i . 't'] >0 && $buildings['f' . $i] > 0) {
            $rearranged[$i]['type'] = $buildings['f' . $i . 't'];
            $rearranged[$i]['level'] = $buildings['f' . $i];
            $rearranged[$i]['field'] = 'f' . $i;
            $rearranged[$i]['field_id'] = $i;
        }

        return $rearranged;
    }

    function getRandomTarget($buildings){
        $free = array();
        foreach($buildings as $key => $build){
            if(in_array($build['type'], [31,32,33,42,43]))
                continue;
            if($build['type']>0 && $build['level']>0){
                $free[] = $build;
            }
        }
        if(!sizeof($free)) return 0;
        shuffle($free);
        $find = $free[mt_rand(0, sizeof($free)-1)];
        return $find ? $find : 0;
    }

    function getCatapultTarget($buildings,$selectedValue=999){
        if ($selectedValue != 999) {
            foreach($buildings as $key => $build){
                if($build['type'] == $selectedValue){
                    return $build;
                }
            }
        }
        return $this->getRandomTarget($buildings);
    }

    function canClaimArtifact($from, $type) {
        global $database,$hero_model;
        $DefenderFields = $this->build;
        $defcanclaim = TRUE;
        
        $attacker = $database->getUserInfoByVillageID($from);
        $count = $database->countOwnedArtefacts($attacker->id);
        if($count==3){
            return false;
        }
        
        for ($i = 19; $i <= 38; $i++) {
            if ($DefenderFields['f' . $i . 't'] == 27) {
                $defTresuaryLevel = $DefenderFields['f' . $i];
                if ($defTresuaryLevel > 0) {
                    $defcanclaim = FALSE;
                } else {
                    $defcanclaim = TRUE;
                }
                break;
            }
        }
        $AttackerFields = $database->getResourceLevel($from);
        for ($i = 19; $i <= 38; $i++) {
            if ($AttackerFields['f' . $i . 't'] == 27) {
                $attTresuaryLevel = $AttackerFields['f' . $i];
                if ($attTresuaryLevel >= 10) {
                    $villageartifact = TRUE;
                } else {
                    $villageartifact = FALSE;
                }
                if ($attTresuaryLevel >= 20) {
                    $accountartifact = TRUE;
                } else {
                    $accountartifact = FALSE;
                }
                break;
            }
        }
        if ($type == 1) {
            if ($defcanclaim == TRUE && $villageartifact == TRUE) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else if ($type == 2 || $type == 3) {
            if ($defcanclaim == TRUE && $accountartifact == TRUE) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    private function Usercantake($vref, $wref, $how) {
        global $database,$hero_model;
        $HeroMansionLevel = 0;
        for ($i = 19; $i <= 38; $i++) {
            if ($this->att['f' . $i . 't'] == 37) {
                $HeroMansionLevel = $this->att['f' . $i];
            }
        }
        if ($how < floor(($HeroMansionLevel - 5) / 5)) {
            $OasisInfo = $database->getOasisInfo($wref);
            $troopcount = $database->countOasisTroops($wref);
            if ($OasisInfo['conqured'] == 0 || $OasisInfo['conqured'] != 0 && $troopcount == 0) {
                $CoordsVillage = $database->getCoor($vref);

                $x = $CoordsVillage['x'];
                $y = $CoordsVillage['y'];

                $xm3 = ($x - 3) < -WORLD_MAX ? $x + WORLD_MAX + WORLD_MAX - 2 : $x - 3;
                $xm2 = ($x - 2) < -WORLD_MAX ? $x + WORLD_MAX + WORLD_MAX - 1 : $x - 2;
                $xm1 = ($x - 1) < -WORLD_MAX ? $x + WORLD_MAX + WORLD_MAX : $x - 1;
                $xp1 = ($x + 1) > WORLD_MAX ? $x - WORLD_MAX - WORLD_MAX : $x + 1;
                $xp2 = ($x + 2) > WORLD_MAX ? $x - WORLD_MAX - WORLD_MAX + 1 : $x + 2;
                $xp3 = ($x + 3) > WORLD_MAX ? $x - WORLD_MAX - WORLD_MAX + 2 : $x + 3;
                $ym3 = ($y - 3) < -WORLD_MAX ? $y + WORLD_MAX + WORLD_MAX - 2 : $y - 3;
                $ym2 = ($y - 2) < -WORLD_MAX ? $y + WORLD_MAX + WORLD_MAX - 1 : $y - 2;
                $ym1 = ($y - 1) < -WORLD_MAX ? $y + WORLD_MAX + WORLD_MAX : $y - 1;
                $yp1 = ($y + 1) > WORLD_MAX ? $y - WORLD_MAX - WORLD_MAX : $y + 1;
                $yp2 = ($y + 2) > WORLD_MAX ? $y - WORLD_MAX - WORLD_MAX + 1 : $y + 2;
                $yp3 = ($y + 3) > WORLD_MAX ? $y - WORLD_MAX - WORLD_MAX + 2 : $y + 3;
                $xarray = array($xm3, $xm2, $xm1, $x, $xp1, $xp2, $xp3);
                $yarray = array($ym3, $ym2, $ym1, $y, $yp1, $yp2, $yp3);
                $xcount = 0;

                $maparray2 = array();
                for ($i = 0; $i <= 6; $i++) {
                    if ($xcount != 7) {
                        $maparray2[] = $database->getBaseID(
						$xarray[$xcount], 
						$yarray[$i]);
                        if ($i == 6) {
                            $i = -1;
                            $xcount +=1;
                        }
                    }
                }
                if (in_array($wref, $maparray2)) {
                    return True;
                } else {
                    return False;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function clearDeleting($id) {
        global $database,$hero_model;
        $time = time();
        
        if(!$database->isDeleting($id)){return true;}
        
        $needVillage = $database->getVillID($id);
        foreach ($needVillage as $village) {
            $database->DelVillage($village);
            $getmovement = $database->getMovement(3, $village, 1);
            foreach ($getmovement as $movedata) {
                $time2 = $movedata['endtime'] - $movedata['starttime'];
                $database->addMovement(4, $movedata['to'], $movedata['from'], $movedata['ref'], $time, $time + $time2);
                $database->insertQueue($movedata['ref'], 2, $time, ($time + $time2));
                $database->setMovementProc($movedata['moveid']);
            }

            $enforcement = $database->getEnforceVillage($village, 0);
            foreach ($enforcement as $enforce) {

                $fromcoor = $database->getCoor($enforce['vref']);
                $tocoor = $database->getCoor($enforce['from']);
                $tribeid = $database->getUserInfoByVillageID($enforce['from']);
                $targettribe = $tribeid['tribe'];
                $speeds = array();

                //find slowest unit.
                $unitarray = array();
                for ($i = 1; $i <= 10; $i++) {
                    if ($enforce['u' . $i] > 0) {
                        if ($unitarray) {
                            reset($unitarray);
                        }
                        global ${"u" . (($targettribe - 1) * 10 + $i)};
                        $unitarray = $unitarray = ${"u" . (($targettribe - 1) * 10 + $i)};
                        $speeds[] = $unitarray['speed'];
                    }
                }
                if ($enforce['u11'] > 0) {
                    $herod = $database->getHeroData($tribeid['id']);
                    $speeds[] = $herod['speed'];
                }
                $fastertroops = $database->checkArtefactsEffects($tribeid['id'], $enforce['from'], 2);
                $time2 = round($database->procDistanceTime($tocoor, $fromcoor, min($speeds), 1, $enforce['from']) / $fastertroops);


                $reference = $database->addAttack($enforce['from'], $enforce['u1'], $enforce['u2'], $enforce['u3'], $enforce['u4'], $enforce['u5'], $enforce['u6'], $enforce['u7'], $enforce['u8'], $enforce['u9'], $enforce['u10'], $enforce['u11'], 2, 0, 0, 0, 0);
                $database->addMovement(4, $enforce['vref'], $enforce['from'], $reference, $time, $time + $time2);
                $database->insertQueue($reference, 2, $time, ($time + $time2));
                $q = "DELETE FROM enforcement where id = '" . $enforce['id'] . "'";
                $database->query($q);
            }
        }
        $q = "UPDATE odata SET `conqured` = '0',`owner` = '2'  where owner = '" . $id . "'";
        $database->query($q);
        $q = "DELETE FROM hero where uid = '" . $id . "'";
        $database->query($q);

        $userinfa = $database->query("SELECT gold,email FROM users WHERE `id`='" . $id . "'");
        $q = "DELETE FROM users where id = '" . $id . "'";
        $database->query($q);
        if ($userinfa[0]['gold'] > DEFAULT_GOLD) {
            $line1 = $database->query("SELECT * FROM `bank` WHERE `email`='" . $userinfa[0]['email'] . "'");
            $line01 = count($line1);
            if ($line01 > 0) {
                $database->query("UPDATE `bank` SET `gold`=`gold`+" . ($userinfa[0]['gold'] - DEFAULT_GOLD) . " WHERE `email`='" . $userinfa[0]['email'] . "'");
            } else {
                $database->query("INSERT INTO `bank` (`id`,`email`,`gold`) VALUES ('0','" . $userinfa[0]['email'] . "','" . ($userinfa[0]['gold'] - DEFAULT_GOLD) . "')");
            }
        }
        $q = "DELETE FROM users where id = '" . $id . "'";
        $database->query($q);
        return true;
    }

    function marketComplete($id) {
        global $database,$hero_model;

        $q = "SELECT * FROM movement where proc = 0 and moveid = '" . $id . "'";
        $mark = $database->query($q);
        if (!count($mark)) {
            $this->DelTrash($id, 7);
            return true;
        }
        if (count($mark) > 0) {
            $data = $mark[0];
            $database->setMovementProc($data['moveid']);
            $sort_type = 11;
            if ($data['wood'] >= $data['clay'] && $data['wood'] >= $data['iron'] && $data['wood'] >= $data['crop']) {
                $sort_type = 11;
            } elseif ($data['clay'] >= $data['wood'] && $data['clay'] >= $data['iron'] && $data['clay'] >= $data['crop']) {
                $sort_type = 12;
            } elseif ($data['iron'] >= $data['wood'] && $data['iron'] >= $data['clay'] && $data['iron'] >= $data['crop']) {
                $sort_type = 13;
            } elseif ($data['crop'] >= $data['wood'] && $data['crop'] >= $data['clay'] && $data['crop'] >= $data['iron']) {
                $sort_type = 14;
            }
            $def = $database->getUserInfoByVIDDR($data['to']);
            $from = $database->getMInfo($data['from']);
            $topic = "REP_С38 " . $from['name'];
            
            //pillage reports - number of res stolen
            $database->addNotice($def['owner'], 0, 0, $sort_type, '' . $from['owner'] . ',' . $from['wref'] . ',' . $data['wood'] . ',' . $data['clay'] . ',' . $data['iron'] . ',' . $data['crop'] . ',' . $data['to'] . ',' . $def['vname'] . ',' . $def['id'] . ',' . $def['username'] . '', $data['endtime'], $topic);
            if ($from['owner'] != $def['owner']) {
                $topic = "REP_С39 " . $def['vname'];
                
            $database->addNotice($from['owner'], 0, 0, $sort_type, '' . $from['owner'] . ',' . $from['wref'] . ',' . $data['wood'] . ',' . $data['clay'] . ',' . $data['iron'] . ',' . $data['crop'] . ',' . $data['to'] . ',' . $def['vname'] . ',' . $def['id'] . ',' . $def['username'] . '', $data['endtime'], $topic);
            }
            $insumres = $data['wood'] + $data['clay'] + $data['iron'] + $data['crop'];
            $database->modifyResource($data['to'], $data['wood'], $data['clay'], $data['iron'], $data['crop'], 1);
            $endtime = $data['endtime'] + ($data['endtime'] - $data['starttime']);
            $ref = $database->addMovement(2, $data['to'], $data['from'], $data['from'], $data['endtime'], $endtime, $data['send'], $data['wood'], $data['clay'], $data['iron'], $data['crop'], $data['merchant']);
            $database->insertQueue($ref, 8, $data['endtime'], $endtime);

            if ($from['owner'] != $def['owner']) {
                $database->modifyPoints($from['owner'], 'merch', $insumres);
                $infa = "ownerID:" . $from['owner'] . ",biderID:" . $def['owner'] . ",wood:" . $data['wood'] .',clay:'. $data['clay'] .' ,iron:'. $data['iron'] .' ,crop:'. $data['crop'].' ';
                $database->addPalevo($from['owner'], $infa, 97);
                $database->addPalevo($def['owner'], $infa, 96);
            }
            return true;
        }
    }

    function TradeRoute() {
        global $database,$hero_model;
        $time = time();
        $q = "SELECT * FROM route where timestamp < '" . $time . "'";
        $dataarray = $database->query($q);
        foreach ($dataarray as $data) {
            if ($database->getVillageState($data['wid'])) {

                $allres2 = $database->getResVillageField($data['from']);

                if ($allres2['crop'] < 0) {
                    $allres2['crop'] = 0;
                }
                $wtrans = ($allres2['wood'] >= $data['wood']) ? $data['wood'] : $allres2['wood'];
                $ctrans = ($allres2['clay'] >= $data['clay']) ? $data['clay'] : $allres2['clay'];
                $itrans = ($allres2['iron'] >= $data['iron']) ? $data['iron'] : $allres2['iron'];
                $crtrans = ($allres2['crop'] >= $data['crop']) ? $data['crop'] : $allres2['crop'];
                $resourcearray = $database->getResourceLevel($data['from']);
                $lvl = $database->getTypeLevel(17, 0, $resourcearray);
                $merchant2 = ($lvl > 0) ? $lvl : 0;
                $used2 = $database->totalMerchantUsed($data['from']);
                $merchantAvail2 = $merchant2 - $used2;

                $resource = array($wtrans, $ctrans, $itrans, $crtrans);

                if ($merchantAvail2 > 0 && $data['merchant'] <= $merchantAvail2) {
                    $res = $resource[0] + $resource[1] + $resource[2] + $resource[3];
                    if ($res != 0) {
                        $database->modifyResource($data['from'], $resource[0], $resource[1], $resource[2], $resource[3], 0);
                        $ref = $database->addMovement(0, $data['from'], $data['wid'], 0, $time, ($time + $data['timetogo']), $data['deliveries'], $resource[0], $resource[1], $resource[2], $resource[3], $data['merchant']);
                        $database->insertQueue($ref, 7, $time, ($time + $data['timetogo']));
                        
                        $def = $database->getUserInfoByVIDDR($data['wid']);
                        $from = $database->getMInfo($data['from']);
                        $infa = "ownerID:" . $from['owner'] . ",biderID:" . $def['owner'] . ",wood:" . $resource[0] .',clay:'. $resource[1] .' ,iron:'. $resource[2] .' ,crop:'. $resource[3].' ';
                        $database->addPalevo($from['owner'], $infa, 97);
                        $database->addPalevo($def['owner'], $infa, 96);
                    }
                    if($data['deliveries']>1 && $data['deliveries']!=$data['deliveries_done']+1){
                        $database->editTradeRoute($data['id'], "deliveries_done", 1, 1);
                        $database->editTradeRoute($data['id'], "timestamp", ($data['timetogo']*2)+10, 1);//to and back hence 2x
                    }else{
                        $database->editTradeRoute($data['id'], "deliveries_done", $data['deliveries'], 0);
                    }
                    
                }
            }
            $database->editTradeRoute($data['id'], "timestamp", 86400, 1);
        }
    }

    function Market2($id) {
        global $database,$hero_model;
        $q = "SELECT * FROM movement where proc = 0 and moveid = '" . $id . "'";
        $mark2 = $database->query($q);
        if (!count($mark2)) {
            $this->DelTrash($id, 8);
            return true;
        }
        if (count($mark2[0]) > 0) {
            $data = $mark2[0];
            $database->setMovementProc($data['moveid']);

            if ($data['send'] > 1) {
                if ($database->getVillageState($data['from'])) {

                    $allres2 = $database->getResVillageField($data['to']);

                    if ($allres2['crop'] < 0) {
                        $allres2['crop'] = 0;
                    }
                    $wtrans = ($allres2['wood'] >= $data['wood']) ? $data['wood'] : $allres2['wood'];
                    $ctrans = ($allres2['clay'] >= $data['clay']) ? $data['clay'] : $allres2['clay'];
                    $itrans = ($allres2['iron'] >= $data['iron']) ? $data['iron'] : $allres2['iron'];
                    $crtrans = ($allres2['crop'] >= $data['crop']) ? $data['crop'] : $allres2['crop'];
                    $resourcearray = $database->getResourceLevel($data['to']);
                    $lvl = $database->getTypeLevel(17, 0, $resourcearray);
                    $merchant2 = ($lvl > 0) ? $lvl : 0;
                    $used2 = $database->totalMerchantUsed($data['to']);
                    $merchantAvail2 = $merchant2 - $used2;

                    $resource = array($wtrans, $ctrans, $itrans, $crtrans);

                    if ($merchantAvail2 > 0 && $data['merchant'] <= $merchantAvail2) {
                        //echo lol1;

                        $res = $resource[0] + $resource[1] + $resource[2] + $resource[3];
                        //echo lol;
                        if ($res != 0) {
                            //  echo lol;
                            $database->modifyResource($data['to'], $resource[0], $resource[1], $resource[2], $resource[3], 0);
                            $ref = $database->addMovement(0, $data['to'], $data['from'], 0, $data['endtime'], ($data['endtime'] + ($data['endtime'] - $data['starttime'])), ($data['send'] - 1), $resource[0], $resource[1], $resource[2], $resource[3], $data['merchant']);
                            $database->insertQueue($ref, 7, $data['endtime'], ($data['endtime'] + ($data['endtime'] - $data['starttime'])));
                            
                            $def = $database->getUserInfoByVIDDR($data['to']);
                            $from = $database->getMInfo($data['from']);
                            $infa = "ownerID:" . $from['owner'] . ",biderID:" . $def['owner'] . ",wood:" . $resource[0] .',clay:'. $resource[1] .' ,iron:'. $resource[2] .' ,crop:'. $resource[3].' ';
                            $database->addPalevo($from['owner'], $infa, 97);
                            $database->addPalevo($def['owner'], $infa, 96);
                        }
                    }
                }
            }

            return true;
        }
    }

    function demolitionComplete($id) {
        global $database,$hero_model;
        $q = "SELECT * FROM demolition WHERE id='" . $id . "'";
        $dem = $database->query($q);
        if (!count($dem)) {
            $this->DelTrash($id, 9);
            return true;
        }
        if (count($dem) > 0) {
            $vil = $dem[0];
            $TpLv = $database->getFieldTypeLevel($vil['vref'], $vil['buildnumber']);
            $type = $TpLv['type'];
            $level = $TpLv['lvl'];
            $clear = "";
            if ($level == 1) {
                $clear = " ,f" . $vil['buildnumber'] . "t=0";
            }
            $xzz = ($level - 1);
            $q = "UPDATE fdata SET `f" . $vil['buildnumber'] . "`='" . $xzz . "'" . $clear . " WHERE vref='" . $vil['vref'] . "'";
            $database->query($q);
            $pop = $database->getPop($type, $level - 1);
            $database->modifyPop($vil['vref'], $pop[0], 1);
            $database->delDemolition($vil['vref']);
            return true;
        }
    }

    function reviveHero($uid, $vref) {
        global $database,$hero_model;
        $q = "UPDATE hero, units SET hero.dead = '0', hero.health = '100', hero.revivetime = '0', hero.lastupdate = '" . time() . "', units.u11 = 1 WHERE hero.uid = '" . $uid . "' AND units.vref = '" . $vref . "'";
        $database->query($q);
        return true;
    }
    
    function calculateSpeed($units,$casulties,$tribe,$playerID){
        $speeds = array(1);
        for ($i = 1; $i <= 10; $i++) {
            if ($units['t' . $i] > $casulties['t' . $i]) {
                global ${"u" . (($tribe - 1) * 10 + $i)};
                $speeds[] = ${"u" . (($tribe - 1) * 10 + $i)}['speed'];
            }
        }
        if ($units['t11'] > $casulties['t11']) {
            $getHero = $database->getHeroData($playerID);
            $speeds[] = $getHero['speed'];
        }
        
        return $speeds;
    }

    function addToFileLog($string){
        $myFile = dirname(__FILE__)."/testFile.txt";
        $fh = fopen($myFile, 'a') or die("can't open file");
        fwrite($fh, date('c', strtotime("now")).':'.$string.PHP_EOL);
        fclose($fh);
    }

}