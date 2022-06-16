<?php

namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;

class Mail {

    private $api_key = '8a80f46ddd430d352768e3ef5c936784';
    private $api_key_secret = '37855bccba6cd9bdf54d94bbe824e77d';

    public function send($to_email, $to_name, $subject, $content)
    {
        $mj = new Client($this->api_key, $this->api_key_secret, true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "damiensuper3359@gmail.com",
                        'Name' => "Damien"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]
                    ],
                    'TemplateID' => 4009705,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                     'Variables' => [
                            'content' => $content
                     ]
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && dd($response->getData());
    }
}