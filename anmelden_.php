<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(file_exists((dirname(__FILE__))."/GameEngine/autoinstall.txt")){
	echo "Install in progress";
	die();
}
$result = json_decode(file_get_contents('https://www.aspidanetwork.com/scripts/ban_system/tmp_ban_check.php?ip='.$_SERVER['REMOTE_ADDR']),true);
if(!empty($result) && !empty($result) && isset($result['result']) && $result['result']){
	header('Location: ban.html');
}
include('GameEngine/Account.php');

if(!empty($_GET['ref'])){$inviter=$database->filterstringvalue($_GET['ref']);}

$disabled = false;
$isFinished = $database->row("SELECT * FROM status LIMIT 1");

$now = time();
$restartDate = $isFinished['restartTime'];
if($now < $restartDate){
	$date1 = new DateTime();$date1->setTimestamp($now);
	$date2 = new DateTime();$date2->setTimestamp($restartDate);
	$diff = $date2->diff($date1);
	$disabled = true;
	//if time to start is lower than 12 then enable register
	if($diff->y ==0 && $diff->d ==0 && $diff->h <= 12 && $diff->invert){	
		$disabled = false;
	}else{	
		$duration = $generator->getTimeFormat($isFinished['restartTime']-time());
	}
}else{
	$disabled = false;
}
?>
<!DOCTYPE html>
<html>
<?php include("Templates/html.php");?>
<body class="v35 <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> signup perspectiveBuildings">
<div id="background">
    <img id="staticElements" src="img/x.gif" alt=""/>
    <div id="bodyWrapper">
        <img style="filter:chroma();" src="img/x.gif" id="msfilter" alt=""/>
        <div id="header">
            <div id="mtop">
                <a id="logo" href="<?php echo HOMEPAGE; ?>" target="_blank" title="<?php echo SERVER_NAME; ?>"></a>
                <div class="clear"></div>
            </div>
        </div>
        <div id="center">
            <?php include('Templates/menu.php');?>
            <div id="contentOuterContainer" class="size1">
                <div class="contentTitle">&nbsp;</div>
                <div class="contentContainer">
                    <div id="content" class="signup">
						<h1 class="titleInHeader"><?php echo REG; ?></h1>

                        <h4 class="round"><?php echo REGISTER_USERINFO; ?></h4>
						<?php if(!$disabled){ ?>
                        <form name="snd" method="post" action="anmelden.php">
                            <input type="hidden" name="ft" value="a1" />
                            <table cellpadding="0" cellspacing="0" align="center">
                                <tbody>
                                <tr class="top">
                                    <th><?php echo INVITED; ?></th>
                                    <td><input class="text" type="text" name="referal"  value="<?php if(!empty($inviter) && is_numeric($inviter)){echo $database->getUserField($inviter,'username',0); }elseif(!empty($inviter) && !is_numeric($inviter)){
                                            echo $inviter;
                                        } ?>" maxlength="15"  />
                                    </td>
                                </tr>

                                <th><?php echo NICKNAME; ?></th>
                                <td><input class="text" type="text" name="name" placeholder="<?=anlm0?>" value="<?php echo $form->getValue('name'); ?>" maxlength="15" />
                                    <span class="error"><?php echo $form->getError('name'); ?></span>
                                </td>

                                <tr>
                                    <th><?php echo EMAIL; ?></th>
                                    <td>
                                        <input class="text" type="text"  placeholder="<?=anlm1?>"  name="email" value="<?php echo stripslashes($form->getValue('email')); ?>" />
                                        <span class="error"><?php echo $form->getError('email'); ?></span>
                                    </td>
                                </tr>
                                <tr class="btm">
                                    <th><?php echo PASSWORD; ?></th>
                                    <td>
                                        <input class="text" type="password"  placeholder="<?=anlm2?>" name="pw" value="<?php echo stripslashes($form->getValue('pw')); ?>" maxlength="30" />
                                        <span class="error"><?php echo $form->getError('pw'); ?></span>
                                    </td>
                                </tr>
								
                                </tbody>
                            </table>
                            <h4 class="round"><?php echo REGISTER_MOREINFO; ?></h4>
                            <div class="checks">
                                <input class="check" type="checkbox" id="agb" name="agb" value="1" <?php echo $form->getRadio('agb',1); ?>/>
                                <label for="agb"><?php echo ACCEPT_RULES; ?></label>
                            </div>			

							<span class="error"><?php echo $form->getError('agree'); ?></span>
                            <div class="btn">
                                <input type="hidden" name="vid" value="0">
                                <input type="hidden" name="kid" value="0">
                                <button type="submit" value="anmelden" name="s1" class="green "  id="btn_signup" title="Register">
                                    <div class="button-container addHoverClick ">
                                        <div class="button-background">
                                            <div class="buttonStart">
                                                <div class="buttonEnd">
                                                    <div class="buttonMiddle"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="button-content"><?php echo REG; ?></div>
                                    </div>
                                </button>
                            </div>
                        </form>
						<?php } else {
							echo "<h2><center>Round finished.</h2><hr>";
							echo "<span class=\"error\">";
							echo "<p><center>New server will be starting in: <br>
							<center><strong><div class=\"dur_r\"><span id=\"timer142\">{$duration}</span></div></p><hr>";
							echo "</span>";
						}?>
                        <div class="clear">&nbsp;</div>
							<img src="img/travianbg.png" alt="Mountain View" style="width:540px;height:300px;">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="contentFooter">&nbsp;</div>
            </div>

        </div>


    </div>
    <div id="ce"></div></div></div></div>
	<script src='https://www.google.com/recaptcha/api.js'></script>
</body>
</html>
