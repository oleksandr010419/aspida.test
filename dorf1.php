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

<body class="v35 <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> village1 perspectiveResources">

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



            <?php

            include("Templates/sideinfo.php");?>





            <div id="contentOuterContainer" class="size1">

                <?php   include("Templates/res.php");



                ?>

                <div class="contentTitle">

                    &nbsp;</div>

                <div class="contentContainer">

                    <div id="content" class="village1">

<?php

             include("Templates/field.php");

if(!isset($timer)){

                        $timer = 1;

}

                        if ($building->NewBuilding) {

                            include("Templates/Building.php");

                        }

                        ?>

                        <div id="map_details">

                            <div class="movements">

                                <?php

                                include("Templates/movement.php");

                                ?></div>

                            <?php

                            include("Templates/production.php");

                            include("Templates/troops.php");

                            echo '<div class="clear"></div>';

                            echo '</div>';

                            ?>
							<div class="clear"></div>





                        </div></div>

                </div>

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

        </div>

		<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-110012133-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-110012133-1');
</script>

</html>