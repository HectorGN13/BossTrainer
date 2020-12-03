<?php

$host = 'ec2-54-247-107-109.eu-west-1.compute.amazonaws.com';
$port = '5432';
$dbname = 'd77jse7a3aa00i';
$username = 'mrdwwkjbslmuhh';
$password = '2a4a07c860f8bf19e0d1b921561a6cbc416acc4a2626f73dbfe8cc43c528e655';
$extra = [];
/*
$host = $username = $password = $dbname = '';

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
if (isset($url["host"]) && isset($url["user"]) && isset($url["pass"]) && isset($url["path"])) {
    $host = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $dbname = substr($url["path"], 1);
}*/

return [
    'components' => [
        'db' => [
                'class' => 'yii\db\Connection',
                'dsn' => "pgsql:host=$host;port=$port;dbname=$dbname",
                'username' => $username,
                'password' => $password,
                'charset' => 'utf8',
        ] + $extra,
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'bosstrainer.help@gmail.com',
                'password' => "Alba1234",
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
    ],
];
