<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%support_conversations}}`.
 */
class m230131_191821_create_support_conversations_table extends Migration
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

        $this->createTable('{{%support_conversations}}', [
            'id'           => $this->primaryKey(),
            'support_id'   => $this->integer(),
            'supporter_id' => $this->integer(),
            'sender_id'    => $this->integer(),
            'attach'       => $this->string()->null(),
            'message'      => $this->text(),
            'created_at'   => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_support_conversations_support_id', 'support_conversations', 'support_id', 'supports', 'id', 'CASCADE');
        $this->addForeignKey('fk_support_conversations_supporter_id', 'support_conversations', 'supporter_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_support_conversations_sender_id', 'support_conversations', 'sender_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_support_conversations_support_id', 'support_conversations');
        $this->dropForeignKey('fk_support_conversations_supporter_id', 'support_conversations');
        $this->dropForeignKey('fk_support_conversations_sender_id', 'support_conversations');
        $this->dropTable('{{%support_conversations}}');
    }
}
