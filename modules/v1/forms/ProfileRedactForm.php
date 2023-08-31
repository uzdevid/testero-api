<?php

namespace app\modules\v1\forms;

use app\exceptions\UnprocessableEntityHttpException;
use app\models\User;
use app\models\Verify;
use Ramsey\Uuid\Uuid;
use Yii;
use yii\base\Model;

class ProfileRedactForm extends Model {
    public string|null $f_name = null;
    public string|null $l_name = null;
    public bool|null $is_mfa_enabled = null;
    public bool|null $is_notification_enabled = null;

    public function formName(): string {
        return 'User';
    }

    public function rules(): array {
        return [
            [['f_name', 'l_name', 'is_mfa_enabled', 'is_notification_enabled'], 'required'],
            [['f_name', 'l_name'], 'string', 'max' => 255],
            [['is_mfa_enabled', 'is_notification_enabled'], 'boolean']
        ];
    }

    /**
     * @throws UnprocessableEntityHttpException
     */
    public function saveAndSendOTP(string $verifyMethod): Verify {
        $user = Yii::$app->user->identity;

        $code = rand(1000, 9999);

        $verify = new Verify();

        $verify->id = Uuid::uuid4()->toString();
        $verify->user_id = $user->id;
        $verify->attributes = $this->attributes;
        $verify->confirm_method = $verifyMethod;
        $verify->hash_code = password_hash($code, PASSWORD_DEFAULT);
        $verify->send_time = time();

        if (!$verify->save()) {
            throw new UnprocessableEntityHttpException("Verify save error", $verify->errors);
        }

        if ($verifyMethod == 'sms') {
            $to = $user->phone;
        } else {
            $to = $user->email;
        }

        Yii::$app->otp->build($verifyMethod)->send($to, $code);

        return $verify;
    }

    /**
     * @throws UnprocessableEntityHttpException
     */
    public function save(): User {
        return self::updateAttributes($this->attributes);
    }

    /**
     * @throws UnprocessableEntityHttpException
     */
    public static function updateAttributes(array $attributes): User {
        $user = Yii::$app->user->identity;

        $user->load($attributes, '');

        if (!$user->save()) {
            throw new UnprocessableEntityHttpException('User update error', $user->errors);
        }

        return $user;
    }
}