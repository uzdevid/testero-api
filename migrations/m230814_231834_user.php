<?php

use app\migrations\traits\UuidTypeTrait;
use Ramsey\Uuid\Uuid;
use yii\base\NotSupportedException;
use yii\db\Migration;

/**
 * Class m230814_231834_user
 */
class m230814_231834_user extends Migration {
    use UuidTypeTrait;

    public static string $tableName = '{{%user}}';

    /**
     * {@inheritdoc}
     * @throws NotSupportedException
     * @throws \yii\base\Exception
     */
    public function safeUp(): void {
        $this->createTable(self::$tableName, [
            'id' => $this->uuid()->notNull(),

            'phone' => $this->char(9)->notNull(),
            'email' => $this->string(255)->notNull(),

            'f_name' => $this->string(255)->notNull(),
            'l_name' => $this->string(255)->notNull(),

            'is_mfa_enabled' => $this->boolean()->notNull()->defaultValue(false),
            'is_notification_enabled' => $this->boolean()->notNull()->defaultValue(false),

            'token' => $this->string(255)->notNull()->unique() // В реальных проектах токен сохраняю в отдельную таблицу Device, это будет активные сеансы пользователя.
        ]);

        $this->addPrimaryKey('pk_user_id', self::$tableName, 'id');

        $this->insert(self::$tableName, [
            'id' => Uuid::uuid4()->toString(),

            'phone' => '993261330',
            'email' => 'uzdevid@gmail.com',

            'f_name' => 'Diyorbek',
            'l_name' => 'Ibragimov',

            'is_mfa_enabled' => true,
            'is_notification_enabled' => true,

            'token' => Yii::$app->security->generateRandomString(255)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable(self::$tableName);
        return true;
    }
}
