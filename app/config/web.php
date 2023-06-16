<?php

use yii\symfonymailer\Mailer;

require __DIR__ . '/bootstrap.php';
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'language' => env('APP_LANGUAGE', 'ru'),
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'd_7QR664rCOPbLUHJztVLXc9lCeD2C82',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => Mailer::class,
            'viewPath' => '@app/mail',
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/modules/orders/messages',
                    'fileMap' => [
                        'app' => 'app.php',
                    ],
                ],
            ],
        ],
        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',
            'enableDefaultLanguageUrlCode' => false,
            'languages' => ['ru', 'en'],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => 'orders/orders/index',
                '/orders' => 'orders/orders/index',
                '/export' => 'orders/export/index',
            ],
        ],
    ],
    'params' => $params,
    'modules' => [
        'orders' => [
            'class' => 'app\modules\orders\OrdersModule',
            'layout' => 'main',
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['192.168.176.1'] // adjust this to your needs

    ];
}

return $config;
