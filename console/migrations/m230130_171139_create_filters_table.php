<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%filters}}`.
 */
class m230130_171139_create_filters_table extends Migration
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

        $this->createTable('{{%filters}}', [
            'id' => $this->primaryKey(),
            'title'      => $this->string(),
            'category_id' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_filters_category_id', 'filters', 'category_id', 'categories', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_filters_category_id', 'filters');
        $this->dropTable('{{%filters}}');
    }
}
