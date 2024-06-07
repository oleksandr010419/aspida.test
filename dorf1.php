<?php
$start = microtime(true);

include "GameEngine/Village.php";

$_SESSION['dorf']=$session->link=1;

if(isset($_GET['visit'])){

    $database->UpdateAchievU($session->uid,"`a7`=1"); //ачивка за группу

    header("Location:dorf1.php");

    exit;

}

include("GameEngine/Building.php");
$database->isWinner();

$building->procBuild($_GET);
?>



<!DOCTYPE html>

<html>

<?php include("Templates/html.php");?>

<body class="v35 <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> village1 perspectiveResources ltr en-US blink"
    data-theme="default">

    <script type="text/javascript">

        window.ajaxToken = 'de3768730d5610742b5245daa67b12cd';

    </script>



    <div id="background">

        <div id="topBar">
            <a id="logo" href="<?php echo HOMEPAGE; ?>" target="_blank" title="<?php echo SERVER_NAME ?>||">
                <img src="https://test.aspidanetwork.com/gpack/delusion_4.5/img/layout/logoSmall.png" width="155px">
            </a>

            <div id="header" class="referAFriend">

                <?php
    
            include("Templates/topheader.php");
    
            include("Templates/toolbar.php");
            include("Templates/res.php");
    
            ?>
            </div>
            <nav id="outOfGame">
                <a href="spieler.php" class="layoutButton buttonFramed withIcon round profile grey    ">
                    <svg viewBox="0 0 15.76 21" class="profile">
                        <g class="outline">
                            <path
                                d="M7.88 1.77c2.1 0 3.8 2.09 3.8 4.65s-1.7 4.65-3.8 4.65S4.08 9 4.08 6.42s1.71-4.65 3.8-4.65m0-1.77c-3 0-5.49 2.88-5.49 6.42s2.46 6.42 5.49 6.42 5.49-2.84 5.49-6.42S10.92 0 7.88 0zm7.88 21a11.81 11.81 0 0 0-2.51-7 7.17 7.17 0 0 1-5.37 2.46A7.17 7.17 0 0 1 2.52 14 11.82 11.82 0 0 0 0 21z">
                            </path>
                        </g>
                        <g class="icon">
                            <path
                                d="M7.88 1.77c2.1 0 3.8 2.09 3.8 4.65s-1.7 4.65-3.8 4.65S4.08 9 4.08 6.42s1.71-4.65 3.8-4.65m0-1.77c-3 0-5.49 2.88-5.49 6.42s2.46 6.42 5.49 6.42 5.49-2.84 5.49-6.42S10.92 0 7.88 0zm7.88 21a11.81 11.81 0 0 0-2.51-7 7.17 7.17 0 0 1-5.37 2.46A7.17 7.17 0 0 1 2.52 14 11.82 11.82 0 0 0 0 21z">
                            </path>
                        </g>
                    </svg>
                </a>
                <a href="options.php" class="layoutButton buttonFramed withIcon round options grey    ">
                    <svg viewBox="0 0 20 20" class="options">
                        <g class="outline">
                            <path
                                d="M9 20l-.24-3.26-.57-.16A7.21 7.21 0 0 1 6.66 16l-.52-.29-2.47 2.1-1.48-1.48 2.14-2.47-.33-.52a7.21 7.21 0 0 1-.62-1.49l-.16-.57L0 11V9l3.26-.24.16-.57A7.21 7.21 0 0 1 4 6.66l.29-.52-2.1-2.47 1.48-1.48 2.47 2.14.52-.33a7.21 7.21 0 0 1 1.49-.62l.57-.16L9 0h2l.24 3.26.57.16a7.21 7.21 0 0 1 1.53.58l.52.29 2.47-2.14 1.48 1.48-2.14 2.51.29.52a7.21 7.21 0 0 1 .62 1.49l.16.57L20 9v2l-3.26.24-.16.57a7.21 7.21 0 0 1-.58 1.53l-.29.52 2.14 2.47-1.48 1.48-2.47-2.14-.52.29a7.21 7.21 0 0 1-1.49.62l-.57.16L11 20zm1-15a5 5 0 1 0 5 5 5 5 0 0 0-5-5z">
                            </path>
                        </g>
                        <g class="icon">
                            <path
                                d="M9 20l-.24-3.26-.57-.16A7.21 7.21 0 0 1 6.66 16l-.52-.29-2.47 2.1-1.48-1.48 2.14-2.47-.33-.52a7.21 7.21 0 0 1-.62-1.49l-.16-.57L0 11V9l3.26-.24.16-.57A7.21 7.21 0 0 1 4 6.66l.29-.52-2.1-2.47 1.48-1.48 2.47 2.14.52-.33a7.21 7.21 0 0 1 1.49-.62l.57-.16L9 0h2l.24 3.26.57.16a7.21 7.21 0 0 1 1.53.58l.52.29 2.47-2.14 1.48 1.48-2.14 2.51.29.52a7.21 7.21 0 0 1 .62 1.49l.16.57L20 9v2l-3.26.24-.16.57a7.21 7.21 0 0 1-.58 1.53l-.29.52 2.14 2.47-1.48 1.48-2.47-2.14-.52.29a7.21 7.21 0 0 1-1.49.62l-.57.16L11 20zm1-15a5 5 0 1 0 5 5 5 5 0 0 0-5-5z">
                            </path>
                        </g>
                    </svg>
                </a>
                <a href="help.php" class="layoutButton buttonFramed withIcon round help grey    ">
                    <svg viewBox="0 0 12.24 20" class="help">
                        <g class="outline">
                            <path
                                d="M3.73 13.1v-.52c0-2.8 1.47-3.8 2.89-4.76 1-.72 2.14-1.46 2.14-2.9s-1.13-2.55-3-2.55A5.39 5.39 0 0 0 2 4.12L0 2.61A8.15 8.15 0 0 1 6.24 0c3 0 6 1.4 6 4.52 0 2.42-1.4 3.38-2.88 4.4-1.33.91-2.7 1.85-2.7 3.82v.36zm3.61 4.8a2.09 2.09 0 0 0-2.1-2.07 2.09 2.09 0 0 0 0 4.17 2.1 2.1 0 0 0 2.1-2.1z">
                            </path>
                        </g>
                        <g class="icon">
                            <path
                                d="M3.73 13.1v-.52c0-2.8 1.47-3.8 2.89-4.76 1-.72 2.14-1.46 2.14-2.9s-1.13-2.55-3-2.55A5.39 5.39 0 0 0 2 4.12L0 2.61A8.15 8.15 0 0 1 6.24 0c3 0 6 1.4 6 4.52 0 2.42-1.4 3.38-2.88 4.4-1.33.91-2.7 1.85-2.7 3.82v.36zm3.61 4.8a2.09 2.09 0 0 0-2.1-2.07 2.09 2.09 0 0 0 0 4.17 2.1 2.1 0 0 0 2.1-2.1z">
                            </path>
                        </g>
                    </svg>
                </a>

                <a href="logout.php" class="layoutButton buttonFramed withIcon round logout grey    ">
                    <svg viewBox="0 0 20 20" class="logout">
                        <g class="outline">
                            <path
                                d="M0 17.01L7.01 10 .14 3.13 3.13.14 10 7.01 17.01 0 20 2.99 12.99 10l6.87 6.87-2.99 2.99L10 12.99 2.99 20 0 17.01z">
                            </path>
                        </g>
                        <g class="icon">
                            <path
                                d="M0 17.01L7.01 10 .14 3.13 3.13.14 10 7.01 17.01 0 20 2.99 12.99 10l6.87 6.87-2.99 2.99L10 12.99 2.99 20 0 17.01z">
                            </path>
                        </g>
                    </svg>
                </a>

                <!-- <li class="clear">&nbsp;</li> -->


            </nav>
        </div>
        <?php include("Templates/topBarHero.php"); ?>
        <!-- <div id="bodyWrapper"> -->




            <div id="center">



                <?php include("Templates/sideinfo.php");?>





                <div id="contentOuterContainer" class="size1">


                    <!-- <div class="contentTitle">

                        &nbsp;
                    </div> -->

                    <!-- <div class="contentContainer"> -->

                    <div class="village1">

                        <?php
                            include("Templates/field.php");
                            if(!isset($timer)) { $timer = 1; }
                            if ($building->NewBuilding) {
                                include("Templates/Building.php");
                            }
                        ?>

                        <div id="map_details">

                            <div class="movements">

                                <?php

                            include("Templates/movement.php");

                            ?>
                            </div>

                            <?php

                        include("Templates/production.php");

                        include("Templates/troops.php");

                        echo '<div class="clear"></div>';

                        echo '</div>';

                        ?>
                            <div class="clear"></div>





                        </div>
                    </div>

                    <!-- </div> -->

                    <?php

                include("Templates/rightsideinfor.php");
				//require 'Templates/quest.php';
                ?>

                    <div class="clear"></div>

                </div>


                <?php

            include("Templates/header.php");

            ?>
                <?php
			include("Templates/footer.php");
			?>

            </div>

            <div id="ce"></div>

        <!-- </div> -->

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-110012133-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() { dataLayer.push(arguments); }
            gtag('js', new Date());

            gtag('config', 'UA-110012133-1');
        </script>

</html>