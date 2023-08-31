<?php

use app\components\OTPService;
use app\models\IdentityClass;
use yii\console\Application;
use yii\db\Connection;
use yii\web\User;

class Yii {
    public static Application|__Application|\yii\web\Application $app;
}

/**
 * @property yii\rbac\DbManager $authManager
 * @property User|__WebUser $user
 * @property Connection $agroCoreFull
 * @property OTPService $otp
 *
 */
class __Application { }

/**
 * @property IdentityClass $identity
 */
class __WebUser { }