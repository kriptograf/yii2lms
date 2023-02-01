<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%quizzes}}`.
 */
class m230130_195024_create_quizzes_table extends Migration
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

        $this->createTable('{{%quizzes}}', [
            'id'            => $this->primaryKey(),
            'creator_id'    => $this->integer(),
            'webinar_id'    => $this->integer(),
            'title'         => $this->string(),
            'time'          => $this->integer()->null(),
            'attempt'       => $this->integer()->null(),
            'pass_mark'     => $this->integer()->null(),
            'certificate'   => $this->boolean(),
            'webinar_title' => $this->string()->null(),
            'total_mark'    => $this->integer()->null(),
            'status'        => $this->string(), // -- 'active', 'inactive'
            'created_at'    => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'    => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_quizzes_creator_id', 'quizzes', 'creator_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_quizzes_webinar_id', 'quizzes', 'webinar_id', 'webinars', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_quizzes_creator_id', 'quizzes');
        $this->dropForeignKey('fk_quizzes_webinar_id', 'quizzes');
        $this->dropTable('{{%quizzes}}');
    }
}
