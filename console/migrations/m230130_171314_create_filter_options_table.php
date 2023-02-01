<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%filter_options}}`.
 */
class m230130_171314_create_filter_options_table extends Migration
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

        $this->createTable('{{%filter_options}}', [
            'id'        => $this->primaryKey(),
            'title'     => $this->string(),
            'filter_id' => $this->integer(),
            'order'     => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_filter_options_filter_id', 'filter_options', 'filter_id', 'filters', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_filter_options_filter_id', 'filter_options');
        $this->dropTable('{{%filter_options}}');
    }
}
