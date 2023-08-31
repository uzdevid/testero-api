<?php

use app\components\otp\OTPService;
use app\exceptions\ExceptionHandler;
use app\models\IdentityClass;
use yii\redis\Cache;
use yii\web\JsonParser;
use yii\web\Response;

return [
    'request' => [
        'cookieValidationKey' => 'lKrRZmbffJfzxSudkdhejixHEgngfTgITOtLmolx',
        'baseUrl' => '',
        'enableCsrfValidation' => false,
        'enableCsrfCookie' => false,
        'parsers' => [
            'application/json' => JsonParser::class,
        ],
    ],
    'response' => [
        'class' => Response::class,
    ],
    'errorHandler' => [
        'class' => ExceptionHandler::class
    ],
    'cache' => [
        'class' => Cache::class,
        'redis' => 'redis'
    ],
    'user' => [
        'identityClass' => IdentityClass::class,
        'enableAutoLogin' => true,
        'enableSession' => false,
        'loginUrl' => null
    ],
    'otp' => [
        'class' => OTPService::class
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
    'db' => require __DIR__ . '/../database/testero.php',
    'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules' => [],
    ],
];