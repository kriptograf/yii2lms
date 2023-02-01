<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%certificates}}`.
 */
class m230130_202305_create_certificates_table extends Migration
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

        $this->createTable('{{%certificates}}', [
            'id'             => $this->primaryKey(),
            'quiz_id'        => $this->integer(),
            'quiz_result_id' => $this->integer(),
            'student_id'     => $this->integer(),
            'user_grade'     => $this->integer(),
            'file'           => $this->string(),
            'created_at'     => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'     => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_certificates_quiz_id', 'certificates', 'quiz_id', 'quizzes', 'id', 'CASCADE');
        $this->addForeignKey('fk_certificates_quiz_result_id', 'certificates', 'quiz_result_id', 'quizzes_results', 'id', 'CASCADE');
        $this->addForeignKey('fk_certificates_student_id', 'certificates', 'student_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_certificates_quiz_id', 'certificates');
        $this->dropForeignKey('fk_certificates_quiz_result_id', 'certificates');
        $this->dropForeignKey('fk_certificates_student_id', 'certificates');
        $this->dropTable('{{%certificates}}');
    }
}
