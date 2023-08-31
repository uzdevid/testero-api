<?php

namespace app\components\otp;

use app\components\otp\methods\EmailMethod;
use app\components\otp\methods\SMSMethod;
use yii\base\Component;
use yii\base\NotSupportedException;

class OTPService extends Component {
    /**
     * @throws NotSupportedException
     */
    public function build(string $verifyMethod): OTPMethodInterface {
        return match ($verifyMethod) {
            'sms' => new SMSMethod(),
            'email' => new EmailMethod(),
            default => throw new NotSupportedException("Verify method '{$verifyMethod}' not supported")
        };
    }
}