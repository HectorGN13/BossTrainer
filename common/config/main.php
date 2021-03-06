<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
    ],
    'components' => [
        'i18n' => [
            'translations' => [
                'cookie-consent' => [
                    'class'          => \yii\i18n\PhpMessageSource::class,
                    'basePath'       => '@app/messages',
                    'sourceLanguage' => 'es',
                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                '<controller:[\w-]+>/<id:\d+>' => '<controller>/view',
            ],
        ],
        'reCaptcha3' => [
            'class'      => 'kekaadrenalin\recaptcha3\ReCaptcha',
            'site_key'   => '6LdazuUZAAAAAMP17Ct88BJ11nJSAV-jUrW9Mpjh',
            'secret_key' => '6LdazuUZAAAAAEoMt3WVZmTtZ_F67mH__j4_T9Zy',
        ],
        'awssdk' => [
            'class' => 'fedemotta\awssdk\AwsSdk',
            'credentials' => [
                'key' => getenv('AWS_ACCESS_KEY_ID'),
                'secret' => getenv('AWS_SECRET_ACCESS_KEY'),

            ],
            'region' => 'eu-central-1',
            'version' => 'latest',
        ],
        'cookieConsentHelper' => [
            'class' => dmstr\cookieconsent\components\CookieConsentHelper::class
        ]
    ],

];
