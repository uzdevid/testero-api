<?php

use app\migrations\traits\TimeTrait;
use app\migrations\traits\UuidTypeTrait;
use yii\db\Migration;

/**
 * Class m230831_072908_verify
 */
class m230831_072908_verify extends Migration {
    use UuidTypeTrait;
    use TimeTrait;

    public static string $tableName = '{{%verify}}';

    /**
     * {@inheritdoc}
     * @throws \yii\base\Exception
     */
    public function safeUp(): void {
        $this->createTable(self::$tableName, [
            'id' => $this->uuid()->notNull(),
            'user_id' => $this->uuid()->notNull(),
            'attributes' => $this->json()->notNull(),
            'confirm_method' => $this->string(32),
            'hash_code' => $this->string(255),
            'send_time' => $this->integerTime()
        ]);

        $this->addPrimaryKey('pk_verify_id', self::$tableName, 'id');
        $this->addForeignKey('pk_verify_user_id', self::$tableName, 'user_id', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable(self::$tableName);
        return true;
    }
}
