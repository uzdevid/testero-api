<?php

namespace app\exceptions;

use Throwable;
use yii\web\HttpException;

class AlreadyExistsException extends HttpException {
    public function __construct(string $message = "", int $code = 409, Throwable|null $previous = null) {
        parent::__construct(409, $message, $code, $previous);
    }
}