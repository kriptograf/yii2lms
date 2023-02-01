<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%faqs}}`.
 */
class m230130_194815_create_faqs_table extends Migration
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

        $this->createTable('{{%faqs}}', [
            'id' => $this->primaryKey(),
            'creator_id'    => $this->integer(),
            'webinar_id'    => $this->integer(),
            'title'         => $this->string(),
            'answer' => $this->text(),
            'order' => $this->integer()->null(),
            'created_at'    => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'    => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_faqs_creator_id', 'faqs', 'creator_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_faqs_webinar_id', 'faqs', 'webinar_id', 'webinars', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_faqs_creator_id', 'faqs');
        $this->dropForeignKey('fk_faqs_webinar_id', 'faqs');
        $this->dropTable('{{%faqs}}');
    }
}
