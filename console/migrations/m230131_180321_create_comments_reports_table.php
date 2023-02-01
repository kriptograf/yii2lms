<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments_reports}}`.
 */
class m230131_180321_create_comments_reports_table extends Migration
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

        $this->createTable('{{%comments_reports}}', [
            'id'         => $this->primaryKey(),
            'user_id'    => $this->integer(),
            'blog_id'    => $this->integer()->null(),
            'webinar_id' => $this->integer()->null(),
            'comment_id' => $this->integer(),
            'message'    => $this->text(),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_comments_reports_comment_id', 'comments_reports', 'comment_id', 'comments', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_comments_reports_comment_id', 'comments_reports');
        $this->dropTable('{{%comments_reports}}');
    }
}
