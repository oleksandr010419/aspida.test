<?php
include("Templates/Plus/pmenu.php");$extragoud="0";
$_SESSION['email']=$session->email;
?>



<?php
$pack_a=(PACK_A_GOLD);
$pack_b=(PACK_B_GOLD);
$pack_c=(PACK_C_GOLD);
$pack_d=(PACK_D_GOLD);
$pack_e=(PACK_E_GOLD);
$pack_f=(PACK_F_GOLD);
$new_pack_a=($pack_a + ($pack_a * DICOUNT_BONUS) / 100);
$new_pack_b=($pack_b + ($pack_b * DICOUNT_BONUS) / 100);
$new_pack_c=($pack_c + ($pack_c * DICOUNT_BONUS) / 100);
$new_pack_d=($pack_d + ($pack_d * DICOUNT_BONUS) / 100);
$new_pack_e=($pack_e + ($pack_e * DICOUNT_BONUS) / 100);
$new_pack_f=($pack_f + ($pack_f * DICOUNT_BONUS) / 100);
?>




<style>
    .tdc{text-align:center;}
</style>
<table width="100%" cellpadding="1" cellspacing="1" >
    <tr><thead>
        <th colspan="5"><center><b style="font-family: Georgia; font-size: 22px;" title=" Here you can buy gold using your PayPal account">Purchase Gold with <?=DICOUNT_BONUS?>% Bonus!!!</b></center></th> <br>
    </tr>
    </thead><tr>
        <td  class="tdc" width="20%"><img src="img/sale.png" height="50"></td>
        <td  class="tdc" width="20%"><b style="font-family: Georgia; font-size: 22px;">Was</b></td>
        <td  class="tdc" width="20%"><b style="font-family: Georgia; font-size: 22px;">Now</td>
		<td  class="tdc" width="20%"><b style="font-family: Georgia; font-size: 22px;">Price</td> 
        <td  class="tdc" width="20%"><img src="img/Paypal alt.png" height="50" title="Buy gold with PayPal"></td>
    </tr><tr>
        <td class="tdc"> Package A<img src="img/payment_package_1.png" width="50" height="50" title="Gold"></td>
		<td class="tdc"> <b><strike style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 20px;"><?=number_format(round($pack_a),0,'.','.')?></strike></b></td>
        <td class="tdc"> <b style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 20px;"><?=number_format(round($new_pack_a),0,'.','.')?></b></td> 
		<td class="tdc"> <b style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 20px;"><?=PACK_A_PRICE?> &euro;</b></td>
        <td class="tdc"> <a href="payment/payment.php?key=<?php echo base64_encode('Arina;'.$session->email.';88;A;Wolf'); ?>" target="_blank">Buy</a></td>
		
    </tr>
    <tr>
        <td class="tdc"> Package B<img src="img/payment_package_2.png" width="50" height="50" title="Gold"></td>
		<td class="tdc"> <b><strike style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 20px;"><?=number_format(round($pack_b),0,'.','.')?></strike></b></td>
        <td class="tdc"> <b style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 20px;"><?=number_format(round($new_pack_b),0,'.','.')?></b></td> 
		<td class="tdc"> <b style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 20px;"><?=PACK_B_PRICE?> &euro;</b></td>
        <td class="tdc"> <a href="payment/payment.php?key=<?php echo base64_encode('Arina;'.$session->email.';88;A;Wolf'); ?>" target="_blank">Buy</a></td>

    </tr><tr>
        <td class="tdc"> Package C<img src="img/payment_package_3.png" width="50" height="50" title="Gold"></td>
		<td class="tdc"> <b><strike style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 20px;"><?=number_format(round($pack_c),0,'.','.')?></strike></b></td>
        <td class="tdc"> <b style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 20px;"><?=number_format(round($new_pack_c),0,'.','.')?></b></td> 
		<td class="tdc"> <b style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 20px;"><?=PACK_C_PRICE?> &euro;</b></td>
        <td class="tdc"> <a href="payment/payment.php?key=<?php echo base64_encode('Arina;'.$session->email.';88;A;Wolf'); ?>" target="_blank">Buy</a></td>

    </tr>
    <tr>
        <td class="tdc"> Package D<img src="img/payment_package_4.png" width="50" height="50" title="Gold"></td>
		<td class="tdc"> <b><strike style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 20px;"><?=number_format(round($pack_d),0,'.','.')?></strike></b></td>
        <td class="tdc"> <b style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 20px;"><?=number_format(round($new_pack_d),0,'.','.')?></b></td> 
		<td class="tdc"> <b style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 20px;"><?=PACK_D_PRICE?> &euro;</b></td>
        <td class="tdc"> <a href="payment/payment.php?key=<?php echo base64_encode('Arina;'.$session->email.';88;A;Wolf'); ?>" target="_blank">Buy</a></td>

    </tr>
    <tr>
        <td class="tdc"> Package E<img src="img/payment_package_5.png" width="50" height="50" title="Gold"></td>
		<td class="tdc"> <b><strike style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 20px;"><?=number_format(round($pack_e),0,'.','.')?></strike></b></td>
        <td class="tdc"> <b style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 20px;"><?=number_format(round($new_pack_e),0,'.','.')?></b></td> 
		<td class="tdc"> <b style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 20px;"><?=PACK_E_PRICE?> &euro;</b></td>
        <td class="tdc"> <a href="payment/payment.php?key=<?php echo base64_encode('Arina;'.$session->email.';88;A;Wolf'); ?>" target="_blank">Buy</a></td>
    </tr>
    <tr>
        <td class="tdc"> Package F<img src="img/payment_package_6.png" width="50" height="50" title="Gold"></td>
		<td class="tdc"> <b><strike style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 20px;"><?=number_format(round($pack_f),0,'.','.')?></strike></b></td>
        <td class="tdc"> <b style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 20px;"><?=number_format(round($new_pack_f),0,'.','.')?></b></td> 
		<td class="tdc"> <b style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 20px;"><?=PACK_F_PRICE?> &euro;</b></td>
        <td class="tdc"> <a href="payment/payment.php?key=<?php echo base64_encode('Arina;'.$session->email.';88;A;Wolf'); ?>" target="_blank">Buy</a></td>
    </tr>


</table><br/>
<br/>
<br /><center> If you have questions, please contact<a href="/nachrichten.php?t=1&id=6"> Administrator</a></center>
<br><center>Gold is credited to your account immediately after payment. </center>
<br><br /><br /><center>Balance of gold from the previous round you can put through <a  href="/plus.php?id=6">Bank</a></center><br>