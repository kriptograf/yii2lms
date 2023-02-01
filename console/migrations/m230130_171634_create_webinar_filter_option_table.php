<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%webinar_filter_option}}`.
 */
class m230130_171634_create_webinar_filter_option_table extends Migration
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

        $this->createTable('{{%webinar_filter_option}}', [
            'id'               => $this->primaryKey(),
            'webinar_id'       => $this->integer(),
            'filter_option_id' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_webinar_filter_option_webinar_id', 'webinar_filter_option', 'webinar_id', 'webinars', 'id');
        $this->addForeignKey('fk_webinar_filter_option_filter_option_id', 'webinar_filter_option', 'filter_option_id', 'filter_options', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_webinar_filter_option_webinar_id', 'webinar_filter_option');
        $this->dropForeignKey('fk_webinar_filter_option_filter_option_id', 'webinar_filter_option');
        $this->dropTable('{{%webinar_filter_option}}');
    }
}
