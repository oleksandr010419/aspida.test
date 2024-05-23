<?php 
class Hero{
    function checkIfHeroHasHorse($id, $uid) {
        global $database;
        $p = array('I' => $id, 'U' => $uid);
        $q = "SELECT id FROM heroitems WHERE type = :I and uid = :U LIMIT 1";
        $answer = $database->query($q, $p);
        if ($answer) {
            return true;
        } else {
            return false;
        }
    }

    function reAddHero($vref, $reason = "") {
        global $database;
        $p = array('V' => $vref);
        $q = "UPDATE units set u11=1 WHERE `vref` = :V";
        $database->query($q, $p);
        $uid = $database->Getowner($vref);
        userDetailedLog($uid, $reason);
        userDetailedLog($uid, $q . '   ' . print_r($p, true));
    }

    function removeExcessHeroes($vrefs, $reason = "") {
        if(is_array($vrefs))$vrefs=implode(",",$vrefs);
        global $database;
        $q = "UPDATE units set u11=0 WHERE `vref` IN (".$vrefs.")";
        $database->query($q);
    }

    function HeroNotInVil($id) {
        global $database;
        $heronum = 0;
        $outgoingarray = $database->getMovement(3, $id, 0);
        if (!empty($outgoingarray)) {
            foreach ($outgoingarray as $out) {
                $heronum += $out['t11'];
            }
        }
        $returningarray = $database->getMovement(4, $id, 1);
        if (!empty($returningarray)) {
            foreach ($returningarray as $ret) {
                if ($ret['attack_type'] != 1) {
                    $heronum += $ret['t11'];
                }
            }
        }
        return $heronum;
    }

    function heroControll($main_wid,$villages,$heroData){
        global $database;
        $hero=0;
		
		if(empty($villages)) return;
		
        $vills=implode(",",$villages);
        $q2 = "SELECT SUM(u11) as sum2 from units where `vref` IN (".$vills.")";   // check if hero is on my account (all villages)
        $he2 = $database->query($q2);
        $hero+=$he2[0]['sum2'];
        if($hero>1){     
            $this->removeExcessHeroes($villages);
            $hero = 0;
        }

        $q1 = "SELECT SUM(u11) as sum1 from enforcement where `from` IN (".$vills.")";       // check if hero is send as reinforcement
        $he1 = $database->query($q1);
        $hero+=$he1[0]['sum1'];

        $q3 = "SELECT SUM(t11) as sum3 from prisoners where `from` IN (".$vills.")";   // check if hero is on traps (all villages)
        $he3 = $database->query($q3);
        $hero+=$he3[0]['sum3'];

        foreach($villages as $myvill){
            $hero+=$database->HeroNotInVil($myvill); // check if hero is not in village (come back from attack , raid , etc.)
        }
        if(!$hero && $heroData['dead']==0 && !$heroData['revivetime']){ //no hero, marked as alive, not reviving => missing
            $this->reAddHero($main_wid,"Hero was lost!");
        }
        if($hero>1){
            $this->removeExcessHeroes($villages);
        }
    }
    
}

$hero_model = new Hero();