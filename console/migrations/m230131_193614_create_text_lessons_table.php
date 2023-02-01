<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%text_lessons}}`.
 */
class m230131_193614_create_text_lessons_table extends Migration
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

        $this->createTable('{{%text_lessons}}', [
            'id'            => $this->primaryKey(),
            'creator_id'    => $this->integer(),
            'webinar_id'    => $this->integer(),
            'title'         => $this->string(),
            'image'         => $this->string()->null(),
            'study_time'    => $this->integer()->null(),
            'summary'       => $this->text(),
            'content'       => $this->text(),
            'accessibility' => $this->string()->defaultValue('free'), // -- 'free', 'paid'
            'order'         => $this->integer()->null(),
            'created_at'    => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'    => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_text_lessons_creator_id', 'text_lessons', 'creator_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_text_lessons_webinar_id', 'text_lessons', 'webinar_id', 'webinars', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_text_lessons_creator_id', 'text_lessons');
        $this->dropForeignKey('fk_text_lessons_webinar_id', 'text_lessons');
        $this->dropTable('{{%text_lessons}}');
    }
}
