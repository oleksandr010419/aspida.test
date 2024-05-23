<?php
class Registr {

    function register($username, $password, $email, $tribe, $country, $ref, $forceID=null) {

        global $database;

        $time = time();

        $starttime = OPENING;

        if ($starttime < $time) {

            $timep = $time;
        } else {
            $timep = $starttime;
        }

        $params = array(
            'user' => $username,
            'pass' => $password,
            'email' => $email,
            'tribe' => intval($tribe),
            'country' => $country,
            'ref' => intval($ref),
            'timer' => $timep,
            'up' => $timep
        );

        if($forceID!=null){
            $params['id'] = $forceID;

            $q = "INSERT INTO users (id,username,password,email,tribe,IsoCountryCode,lastupdate,regtime,invited,gold,advtime)
                VALUES (:id,:user, :pass, :email, :tribe, :country, :up, :timer, :ref, 0," . $timep . ")";

        }else{
            $q = "INSERT INTO users (username,password,email,tribe,IsoCountryCode,lastupdate,regtime,invited,gold,advtime)
                VALUES (:user, :pass, :email, :tribe, :country, :up, :timer, :ref, 0," . $timep . ")";
        }


        $database->query($q, $params);

        return $database->get_last_id();
    }

    function checkActivate($act) {

        global $database;

        $q = "SELECT * FROM activate where act = :act";

        $params = array('act' => $act);

        return $database->query($q, $params);
    }

    function checkAccount($name, $email) {

        global $database;

        $q = "SELECT * FROM activate where `username` = :name or `email` = :email";

        $params = array('name' => $name, 'email' => $email);

        return $database->query($q, $params);
    }

    function activate($username, $password, $email, $tribe, $isoCountryCode, $loc, $act, $act2, $ref) {

        global $database;

        $params = array(
            'user' => $username,
            'pass' => $password,
            'email' => $email,
            'tribe' => 0,
            'isoCountryCode' => $isoCountryCode,
            'act' => $act,
            'act2' => $act2,
            'ref' => $ref,
            'time' => time(),
            'location' => 0
        );

        $q = "INSERT INTO activate (username,password,email,tribe,IsoCountryCode,timestamp,act,act2,ref,location) VALUES (:user, :pass, :email, :tribe, :isoCountryCode, :time, :act, :act2,:ref,:location)";

        $database->query($q, $params);

        return $database->get_last_id();
    }

    function unreg($username) {

        global $database;

        $params = array('user' => $username);

        $q = "DELETE from activate where username = '" . $username . "'";

        $database->query($q, $params);
    }

}

$regme = new Registr;

