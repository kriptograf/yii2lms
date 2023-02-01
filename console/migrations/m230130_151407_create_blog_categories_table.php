<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blog_categories}}`.
 */
class m230130_151407_create_blog_categories_table extends Migration
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

        $this->createTable('{{%blog_categories}}', [
            'id'    => $this->primaryKey(),
            'title' => $this->string(),
            'slug'  => $this->string()->unique(),
        ], $tableOptions);

        $this->createIndex('idx_blog_categories_slug', 'blog_categories', 'slug', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_blog_categories_slug', 'blog_categories');
        $this->dropTable('{{%blog_categories}}');
    }
}
