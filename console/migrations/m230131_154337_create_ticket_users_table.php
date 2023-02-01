<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ticket_users}}`.
 */
class m230131_154337_create_ticket_users_table extends Migration
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

        $this->createTable('{{%ticket_users}}', [
            'id'         => $this->primaryKey(),
            'ticket_id'  => $this->integer(),
            'user_id'    => $this->integer(),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_ticket_users_ticket_id', 'ticket_users', 'ticket_id', 'tickets', 'id', 'CASCADE');
        $this->addForeignKey('fk_ticket_users_user_id', 'ticket_users', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_ticket_users_ticket_id', 'ticket_users');
        $this->dropForeignKey('fk_ticket_users_user_id', 'ticket_users');
        $this->dropTable('{{%ticket_users}}');
    }
}
