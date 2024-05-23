    <div id="build" class="gid27">
<?php
        include("27_menu.php");
        if(isset($_GET['show']))
		{  
			if(isset($_GET['activate'])){
				//this action can only be performed on given village
				$artefact = $database->getArtefactDetails($_GET['show']);
				/*if($session->uid==16){
					die(print_r($artefact));
				}*/
				if($artefact['owner'] == $session->uid){
					if($_GET['activate']==1){
						if($artefact['size']==1 && $database->countOwnedActiveSmallArtefacts($session->uid)<2){
							$database->changeStateArtefact($_GET['show'],1);
						}
						else if($artefact['size']!=1 && $database->countOwnedActiveLargeArtefacts($session->uid)==0){
							$database->changeStateArtefact($_GET['show'],1);
						}
						checkVillageStatus($village->vref);
					}else{
						if($artefact['size']==1){
							$database->changeStateArtefact($_GET['show'],0);
						}
						else{
							$database->changeStateArtefact($_GET['show'],0);
						}
					}
				}				
			}
			include("27_show.php");  
		}
		else{
			if(!isset($_GET['t'])){
				include("27_1.php");
			}elseif(isset($_GET['t']) && $_GET['t'] == 2){
				include("27_2.php");
			}elseif(isset($_GET['t']) && $_GET['t'] == 3){
				include("27_3.php");
			}
        }
        ?>
    </div>