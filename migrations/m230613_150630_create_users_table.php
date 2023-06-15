<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m230613_150630_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey()->notNull(),
            'first_name' => $this->string(300)->notNull(),
            'last_name' => $this->string(300)->notNull(),
        ]);

//        $this->addForeignKey(
//            'fk_service_id',
//            'orders',
//            'service_id',
//            'services',
//            'id',
//            'CASCADE'
//        );
//
//        $this->addForeignKey(
//            'fk_user_id',
//            'orders',
//            'user_id',
//            'users',
//            'id',
//            'CASCADE'
//        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
