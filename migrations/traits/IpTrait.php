<?php

namespace app\migrations\traits;

use yii\base\NotSupportedException;
use yii\db\ColumnSchemaBuilder;
use yii\db\Connection;

trait IpTrait {
    /**
     * @return Connection the database connection to be used for schema building.
     */
    abstract protected function getDb();

    /**
     * Creates an ip column.
     * @return ColumnSchemaBuilder the column instance which can be further customized.
     * @throws NotSupportedException
     */
    public function inet(): ColumnSchemaBuilder {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder('inet');
    }
}