<?php

namespace app\models;

use yii\web\IdentityInterface;

class IdentityClass extends User implements IdentityInterface {
    public static function findIdentity($id): IdentityClass|IdentityInterface|null {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null): User|IdentityInterface|null {
        return static::findOne(['token' => $token]);
    }

    public function getId(): int|string {
        return $this->id;
    }

    public function getAuthKey() {
        return null;
    }

    public function validateAuthKey($authKey): bool {
        return false;
    }
}