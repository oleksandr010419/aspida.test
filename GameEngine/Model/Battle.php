<?php
class Battle {

    public static function getBuildingLevelAfterCatas($building_lvl, $units, $upgrade_lvl, $race_durab, $durability_other) {
        if ($durability_other != 1) {
            $units = floor($units / $durability_other);
        }
        $units *= self::bonusCatsRams($upgrade_lvl);
        $speed_modifier = (SPEED>10)?(SPEED): 1;
        $effective_number = ((8 * $units - 1) / $race_durab) / (($speed_modifier<1)?1:$speed_modifier); // bugfix for catapults
        if ($effective_number <= 0)
            return $building_lvl;
        else if ($effective_number > $building_lvl*($building_lvl+1))
            return 0;
        else
            return round(sqrt(pow($building_lvl+0.5, 2) - $effective_number));
    }

    public static function bonusCatsRams($upgrade_lvl) {
        return round(2*pow(1.0205, $upgrade_lvl), 2)/2;
    }

    public function remorale($off, $def, $pop, $wall) {
        $def = $def==0?1:$def;
        $pts = round($off) / round($def * $wall);
        $morale = round(pow($pop, -0.2*min($pts, 1)), 3);
        return $pts * $this->limit(0.667, $morale, 1.0);
    }
    
    public function calc_diffusion($troops_amount) {
        $n = 2*round(1.8592 - pow($troops_amount, 0.015), 4);
        return $this->limit(1.2578, $n, 1.5);
    }

    public function limit($low, $value, $high) {
        if ($value < $low) return $low;
        if ($value > $high) return $high;
        return $value;
    }

    public function sigma($x) {
        return $x >= 1 ? 1 - 0.5 / $x : 0.5 * $x;
    }

    public function natarAttack($to, $power) {
        global $database;
        $power_array = array('0'=>0,'1'=>(SPEED *3),'5'=>(SPEED *15),'10'=>(SPEED *30),'15'=>(SPEED *45),'20'=>(SPEED *60));

        $wid = $database->single("SELECT wref FROM vdata WHERE `owner`= 3 and `capital`='1'");
        if (SPEED >= 999) {
            $time = 120;
        } else {
            $time = 360;
        }

        for ($i = 1; $i <= 8; $i++) {
            if ($i != 4) {
                $coef = $power / $i;
                $data['u' . $i] = round(SPEED * $coef);
            }
        }
        $cata_power = ($power>=90?20:($power>=75)?15:($power>=45)?10:($power>=15)?5:($power>=5)?1:0);


        $rams = $data['u7'];
        $catapults = $power_array[$cata_power];//on x10 600 catas  destroy lvl 20 soo we need to adjust 
        //i think that on levels 5-15 we should destory max 1 lvls (30),15-45 5lvls (150), 45 - 75 10lvl (300),75-90 15lvls (450), 90-100 20lvls (600). 

        $reference = $database->addAttack($wid, $data['u1'], $data['u2'], $data['u3'], 0, $data['u5'], $data['u6'], $rams, $catapults, 0, 0, 0, 3, 40, 0, 0, 0);
        $database->addMovement(3, $wid, $to, $reference, time(), ($time + time()));
        $database->insertQueue($reference, 1, time(), ($time + time()));
    }
}
?>