<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'jdfsmgkljsdfpkgf',
            'baseUrl' => '',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                'multipart/form-data' => 'yii\web\MultipartFormDataParser'
            ]
        ],
        'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8',
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                if ($response->statusCode == 404) {
                    $response->data = [
                        'message' => "not-found",
                    ];
                }
                if ($response->statusCode == 401) {
                    Yii::$app->response->statusCode = 403;
                    // $response->data = [
                    //     'message' => "login failed",
                    // ];
                }
                if ($response->statusCode == 403) {
                    $response->data = [
                        'message' => "forbidden for you",
                    ];
                }
            },
            'formatters' => [
                \yii\web\Response::FORMAT_JSON => [
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG, // use "pretty" output in debug mode
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                    // ...
                ],
            ],
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
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
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

        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                "GET login" => 'site/login',
                
                ['class' => 'yii\rest\UrlRule', 'controller' => 'user'],

                "POST school-api/registr" => 'user/register',
                "OPTIONS registr" => 'user/options',

                "POST school-api/auth" => 'user/login',
                "OPTIONS auth" => 'user/options',

                "GET school-api/courses" => 'site/courses',
                "OPTIONS courses" => 'site/options',

                "GET school-api/courses/<course_id>" => 'site/get-video',
                "OPTIONS courses/<course_id>" => 'site/options',

                "POST school-api/courses/<course_id>/buy" => 'site/buy-courses',
                "OPTIONS courses/<course_id>/buy" => 'site/options',

                "GET school-api/order/<id>" => 'site/cancel',
                "OPTIONS order/<id>" => 'site/options',

                "GET school-api/orders" => 'site/get-user-courses',
                "OPTIONS orders" => 'site/options',

                "POST school-api/payment-webhook" => 'site/payment-webhook',
                "OPTIONS school-api/payment-webhook" => 'site/payment-webhook',
            ],
        ]

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];
}

return $config;
