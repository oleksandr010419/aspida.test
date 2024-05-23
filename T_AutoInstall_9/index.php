<?php include("templates/script.tpl");
header('Content-Type: text/html; charset=UTF-8');
if(!isset($_GET['s'])) {
	$_GET['s']=0;
}
error_reporting(E_ALL^E_NOTICE);
if(!empty($_GET['lang'])){
    if($_GET['lang']=='ru'){
        setcookie('lang', 'ru');
        $_COOKIE['lang']='ru';
    }elseif($_GET['lang']=='en'){
        setcookie('lang', 'en');
        $_COOKIE['lang']='en';

    }

}
if(empty($_COOKIE['lang'])){$language="ru";}else{$language=$_COOKIE['lang'];}

include("../GameEngine/Lang/" . $language . ".php");
?>


<!DOCTYPE html>
<html>
<head>
    <title>Aspida Servers Installation</title>
    <link rel="shortcut icon" href="../favicon.ico"/>
    <link href="../gpack/delusion_4.4/lang/en/compact.css" rel="stylesheet" type="text/css" />

    <script src="http://www.cy-pr.com/tools/time/time.js" type="text/javascript"></script>
</head>
<style>h1 {

        font-family: monotype corsiva, Helvetica, sans-serif;
        color:#a40020;
font-size: 40px;
    }</style>
<body class="v35 map perspectiveResources">

<div id="background">
    <div id="headerBar"></div>
    <div id="bodyWrapper">



        <div id="header">
            <?php
            if(isset($_GET['lang'])){

                if(count($_GET)==1){
                    $_SERVER['QUERY_STRING']= preg_replace('/lang='.$_GET['lang'].'/','',$_SERVER['QUERY_STRING']);
                }else{
                    $_SERVER['QUERY_STRING']= preg_replace('/&lang='.$_GET['lang'].'/','',$_SERVER['QUERY_STRING']);
                }
            }
            if(count($_GET) && isset($_GET['lang'])){
                if($_GET['lang']!='en'){
                    $linken='?'.$_SERVER['QUERY_STRING'].'&lang=en';
                }else{$linken='?'.$_SERVER['QUERY_STRING'];}
                if($_GET['lang']!='ru'){
                    $linkru='?'.$_SERVER['QUERY_STRING'].'&lang=ru';
                }else{$linkru='?'.$_SERVER['QUERY_STRING'];}
            }elseif(!count($_GET)){
                $linkru='?lang=ru';
                $linken='?lang=en';
            }else{
                $linkru='?'.$_SERVER['QUERY_STRING'].'&lang=ru';
                $linken='?'.$_SERVER['QUERY_STRING'].'&lang=en';

            }


            ?>

            <a href="<?=$_SERVER['PHP_SELF'].$linkru?>" title="Изменить Язык на Русский" class="ru"></a>
            <a href="<?=$_SERVER['PHP_SELF'].$linken?>" title="Change language into English" class="en"></a>
        </div>
        <div id="center" style="float:none">





            <center>
                <div class="headline" style="margin-top:-30px">
                    <span class="f18 c5" ><h1>Travian T4.2 Installation Script</h1></span></div>

<br />
               <div id="contentOuterContainer" style="float:none">
               <div class="contentTitle">
                   				</div>
               <div class="contentContainer">

<br />
					<?php
					IHG_Progressbar::draw_css();
					$bar = new IHG_Progressbar(7, 'Step %d from %d ');
					$bar->draw();
					for($i = 0; $i < ($_GET['s']+1); $i++) {
						$bar->tick();
					}
					?>


				<?php
				if(substr(sprintf('%o', fileperms('../')), -4)<'700'){
					echo"<span class='f18 c5'>ERROR!</span><br />It's not possible to write the config file. Change the permission to '777'. After that, refresh this page!";
				} else
					switch($_GET['s']){
						case 0:
                            include("templates/greet.tpl");break;
                        case 1:
						include("templates/config.tpl");
						break;
						case 2:
						include("templates/dataform.tpl");
						break;
						case 3:
						include("templates/field.tpl");

						break;
						case 4:
                            include("templates/multihunter.tpl");

                            break;
						case 5:

						include("templates/oasis.tpl");
						break;
						case 6:						
						include("include/emails.php");						//gather users from old install and send emails about server start						gatherUsers();						notifyUsers();
						include("templates/end.tpl");
						break;
					}
				?>

               </div>
               <div class="clear">&nbsp;</div>

               <div class="contentFooter"></div>
        </center>
            <div class="clear"></div>
        </div>

                </div>
                <div id="ce"></div>


</body>
</html>
