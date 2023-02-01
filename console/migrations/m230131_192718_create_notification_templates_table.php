<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notification_templates}}`.
 */
class m230131_192718_create_notification_templates_table extends Migration
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

        $this->createTable('{{%notification_templates}}', [
            'id'       => $this->primaryKey(),
            'title'    => $this->string(),
            'template' => $this->text(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%notification_templates}}');
    }
}
