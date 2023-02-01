<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%quizzes_questions_answers}}`.
 */
class m230130_200042_create_quizzes_questions_answers_table extends Migration
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

        $this->createTable('{{%quizzes_questions_answers}}', [
            'id'          => $this->primaryKey(),
            'creator_id'  => $this->integer(),
            'question_id' => $this->integer(),
            'title'       => $this->string(),
            'image'       => $this->string(),
            'correct'     => $this->boolean()->defaultValue(false),
            'created_at'  => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'  => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_quizzes_questions_answers_question_id', 'quizzes_questions_answers', 'question_id', 'quizzes_questions', 'id', 'CASCADE');
        $this->addForeignKey('fk_quizzes_questions_answers_creator_id', 'quizzes_questions_answers', 'creator_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_quizzes_questions_answers_question_id', 'quizzes_questions_answers');
        $this->dropForeignKey('fk_quizzes_questions_answers_creator_id', 'quizzes_questions_answers');
        $this->dropTable('{{%quizzes_questions_answers}}');
    }
}
