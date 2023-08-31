<?php

namespace app\bootstraps;

use yii\base\BootstrapInterface;
use yii\web\Response;

class ResponseFormat implements BootstrapInterface {
    public function bootstrap($app): void {
        $app->response->on('beforeSend', function ($event) {
            $response = $event->sender;

            if ($response->format !== Response::FORMAT_JSON) {
                return;
            }

            if (!isset($response->data['success'])) {
                $response->data = [
                    'success' => $response->isSuccessful,
                    'body' => $response->data,
                ];
            }
        });
    }
}