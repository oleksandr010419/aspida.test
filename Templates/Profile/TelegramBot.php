<?php
class TelegramBot {
    private $botToken;
    private $chatId;

    public function __construct($botToken, $chatId) {
        $this->botToken = $botToken;
        $this->chatId = $chatId;
    }

    public function sendMessage($messageText) {
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
}
?>
 