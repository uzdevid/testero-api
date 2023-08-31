<?php

namespace app\exceptions;

use Yii;
use yii\web\ErrorHandler;

class ExceptionHandler extends ErrorHandler {
    public function renderException($exception): void {
        $response = Yii::$app->response;
        $response->statusCode = $exception->statusCode;

        if ($exception instanceof UnprocessableEntityHttpException) {
            $response->data = [
                'message' => $exception->getMessage(),
                'errors' => $exception->errors
            ];
        } elseif (($exception instanceof yii\db\Exception) && YII_DEBUG === true) {
            $response->data = [
                'message' => 'Server error'
            ];
        } else {
            parent::renderException($exception);
            return;
        }

        $response->send();
    }
}