<?php


include "GameEngine/Village.php";



if($session->access == BANNED){
?>
    <!DOCTYPE html>
    <html>
<?php include("Templates/html.php");?>


<body class="v35 <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> statistics">
<script type="text/javascript">
    window.ajaxToken = 'de3768730d5610742b5245daa67b12cd';
</script>
<div id="background">
    <div id="headerBar"></div>
    <div id="bodyWrapper">

        <div id="header">

            <?php
            include("Templates/topheader.php"); // mehdi jan injaro man edit kardam bordam tu hamin file ke berim baghie ja ha ham include konim!
            include("Templates/toolbar.php"); // mehdi jan injaro man edit kardam bordam tu hamin file ke berim baghie ja ha ham include konim!

            ?>

        </div>
        <div id="center">

            <?php include("Templates/sideinfo.php"); ?>

            <div id="contentOuterContainer" class="size1">
                <?php include("Templates/res.php"); ?>

                <div class="contentTitle">
                    <a id="closeContentButton" class="contentTitleButton" href="dorf<?=$session->link?>.php" title="Close window">&nbsp;</a>
                    <a id="answersButton" class="contentTitleButton" href="http://t4.answers.travian.com/index.php?aid=106#go2answer" target="_blank" title="Travian Answers">&nbsp;</a>						</div>
                <div class="contentContainer">
                    <div id="content" class="statistics">
<?php
include("Templates/ban_msg.php");
?>


                    </div>
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
        <div id="ce"></div>
    </div>
</body>
    </html>


<?php
}
else{header("Location: dorf1.php");  exit();}?>
