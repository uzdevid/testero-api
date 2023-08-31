<?php

namespace app\components\otp;

interface OTPMethodInterface {
    public function send(string $to, int $code): bool;
}