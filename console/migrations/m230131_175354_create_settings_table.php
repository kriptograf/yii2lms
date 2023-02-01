<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%settings}}`.
 */
class m230131_175354_create_settings_table extends Migration
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

        $this->createTable('{{%settings}}', [
            'id'    => $this->primaryKey(),
            'page'  => $this->string()->defaultValue('other'), // -- 'general', 'financial', 'personalization', 'notifications', 'seo', 'customization', 'other'
            'name'  => $this->string(),
            'value' => $this->text()->null(),
        ], $tableOptions);

        $this->createIndex('idx_settings_name', 'settings', 'name');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_settings_name', 'settings');
        $this->dropTable('{{%settings}}');
    }
}
