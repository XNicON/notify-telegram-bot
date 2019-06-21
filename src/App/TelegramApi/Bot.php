<?php

namespace App\TelegramApi;

use Curl\Curl;

class Bot {
    private $apiUrl = 'https://api.telegram.org/bot';
    private $token;

    function __construct($token)
    {
        $this->token = $token;
    }

    private function call($method, array $data)
    {
        $curl = new Curl();
        $curl->setUserAgent('TgBotNotify');
        $curl->setHeader('Content-Type', 'application/json');
        $curl->post($this->apiUrl.$this->token.'/'.$method, json_encode($data));
        $curl->close();

        if ($curl->getHttpStatusCode() == 200) {
            return $curl->getResponse();
        }

        return $curl->getHttpStatusCode();
    }

    public function sendMessage($chat_id, $text)
    {
        $data = [
            'chat_id' => $chat_id
        ];

        do {
            $data['text'] = mb_substr($text, 0, 4096);
            $response = $this->call('sendMessage', $data);
            $text = mb_substr($text, 4096);
        } while (mb_strlen($text, 'UTF-8') > 0);

        return $response;
    }
}