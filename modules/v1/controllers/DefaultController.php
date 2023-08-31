<?php

namespace app\modules\v1\controllers;

use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;
use yii\filters\VerbFilter;
use yii\rest\Controller;

class DefaultController extends Controller {
    public function behaviors(): array {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => Cors::class
        ];

        $behaviors['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'index' => ['GET'],
            ],
        ];

        $behaviors['bearerAuth'] = [
            'class' => HttpBearerAuth::class,
        ];

        return $behaviors;
    }

    public function actionIndex(): array {
        return [
            'success' => true,
            'body' => [
                'versions' => [
                    'v1' => [
                        'is_supported' => true,
                    ],
                ]
            ]
        ];
    }
}
