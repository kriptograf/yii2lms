<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 */
class m230130_201131_create_comments_table extends Migration
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

        $this->createTable('{{%comments}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'webinar_id' => $this->integer()->null(),
            'blog_id' => $this->integer()->null(),
            'reply_id' => $this->integer()->null(),
            'review_id' => $this->integer()->null(),
            'comment' => $this->text(),
            'status' => $this->string(), // -- 'pending', 'active'
            'report' => $this->boolean()->defaultValue(false),
            'disabled' => $this->boolean()->defaultValue(false),
            'viewed_at' => $this->integer()->null(),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_comments_user_id', 'comments', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_comments_user_id', 'comments');
        $this->dropTable('{{%comments}}');
    }
}
