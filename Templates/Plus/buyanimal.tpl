<?php 
require_once __DIR__.'/../../GameEngine/Database.php';

global $session; 
if($session->access!=BANNED){
$price = array('','1','2','3','4','5','6','7','8','9','10');
?>
<h1>خرید حیوانات</h1>
<script type="text/javascript">
function altRows(id){
	if(document.getElementsByTagName){  
		
		var table = document.getElementById(id);  
		var rows = table.getElementsByTagName("tr"); 
		 
		for(i = 0; i < rows.length; i++){          
			if(i % 2 == 0){
				rows[i].className = "evenrowcolor";
			}else{
				rows[i].className = "oddrowcolor";
			}      
		}
	}
}
window.onload=function(){
	altRows('alternatecolor');
}
</script>
<font color="black" size="3"><center><b><blink>
در اینجا قادر به خرید حیوانات توسط سکۀ طلای <?php echo SERVER_NAME;?> هستید
</font></center></b></blink>
<br />
<font color="black" size="3"><center>
برای اطلاع از از قیمت های هر حیوان , روی عکس آن کلیک کنید
</font></center>
<br />
<form method="POST" name="snd" action="animal.php?buy">
<input name="x" value="1" type="hidden">
	<table id="troops" cellpadding="1" cellspacing="0"  class="altrowstable" id="alternatecolor">
	<tbody><tr>
		<td class="line-first column-first large"><center><center><img class="unit u31" src="img/x.gif" title="<?php echo U31;echo " ".$price[1]." طلا";?>" alt="<?php echo U31; ?>"> <input name="t31" maxlength="6" type="text" size = "10" placeholder="<?php echo $village->unitarray['u31'];?>">
		<a href="#" onclick="document.snd.t31.value=<?php echo round($session->gold/$price[1]);?>; return false;"><?php echo round($session->gold/$price[1]);?></a>
        <td class="line-first large"><center><img class="unit u32" src="img/x.gif" title="<?php echo U32;echo " ".$price[2]." طلا"; ?>" alt="<?php echo U32;?>"> <input name="t32" maxlength="6" type="text" size = "10" placeholder="<?php echo $village->unitarray['u32'];?>">
		<a href="#" onclick="document.snd.t32.value=<?php echo round($session->gold/$price[2]);?>; return false;"><?php echo round($session->gold/$price[2]);?></a>
        <td class="line-first regular"><center><img class="unit u33" src="img/x.gif" title="<?php echo U33;echo " ".$price[3]." طلا"; ?>" alt="<?php echo U33;?>"> <input name="t33" maxlength="6" type="text" size = "10" placeholder="<?php echo $village->unitarray['u33'];?>">
		<a href="#" onclick="document.snd.t33.value=<?php echo round($session->gold/$price[3]);?>; return false;"><?php echo round($session->gold/$price[3]);?></a>
    </tr>
	<tr>
		<td class="line-first column-last small"><center><img class="unit u34" src="img/x.gif" title="<?php echo U34;echo " ".$price[4]." طلا"; ?>" alt="<?php echo U34; ?>"> <input name="t34" maxlength="6" type="text" size = "10" placeholder="<?php echo $village->unitarray['u34'];?>">
		<a href="#" onclick="document.snd.t34.value=<?php echo round($session->gold/$price[4]);?>; return false;"><?php echo round($session->gold/$price[4]);?></a>
		<td class="column-first large"><center><img class="unit u35" src="img/x.gif" title="<?php echo U33;echo " ".$price[5]." طلا"; ?>" alt="<?php echo U35; ?>"> <input name="t35" maxlength="6" type="text" size = "10" placeholder="<?php echo $village->unitarray['u35'];?>">
		<a href="#" onclick="document.snd.t35.value=<?php echo round($session->gold/$price[5]);?>; return false;"><?php echo round($session->gold/$price[5]);?></a>
		<td class="large"><center><img class="unit u36" src="img/x.gif" title="<?php echo U36;echo " ".$price[6]." طلا"; ?>" alt="<?php echo U36; ?>"> <input name="t36" maxlength="6" type="text" size = "10" placeholder="<?php echo $village->unitarray['u36'];?>">
		<a href="#" onclick="document.snd.t36.value=<?php echo round($session->gold/$price[6]);?>; return false;"><?php echo round($session->gold/$price[6]);?></a>
	</tr>
	<tr>
		<td class="regular"><center><img class="unit u37" src="img/x.gif" title="<?php echo U37;echo " ".$price[7]." طلا"; ?>" alt="<?php echo U37; ?>"> <input name="t37" maxlength="6" type="text" size = "10" placeholder="<?php echo $village->unitarray['u37'];?>">
		<a href="#" onclick="document.snd.t37.value=<?php echo round($session->gold/$price[7]);?>; return false;"><?php echo round($session->gold/$price[7]);?></a>
		<td class="column-last small"><center><img class="unit u38" src="img/x.gif" title="<?php echo U38;echo " ".$price[8]." طلا"; ?>" alt="<?php echo U38; ?>"> <input name="t38" maxlength="6" type="text" size = "10" placeholder="<?php echo $village->unitarray['u38'];?>">
		<a href="#" onclick="document.snd.t38.value=<?php echo round($session->gold/$price[8]);?>; return false;"><?php echo round($session->gold/$price[8]);?></a>
		<td class="line-last column-first large"><center><img class="unit u39" src="img/x.gif" title="<?php echo U39;echo " ".$price[9]." طلا"; ?>" alt="<?php echo U39; ?>"> <input name="t39" maxlength="6" type="text" size = "10" placeholder="<?php echo $village->unitarray['u39'];?>">
		<a href="#" onclick="document.snd.t39.value=<?php echo round($session->gold/$price[9]);?>; return false;"><?php echo round($session->gold/$price[9]);?></a>
	</tr>
	<tr>
		<td></td>
			<td class="line-last large"><center><img class="unit U40" src="img/x.gif" title="<?php echo U40;echo " ".$price[10]." طلا"; ?>" alt="<?php echo U33; ?>"> <input name="t40" maxlength="6" type="text" size = "10" placeholder="<?php echo $village->unitarray['u40'];?>">
			<a href="#" onclick="document.snd.t40.value=<?php echo round($session->gold/$price[10]);?>; return false;"><?php echo round($session->gold/$price[10]);?></a>
		<td></td>
	</tr>
</tbody></table>
<center><br /><br />
<button type="submit" value="خرید حیوانات" name="s1" id="btn_ok"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents">خرید حیوانات</div></div></button>

</center>
<?php
if(isset($_GET['buy'])){
$troop = array('0','0','0','0','0','0','0','0','0','0','0');
$gold = 0;
for($i=1; $i<=10; $i++){
		if($i == 10){
			if ($_POST['t40'] > 0 && $_POST['t40'] <= round($session->gold/$price[10])){
				$troop[10] = (int)$_POST['t40'];
				$gold = $gold + ($troop[10]*$price[10]);
			}else{
				$troop[10] = 0;
			}
		}else{
				if ($_POST['t3'.$i] > 0 && $_POST['t3'.$i] <= round($session->gold/$price[$i])){
					$troop[$i] = (int)$_POST['t3'.$i];
					$gold = $gold + ($troop[$i]*$price[$i]);
				}else{
					$troop[$i] = 0;
				}
		}
}
if($gold > 0 ){
$q = "UPDATE " . TB_PREFIX . "units SET u31 = u31 + ".$troop[1].", u32 = u32 + ".$troop[2].", u33 = u33 + ".$troop[3].", u34 = u34 + ".$troop[4].",
u35 = u35 + ".$troop[5].", u36 = u36 + ".$troop[6].", u37 = u37 + ".$troop[7].", u38 = u38 + ".$troop[8].", u39 = u39 + ".$troop[9].", u40 = u40 + ".$troop[10]."
WHERE vref ='".$_SESSION['wid']."'";
$result = $database->query($q)or die(mysql_error());
$q = "UPDATE " . TB_PREFIX . "users SET gold = gold - $gold WHERE id = ".$session->uid."";
$result = $database->query($q)or die(mysql_error());
echo "<script>alert('حیوانات خریداری شدند .');location.href='animal.php';</script>";

}else{
echo "<script>alert('خطا در خرید');location.href='animal.php';</script>";
}
}
}else{
header("Location: Banned.php");
}
?>

<div style="margin-right:500px;margin-top:110px; font-style: italic; font-size: 10px; color:#bfbfbf">SHadoW&copy;</div>