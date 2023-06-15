<?php

use yii\db\Exception;
use yii\db\Migration;

/**
 * Class m230615_111436_restore_data
 */
class m230615_111436_restore_data extends Migration
{
    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function safeUp()
    {
        ini_set('memory_limit', '1000M');

        $sql = file_get_contents(__DIR__ . '/data/test_db_data.sql');

        Yii::$app->getDb()->createCommand('SET foreign_key_checks = 0; ' . $sql . 'SET foreign_key_checks = 1;')->execute();
    }
}
