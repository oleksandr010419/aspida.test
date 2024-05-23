<?php
	$gpack= GP_LOCATE;

//de bird
if($displayarray['regtime']+PROTECTION > time() && $displayarray['protect']!=0){
    $uurover=date('H:i:s', ($displayarray['regtime']+PROTECTION - time()));
    $profiel = preg_replace("/\[#0]/is",'<img src="'.$gpack.'img/t/tn.gif" border="0" title="Player '.$uurover.' Time is no longer supported." >', $profiel,1);
} else {
    $geregistreerd=date('Y/m/d', ($displayarray['regtime']));
    $tregistreerd=date('H:i', ($displayarray['regtime']));
    $profiel = preg_replace("/\[#0]/is",'<img src="'.$gpack.'img/t/tnd.gif" border="0" title="Players on '.$geregistreerd.' '.$tregistreerd.' is enrolled">', $profiel,1);
}


//natar image
if($displayarray['username'] == "Natars"){
    $profiel = preg_replace("/\[#natars]/is",'<img src="gpack/delusion_4.5/img/t/ffff.jpg" border="0">', $profiel,1);
}
//multihunders image
if($displayarray['username'] == "multihunter"){
    $profiel = preg_replace("/\[#multihunter]/is",'<img src="gpack/delusion_4.5/img/t/multihunter_basic_1.png" border="0">', $profiel,1);
}
 	$podryad=MEDAL19;
	$times=TIMES;
	$podryad=$times." ".$podryad;
	$titel=BONUS;
	$days=DNYA;
	$woord=STATISTIC6;
	$whatka=OVERVIEW39;
foreach($varmedal as $medal) {

switch ($medal['categorie']) {
    case "1":
        $titel=MEDAL1;
        $titel=$titel." ".$days;
        break;
    case "2":
       $titel=MEDAL2;
        $titel=$titel." ".$days;
        break;
    case "3":
        $titel=MEDAL3;
         $titel=$titel." ".$days;
        break;
    case "4":
        $titel=MEDAL4;
        $titel=$titel." ".$days;
        break;
    case "5":
        $titel=MEDAL5;
        $titel=$titel." ".$days;
        break;
    case "6":
     $titel0=MEDAL6;

          $titel="".$titel0." ".$days." ".$medal['points']."  ".$podryad."";
        break;
    case "7":
            $titel0=MEDAL7;

        $titel="".$titel0." ".$days." ".$medal['points']."  ".$podryad."";
        break;
    case "8":
                   $titel0=MEDAL8;

         $titel="".$titel0." ".$days." ".$medal['points']."  ".$podryad."";
        break;
    case "9":
                    $titel0=MEDAL9;
       $titel="".$titel0." ".$days." ".$medal['points']."  ".$podryad."";
        break;
    case "10":
                $titel=MEDAL10;
        $titel=$titel." ".$days;
        break;
    case "11":
                            $titel0=MEDAL11;
       $titel="".$titel0." ".$days." ".$medal['points']."  ".$podryad."";
        break;
    case "12":
                            $titel0=MEDAL12;
      $titel="".$titel0." ".$days." ".$medal['points']."  ".$podryad."";
        break;
            case "17":
                $titel=MEDAL17;
        $titel=$titel." ".$days;
        break;
                    case "18":
                $titel=MEDAL18;
        $titel=$titel." ".$days;
        break;


}

    if(isset($bonus[$medal['id']])){

        $profiel = preg_replace("/\[#".$medal['id']."]/is",'<img class="medal '.$medal['img'].'" src="img/x.gif" title="'.$titel.'
<br />Week: '.$medal['week'].'">', $profiel,1);
    } else {
        $profiel = preg_replace("/\[#".$medal['id']."]/is",'<img class="medal '.$medal['img'].'" src="img/x.gif" title="Category: '.$titel.'<br />Week: '.$medal['week'].'<br />Rank: '.$medal['plaats'].'<br />'.$woord.': '.$medal['points'].'<br />">', $profiel,1);
    }

}
    
	$main_id = null;//$session->main_id;
	if($main_id == null){
		$main_id_data = json_decode(file_get_contents("https://aspidanetwork.com/api.php?email=".urlencode($displayarray['email'])));
		$main_id = $main_id_data->uid;		
	}

    if($main_id != null){
         $main_medals_data = json_decode(file_get_contents("https://aspidanetwork.com/api.php?id=".$main_id));
         if(!empty($main_medals_data) && !empty($main_medals_data->medals)){
             foreach($main_medals_data->medals as $medal) {
                $title = constant('MEDAL_'.$medal->category);
                $round = ($medal->round>0)?'<br />'.OVERVIEW41.': '.$medal->round.' with nick '.$medal->nick.'['.OVERVIEW42.':'.$medal->server.']':"";
                $profiel = preg_replace("/\[#m".$medal->category."]/is",'<img class="medal large m'.$medal->category.'" src="img/x.gif" title="'.$title.$round.'">', $profiel,1);
             }
         }
     }