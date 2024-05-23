<?php
if($fromfile){
if(!file_exists("done.txt")){
    $ourFileHandle = fopen("done.txt", 'w');
    fclose($ourFileHandle);
    $q = "
    SELECT users.id userid, users.username username,users.alliance alliance, (
    SELECT SUM( vdata.pop )
    FROM vdata
    WHERE vdata.owner = userid
    )totalpop, (
        SELECT COUNT( vdata.wref )
    FROM vdata
    WHERE vdata.owner = userid AND type != 99
    )totalvillages, (
    SELECT alidata.tag
    FROM alidata, users
    WHERE alidata.id = users.alliance
    AND users.id = userid
    )allitag
    FROM users
    WHERE users.access < " . (INCLUDE_ADMIN ? "10" : "8") . " and id>5
    ORDER BY totalpop DESC, totalvillages DESC, username ASC";

    $result = $database->query($q);
    foreach($result as $row)
    {
        $datas[] = $row;
    }

    ## Top Attacker
    $q = "
    SELECT users.id userid, users.username username, users.apall,  (
    SELECT COUNT( vdata.wref )
    FROM vdata
    WHERE vdata.owner = userid AND type != 99
    )totalvillages, (
    SELECT SUM( vdata.pop )
    FROM vdata
            WHERE vdata.owner = userid
    )pop
    FROM users
    WHERE users.apall >0 AND users.access < " . (INCLUDE_ADMIN ? "10" : "8") . " AND users.tribe <= 3
    ORDER BY users.apall DESC, pop DESC, username ASC";

    $result = $database->query($q);
    foreach($result as $row)
    {
        $attacker[] = $row;
    }

    ## Top Defender
    $q = "
    SELECT users.id userid, users.username username, users.dpall,  (
    SELECT COUNT( vdata.wref )
    FROM vdata
    WHERE vdata.owner = userid AND type != 99
    )totalvillages, (
    SELECT SUM( vdata.pop )
    FROM vdata
    WHERE vdata.owner = userid
    )pop
    FROM users
    WHERE users.dpall >0 AND users.access < " . (INCLUDE_ADMIN ? "10" : "8") . " and id>5
    ORDER BY users.dpall DESC, pop DESC, username ASC";
    $result = $database->query($q);
    foreach($result as $row)
    {
        $defender[] = $row;
    }
    
    
    //give gold to winner
    $database->modifyGold($datas[0]['userid'],200,1,"End game bonus"); //топ насел
    $database->modifyGold($attacker[0]['userid'],200,1,"End game bonus"); //топ атакер
    if($attacker[0]['username']==$defender[0]['username']){
            $database->modifyGold($defender[1]['userid'],200,1,"End game bonus"); //топ деффер место 2
    }else{
            $database->modifyGold($defender[0]['userid'],200,1,"End game bonus"); //топ деффер место 1
    }
    $sql = $database->query("SELECT vref FROM fdata WHERE f99 = '100' and f99t = '40'");
    $vref = $sql[0]['vref'];

    $sql = $database->query("SELECT owner FROM vdata WHERE wref = '".$vref."'");
    $owner = $sql[0]['owner'];
	$database->modifyGold($owner,500,1,"End game bonus");//чудостроитель

    $sql = $database->query("SELECT alliance FROM users WHERE id = '".$owner."'");
    $allianceid = $sql[0]['alliance'];
    if($allianceid){
        $sql = $database->query("SELECT id FROM users WHERE alliance = '".$allianceid."'");
        foreach($sql as $users){
            $database->modifyGold($users['id'],250,1,"End game bonus");//голд чудостроителю
        }
    }



    //transfer gold to bank
    $userinfa=$database->query("SELECT gold,email,id FROM users");

    foreach($userinfa as $u){

    $line1=$database->query("SELECT * FROM `bank` WHERE `email`='".$u['email']."'");
    $line01=count($line1);

    //get gold which user spent at round
    $log=$database->getPalevo(3,1,$u['id']);
      $log_size = count($log);
      $spent_gold=0;
    
    for($i=0;$i<$log_size;$i++) {
        $dataarray = explode(",",$log[$i]['infa']);
        $spent_gold+=$dataarray[2];
    }
  
    //calculate insert gold
    $insert_gold = 0;
    if($spent_gold >= DEFAULT_GOLD)
        $insert_gold = $u['gold'];
    else 
        $insert_gold = $u['gold']-DEFAULT_GOLD+$spent_gold;
    
    if($insert_gold < 0)
        $insert_gold = 0;
  
    if($line01>0){
        $database->query("UPDATE `bank` SET `gold`= gold + ".($insert_gold)." WHERE `email`='".$u['email']."'"); //все золото переводим в банк
    }else{
        $database->query("INSERT INTO `bank` (`id`,`email`,`gold`) VALUES ('0','".$u['email']."','".($insert_gold)."')");
    }
        
        $database->query("INSERT INTO log (`id`,`userid`,`email`,`gold`,`ip`,`time`,`server`) VALUES ('0','999','" . $u['email'] . "','".($insert_gold)."','vidacha','" . time() . "','0')");
    }




}
}