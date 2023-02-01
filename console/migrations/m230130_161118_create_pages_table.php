<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pages}}`.
 */
class m230130_161118_create_pages_table extends Migration
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

        $this->createTable('{{%pages}}', [
            'id'              => $this->primaryKey(),
            'link'            => $this->string(),
            'name'            => $this->string(),
            'title'           => $this->string(),
            'seo_description' => $this->string()->null(),
            'robot'           => $this->boolean()->defaultValue(false),
            'content'         => $this->text(),
            'status'          => $this->string()->defaultValue('draft'), // -- 'publish', 'draft'
            'created_at'      => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'      => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pages}}');
    }
}
