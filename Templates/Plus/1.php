<?php
include("Templates/Plus/pmenu.php");$extragoud="0";
$_SESSION['email']=$session->email;
?>








<style>
    .tdc{text-align:center;}
</style>

    
        <h1>Payment methods</h1>
    </tr>
  <br></br>
<a><img src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/silver-rect-paypal-60px.png" alt="PayPal"></a>
<br></br><br></br>
<form action="https://checkout.wirecard.com/page/init.php" method="post" name="form">
      <input type="hidden" name="customerId" value="D200001" />

      <input type="hidden" name="successURL" value="http://devel.flyerdefenders.com/purchase/callback/" />
      <input type="hidden" name="pendingURL" value="http://devel.flyerdefenders.com/purchase/callback/" />
      <input type="hidden" name="failureURL" value="http://localhost:8000/purchase/callback/" />
      <input type="hidden" name="cancelURL" value="http://localhost:8000/purchase/callback/" />
      <input type="hidden" name="confirmURL" value="http://www.flyerconcierge.com/purchase/callback/" />
      <input type="hidden" name="serviceURL" value="http://www.flyerconcierge.com" />
      <input type="hidden" name="imageURL" value="http://www.flyerconcierge.com//static/images/favicon.png" />

      <input type="hidden" name="amount" value="99.99" />
      <input type="hidden" name="currency" value="USD" />
      <input type="hidden" name="language"  value="en" />

      <input type="hidden" name="orderDescription" value="Jane Doe (33562)" />
      <input type="hidden" name="displayText" value="Thank you very much for your order." />


      <input type="hidden" name="requestFingerprintOrder" value="secret,customerId,amount,currency,language,orderDescription,displayText,successUrl,pendingURL,confirmURL,requestFingerprintOrder" />
      <input type="hidden" name="requestfingerprint" value="1ac419491b47d8f9413736ce69b79af57f0bf9ee10dd2d0253c3e75ac6da2d4b0c185ae0e955804c0795237ffccadd35caa62a8843355d493ecef02310dc860d" />

      <input type="hidden" name="windowName" value="form" />

      <table border="1" bordercolor="lightgray" cellpadding="10" cellspacing="0">
        <tr>
          <td align="right"><b>Order description</b></td>
          <td>Jane Doe (33562)</td>
        </tr>
        <tr>
          <td align="right"><b>Amount</b></td>
          <td>99.99 USD</td>
        </tr>
        <tr>
          <td align="right"><b>Payment type</b></td>
          <td>
            <select name="paymenttype">
              <option value="SELECT">Select within Wirecard Payment Process</option>
              <option value="CCARD">Credit Card</option>
              <option value="MAESTRO">Maestro SecureCode</option>
              <option value="PBX">paybox</option>
              <option value="PSC">Paysafecard</option>
              <option value="EPS">eps Online Bank Transfer</option>
              <option value="ELV">Direct Debit</option>
              <option value="QUICK">@Quick</option>
              <option value="IDL">iDEAL</option>
              <option value="GIROPAY">giropay</option>
              <option value="PAYPAL">PayPal</option>
              <option value="SOFORTUEBERWEISUNG">sofortüberweisung</option>
              <option value="C2P">CLICK2PAY</option>
              <option value="BANCONTACT_MISTERCASH">Bancontact/MisterCash</option>
              <option value="INVOICE">Invoice</option>
              <option value="INSTALLMENT">Installment</option>
              <option value="PRZELEWY24">Przelewy24</option>
              <option value="MONETA">Moneta.ru</option>
              <option value="POLI">POLi</option>
              <option value="EKONTO">eKonto</option>
              <option value="INSTANTBANK">Instant Bank</option>
              <option value="MPASS">mpass</option>
              <option value="SKRILLDIRECT">Skrill Direct</option>
              <option value="SKRILLWALLET">Skrill Digital Wallet</option>
              <!-- <option value="CCARD-MOTO">Credit card: phone order or mail order</option>  -->
            </select>
          </td>
        </tr>
        <tr>
          <td colspan="2" align="right"><input type="submit" value="Checkout" /></td>
        </tr>
      </table>
</form>

<script src='https://assets.fortumo.com/fmp/fortumopay.js' type='text/javascript'></script>
<a id="fmp-button" href="#" rel="0838e46c5a36d3efb733c5a3e2c96f89"><img src="https://assets.fortumo.com/fmp/fortumopay_150x50_red.png" width="150" height="50" alt="Mobile Payments by Fortumo" border="0" /></a>
<br /><center> If you have questions, please contact<a href="/nachrichten.php?t=1&id=6"> Administrator</a></center>
<br><center>Gold is credited to your account immediately after payment. </center>
<br><br /><br /><center>Balance of gold from the previous round you can put through <a  href="/plus.php?id=6">Bank</a></center><br>