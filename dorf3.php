<?php
include "GameEngine/Village.php";
include("GameEngine/Building.php");

?>
<!DOCTYPE html>
<html>
<?php include("Templates/html.php");?>


<body class="v35 <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> village3 <?php if($dorf1==''){echo 'perspectiveBuildings';}else{ echo 'perspectiveResources';} ?>">
<script type="text/javascript">
    window.ajaxToken = 'de3768730d5610742b5245daa67b12cd';
</script>
<div id="background">
    <div id="headerBar"></div>
    <div id="bodyWrapper">

        <div id="header">

            <?php
            include("Templates/topheader.php");
            include("Templates/toolbar.php");

            ?>

        </div>
        <div id="center">


            <?php include("Templates/sideinfo.php"); ?>

            <div id="contentOuterContainer" class="size1">

                <?php include("Templates/res.php"); ?>
                <div class="contentTitle"><a id="closeContentButton" class="contentTitleButton" href="dorf<?=$session->link?>.php" title="Close window">&nbsp;</a>
                    <a id="answersButton" class="contentTitleButton" href="http://t4.answers.travian.com/index.php?aid=106#go2answer" target="_blank" title="Travian Answers">&nbsp;</a></div>
                <div class="contentContainer">
                    <div id="content" class="village3">
                        <h1 class="titleInHeader"><?=PLUS1?></h1>

                        <script type="text/javascript">
                            window.addEvent('domready', function()
                            {
                                $$('.subNavi').each(function(element)
                                {
                                    new Travian.Game.Menu(element);
                                });
                            });
                        </script>
    <?php
    include('Templates/dorf3/menu.php');
    ?>
<?php
if($session->plus){
    $int=intval($_GET['s']);
    $num=($int > 0 && $int <=5)?$int:1;
	  include("Templates/dorf3/".$num.".php");
}else{
  include("Templates/dorf3/noplus.php");
}
?>

                        <div class="clear">&nbsp;</div>
                    </div>
                    <div class="clear"></div>


                </div>
                <div class="contentFooter">&nbsp;</div>

            </div>
            <?php
            include("Templates/rightsideinfor.php");
            ?>
            <div class="clear"></div>
        </div>
        <?php

        include("Templates/header.php");
        ?>
    </div>
    <div id="ce"></div>
</div>
</body>
</html>

