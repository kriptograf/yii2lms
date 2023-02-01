<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notifications}}`.
 */
class m230130_153953_create_notifications_table extends Migration
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

        $this->createTable('{{%notifications}}', [
            'id'         => $this->primaryKey(),
            'user_id'    => $this->integer()->null(),
            'group_id'   => $this->integer()->null(),
            'title'      => $this->string(),
            'message'    => $this->text(),
            'sender'     => $this->string()->defaultValue('system'), // -- 'system', 'admin'
            'type'       => $this->string(), // -- 'single', 'all_users', 'students', 'instructors', 'organizations', 'group'
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_notifications_user_id', 'notifications', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_notifications_group_id', 'notifications', 'group_id', 'groups', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_notifications_user_id', 'notifications');
        $this->dropForeignKey('fk_notifications_group_id', 'notifications');
        $this->dropTable('{{%notifications}}');
    }
}
