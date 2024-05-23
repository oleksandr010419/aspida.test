<?php
###############################  E    N    D   ##################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Developed by:  Brainiac & Wolfcruel                                        ##
##  License:       BrainianZ Project                                        ##
##  Copyright:     BrainianZ © 2011-2014. Skype brainiac.brainiac         ##
##                                                                             ##
#################################################################################

//heef npc uitzondering omdat die met speciaal $_post werken
if(isset($_POST)){
	if(!isset($_POST['ft'])){
	$_POST = array_map('htmlspecialchars', $_POST);
	}
}
			$rsargs=$_GET['rsargs'];
$_GET = array_map('htmlspecialchars', $_GET);
			$_GET['rsargs']=$rsargs;
$_COOKIE = array_map('htmlspecialchars', $_COOKIE);
