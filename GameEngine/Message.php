<?php
class Message {
    public $unread, $nunread = false;

    public $inbox, $inbox1, $sent, $sent1, $reading, $reply, $noticearray, $notice = array();
    private $totalMessage;

    private $telegramBot;

    function __construct() {
        $this->getMessages();

        if (isset($_SESSION['reply'])) {
            $this->reply = $_SESSION['reply'];
            unset($_SESSION['reply']);
        }

        $botToken = "6808575447:AAF80Qdv7T9ncTGfOYHS-0Y_GTgjhwrRMRo";
        $chatId = "446162024";
        $speed = defined('SPEED') ? SPEED : null; // Retrieve SPEED from config.php 
		$this->telegramBot = new TelegramBot($botToken, $chatId, $speed);
    }

    public function procMessage($post) {
        global $database, $generator, $session;
        if (isset($post['ft'])) {
            $post['id'] = $database->filterintvalue($post['id']);
            switch ($post['ft']) {
                case "m1":
                    $this->quoteMessage($post['id']);
                    break;
                case "m2":
                    if (isset($_SESSION['username'])) {
                        if ($post['key'] == $_SESSION['mescheck']) {
                            $this->error = false;

                            if ($this->error === false) {
                                if ($post['an'] == "[ally]") {
                                    $this->sendAMessage($post['be'], $database->RemoveXSS($post['message']));
                                } else {
                                    $this->sendMessage($post['an'], $post['be'], $database->RemoveXSS($post['message']));
                                }
                                $_SESSION['mescheck'] = $generator->generateRandStr(3);
                                header("Location: nachrichten.php?t=2");
                                exit();
                            }
                        }
                    }
                    break;
                case "m3":
                case "m4":
                case "m5":
                    if (isset($post['delmsg_x']) && $session->right['s6']) {
                        $this->removeMessage($post);
                    }
                    break;
            }
        }
    }

    public function quoteMessage($id) {
        foreach ($this->inbox as $message) {
            if ($message['id'] == $id) {
                $message = preg_replace('/\[message\]/', '', $message);
                $message = preg_replace('/\[\/message\]/', '', $message);
                $this->reply = $_SESSION['reply'] = $message;
                header("Location: nachrichten.php?t=1&id=" . $message['owner']);
                exit();
            }
        }
    }

    public function loadMessage($id) {
        global $database;
        if ($this->findInbox($id)) {
            foreach ($this->inbox as $message) {
                if ($message['id'] == $id) {
                    $this->reading = $message;
                }
            }
        }
        if ($this->findSent($id)) {
            foreach ($this->sent as $message) {
                if ($message['id'] == $id) {
                    $this->reading = $message;
                }
            }
        }

        if ($this->reading['viewed'] == 0) {
            $database->getMessage($id, 4, $_SESSION['id_user']);
        }
    }

    private function removeMessage($post) {
        global $database;
        for ($i = 1; $i <= 10; $i++) {
            if (isset($post['n' . $i])) {
                $post['n' . $i] = $database->filterintvalue($post['n' . $i]);
                $p = array('n' => $post['n' . $i]);
                $message1 = $database->query("SELECT * FROM mdata where id = :n", $p);
                $message = $message1[0];
                if ($message['target'] == $_SESSION['id_user'] && $message['owner'] == $_SESSION['id_user']) {
                    $database->getMessage($post['n' . $i], 8);
                } else if ($message['target'] == $_SESSION['id_user']) {
                    $database->getMessage($post['n' . $i], 5);
                } else if ($message['owner'] == $_SESSION['id_user']) {
                    $database->getMessage($post['n' . $i], 7);
                }
            }
        }
        header("Location: nachrichten.php");
    }

    private function getMessages() {
        global $database;
        $this->inbox = $database->getMessage($_SESSION['id_user'], 1);
        $this->sent = $database->getMessage($_SESSION['id_user'], 2);
        $this->inbox1 = $database->getMessage($_SESSION['id_user'], 9);
        $this->sent1 = $database->getMessage($_SESSION['id_user'], 10);
        $this->totalMessagesLast24h = $database->getMessagesSentToday($_SESSION['id_user']);
        if ($_SESSION['id_user'] == 6) {
            $this->totalMessagesLast24h = 0;
        }
        $this->totalMessage = count($this->inbox) + count($this->sent);
    }

    private function sendAMessage($topic, $text) {
        global $database;
        $alli = $_SESSION['alliance_user'];
        $uid = $_SESSION['id_user'];
        $allmembersQ = $database->query("SELECT id FROM users WHERE alliance='" . $alli . "'");
        $userally = $alli;
        $perm0 = $database->query("SELECT opt7 FROM ali_permission WHERE uid='" . $uid . "'");
        $permission = $perm0[0];

        if ($topic == "") {
            $topic = "No subject";
        }
        if (!preg_match('/\[message\]/', $text) && !preg_match('/\[\/message\]/', $text)) {
            $text = "[message]" . $text . "[/message]";
            $alliance = $player = $coor = 0;

            if ($permission['opt7'] == 1) {
                if ($userally != 0) {
                    foreach ($allmembersQ as $allmembers) {
                        $database->sendMessage($allmembers['id'], $_SESSION['id_user'], $topic, $text, 0, $alliance, $player, $coor);
                    }
                }
            }
        }
    }

    private function sendMessage($receive, $topic, $text) {
        global $database;
        if (!empty($receive)) {
            $user = $database->getUserField($receive, "id", 1);
            $senderUid = $_SESSION['id_user'];
            $speed = $this->telegramBot->getSpeed(); // Get the SPEED value from TelegramBot
            
            if ($user > 0) {
                if ($topic == "") {
                    $topic = "no subject";
                }

                // Check if the target is '6'
                if ($user == 6) {
                    // Send to Telegram only if the target is '6'
                    $this->telegramBot->sendMessage("New message received from user " . $senderUid . " in server x(" . $speed . "): " . $text);
                }
                
                // Include the restricted words from the PHP file
                $restrictedWords = include('/var/www/html/scripts/forbidden/forbidden_words.php');

                $normalizedText = str_replace(" ", "", $text);  // Remove all spaces

                foreach ($restrictedWords as $word) {
                    $word = trim($word);  // Trim any whitespace
                    $word = str_replace(" ", "", $word);  // Remove spaces from the restricted word

                    if (stripos($normalizedText, $word) !== false) {
                        header("Location: ".$_SERVER['PHP_SELF']);
                        exit;
                    }
                }

                require_once(__DIR__ . "/Lib/ProfanityFilter/Blocker.php");
                $message_check = new Blocker($text, "*****");
                if (!$message_check->clean()) {
                    $infa = "message:" . $text . ",target:" . $user;
                    $database->addPalevo($senderUid, $infa, 76);
                }
                if (preg_match('/(http|https|ftp|ftps)\:\/\/(www\.)?[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/', $text)) {
                    $infa = "message:" . $text . ",target:" . $user;
                    if (stripos($text, "aspidanetwork.com/berichte") === false && stripos($text, "Reply:") === false) {
                        $database->addPalevo($senderUid, $infa, 77);
                    }
                }

                // Rest of your sendMessage logic...

                $text = "[message]" . $text . "[/message]";
                $alliance = $player = $coor = 0;
                $database->sendMessage($user, $senderUid, $topic, $text, 0, $alliance, $player, $coor);
            }
        }
    }

    private function findInbox($id) {
        foreach ($this->inbox as $message) {
            if ($message['id'] == $id) {
                return true;
            }
        }
        return false;
    }

    private function findSent($id) {
        foreach ($this->sent as $message) {
            if ($message['id'] == $id) {
                return true;
            }
        }
        return false;
    }
}

class TelegramBot {
    private $botToken;
    private $chatId;
    private $speed;

    public function __construct($botToken, $chatId, $speed) {
        $this->botToken = $botToken;
        $this->chatId = $chatId;
        $this->speed = $speed; // Store the SPEED value
    }

    public function sendMessage($messageText) {
        // Include the SPEED value in the message
        //$messageText = "New message received from user " . $this->chatId . " in server x(" . $this->speed . "): " . $messageText;

        $url = "https://api.telegram.org/bot{$this->botToken}/sendMessage";
        $data = [
            'chat_id' => $this->chatId,
            'text' => $messageText,
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ],
        ];

        $context = stream_context_create($options);
        $result = @file_get_contents($url, false, $context);

        if ($result === false) {
            error_log("Telegram Bot Error: Unable to send message");
        }
    }

    public function getSpeed() {
        return $this->speed;
    }
}

$message = new Message;
?>
