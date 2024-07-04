<?php
include "GameEngine/Village.php";
$_SESSION['dorf'] = $session->link = 2;
if (isset($_GET['visit'])) {
    $database->UpdateAchievU($session->uid, "`a7`=1"); //ачивка за группу
    header("Location:dorf2.php");
    exit;
}

include("GameEngine/Building.php");
include("GameEngine/Technology.php");

$building->procBuild($_GET);
$_SESSION['dorf'] = 2;

if (isset($_GET['pivo'])) {

    $wid = $village->wid;

    $vwood = $village->awood;
    $vclay = $village->aclay;
    $viron = $village->airon;
    $vcrop = $village->acrop;

    if (38700 < $vwood && 16800 < $vclay && 59400 < $viron && 13400 < $vcrop) {
        $lvl = $village->resarray;
        $lvll = 0;
        for ($i = 16; $i <= 38; $i++) {
            if ($lvl['f' . $i . 't'] == 35) {
                $lvll = $lvl['f' . $i];
            }
        }
        if ($lvll) {
            $bre = $bid35[$lvll]['attri'];
            $database->throwBeerParty($bre, $wid, $session->uid);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<?php include("Templates/html.php"); ?>

<body class="v35 <?= $database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> village2 blink en-US perspectiveBuildings ltr oldBuildingIcons" data-theme="default">
    <script type="text/javascript">
        window.ajaxToken = 'de3768730d5610742b5245daa67b12cd';
    </script>
    <div id="background">
        <?php include("topBar.php"); ?>
        <?php include("Templates/topBarHero.php"); ?>

        <div id="center">

            <?php include("Templates/sideinfo.php"); ?>
            <div id="contentOuterContainer" class="">
                <div class="village2">
                    <?php
                        //include("Templates/res.php");
                    ?>
                    <div id="villageContent">
                        <?php include("Templates/dorf2.php"); ?>

                    </div>
                    <?php
                        if ($building->NewBuilding) {
                            include("Templates/Building.php");
                        }
                    ?>
                </div>
            </div>
            <?php include("Templates/rightsideinfor.php"); ?>
            <?php include("Templates/header.php"); ?>
            <?php include("Templates/footer.php"); ?>
            <div class="clear"></div>
        </div>
        <div id="ce"></div>
    </div>
</body>

</html>