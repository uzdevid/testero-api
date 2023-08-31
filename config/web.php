<?php

use app\bootstraps\ResponseFormat;
use app\modules\v1\V1Module;

$config = [
    'id' => 'linky-api',
    'name' => 'Linky',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        ResponseFormat::class
    ],
    'timeZone' => 'Asia/Tashkent',
    'language' => 'en',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'modules' => [
        'v1' => V1Module::class
    ],
    'components' => require __DIR__ . '/components/web.php',
    'params' => require __DIR__ . '/params/web.php',
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
