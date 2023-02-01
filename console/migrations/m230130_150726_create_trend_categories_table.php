<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%trend_categories}}`.
 */
class m230130_150726_create_trend_categories_table extends Migration
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

        $this->createTable('{{%trend_categories}}', [
            'id'          => $this->primaryKey(),
            'category_id' => $this->integer(),
            'icon'        => $this->string()->null(),
            'color'       => $this->string()->null(),
            'created_at'  => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'  => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->createIndex('idx_trend_categories_category_id', 'trend_categories', 'category_id');
        $this->addForeignKey('fk_trend_categories_category_id', 'trend_categories', 'category_id', 'categories', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_trend_categories_category_id', 'trend_categories');
        $this->dropForeignKey('fk_trend_categories_category_id', 'trend_categories');
        $this->dropTable('{{%trend_categories}}');
    }
}
