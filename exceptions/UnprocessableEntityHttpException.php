<?php

namespace app\exceptions;

use Exception;

class UnprocessableEntityHttpException extends \yii\web\UnprocessableEntityHttpException {
    public array $errors;

    public function __construct($message = null, $errors = [], $code = 0, Exception $previous = null) {
        $this->errors = $errors;
        parent::__construct($message, $code, $previous);
    }
}