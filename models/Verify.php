<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "verify".
 *
 * @property string $id
 * @property string $user_id
 * @property array $attributes
 * @property string|null $confirm_method
 * @property string|null $hash_code
 * @property int|null $send_time
 *
 * @property User $user
 */
class Verify extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'verify';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'attributes'], 'required'],
            [['id', 'user_id'], 'string'],
            [['attributes'], 'safe'],
            [['send_time'], 'default', 'value' => null],
            [['send_time'], 'integer'],
            [['confirm_method'], 'string', 'max' => 32],
            [['hash_code'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'attributes' => 'Attributes',
            'confirm_method' => 'Confirm Method',
            'hash_code' => 'Hash Code',
            'send_time' => 'Send Time',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
