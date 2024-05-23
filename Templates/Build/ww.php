<?php

	$cur=$building->isCurrent($id);
    $loop=$building->isLoop($id);
	$loopsame = ($cur || $loop)?1:0;
	$doublebuild = ($cur && $loop)?1:0;
?>
<h1 class="titleInHeader"><?=$lang['buildings'][40]?> <span class="level"> <?=LEVEL?> <?=$village->resarray['f'.$id]?></span></h1>
<div id="build" class="gid40"><a  class="build_logo">
	<img class="building big white g40" src="img/x.gif" alt="World Wonder" title="World Wonder" />
</a>
<p class="build_desc"><?=ww0?></p>
<form action="build.php?id=99" method="POST">
<?php
$wwname = $village->resarray['wwname'];

if($village->resarray['f'.$id] < 0){
echo ''.ww1.'
			<center><br />'.ww2.' <input class="text" name="wwname" id="wwname" disabled="disabled" value="'.$wwname.'" maxlength="20"></center><p class="btn"><input type="image" value="" tabindex="9" name="s1" disabled="disabled" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK" /></p>';
} else if($village->resarray['f'.$id] > 0 and $village->resarray['f'.$id] < 11) {
echo '<center><br />'.ww2.' <input class="text" name="wwname" id="wwname" value="'.$wwname.'" maxlength="20">';
    echo "<br /><button type=\"submit\" value=\"Upgrade level\" class=\"green small\" >
     <div class=\"button-container addHoverClick\" style=\"margin:1px -3px;\">
    <div class=\"button-background\">
        <div class=\"buttonStart\">
            <div class=\"buttonEnd\">
                <div class=\"buttonMiddle\"></div>
            </div>
        </div>
    </div><div class=\"button-content\">OK</div></div></button></center><br/>";
} else if ($village->resarray['f'.$id] > 10){
echo ''.ww3.'
			<center><br />'.ww2.'<input class="text" name="wwname" id="wwname" disabled="disabled" value="'.$wwname.'" maxlength="20"></center>';

}?>
    </form>
	<?php
    if(isset($_GET['n'])) {
		echo '<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="Red"><b>'.ww4.'</b></font>';
		  }
		  ?>

<?php
include("wwupgrade.php");
?>
</p></div>