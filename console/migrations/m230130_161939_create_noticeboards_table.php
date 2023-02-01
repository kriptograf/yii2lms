<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%noticeboards}}`.
 */
class m230130_161939_create_noticeboards_table extends Migration
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

        $this->createTable('{{%noticeboards}}', [
            'id'         => $this->primaryKey(),
            'organ_id'   => $this->integer(),
            'user_id'    => $this->integer(),
            'type'       => $this->string(), // -- 'all', 'organizations', 'students', 'instructors', 'students_and_instructors'
            'sender'     => $this->string(),
            'title'      => $this->string(),
            'message'    => $this->text(),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_noticeboards_organ_id', 'noticeboards', 'organ_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_noticeboards_user_id', 'noticeboards', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_noticeboards_organ_id', 'noticeboards');
        $this->dropForeignKey('fk_noticeboards_user_id', 'noticeboards');
        $this->dropTable('{{%noticeboards}}');
    }
}
