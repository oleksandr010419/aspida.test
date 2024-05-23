<?php
include("Mail/Mail.php");

class Mailer extends mail_class {
    
    // This method sends a gold reward email (assuming, as it was empty in the provided code)
    function sendGold($email, $code) {
        // Implementation needed.
    }

    // This method sends an activation email to a new user
    function sendActivate($email, $username, $pass, $act) {
    $subject = "Thank you for registering on " . SERVER_NAME . " speed, (round ".GAME_ROUND.")"; 
    $link = HOMEPAGE . "activate.php?code=" . $act;
    $unsubscribeLink = HOMEPAGE . "unsubscribe.php?email=" . urlencode($email);  
    $this->set_mail_vars($email, $subject);
    
    $this->msg = "
    <center>
		<img src='https://x10.aspidanetwork.com/Mail/background_01.jpg' alt='Welcome to " . SERVER_NAME . "' width='600' height='400'>
        <h2>Hello " . htmlspecialchars($username) . ",</h2><br>
        <p>Thank you for joining " . SERVER_NAME . "!</p><br>
        <p>To get started, please activate your account by clicking the button below:</p><br>
        <a href='" . htmlspecialchars($link) . "' target='_blank' style='background-color: orange; font-size: 22px; color: white; padding: 10px 20px; border: none; text-decoration: none; border-radius: 5px; display: inline-block;'><B>Activate Account</B></a><br><br>
        <p>If you did not create an account with us, no further action is required.</p><br>
        <p>Warm regards,</p>
        <p>The " . SERVER_NAME . " Team</p>
    </center>
    <p style='font-size: 12px; text-align: center;'>Please do not reply to this email directly. Replies sent to this address cannot be answered.<br>
    If you have any questions or concerns, you are invited to contact Support in the game.<br>
    You've received this message because you are registered at Aspida Private Servers with the email ".$email.".</p>
	<div style='text-align: center; padding: 20px;'>
    <a href='https://www.facebook.com/aspidanetwork' target='_blank' style='margin-right: 10px; text-decoration: none; display: inline-block;'>
        <img src='https://www.aspidanetwork.com/images/social/facebook.png' alt='Facebook' style='width: 30px; height: 30px; display: block; margin: 0 auto;'>
        <span style='display: block; font-size: 10px; color: blue;'>Facebook</span>
    </a>
    <a href='https://twitter.com/aspidagames' target='_blank' style='margin-right: 10px; text-decoration: none; display: inline-block;'>
        <img src='https://www.aspidanetwork.com/images/social/twitter.png' alt='Twitter' style='width: 30px; height: 30px; display: block; margin: 0 auto;'>
        <span style='display: block; font-size: 10px; color: blue;'>Twitter</span>
    </a>
    <a href='https://www.youtube.com/channel/UCb7wcPQMaLC-Z8H3uYvG94Q' target='_blank' style='margin-right: 10px; text-decoration: none; display: inline-block;'>
        <img src='https://www.aspidanetwork.com/images/social/youtube.png' alt='Youtube' style='width: 30px; height: 30px; display: block; margin: 0 auto;'>
        <span style='display: block; font-size: 10px; color: blue;'>Youtube</span>
    </a>
    <a href='https://www.linkedin.com/profile/guided?trk=uno-choose-ge-no-intent&dl=no' target='_blank' style='margin-right: 10px; text-decoration: none; display: inline-block;'>
        <img src='https://www.aspidanetwork.com/images/social/linkedin.png' alt='LinkedIn' style='width: 30px; height: 30px; display: block; margin: 0 auto;'>
        <span style='display: block; font-size: 10px; color: blue;'>LinkedIn</span>
    </a>
    <a href='https://www.instagram.com/p/CxO5RyqS6rm/?igshid=MzRlODBiNWFlZA==' target='_blank' style='margin-right: 10px; text-decoration: none; display: inline-block;'>
        <img src='https://www.aspidanetwork.com/images/social/instagram.png' alt='Instagram' style='width: 30px; height: 30px; display: block; margin: 0 auto;'>
        <span style='display: block; font-size: 10px; color: blue;'>Instagram</span>
    </a>
    <a href='https://api.whatsapp.com/send?phone=%2B61403334250&data=...' target='_blank' style='margin-right: 10px; text-decoration: none; display: inline-block;'>
        <img src='https://www.aspidanetwork.com/images/social/whatsapp.png' alt='WhatsApp' style='width: 30px; height: 30px; display: block; margin: 0 auto;'>
        <span style='display: block; font-size: 10px; color: blue;'>WhatsApp</span>
    </a>
    <a href='https://discord.gg/RR7nqxgF' target='_blank' style='margin-right: 10px; text-decoration: none; display: inline-block;'>
        <img src='https://www.aspidanetwork.com/images/social/discord.png' alt='Discord' style='width: 40px; height: 30px; display: block; margin: 0 auto;'>
        <span style='display: block; font-size: 10px; color: blue;'>Discord</span>
    </a>
    <a href='mailto:aspidagames@gmail.com' target='_blank' style='margin-right: 10px; text-decoration: none; display: inline-block;'>
        <img src='https://www.aspidanetwork.com/images/social/help.png' alt='Email' style='width: 40px; height: 30px; display: block; margin: 0 auto;'>
        <span style='display: block; font-size: 10px; color: blue;'>Email</span>
    </a>
</div>


    <p style='font-size: 12px; text-align: center;'>
        <a href='" . htmlspecialchars($unsubscribeLink) . "' target='_blank' style='color: grey;'>Unsubscribe</a>
    </p>

";

    
    $this->send();
}

    
    // Additional methods as needed...
}

$mailer = new Mailer;
// Usage examples might include:
// $mailer->sendActivate($email, $username, $password, $activationCode);
// $mailer->sendPassword($email, $username, $newPassword, $code);
