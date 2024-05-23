<?php
include("Templates/Plus/pmenu.php");$extragoud="0";
$_SESSION['email']=$session->email;
?>








<style>
    .tdc{text-align:center;}
</style>
<table width="100%" cellpadding="1" cellspacing="1" >
    <tr><thead>
        <th colspan="5"><center><b><font color="red"><u>Buy Gold</u></b></font></center></th> <br>
    </tr>
    </thead><tr>
        <td  class="tdc" width="20%">Select a Package</td>
        <td  class="tdc" width="20%">Price</td>
        <td  class="tdc" width="20%">Amount of gold</td>
        <td  class="tdc" width="20%">Buying(Paypal)</td>
    </tr><tr>
        <td class="tdc"> Package A</td>
        <td class="tdc"> 2 &euro;</td>
        <td class="tdc"> 1.250 <img src="img/x.gif" class="gold" alt="gold" title="Gold"></td>
        <td class="tdc"> <a href="payment/payment.php?key=<?php echo base64_encode('Arina;'.$session->email.';88;A;Wolf'); ?>" target="_blank">Buy</a></td>
    </tr>
    <tr>
        <td class="tdc"> Package B</td>
        <td class="tdc"> 4 &euro;</td>
        <td class="tdc"> 3.125 <img src="img/x.gif" class="gold" alt="gold" title="Gold"></td>
        <td class="tdc"> <a href="payment/payment.php?key=<?php echo base64_encode('Arina;'.$session->email.';88;B;Wolf'); ?>" target="_blank">Buy</a></td>

    </tr><tr>
        <td class="tdc"> Package C</td>
        <td class="tdc"> 8 &euro;</td>
        <td class="tdc"> 7.750 <img src="img/x.gif" class="gold" alt="gold" title="Gold"></td>
        <td class="tdc"> <a href="payment/payment.php?key=<?php echo base64_encode('Arina;'.$session->email.';88;C;Wolf'); ?>" target="_blank">Buy</a></td>

    </tr>
    <tr>
        <td class="tdc"> Package D</td>
        <td class="tdc"> 16 &euro;</td>
        <td class="tdc"> 19.500 <img src="img/x.gif" class="gold" alt="gold" title="Gold"></td>
        <td class="tdc"> <a href="payment/payment.php?key=<?php echo base64_encode('Arina;'.$session->email.';88;D;Wolf'); ?>" target="_blank">Buy</a></td>

    </tr>
    <tr>
        <td class="tdc"> Package E</td>
        <td class="tdc"> 32 &euro;</td>
        <td class="tdc"> 50.000 <img src="img/x.gif" class="gold" alt="gold" title="Gold"></td>
        <td class="tdc"> <a href="payment/payment.php?key=<?php echo base64_encode('Arina;'.$session->email.';88;E;Wolf'); ?>" target="_blank">Buy</a></td>
    </tr>
    <tr>
        <td class="tdc"> Package F</td>
        <td class="tdc"> 50 &euro;</td>
        <td class="tdc"> 100.000 <img src="img/x.gif" class="gold" alt="gold" title="Gold"></td>
        <td class="tdc"> <a href="payment/payment.php?key=<?php echo base64_encode('Arina;'.$session->email.';88;F;Wolf'); ?>" target="_blank">Buy</a></td>

    </tr>


</table><br/>
<br/><script src='https://assets.fortumo.com/fmp/fortumopay.js' type='text/javascript'></script>
<a id="fmp-button" href="#" rel="0838e46c5a36d3efb733c5a3e2c96f89"><img src="https://assets.fortumo.com/fmp/fortumopay_150x50_red.png" width="150" height="50" alt="Mobile Payments by Fortumo" border="0" /></a>
<br /><center> If you have questions, please contact<a href="/nachrichten.php?t=1&id=6"> Administrator</a></center>
<br><center>Gold is credited to your account immediately after payment. </center>
<br><br /><br /><center>Balance of gold from the previous round you can put through <a  href="/plus.php?id=6">Bank</a></center><br>