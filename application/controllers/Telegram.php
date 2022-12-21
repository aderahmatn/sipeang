<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Telegram extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {

        $TOKEN = "5876987158:AAEMq3QfjstyZK1a38T5h0TgTHNeDBTV1fE";
        $apiURL = "https://api.telegram.org/bot$TOKEN";
        $update = json_decode(file_get_contents($apiURL . '/getUpdates'), TRUE);
        $data = array('detail' => $update,);
        $chatID = $data['detail']['result'][0]['message']['chat']['id'];
        $message = $data['detail']['result'][0]['message']['text'];
        if (strpos($message, "/start") === 0) {
            file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=Haloo, test webhooks sipeang.&parse_mode=HTML");
        }
        // // var_dump($data['detail']['result'][0]['message']['text']);
    }
}

/* End of file Telegram.php */
