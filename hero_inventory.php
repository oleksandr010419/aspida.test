<?php

if(isset($_POST['id']) && !is_numeric($_POST['id'])) die('Hacking Attemp');
if(isset($_POST['amount']) && !is_numeric($_POST['amount'])) die('Hacking Attemp');
include("GameEngine/Village.php");
//$session->heroD['level']=100;

//$hero_model->heroControll($_SESSION['wid'],$session->villages,$session->heroD);

if($session->heroD['gender']==0){
	$gender='male';}
else{
    $gender='female';
}
$tribe = $session->tribe;
$hero_t = $GLOBALS["hero_t".$tribe];
$heroid = $session->heroD['heroid'];
if($session->heroD['dead'] && isset($_GET['revive'])==1 && 
	$village->awood > $hero_t[$session->heroD['level']]['wood'] && 
	$village->aclay > $hero_t[$session->heroD['level']]['clay'] && 	
	$village->airon > $hero_t[$session->heroD['level']]['iron'] && $village->acrop > $hero_t[$session->heroD['level']]['crop']){

    if(!$session->heroD['revivetime']){
        $each = (time() + ($hero_t[$session->heroD['level']]['time']/SPEED*1.5));

	if(empty($each) || $each<=0){
		$each = 1000000;
	}
		
    $database->query("UPDATE hero SET `revivetime` ='".$each."',`wref` = '" . $village->wid . "'  WHERE `uid` = '" . $session->uid . "'");
    $database->insertQueue($session->uid,11,time(),$each,$village->wid);

    $database->modifyResource($village->wid,$hero_t[$session->heroD['level']]['wood'],$hero_t[$session->heroD['level']]['clay'],$hero_t[$session->heroD['level']]['iron'],$hero_t[$session->heroD['level']]['crop'],0);
    $database->modifyHero2('wref', $village->wid, $session->uid, 0);
}
    header("Location: hero_inventory.php"); exit;
}


$gi = $database->getHeroInventory($session->uid);
include("GameEngine/Inventory.php");
if(!empty($_POST) || !empty($_GET)){
header("Location: hero_inventory.php");//exit;
}

?>
<!DOCTYPE html>
<html>
<?php include("Templates/html.php");?>
<?php
if(isset($_GET['inventory'])){

	$uid = $session->uid;
	if(isset($_GET['helmet'])){
		$database->setHeroInventory($uid, "helmet", 0);
		$database->editProcItem($gi['helmet'], 0, $uid);
		$database->modifyHeroFace($uid, "helmet", 0);

	}elseif(isset($_GET['leftHand'])){
        $itemData2 = $database->getItemData($gi['leftHand']);
        if($itemData2['type']>=76 && $itemData2['type']<=78){
            switch($itemData2['type']){
                case 76:
                    $strong=500;
                    break;
                case 77:$strong=1000;
                    break;
                case 78:$strong=1500;
                    break;

            }
            $database->modifyHero2("itempower",$strong,$uid,2);
        }
		$database->setHeroInventory($uid, "leftHand", 0);
		$database->editProcItem($gi['leftHand'], 0, $uid);
		$database->modifyHeroFace($uid, "leftHand", 0);

	}elseif(isset($_GET['rightHand'])){
		$itemData2 = $database->getItemData($gi['rightHand']);
		$btype=4;
		$type = $itemData2['type'];
		include dirname(__FILE__)."/GameEngine/Data/alt.php";
		$itempower = (!empty($effect)?$effect:0);
		
        $database->modifyHero2("itempower",$itempower,$uid,2);
		$database->setHeroInventory($uid, "rightHand", 0);
		$database->editProcItem($gi['rightHand'], 0, $uid);
		$database->modifyHeroFace($uid, "rightHand", 0);

	}elseif(isset($_GET['body'])){
        $itemData2 = $database->getItemData($gi['body']);
		$database->setHeroInventory($uid, "body", 0);
		$database->editProcItem($gi['body'], 0, $uid);
		$database->modifyHeroFace($uid, "body", 0);
        if($itemData2['type']>=88 && $itemData2['type']<=93){
            switch($itemData2['type']){
                case 88:
                case 92:
                    $strong=500;
                    break;
                case 89:$strong=1000;
                    break;
                case 90:$strong=1500;
                    break;
                case 91:$strong=250;
                    break;
                case 93:$strong=750;
                    break;
            }
            $database->modifyHero2("itempower",$strong,$uid,2);
        }

	}elseif(isset($_GET['horse'])){
		$itemData2 = $database->getItemData($gi['horse']);
		if($itemData2['type']==103){
		$database->modifyHero2("speed",7,$uid,2);
		}elseif($itemData2['type']==104){
		$database->modifyHero2("speed",10,$uid,2);
		}elseif($itemData2['type']==105){
		$database->modifyHero2("speed",13,$uid,2);
		}
		$database->setHeroInventory($uid, "horse", 0);
		$database->editProcItem($gi['horse'], 0, $uid);
		$database->modifyHeroFace($uid, "horse", 0);

	}elseif(isset($_GET['bag'])){
		$database->setHeroInventory($uid, "bag", 0);
		$database->editProcItem($gi['bag'], 0, $uid);
		$itemdata = $database->getItemData($gi['bag']);
		if($itemdata['btype'] >= 7 && $itemdata['btype']<=9){
		$database->editHeroType($itemdata['id'], 0, 2);
		}
	}elseif(isset($_GET['shoes'])){
        $itemData2 = $database->getItemData($gi['shoes']);
        $database->setHeroInventory($uid, "shoes", 0);
        $database->editProcItem($gi['shoes'], 0, $uid);
        $database->modifyHeroFace($uid, "foot", 0);
        if($itemData2['type']>=100 && $itemData2['type']<=102){
            if($itemData2['type']==100){
                $value = 3;
            }elseif($itemData2['type']==101){
                $value = 4;
            }elseif($itemData2['type']==102){
                $value = 5;
            }
            $database->modifyHero2('speed', $value, $uid, 2);
        }elseif($itemData2['type']>=94 && $itemData2['type']<=96){

            if($itemData2['type']==94){
                $value = 10;
            }elseif($itemData2['type']==95){
                $value = 15;
            }elseif($itemData2['type']==96){
                $value = 20;
            }
            $database->modifyHero2('autoregen', $value, $uid, 2);
            //exit;
        }
    }
}

?>
<body class="v35 <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> hero_inventory <?php if($dorf1==''){echo 'perspectiveBuildings';}else{ echo 'perspectiveResources';} ?>">
<script type="text/javascript">
    window.ajaxToken = 'de3768730d5610742b5245daa67b12cd';
</script>
<div id="background">
<div id="headerBar"></div>
<div id="bodyWrapper">

<div id="header">

    <?php
    include("Templates/topheader.php");
    include("Templates/toolbar.php");

    ?>

</div>
<div id="center">


<?php include("Templates/sideinfo.php"); ?>

<div id="contentOuterContainer" class="size1">

<?php include("Templates/res.php"); ?>
<div class="contentTitle"><a id="closeContentButton" class="contentTitleButton" href="dorf<?=$session->link?>.php" title="Close window">&nbsp;</a>
    <a id="answersButton" class="contentTitleButton" href="http://t4.answers.travian.com/index.php?aid=106#go2answer" target="_blank" title="Travian Answers">&nbsp;</a></div>
<div class="contentContainer">
<div id="content" class="hero_inventory"><h1 class="titleInHeader"><?=$session->username?> - <?php echo U0; ?> <?=LVL."  ". $session->heroD['level']?></h1>
<div class="contentNavi subNavi">
				<div class="container active">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_inventory.php"><span class="tabItem"><?=herohero0?></span></a></div>
				</div>
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero.php"><span class="tabItem"><?=herohero1?></span></a></div>
				</div>
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_adventure.php"><span class="tabItem"><?=herohero2?></span></a></div>
				</div>
				<div class="container normal">
					<div class="background-start">&nbsp;</div>
					<div class="background-end">&nbsp;</div>
					<div class="content"><a href="hero_auction.php"><span class="tabItem"><?=herohero3?></span></a></div>
				</div><div class="clear"></div>
		</div>
		<script type="text/javascript">
					window.addEvent('domready', function()
					{
						$$('.subNavi').each(function(element)
						{
							new Travian.Game.Menu(element);
						});
					});
</script>
<div class="clear"></div>
<?php
include("Templates/hero.php");
?>

<div id="bodyOptions">
	<div id="hero_body_container">
		<div id="hero_body">

         <img class="heroBodyImage heroBodyImage-LTR"  src="<?=$database->heroBody($session->uid)?>" >
			<div class="clear"></div>
		</div>

		<div id="hero_body_content">
			<div class="content gender_<?=$gender?>">

<?php

$dis = '';
if($session->heroD['dead']==1){
	$dis = ' disabled';
}
if($gi['helmet']!=0){

	$data = $database->getItemData($gi['helmet']);
    $btype=$data['btype'];
    $type=$data['type'];
    include "GameEngine/Data/alt.php";
	$item = '<a href="?inventory&helmet"><div id="item_'.$gi['helmet'].'" title="'.$name.'||'.$title.'" class="item item_'.$data['type'].' onHero'.$dis.'" style="position: relative; left: 0px; top: 0px; "><div class="amount">'.$data['num'].'</div></div></a>';
	echo '<div id="helmet" class="draggable">'.$item.'</div>';
}else{
	echo '<div id="helmet" class="draggable"></div>';
}

if($gi['leftHand']!=0){
	$data = $database->getItemData($gi['leftHand']);
    $btype=$data['btype'];
    $type=$data['type'];
    include "GameEngine/Data/alt.php";
	$item = '<a href="?inventory&leftHand"><div id="item_'.$gi['leftHand'].'" title="'.$name.'||'.$title.'" class="item item_'.$data['type'].' onHero'.$dis.'" style="position: relative; left: 0px; top: 0px; "><div class="amount">'.$data['num'].'</div></div></a>';
	echo '<div id="leftHand" class="draggable">'.$item.'</div>';
}else{
	echo '<div id="leftHand" class="draggable"></div>';
}

if($gi['rightHand']!=0){
	$data = $database->getItemData($gi['rightHand']);
    $btype=$data['btype'];
    $type=$data['type'];
    include "GameEngine/Data/alt.php";
	$item = '<a href="?inventory&rightHand"><div id="item_'.$gi['rightHand'].'" title="'.$name.'||'.$title.'" class="item item_'.$data['type'].' onHero'.$dis.'" style="position: relative; left: 0px; top: 0px; "><div class="amount">'.$data['num'].'</div></div></a>';
	echo '<div id="rightHand" class="draggable">'.$item.'</div>';
}else{
	echo '<div id="rightHand" class="draggable"></div>';
}

if($gi['body']!=0){
	$data = $database->getItemData($gi['body']);
    $btype=$data['btype'];
    $type=$data['type'];
    include "GameEngine/Data/alt.php";
	$item = '<a href="?inventory&body"><div id="item_'.$gi['body'].'" title="'.$name.'||'.$title.'" class="item item_'.$data['type'].' onHero'.$dis.'" style="position: relative; left: 0px; top: 0px; "><div class="amount">'.$data['num'].'</div></div></a>';
	echo '<div id="body" class="draggable">'.$item.'</div>';
}else{
	echo '<div id="body" class="draggable"></div>';
}

if($gi['horse']!=0){
	$data = $database->getItemData($gi['horse']);
    $btype=$data['btype'];
    $type=$data['type'];
    include "GameEngine/Data/alt.php";
	$item = '<a href="?inventory&horse"><div id="item_'.$gi['horse'].'" title="'.$name.'||'.$title.'" class="item item_'.$data['type'].' onHero'.$dis.'" style="position: relative; left: 0px; top: 0px; "><div class="amount">'.$data['num'].'</div></div></a>';
	echo '<div id="horse" class="draggable">'.$item.'</div>';
}else{
	echo '<div id="horse" class="draggable"></div>';
}
if($gi['shoes']!=0){
    $data = $database->getItemData($gi['shoes']);
    $btype=$data['btype'];
    $type=$data['type'];
    include "GameEngine/Data/alt.php";
    $item = '<a href="?inventory&shoes"><div id="item_'.$gi['shoes'].'" title="'.$name.'||'.$title.'" class="item item_'.$data['type'].' onHero'.$dis.'" style="position: relative; left: 0px; top: 0px; "><div class="amount">'.$data['num'].'</div></div></a>';
    echo '<div id="shoes" class="draggable">'.$item.'</div>';
}else{
    echo '<div id="shoes" class="draggable"></div>';
}

if($gi['bag']!=0){
	//$data = $database->getItemData($gi['bag']);
//	if($data['btype'] < 7 && $data['btype'] > 9){
//	$item = '<a href="?inventory&bag"><div id="item_'.$gi['bag'].'" class="item item_'.$data['type'].' onHero" style="position: relative; left: 0px; top: 0px; "><div class="amount">'.$data['num'].'</div></div></a>';
	//echo '<div id="bag" class="draggable">'.$item.'</div>';
	//}else{
	$data = $database->getItemData($gi['bag']);
	$item = '<a href="?inventory&bag"><div id="item_'.$gi['bag'].'" class="item '.$gender.'_item_'.($data['btype']+105).' onHero" style="position: relative; left: 0px; top: 0px; "><div class="amount">'.$data['type'].'</div></div></a>';
	echo '<div id="bag" class="draggable">'.$item.'</div>';
	//}
}else{
	echo '<div id="bag" class="draggable"></div>';
}
?>
			</div>
		</div>
	</div>

</div>
<div id="hero_inventory">
	<div class="boxes boxesColor gray"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div>

        <div class="boxes-contents cf">
    <div id="itemsToSale"><?php
$prefix = "heroitems";

$sql = $database->query("SELECT * FROM heroitems WHERE (proc = 0 or (btype > 6 and btype <10 and num>type)) AND uid = '".$session->uid."'");
$outputList = '';

$inv = 1;
foreach($sql as $row){
$id = $row["id"];$uid = $row["uid"];$btype = $row["btype"];$type = $row["type"];$num = $row["num"];$proc = $row["proc"];
include "GameEngine/Data/alt.php";
	if($btype<=10 or $btype==11 or $btype==13){
		if($session->heroD['dead']==1){
			$dis = ' disabled';
			$deadTitle = "
			<span class='itemNotMoveable'>You cannot use this item when your hero is dead.</span><br>";
		}else if($btype==13 && $session->heroD['level']==0){
			$dis = ' disabled';
			$deadTitle = "
			<span class='itemNotMoveable'>You cannot use this item until hero has level 1.</span><br>";
		}
		else{
			$dis = '';
			$deadTitle = '';
		}
	}else{
		$dis = '';
		$deadTitle = '';
	}
	if($btype >= 7 && $btype <= 9){

	$amount = '('.$num.') ';
	$outputList .= "<div id=\"inventory_".$inv."\" class=\"inventory draggable\">";
	$outputList .= "<div id=\"item_".$id."\" title=\"".$amount."".$name."||".$deadTitle.($num*SPEED/10).$title."\" class=\"item ".$gender."_item_".($btype+105)."".$dis."\" style=\"position:relative;left:0;top:0;\">";
	$outputList .= "<div class=\"amount\">".($num-$type)."</div>";
	$outputList .= "</div>";
	$outputList .= '</div>';
	}else{
	if($num==1){$amount = '';}else{$amount = '('.$num.') ';}
	$outputList .= "<div id=\"inventory_".$inv."\" class=\"inventory draggable\">";
	$outputList .= "<div id=\"item_".$id."\" title=\"".$amount."".$name."||".$deadTitle."".$title."\" class=\"item ".$gender."_item_".$item."".$dis."\" ' style=\"position:relative;left:0;top:0;\">";
	$outputList .= "<div class=\"amount\">".$num."</div>";
	$outputList .= "</div>";
	$outputList .= '</div>';
	$inv++;	
	}
}
	echo $outputList;
	
if($inv <= 12){
	for($i=$inv;$i<=((12+$inv)-$inv);$i++){
		echo '<div id="inventory_'.$i.'" class="inventory draggable"></div>';
	}
}else{
	echo '<div id="inventory_'.$i.'" class="inventory draggable"></div>';
}
?>
			<div class="market">
				<a class="buy arrow" href="hero_auction.php?action=buy"><?=herohero4?></a>
				<a class="sell arrow" href="hero_auction.php?action=sell"><?=herohero5?></a>
				<a class="sell arrow" href="hero_auction.php?action=delete"><?=herohero7?></a>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
</div>
<div class="clear"></div>
<div id="placeHolder"></div>
<form id="HeroInventory" method="post" action="hero_inventory.php">
	<input type="hidden" name="a" value="inventory">
	<input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
	<input type="hidden" name="amount" value="<?php echo $_POST['amount']; ?>">
    <input type="hidden" name="btype" value="<?php echo $_POST['btype']; ?>">
    <input type="hidden" name="type" value="<?php echo $_POST['type']; ?>">
</form>
                                <?php $ucp= round($database->getVSumField($session->uid, 'cp'));
                                $ucpn=round($database->getUserField($session->uid, 'cp',0));?>
<script type="text/javascript">
	Travian.Game.Hero.Inventory = new (new Class(
	{

		
		b15: '<table id="heroInventoryDataDialog" class="transparent" cellspacing="0" cellpadding="0"><tbody><tr class="rowBeforeUse"><th><?=heroh2?></th><td><?php echo $ucpn; ?></td></tr><tr class="rowUseValue"><th><?=heroh3?></th><td class="displayUseValue"><?php echo $ucp/2; ?></td></tr><tr class="rowAfterUse"><th><?=heroh4?></th><td class="displayAfterUse"><?php echo ($ucpn+$ucp/2); ?></td></tr></tbody></table>',
		
		alreadyOpen: false,
        textSingle: "<?=heroh1?>" ,
		textMulti: 'Total item used: &lt;input class=\"text\" id=\"amount\" type=\"text\" value=\"\" /&gt;'.unescapeHtml(),
		initialize: function() {
			var $this = this;
			
<?php
$sql2 = $database->query("SELECT * FROM heroitems WHERE proc = 0 AND uid = '".$session->uid."'");

foreach($sql2 as $row2){
$id = $row2["id"];$num = $row2["num"];$btype = $row2["btype"];$type = $row2["type"];
	if($btype<=10 or $btype==11 or $btype==13){
		if($session->heroD['dead']==0){
			if($num==1){
?>
$('item_<?php echo $id; ?>').addEvent('click', function() { $this.showItem(<?php echo $id; ?>,<?php echo $num; ?>,<?php echo $btype; ?>,<?php echo $type; ?>);});															   
<?php		}else{ ?>
$('item_<?php echo $id; ?>').addEvent('click', function() { $this.sellItem(<?php echo $id; ?>,<?php echo $num; ?>,<?php echo $btype; ?>,<?php echo $type; ?>);});
<?php
			}
		}
	}else{
?>
$('item_<?php echo $id; ?>').addEvent('click', function() { $this.sellItem(<?php echo $id; ?>,<?php echo $num; ?>,<?php echo $btype; ?>,<?php echo $type; ?>);});
<?php
	}
}
?>
							},
		showItem: function (id, amount, btype, type){
			var $this = this;
			$('HeroInventory').id.value = id;
			$('HeroInventory').amount.value = amount;
			$('HeroInventory').btype.value = btype;
			$('HeroInventory').type.value = type;
			$('HeroInventory').submit();
		},
		sellItem: function (id, amount, btype, type){
			var html = '';
			var $this = this;
			if (this.alreadyOpen){
				return;
			}
			this.alreadyOpen = true;
			$('HeroInventory').id.value = id;
			$('HeroInventory').amount.value = amount;
			$('HeroInventory').btype.value = btype;
			$('HeroInventory').type.value = type;
			if (amount == 1){
				if(btype == 10){
					html = $this.textSingle;
					html += this.b10;
				}else
				if(btype == 15){
					html = $this.textSingle;
					html += this.b15;
				}else{
					html = $this.textSingle;
				}
			}else{
				if(btype == 15){
                    cp_now = '<?=round($ucpn)?>';
					cp = '<?php echo round($ucp/2); ?>';
					cp_b = (cp*amount);
					cp_total = <?php echo round($ucpn); ?>+cp_b;
					html = $this.textMulti;
					html += '<table id="heroInventoryDataDialog" class="transparent" cellspacing="0" cellpadding="0"><tbody><tr class="rowBeforeUse"><th>Очков Культуры:</th><td>'+cp_now+'</td></tr><tr class="rowUseValue"><th>Бонус:</th><td class="displayUseValue">'+cp_b+'</td></tr><tr class="rowAfterUse"><th>Очков Культуры Станет: </th><td class="displayAfterUse">'+cp_total+'</td></tr></tbody></table>';
					
				}else{
					html = $this.textMulti;
				}
			}
			html.dialog({
				relativeTo:			$('content'),
				elementFoucs:		'inventoryAmount',
				buttonTextOk:		'Ok',
				buttonTextCancel:	'Cancel',
				title:				"<?=heroh0?>" ,
				onOpen: function(dialog, contentElement){
					if ($('amount')){
						$('amount').value = amount;
						$('amount').addEvent('change', function(){
							$('HeroInventory').amount.value = $('amount').value;
						});
					}
				},
				onOkay: function(dialog, contentElement){
					if ($('amount')){
						$('HeroInventory').amount.value = $('amount').value;
					}
					$('HeroInventory').submit();
				},
				onClose: function(dialog, contentElement){
					$this.alreadyOpen = false;
				}
			});
		}
	}));
</script>
<div class="clear">&nbsp;</div>
</div>
<div class="clear"></div>


</div>
<div class="contentFooter">&nbsp;</div>

</div>
<?php
include("Templates/rightsideinfor.php");
?>
<div class="clear"></div>
</div>
<?php

include("Templates/header.php");
?>
</div>
<div id="ce"></div>
</div>
</body>
</html>




