<?php
class mail_class {
    var $mail_from = 'no-reply@aspidanetwork.com';
    var $mail_to;
    var $subject;
    var $msg;
    var $mail_subject;

    function set_mail_vars($to, $subject){
        $this->mail_to = $to;
        $this->mail_subject = $subject;
    }

    function send(){
        // Escape all quotes, else the eval will fail.
        $this->msg = str_replace("'", "\'", $this->msg);
        $this->msg = preg_replace('#\{([a-z0-9\-_]*?)\}#is', "' . $\\1 . '", $this->msg);

        eval("\$this->msg = '$this->msg';");
        $headers = "";
        $headers .= 'From: Aspida Team <' . $this->mail_from . '>' . "\r\n";
        $headers .= 'Reply-To: No Reply <' . $this->mail_from . '>' . "\r\n";
        $headers .= 'Return-Path: <' . $this->mail_from . '>' . "\r\n";
        
        // Generate a unique Message-ID header
        $message_id = "<" . uniqid() . "@" . $_SERVER['SERVER_NAME'] . ">";
        $headers .= "Message-ID: " . $message_id . "\r\n";
        
        $headers .= "X-Mailer: PHP v" . phpversion() . "\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";  // Add this line
		$result = @mail($this->mail_to, $this->mail_subject, $this->msg, $headers);
        
        if (!$result) {
            die('Unable to send mail');
        }

        return true;
    }
}
?>
