<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%categories}}`.
 */
class m230130_144040_create_categories_table extends Migration
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

        $this->createTable('{{%categories}}', [
            'id'        => $this->primaryKey(),
            'parent_id' => $this->integer()->null()->defaultValue(null),
            'title'     => $this->string(255),
            'order'     => $this->integer()->null(),
            'icon'      => $this->string(255)->null(),
        ], $tableOptions);

        $this->createIndex('idx_categories_parent_id', 'categories', 'parent_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_categories_parent_id', 'categories');
        $this->dropTable('{{%categories}}');
    }
}
