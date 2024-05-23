<?php function getTabs($class = ""){
	$menu = '</div><div class="header">
			<ul>
				<li class="'.(($class=="buyGold")?'active':'').'">
					<a href="#" class="tabButton buyGold" onclick="return false;">
						<div class="tabBtnBGPart start">
							<div class="tabBtnBGPart end">
								<div class="tabBtnBGPart middle"></div>
							</div>
						</div>
						<div class="text">Buy gold</div>
						<img src="img/x.gif" class="tabBtnImg">
					</a>
					<div class="tabBorder"></div>
				</li>
				<li class="'.(($class=="pros")?'active':'').'" >
					<a href="#" class="tabButton pros" onclick="return false;">
						<div class="tabBtnBGPart start">
							<div class="tabBtnBGPart end">
								<div class="tabBtnBGPart middle"></div>
							</div>
						</div>
						<div class="text">Advantages</div>
						<img src="img/x.gif" class="tabBtnImg">
					</a>
					<div class="tabBorder"></div>
				</li>';
			global $session;
             if(EXTRA_MENU) {
				$menu .= '<li class="'.(($class=="buyResources")?'active':'').'" >
					<a href="#" class="tabButton buyResources" onclick="return false;">
						<div class="tabBtnBGPart start">
							<div class="tabBtnBGPart end">
								<div class="tabBtnBGPart middle"></div>
							</div>
						</div>
						<div class="text">Buy resources</div>
						<img src="img/x.gif" class="tabBtnImg">
					</a>
					<div class="tabBorder"></div>
				</li>
				<li class="'.(($class=="buyBuildings")?'active':'').'" >
					<a href="#" class="tabButton buyBuildings" onclick="return false;">
						<div class="tabBtnBGPart start">
							<div class="tabBtnBGPart end">
								<div class="tabBtnBGPart middle"></div>
							</div>
						</div>
						<div class="text">Buy Buildings</div>
						<img src="img/x.gif" class="tabBtnImg">
					</a>
					<div class="tabBorder"></div>
				</li>
				<li class="'.(($class=="buyTroops")?'active':'').'" >
					<a href="#" class="tabButton buyTroops" onclick="return false;">
						<div class="tabBtnBGPart start">
							<div class="tabBtnBGPart end">
								<div class="tabBtnBGPart middle"></div>
							</div>
						</div>
						<div class="text">Buy Troops</div>
						<img src="img/x.gif" class="tabBtnImg">
					</a>
					<div class="tabBorder"></div>
				</li>';
			 }
			 
			$menu .= '<li class="'.(($class=="extraPlus")?'active':'').'" >
					<a href="#" class="tabButton extraPlus"
					   onclick="return false;">
						<div class="tabBtnBGPart start">
							<div class="tabBtnBGPart end">
								<div class="tabBtnBGPart middle"></div>
							</div>
						</div>
						<div class="text"><img src="/img/starGold.png" style="vertical-align: middle;width: 22px"> Plus Features</div>
					</a>
					<div class="tabBorder"></div>
				</li>
				<li class="clear"></li>
			</ul>
		</div>';
		return $menu;
}
?>
