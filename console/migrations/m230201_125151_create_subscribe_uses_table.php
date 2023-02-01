<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subscribe_uses}}`.
 */
class m230201_125151_create_subscribe_uses_table extends Migration
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

        $this->createTable('{{%subscribe_uses}}', [
            'id'           => $this->primaryKey(),
            'user_id'      => $this->integer(),
            'subscribe_id' => $this->integer(),
            'webinar_id'   => $this->integer(),
            'sale_id'      => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_subscribe_uses_user_id', 'subscribe_uses', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_subscribe_uses_subscribe_id', 'subscribe_uses', 'subscribe_id', 'subscribes', 'id', 'CASCADE');
        $this->addForeignKey('fk_subscribe_uses_webinar_id', 'subscribe_uses', 'webinar_id', 'webinars', 'id', 'CASCADE');
        $this->addForeignKey('fk_subscribe_uses_sale_id', 'subscribe_uses', 'sale_id', 'sales', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_subscribe_uses_user_id', 'subscribe_uses');
        $this->dropForeignKey('fk_subscribe_uses_subscribe_id', 'subscribe_uses');
        $this->dropForeignKey('fk_subscribe_uses_webinar_id', 'subscribe_uses');
        $this->dropForeignKey('fk_subscribe_uses_sale_id', 'subscribe_uses');
        $this->dropTable('{{%subscribe_uses}}');
    }
}
