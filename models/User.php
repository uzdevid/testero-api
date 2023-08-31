<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $phone
 * @property string $email
 * @property string $f_name
 * @property string $l_name
 * @property bool $is_mfa_enabled
 * @property bool $is_notification_enabled
 * @property string $token
 *
 * @property Verify[] $verifies
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'phone', 'email', 'f_name', 'l_name', 'token'], 'required'],
            [['id'], 'string'],
            [['is_mfa_enabled', 'is_notification_enabled'], 'boolean'],
            [['phone'], 'string', 'max' => 9],
            [['email', 'f_name', 'l_name', 'token'], 'string', 'max' => 255],
            [['token'], 'unique'],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Phone',
            'email' => 'Email',
            'f_name' => 'F Name',
            'l_name' => 'L Name',
            'is_mfa_enabled' => 'Is Mfa Enabled',
            'is_notification_enabled' => 'Is Notification Enabled',
            'token' => 'Token',
        ];
    }

    /**
     * Gets query for [[Verifies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVerifies()
    {
        return $this->hasMany(Verify::class, ['user_id' => 'id']);
    }
}
