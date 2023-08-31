<?php

namespace app\modules\v1\forms;

use app\exceptions\UnprocessableEntityHttpException;
use app\models\User;
use app\models\Verify;
use yii\base\Model;

class VerifyForm extends Model {
    public string|null $id = null;
    public string|null $code = null;

    public function formName(): string {
        return 'Verify';
    }

    public function rules(): array {
        return [
            [['id', 'code'], 'required'],
            ['id', 'exist', 'targetClass' => Verify::class],
            ['code', 'checkCode']
        ];
    }

    public function checkCode(): void {
        $verify = Verify::findOne($this->id);

        if (!password_verify($this->code, $verify->hash_code)) {
            $this->addError('code', 'Incorrect confirmation code');
        }
    }

    /**
     * @throws UnprocessableEntityHttpException
     */
    public function accept(): User {
        $verify = Verify::findOne($this->id);

        return ProfileRedactForm::updateAttributes($verify->attributes);
    }
}