<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%quizzes_questions}}`.
 */
class m230130_195608_create_quizzes_questions_table extends Migration
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

        $this->createTable('{{%quizzes_questions}}', [
            'id'         => $this->primaryKey(),
            'quiz_id'    => $this->integer(),
            'creator_id' => $this->integer(),
            'title'      => $this->string(),
            'grade'      => $this->string(),
            'type'       => $this->string(), // -- 'multiple', 'descriptive'
            'correct'    => $this->string()->null(),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_quizzes_questions_quiz_id', 'quizzes_questions', 'quiz_id', 'quizzes', 'id', 'CASCADE');
        $this->addForeignKey('fk_quizzes_questions_creator_id', 'quizzes_questions', 'creator_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_quizzes_questions_quiz_id', 'quizzes_questions');
        $this->dropForeignKey('fk_quizzes_questions_creator_id', 'quizzes_questions');
        $this->dropTable('{{%quizzes_questions}}');
    }
}
