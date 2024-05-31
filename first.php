<?php

if(isset($_POST['vid']) && (!is_numeric($_POST['vid']) || !in_array($_POST['vid'],array(1,2,3,6,7,8)))){

    die('lol wat');

}

if(isset($_POST['sector']) &&  !in_array($_POST['sector'],array('ne','nw','sw','se'))){

    die('lol wat');

}

//error_reporting(0);

include("GameEngine/Account.php");

if(!count($database->query("SELECT id FROM activate where `username`='".$_SESSION['username']."'")) || !isset($_SESSION['username'])){

  if(!isset($_SESSION['username'])){

      die("Go through the activation process again or delete your account activation and re-register.");

  }else{

      die("Account, or it has already been activated or is not registered.");

  }

}

$error = "";
if(isset($_POST['final'])){
	//step 3 goes here
	
	//afer that activate - login
	
	$account->Activate();

	header("Location: login.php");
}
if ((isset($_GET['step'])&& $_GET['step']==1 ) || (isset($_POST['vid']) && in_array($_POST['vid'],array(1,2,3,6,7,8)))) {//&& isset($_POST['country']) 

	$t=$_POST['vid'];

    $p=array('t'=>$t);

    $p['country'] = 'XA';//$_POST['country'];
	
	$p['username'] = $_SESSION['username'];
	/*if(empty($p['country']) || $p['country'] =='-1'){
		$error = "<span style=\"color:red;font-weight:bold\">You need to select a country.</span>";
	}else{*/
		$database->query("UPDATE activate set tribe=:t, IsoCountryCode=:country where `username`=:username",$p);//, IsoCountryCode=:country
	//}
}

if ((isset($_GET['step'])&& $_GET['step']==2 ) || isset($_POST['sector'])) {

	switch($_POST['sector']) {

		default: $sector = "1"; break;

		case "ne": $sector = "3"; break;

		case "nw": $sector = "4"; break;

		case "sw": $sector = "1"; break;

		case "se": $sector = "2"; break;

	}

	$p=array('s'=>$sector);
	$p['username'] = $_SESSION['username'];

    $database->query("UPDATE activate set location=:s where `username`=:username",$p);

}



$ta = array(array(first_page_tribe2_lead,first_page_tribe2),array(first_page_tribe1_lead,first_page_tribe1),array(first_page_tribe3_lead,first_page_tribe3));

$tr_loc=$database->query("SELECT tribe,location,IsoCountryCode FROM activate where `username`='".$_SESSION['username']."'");

$tribe = $tr_loc[0]['tribe'];

$country = $tr_loc[0]['IsoCountryCode'];

$location = $tr_loc[0]['location'];

if(isset($_GET['step'])){
	switch($_GET['step']){
		case 2:
			$page = 2; 
			break;
		case 3:
			$page = 3; 
			break;
		case 1:
		default:
			$page = 1; 
	}
}
else{
	if ($location>0) {
		$page = 3; 
	}
	elseif($tribe>0 && !isset($_GET['ct'])) {

		$page = 2; 

		$title = first_page_second_step_desc1;

	}else{

		$page = 1;

		$title = first_desc1;

	}
}

// Grab the list of countries for the dropdown
$countries = $database->query('SELECT IsoCountryCode, Country FROM CountryTbl ORDER BY Country ASC');

?>
<!DOCTYPE html>
<html>
<?php include("Templates/html.php");?>

<script type="text/javascript">
	window.ajaxToken = 'f6ec0129e135fe343e872bc09886b6ac';
	window._player_uuid = '';
</script>
<script type="text/javascript">
	window.TravianDefaults = {
		Map: { Size: { width: 801, height: 801, left: -400, right: 400, bottom: -400, top: 400 } }
	};
</script>
<script type="text/javascript">
	Travian.Translation.add(
		{
			'allgemein.anleitung': 'Instructions',
			'allgemein.cancel': 'cancel',
			'allgemein.ok': 'OK',
			'allgemein.close': 'close',
			'cropfinder.keine_ergebnisse': 'No search results found.'
		});
	Travian.applicationId = 'T4.4 Game';
	Travian.Game.version = '4.4';
	Travian.Game.worldId = '';
	Travian.Game.speed = 1;

	Travian.Templates = {};
	Travian.Templates.ButtonTemplate = "<button >\n\t<div class=\"button-container addHoverClick\">\n\t\t<div class=\"button-background\">\n\t\t\t<div class=\"buttonStart\">\n\t\t\t\t<div class=\"buttonEnd\">\n\t\t\t\t\t<div class=\"buttonMiddle\"><\/div>\n\t\t\t\t<\/div>\n\t\t\t<\/div>\n\t\t<\/div>\n\t\t<div class=\"button-content\"><\/div>\n\t<\/div>\n<\/button>\n";

</script>


<script type="text/javascript">
	jQuery(document).ready(function () {
		Travian.Form.UnloadHelper.message = 'You have made changes. Do you really want to leave this page?';
		new Travian.TabManager();
	});
</script>
<script type="text/javascript">
	Travian.Game.Preferences.initialize([]);
</script>
</head>

<body class="activate v35 chrome blink en-US perspectiveBuildings ltr mobileOptimized" data-theme="default">
	<div id="reactDialogWrapper"></div>
	<div id="background" class>
		<!-- <div id="bodyWrapper"> -->
			<!-- <img style="filter:chroma();" src="./activate1_files/x.gif" id="msfilter" alt=""> -->

			<div id="topBar">
				<a id="logo" href="<?php echo HOMEPAGE; ?>" target="_blank"></a>
			</div>
			<div id="center">
				<?php include('Templates/menu.php');?>

				<div id="contentOuterContainer" class=" contentPage">
					<div class="contentTitle buttonCount0">
						<a id="answersButton" class="contentTitleButton buttonFramed withIcon rectangle green"
							href="http://t4.answers.travian.com/index.php?aid=21#go2answer" target="_blank">&nbsp;</a>
					</div>
					<div class="contentContainer">
						<?php

							switch($page) {

								case 1: {
									include('activate_step1.php');
									break;
								}

								case 2: {
									include('activate_step2.php');
									break;
								}
								
								case 3: {
									include('activate_step3.php');
									break;
								}
							}
							?>


						<div class="clear">&nbsp;</div>
					</div>
					<div class="contentFooter"></div>
				</div>

				<div id="sidebarAfterContent" class="sidebar afterContent ">
					<div class="clear"></div>
				</div>

				<div class="clear"></div>
			</div>

			<div id="footer" class="size1">
				<div id="pageLinks">
					<a href="<?php echo HOMEPAGE; ?>" target="_blank">Homepage</a>

					<div class="clear"></div>
				</div>
				<p class="copyright">©2014 - 2024 Aspida Games</p>
			</div>

		<!-- </div> -->


		<div id="ce"></div>



	</div>
	<script type="text/javascript">
		var T4_feature_flags = { "vacationMode": true, "territory": false, "heroitems": true, "allianceBonus": true, "boostedStart": false, "pushingProtectionAlways": false, "tribesEgyptiansAndHuns": false, "hideFoolsArtifacts": false, "welcomeScreen": false };
	</script>





	<div style="position: absolute; top: 0px; left: 0px; opacity: 0; z-index: 10000;">
		<div class="tip">
			<div class="tip-container">
				<div class="tl"></div>
				<div class="tr"></div>
				<div class="tc"></div>
				<div class="ml"></div>
				<div class="mr"></div>
				<div class="mc"></div>
				<div class="bl"></div>
				<div class="br"></div>
				<div class="bc"></div>
				<div class="tip-contents">
					<div class="title elementTitle"></div>
					<div class="text elementText"></div>
				</div>
			</div>
		</div>
	</div>

</body>

</html>