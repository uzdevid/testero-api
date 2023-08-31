<?php

namespace app\traits;

use yii\filters\Cors;

trait CorsTrait {
    public static array $cors = [
        'class' => Cors::class,
        'cors' => [
            'Origin' => [
                "http://localhost:3000",
                "https://app.linky.uz"
            ],
            'Access-Control-Request-Headers' => ['*', 'Access-Token', 'Refresh-Token'],
            'Access-Control-Allow-Credentials' => true,
        ]
    ];
}