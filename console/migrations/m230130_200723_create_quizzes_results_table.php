<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%quizzes_results}}`.
 */
class m230130_200723_create_quizzes_results_table extends Migration
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

        $this->createTable('{{%quizzes_results}}', [
            'id'         => $this->primaryKey(),
            'quiz_id'    => $this->integer(),
            'user_id'    => $this->integer(),
            'results'    => $this->text(),
            'user_grade' => $this->integer()->null(),
            'status'     => $this->string(), // -- 'passed', 'failed', 'waiting'
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_quizzes_results_quiz_id', 'quizzes_results', 'quiz_id', 'quizzes', 'id', 'CASCADE');
        $this->addForeignKey('fk_quizzes_results_user_id', 'quizzes_results', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_quizzes_results_quiz_id', 'quizzes_results');
        $this->dropForeignKey('fk_quizzes_results_user_id', 'quizzes_results');
        $this->dropTable('{{%quizzes_results}}');
    }
}
