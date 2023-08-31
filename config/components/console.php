<?php

use yii\redis\Cache;

return [
    'cache' => [
        'class' => Cache::class,
        'redis' => 'redis'
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
];