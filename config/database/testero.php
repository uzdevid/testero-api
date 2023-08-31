<?php

use yii\db\Connection;

return [
    'class' => Connection::class,
    'dsn' => "${_ENV['MAIN_DB_DSN']}:host=${_ENV['MAIN_DB_HOST']};port=${_ENV['MAIN_DB_PORT']};dbname=${_ENV['MAIN_DB_NAME']}",
    'username' => $_ENV['MAIN_DB_USER'],
    'password' => $_ENV['MAIN_DB_PASS'],
    'charset' => $_ENV['MAIN_DB_CHARSET'],

    'enableSchemaCache' => true,
    'schemaCacheDuration' => 60,
    'schemaCache' => 'cache',
];
