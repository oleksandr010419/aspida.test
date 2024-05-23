<?php 
Global $session;
if(!empty($artefact)){
	include ('27_artefact.php');
	if($list_all && $artefact['size']==3){echo "<tr><td colspan=\"4\"></td></tr>";}
	echo '<tr>';
	echo '<td class="icon">' . $image . '</td>';
	echo '<td class="nam">
						<a href="build.php?id=' . $id . '&show=' . $artefact['id'] . '">' . $name . '</a> <span class="bon">' . $bonus . '</span>
						<div class="info" '.($artefact['activated']==0?'style="color:red"':"").'>
							' . sokr17 . ' <b>' . $reqlvl . '</b>, ' . sokr3 . ' <b>' . $effect . '</b>
						</div>
					</td>';
	if(!$list_all){
		if($artifact['owner']==$session->uid){
			echo '<td class="pla"><a href="karte.php?d=' . $artefact['vref'] . '&c=' . $generator->getMapCheck($artefact['vref']) . '">' . $database->getVillageField($artefact['vref'], "name") . '</a></td>';
			echo '<td class="dist">' . date("d/m/Y H:i", $artefact['conquered']) . '</td>';
		}else{
			echo '<td class="pla"><a href="karte.php?d=' . $artefact['vref'] . '&c=' . $generator->getMapCheck($artefact['vref']) . '">' . $database->getUserField($artefact['owner'], "username", 0) . '</a></td>';
			echo '<td class="dist">' . (isset($artefact[0])?$artefact[0]: '?') . '</td>';
		}
	}else{
		$alli="";

		if($artefact['owner']==3){ 
			$user=TRIBE5;
		}
		else{
		   $ui=$database->getUserforsoc($artefact['owner']);
		   $user=$ui['username'];
		   if($ui['id']){
				$alli='<a href="allianz.php?aid='.$ui['id'].'">'.$ui['tag'];
		   }
		}
		echo '<td class="pla"><a href="karte.php?d=' . $artefact['vref'] . '&c=' . $generator->getMapCheck($artefact['vref']) . '">'.$user.'</a></td>';
		echo  '<td class="al">'.$alli.'</a></td>';
	}
	echo' </tr>';
	if($list_all && $artefact['size']==3){echo "<tr><td colspan=\"4\"></td></tr>";}
}