<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%text_lessons_attachments}}`.
 */
class m230201_124713_create_text_lessons_attachments_table extends Migration
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

        $this->createTable('{{%text_lessons_attachments}}', [
            'id'             => $this->primaryKey(),
            'text_lesson_id' => $this->integer(),
            'file_id'        => $this->integer(),
            'created_at'     => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'     => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_text_lessons_attachments_text_lesson_id', 'text_lessons_attachments', 'text_lesson_id', 'text_lessons', 'id', 'CASCADE');
        $this->addForeignKey('fk_text_lessons_attachments_file_id', 'text_lessons_attachments', 'file_id', 'files', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_text_lessons_attachments_text_lesson_id', 'text_lessons_attachments');
        $this->dropForeignKey('fk_text_lessons_attachments_file_id', 'text_lessons_attachments');
        $this->dropTable('{{%text_lessons_attachments}}');
    }
}
