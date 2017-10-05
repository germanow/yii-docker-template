<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=mysql;dbname=yii2advanced',
            'username' => 'root',
            'password' => 'pO9yk/c#1$:x>g,j~2SbaIQ5fcPSE`G`',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'postfix',
                'username' => 'root',
                'password' => 'NIXp8Eaw33ZL7k5o',
                'port' => '587',
                'encryption' => 'tls',
                'streamOptions' => [ //Для самоподписанных сертификатов
                    'ssl' => [
                        'allow_self_signed' => true,
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ],
                ],
            ]
        ],
    ],
];
