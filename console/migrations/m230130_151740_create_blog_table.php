<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blog}}`.
 */
class m230130_151740_create_blog_table extends Migration
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

        $this->createTable('{{%blog}}', [
            'id'               => $this->primaryKey(),
            'category_id'      => $this->integer(),
            'author_id'        => $this->integer(),
            'title'            => $this->string(255),
            'slug'             => $this->string(255)->unique(),
            'image'            => $this->string(255)->null(),
            'description'      => $this->text()->null(),
            'meta_description' => $this->text()->null(),
            'content'          => $this->text(),
            'visit_count'      => $this->integer()->defaultValue(0),
            'enable_comment'   => $this->boolean()->defaultValue(true),
            'status'           => $this->string()->defaultValue('pending'), // -- 'pending', 'publish'
            'created_at'       => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'       => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->createIndex('idx_blog_category_id', 'blog', 'category_id');
        $this->createIndex('idx_blog_author_id', 'blog', 'author_id');
        $this->createIndex('idx_blog_title', 'blog', 'title');

        $this->addForeignKey('fk_blog_category_id', 'blog', 'category_id', 'blog_categories', 'id', 'CASCADE');
        $this->addForeignKey('fk_blog_author_id', 'blog', 'author_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_blog_category_id', 'blog');
        $this->dropIndex('idx_blog_author_id', 'blog');
        $this->dropIndex('idx_blog_title', 'blog');

        $this->dropForeignKey('fk_blog_category_id', 'blog');
        $this->dropForeignKey('fk_blog_author_id', 'blog');

        $this->dropTable('{{%blog}}');
    }
}
