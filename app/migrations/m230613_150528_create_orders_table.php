<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m230613_150528_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('orders', [
            'id' => $this->primaryKey()->notNull(),
            'user_id' => $this->bigInteger()->notNull(),
            'link' => $this->string(300)->notNull(),
            'quantity' => $this->integer()->notNull(),
            'service_id' => $this->bigInteger()->notNull(),
            'status' => $this->tinyInteger(1)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'mode' => $this->tinyInteger(1)->notNull(),
        ]);

        $this->addForeignKey(
            'fk_service_id',
            'orders',
            'service_id',
            'services',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_user_id',
            'orders',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%orders}}');
    }
}
