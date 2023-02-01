<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notifications_status}}`.
 */
class m230130_155051_create_notifications_status_table extends Migration
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

        $this->createTable('{{%notifications_status}}', [
            'id'              => $this->primaryKey(),
            'user_id'         => $this->integer(),
            'notification_id' => $this->integer(),
            'seen_at'         => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_notifications_status_user_id', 'notifications_status', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_notifications_status_notification_id', 'notifications_status', 'notification_id', 'notifications', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_notifications_status_user_id', 'notifications_status');
        $this->dropForeignKey('fk_notifications_status_notification_id', 'notifications_status');
        $this->dropTable('{{%notifications_status}}');
    }
}
