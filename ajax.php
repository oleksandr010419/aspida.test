<?php
session_start();
switch($_GET['cmd']) {
	case 'mapLowRes':
		$is_ajax=true;
		include("lowresmap.php");
		break;
    case 'exchangeResources':
        session_start();
        //file_put_contents('GameEngine/queue2/_log.txt', var_export($_POST['defaultValues']['r1'], true) . "\r\n\r\n",FILE_APPEND);
        include("GameEngine/Data/buidata.php");
        include("GameEngine/Database.php");
        if (!isset($_COOKIE['lang']) || empty($_COOKIE['lang'])) {
            $language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            if (in_array($language, array('ru', 'ua', 'be'))) {
                setcookie('lang', 'ru');
                $language=$_COOKIE['lang']='ru';
            } else {
                setcookie('lang', 'en');
                $language=$_COOKIE['lang']='en';
            }
        } else {
            $language = $_COOKIE['lang'];
        }
        include("GameEngine/Lang/" . $language . ".php");

        $vilres=$database->getResVillageField($_SESSION['wid']);
        $ress=$crop=0;
        $fdata=$database->getResourceLevel($_SESSION['wid']);
        for ($i = 19; $i < 40; $i++){
            if ($fdata['f' . $i . 't'] == 10){$ress += $bid10[$fdata['f' . $i]]['attri'] * STORAGE_MULTIPLIER;}
            if ($fdata['f' . $i . 't'] == 38){$ress += $bid38[$fdata['f' . $i]]['attri'] * STORAGE_MULTIPLIER;}
            if ($fdata['f' . $i . 't'] == 11){$crop += $bid11[$fdata['f' . $i]]['attri'] * STORAGE_MULTIPLIER;}
            if ($fdata['f' . $i . 't'] == 39){$crop += $bid39[$fdata['f' . $i]]['attri'] * STORAGE_MULTIPLIER;}
        }

        if ($ress == 0){$ress = 800 * STORAGE_MULTIPLIER;}
        if ($crop == 0){$crop = 800 * STORAGE_MULTIPLIER;}
        if(!isset($_POST['desired'])){
		$html = '<div class="exchangeResources" id="build">
		<p class="npc_desc">With the NPC merchant, you can distribute the resources in your warehouse as you desire.<br>
		<br>
		The first line shows the current stock. In the second line, you can choose another distribution. The third line shows the difference between the old and new stock.</p><input id="t" name="t" type="hidden" value="3"> <input id="a" name="a" type="hidden" value="6"> <input id="c" name="c" type="hidden" value="be6"> <input id="d" name="d" type="hidden" value="'.$_SESSION["wid"].'">
		<table cellpadding="1" cellspacing="1" id="npc">
			<thead>
				<tr>
					<td class="all">
						<a href="#" onclick="Travian.Game.Marketplace.ExchangeResources.fillup(0); return false;"><img alt="Lumber" class="r1" src="img/x.gif" title="Lumber"></a> <span id="org0">'.$vilres["wood"].'</span>
					</td>
					<td class="all">
						<a href="#" onclick="Travian.Game.Marketplace.ExchangeResources.fillup(1); return false;"><img alt="Clay" class="r2" src="img/x.gif" title="Clay"></a> <span id="org1">'.$vilres["clay"].'</span>
					</td>
					<td class="all">
						<a href="#" onclick="Travian.Game.Marketplace.ExchangeResources.fillup(2); return false;"><img alt="Iron" class="r3" src="img/x.gif" title="Iron"></a> <span id="org2">'.$vilres["iron"].'</span>
					</td>
					<td class="all">
						<a href="#" onclick="Travian.Game.Marketplace.ExchangeResources.fillup(3); return false;"><img alt="Crop" class="r4" src="img/x.gif" title="Crop"></a> <span id="org3">'.$vilres["crop"].'</span>
					</td>
					<td class="deco"></td>
					<td class="sum">Sum:&nbsp;<span id="org4">'.($vilres["wood"]+$vilres["clay"]+$vilres["iron"]+$vilres["crop"]).'</span></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="sel"><input class="text" id="m2[0]" maxlength="7" name="m2[]" onkeyup="Travian.Game.Marketplace.ExchangeResources.calculateRest();" size="5" value="'.$_POST['defaultValues']['r1'].'"> <input id="m1[0]" name="m1[]" type="hidden" value="'.$_POST['defaultValues']['r1'].'"></td>
					<td class="sel"><input class="text" id="m2[1]" maxlength="7" name="m2[]" onkeyup="Travian.Game.Marketplace.ExchangeResources.calculateRest();" size="5" value="'.$_POST['defaultValues']['r2'].'"> <input id="m1[1]" name="m1[]" type="hidden" value="'.$_POST['defaultValues']['r2'].'"></td>
					<td class="sel"><input class="text" id="m2[2]" maxlength="7" name="m2[]" onkeyup="Travian.Game.Marketplace.ExchangeResources.calculateRest();" size="5" value="'.$_POST['defaultValues']['r3'].'"> <input id="m1[2]" name="m1[]" type="hidden" value="'.$_POST['defaultValues']['r3'].'"></td>
					<td class="sel"><input class="text" id="m2[3]" maxlength="7" name="m2[]" onkeyup="Travian.Game.Marketplace.ExchangeResources.calculateRest();" size="5" value="'.$_POST['defaultValues']['r4'].'"> <input id="m1[3]" name="m1[]" type="hidden" value="'.$_POST['defaultValues']['r4'].'"></td>
					<td class="deco"></td>
					<td class="sum">Sum:&nbsp;<span id="newsum">'.($_POST['defaultValues']['r1']+$_POST['defaultValues']['r2']+$_POST['defaultValues']['r3']+$_POST['defaultValues']['r4']).'</span></td>
				</tr>
				<tr>
					<td class="rem"><span id="diff0">&#x202d;'.round($vilres["wood"]-$_POST['defaultValues']['r1']).'&#x202c;</span></td>
					<td class="rem"><span id="diff1">&#x202d;'.round($vilres["clay"]-$_POST['defaultValues']['r2']).'&#x202c;</span></td>
					<td class="rem"><span id="diff2">&#x202d;'.round($vilres["iron"]-$_POST['defaultValues']['r3']).'&#x202c;</span></td>
					<td class="rem"><span id="diff3">&#x202d;'.round($vilres["crop"]-$_POST['defaultValues']['r4']).'&#x202c;</span></td>
					<td class="deco"></td>
					<td class="sum">Rest:&nbsp;<span id="remain">'.($vilres["wood"]+$vilres["clay"]+$vilres["iron"]+$vilres["crop"]).'</span></td>
				</tr>
			</tbody>
		</table>
		<p class="disableButtonHandler" id="submitButton"><button class="gold" id="npc_market_button" title="Redeem now." type="submit" value="Redeem">
		<div class="button-container addHoverClick">
			<div class="button-background">
				<div class="buttonStart">
					<div class="buttonEnd">
						<div class="buttonMiddle"></div>
					</div>
				</div>
			</div>
			<div class="button-content">
				Redeem<img alt="" class="goldIcon" src="img/x.gif"><span class="goldValue">3</span>
			</div>
		</div></button>
		<script id="npc_market_button_script" type="text/javascript">
		  window.addEvent(\'domready\', function() {        if($(\'npc_market_button\')) {            $(\'npc_market_button\').addEvent(\'click\', function () {                window.fireEvent(\'buttonClicked\', [this, {"type":"submit","value":"Redeem","name":"","id":"npc_market_button","class":"gold ","title":"Redeem now.","confirm":"","onclick":"","coins":3,"wayOfPayment":{"featureKey":"marketplace","context":"","dataCallback":"returnInputValues"}}]);            });        }   });
		</script></p>
		<p id="submitText"><button class="gold" id="button59ad1d8ce56f9" onclick="javascript:Travian.Game.Marketplace.ExchangeResources.portion('.$_SESSION['wid'].');" title="Distribute remaining resources." type="button" value="Distribute remaining resources.">
		<div class="button-container addHoverClick">
			<div class="button-background">
				<div class="buttonStart">
					<div class="buttonEnd">
						<div class="buttonMiddle"></div>
					</div>
				</div>
			</div>
			<div class="button-content">
				Distribute remaining resources.
			</div>
		</div></button>
		<script id="button59ad1d8ce56f9_script" type="text/javascript">
		window.addEvent(\'domready\', function() {        if($(\'button59ad1d8ce56f9\')) {            $(\'button59ad1d8ce56f9\').addEvent(\'click\', function () {                window.fireEvent(\'buttonClicked\', [this, {"type":"button","value":"Distribute remaining resources.","name":"","id":"button59ad1d8ce56f9","class":"gold ","title":"Distribute remaining resources.","confirm":"","onclick":"javascript:Travian.Game.Marketplace.ExchangeResources.portion('.$_SESSION["wid"].');"}]);            });        }  });
		</script></p>
		<script>
		      Travian.Game.Marketplace.ExchangeResources.initialize('.$ress.', '.$crop.');       Travian.Game.Marketplace.ExchangeResources.calculateRest();     function returnInputValues()        {           var inputFields = $$(\'form input\');         var returnObject = {};          Array.each(inputFields, function(element, index)            {               var name = element.get(\'id\');               var curObject = {};                var value = element.get(\'value\');                if (isNaN(value) || void 0 == value) {                    value = 0;                }               curObject[name] = value;                Object.append(returnObject, curObject);         });         return returnObject;        }   
		</script>
	</div>';

            echo '
{
	"response": {"error":false,"errorMsg":null,"data":{"html":'.json_encode($html).'}}
}';
        }else{

            $vilres=$database->getNPCVillageField($_SESSION['wid']);
            $needsum=$_POST['desired'][0]+$_POST['desired'][1]+$_POST['desired'][2]+$_POST['desired'][3];
            $havesum=($vilres["wood"]+$vilres["clay"]+$vilres["iron"]+$vilres["crop"]);
           $next=$lol=$Rmax=$floated=0;
            $Tres=$new=array();
            if($havesum>=$needsum){
                $diff=$havesum;
                while ($diff>=1) {
                    $newdiff=0;
                    $lol++;
                    for ($i = 0; $i <= 3; $i++) {
                        if ($i < 3) {
                            $max = $vilres['maxstore'];
                        } else {
                            $max = $vilres['maxcrop'];
                        }
                        if (!$next) {
                            $Tres[$i] = (($_POST['desired'][$i] + (($havesum - $needsum) / 4)) > $max) ? $max : ($_POST['desired'][$i] + (($havesum - $needsum) / 4));
                            $Tres[$i] = floor($Tres[$i]);
                            if ($Tres[$i] == $max) {
                                $Rmax++;
                            }

                            $diff -= $Tres[$i];

                        } else {
                            if ($Tres[$i] != $max) {
                                $new = (($Tres[$i] + $diff / (4 - $Rmax)) > $max) ? $max : (($Tres[$i] + $diff / (4 - $Rmax)));
$new=floor($new);
                                $newdiff += $new - $Tres[$i];
                                $Tres[$i] = $new;
                                if ($Tres[$i] == $max) {
                                    $Rmax++;
                                }
                            }

                        }

                    }
                    $diff -= $newdiff;
                    $next++;
                    if($lol>5){
                        break;
                    }
                }
            }else{

                for ($i = 0; $i <= 3; $i++) {
                    $Tres[$i] =  floor($_POST['desired'][$i] - ($needsum-$havesum) / 4);
                }
            }
$gotsum=array_sum($Tres);
while($havesum>$gotsum){
    for($i=0;$i<=3;$i++){
        if ($i < 3) {
            $max = $vilres['maxstore'];
        } else {
            $max = $vilres['maxcrop'];
        }

    if($Tres[$i]<$max){$Tres[$i]+=1; $gotsum+=1;; if($gotsum==$havesum){break;} }
        //file_put_contents('GameEngine/queue2/log.txt', var_export($havesum.'<'.$gotsum, true) . "\r\n\r\n",FILE_APPEND);
    }
}
            echo '{
	"response": {"error":false,"errorMsg":null,"data":{"distributed":['.$Tres[0].','.$Tres[1].','.$Tres[2].','.$Tres[3].'],"resources":['.$vilres["wood"].','.$vilres["clay"].','.$vilres["iron"].','.$vilres["crop"].']}}
}';

        }



        break;


    case 'quest':

        session_start();
        include("GameEngine/Database.php");
        if (!isset($_COOKIE['lang']) || empty($_COOKIE['lang'])) {
            $language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            if (in_array($language, array('ru', 'ua', 'be'))) {
                setcookie('lang', 'ru');
                $language=$_COOKIE['lang']='ru';
            } else {
                setcookie('lang', 'en');
                $language=$_COOKIE['lang']='en';
            }
        } else {
            $language = $_COOKIE['lang'];
        }
        include("GameEngine/Lang/" . $language . ".php");

		require_once __DIR__.'/GameEngine/DailyQuest.php';	
		$daily_quest = new DailyQuest($_SESSION['id_user']);
		$daily_quest->createQuest();
		$questsData = $daily_quest->getQuests();
		$totalPoints = min($questsData['adventure']*5, 5)
						+ min($questsData['raid_oasis']*3, 9)
						+ min($questsData['auction']*5, 15)
						+ min($questsData['gain_spend_gold']*2, 6)
						+ min($questsData['upgrade_building']*4, 12)
						+ min($questsData['upgrade_resource']*5, 15)
						+ min($questsData['build_infantry']*4, 12)
						+ min($questsData['build_cavalry']*4, 12)
						+ min($questsData['celebration']*5, 15)
						+ min($questsData['vote']*2, 4);


        switch($_POST['questTutorialId']){

            case "AchievementQuestReward_01":
            case "AchievementQuestReward_02":
            case "AchievementQuestReward_03":
            case "AchievementQuestReward_04":



        switch($_POST['questTutorialId']){
            case "AchievementQuestReward_01":
                $points=25;
                $reward=$questsData['reward1'];
                if($questsData['reward1']==0 && $points <= $totalPoints){
                    $reward=rand(1,3);
                    switch($reward){
                        case 1:
                            $peoples=$database->query("SELECT wref FROM `vdata` WHERE `owner`='".$_SESSION['id_user']."' LIMIT 1");
                            $database->addAdventure($peoples[0]['wref'], $_SESSION['id_user'],5);
                            break;
                        case 2:
                            $database->setCelCp($_SESSION['id_user'],5000);
                            break;
                        case 3:
                            $r1=$r2=$r3=$r4=0;
                            ${'r'.(rand(1,4))}=HOWRES;
                            $database->modifyResource($_SESSION['wid'],$r1,$r2,$r3,$r4,1);
                            break;
                    }
					$daily_quest->claimReward(1);
				}
                $prize=constant("questday".($reward+4));
                $prizes="<li>".questday5."</li>


            <li>".questday6."</li>

            <li>".questday7."</li>";
                break;
            case "AchievementQuestReward_02":
                $points=50;
                $reward=$questsData['reward2'];
                if($questsData['reward2']==0 && $points <= $totalPoints){
                    $reward=rand(1,5);
                    switch($reward) {
                        case 1:  $plus="plus"; break;
                        case 2:  $plus="b1";   break;
                        case 3: $plus ="b2";  break;
                        case 4: $plus ="b3";  break;
                        case 5: $plus ="b4";  break;
                    }
                    $row =  $database->query("SELECT `".$plus."` FROM users WHERE `id` = '".$_SESSION['id_user']."'");
                    $tip=$row[0][$plus];
                    if ($tip==0 or $tip<time()){
                        $time=time()+86400;
                    }
                    if($tip>time()){
                        $time= $tip+86400;
                    }
                    $q = "UPDATE users SET `".$plus."`='".$time."' where  `id` =  '".$_SESSION['id_user']."'";
                    $database->query($q);
					$daily_quest->claimReward(2);
                }





                $prize=constant("questday".($reward+8));
                $prizes=" <li>".questday9."</li>

    <li>".questday10."</li>

    <li>".questday11."</li>

    <li>".questday12."</li>

    <li>".questday13."</li>";
                break;
            case "AchievementQuestReward_03":
                $points=75;
                $reward=$questsData['reward3'];
                if($questsData['reward3']==0 && $points <= $totalPoints){
                    $reward=rand(1,3);
                    switch($reward){
                        case 1:
                            $peoples=$database->query("SELECT wref FROM `vdata` WHERE `owner`='".$_SESSION['id_user']."' LIMIT 1");

                            $database->addAdventure($peoples[0]['wref'], $_SESSION['id_user'],20);
                            break;
                        case 2:
                            $database->addHeroItem($_SESSION['id_user'], 12, 0, 1);
                            $database->addHeroItem($_SESSION['id_user'], 12, 0, 1);
                            //два ведра
                            break;
                        case 3:
                            $database->setSilver($_SESSION['id_user'],1000,1);
                            break;
                    }
					$daily_quest->claimReward(3);
                }


                $prize=constant("questday".($reward+14));
                $prizes="   <li>".questday15."</li>

    <li>".questday16."</li>

    <li>".questday17."</li>";
                break;
            case "AchievementQuestReward_04":
                $points=100;
                $reward=$questsData['reward4'];
                if($questsData['reward4']==0 && $points <= $totalPoints){
                    $reward=rand(1,3);

                    switch($reward){
                        case 1:
                            $database->modifyGold($_SESSION['id_user'],50,1,"Achievment Quest Reward");
                            break;
                        case 2:
                            $database->setSilver($_SESSION['id_user'],4000,1);
                            //два ведра
                            break;
                        case 3:
                            $peoples=$database->query("SELECT wref FROM `vdata` WHERE `owner`='".$_SESSION['id_user']."' LIMIT 1");
                            $database->addAdventure($peoples[0]['wref'], $_SESSION['id_user'],50);
                            break;
                    }
					$daily_quest->claimReward(4);


                }
                $prize=constant("questday".($reward+18));
                $prizes="<li>".questday19."</li>

    <li>".questday20." </li>
    <li>".questday21." </li>";
                break;

        }
$html=json_encode("<div class=\"birthdayRibbonContainer\">
    <div class=\"headline\">
        ".questday2."   </div>
</div>
<div class=\"clear\"></div>

<div class=\"questWrapper achievements\">
    <h2 class=\"questTitle\">".questday32."</h2>
    <hr class=\"achievementLine\" />
 <div class=\"questImage\">
   <img id=\"questLogo\" src=\"img/x.gif\" class=\"enumerableElementsImage ".$_POST['questTutorialId']."\" style=\"\" title=\"".questday33." ".$points." ".questday34."\" alt=\"Набрано ".$points." очков\" />
    </div>

 <div class=\"questDescription\">
  <div id=\"questDescription\" class=\"enumerableElementsDiscription \" style=\"\" title=\"\">
".questday35." ".$points." ".questday36."<br />
".questday37."<br />
<ul>".$prizes."</ul></div>
        <h3 class=\"questRewardTitle\">".questday38." ".$points." ".questday39."</h4>        ".$prize."    </div>

 <div class=\"clear\"></div>

    <hr class=\"achievementLine\" />

 <div class=\"questButtons\">



  <div class=\"clear\"></div>
 </div>
 </div>");

            echo '
{
	response: {"error":false,"errorMsg":null,"data":{"html":'.$html.'}}
}';



        break;



            case "Tutorial_01":
                $html=json_encode("<div class=\"questWrapper\"><div class=\"questImage\"><img id=\"questLogo\" src=\"img/x.gif\" class=\"enumerableElementsImage tutorial_15_reward_image_vid1\" style=\"\" title=\"End of the tutorial\" alt=\"End of the tutorial\" />\t</div><h2 class=\"questTitle\">\tskip tutorial\t</h2><div class=\"questDescription\">\t<div id=\"questDescription\" class=\"enumerableElementsDiscription \" style=\"\" title=\"\">To get you started, I will give you the buildings and advantages from the tutorial. Further tasks and rewards are waiting for you from now until you found your second village. Enjoy playing Travian!</div>\t</div><h4 class=\"questRewardTitle\">Your reward:</h4>\t<div class=\"questRewards\">\t<div id=\"rewardDescription\" class=\"enumerableElementsDiscription \" style=\"\" title=\"\">Rally point, clay pit, woodcutter 2, cropland 2, 10 gold, 1 day PLUS</div>\t</div><div class=\"clear\"></div><div class=\"questButtons\">\t<button  type=\"submit\" value=\"Collect reward.\" id=\"button5482bfe59d80c\" class=\"green questButtonNext\" questButtonNext=\"1\" questId=\"Tutorial_15a\"><div class=\"button-container addHoverClick\">\t<div class=\"button-background\"><div class=\"buttonStart\">\t<div class=\"buttonEnd\"><div class=\"buttonMiddle\"></div>\t</div></div>\t</div>\t<div class=\"button-content\">Collect reward.</div></div></button><script type=\"text/javascript\">window.addEvent('domready', function(){if($('button5482bfe59d80c')){\t$('button5482bfe59d80c').addEvent('click', function ()\t{window.fireEvent('buttonClicked', [this, {\"type\":\"submit\",\"value\":\"Collect reward.\",\"name\":\"\",\"id\":\"button5482bfe59d80c\",\"class\":\"green questButtonNext\",\"title\":\"\",\"confirm\":\"\",\"onclick\":\"\",\"questButtonNext\":true,\"questId\":\"Tutorial_15a\"}]);\t});}});</script>\t<div class=\"clear\"></div></div></div>");


                echo '
{
	response: {"error":false,"errorMsg":null,"data":{"html":'.$html.'}}
}';
                break;



default:
    $html=json_encode("<div id=\"questTodoListDialog\" class=\"questWrapper questToDoList\"><script type=\"text/javascript\">\tTravian.Translation.add({'answers.questTodoList_title': \"Travian Answers\"\t});</script><h4 class=\"round\">Battle\t<div class=\"categoryProgress\">7/14</div></h4>\t<ul>\t<li class=\"questName\"><a class=\"arrow quest\" data-questId=\"Battle_08\" data-category=\"battle\"> <img src=\"img/x.gif\" alt=\"A reward is waiting for you.\"\ttitle=\"A reward is waiting for you.\">10 adventures</a>\t</li><li class=\"questName\"><a class=\"arrow quest\" data-questId=\"Battle_09\" data-category=\"battle\"> <img src=\"img/x.gif\" alt=\"A reward is waiting for you.\"\ttitle=\"A reward is waiting for you.\">Auctions</a>\t</li></ul>\t<h4 class=\"round\">Economy\t<div class=\"categoryProgress\">10/12</div></h4>\t<ul>\t<li class=\"questName\"><a class=\"arrow quest\" data-questId=\"Economy_11\" data-category=\"economy\"> <img src=\"img/x.gif\" alt=\"A reward is waiting for you.\"\ttitle=\"A reward is waiting for you.\">Grain Mill</a>\t</li><li class=\"questName\"><a class=\"arrow quest\" data-questId=\"Economy_12\" data-category=\"economy\"> <img src=\"img/x.gif\" alt=\"A reward is waiting for you.\"\ttitle=\"A reward is waiting for you.\">All to 5</a>\t</li></ul>\t<h4 class=\"round\">World\t<div class=\"categoryProgress\">12/15</div></h4>\t<ul>\t<li class=\"questName\"><a class=\"arrow quest\" data-questId=\"World_12\" data-category=\"world\"> <img src=\"img/x.gif\" alt=\"A reward is waiting for you.\"\ttitle=\"A reward is waiting for you.\">Warehouse level 7</a>\t</li><li class=\"questName\"><a class=\"arrow quest\" data-questId=\"World_14\" data-category=\"world\"> <img src=\"img/x.gif\" alt=\"A reward is waiting for you.\"\ttitle=\"A reward is waiting for you.\">Residence or palace level 10</a>\t</li></ul></div><script type=\"text/javascript\">window.addEvent('domready', function(){\tTravian.Game.Quest.setOptions(\t{dialogListData: {\"quests\":{\"battle\":{\"questsTotal\":14,\"questsCompleted\":7,\"name\":\"Battle\",\"quests\":{\"Battle_08\":{\"id\":\"Battle_08\",\"name\":\"questV2.battle_08_name\",\"category\":\"battle\",\"stepType\":\"task\",\"currentStep\":0,\"stepCount\":2,\"steps\":[{\"stepId\":0,\"type\":\"task\",\"stepDescription\":null},{\"stepId\":1,\"type\":\"reward\"}],\"answersLink\":\"http:\/\/t4.answers.travian.com\/index.php?aid=312#go2answer\"},\"Battle_09\":{\"id\":\"Battle_09\",\"name\":\"questV2.battle_09_name\",\"category\":\"battle\",\"stepType\":\"task\",\"currentStep\":0,\"stepCount\":2,\"steps\":[{\"stepId\":0,\"type\":\"task\",\"stepDescription\":null},{\"stepId\":1,\"type\":\"reward\"}],\"answersLink\":\"http:\/\/t4.answers.travian.com\/index.php?aid=313#go2answer\"}}},\"economy\":{\"questsTotal\":12,\"questsCompleted\":10,\"name\":\"Economy\",\"quests\":{\"Economy_11\":{\"id\":\"Economy_11\",\"name\":\"questV2.economy_11_name\",\"category\":\"economy\",\"stepType\":\"task\",\"currentStep\":0,\"stepCount\":3,\"steps\":[{\"stepId\":0,\"type\":\"task\",\"stepDescription\":null},{\"stepId\":1,\"type\":\"task\",\"stepDescription\":null},{\"stepId\":2,\"type\":\"reward\"}],\"answersLink\":\"http:\/\/t4.answers.travian.com\/index.php?aid=330#go2answer\"},\"Economy_12\":{\"id\":\"Economy_12\",\"name\":\"questV2.economy_12_name\",\"category\":\"economy\",\"stepType\":\"task\",\"currentStep\":0,\"stepCount\":2,\"steps\":[{\"stepId\":0,\"type\":\"task\",\"stepDescription\":null},{\"stepId\":1,\"type\":\"reward\"}],\"answersLink\":\"http:\/\/t4.answers.travian.com\/index.php?aid=331#go2answer\"}}},\"world\":{\"questsTotal\":16,\"questsCompleted\":12,\"name\":\"World\",\"quests\":{\"World_12\":{\"id\":\"World_12\",\"name\":\"questV2.world_12_name\",\"category\":\"world\",\"stepType\":\"task\",\"currentStep\":0,\"stepCount\":2,\"steps\":[{\"stepId\":0,\"type\":\"task\",\"stepDescription\":null},{\"stepId\":1,\"type\":\"reward\"}],\"answersLink\":\"http:\/\/t4.answers.travian.com\/index.php?aid=358#go2answer\"},\"World_14\":{\"id\":\"World_14\",\"name\":\"questV2.world_14_name\",\"category\":\"world\",\"stepType\":\"task\",\"currentStep\":0,\"stepCount\":2,\"steps\":[{\"stepId\":0,\"type\":\"task\",\"stepDescription\":null},{\"stepId\":1,\"type\":\"reward\"}],\"answersLink\":\"http:\/\/t4.answers.travian.com\/index.php?aid=360#go2answer\"}}},\"achievementquests\":{\"questsTotal\":10,\"questsCompleted\":4,\"name\":\"Achievement Quests\",\"quests\":{\"AchievementQuest_02\":{\"id\":\"AchievementQuest_02\",\"name\":\"achievementQuests.achQuest_02_name\",\"category\":\"achievementquests\",\"stepType\":\"achievementtask\",\"currentStep\":0,\"stepCount\":3,\"steps\":[{\"stepId\":0,\"type\":\"achievementtask\",\"stepDescription\":null},{\"stepId\":1,\"type\":\"achievementtask\",\"stepDescription\":null},{\"stepId\":2,\"type\":\"achievementtask\",\"stepDescription\":null}],\"answersLink\":\"http:\/\/t4.answers.travian.com\/index.php?aid=%%achievementQuests.achQuest_02_answer (en)%%#go2answer\"},\"AchievementQuest_03\":{\"id\":\"AchievementQuest_03\",\"name\":\"achievementQuests.achQuest_03_name\",\"category\":\"achievementquests\",\"stepType\":\"achievementtask\",\"currentStep\":0,\"stepCount\":3,\"steps\":[{\"stepId\":0,\"type\":\"achievementtask\",\"stepDescription\":null},{\"stepId\":1,\"type\":\"achievementtask\",\"stepDescription\":null},{\"stepId\":2,\"type\":\"achievementtask\",\"stepDescription\":null}],\"answersLink\":\"http:\/\/t4.answers.travian.com\/index.php?aid=%%achievementQuests.achQuest_03_answer (en)%%#go2answer\"},\"AchievementQuest_04\":{\"id\":\"AchievementQuest_04\",\"name\":\"achievementQuests.achQuest_04_name\",\"category\":\"achievementquests\",\"stepType\":\"achievementtask\",\"currentStep\":0,\"stepCount\":1,\"steps\":[{\"stepId\":0,\"type\":\"achievementtask\",\"stepDescription\":null}],\"answersLink\":\"http:\/\/t4.answers.travian.com\/index.php?aid=%%achievementQuests.achQuest_04_answer (en)%%#go2answer\"},\"AchievementQuest_08\":{\"id\":\"AchievementQuest_08\",\"name\":\"achievementQuests.achQuest_08_name\",\"category\":\"achievementquests\",\"stepType\":\"achievementtask\",\"currentStep\":0,\"stepCount\":3,\"steps\":[{\"stepId\":0,\"type\":\"achievementtask\",\"stepDescription\":null},{\"stepId\":1,\"type\":\"achievementtask\",\"stepDescription\":null},{\"stepId\":2,\"type\":\"achievementtask\",\"stepDescription\":null}],\"answersLink\":\"http:\/\/t4.answers.travian.com\/index.php?aid=%%achievementQuests.achQuest_08_answer (en)%%#go2answer\"},\"AchievementQuest_09\":{\"id\":\"AchievementQuest_09\",\"name\":\"achievementQuests.achQuest_09_name\",\"category\":\"achievementquests\",\"stepType\":\"achievementtask\",\"currentStep\":0,\"stepCount\":3,\"steps\":[{\"stepId\":0,\"type\":\"achievementtask\",\"stepDescription\":null},{\"stepId\":1,\"type\":\"achievementtask\",\"stepDescription\":null},{\"stepId\":2,\"type\":\"achievementtask\",\"stepDescription\":null}],\"answersLink\":\"http:\/\/t4.answers.travian.com\/index.php?aid=%%achievementQuests.achQuest_09_answer (en)%%#go2answer\"},\"AchievementQuest_10\":{\"id\":\"AchievementQuest_10\",\"name\":\"achievementQuests.achQuest_10_name\",\"category\":\"achievementquests\",\"stepType\":\"achievementtask\",\"currentStep\":0,\"stepCount\":3,\"steps\":[{\"stepId\":0,\"type\":\"achievementtask\",\"stepDescription\":null},{\"stepId\":1,\"type\":\"achievementtask\",\"stepDescription\":null},{\"stepId\":2,\"type\":\"achievementtask\",\"stepDescription\":null}],\"answersLink\":\"http:\/\/t4.answers.travian.com\/index.php?aid=%%achievementQuests.achQuest_10_answer (en)%%#go2answer\"}}},\"achievementrewards\":{\"questsTotal\":4,\"questsCompleted\":1,\"name\":\"Achievement Rewards\",\"quests\":[]}}}});Travian.Game.Quest.bindDialogTodoListDelegation();});</script>");



    echo '
{
	response: {"error":false,"errorMsg":null,"data":{"html":'.$html.'}}
}';




        }






        break;


    case 'questachievements':
        session_start();

        include("GameEngine/Database.php");
        if (!isset($_COOKIE['lang']) || empty($_COOKIE['lang'])) {
            $language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            if (in_array($language, array('ru', 'ua', 'be'))) {
                setcookie('lang', 'ru');
                $language=$_COOKIE['lang']='ru';
            } else {
                setcookie('lang', 'en');
                $language=$_COOKIE['lang']='en';
            }
        } else {
            $language = $_COOKIE['lang'];
        }
        include("GameEngine/Lang/" . $language . ".php");
        $achievs=$database->getAchiev($_SESSION['id_user']);
       // file_put_contents('GameEngine/queue2/_log.txt', var_export($achievs, true) . "\r\r",FILE_APPEND);
        $points['1']=floor(min($achievs['a1'],15));
        $points['2']=$achievs['a2']*20;
        $points['3']=min($achievs['a3'],2)*10;
        $points['4']=$achievs['a4']*5;
        $points['5']=floor(min($achievs['a5'],30)/2);
        $points['6']=$achievs['a6']*10;
        $points['7']=$achievs['a7']*5;
        $points['8']=$achievs['a8']*10;
        $done= 'class="hook done" title=" '.questday0.' "';
        $notdone= 'class="hook working" title="'.questday1.' "';
        $hide='class="hook hide"';
        $astatus[1]=(min($achievs['a1'],15)==15)?$done:(($achievs['a1']>0)?$notdone:$hide);
        $astatus[2]=($achievs['a2']==1)?$done:$hide;
        $astatus[3]=(min($achievs['a3'],2)==2)?$done:(($achievs['a3']>0)?$notdone:$hide);
        $astatus[4]=($achievs['a4']==1)?$done:$hide;
        $astatus[5]=(min($achievs['a5'],30)==30)?$done:(($achievs['a5']>0)?$notdone:$hide);
        $astatus[6]=($achievs['a6']==1)?$done:$hide;
        $astatus[7]=($achievs['a7']==1)?$done:$hide;
        $astatus[8]=($achievs['a8']==1)?$done:$hide;
        $red="color:#800000";
        $green="color:#00CC00";
        $yellow="color: #836fff";
        $acolor[1]=(min($achievs['a1'],15)==15)?$green:(($achievs['a1']>0)?$yellow:$red.';cursor:pointer;');
        $acolor[2]=($achievs['a2']==1)?$green:$red;
        $acolor[3]=(min($achievs['a3'],2)==2)?$green:(($achievs['a3']>0)?$yellow:$red);
        $acolor[4]=($achievs['a4']==1)?$green:$red;
        $acolor[5]=(min($achievs['a5'],30)==30)?$green:(($achievs['a5']>0)?$yellow:$red);
        $acolor[6]=($achievs['a6']==1)?$green:$red;
        $acolor[7]=($achievs['a7']==1)?$green:$red;
        $acolor[8]=($achievs['a8']==1)?$green:$red;
        
		require_once __DIR__.'/GameEngine/DailyQuest.php';	
		$daily_quest = new DailyQuest($_SESSION['id_user']);
		$daily_quest->createQuest();
		$questsData = $daily_quest->getQuests();	
		
		$totalPoints = min($questsData['adventure']*5, 5)
						+ min($questsData['raid_oasis']*3, 9)
						+ min($questsData['auction']*5, 15)
						+ min($questsData['gain_spend_gold']*2, 6)
						+ min($questsData['upgrade_building']*4, 12)
						+ min($questsData['upgrade_resource']*5, 15)
						+ min($questsData['build_infantry']*4, 12)
						+ min($questsData['build_cavalry']*4, 12)
						+ min($questsData['celebration']*5, 15)
						+ min($questsData['vote']*2, 4);
		
		$sum=$totalPoints;
		
		
		
        $title1=(!$questsData['reward1'])?questday4."<br/>
        <ul>
            <li>".questday5."</li>


            <li>".questday6."</li>

            <li>".questday7."</li>

        </ul>":"".questday40."<br /> ".constant("questday".($questsData['reward1']+4));
$title2=(!$questsData['reward2'])?questday8."<br/>
<ul>
    <li>".questday9."</li>

    <li>".questday10."</li>

    <li>".questday11."</li>

    <li>".questday12."</li>

    <li>".questday13."</li>

</ul>":"Your reward today:<br /> ".constant("questday".($questsData['reward2']+8));
        $title3=(!$questsData['reward3'])?questday14."<br/>
<ul>
    <li>".questday15."</li>

    <li>".questday16."</li>

    <li>".questday17."</li>

</ul>":"Your reward today:<br /> ".constant("questday".($questsData['reward3']+13));
        $title4=(!$questsData['reward4'])?questday18."<br/>
<ul>
    <li>".questday19."</li>

    <li>".questday20." </li>
    <li>".questday21." </li>

</ul>":"".questday40."<br /> ".constant("questday".($questsData['reward4']+18));
        $html = json_encode("<div class=\"questWrapper achievements mainDialog\">
<div class=\"birthdayRibbonContainer\">
    <div class=\"headline\"> ".questday2."</div>
</div>
<div class=\"clear\"></div>
<div class=\"pointsAndAchievements\">
    <div class=\"achievementPoints\">
        <div class=\"points\"> ".$sum."</div>
        <div class=\"pointstext\"> ".questday3."</div>
    </div>
    <div id=\"achievementRewardList\">
        <div class=\"verticalLine\"></div>
        <div class=\"achievementArrow\"><img src=\"img/x.gif\"/></div>
        <div class=\"achievement\">
        ".(($sum>=25 && $questsData['reward1']==0)?"
        <a data-questid=\"AchievementQuestReward_01\" data-category=\"achievementrewards\" class=\"quest\" href=\"#\">
        <div class=\"bigSpeechBubble rewardReady\">
                                    <img src=\"img/x.gif\" alt=\"\">
                                </div>":(($sum>=25 && $questsData['reward1']>0)?"
                            <div class=\"hook points_25\">
                                <img src=\"img/x.gif\" alt=\"\">
                            </div>
                            ":""))."
        <div class=\"pointAmount points_25
        \"> 25
    </div>
    <img src=\"img/x.gif\" class=\"points_25 ".(($sum<25)?('in'):(''))."active\" />
    </a>
</div>
<div class=\"achievementArrow\"><img src=\"img/x.gif\"/></div>
<div class=\"achievement\">
        ".(($sum>=50 && $questsData['reward2']==0)?"
        <a data-questid=\"AchievementQuestReward_02\" data-category=\"achievementrewards\" class=\"quest\" href=\"#\">
        <div class=\"bigSpeechBubble rewardReady\">
                                    <img src=\"img/x.gif\" alt=\"\">
                                </div>":(($sum>=50 && $questsData['reward2']>0)?"
                            <div class=\"hook points_50\">
                                <img src=\"img/x.gif\" alt=\"\">
                            </div>
                            ":""))."
<div class=\"pointAmount points_50\">                                50                            </div>
<img src=\"img/x.gif\" class=\"points_50 ".(($sum<50)?('in'):(''))."active\" />     </a>                   </div>
<div class=\"achievementArrow\"><img src=\"img/x.gif\"/></div>
<div class=\"achievement\">
        ".(($sum>=75 && $questsData['reward3']==0)?"
        <a data-questid=\"AchievementQuestReward_03\" data-category=\"achievementrewards\" class=\"quest\" href=\"#\">
        <div class=\"bigSpeechBubble rewardReady\">
                                    <img src=\"img/x.gif\" alt=\"\">
                                </div>":(($sum>=75 && $questsData['reward3']>0)?"
                            <div class=\"hook points_75\">
                                <img src=\"img/x.gif\" alt=\"\">
                            </div>
                            ":""))."
<div class=\"pointAmount points_75\">                                75                            </div>
<img src=\"img/x.gif\" class=\"points_75 ".(($sum<75)?('in'):(''))."active\" />         </a>               </div>
<div class=\"achievementArrow\"><img src=\"img/x.gif\"/></div>
<div class=\"achievement\">
        ".(($sum>=100 && $questsData['reward4']==0)?"
        <a data-questid=\"AchievementQuestReward_04\" data-category=\"achievementrewards\" class=\"quest\" href=\"#\">
        <div class=\"bigSpeechBubble rewardReady\">
                                    <img src=\"img/x.gif\" alt=\"\">
                                </div>":(($sum>=100 && $questsData['reward4']>0)?"
                            <div class=\"hook points_100\">
                                <img src=\"img/x.gif\" alt=\"\">
                            </div>
                           ":""))."
<div class=\"pointAmount points_100\">                                100                            </div>
<img src=\"img/x.gif\" class=\"points_100 ".(($sum<100)?'in':'')."active\" />                </a>        </div>        </div>    </div>
<div class=\"clear\"></div>
<hr class=\"achievementLine\"/>
<div class=\"achievement\" ><h1 class=\"questList\">".questday22."</h1>

    <div class=\"nextReset\">".questday23."</div>
    <table id=\"achievementQuestList\">	

	<tr class=\"\">       

	<td class=\"hook\"><img src=\"img/x.gif\" class=\"hook ".($questsData['adventure'] > 0 ? 'done' : '')."\"/></td>    

	<td class=\"steps\">".min($questsData['adventure'], 1)."/1</td>      

	<td class=\"questName\">Complete an adventure</td>       

	<td class=\"points\">+ ".min($questsData['adventure']*5, 5)." / 5</td>     

	</tr>		
	
	
	<tr class=\"zebra\">          

	<td class=\"hook\"><img src=\"img/x.gif\" class=\"hook ".($questsData['raid_oasis'] > 2 ? 'done' : '')."\"/></td>        

    <td class=\"steps\">".min($questsData['raid_oasis'], 3)."/3</td>          

	<td class=\"questName\">Raid an unoccupied oasis</td>         

	<td class=\"points\">+ ".min($questsData['raid_oasis']*3, 9)." / 9</td>      

	</tr>

	<tr class=\"zebra\">      

	<td class=\"hook\"><img src=\"img/x.gif\" class=\"hook ".($questsData['auction'] > 2 ? 'done' : '')."\"/></td>       

	<td class=\"steps\">".min($questsData['auction'], 3)."/3</td>       

	<td class=\"questName\">Win an auction</td>       

	<td class=\"points\">+ ".min($questsData['auction']*5, 5)." / 15</td>     

	</tr>		<tr class=\"\">           
	<td class=\"hook\"><img src=\"img/x.gif\" class=\"hook ".($questsData['gain_spend_gold'] > 2 ? 'done' : '')."\"/></td>            
	<td class=\"steps\">".min($questsData['gain_spend_gold'], 3)."/3</td>            
	<td class=\"questName\">Gain or spend gold</td>            
	<td class=\"points\">+ ".min($questsData['gain_spend_gold']*2, 6)." / 6</td>        
	</tr>		
	<tr class=\"zebra\">            
	<td class=\"hook\"><img src=\"img/x.gif\" class=\"hook ".($questsData['upgrade_building'] > 2 ? 'done' : '')."\"/></td>        
    <td class=\"steps\">".min($questsData['upgrade_building'], 3)."/3</td>            
	<td class=\"questName\">Upgrade a building</td>            <td class=\"points\">+ ".min($questsData['upgrade_building']*4, 12)." / 12</td>        </tr>		<tr class=\"\">            <td class=\"hook\"><img src=\"img/x.gif\" class=\"hook ".($questsData['upgrade_resource'] > 2 ? 'done' : '')."\"/></td>            <td class=\"steps\">".min($questsData['upgrade_resource'], 3)."/3</td>            <td class=\"questName\">Upgrade a resource field</td>            <td class=\"points\">+ ".min($questsData['upgrade_resource']*5, 15)." / 15</td>        </tr>		<tr class=\"zebra\">            <td class=\"hook\"><img src=\"img/x.gif\" class=\"hook ".($questsData['build_infantry'] > 2 ? 'done' : '')."\"/></td>            <td class=\"steps\">".min($questsData['build_infantry'], 3)."/3</td>            <td class=\"questName\">Build 20 infantry units of one type at once</td>            <td class=\"points\">+ ".min($questsData['build_infantry']*4, 12)." / 12</td>        </tr>		<tr class=\"\">            <td class=\"hook\"><img src=\"img/x.gif\" class=\"hook ".($questsData['build_cavalry'] > 2 ? 'done' : '')."\"/></td>            <td class=\"steps\">".min($questsData['build_cavalry'], 3)."/3</td>            <td class=\"questName\">Build 20 cavalry units of one type at once</td>            <td class=\"points\">+ ".min($questsData['build_cavalry']*4, 12)." / 12</td>        </tr>		<tr class=\"zebra\">            <td class=\"hook\"><img src=\"img/x.gif\" class=\"hook ".($questsData['celebration'] > 2 ? 'done' : '')."\"/></td>            <td class=\"steps\">".min($questsData['celebration'], 3)."/3</td>            <td class=\"questName\">Hold a small or big celebration</td>            <td class=\"points\">+ ".min($questsData['celebration']*5, 15)." / 15</td>        </tr>
		
		
		
	
    </table>
	
</div></div>
<script type=\"text/javascript\">
        Travian.Game.Quest.bindListDelegation('achievementQuestList');    Travian.Game.Quest.bindListDelegation('achievementRewardList');    Travian.Tip.refresh();
</script>");
        echo '
{
	response: {"error":false,"errorMsg":null,"data":{"html":'.$html.'}}
}';
        break;
    case 'silverExchange' :
        session_start();
        include("GameEngine/Database.php");
        if($_SESSION['s4']){
			$silver=$_POST['s'];
			if(!intval($_POST['s'])){exit;}
			$goldblya=floor($silver/2000);
			/*$user_silver = $database->getUserSilver($_SESSION['id_user']);
			if($silver>=2000 && $user_silver>=$silver){
				$silvers = "- ".$goldblya*2000;
				$database->setSilver($_SESSION['id_user'],$goldblya*2000,0);
				$database->modifyGold($_SESSION['id_user'],$goldblya,1,"Exchanged from silver[".$silvers."]");
			}*/
			
			$UID = $_SESSION['id_user'];
			$counter = 0;
			$waiting=true;
			while($waiting && $counter < 10) {
				try {
					$database->starttransaction("silver2gold_".$UID);
					
					$user_silver = $database->getUserSilver($_SESSION['id_user']);
					if($silver>=2000 && $user_silver>=$silver){
						$silvers = "- ".$goldblya*2000;
						$database->setSilver($_SESSION['id_user'],$goldblya*2000,0);
						$database->modifyGold($_SESSION['id_user'],$goldblya,1,"Exchanged from silver[".$silvers."]");
					}
					
					$waiting = false;
				} catch (PDOException $e) {
					if (stripos($e->getMessage(), 'DATABASE IS LOCKED') !== false || stripos($e->getMessage(),"There is already an active transaction")) {
						addToLog("general","Thread waitning for lock to lift - troop send back");
						usleep(500000);
					} else {
						$database->pdo->commitq("silver2gold_".$UID);
					}
				}
				$counter++;
			}
			$database->commitq("silver2gold_".$UID);

			echo '{response: {"error":false,"errorMsg":null,"data":{result:true,"type":"SilverToGold","silver":'.$silver.',"gold":'.$goldblya.',"oldSilver":"'.$_SESSION['silver'].'","oldGold":"'.$_SESSION['gold'].'","newSilver":'.($_SESSION['silver']-$goldblya*2000).',"newGold":'.($_SESSION['gold']+$goldblya).'}}}';
        }
        break;


    case 'heroSetAttributes':
        session_start();
        include("GameEngine/Database.php");
        $uid=$_SESSION['id_user'];
        $heroD=$database->WowSoQueryH($uid);

        $att=$prod=$abon=$dbon=0;
        $att=intval($database->FilterIntValue($_POST['attributes']['power']));
        $abon=intval($database->FilterIntValue($_POST['attributes']['offBonus']));
        $dbon=intval($database->FilterIntValue($_POST['attributes']['defBonus']));
        $prod=intval($database->FilterIntValue($_POST['attributes']['productionPoints']));
        if(!in_array($_POST['resource'],array(0,1,2,3,4))){ echo 'Burn motherfucker,burn.';die;}
        
		if(($att > 0 OR  $abon > 0 OR $dbon > 0 OR $prod > 0) AND ($att >= 0 and  $abon >= 0 and $dbon >= 0 and $prod >= 0) ){
            $points_spent=$att+$abon+$dbon+$prod;
            $points_availible_per_level=(($heroD['level']==0)?1:$heroD['level'])*4;
            $points_availible=$points_availible_per_level-($heroD['power']+$heroD['offBonus']+$heroD['defBonus']+$heroD['product']);
            $ost=$points_availible-$points_spent;

            if($ost>=0 && $ost!=$points_availible){

                if(($heroD['power']+$att)<100){
                    $database->query("UPDATE hero SET `power` = `power`+".$att." WHERE `uid` = '" . $uid . "'");
                }elseif($att>0){ $database->query("UPDATE hero SET `power` = 100 WHERE `uid` = '" . $uid . "'");}
                if(($heroD['offBonus']+$abon)<100){
                    $database->query("UPDATE hero SET `offBonus` = `offBonus`+".$abon." WHERE `uid` = '" . $uid . "'");
                }elseif($abon>0){$database->query("UPDATE hero SET `offBonus` = 100 WHERE `uid` = '" . $uid . "'");}
                if(($heroD['defBonus']+$dbon)<100){
                    $database->query("UPDATE hero SET `defBonus` = `defBonus`+".$dbon." WHERE `uid` = '" . $uid . "'");
                }elseif($dbon>0){$database->query("UPDATE hero SET `defBonus` = 100 WHERE `uid` = '" . $uid . "'");}
                if(($heroD['product']+$prod)<100){
                    $database->query("UPDATE hero SET `product` = `product`+".$prod." WHERE `uid` = '" . $uid . "'");}
                else{$database->query("UPDATE hero SET `product` = 100 WHERE `uid` = '" . $uid . "'");}
            }


        }
        if($_POST['attackBehaviour']=='fight'){
            $database->modifyHero2('hide', 0, $uid, 0);
        }
        if($_POST['attackBehaviour']=='hide'){
            $database->modifyHero2('hide', 1, $uid, 0);
        }

        for($i=0;$i<=4;$i++){
            if($_POST['resource'] == $i){
                $database->modifyHero2('r'.$i, 1, $_SESSION['id_user'], 0);
            }else{
                $database->modifyHero2('r'.$i, 0, $_SESSION['id_user'], 0);
            }


        }
        echo '{response: {"error":false,"errorMsg":null,"data":{}}}';
        break;
    case 'premiumFeature':
        session_start();
        $id=$_REQUEST['featureKey'];
        $uid=$_SESSION['id_user'];
        if($_SESSION['s4']){
			include("GameEngine/Database.php");
			$gol= $database->query("SELECT `gold` FROM users WHERE `id`='".$uid."'");
			$gold=$gol[0]['gold'];
			$cost = 10000000;
			switch($id) {
				case 6: $cost=COSTCP;break;
				case 7: $cost=COSTCP;break;
				case 8:  $type="plus"; $cost=20; break;
				case 9:  $type="b1";   $cost=5; break;
				case 10: $type ="b2";  $cost=5; break;
				case 11: $type ="b3";  $cost=5; break;
				case 12: $type ="b4";  $cost=5; break;
				case 13: $cost=COSTRES; break;
				case 15: $cost=250; break;
				case 21: $type ="a1";  $cost=OFFENSE1_COST; break;
				case 31: $type ="d1";  $cost=DEFENCE1_COST; break;
				case 41: $cost=20;$dest="plus.php?id=traviann&";$action="lumber"; break;
				case 42: $cost=20;$dest="plus.php?id=traviann&";$action="clay"; break;
				case 43: $cost=20;$dest="plus.php?id=traviann&";$action="iron"; break;
				case 44: $cost=20;$dest="plus.php?id=traviann&";$action="crop"; break;
				case 45: $cost=80;$dest="plus.php?id=traviann&";$action="combo1"; break;
				case 46: $cost=480;$dest="plus.php?id=traviann&";$action="combo2"; break;
				case 47: $cost=1920;$dest="plus.php?id=traviann&";$action="combo3"; break;
				
				case 51: $cost=2;$dest="more.php?";$action="buyAdventure"; break;
				case 52: $cost=10;$dest="plus.php?id=pbuild&";$action="warehouse20"; break;
				case 53: $cost=10;$dest="plus.php?id=pbuild&";$action="granary20"; break;
				case 54: $cost=10;$dest="plus.php?id=pbuild&";$action="main20"; break;
				case 55: $cost=20;$dest="plus.php?id=pbuild&";$action="ordoogah"; break;
				case 56: $cost=30;$dest="plus.php?id=pbuild&";$action="barracks20"; break;
				case 57: $cost=30;$dest="plus.php?id=pbuild&";$action="stable20"; break;
				case 58: $cost=30;$dest="plus.php?id=pbuild&";$action="workshop20"; break;
				case 59: $cost=20;$dest="plus.php?id=pbuild&";$action="academy20"; break;
				case 60: $cost=30;$dest="plus.php?id=pbuild&";;$action="smithy20"; break;
				case 61: $cost=30;$dest="plus.php?id=pbuild&";$action="treasury20"; break;
				case 62: $cost=30;$dest="plus.php?id=pbuild&";$action="tournament_square20"; break;
				case 63: $cost=150;$dest="plus.php?id=traviann&";$action="manba2"; break;
				case 64: $cost=300;$dest="plus.php?id=traviann&";$action="manba"; break;
				case 65: $cost=500;$dest="plus.php?id=traviann&";$action="manba3"; break;
				
				case 71: $cost=100;$dest="plus.php?id=traviann&";$action="n1"; break;
				case 72: $cost=200;$dest="plus.php?id=traviann&";$action="n2"; break;
				case 73: $cost=400;$dest="plus.php?id=traviann&";$action="n3"; break;
				case 74: $cost=800;$dest="plus.php?id=traviann&";$action="n4"; break;
				case 75: $cost=1600;$dest="plus.php?id=traviann&";$action="n5"; break;
				case 76: $cost=3200;$dest="plus.php?id=traviann&";$action="n6"; break;
			}
			if($id>600){
				$pack = $id%600;
				$dest="plus.php?id=traviann&troop=1&";
				$action=$pack;
				$cost=(($pack%10==1)?100:(($pack%10==2)?200:(($pack%10==3)?400:(($pack%10==4)?1000:(($pack%10==5)?5000:(($pack%10==6)?10000:100000))))));//100/200/400/1000
			}
			elseif($id>500){
				$pack = $id%500;
				$dest="plus.php?id=traviann&troop=1&";
				$action=$pack;
				$cost=(($pack%10==1)?100:(($pack%10==2)?200:(($pack%10==3)?400:(($pack%10==4)?1000:(($pack%10==5)?5000:(($pack%10==6)?10000:100000))))));//100/200/400/1000
			}
			elseif($id>300){
				$pack = $id%300;
				$dest="plus.php?id=traviann&troop=1&";
				$action=$pack;
				$cost=(($pack%10==1)?100:(($pack%10==2)?200:(($pack%10==3)?400:(($pack%10==4)?1000:(($pack%10==5)?5000:(($pack%10==6)?10000:100000))))));//100/200/400/1000
			}
			elseif($id>200){
				$pack = $id%200;
				$dest="plus.php?id=traviann&troop=1&";
				$action=$pack;
				$cost=(($pack%10==1)?100:(($pack%10==2)?200:(($pack%10==3)?400:(($pack%10==4)?1000:(($pack%10==5)?5000:(($pack%10==6)?10000:100000))))));//100/200/400/1000
			}
			elseif($id>100){
				$pack = $id%100;
				$dest="plus.php?id=traviann&troop=1&";
				$action=$pack;
				$cost=(($pack%10==1)?100:(($pack%10==2)?200:(($pack%10==3)?400:(($pack%10==4)?1000:(($pack%10==5)?5000:(($pack%10==6)?10000:100000))))));//100/200/400/1000
			}		
			
			if($gold-$cost>=0){
				$database->UpdateAchievU($uid,"`a5`=a5+".$cost);
						
				if($id>=41){
					$opts = array( 'http'=>array( 'method'=>"GET",
								  'header'=>"Accept-language: en\r\n" .
								   "Cookie: ".session_name()."=".session_id()."\r\n" ) );

					$context = stream_context_create($opts);
					session_write_close();   
					error_reporting(0);
					file_get_contents(HOMEPAGE.$dest."action=".$action, false, $context);
					echo json_encode( array('response' => array('data' => array('functionToCall'=>"reloadDialog",'context'=>"paymentWizard"))) );
					die();
				}elseif($id == 15){
					$database->BuyClub($uid);
				}elseif($id == 13){       
					$database->buyRes($uid,$gold,$_SESSION['wid'],COSTRES,HOWRES);                
				}elseif ($id == 7) {
					include("GameEngine/Village.php");
					include("GameEngine/Building.php");
					global $database,$session,$village,$bid18,$building;		
					$building->finishAll();
				}elseif ($id == 6) {
					$database->buyCp($uid);
				}
				elseif($id>7 && $id<41){
					$database->buyPlus($type,$cost,$uid,$gold);
				}
				echo '{"response": {"error":false,"errorMsg":null,"data":{"functionToCall":"reloadDialog","context":"paymentWizard"}}}';
				die();
			}
			echo '{"response": {"error":true,"errorMsg":"No gold?","data":{}}}';
        }
        break;
    case 'viewTileDetails':
        $x = $_POST['x'];
        $y = $_POST['y'];
        ob_start(); // begin collecting output

        include 'Templates/Map/vildialog.php';
        $html = ob_get_clean(); // retrieve output from myfile.php, stop buffering
        echo json_encode( array('response' => array('data'=>array('html' => $html))) );
        break;
    case 'changeVillageName':

        include("GameEngine/Database.php");
        $_POST['name']=$database->RemoveXSS($_POST['name']);
        if(str_replace(" ","",$_POST['name'])!=''){
        $p=array('N'=>$_POST['name'],'D'=>$_POST['did'],'UID'=>$_SESSION['id_user']);
        $database->query("UPDATE vdata SET `name` = :N where `wref` = :D and owner=:UID",$p);
        echo json_encode( array('response' => array('data' => array('name'=>$_POST['name'],'bname'=>$_POST['name']))) );
        }
        break;

    case 'heroEditor':
        session_start();
        include("GameEngine/Database.php");
        $herodetail = $heroD=$database->WowSoQueryH($_SESSION['id_user']);
        $getcolor = $herodetail['color'];
        if($herodetail['gender']==0) {$gstr='male';} else {$gstr='female';}
        $gender=$herodetail['gender'];
        $geteye = $herodetail['eye'];if ($gender==0) $geteye%=5;
        $geteyebrow = $herodetail['eyebrow'];if ($gender==0) $geteyebrow%=5;
        $getnose = $herodetail['nose'];if ($gender==0) $getnose%=5;
        $getear = $herodetail['ear'];if ($gender==0) $getear%=5;
        $getmouth = $herodetail['mouth'];if ($gender==0) $getmouth%=4;
        $getbeard = $herodetail['beard']; if ($gender==1) $getbeard=5;
        $gethair = $herodetail['hair'];if ($gender==0) $gethair%=5;
        $getface = $herodetail['face'];if ($gender==0) $getface%=5;
        $head = $_POST['attribs']['headProfile'];
        $color = $_POST['attribs']['hairColor'];
        $hair = $_POST['attribs']['hairStyle'];
        $ear = $_POST['attribs']['ears'];
        $eyebrow = $_POST['attribs']['eyebrow'];
        $eye = $_POST['attribs']['eyes'];
        $nose = $_POST['attribs']['nose'];
        $mouth = $_POST['attribs']['mouth'];
        $beard = $_POST['attribs']['beard'];
        if($beard == 5999) $beard = -1; // some fix
        if($head != $getface){					$atrface = $head;					if ($gender==0) $atrface%=5;				}
        else{					$atrface = $getface;				}
        if($hair != $gethair){					$atrhair = $hair;					if ($gender==0) $atrhair%=5;				}
        else{					$atrhair = $gethair;				}
        if($ear != $getear){					$atrear = $ear;					if ($gender==0) $atrear%=5;				}
        else{					$atrear = $getear;				}
        if($eye != $geteye){					$atreye = $eye;					if ($gender==0) $atreye%=5;				}
        else{					$atreye = $geteye;				}
        if($mouth != $getmouth){					$atrmouth = $mouth;					if ($gender==0) $atrmouth%=5;				}
        else{					$atrmouth = $getmouth;				}
        if($beard != $getbeard){					$atrbeard = $beard;					if ($gender==0) $atrbeard%=5;				}
        else{					$atrbeard = $getbeard;				}
        if($nose != $getnose){					$atrnose = $nose;					if ($gender==0) $atrnose%=5;				}
        else{					$atrnose = $getnose;				}
        if($eyebrow != $geteyebrow){					$atreyebrow = $eyebrow;					if ($gender==0) $atreyebrow%=5;				}
        else{					$atreyebrow = $geteyebrow;				}
        if($color != $getcolor){					$atrcolor = $color;		}
        else{					$atrcolor = $getcolor;				}
        if($atrcolor==0){
            $color = "black";
        }
        if($atrcolor==1){
            $color = "brown";
        }
        if($atrcolor==2){
            $color = "darkbrown";
        }
        if($atrcolor==3){
            $color = "yellow";
        }
        if($atrcolor==4){
            $color = "red";
        }
        include("Templates/Ajax/heroeditor.tpl");
        break;

    case 'overlay':
        include("Templates/Ajax/overlay.tpl");
        break;	
	case 'bbuyAdventure':
		$error = true;
		if($session->gold >= 2) {			
			include("GameEngine/Database.php");
			$database->addAdventure($village->wid, $session->uid,1);
			$database->modifyGold($session->uid,2,0,"Bought Adventure");
			$done1 =  "Your purchace is successful.";
			$error = false;
		}else{
			$done1 = "Not enough gold coin";
		}
		break;
	case 'paymentWizard':
		require_once __DIR__.'/GameEngine/Village.php';	
		require_once __DIR__.'/GameEngine/Session.php';		
		$response = array("response"=>array("error"=>false,"errorMsg"=>"","data"=>array("html"=>"")));
		switch($_REQUEST['activeTab']){
			case 'pros':
				$response['response']['data']['html'] = readFileAsStringStream("advantages.php");
				break;
			case 'buyResources':
				$response['response']['data']['html'] = readFileAsStringStream("buyResources.php");
				break;				
			case 'buyBuildings':
				$response['response']['data']['html'] = readFileAsStringStream("buyBuildings.php");
				break;
			case 'buyTroops':
				$response['response']['data']['html'] = readFileAsStringStream("buyTroops.php");
				break;
			case 'extraPlus':
				$response['response']['data']['html'] = readFileAsStringStream("extraPlus.php");
				break;	
			case 'bank':
				$response['response']['data']['html'] = readFileAsStringStream("bank.php");
				break;					
			case 'buyGold':
			default:				
				$response['response']['data']['html'] = readFileAsStringStream("buyGold.php");
		}
		echo json_encode($response);
		break;
	case 'paymentProviders':
		require_once __DIR__.'/GameEngine/Village.php';		
		$response = array("response"=>array("error"=>false,"errorMsg"=>"","data"=>array("html"=>"")));
		$response['response']['data']['html'] = readFileAsStringStream("providers.php");
		echo json_encode($response);
		
		break;
}


function readFileAsStringStream($file){
	$file_contents;
	ob_start();
	include dirname(__FILE__)."/Templates/Plus/tabs/".$file;
	$file_contents = ob_get_contents();
	ob_end_clean();
	return $file_contents;
}
