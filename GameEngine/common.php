<?php
function getIDButton($id, $text, $disabled = false, $class="green") {
    return "
	<button id=\"".$id."\" class=\"". $class." ". (($disabled) ? "disabled" : "") . " \" type=\"button\" value=\"\" >
	<div class=\"button-container addHoverClick \">
			<div class=\"button-background\">
				<div class=\"buttonStart\">
					<div class=\"buttonEnd\">
						<div class=\"buttonMiddle\"></div>
					</div>
				</div>
			</div>
			<div class=\"button-content\">" . $text . "</div>
		</div>
		</button>";
}
function getButton($text, $link, $disabled = false, $class="green") {
    return "
	<button class=\"". $class." ". (($disabled) ? "disabled" : "") . " questButtonOverviewAchievements\" type=\"button\" value=\"Activation\" " . (($link != '') ? "onclick=\"window.location.href = '" . $link . "';return false;\"" : "") . ">
	<div class=\"button-container addHoverClick \">
			<div class=\"button-background\">
				<div class=\"buttonStart\">
					<div class=\"buttonEnd\">
						<div class=\"buttonMiddle\"></div>
					</div>
				</div>
			</div>
			<div class=\"button-content\">" . $text . "</div>
		</div>
		</button>";
}
function getAjaxButton($text, $clickAction, $disabled = false, $class="green",$id) {
    return "
	<button class=\"".$class." " . $disabl . "\" type=\"button\"  onclick=\"".$clickAction."; return false;\">
		<div class=\"button-container addHoverClick \">     
			<div class=\"button-background\">         
				<div class=\"buttonStart\">  
					<div class=\"buttonEnd\">                 
						<div class=\"buttonMiddle\">
						</div>             
					</div>        
				</div>     
			</div>     
			<div class=\"button-content\">
				<span id='".$id."'>" . $text . "</span>
			</div>
		</div>
	</button>";
}
function noGoldButton($text) {
    return "
	<button class=\"gold \" type=\"button\"  class=\" disabled\" onclick=\"(new Event(event)).stop(); return false;\" onfocus=\"$$('button', 'input[type!=hidden]', 'select')[0].focus(); (new Event(event)).stop(); return false;\">
		<div class=\"button-container addHoverClick \">     
			<div class=\"button-background\">         
				<div class=\"buttonStart\">             
					<div class=\"buttonEnd\">                 
						<div class=\"buttonMiddle\">
						</div>             
					</div>         
				</div>     
			</div>     
			<div class=\"button-content\">" . $text . "</div>
		</div>
	</button>";
}
function getsvgicon(){
	return "<svg class=\"toggle-caret\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 45 32.9\">
	<style>
		.caret{fill:url(#caret_to_bottom_fill); stroke:url(#caret_to_bottom_stroke);}
	</style>
	<linearGradient id=\"caret_to_bottom_fill\" x1=\"22.4983\" x2=\"22.4983\" y1=\"26.6416\" y2=\"8.0344\" gradientUnits=\"userSpaceOnUse\" gradientTransform=\"matrix(1 0 0 -1 0 33.833)\">
		<stop offset=\".1147\" stop-color=\"#DADED4\"></stop>
		<stop offset=\".1452\" stop-color=\"#F9FBF7\"></stop>
		<stop offset=\".1551\" stop-color=\"#FFFFFF\"></stop>
	</linearGradient>

	<linearGradient id=\"caret_to_bottom_stroke\" x1=\"22.4983\" x2=\"22.4983\" y1=\"26.6416\" y2=\"8.0344\" gradientUnits=\"userSpaceOnUse\" gradientTransform=\"matrix(1 0 0 -1 0 33.833)\">
		<stop offset=\"0\" stop-color=\"#7C9A58\"></stop>
		<stop offset=\".2\" stop-color=\"#60A200\"></stop>
		<stop offset=\".4\" stop-color=\"#63A500\"></stop>
		<stop offset=\"1\" stop-color=\"#7DB211\"></stop>
	</linearGradient>
	<path class=\"down_glow\" d=\"M39 5.9c-.4-.5-1-.8-1.5-.9H7.4c-.6 0-1.1.2-1.5.9C5.5 6.3 5 7.7 5 9c0 .7 0 2.5.5 3.1l15.1 15.1c.4.5 1.3.7 1.9.7.6 0 1.5-.2 2-.7l14.9-15c.4-.5.6-2 .6-2.7.1-1.2-.5-3.4-1-3.6z\"></path>
	<path class=\"up_glow\" d=\"M39.2,8.2c-0.4-0.5-1.6-1-2.1-1.1l-29.2,0c-0.6,0-1.6,0.4-2.1,1C5.4,8.6,5,9.7,5,11 c0,0.7,0.1,3.3,1.3,4.8l13,13.1c0.4,0.5,2.5,1,3.1,1c0.6,0,2.7-0.5,3.8-1.5L38.4,16c1.4-1.4,1.6-3.8,1.6-4.5 C40.1,10.3,39.9,8.7,39.2,8.2z\"></path>
	<path class=\"topshadow\" d=\"M39.8 10.8c.5-1.7.1-5.7-2.5-5.8H7.2c-2.4.1-2.4 4.6-2.1 5.6 0 .1.2.1.2.1.8-.2.9-2 3.4-2.1 6.8-.1 22.1 0 28.5.1 2.6.1 2.1 1.9 2.6 2.1z\"></path>
	<path class=\"bottomshadow\" d=\"M39.4,8.9C39,8.5,38.5,8.3,38,8.2L7.1,8.3C6.5,8.3,6,8.5,5.6,9C5.2,9.4,5,9.9,5,10.5 c0,0.6-0.2,3.6,1.7,5.6l12.7,12.8c1,0.7,2,1,3.1,1c1.1,0,2.7-0.6,3.8-1.5L38.4,16c1.9-2.1,1.6-5.1,1.6-5.7 C40.1,9.8,39.9,9.3,39.4,8.9z\"></path>
	<path class=\"caret\" d=\"M38.3 8.8c-.4-.4-.9-.6-1.4-.7H8.1c-.6 0-1.1.2-1.5.7-.4.4-.6.9-.6 1.5s.2 1 .6 1.5L21 26.2c.4.4.9.6 1.5.6s1-.2 1.5-.6l14.3-14.5c.4-.4.6-.9.6-1.5.1-.5-.1-1-.6-1.4z\"></path>
</svg>";
}
function removeLogs(){
	foreach (new DirectoryIterator(dirname(__FILE__)."/logs") as $fileInfo) {
		if(!$fileInfo->isDot() && $fileInfo->getExtension()=='txt') {
			unlink($fileInfo->getPathname());
		}
	}
}
function removeCache(){
	foreach (new DirectoryIterator(dirname(__FILE__)."/../mcache") as $fileInfo) {
		if(!$fileInfo->isDot()) {
			unlink($fileInfo->getPathname());
		}
	}
	foreach (new DirectoryIterator(dirname(__FILE__)."/../mmark") as $fileInfo) {
		if(!$fileInfo->isDot()) {
			unlink($fileInfo->getPathname());
		}
	}
}
function getWallID($tribe){
	if($tribe>3){
		return "4".($tribe-4);
	}else{
		return "3".$tribe;
	}
}	
function gcd ($a, $b) {
    return $b ? gcd($b, $a % $b) : $a;
}
function generateHiddenKey($time){
	return base64_encode($time*mt_rand(7,11));
}
function checkKey($key_val){
	if(empty($key_val))return false;
	$key = base64_decode($key_val);
	for($i=7;$i<=11;$i++){
		$t = $key/$i;
		$diff = time()-$t;
		if($diff<=300 && $diff>0){
			return true;
		}
	}
	return false;
}
function isValidTimeStamp($timestamp)
{
    return ((string) (int) $timestamp === $timestamp) 
        && ($timestamp <= PHP_INT_MAX)
        && ($timestamp >= ~PHP_INT_MAX);
}
function npcButton($r1,$r2,$r3,$r4) {
    return '<div class="section2"><button type="button" value="npc" class="gold "
	onclick="window.location.href=\'build.php?gid=17&t=3&r1='.((int)($r1)).'&r2='.((int)($r2)).'&r3='.((int)($r3)).'&r4='.((int)($r4)).'\'; return false;">
	<div class="button-container addHoverClick">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content">Exchange resources</div>
	</div></button></div>';
	
	/*return '<div class="section2">
	<button type="button" value="Exchange resources" id="button59aabd5c4bc13" class="gold ">
	<div class="button-container addHoverClick">
		<div class="button-background">
			<div class="buttonStart">
				<div class="buttonEnd">
					<div class="buttonMiddle"></div>
				</div>
			</div>
		</div>
		<div class="button-content">Exchange resources</div>
	</div>
</button>
<script type="text/javascript" id="button59aabd5c4bc13_script">
	window.addEvent("domready", function() {
		if($("button59aabd5c4bc13")) {
			$("button59aabd5c4bc13").addEvent("click", function () {
				window.fireEvent("buttonClicked", [this, {"type":"button","value":"Exchange resources","name":"","id":"button59aabd5c4bc13","class":"gold ","title":"Click here to exchange resources.","confirm":"","onclick":"","dialog":{"cssClass":"white","draggable":false,"overlayCancel":true,"buttonOk":false,"saveOnUnload":false,"data":{"cmd":"exchangeResources","defaultValues":{"r1":130,"r2":115,"r3":195,"r4":115,"npc":true,"time":{"max":803}},"did":"2467"}}}]);
			});
		}
	});
</script>
</div>';*/
}

function addToLog($log_type,$string){
	switch($log_type){
		case 'cron':
			$myFile = dirname(__FILE__)."/logs/cron.txt";
			break;
		case 'user':
			$myFile = dirname(__FILE__)."/logs/user_log.txt";
			break;
		case 'natars':
			$myFile = dirname(__FILE__)."/logs/natars_log.txt";
			break;		
		case 'goldLog':
			$myFile = dirname(__FILE__)."/logs/gold_log.txt";
			break;		
		case 'hero':
			$myFile = dirname(__FILE__)."/logs/hero.txt";
			break;
		case 'db':
			$myFile = dirname(__FILE__)."/logs/db.txt";
			break;	
			//return;
		case 'payments':
			$myFile = dirname(__FILE__)."/logs/payment_log.txt";
			break;	
		default:
			$myFile = dirname(__FILE__)."/logs/default_log.txt";
	}
	if(!file_exists($myFile)){
		$fh = fopen($myFile, 'w') or die("can't open file");
	}else{
		$fh = fopen($myFile, 'a') or die("can't open file");
	}
	
	fwrite($fh, date('c', strtotime("now")).':'.$string.PHP_EOL);
	fclose($fh);
}

function addToUserLog($current_user,$string){
	if(!file_exists(dirname(__FILE__)."/logs/user_".$current_user.".txt")){
		$fh = fopen(dirname(__FILE__)."/logs/user_".$current_user.".txt", 'w') or die("can't open file");
	}else{
		$fh = fopen(dirname(__FILE__)."/logs/user_".$current_user.".txt", 'a') or die("can't open file");
	}
	
	fwrite($fh, date('c', strtotime("now")).':'.$string.PHP_EOL);
	fclose($fh);
}
/* logs */
function userActivityMonitor($current_user){
	$uid_to_watch = array(6);
	$current_script = basename($_SERVER["SCRIPT_NAME"], ".php");
	if(in_array($current_user,$uid_to_watch) && ($current_script == 'a2b' || ($current_script=='build' && $_REQUEST['id']==39))){
		addToUserLog($current_user,"[".$current_script."]=========".$current_user."===========");	
		addToUserLog($current_user,print_r($_REQUEST,true));
		addToUserLog($current_user,"========================");	
		addToUserLog($current_user,print_r($_SERVER,true));
	}
	else {
		/*addToUserLog($current_user,"[".$current_script."]=========".$current_user."===========");	
		//addToUserLog($current_user,print_r($_SERVER,true));
		//addToUserLog($current_user,"========================");	
		addToUserLog($current_user,print_r($_REQUEST,true));*/
	}
}
function userDetailedLog($current_user,$message){
	$uid_to_watch = array(6);
	$current_script = basename($_SERVER["SCRIPT_NAME"], ".php");
	if(in_array($current_user,$uid_to_watch)){
		addToUserLog($current_user,"[".$current_script."]=========".$current_user."===========");	
		addToUserLog($current_user,$message);
	}
}
?>