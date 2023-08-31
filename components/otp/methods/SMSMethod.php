<?php

namespace app\components\otp\methods;

use app\components\otp\OTPMethodInterface;
use Yii;

class SMSMethod implements OTPMethodInterface {

    public function send(string $to, int $code): bool {
        Yii::$app->response->headers->set('X-OTP', $code);

        return true;
    }
}