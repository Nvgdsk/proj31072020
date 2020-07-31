<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users_phones}}`.
 */
class m200727_154748_create_users_phones_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users_phones}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'phone' => $this->string(20)
        ]);
        $this->createIndex(
            'idx-users_phones-user_id',
            'users_phones',
            'user_id');
        $this->addForeignKey(
            'fk-users_phones-users_id',
            'users_phones',
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
        $this->dropTable('{{%users_phones}}');
    }
}
