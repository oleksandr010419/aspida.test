<?php 
$te = $artefact['type'];
$se = $artefact['size'];
$bonus="";
if ($te == 1 AND $se == 1) {
	$name = ART1;
	$desc = ART16;
	$bonus = "(4x) ";
	$image = '<img class="artefact_icon_2" src="img/x.gif">';
}
if ($te == 1 AND $se == 2) {
	$name = ART2;
	$desc = ART16;
	$bonus = "(3x) ";
	$image = '<img class="artefact_icon_2" src="img/x.gif">';
}
if ($te == 1 AND $se == 3) {
	$name = ART3;
	$desc = ART16;
	$bonus = "(5x) ";
	$image = '<img class="artefact_icon_2" src="img/x.gif">';
}
if ($te == 2 AND $se == 1) {
	$name = ART4;
	$desc = ART17;
	$bonus = "(2x) ";
	$image = '<img class="artefact_icon_4" src="img/x.gif">';
}
if ($te == 2 AND $se == 2) {
	$name = ART5;
	$desc = ART17;
	$bonus = "(1.5x) ";
	$image = '<img class="artefact_icon_4" src="img/x.gif">';
}
if ($te == 2 AND $se == 3) {
	$name = ART6;
	$desc = ART17;
	$bonus = "(3x) ";
	$image = '<img class="artefact_icon_4" src="img/x.gif">';
}
if ($te == 3 AND $se == 1) {
	$name = ART7;
	$desc = ART18;
	$bonus = "(5x) ";
	$image = '<img class="artefact_icon_5" src="img/x.gif">';
}
if ($te == 3 AND $se == 2) {
	$name = ART8;
	$desc = ART18;
	$bonus = "(3x) ";
	$image = '<img class="artefact_icon_5" src="img/x.gif">';
}
if ($te == 3 AND $se == 3) {
	$name = ART9;
	$desc = ART18;
	$bonus = "(10x) ";
	$image = '<img class="artefact_icon_5" src="img/x.gif">';
}
if ($te == 4 AND $se == 1) {
	$name = ART31;
	$desc = ART34;
	$bonus = "(50%) ";
	$image = '<img class="artefact_icon_6" src="img/x.gif">';
}
if ($te == 4 AND $se == 2) {
	$name = ART32;
	$desc = ART34;
	$bonus = "(25%) ";
	$image = '<img class="artefact_icon_6" src="img/x.gif">';
}
if ($te == 4 AND $se == 3) {
	$name = ART33;
	$desc = ART34;
	$bonus = "(50%) ";
	$image = '<img class="artefact_icon_6" src="img/x.gif">';
}
if ($te == 5 AND $se == 1) {
	$name = ART10;
	$desc = ART19;
	$bonus = "(50%) ";
	$image = '<img class="artefact_icon_8" src="img/x.gif">';
}
if ($te == 5 AND $se == 2) {
	$name = ART11;
	$desc = ART19;
	$bonus = "(25%) ";
	$image = '<img class="artefact_icon_8" src="img/x.gif">';
}
if ($te == 5 AND $se == 3) {
	$name = ART12;
	$desc = ART19;
	$bonus = "(50%) ";
	$image = '<img class="artefact_icon_8" src="img/x.gif">';
}
if ($te == 6) {
	$name = ART13;
	$desc = ART20;
	$bonus = ART15;
	$image = '<img class="artefact_icon_9" src="img/x.gif">';
}
if ($te == 7 AND $se == 1) {
	$name = ART35;
	$desc = ART38;
	$bonus = "(200) ";
	$image = '<img class="artefact_icon_10" src="img/x.gif">';
}
if ($te == 7 AND $se == 2) {
	$name = ART36;
	$desc = ART38;
	$bonus = "(100) ";
	$image = '<img class="artefact_icon_10" src="img/x.gif">';
}
if ($te == 7 AND $se == 3) {
	$name = ART37;
	$desc = ART38;
	$bonus = "(500) ";
	$image = '<img class="artefact_icon_10" src="img/x.gif">';
}
if ($te == 8 AND $se == 1) {
	$name = ART41;
	$desc = ART43.ART44;
	$bonus = ART45;
	$image = '<img class="artefact_icon_fool" src="img/x.gif">';
}
if ($te == 8 AND $se == 3) {
	$name = ART42;
	$desc = ART43;
	$bonus = ART45;
	$image = '<img class="artefact_icon_fool" src="img/x.gif">';
}
if ($te == 11) {
	$name = ART14;
	$desc = ART21;
	$bonus = ART15;
	$image = '<img class="artefact_icon_1" src="img/x.gif">';
}
if ($artefact['size'] == 1) {
	$reqlvl = 10;
	$range = sokr1;
} elseif ($artefact['size'] == 2 or 3) {
	$reqlvl = 20;
	$range = pluss11;
}