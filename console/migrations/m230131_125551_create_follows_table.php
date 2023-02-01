<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%follows}}`.
 */
class m230131_125551_create_follows_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%follows}}', [
            'id'       => $this->primaryKey(),
            'follower' => $this->integer(),
            'user_id'  => $this->integer(),
            'status'   => $this->string(), // -- 'requested', 'accepted', 'rejected'
        ], $tableOptions);

        $this->addForeignKey('fk_follows_follower', 'follows', 'follower', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_follows_user_id', 'follows', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_follows_follower', 'follows');
        $this->dropForeignKey('fk_follows_user_id', 'follows');
        $this->dropTable('{{%follows}}');
    }
}
