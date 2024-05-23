<?php
include("GameEngine/Account.php");

?>
<!DOCTYPE html>
<html>
<?php include("Templates/html.php");?>

<body class="v35 <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> logout perspectiveBuildings">
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
                    <div id="content" class="logout">





                        <h1 class="titleInHeader"><?php echo LOGOUT_TITLE; ?></h1>
                        <h4><?php echo LOGOUT_H4; ?></h4>
                        <p><?php echo LOGOUT_DESC; ?></p>
                        <p><a class="arrow" href="login.php?del_cookie"><?php echo LOGOUT_LINK;?></a></p>
                    </div>
                    <div class="clear">&nbsp;</div>
                </div>
                <div class="clear"></div>

                <div class="contentFooter">&nbsp;</div>
            </div>
			<?php include('Templates/menu2.php');?>
        </div>

    </div>


    <div id="ce"></div>

</body>
</html>