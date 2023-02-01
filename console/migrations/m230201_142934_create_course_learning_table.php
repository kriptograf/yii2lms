<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%course_learning}}`.
 */
class m230201_142934_create_course_learning_table extends Migration
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

        $this->createTable('{{%course_learning}}', [
            'id'             => $this->primaryKey(),
            'user_id'        => $this->integer(),
            'text_lesson_id' => $this->integer(),
            'file_id'        => $this->integer(),
            'session_id'     => $this->integer(),
            'created_at'     => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'     => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_course_learning_user_id', 'course_learning', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_course_learning_text_lesson_id', 'course_learning', 'text_lesson_id', 'text_lessons', 'id', 'CASCADE');
        $this->addForeignKey('fk_course_learning_file_id', 'course_learning', 'file_id', 'files', 'id', 'CASCADE');
        $this->addForeignKey('fk_course_learning_session_id', 'course_learning', 'session_id', 'sessions', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%course_learning}}');
    }
}
