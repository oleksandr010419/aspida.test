<?php class Medal extends DB{
	function findTopAttackers(){
		
	}
	
	function findTopDefenders(){
		
	}
	
	
	
	
	
	function addMedal($id, $categ, $place,$week, $points,$img, $allycheck=0) {
		$quer = "INSERT into medal(userid, categorie, plaats, week, points, img,allycheck) values('" . $id . "', '" . $categ . "', '" . $place . "', '" . $week . "', '" . $points . "', '" . $img . "','".$allycheck."')";
		$this->query($quer);
	}
}?>