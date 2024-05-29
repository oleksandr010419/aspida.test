<?php
//login.php
$result = @json_decode(file_get_contents('https://www.aspidanetwork.com/ban_system/tmp_ban_check.php?ip=' . $_SERVER['REMOTE_ADDR']), true);
if (!empty($result) && isset($result['result']) && $result['result']) {
    header('Location: ban.html');
    exit;
}

include("GameEngine/Account.php");
$isFinished = $database->row("SELECT * FROM status LIMIT 1");
$now = time();
$restartDate = $isFinished['restartTime'];
$date1 = new DateTime();
$date1->setTimestamp($now);
$date2 = new DateTime();
$date2->setTimestamp($restartDate);
$diff = $date2->diff($date1);
$hours = $diff->h;	
$disabled = false;
if($diff->y ==0 && $diff->d ==0 && $diff->h <= 12 && $diff->invert)
{	
	$disabled = true;
}

if(isset($_GET['del_cookie'])) {
	setcookie("COOKUSR","",time()-3600*24,"/login.php");
	setcookie("PW","",time()-3600*24,"/login.php");
	header("Location: login.php");
    exit();
}

if(!isset($_COOKIE['COOKUSR'])) {
	$_COOKIE['COOKUSR'] = "";
}
if(!isset($_COOKIE['PW'])) {
	$_COOKIE['PW'] = "";
}

?>
<!DOCTYPE html>
<html>
<?php include("Templates/html.php");?>

<body
    class="<?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> login v35 chrome blink en-US perspectiveBuildings ltr mobileOptimized"
    data-theme="default">
    <div id="background">
        <img id="staticElements" src="img/x.gif" alt="" />
        <div id="bodyWrapper">
            <div id="topBar">
                <!-- <a id="logo" href="https://www.travian.com/international" target="_blank" previewlistener="true">
                </a> -->
                <div id="header" class="referAFriend">
                    <!-- <input type="checkbox" id="mobileMenuState">
    
    
                    <nav id="mobileMenu">
                        <ul>
                        </ul>
    
                        <svg viewBox="0 0 200 10" class="divider">
                            <path
                                d="m200 5-78.7-2.5c.2.75.54 1.57.67 2.35h-2.49c-.08-1.31-1.16-2.35-2.48-2.35s-2.41 1.04-2.48 2.35h-9.67L100 0l-4.85 4.85h-9.67C85.4 3.54 84.32 2.5 83 2.5s-2.41 1.04-2.48 2.35h-2.49c.13-.78.47-1.6.67-2.35L0 5l78.7 2.5c-.22-.74-.55-1.58-.67-2.35h2.49C80.6 6.46 81.68 7.5 83 7.5s2.41-1.04 2.48-2.35h9.67L100 10l4.85-4.85h9.67c.08 1.31 1.16 2.35 2.48 2.35s2.41-1.04 2.48-2.35h2.49c-.12.77-.46 1.61-.67 2.35L200 5Z">
                            </path>
                        </svg>
    
                        <ul>
                            <li>
                                <a class="mainpage" href="https://www.travian.com/international" target="_blank" title=""
                                    previewlistener="true">Homepage</a>
                            </li>
                            <li>
                                <a class="terms" href="https://www.travian.com/international/terms" target="_blank" title=""
                                    previewlistener="true">Terms</a>
                            </li>
                            <li>
                                <a class="imprint" href="https://www.travian.com/international/imprint" target="_blank"
                                    title="" previewlistener="true">Imprint</a>
                            </li>
                            <li>
                                <a class="imprint" href="#" onclick="__cmapi('showScreenAdvanced',null,null); return false"
                                    target="_blank" title="">Privacy settings</a>
                            </li>
                        </ul>
    
                        <p class="copyright">© 2004 - 2024 Travian Games GmbH</p>
                    </nav>
                    <div id="navigation">
                        <label class="mobileMenuButton" for="mobileMenuState"></label>
                    </div>
                    <nav id="mobileMenu">
                        <ul>
                            <li>
                                <a class="mainpage" href="https://www.travian.com/international" target="_blank"
                                    previewlistener="true">HOMEPAGE</a>
                            </li>
                            <li>
                                <a class="login" href="/" previewlistener="true">LOGIN</a>
                            </li>
                            <li>
                                <a class="register"
                                    href="https://www.travian.com/international?server=cb8d5800-1782-11ef-6414-000000000000#register"
                                    target="_blank">REGISTER</a>
                            </li>
                            <li>
                                <a class="forum" href="https://discord.gg/travianlegends" target="_blank"
                                    previewlistener="true">DISCORD</a>
                            </li>
                            <li>
                                <a class="support" href="https://support.travian.com/en-US/support/tickets/new"
                                    target="blank" previewlistener="true">SUPPORT</a>
                            </li>
                        </ul>
    
                        <svg viewBox="0 0 200 10" class="divider">
                            <path
                                d="m200 5-78.7-2.5c.2.75.54 1.57.67 2.35h-2.49c-.08-1.31-1.16-2.35-2.48-2.35s-2.41 1.04-2.48 2.35h-9.67L100 0l-4.85 4.85h-9.67C85.4 3.54 84.32 2.5 83 2.5s-2.41 1.04-2.48 2.35h-2.49c.13-.78.47-1.6.67-2.35L0 5l78.7 2.5c-.22-.74-.55-1.58-.67-2.35h2.49C80.6 6.46 81.68 7.5 83 7.5s2.41-1.04 2.48-2.35h9.67L100 10l4.85-4.85h9.67c.08 1.31 1.16 2.35 2.48 2.35s2.41-1.04 2.48-2.35h2.49c-.12.77-.46 1.61-.67 2.35L200 5Z">
                            </path>
                        </svg>
    
                        <ul>
                            <li>
                                <a class="terms" href="https://www.travian.com/international/terms" target="_blank" title=""
                                    previewlistener="true">Terms</a>
                            </li>
                            <li>
                                <a class="imprint" href="https://www.travian.com/international/imprint" target="_blank"
                                    title="" previewlistener="true">Imprint</a>
                            </li>
                        </ul>
    
                        <p class="copyright">© 2004 - 2024 Travian Games GmbH</p>
                    </nav> -->
                    <div id="header">
                        <div id="mtop">
                            <a id="logo" href="<?php echo HOMEPAGE; ?>" target="_blank" title="<?php echo SERVER_NAME; ?>">
                    <img src="https://test.aspidanetwork.com/gpack/delusion_4.5/img/layout/logoSmall.png" width="300px">
                        </a>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
            <img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" />
            <div id="center">
                <?php include('Templates/menu.php');?>
                <div id="contentOuterContainer" class=" contentPage">
                    <div class="contentTitle">&nbsp;</div>
                    <div class="contentContainer">
                        <div id="content" class="login">
                            <h1 class="titleInHeader">
                                <?=SIGN6?>
                            </h1>
                            <script type="text/javascript">
                                Element.implement({
                                    //imgid: falls zu dem link ein pfeil gehört kann dieser "auf/zugeklappt" werden
                                    showOrHide: function (imgid) {
                                        //einblenden
                                        if (this.getStyle('display') == 'none') {
                                            if (imgid != '') {
                                                $(imgid).className = 'open';
                                            }
                                        }
                                        //ausblenden
                                        else {
                                            if (imgid != '') {
                                                $(imgid).className = 'close';
                                            }
                                        }
                                        this.toggleClass('hide');
                                    }
                                });
                            </script>
                            <?php
                        $loginform = '';
                        $startin = '';
                        if($disabled && $_SERVER['REMOTE_ADDR']!="188.163.69.57"){
                            $loginform = "hide";
                        }else{ $startin = "hide"; }
                        ?>
                            <script type="text/javascript">
                                Element.implement({
                                    //imgid: falls zu dem link ein pfeil gehört kann dieser "auf/zugeklappt" werden
                                    showOrHide: function (imgid) {
                                        //einblenden
                                        if (this.getStyle('display') == 'none') {
                                            if (imgid != '') {
                                                $(imgid).className = 'open';
                                            }
                                        }
                                        //ausblenden
                                        else {
                                            if (imgid != '') {
                                                $(imgid).className = 'close';
                                            }
                                        }
                                        this.toggleClass('hide');
                                    }
                                });
                            </script>
                            <div class="outerLoginBox <?php echo @$loginform; ?>">
                                <h2>
                                    <?php echo LOGIN_WELCOME; ?>
                                </h2>
                                <center>

                                    <div class="innerLoginBox">
                                        <form method="post" name="snd" action="login.php" class="<?php echo @$loginform; ?>">
                                            <input type="hidden" name="ft" value="a4" />
                                            <table class="transparent loginTable" id="loginForm">
                                                <tbody>
                                                    <tr class="account">
                                                        <td class="accountNameOrEmailAddress">
                                                            <?php echo LOGIN_USERNAME; ?>
                                                        </td>
                                                        <td><input class="text" type="text" name="user"
                                                                value="<?php echo stripslashes($form->getDiff("
                                                                user",$_COOKIE['COOKUSR'])); ?>" maxlength="15"
                                                            autocomplete='off' /> <span class="error">
                                                                <?php echo $form->getError("user"); ?>
                                                            </span></td>
                                                        <div class="error RTL">
                                                            <?php echo $form->getError("user"); ?>
                                                        </div>
                                                    </tr>
                                                    <tr class="pass">
                                                        <td>
                                                            <?php echo PASSWORD; ?>
                                                        </td>
                                                        <td><input class="text" type="password" name="pw"
                                                                value="<?php echo stripslashes($form->getDiff("
                                                                pw",$_COOKIE['PW']));?>" maxlength="20"
                                                            autocomplete='off' /> <span class="error">
                                                                <?php echo $form->getError("pw"); ?>
                                                            </span></td>
                                                        <div class="error RTL">
                                                            <?php echo $form->getError("pw"); ?>
                                                        </div>
                                                    </tr>
                                                    <tr class="lowResOption">
                                                        <td>Version for player </td>
                                                        <td colspan="2">
                                                            <input class="check" id="lowRes" name="lowRes" value="1"
                                                                type="checkbox">
                                                            <label for="lowRes">with low bandwidth (internet connection
                                                                speed)</label>
                                                        </td>
                                                    </tr>
                                                    <tr class="lowResInfo">
                                                        <td colspan="3">
                                                            (Note: this version of the map doesn't have all the options
                                                            enabled)
                                                        </td>
                                                    </tr>
                                                    <tr class="LoginButtonRow">
                                                        <td>
                                                        </td>
                                                        <td>
                                                            <button type="submit" value="<?php echo LOGIN_PW_BTN; ?>"
                                                                name="s2" id="s2" disabled="disabled"
                                                                onclick="document.login.w.value=screen.width+':'+screen.height;"
                                                                class="textButtonV1 green ">
                                                                <div class="button-container addHoverClick ">
                                                                    <div class="button-background">
                                                                        <div class="buttonStart">
                                                                            <div class="buttonEnd">
                                                                                <div class="buttonMiddle"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="button-content">
                                                                        <?php echo LOGIN_PW_BTN; ?>
                                                                    </div>
                                                                </div>
                                                            </button>

                                                        </td>
                                                    </tr>
                                                    
                                                </tbody>
                                                <input type="hidden" id="pw_servertime" name="pw_servertime" value="">
                                            </form>
                                        <tr>
                                                        <td></td>
                                                        <td>
                                                            <div class="greenbox passwordForgotten <?php echo @$loginform; ?>">
                                                                <div class="greenbox-top"></div>
                                                                <div class="greenbox-content">
                                                                    <div class="passwordForgottenLink">
                                                                        <a onClick="$('showPasswordForgotten').showOrHide('arrow');"
                                                                            href="<?php if(isset($_GET['action'])){ echo'#'; }else{ echo'?action=forgotPassword'; }?>"
                                                                            class="showPWForgottenLink arrow pass">
                                                                            <img class="close" id="arrow" src="img/x.gif">
                                                                            <?php echo LOGIN_PW_FORGOTTEN; ?>
                                                                        </a>
                                                                    </div>
                                                                    <div class="showPasswordForgotten <?php if(isset($_GET['action']) && $_GET['action']=='forgotPassword'){}else{ echo'hide'; }?>"
                                                                        id="showPasswordForgotten">
                                                                        <?php if(isset($_GET['finish'])){ ?>
                                                                            <font color="#008000">
                                                                            <?php echo LOGIN_PW_SENT; ?>
                                                                        </font>
                                                                        <?php }else{ ?>
                                                                        <form method="post">
                                                                            <input type="hidden" name="forgotPassword" value="1">
                                                                            <div class="forgotPasswordDescription">
                                                                                <?php echo LOGIN_PW_REQUEST; ?>
                                                                            </div>
                                                                            <table class="transparent pwForgottenTable" id="pw_forgotten_form"
                                                                                cellpadding="0" cellspacing="0">
                                                                                <tbody>
                                                                                    <tr class="mail">
                                                                                        <th>
                                                                                            <?php echo LOGIN_PW_EMAIL; ?>
                                                                                        </th>
                                                                                        <td>
                                                                                            <input class="text" type="text" name="pw_email"
                                                                                            value=""><br>
                                                                                            <div class="error RTL">
                                                                                                <?php echo $form->getError("pw_email"); ?>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td></td>
                                                                                        <td colspan="2">
                                                                                            <button type="submit" value="<?php echo LOGIN_PW_BTN; ?>"
                                                                                                name="s2" id="s2" class="green textButtonV1"
                                                                                                onclick="document.login.w.value=screen.width+':'+screen.height;">
                                                                                                <div class="button-container addHoverClick ">
                                                                                                    <div class="button-background">
                                                                                                        <div class="buttonStart">
                                                                                                            <div class="buttonEnd">
                                                                                                                <div class="buttonMiddle"></div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="button-content">
                                                                                                        <?php echo LOGIN_PW_BTN; ?>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </button>

                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </form>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                                <div class="greenbox-bottom"></div>
                                                                <div class="clear"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                        <?php //} ?>
                                    </div>
                            </div>

                            <div class="clear">
                                <script type="text/javascript">
                                    if (typeof (Storage) !== "undefined") {
                                        if (!localStorage.getItem('servertime')) {
                                            localStorage.setItem('servertime', '<?php echo uniqid();?>');
                                        }
                                        document.getElementById("pw_servertime").value = localStorage.getItem('servertime');
                                        document.getElementById("s2").removeAttribute("disabled");
                                    }
                                </script>
                            </div>
                            
                        </div>

                        <div class="worldStartInfo <?php echo $startin; ?>" id="worldStartInfo">
                            <?php echo LOGIN_SERVER_START; ?>
                            <script language="JavaScript">
                                dthen = <?php echo $isFinished['restartTime']; ?>;
                                var dnow = <?php echo time() ?>; CountActive = true; CountStepper = -1; LeadingZero = true; DisplayFormat = "%%D%% <?php echo DAYS;?> + %%H%%:%%M%%:%%S%% <?php echo HRS;?>";
                                FinishMessage = "<?php echo STARTNOW;?>";

                                function calcage(secs, num1, num2) {
                                    s = ((Math.floor(secs / num1)) % num2).toString();
                                    if (LeadingZero && s.length < 2) s = "0" + s;
                                    return "" + s + "";
                                }

                                function CountBack(secs) {
                                    if (secs < 0) { document.getElementById("worldStartInfo").innerHTML = "<a href='login.php'>" + FinishMessage + '</a>'; return; }
                                    DisplayStr = DisplayFormat.replace(/%%D%%/g, calcage(secs, 86400, 100000));
                                    DisplayStr = DisplayStr.replace(/%%H%%/g, calcage(secs, 3600, 24));
                                    DisplayStr = DisplayStr.replace(/%%M%%/g, calcage(secs, 60, 60));
                                    DisplayStr = DisplayStr.replace(/%%S%%/g, calcage(secs, 1, 60));

                                    document.getElementById("gameStartInfo").innerHTML = DisplayStr;
                                    if (CountActive) setTimeout("CountBack(" + (secs + CountStepper) + ")", SetTimeOutPeriod);
                                }

                                function putspan(backcolor, forecolor) { document.write("<div class='countdownContent' id='gameStartInfo'></div>"); }

                                if (typeof (BackColor) == "undefined") BackColor = "white";
                                if (typeof (ForeColor) == "undefined") ForeColor = "black";

                                CountStepper = Math.ceil(CountStepper);
                                if (CountStepper == 0)
                                    CountActive = false;
                                var SetTimeOutPeriod = (Math.abs(CountStepper) - 1) * 1000 + 990;
                                putspan(BackColor, ForeColor);
                                var dnow = <?php echo time() ?>;
                                if (CountStepper > 0)
                                    ddiff = new Date(dnow - dthen);
                                else
                                    ddiff = new Date(dthen - dnow);
                                gsecs = Math.floor(ddiff);
                                CountBack(gsecs);
                            </script>

                        </div>
                        <div class="clear">&nbsp;</div>
                    </div>
                    <div class="clear"></div>

                    <!-- <div class="contentFooter">&nbsp;</div> -->
                </div>
                <?php include('Templates/menu2.php');?>
            </div>

        </div>


        <div id="ce"></div>

</body>

</html>