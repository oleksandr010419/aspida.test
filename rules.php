<?php
include("GameEngine/config.php");
if (!isset($_COOKIE['lang']) || empty($_COOKIE['lang'])) {
	$language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	if (in_array($language, array('ru', 'ua', 'be'))) {
		setcookie('lang', 'ru');
		$language=$_COOKIE['lang']='ru';
	} else {
		setcookie('lang', 'en');
		$language=$_COOKIE['lang']='en';
	}
} else {
	$language = $_COOKIE['lang'];
}
include("GameEngine/Lang/" . $language . ".php");
?>
<!DOCTYPE html>

<html>
<?php include("Templates/html.php") ?>

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

			<a href="<?=$_SERVER['PHP_SELF'].$linkru?>" title="Ελληνικά" class="ru"></a>
			<a href="<?=$_SERVER['PHP_SELF'].$linken?>" title="English" class="en"></a>
		</div>
		<div id="center" style="float:none">





			<center>
				<div class="headline" style="margin-top:-30px">


<?php include("Templates/rules.php"); ?>
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