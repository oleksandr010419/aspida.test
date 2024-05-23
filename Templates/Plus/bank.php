<?php
///include("Templates/Plus/pmenu.php");
include("banksystem.php");

if ($_GET['step'] == 1) {
    //$info = $banksystem->getInfo($_SESSION['email']); }
}

  $g = '<img src="img/x.gif" class="gold" alt="gold">';
?>
<?php       $mail_from_session = $session->email;
            $mail_from_session[0] = '*';
            $mail_from_session[1] = '*';
            $mail_from_session[2] = '*';
            $mail_from_session[3] = '*';
            $info = $banksystem->getGoldCount($_SESSION['email']);
            $gold = $info['gold'];
            if ($gold < 1) {
                $gold = "You don't have a sufficient amount of gold!";
            }
            
            
         ?>
        <center>Here you can redeem your gold from the past servers. You may also use the code on any servers of aspida network.<br /></center>
<br /><br /><br /><br />
<table width="100%" class="transparent">
	<tr>
		<th>Account name:</th>
		<td><?=$session->username?>
	</tr>
	<tr>
		<th>Email:</th>
		<td><?=$mail_from_session?>
	</tr>
</table>
<br />

            <?php
			require_once __DIR__.'/../../../scripts/bank_coupon/main.php';
			$bank = new Bank(SQL_SERVER, SQL_USER, SQL_PASS, SQL_DB, DEFAULT_GOLD, str_replace(' ', '_', SERVER_NAME), OPENING);
			switch($_GET['step']) {
                default: ?>
                    <form name="bank1" action="?id=6&step=1" method="post">
						<center>
							Aspida Key:<br/>
							<input placeholder="XXXXX-XXXXX-XXXXX-XXXXX" size="24" name="key"><br>
							<input type="submit" value="Redeem">
						</center>
                    </form>
					<?php 
					break;
				case 1:
					if (!$bank->checkForKey($_POST['key'])){
						header("Location: plus.php?id=6&step=fail");
						exit;
					} else {
						$keyData = $bank->getKeyData($_POST['key']);
						if($bank->checkExpiryDate($keyData['expiry_date'])){
							header("Location: plus.php?id=6&step=expired");
							exit;
						}
						echo "<center>This key is worth <b>".$keyData['gold']."</b> <img src='img/x.gif' class='gold'/></center><br/>";
						echo "Would you like to redeem it ?<br/>";
						echo "<form action='?id=6&step=2' method=POST><input type='hidden' value='".$_POST['key']."' name='key'><input type='submit' value='Redeem'></form>";
					}
					break;
				case 2:
					if (!$bank->checkForKey($_POST['key'])){
						header("Location: plus.php?id=6&step=fail");
						exit;
					} else {
						$keyData = $bank->getKeyData($_POST['key']);
						if($bank->checkExpiryDate($keyData['expiry_date'])){
							header("Location: plus.php?id=6&step=expired");
							exit;
						}
						//$bank->redeemKey($_POST['key'], $session->uid);
						global $database;
						$database->modifyGold( $session->uid ,$keyData['gold'] , 1,"Coupon[".$_POST['key']."] redeemed!");
						$bank->redeemKey($_POST['key'], $session->uid);
						echo "<center>This key has been redeemed. <br/><a href='?id=6'>Redeem another one</a></center>";
					}
					break;
				case 'expired':
					echo "<center>This key has been expired. <a href='?id=6'>Retry</a></center>";
					break;
				case 'fail':
					echo "<center>This key does not exist. <a href='?id=6'>Retry</a></center>";
					break;
            }
            ?>


            
             
             <img src="img/bsba.gif" width="100%">