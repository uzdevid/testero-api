<?php

namespace app\modules\v1\controllers;

use app\exceptions\UnprocessableEntityHttpException;
use app\modules\v1\forms\ProfileRedactForm;
use app\modules\v1\forms\VerifyForm;
use app\traits\CorsTrait;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\VerbFilter;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;

class ProfileController extends Controller {
    use CorsTrait;

    public function behaviors(): array {
        $behaviors = parent::behaviors();
        $behaviors['Cors'] = self::$cors;

        $behaviors['HttpBearerAuth'] = [
            'class' => HttpBearerAuth::class,
        ];

        $behaviors['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'redact' => ['POST']
            ],
        ];

        return $behaviors;
    }

    /**
     * @throws UnprocessableEntityHttpException
     * @throws BadRequestHttpException
     */
    public function actionRedact(): array {
        $body = Yii::$app->request->post();

        if (empty($body['verify_method'])) {
            throw new BadRequestHttpException('Verify method not set');
        }

        if (!in_array($body['verify_method'], ['sms', 'email'])) {
            throw new BadRequestHttpException('Unknown verify method');
        }

        $redactForm = new ProfileRedactForm();

        $redactForm->load($body);

        if (!$redactForm->validate()) {
            throw new UnprocessableEntityHttpException('Validation error', $redactForm->firstErrors);
        }

        $user = Yii::$app->user->identity;

        $response = [];

        if ($user->is_mfa_enabled) {
            $verify = $redactForm->saveAndSendOTP($body['verify_method']);

            $response['Verify']['required'] = true;
            $response['Verify']['id'] = $verify->id;
        } else {
            $user = $redactForm->save();

            $response['Verify']['required'] = false;

            $response['User'] = [
                'id' => $user->id,
                'f_name' => $user->f_name,
                'l_name' => $user->l_name,
                'is_mfa_enabled' => $user->is_mfa_enabled,
                'is_notification_enabled' => $user->is_notification_enabled
            ];
        }

        return $response;
    }

    /**
     * @throws UnprocessableEntityHttpException
     */
    public function actionVerify(): array {
        $verifyForm = new VerifyForm();

        $verifyForm->load(Yii::$app->request->post());

        if (!$verifyForm->validate()) {
            throw new UnprocessableEntityHttpException('Validation error', $verifyForm->firstErrors);
        }

        $verifyForm->accept();

        $user = Yii::$app->user->identity;

        return [
            'User' => [
                'id' => $user->id,
                'f_name' => $user->f_name,
                'l_name' => $user->l_name,
                'is_mfa_enabled' => $user->is_mfa_enabled,
                'is_notification_enabled' => $user->is_notification_enabled
            ]
        ];
    }
}
