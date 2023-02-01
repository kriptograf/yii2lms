<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%noticeboards_status}}`.
 */
class m230130_162536_create_noticeboards_status_table extends Migration
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

        $this->createTable('{{%noticeboards_status}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'noticeboard_id' => $this->integer(),
            'seen_at' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_noticeboards_status_user_id', 'noticeboards_status', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_noticeboards_status_noticeboard_id', 'noticeboards_status', 'noticeboard_id', 'noticeboards', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_noticeboards_status_user_id', 'noticeboards_status');
        $this->dropForeignKey('fk_noticeboards_status_noticeboard_id', 'noticeboards_status');
        $this->dropTable('{{%noticeboards_status}}');
    }
}
