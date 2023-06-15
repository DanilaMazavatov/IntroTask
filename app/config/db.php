<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => env('DB_DRIVER') . ':host=' . env('MYSQL_HOST') . ';port=' . env('MYSQL_PORT') . ';dbname=' . env('MYSQL_DATABASE'),
    'username' => env('MYSQL_USERNAME'),
    'password' => env('MYSQL_PASSWORD'),
    'charset' => env('MYSQL_CHARSET'),
];
