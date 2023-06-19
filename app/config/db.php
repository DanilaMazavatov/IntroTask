<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => env('DB_DRIVER', 'mysql') . ':host=' . env('MYSQL_HOST', 'db') .
        ';port=3306;dbname=' . env('MYSQL_DATABASE', 'test_db'),
    'username' => env('MYSQL_USERNAME', 'root'),
    'password' => env('MYSQL_PASSWORD', 'root'),
    'charset' => env('MYSQL_CHARSET', 'utf8'),
];
