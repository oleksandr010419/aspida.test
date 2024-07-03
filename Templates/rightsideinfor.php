<?php
$baracks = "disabled";
$workshop = "disabled";
$stable = "disabled";
$market_ = "disabled";
$builds = $village->resarray;
for ($i = 19; $i <= 40; $i++) {
    if ($builds['f' . $i . 't'] == 19) {
        $baracks = "";
        $bid = $i;
    }
    if ($builds['f' . $i . 't'] == 21) {
        $workshop = "";
        $wid = $i;
    }
    if ($builds['f' . $i . 't'] == 20) {
        $stable = "";
        $sid = $i;
    }
    if ($builds['f' . $i . 't'] == 17) {
        $market_ = "";
        $mid = $i;
        $lvlm = $builds['f' . $i];
    }
}
?>
<div id="sidebarAfterContent" class="sidebar afterContent">
    <div class="sidebarBoxWrapper">
    <div id="sidebarBoxActiveVillage" class="sidebarBox   ">

        <div class="sidebarBoxInnerBox">
            <div class="innerBox header ">
                <div class="buttonsWrapper">
                <button type="button" id="button5229e5254faf9"  class="layoutButton buttonFramed withIcon round    <?php if ($session->plus) {
                    echo 'White';
                } else {
                    echo 'Black';
                } ?> <?= $green ?> <?php echo $workshop; ?>" onclick="return false;" title="<?php
                if (!$session->plus) {
                    echo "" . DIRECT_LINK . "||" . NO_PLUS_ESI . "";
                    if ($workshop == "") {
                        echo "<br /><span class=&quot;warning&quot;>" . dorf1_villageNameBox_7 . " ";
                        echo "</span>";
                    } else {
                        echo "<br /><span class=&quot;warning&quot;>" . dorf1_villageNameBox_7 . ". " . dorf1_villageNameBox_8 . ".";
                        echo "</span>";
                    }
                } else {
                    if ($workshop == "" && $session->plus) {
                        echo "To the workshop||";
                      
                        $min = (($session->tribe - 1) * 10 ) + 7;
                        $max = (($session->tribe - 1) * 10 ) + 8;
						$activeVillageId = $village->wid;
                        $training = $database->query("SELECT * FROM training WHERE `vref` = '" . $activeVillageId . "' AND `unit` <= '" . $max . "' AND `unit` >= '" . $min . "'");

                            $maxTimestamp = 0;
            foreach ($training as $t) {
                if ($t['timestamp'] > $maxTimestamp) {
                    $maxTimestamp = $t['timestamp'];
                }
            }

            if ($maxTimestamp > 0) {
                $trainingDuration = $maxTimestamp - time();
                $hours = floor($trainingDuration / 3600);
                $minutes = floor(($trainingDuration / 60) % 60);
                $seconds = $trainingDuration % 60;
                echo "Training duration: " . sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
            } else {
                echo "Currently, training is not conducted.";
            }
        } else {
                        echo "" . dorf1_villageNameBox_7 . ".<br /><span class=&quot;warning&quot;> " . dorf1_villageNameBox_8 . ".";
                        echo "</span>";
                    }
                }
                ?>">
                    <svg viewBox="0 0 20 18.8" class="workshop"><g class="outline">
                    <path d="M19.73 6l-.45-.22-2.77-.8.49-.43a1.45 1.45 0 0 0 0-2 1.3 1.3 0 0 0-1.9.06l-.48.6-.48-3-3.93.15.12 4.05L13 5l-1.75 2a14.68 14.68 0 0 0-4.32-1.53 3.58 3.58 0 0 0 .17-4.06C6.26.19 4.87-.42 2.71.33A12.12 12.12 0 0 1 4 1a3.11 3.11 0 0 1 1.12 1.29 3.82 3.82 0 0 1-.39 3A16.83 16.83 0 0 1 3 4.64 3.15 3.15 0 0 1 1.56 3.3a5.86 5.86 0 0 1-.69-2 4.42 4.42 0 0 0-.38 4.62 3.56 3.56 0 0 0 3.84 1.32 12 12 0 0 0 .46 6.93l-1.31 1.49a1.29 1.29 0 0 0 .12 1.81l.12.11a1.28 1.28 0 0 0 1.81-.12l.84-.95A12.12 12.12 0 0 0 9 18.8l1.66-1.13A16.33 16.33 0 0 1 8 14.62l1.3-1.45 2.32-2.6a9.7 9.7 0 0 1 .83 1 16.44 16.44 0 0 1 1.87 3.57L16 14.05a12.44 12.44 0 0 0-2-4.72 7.09 7.09 0 0 0-.59-.74l1.75-2 .8 2.87.24.46c.56.55 1.82.11 2.8-1s1.29-2.4.73-2.92zM7.82 10.72l-.6.67-.45.51a13.24 13.24 0 0 1-.53-4.66 13.15 13.15 0 0 1 3.29 1.58z"></path>
                    </g><g class="icon">
                    <path d="M19.73 6l-.45-.22-2.77-.8.49-.43a1.45 1.45 0 0 0 0-2 1.3 1.3 0 0 0-1.9.06l-.48.6-.48-3-3.93.15.12 4.05L13 5l-1.75 2a14.68 14.68 0 0 0-4.32-1.53 3.58 3.58 0 0 0 .17-4.06C6.26.19 4.87-.42 2.71.33A12.12 12.12 0 0 1 4 1a3.11 3.11 0 0 1 1.12 1.29 3.82 3.82 0 0 1-.39 3A16.83 16.83 0 0 1 3 4.64 3.15 3.15 0 0 1 1.56 3.3a5.86 5.86 0 0 1-.69-2 4.42 4.42 0 0 0-.38 4.62 3.56 3.56 0 0 0 3.84 1.32 12 12 0 0 0 .46 6.93l-1.31 1.49a1.29 1.29 0 0 0 .12 1.81l.12.11a1.28 1.28 0 0 0 1.81-.12l.84-.95A12.12 12.12 0 0 0 9 18.8l1.66-1.13A16.33 16.33 0 0 1 8 14.62l1.3-1.45 2.32-2.6a9.7 9.7 0 0 1 .83 1 16.44 16.44 0 0 1 1.87 3.57L16 14.05a12.44 12.44 0 0 0-2-4.72 7.09 7.09 0 0 0-.59-.74l1.75-2 .8 2.87.24.46c.56.55 1.82.11 2.8-1s1.29-2.4.73-2.92zM7.82 10.72l-.6.67-.45.51a13.24 13.24 0 0 1-.53-4.66 13.15 13.15 0 0 1 3.29 1.58z"></path>
                    </g></svg>
                </button>

                <script type="text/javascript">

                            if ($('button5229e5254faf9'))
                    {
                    $('button5229e5254faf9').addEvent('click', function ()
                    {
                    window.fireEvent('buttonClicked', [this, {"type":"<?= $green ?>", "onclick":"return false;", "loadTitle":<?php if ($workshop == "" && $session->plus) {
                    echo "true";
                } else {
                    echo "false";
                } ?>, "boxId":"activeVillage", "disabled":<?php if ($workshop == "" && $session->plus) {
                    echo "false";
                } else {
                    echo "true";
                } ?>, "speechBubble":"", "class":"", "id":"button5229e5254ffa5", "redirectUrl":"<?php if ($workshop == "" && $session->plus) {
                    echo "build.php?id=" . $wid;
                } else {
                    echo "";
                } ?>", "redirectUrlExternal":""<?php if ($workshop == "" && $session->plus) {
                                     echo "";
                                 } else {
                                     echo ",\"plusDialog\":{\"featureKey\":\"directLinks\",\"infoIcon\":\"http:/\/\t4.answers.travian.com.sa\/index.php?aid=\u062a\u0639\u0644\u0651\u0645 \u0627\u0644\u0645\u0632\u064a\u062f#go2answer\"}";
                                 } ?>}]);
                    });
                    }
                </script>
				
				<button type="button" id="button5229e5254fc5c" class="layoutButton buttonFramed withIcon round <?php if ($session->plus) {
                                     echo 'White';
                                 } else {
                                     echo 'Black';
                                 } ?> <?= $green ?> <?php echo $stable; ?> " onclick="return false;" title="<?php
                                 if (!$session->plus) {
                                     echo "" . DIRECT_LINK . "||" . NO_PLUS_ESI . "";
                                     if ($stable == "") {
                                         echo "<br /><span class=&quot;warning&quot;>Build the Stable";
                                         echo "</span>";
                                     } else {
                                         echo "<br /><span class=&quot;warning&quot;>" . dorf1_villageNameBox_5 . ". " . dorf1_villageNameBox_6 . ".";
                                         echo "</span>";
                                     }
                                 } else {
                                     if ($stable == "" && $session->plus) {
                                         echo "To the stable||";
                                         switch ($session->tribe) {
							case 1: $dif = 3; break;
							case 2: $dif = 4; break;
							case 3: $dif = 2; break;
							case 6: $dif = 3; break;
							case 7: $dif = 2; break;
							case 8: $dif = 2; break;
							}

							$min = (($session->tribe - 1) * 10 ) + 1 + $dif;
							$max = (($session->tribe - 1) * 10 ) + 6 ;
							


							// Debugging: Check user ID and village ID
							//echo "User ID: " . $session->uid . "<br>";
							//echo "Active Village ID: " . $village->wid . "<br>";
							// Debugging: Check min and max unit values
							//echo "Min Unit: " . $min . "<br>";
							//echo "Max Unit: " . $max . "<br>";
							// This should be the ID of the active village.
$activeVillageId = $village->wid;

// Adjust the query to filter by the active village ID.
$training = $database->query("SELECT * FROM training WHERE `vref` = '" . $activeVillageId . "' AND `unit` <= '" . $max . "' AND `unit` >= '" . $min . "'");

                            $maxTimestamp = 0;
            foreach ($training as $t) {
                if ($t['timestamp'] > $maxTimestamp) {
                    $maxTimestamp = $t['timestamp'];
                }
            }

            if ($maxTimestamp > 0) {
                $trainingDuration = $maxTimestamp - time();
                $hours = floor($trainingDuration / 3600);
                $minutes = floor(($trainingDuration / 60) % 60);
                $seconds = $trainingDuration % 60;
                echo "Training duration: " . sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
            } else {
                echo "Currently, training is not conducted.";
            }
        } else {
                                         echo "" . dorf1_villageNameBox_5 . ".<br /><span class=&quot;warning&quot;> " . dorf1_villageNameBox_6 . ".";
                                         echo "</span>";
                                     }
                                 }
                ?>">
                    <svg viewBox="0 0 18.46 20" class="barracks"><g class="outline">
                    <path d="M4.32 13.44l.88.56 3-2.51-1.88-1.42a7.16 7.16 0 0 0-2.81 1.25c-.21.48-1 2.74-1 2.74l-1.34.64 1.13-4.07.16-.63a5.27 5.27 0 0 1 10 3.29c-.17 1.14-.15 3 1.39 3.91l.39.32a3.79 3.79 0 0 1-2.05.71c-.82-.14-1.62-2.3-1.62-2.33a1.49 1.49 0 1 0-2.66 1 1.45 1.45 0 0 0 1.13.58A13.32 13.32 0 0 1 1.49 20zM0 1.14l3.93 4.51c1-.14 3.5-1 4.56-.76 4.63 1.2 6.51 5.46 5.41 10.51 1.37 1.17 0 0 3.12 3.15a24.7 24.7 0 0 0 1-3.15 13.83 13.83 0 0 0 .44-3.28L15.66 11l2.73-.34a12.59 12.59 0 0 0-1.8-5.36l-3.67 1.44 2.82-2.69A10.8 10.8 0 0 0 11.5.83l-2 3.43.75-3.86-.2-.06A10.61 10.61 0 0 0 6.14.07l.41 3.09L5.09.25A18.06 18.06 0 0 0 0 1.14z"></path>
                    </g><g class="icon">
                    <path d="M4.32 13.44l.88.56 3-2.51-1.88-1.42a7.16 7.16 0 0 0-2.81 1.25c-.21.48-1 2.74-1 2.74l-1.34.64 1.13-4.07.16-.63a5.27 5.27 0 0 1 10 3.29c-.17 1.14-.15 3 1.39 3.91l.39.32a3.79 3.79 0 0 1-2.05.71c-.82-.14-1.62-2.3-1.62-2.33a1.49 1.49 0 1 0-2.66 1 1.45 1.45 0 0 0 1.13.58A13.32 13.32 0 0 1 1.49 20zM0 1.14l3.93 4.51c1-.14 3.5-1 4.56-.76 4.63 1.2 6.51 5.46 5.41 10.51 1.37 1.17 0 0 3.12 3.15a24.7 24.7 0 0 0 1-3.15 13.83 13.83 0 0 0 .44-3.28L15.66 11l2.73-.34a12.59 12.59 0 0 0-1.8-5.36l-3.67 1.44 2.82-2.69A10.8 10.8 0 0 0 11.5.83l-2 3.43.75-3.86-.2-.06A10.61 10.61 0 0 0 6.14.07l.41 3.09L5.09.25A18.06 18.06 0 0 0 0 1.14z"></path>
                    </g></svg>
                </button>

                <script type="text/javascript">

                            if ($('button5229e5254fc5c'))
                    {
                    $('button5229e5254fc5c').addEvent('click', function ()
                    {
                    window.fireEvent('buttonClicked', [this, {"type":"<?= $green ?>", "onclick":"return false;", "loadTitle":<?php if ($stable == "" && $session->plus) {
                    echo "true";
                } else {
                    echo "false";
                } ?>, "boxId":"activeVillage", "disabled":<?php if ($stable == "" && $session->plus) {
                    echo "false";
                } else {
                    echo "true";
                } ?>, "speechBubble":"", "class":"", "id":"button5229e5254ffa5", "redirectUrl":"<?php if ($stable == "" && $session->plus) {
                    echo "build.php?id=" . $sid;
                } else {
                    echo "";
                } ?>", "redirectUrlExternal":""<?php if ($stable == "" && $session->plus) {
                    echo "";
                } else {
                    echo ",\"plusDialog\":{\"featureKey\":\"directLinks\",\"infoIcon\":\"http:/\/\t4.answers.travian.com.sa\/index.php?aid=\u062a\u0639\u0644\u0651\u0645 \u0627\u0644\u0645\u0632\u064a\u062f#go2answer\"}";
                } ?>}]);
                    });
                    }
                </script>
				
				
                <button type="button" id="button5229e5254fe6f"  class="layoutButton buttonFramed withIcon round <?php if ($session->plus) {
                        echo 'White';
                    } else {
                        echo 'Black';
                    } ?> <?= $green ?> <?php echo $baracks; ?> " onclick="return false;" title="
                    <?php
					//echo '<pre>';
					//print_r($session);
					//echo '</pre>';
					
					
                    if (!$session->plus) {
                        echo "" . DIRECT_LINK . "||" . NO_PLUS_ESI . "";
                        if ($baracks == "") {
                            echo "<br /><span class=&quot;warning&quot;>Build baracks";
                            echo "</span>";
                        } else {
                            echo "<br /><span class=&quot;warning&quot;>" . dorf1_villageNameBox_3 . ". " . dorf1_villageNameBox_4 . ".";
                            echo "</span>";
                        }
                    } else {
                        if ($baracks == "" && $session->plus) {
                            echo "To the baracks||";
                            switch ($session->tribe) {
							case 1: $dif = 3; break;
							case 2: $dif = 4; break;
							case 3: $dif = 2; break;
							case 6: $dif = 3; break;
							case 7: $dif = 2; break;
							case 8: $dif = 2; break;
							}

							$min = (($session->tribe - 1) * 10 ) + 1;
							$max = $min + $dif - 1;
							


							// Debugging: Check user ID and village ID
							//echo "User ID: " . $session->uid . "<br>";
							//echo "Active Village ID: " . $village->wid . "<br>";
							// Debugging: Check min and max unit values
							//echo "Min Unit: " . $min . "<br>";
							//echo "Max Unit: " . $max . "<br>";
							// This should be the ID of the active village.
$activeVillageId = $village->wid;

// Adjust the query to filter by the active village ID.
$training = $database->query("SELECT * FROM training WHERE `vref` = '" . $activeVillageId . "' AND `unit` <= '" . $max . "' AND `unit` >= '" . $min . "'");

                            $maxTimestamp = 0;
            foreach ($training as $t) {
                if ($t['timestamp'] > $maxTimestamp) {
                    $maxTimestamp = $t['timestamp'];
                }
            }

            if ($maxTimestamp > 0) {
                $trainingDuration = $maxTimestamp - time();
                $hours = floor($trainingDuration / 3600);
                $minutes = floor(($trainingDuration / 60) % 60);
                $seconds = $trainingDuration % 60;
                echo "Training duration: " . sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
            } else {
                echo "Currently, training is not conducted.";
            }
        } else {
                            echo "" . dorf1_villageNameBox_3 . ".<br /><span class=&quot;warning&quot;> " . dorf1_villageNameBox_4 . ".";
                            echo "</span>";
                        }
                    }
                    ?>">
                    <svg viewBox="0 0 19.07 20" class="stable"><g class="outline">
                    <path d="M0 13.31a.79.79 0 0 0 .38.69 2.06 2.06 0 0 0 2 1.66h.33a2 2 0 0 0 1.67-1.68A8.12 8.12 0 0 0 6.76 13c.88-.51 1.87-1.23 2-2 .48-1.78-1.69-2.77-1.59-2.89 2.19.76 2.29 2 2.09 4.17 0 .35-2.42 6.68-2.57 7.11 1.37.81 2.36.71 5.15.31 1.55-.58 3.58-2.36 4.82-3a24.9 24.9 0 0 0 1.15-2.92 10.38 10.38 0 0 0-.24-3.46v-.05a7.48 7.48 0 0 1 1.52.77c0-.05-1.72-2.45-2.08-3a11.18 11.18 0 0 0-.79-.95 8.33 8.33 0 0 0-2.33-1.51 16 16 0 0 1 1.64-.05c-.92-.51-1.08-.88-5.64-2.45a12.52 12.52 0 0 1-1.61-.53A5 5 0 0 0 6.63.29 1.82 1.82 0 0 0 5.6 0a17.54 17.54 0 0 1 .17 1.75c.05.8.08 1.53.08 1.53l-.15.16-.49-.28-1.63-.94a5.07 5.07 0 0 0 .78 2.55c-.34.28-.62.7-.87.65s-.93.72-.93.72c-.25.51.14 1.23.06 1.9A7.47 7.47 0 0 0 2 9.27a5.85 5.85 0 0 0-.39 1.44l-1 1.82a.8.8 0 0 0-.61.78zm7.47-9.49c.49.05 5.82 1.87 7.72 5.31a9 9 0 0 1 .81 6.92s-.66-4.38-1.8-6.22c-1.29-2.07-1.22-2-4.42-4.19-1.18-.82-2.21-1.8-2.31-1.82zM3.55 8c0-.48.23-1.37.71-1.37h.48c.33 0 .61.1.61.42a1.16 1.16 0 0 1-.54.85.93.93 0 0 1-.55.2c-.48-.04-.71.35-.71-.1z"></path>
                    </g><g class="icon">
                    <path d="M0 13.31a.79.79 0 0 0 .38.69 2.06 2.06 0 0 0 2 1.66h.33a2 2 0 0 0 1.67-1.68A8.12 8.12 0 0 0 6.76 13c.88-.51 1.87-1.23 2-2 .48-1.78-1.69-2.77-1.59-2.89 2.19.76 2.29 2 2.09 4.17 0 .35-2.42 6.68-2.57 7.11 1.37.81 2.36.71 5.15.31 1.55-.58 3.58-2.36 4.82-3a24.9 24.9 0 0 0 1.15-2.92 10.38 10.38 0 0 0-.24-3.46v-.05a7.48 7.48 0 0 1 1.52.77c0-.05-1.72-2.45-2.08-3a11.18 11.18 0 0 0-.79-.95 8.33 8.33 0 0 0-2.33-1.51 16 16 0 0 1 1.64-.05c-.92-.51-1.08-.88-5.64-2.45a12.52 12.52 0 0 1-1.61-.53A5 5 0 0 0 6.63.29 1.82 1.82 0 0 0 5.6 0a17.54 17.54 0 0 1 .17 1.75c.05.8.08 1.53.08 1.53l-.15.16-.49-.28-1.63-.94a5.07 5.07 0 0 0 .78 2.55c-.34.28-.62.7-.87.65s-.93.72-.93.72c-.25.51.14 1.23.06 1.9A7.47 7.47 0 0 0 2 9.27a5.85 5.85 0 0 0-.39 1.44l-1 1.82a.8.8 0 0 0-.61.78zm7.47-9.49c.49.05 5.82 1.87 7.72 5.31a9 9 0 0 1 .81 6.92s-.66-4.38-1.8-6.22c-1.29-2.07-1.22-2-4.42-4.19-1.18-.82-2.21-1.8-2.31-1.82zM3.55 8c0-.48.23-1.37.71-1.37h.48c.33 0 .61.1.61.42a1.16 1.16 0 0 1-.54.85.93.93 0 0 1-.55.2c-.48-.04-.71.35-.71-.1z"></path>
                    </g></svg>
                </button>
				
				

                <script type="text/javascript">

                            if ($('button5229e5254fe6f'))
                    {
                    $('button5229e5254fe6f').addEvent('click', function ()
                    {
                    window.fireEvent('buttonClicked', [this, {"type":"<?= $green ?>", "onclick":"return false;", "loadTitle":<?php if ($baracks == "" && $session->plus) {
    echo "true";
} else {
    echo "false";
} ?>, "boxId":"activeVillage", "disabled":<?php if ($baracks == "" && $session->plus) {
    echo "false";
} else {
    echo "true";
} ?>, "speechBubble":"", "class":"", "id":"button5229e5254ffa5", "redirectUrl":"<?php if ($baracks == "" && $session->plus) {
    echo "build.php?id=" . $bid;
} else {
    echo "";
} ?>", "redirectUrlExternal":""<?php if ($baracks == "" && $session->plus) {
    echo "";
} else {
    echo ",\"plusDialog\":{\"featureKey\":\"directLinks\",\"infoIcon\":\"http:/\/\t4.answers.travian.com.sa\/index.php?aid=\u062a\u0639\u0644\u0651\u0645 \u0627\u0644\u0645\u0632\u064a\u062f#go2answer\"}";
} ?>}]);
                    });
                    }
                </script>
				<button type="button" id="button5229e5254ffa5" class="layoutButton buttonFramed withIcon round <?php if ($session->plus) {
    echo 'White';
} else {
    echo 'Black';
} ?> <?= $green ?> <?php echo $market_; ?> " onclick="return false;" title="<?php
if (!$session->plus) {
    echo "" . DIRECT_LINK . "||" . NO_PLUS_ESI . "";
    if ($market_ == "") {
        echo "To the marketplace||";
    } else {
        echo "<br /><span class=&quot;warning&quot;>" . dorf1_villageNameBox_1 . ". " . dorf1_villageNameBox_2 . ".";
        echo "</span>";
    }
} else {
    if ($market_ == "" && $session->plus) {
        echo "To the marketplace||";

        echo FREE_MERCHANTS  . ($lvlm - $database->totalMerchantUsed($village->wid)) . "/" . ($lvlm);
    } else {
        echo "" . dorf1_villageNameBox_1 . ".<br /><span class=&quot;warning&quot;> " . dorf1_villageNameBox_2 . ".";
        echo "</span>";
    }
}
?>">
                    <svg viewBox="0 0 20.21 18" class="market"><g class="outline">
                    <path d="M17.12 7L17 3.43h1V2h-6V1h-1V0H9v1H8v1H2v1.43h1L2.92 6.9C1.89 7.47 0 8.71 0 10.14a3.58 3.58 0 1 0 7.15 0c0-1.47-2-2.74-3-3.29L4 3.43h5V15H8v1H6v1H5v1h10v-1h-1v-1h-2v-1h-1V3.43h5L15.9 7c-1 .54-3 1.81-3 3.29a3.67 3.67 0 0 0 3.75 3.5 3.75 3.75 0 0 0 3.57-3.57c-.01-1.49-2.07-2.66-3.1-3.22zm-3.58 3.2c0-1 1.59-1.85 2.46-2.24.32-.15.55-.23.55-.23s.26.1.63.27c.87.4 2.36 1.24 2.36 2.2 0 1.37-6 1.37-6 0zm-13 0C.53 9.21 2.11 8.35 3 8c.33-.15.55-.23.55-.23s.26.1.63.27c.88.4 2.37 1.24 2.37 2.2-.02 1.33-6.02 1.33-6.02-.04z"></path>
                    </g><g class="icon">
                    <path d="M17.12 7L17 3.43h1V2h-6V1h-1V0H9v1H8v1H2v1.43h1L2.92 6.9C1.89 7.47 0 8.71 0 10.14a3.58 3.58 0 1 0 7.15 0c0-1.47-2-2.74-3-3.29L4 3.43h5V15H8v1H6v1H5v1h10v-1h-1v-1h-2v-1h-1V3.43h5L15.9 7c-1 .54-3 1.81-3 3.29a3.67 3.67 0 0 0 3.75 3.5 3.75 3.75 0 0 0 3.57-3.57c-.01-1.49-2.07-2.66-3.1-3.22zm-3.58 3.2c0-1 1.59-1.85 2.46-2.24.32-.15.55-.23.55-.23s.26.1.63.27c.87.4 2.36 1.24 2.36 2.2 0 1.37-6 1.37-6 0zm-13 0C.53 9.21 2.11 8.35 3 8c.33-.15.55-.23.55-.23s.26.1.63.27c.88.4 2.37 1.24 2.37 2.2-.02 1.33-6.02 1.33-6.02-.04z"></path>
                    </g></svg>

                </button>

                <script type="text/javascript">

                            if ($('button5229e5254ffa5'))
                    {
                    $('button5229e5254ffa5').addEvent('click', function ()
                    {
                    window.fireEvent('buttonClicked', [this, {"type":"<?= $green ?>", "onclick":"return false;", "loadTitle":<?php if ($market_ == "" && $session->plus) {
                    echo "true";
                } else {
                    echo "false";
                } ?>, "boxId":"activeVillage", "disabled":<?php if ($market_ == "" && $session->plus) {
                    echo "false";
                } else {
                    echo "true";
                } ?>, "speechBubble":"", "class":"", "id":"button5229e5254ffa5", "redirectUrl":"<?php if ($market_ == "" && $session->plus) {
                    echo "build.php?id=" . $mid;
                } else {
                    echo "";
                } ?>", "redirectUrlExternal":""<?php if ($market_ == "" && $session->plus) {
                    echo "";
                } else {
                    echo ",\"plusDialog\":{\"featureKey\":\"directLinks\",\"infoIcon\":\"http:/\/\t4.answers.travian.com.sa\/index.php?aid=\u062a\u0639\u0644\u0651\u0645 \u0627\u0644\u0645\u0632\u064a\u062f#go2answer\"}";
                } ?>}]);
                    });
                    }
                </script>               
                <div class="clear"></div>
            </div>
        </div>
        <div class="innerBox content">
            <div id="villageName" class="boxTitle"><?php echo $village->vname; ?></div>
            <div class="loyalty medium">
                <?php echo LOYALTY; ?>: <span>‏ <?php echo ceil($village->loyalty); ?>%‏</span>
            </div>
            <div class="innerBox footer">                   
                <button type="button" id="button5229e5255021d"  class="layoutButton editWhite green  " onclick="return false;" title="<?php echo dorf1_villageNameBox_16; ?>">
                    <div class="button-container addHoverClick">
                        <img src="img/x.gif" alt="" />
                    </div>
                </button>
                <script type="text/javascript">

                            if ($('button5229e5255021d'))
                    {
                    $('button5229e5255021d').addEvent('click', function ()
                    {
                    window.fireEvent('buttonClicked', [this, {"type":"green", "onclick":"return false;", "loadTitle":false, "boxId":"", "disabled":false, "speechBubble":"", "class":"", "id":"button5229e5255021d", "redirectUrl":"", "redirectUrlExternal":"", "title":"\u0627\u0646\u0642\u0631 \u0647\u0646\u0627 \u0645\u0631\u062a\u064a\u0646 \u0644\u062a\u063a\u064a\u0651\u0631 \u0627\u0633\u0645 \u0642\u0631\u064a\u062a\u0643", "villageDialog":{"title":"<?= CHANGING_YOUR_VILLAGE_NAME ?>:", "description":"<?= NEW_NAME ?>:", "saveText":"<?= SAVE ?>", "villageId":"<?php echo $village->wid; ?>"}}]);
                    });
                    }
                </script>


                
                <button type="button" id="button5229e5254fe6f"  class="layoutButton attack <?php if ($session->offbonus < time()) {
                        echo 'gold';
                    } else {
                        echo 'green';
                    } ?>" onclick="<?php if ($session->offbonus < time()) {echo "window.fireEvent('startPaymentWizard', {}); this.blur(); return false;";}else{echo "return false";}?>"
                    title="<?php if ($session->offbonus < time()) {echo "Buy Offence bonus!";}else{ 
                        $tl_b4 = $session->offbonus;    
                        $date2 = time();
                        $holdtotmin4 = (($tl_b4 - $date2) / 60);
                        $holdtothr4 = (($tl_b4 - $date2) / 3600);
                        $holdtotday4 = intval(($tl_b4 - $date2) / 86400);
                        $holdhr4 = intval($holdtothr4 - ($holdtotday4 * 24));
                        $holdmr4 = intval($holdtotmin4 - (($holdhr4 * 60) + ($holdtotday4 * 1440)));        

                        echo "Offence bonus active <font color='#B3B3B3' size='1'>" . pluss28 . ": <b> " . $holdtotday4 . "</b> " . pluss29 . " ";
                        echo "<b>  <span id='time31'>" . ($holdhr4) . "</span></b> " . pluss30 . " ";
                        echo "<b>  " . ($holdmr4) . "</b> " . pluss31 . "</font>";                        
                        }?>">
                    <div class="button-container addHoverClick">
                        <img class="iReport iReport3" src="img/x.gif" alt="" />
                    </div>
                </button>

                <button type="button" id="button5229e5254fe6f"  class="layoutButton defence <?php if ($session->defbonus < time()) {
                        echo 'gold';
                    } else {
                        echo 'green';
                    } ?>" onclick="<?php if ($session->defbonus < time()) {echo "window.fireEvent('startPaymentWizard', {}); this.blur(); return false;";}else{echo "return false";}?>"
                    title="<?php 
                    if ($session->defbonus < time()) {
                        echo "Buy Defence bonus!";}else{
                        $tl_b4 = $session->defbonus;    
                        $date2 = time();
                        $holdtotmin4 = (($tl_b4 - $date2) / 60);
                        $holdtothr4 = (($tl_b4 - $date2) / 3600);
                        $holdtotday4 = intval(($tl_b4 - $date2) / 86400);
                        $holdhr4 = intval($holdtothr4 - ($holdtotday4 * 24));
                        $holdmr4 = intval($holdtotmin4 - (($holdhr4 * 60) + ($holdtotday4 * 1440)));        

                        echo "Defence bonus active <font color='#B3B3B3' size='1'>" . pluss28 . ": <b> " . $holdtotday4 . "</b> " . pluss29 . " ";
                        echo "<b>  <span id='time31'>" . ($holdhr4) . "</span></b> " . pluss30 . " ";
                        echo "<b>  " . ($holdmr4) . "</b> " . pluss31 . "</font>";
                    }?>">
                    <div class="button-container addHoverClick">
                        <img class="iReport iReport5" src="img/x.gif" alt="" />
                    </div>
                </button>
                
            </div>
        </div>
        </div>
    </div>
    <div id="sidebarBoxVillagelist" class="sidebarBox toggleable collapsed ">

            <div class="innerBox header ">
                <div class="buttonsWrapper">

                    <button type="button" id="button5229e52550762"  class="layoutButton buttonFramed withIcon round green  " onclick="return false;" title="<?php echo dorf1_villageNameBox2_1; ?>">
                        <svg viewBox="0 0 20 14.92" class="overview"><g class="outline">
                        <path d="M10 1.41c4.61 0 8.34 6.05 8.34 6.05s-3.73 6.05-8.34 6.05-8.34-6-8.34-6 3.73-6 8.34-6M10 0C7.7 0 5.38 1.16 3.1 3.44A20.17 20.17 0 0 0 .46 6.72L0 7.46l.46.74a20.17 20.17 0 0 0 2.64 3.28c2.28 2.28 4.6 3.44 6.9 3.44s4.62-1.16 6.9-3.44a20.17 20.17 0 0 0 2.64-3.28l.46-.74-.46-.74a20.17 20.17 0 0 0-2.64-3.28C14.62 1.16 12.3 0 10 0zm.08 11.64a4.5 4.5 0 1 1 4.49-4.49 4.5 4.5 0 0 1-4.49 4.49zm0-7.88a3.39 3.39 0 1 0 3.38 3.39 3.39 3.39 0 0 0-3.38-3.39zm0 5.92a2.53 2.53 0 1 1 2.52-2.53 2.53 2.53 0 0 1-2.52 2.53z"></path>
                        </g><g class="icon">
                        <path d="M10 1.41c4.61 0 8.34 6.05 8.34 6.05s-3.73 6.05-8.34 6.05-8.34-6-8.34-6 3.73-6 8.34-6M10 0C7.7 0 5.38 1.16 3.1 3.44A20.17 20.17 0 0 0 .46 6.72L0 7.46l.46.74a20.17 20.17 0 0 0 2.64 3.28c2.28 2.28 4.6 3.44 6.9 3.44s4.62-1.16 6.9-3.44a20.17 20.17 0 0 0 2.64-3.28l.46-.74-.46-.74a20.17 20.17 0 0 0-2.64-3.28C14.62 1.16 12.3 0 10 0zm.08 11.64a4.5 4.5 0 1 1 4.49-4.49 4.5 4.5 0 0 1-4.49 4.49zm0-7.88a3.39 3.39 0 1 0 3.38 3.39 3.39 3.39 0 0 0-3.38-3.39zm0 5.92a2.53 2.53 0 1 1 2.52-2.53 2.53 2.53 0 0 1-2.52 2.53z"></path>
                        </g></svg>
                    </button>

                    <script type="text/javascript">

                                if ($('button5229e52550762'))
                        {
                        $('button5229e52550762').addEvent('click', function ()
                        {
                        window.fireEvent('buttonClicked', [this, {"type":"green", "onclick":"return false;", "loadTitle":false, "boxId":"", "disabled":false, "speechBubble":"", "class":"", "id":"button5229e52550762", "redirectUrl":"dorf3.php", "redirectUrlExternal":""}]);
                        });
                        }
                    </script>

                    <button type="button" id="buttonBuild" class="layoutButton buttonFramed withIcon round green build<?= $_COOKIE['builder'] ?>  green"
                            title="Enable this button to construct by clicking on the field" onclick="return false;">
                            <svg viewBox="0 0 20 14.92" class="overview"><g class="outline">
                            <path d="M10 1.41c4.61 0 8.34 6.05 8.34 6.05s-3.73 6.05-8.34 6.05-8.34-6-8.34-6 3.73-6 8.34-6M10 0C7.7 0 5.38 1.16 3.1 3.44A20.17 20.17 0 0 0 .46 6.72L0 7.46l.46.74a20.17 20.17 0 0 0 2.64 3.28c2.28 2.28 4.6 3.44 6.9 3.44s4.62-1.16 6.9-3.44a20.17 20.17 0 0 0 2.64-3.28l.46-.74-.46-.74a20.17 20.17 0 0 0-2.64-3.28C14.62 1.16 12.3 0 10 0zm.08 11.64a4.5 4.5 0 1 1 4.49-4.49 4.5 4.5 0 0 1-4.49 4.49zm0-7.88a3.39 3.39 0 1 0 3.38 3.39 3.39 3.39 0 0 0-3.38-3.39zm0 5.92a2.53 2.53 0 1 1 2.52-2.53 2.53 2.53 0 0 1-2.52 2.53z"></path>
                            </g><g class="icon">
                            <path d="M10 1.41c4.61 0 8.34 6.05 8.34 6.05s-3.73 6.05-8.34 6.05-8.34-6-8.34-6 3.73-6 8.34-6M10 0C7.7 0 5.38 1.16 3.1 3.44A20.17 20.17 0 0 0 .46 6.72L0 7.46l.46.74a20.17 20.17 0 0 0 2.64 3.28c2.28 2.28 4.6 3.44 6.9 3.44s4.62-1.16 6.9-3.44a20.17 20.17 0 0 0 2.64-3.28l.46-.74-.46-.74a20.17 20.17 0 0 0-2.64-3.28C14.62 1.16 12.3 0 10 0zm.08 11.64a4.5 4.5 0 1 1 4.49-4.49 4.5 4.5 0 0 1-4.49 4.49zm0-7.88a3.39 3.39 0 1 0 3.38 3.39 3.39 3.39 0 0 0-3.38-3.39zm0 5.92a2.53 2.53 0 1 1 2.52-2.53 2.53 2.53 0 0 1-2.52 2.53z"></path>
                            </g></svg>
                    </button>
                    <script type="text/javascript">

                                if ($('buttonBuild'))
                        {
                        $('buttonBuild').addEvent('click', function ()
                        {
                        window.fireEvent('buttonClicked', [this, {"type":"green", "onclick":"return false;", "loadTitle":false, "boxId":"", "disabled":false, "speechBubble":"", "class":"", "id":"buttonBuild", "redirectUrl":"<?php echo (($dorf1 == '') ? 'dorf2.php' : 'dorf1.php') . "?builder=" . $another; ?>", "redirectUrlExternal":""}]);
                        });
                        }
                    </script>
                    <div class="clear"></div>
    <?php
    $count = count($session->vvillages);
    $mode = CP;
    $c = 1;
    while (${'cp' . $mode}[$c] < $session->cp) {
        $c++;
    }
    $c--;
    ?>
                </div>

                   
                </div>
            <div class="innerBox content">
                <div class="expansionSlotInfo" title="<?php echo dorf1_villageNameBox2_3; ?> :  <?= $count ?>/<?php echo $c; ?> ‏<br /><?php echo dorf1_villageNameBox2_5; ?>  <?php echo $session->cp; ?> / <?php echo ${'cp' . $mode}[$c + 1]; ?>">
                    
                    <div class="boxTitle"><?php echo dorf1_villageNameBox2_3; ?><span class="slots"><?= $count . "/" . $c ?></span></div>
                    <div class="barWrapper">
                        <div class="bar" style="width:<?php echo (($session->cp / ${'cp' . $mode}[$c + 1]) * 100); ?>%">&nbsp;</div>
                    </div>
                </div>

                <script type="text/javascript">
                    <?php /*window.addEvent('domready', function()
                    {
                        Travian.Translation.add(
                        {
                                'villagelist_collapsed': '<?php echo dorf1_villageNameBox2_2; ?>',
                                'villagelist_expanded': '<?php echo dorf1_villageNameBox2_4; ?>'
                        });
                        var box = $('sidebarBoxVillagelist');
                        if(box){
                            box.down('button.toggle').addEvent('click', function(e)
                            {
                            Travian.Game.Layout.toggleBox(box, 'travian_toggle', 'villagelist');
                            });
                        }
                    }); */?>
                    </script>    
                <div class="villageList">
<?php
$attt = array();
if ($session->plus) {

    $att = $database->getMovement(88, $villmas, 1);
    foreach ($att as $lol) {
        $attt[$lol['to']]+=1;
    }
}
foreach ($session->vvillages as $vil) {
    $village_attack = "";
    $village_title = $vil['name'];
    if ($session->plus) {

        if ($attt[$vil['wref']]) {
            $village_attack = "attack ";
            $village_title = "attacks on this village: " . $attt[$vil['wref']];
        }
    }
    $newquery = explode("&", $_SERVER['QUERY_STRING']);

    if (isset($_GET['newdid']) || isset($_GET['id'])) {
        unset($newquery[0]);
    }
    if (isset($_GET['newdid']) && isset($_GET['id'])) {
        unset($newquery[1]);
    }
    $newquery = implode("&", $newquery);
    if ($_SERVER['PHP_SELF'] == "/build.php") {
        $build = true;
    } else {
        $build = false;
    }
    if ($build && $id > 18) {
        $buildvil = $fff[$vil['wref']];
        $newidbuild = $_GET['id'];
        $exist = 0;
        for ($b = 19; $b <= 40; $b++) {
            if ($buildvil['f' . $b . 't'] == $village->resarray['f' . $_GET['id'] . 't'] && $buildvil['f' . $b] > 0) {

                $newidbuild = $b;
                $exist = 1;
            }
        }
    }
    if (isset($_GET['id'])) {
        $link = "?newdid=" . $vil['wref'] . "&id=" . $_GET['id'] . "&" . $newquery;
    } else {
        $link = "?newdid=" . $vil['wref'] . "&" . $newquery;
    }
    if ($build && $id > 18) {

        if ($newidbuild != $_GET['id']) {
            $link = "?newdid=" . $vil['wref'] . "&id=" . $newidbuild . "&" . $newquery;
        } elseif (!$exist) {
            $link = "?newdid=" . $vil['wref'] . "&id=" . $newidbuild;
        }
    }
    ?>              <div class="dropContainer">
                        <div class="listEntry <?php if ($vil['wref'] == $village->wid) {
        echo "active";
    } ?> <?= $village_attack ?>" title="<?php echo $vil['name']; ?> (<?php echo $vil['vx']; ?>|<?php echo $vil['vy']; ?>)">
                            <a  href="<?= $_SERVER['PHP_SELF'] . $link; ?>" accesskey="b" class="active">
                                <span class="iconAndNameWrapper">
                                    <span class="incomingTroops">
                                        <svg viewBox="0 0 20 19.06" class="attack">
                                        <path d="M16.22 13.08l2.14-2.14-1.37-1.36-1.63 1.63-2.15-2.15 4.74-4.73L19.06 0l-4.32 1.11L10 5.85 5.26 1.11.94 0l1.11 4.33 4.74 4.73-2.15 2.15-1.63-1.63-1.37 1.36 2.14 2.14L0 16.86l2.21 2.2 3.78-3.77 2.13 2.13 1.37-1.37-1.63-1.63L10 12.28l2.14 2.14-1.63 1.63 1.37 1.37 2.14-2.13 3.77 3.77 2.21-2.2-3.78-3.78z"></path>
                                        </svg>
                                    </span>
                                    <span id="vul_<?php echo $vil['name']; ?>" class="name"><?php echo $vil['name']; ?></span>
                                </span>
                                <span class="coordinatesGrid">
                                    ‏<span class="coordinates coordinatesWrapper coordinatesAligned coordinatesltr "><span class="coordinateX">(<?php echo $vil['vx']; ?></span><span class="coordinatePipe">|</span><span class="coordinateY"><?php echo $vil['vy']; ?>)</span></span></a>
                                </span>
                        </div>
                    <?php }
                    ?>
                    </div>
                </div>
            </div>
            <div class="innerBox footer">
            </div>
    </div>





    <div class="sidebarBox   " id="sidebarBoxQuestachievements">

            <div class="innerBox header ">
                <div class="buttonsWrapper">
                    <div class="textButtonV2 buttonFramed rectangle withText withLoadingIndicator ">
                        <div>
                            <?= quest173 ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="innerBox content">
                <div class="boxTitle"><?= quest174 ?></div>     
                <form>
                    <div class="questAchievementContainer">
                        <button onclick="return false;" questbuttonoverviewachievements="1" class="textButtonV2 buttonFramed rectangle withText withLoadingIndicator green" id="button545dec96b3524" value="Подробности" type="submit">
                            <div class="button-container addHoverClick ">
                                <div class="button-background">
                                    <div class="buttonStart">
                                        <div class="buttonEnd">
                                            <div class="buttonMiddle"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-content"><?= quest175 ?></div>
                            </div>
                        </button>
                        <script type="text/javascript">
                                    window.addEvent('domready', function()
                                    {
                                    if ($('button545dec96b3524'))
                                    {
                                    $('button545dec96b3524').addEvent('click', function ()
                                    {
                                    window.fireEvent('buttonClicked', [this, {"type":"submit", "value":"\u041f\u043e\u0434\u0440\u043e\u0431\u043d\u043e\u0441\u0442\u0438", "name":"", "id":"button545dec96b3524", "class":"green questButtonOverviewAchievements", "title":"", "confirm":"", "onclick":"", "questButtonOverviewAchievements":true, "onClick":"return false;"}]);
                                    });
                                    }
                                    });                        </script>
                    </div>
                </form>

                <script type="text/javascript">
                            window.addEvent('domready', function()
                            {
                            Travian.Game.Quest.addListData(
                            {"achievementquests":{"questsTotal":8, "questsCompleted":1, "name":"\u0415\u0436\u0435\u0434\u043d\u0435\u0432\u043d\u044b\u0435 \u0437\u0430\u0434\u0430\u043d\u0438\u044f", "quests":{"AchievementQuest_01":{"id":"AchievementQuest_01", "name":"achievementQuests.achQuest_01_name", "category":"achievementquests", "stepType":"achievementtask", "currentStep":0, "stepCount":1, "steps":[{"stepId":0, "type":"achievementtask", "stepDescription":null}], "answersLink":"http:\/\/t4.answers.travian.ru\/index.php?aid=%%achievementQuests.achQuest_01_answer (ru)%%#go2answer"}, "AchievementQuest_02":{"id":"AchievementQuest_02", "name":"achievementQuests.achQuest_02_name", "category":"achievementquests", "stepType":"achievementtask", "currentStep":0, "stepCount":3, "steps":[{"stepId":0, "type":"achievementtask", "stepDescription":null}, {"stepId":1, "type":"achievementtask", "stepDescription":null}, {"stepId":2, "type":"achievementtask", "stepDescription":null}], "answersLink":"http:\/\/t4.answers.travian.ru\/index.php?aid=%%achievementQuests.achQuest_02_answer (ru)%%#go2answer"}, "AchievementQuest_03":{"id":"AchievementQuest_03", "name":"achievementQuests.achQuest_03_name", "category":"achievementquests", "stepType":"achievementtask", "currentStep":0, "stepCount":3, "steps":[{"stepId":0, "type":"achievementtask", "stepDescription":null}, {"stepId":1, "type":"achievementtask", "stepDescription":null}, {"stepId":2, "type":"achievementtask", "stepDescription":null}], "answersLink":"http:\/\/t4.answers.travian.ru\/index.php?aid=%%achievementQuests.achQuest_03_answer (ru)%%#go2answer"}, "AchievementQuest_04":{"id":"AchievementQuest_04", "name":"achievementQuests.achQuest_04_name", "category":"achievementquests", "stepType":"achievementtask", "currentStep":0, "stepCount":1, "steps":[{"stepId":0, "type":"achievementtask", "stepDescription":null}], "answersLink":"http:\/\/t4.answers.travian.ru\/index.php?aid=%%achievementQuests.achQuest_04_answer (ru)%%#go2answer"}, "AchievementQuest_05":{"id":"AchievementQuest_05", "name":"achievementQuests.achQuest_05_name", "category":"achievementquests", "stepType":"achievementtask", "currentStep":0, "stepCount":3, "steps":[{"stepId":0, "type":"achievementtask", "stepDescription":null}, {"stepId":1, "type":"achievementtask", "stepDescription":null}, {"stepId":2, "type":"achievementtask", "stepDescription":null}], "answersLink":"http:\/\/t4.answers.travian.ru\/index.php?aid=%%achievementQuests.achQuest_05_answer (ru)%%#go2answer"}, "AchievementQuest_07":{"id":"AchievementQuest_07", "name":"achievementQuests.achQuest_07_name", "category":"achievementquests", "stepType":"achievementtask", "currentStep":0, "stepCount":3, "steps":[{"stepId":0, "type":"achievementtask", "stepDescription":null}, {"stepId":1, "type":"achievementtask", "stepDescription":null}, {"stepId":2, "type":"achievementtask", "stepDescription":null}], "answersLink":"http:\/\/t4.answers.travian.ru\/index.php?aid=%%achievementQuests.achQuest_07_answer (ru)%%#go2answer"}, "AchievementQuest_08":{"id":"AchievementQuest_08", "name":"achievementQuests.achQuest_08_name", "category":"achievementquests", "stepType":"achievementtask", "currentStep":0, "stepCount":3, "steps":[{"stepId":0, "type":"achievementtask", "stepDescription":null}, {"stepId":1, "type":"achievementtask", "stepDescription":null}, {"stepId":2, "type":"achievementtask", "stepDescription":null}], "answersLink":"http:\/\/t4.answers.travian.ru\/index.php?aid=%%achievementQuests.achQuest_08_answer (ru)%%#go2answer"}, "AchievementQuest_09":{"id":"AchievementQuest_09", "name":"achievementQuests.achQuest_09_name", "category":"achievementquests", "stepType":"achievementtask", "currentStep":0, "stepCount":3, "steps":[{"stepId":0, "type":"achievementtask", "stepDescription":null}, {"stepId":1, "type":"achievementtask", "stepDescription":null}, {"stepId":2, "type":"achievementtask", "stepDescription":null}], "answersLink":"http:\/\/t4.answers.travian.ru\/index.php?aid=%%achievementQuests.achQuest_09_answer (ru)%%#go2answer"}, "AchievementQuest_10":{"id":"AchievementQuest_10", "name":"achievementQuests.achQuest_10_name", "category":"achievementquests", "stepType":"achievementtask", "currentStep":0, "stepCount":3, "steps":[{"stepId":0, "type":"achievementtask", "stepDescription":null}, {"stepId":1, "type":"achievementtask", "stepDescription":null}, {"stepId":2, "type":"achievementtask", "stepDescription":null}], "answersLink":"http:\/\/t4.answers.travian.ru\/index.php?aid=%%achievementQuests.achQuest_10_answer (ru)%%#go2answer"}}}});
                            });                </script>        </div>
            <div class="innerBox footer">
            </div>
    </div>


                    <?php if ($session->quest != 2047 && QUEST == true && xQUEST != 0) { ?>


        <div id="sidebarBoxQuestmaster" class="sidebarBox   ">
            <div class="sidebarBoxBaseBox">
                <div class="baseBox baseBoxTop">
                    <div class="baseBox baseBoxBottom">
                        <div class="baseBox baseBoxCenter"></div>
                    </div>
                </div>
            </div>
            <div class="sidebarBoxInnerBox">
                <div class="innerBox header ">
                    <button type="button" class="forceDisplayElement vid_<?= $session->tribe ?> " id="questmasterButton">
                        <img src="img/x.gif" alt="" class="border">
                        <img src="img/x.gif" alt="" class="animation ">
                        <img src="img/x.gif" alt="" class="mentor">

                        <div title="" class="bigSpeechBubble newQuestSpeechBubble">
                            <img alt="" src="img/x.gif">
                        </div></button>

                    <button onclick="return false;" class="layoutButton bulbWhite green  " id="button5482f2530cb21" type="button">
                        <div class="button-container addHoverClick">
                            <img alt="" src="img/x.gif">
                        </div>
                    </button>

                    <script type="text/javascript">

                                if ($('button5482f2530cb21'))
                        {
                        $('button5482f2530cb21').addEvent('click', function ()
                        {
                        window.fireEvent('buttonClicked', [this, {"type":"green", "onclick":"return false;", "loadTitle":false, "boxId":"", "disabled":false, "speechBubble":"", "class":"", "id":"button5482f2530cb21", "redirectUrl":"", "redirectUrlExternal":"", "overlay":[]}]);
                        });
                        }
                    </script><div class="clear"></div>

                    <script type="text/javascript">
                        window.addEvent('domready', function()
                        {
                        Travian.Game.Quest.setOptions(
                        {
                        isTutorial : false  });
                                Travian.Game.Quest.animateQuestMaster();
                                // Dialog an den Questmaster binden
                                $('questmasterButton').addEvent('click', function()
                        {
                        Travian.Game.Quest.mentorClick('');
                        });
                        });                </script>
                    <div>
                    </div>      </div>
                <div class="innerBox content">
                    <div class="boxTitle">Task overview</div>

                    <ul id="mentorTaskList" class="notClickable">
                        <?php

                        function questTitle($type, $id) {
                            switch ($type) {
                                case 'war':
                                    switch ($id) {
                                        case 1:
                                            $title = quest1;
                                            $overiew = quest2;
                                            $task = quest3;
                                            $reward = quest4;
                                            $answer = quest5;
                                            break;
                                        case 2:
                                            $title = quest6;
                                            $overiew = quest7;
                                            $task = quest8;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . round(130 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeClay"> <span class="questRewardValue">' . round(150 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeIron"> <span class="questRewardValue">' . round(120 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeCrop"> <span class="questRewardValue">' . round(100 * xQUEST) . '</span>
                            ';
                                            $answer = quest9;
                                            break;
                                        case 3:
                                            $title = quest10;
                                            $overiew = quest11;
                                            $task = quest12;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . round(100 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeClay"> <span class="questRewardValue">' . round(140 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeIron"> <span class="questRewardValue">' . round(160 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeCrop"> <span class="questRewardValue">' . round(30 * xQUEST) . '</span>
                            ';
                                            $answer = quest13;
                                            break;
                                        case 4:
                                            $title = quest14;
                                            $overiew = ""; //вот тут проебал текст задания,только ответка есть
                                            $task = "";
                                            $reward = '<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . round(190 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeClay"> <span class="questRewardValue">' . round(250 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeIron"> <span class="questRewardValue">' . round(150 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeCrop"> <span class="questRewardValue">' . round(110 * xQUEST) . '</span>
                            ';
                                            $answer = quest17;
                                            break;
                                        case 5:
                                            $title = quest18;
                                            $overiew = quest19;
                                            $task = quest20;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeItem item114"> <span class="questRewardValue">' . round(xQUEST) . '</span>
                            ';
                                            $answer = quest21;
                                            break;
                                        case 6:
                                            $title = quest22;
                                            $overiew = quest23;
                                            $task = quest24;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . round(120 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeClay"> <span class="questRewardValue">' . round(120 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeIron"> <span class="questRewardValue">' . round(90 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeCrop"> <span class="questRewardValue">' . round(50 * xQUEST) . '</span>
                            ';
                                            $answer = quest25;
                                            break;
                                        case 7:
                                            $title = quest26; //при отправке
                                            $overiew = quest27;
                                            $task = quest28;
                                            $reward = quest29;
                                            $answer = quest30;
                                            break;
                                        case 8:
                                            $title = quest31;
                                            $overiew = quest32;
                                            $task = quest33;
                                            $reward = quest34;
                                            $answer = quest35;
                                            break;
                                        case 9:
                                            $title = quest36;
                                            $overiew = quest37;
                                            $task = quest38;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . round(280 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeClay"> <span class="questRewardValue">' . round(120 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeIron"> <span class="questRewardValue">' . round(200 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeCrop"> <span class="questRewardValue">' . round(110 * xQUEST) . '</span>
                            ';
                                            $answer = quest39;
                                            break;
                                        case 10:
                                            $title = quest40;
                                            $overiew = quest41;
                                            $task = quest42;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . round(440 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeClay"> <span class="questRewardValue">' . round(290 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeIron"> <span class="questRewardValue">' . round(430 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeCrop"> <span class="questRewardValue">' . round(240 * xQUEST) . '</span>
                            ';
                                            $answer = quest43;
                                            break;
                                        case 11:
                                            $title = quest44;
                                            $overiew = quest45;
                                            $task = quest46;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . round(210 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeClay"> <span class="questRewardValue">' . round(170 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeIron"> <span class="questRewardValue">' . round(245 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeCrop"> <span class="questRewardValue">' . round(115 * xQUEST) . '</span>
                            ';
                                            $answer = quest47;
                                            break;
                                        case 12:
                                            $title = quest48;
                                            $overiew = quest49;
                                            $task = quest50;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . round(450 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeClay"> <span class="questRewardValue">' . round(435 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeIron"> <span class="questRewardValue">' . round(515 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeCrop"> <span class="questRewardValue">' . round(550 * xQUEST) . '</span>
                            ';
                                            $answer = quest51;
                                            break;
                                        case 13:
                                            $title = quest52;
                                            $overiew = quest53;
                                            $task = quest54;
                                            $reward = '
                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . round(500 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeClay"> <span class="questRewardValue">' . round(400 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeIron"> <span class="questRewardValue">' . round(700 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeCrop"> <span class="questRewardValue">' . round(400 * xQUEST) . '</span>
                            ';
                                            $answer = quest55;
                                            break;
                                        case 14:
                                            $title = quest56;
                                            $overiew = quest57;
                                            $task = quest58;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeItem item112"> <span class="questRewardValue">10</span>
                            ';
                                            $answer = quest59;
                                            break;
                                    }
                                    break;
                                case 'economy':
                                    switch ($id) {
                                        case 1:
                                            $title = quest60;
                                            $overiew = quest61;
                                            $task = quest62;
                                            $reward = quest63;
                                            $answer = quest64;
                                            //квест завершается при начале постройки рудника
                                            break;
                                        case 2:
                                            $title = quest65;
                                            $overiew = quest66;
                                            $task = quest67;
                                            $reward = '<img class="questRewardTypeResource questRewardTypeWood" src="img/x.gif"> <span class="questRewardValue">' . round(160 * xQUEST) . '</span>
            <img class="questRewardTypeResource questRewardTypeClay" src="img/x.gif"> <span class="questRewardValue">' . round(190 * xQUEST) . '</span>
            <img class="questRewardTypeResource questRewardTypeIron" src="img/x.gif"> <span class="questRewardValue">' . round(150 * xQUEST) . '</span>
            <img class="questRewardTypeResource questRewardTypeCrop" src="img/x.gif"> <span class="questRewardValue">' . round(70 * xQUEST) . '</span>';
                                            $answer = quest68;
                                            break;
                                        case 3:
                                            $title = quest69;
                                            $overiew = quest70;
                                            $task = quest71;
                                            $reward = '<img class="questRewardTypeResource questRewardTypeWood" src="img/x.gif"> <span class="questRewardValue">' . round(250 * xQUEST) . '</span>
            <img class="questRewardTypeResource questRewardTypeClay" src="img/x.gif"> <span class="questRewardValue">' . round(290 * xQUEST) . '</span>
            <img class="questRewardTypeResource questRewardTypeIron" src="img/x.gif"> <span class="questRewardValue">' . round(100 * xQUEST) . '</span>
            <img class="questRewardTypeResource questRewardTypeCrop" src="img/x.gif"> <span class="questRewardValue">' . round(130 * xQUEST) . '</span>';
                                            $answer = quest72;
                                            break;
                                        case 4:
                                            $title = quest73;
                                            $overiew = quest74;
                                            $task = quest75;
                                            $reward = '<img class="questRewardTypeResource questRewardTypeWood" src="img/x.gif"> <span class="questRewardValue">' . round(400 * xQUEST) . '</span>
            <img class="questRewardTypeResource questRewardTypeClay" src="img/x.gif"> <span class="questRewardValue">' . round(460 * xQUEST) . '</span>
            <img class="questRewardTypeResource questRewardTypeIron" src="img/x.gif"> <span class="questRewardValue">' . round(330 * xQUEST) . '</span>
            <img class="questRewardTypeResource questRewardTypeCrop" src="img/x.gif"> <span class="questRewardValue">' . round(270 * xQUEST) . '</span>';
                                            $answer = quest76;
                                            break;
                                        case 5:
                                            $title = quest77;
                                            $overiew = quest78;
                                            $task = quest79;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . round(240 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeClay"> <span class="questRewardValue">' . round(255 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeIron"> <span class="questRewardValue">' . round(190 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeCrop"> <span class="questRewardValue">' . round(160 * xQUEST) . '</span>
                            ';
                                            $answer = quest80;
                                            break;
                                        case 6:
                                            $title = quest81;
                                            $overiew = quest82;
                                            $task = quest83;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . round(600 * xQUEST) . '</span>
                            ';
                                            $answer = quest84;
                                            break;
                                        case 7:
                                            $title = quest85;
                                            $overiew = quest86;
                                            $task = quest87;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . round(100 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeClay"> <span class="questRewardValue">' . round(99 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeIron"> <span class="questRewardValue">' . round(99 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeCrop"> <span class="questRewardValue">' . round(99 * xQUEST) . '</span>
                            ';
                                            $answer = quest88;
                                            break;
                                        case 8:
                                            $title = quest89;
                                            $overiew = quest90;
                                            $task = quest91;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . round(400 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeClay"> <span class="questRewardValue">' . round(400 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeIron"> <span class="questRewardValue">' . round(400 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeCrop"> <span class="questRewardValue">' . round(200 * xQUEST) . '</span>
                            ';
                                            $answer = quest92;
                                            break;
                                        case 9:
                                            $title = quest93;
                                            $overiew = quest94;
                                            $task = quest95;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . round(620 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeClay"> <span class="questRewardValue">' . round(730 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeIron"> <span class="questRewardValue">' . round(560 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeCrop"> <span class="questRewardValue">' . round(230 * xQUEST) . '</span>
                            ';
                                            $answer = quest96;
                                            break;
                                        case 10:
                                            $title = quest97;
                                            $overiew = quest98;
                                            $task = quest99;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">880</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeClay"> <span class="questRewardValue">1020</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeIron"> <span class="questRewardValue">590</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeCrop"> <span class="questRewardValue">320</span>
                            ';
                                            $answer = quest100;
                                            break;
                                        case 11:
                                            $title = quest101;
                                            $overiew = quest102;
                                            $task = quest103;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeBuilding g8Icon"> <span class="questRewardValue">' . quest104 . '</span>
                            ';
                                            $answer = quest105;
                                            break;
                                        case 12:
                                            $title = quest106;
                                            $overiew = quest107;
                                            $task = quest108;
                                            $reward = quest109;
                                            $answer = quest110;
                                            break;
                                    }
                                    break;
                                case 'world':
                                    switch ($id) {
                                        case 1:
                                            $title = quest111;
                                            $overiew = quest112;
                                            $task = quest113;
                                            $reward = '<img class="questRewardTypeResource questRewardTypeWood" src="img/x.gif"> <span class="questRewardValue">' . round(90 * xQUEST) . '</span>
            <img class="questRewardTypeResource questRewardTypeClay" src="img/x.gif"> <span class="questRewardValue">' . round(120 * xQUEST) . '</span>
            <img class="questRewardTypeResource questRewardTypeIron" src="img/x.gif"> <span class="questRewardValue">' . round(60 * xQUEST) . '</span>
            <img class="questRewardTypeResource questRewardTypeCrop" src="img/x.gif"> <span class="questRewardValue">' . round(30 * xQUEST) . '</span>';
                                            $answer = quest114;
                                            break;
                                        case 2:
                                            $title = quest115;
                                            $overiew = quest116;
                                            $task = quest117;
                                            $reward = quest118;
                                            $answer = quest119;
                                            break;
                                        case 3:
                                            $title = quest120;
                                            $overiew = quest121;
                                            $task = quest122;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . round(170 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeClay"> <span class="questRewardValue">' . round(100 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeIron"> <span class="questRewardValue">' . round(130 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeCrop"> <span class="questRewardValue">' . round(70 * xQUEST) . '</span>
                            ';
                                            $answer = quest123;
                                            break;
                                        case 4:
                                            $title = quest124;
                                            $overiew = quest125;
                                            $task = quest126;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . round(215 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeClay"> <span class="questRewardValue">' . round(145 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeIron"> <span class="questRewardValue">' . round(195 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeCrop"> <span class="questRewardValue">' . round(50 * xQUEST) . '</span>
                            ';
                                            $answer = quest127;
                                            break;
                                        case 5:
                                            $title = quest128;
                                            $overiew = quest129;
                                            $task = quest130;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . round(90 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeClay"> <span class="questRewardValue">' . round(160 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeIron"> <span class="questRewardValue">' . round(90 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeCrop"> <span class="questRewardValue">' . round(95 * xQUEST) . '</span>
                            ';
                                            $answer = quest131;
                                            break;
                                        case 6:
                                            $title = quest132;
                                            $overiew = quest133;
                                            $task = quest134;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . round(280 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeClay"> <span class="questRewardValue">' . round(315 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeIron"> <span class="questRewardValue">' . round(200 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeCrop"> <span class="questRewardValue">' . round(145 * xQUEST) . '</span>
                            ';
                                            $answer = quest135;
                                            break;
                                        case 7:
                                            $title = quest136;
                                            $overiew = quest137;
                                            $task = quest138;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeGold"> <span class="questRewardValue">20</span>
                            ';
                                            $answer = quest139;
                                            break;
                                        case 8:
                                            $title = quest140;
                                            $overiew = quest141;
                                            $task = quest142;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . round(295 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeClay"> <span class="questRewardValue">' . round(210 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeIron"> <span class="questRewardValue">' . round(235 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeCrop"> <span class="questRewardValue">' . round(185 * xQUEST) . '</span>
                            ';
                                            $answer = quest143;
                                            break;
                                        case 9:
                                            $title = quest144;
                                            $overiew = quest145;
                                            $task = quest146;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . round(570 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeClay"> <span class="questRewardValue">' . round(470 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeIron"> <span class="questRewardValue">' . round(560 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeCrop"> <span class="questRewardValue">' . round(265 * xQUEST) . '</span>
                            ';
                                            $answer = quest147;
                                            break;
                                        case 10:
                                            $title = quest148;
                                            $overiew = quest149;
                                            $task = quest150;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . round(525 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeClay"> <span class="questRewardValue">' . round(420 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeIron"> <span class="questRewardValue">' . round(620 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeCrop"> <span class="questRewardValue">' . round(335 * xQUEST) . '</span>
                            ';
                                            $answer = quest151;
                                            break;
                                        case 11:
                                            $title = quest152;
                                            $overiew = quest153;
                                            $task = quest154;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . round(650 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeClay"> <span class="questRewardValue">' . round(800 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeIron"> <span class="questRewardValue">' . round(740 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeCrop"> <span class="questRewardValue">' . round(530 * xQUEST) . '</span>
                            ';
                                            $answer = quest155;
                                            break;
                                        case 12:
                                            $title = quest156;
                                            $overiew = quest157;
                                            $task = quest158;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . round(265 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeClay"> <span class="questRewardValue">' . round(2150 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeIron"> <span class="questRewardValue">' . round(1810 * xQUEST) . '</span>
                                                <img src="img/x.gif" class="questRewardTypeResource questRewardTypeCrop"> <span class="questRewardValue">' . round(1320 * xQUEST) . '</span>
                            ';
                                            $answer = quest159;
                                            break;
                                        case 13:
                                            $title = ""; //посмотреть отчеты в округе
                                            $overiew = "";
                                            $task = "";
                                            $reward = "";
                                            $answer = "";
                                            break;
                                        case 14:
                                            $title = quest160;
                                            $overiew = quest161;
                                            $task = quest162;
                                            $reward = quest163;
                                            $answer = quest164;
                                            break;
                                        case 15:
                                            $title = quest165;
                                            $overiew = quest166;
                                            $task = quest167;
                                            $reward = '<img src="img/x.gif" class="questRewardTypeResource questRewardTypeWood"> <span class="questRewardValue">' . round(1050 * xQUEST) . '</span>
                                            <img src="img/x.gif" class="questRewardTypeResource questRewardTypeClay"> <span class="questRewardValue">' . round(800 * xQUEST) . '</span>
                                            <img src="img/x.gif" class="questRewardTypeResource questRewardTypeIron"> <span class="questRewardValue">' . round(900 * xQUEST) . '</span>
                                            <img src="img/x.gif" class="questRewardTypeResource questRewardTypeCrop"> <span class="questRewardValue">' . round(750 * xQUEST) . '</span>
                    ';
                                            $answer = quest168;
                                            break;
                                        case 16:
                                            $title = quest169;
                                            $overiew = quest170;
                                            $task = quest171;
                                            $reward = ""; //награды нет
                                            $answer = quest172;
                                            break;
                                    }
                                    break;
                            }
                        }
                        ?>

                        <li> <a data-category="world" data-questid="World_12" class="quest" href="#">
                                Warehouse level 7               </a></li>


                    </ul>

                    <script type="text/javascript">

                                window.addEvent('domready', function()
                                {
                                Travian.Game.Quest.setOptions(
                                {
                                tipsTurnoffAjaxTrigger: false,
                                        tutorialData: {},
                                        highlightSelectors: {}      });
                                        Travian.Game.Quest.addListData(
                                        {"battle":{"questsTotal":14, "questsCompleted":7, "name":"Battle", "quests":{"Battle_08":{"id":"Battle_08", "name":"questV2.battle_08_name", "category":"battle", "stepType":"task", "currentStep":0, "stepCount":2, "steps":[{"stepId":0, "type":"task", "stepDescription":null}, {"stepId":1, "type":"reward"}], "answersLink":"http:\/\/t4.answers.travian.com\/index.php?aid=312#go2answer"}, "Battle_09":{"id":"Battle_09", "name":"questV2.battle_09_name", "category":"battle", "stepType":"task", "currentStep":0, "stepCount":2, "steps":[{"stepId":0, "type":"task", "stepDescription":null}, {"stepId":1, "type":"reward"}], "answersLink":"http:\/\/t4.answers.travian.com\/index.php?aid=313#go2answer"}}}, "economy":{"questsTotal":12, "questsCompleted":10, "name":"Economy", "quests":{"Economy_11":{"id":"Economy_11", "name":"questV2.economy_11_name", "category":"economy", "stepType":"task", "currentStep":0, "stepCount":3, "steps":[{"stepId":0, "type":"task", "stepDescription":null}, {"stepId":1, "type":"task", "stepDescription":null}, {"stepId":2, "type":"reward"}], "answersLink":"http:\/\/t4.answers.travian.com\/index.php?aid=330#go2answer"}, "Economy_12":{"id":"Economy_12", "name":"questV2.economy_12_name", "category":"economy", "stepType":"task", "currentStep":0, "stepCount":2, "steps":[{"stepId":0, "type":"task", "stepDescription":null}, {"stepId":1, "type":"reward"}], "answersLink":"http:\/\/t4.answers.travian.com\/index.php?aid=331#go2answer"}}}, "world":{"questsTotal":16, "questsCompleted":12, "name":"World", "quests":{"World_12":{"id":"World_12", "name":"questV2.world_12_name", "category":"world", "stepType":"task", "currentStep":0, "stepCount":2, "steps":[{"stepId":0, "type":"task", "stepDescription":null}, {"stepId":1, "type":"reward"}], "answersLink":"http:\/\/t4.answers.travian.com\/index.php?aid=358#go2answer"}, "World_14":{"id":"World_14", "name":"questV2.world_14_name", "category":"world", "stepType":"task", "currentStep":0, "stepCount":2, "steps":[{"stepId":0, "type":"task", "stepDescription":null}, {"stepId":1, "type":"reward"}], "answersLink":"http:\/\/t4.answers.travian.com\/index.php?aid=360#go2answer"}}}});
                                        Travian.Game.Quest.bindListDelegation();
                                        Travian.Game.Quest.createHighlights();
                                        Travian.Game.Quest.initializeQuests();
                                });

                    </script>
                </div>
                <div class="innerBox footer">
                </div>
            </div>
        </div>
        <div class="clear"></div>
        
<?php } ?>
        <div class="sidebarBox   " id="sidebarBoxQuestachievements">
            <div class="sidebarBoxBaseBox">
                <div class="baseBox baseBoxTop">
                    <div class="baseBox baseBoxBottom">
                        <div class="baseBox baseBoxCenter"></div>
                    </div>
                </div>
            </div>
            <div class="sidebarBoxInnerBox">
                <div class="innerBox header ">
                    <div class="travianBirthdayRibbon buttonsWrapper">
                        <div class="textButtonV2 buttonFramed rectangle withText withLoadingIndicator ">
                            <div>Free Gold</div>
                        </div>
                    </div>
                </div>
                <div class="innerBox content">
                    <div class="boxTitle">Ideas to get some more gold</div> 
                     <button class="textButtonV2 buttonFramed rectangle withText withLoadingIndicator green" onclick="window.open('http://aspidanetwork.com/freegold/index.html','_blank');">
                        <div class="button-container addHoverClick ">
                            <div class="button-background">
                                <div class="buttonStart">
                                    <div class="buttonEnd">
                                        <div class="buttonMiddle"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-content">Check here</div>
                        </div>
                    </button>
                </div>
                <div class="innerBox footer">
                </div>
            </div>
        </div>
    </div>
</div>