<?php

use yii\db\Migration;

/**
 * Class m200727_170827_create_users_phones
 */
class m200727_170827_create_users_phones extends Migration
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
        echo "m200727_170827_create_users_phones cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200727_170827_create_users_phones cannot be reverted.\n";

        return false;
    }
    */
}
