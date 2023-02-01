<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cart}}`.
 */
class m230131_130607_create_cart_table extends Migration
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

        $this->createTable('{{%cart}}', [
            'id' => $this->primaryKey(),
            'creator_id' => $this->integer(),
            'webinar_id' => $this->integer(),
            'reserve_meeting_id' => $this->integer()->null(),
            'subscribe_id' => $this->integer()->null(),
            'promotion_id' => $this->integer()->null(),
            'ticket_id' => $this->integer()->null(),
            'special_offer_id' => $this->integer()->null(),
        ], $tableOptions);

        $this->addForeignKey('fk_cart_creator_id', 'cart', 'creator_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_cart_webinar_id', 'cart', 'webinar_id', 'webinars', 'id', 'CASCADE');
        $this->addForeignKey('fk_cart_ticket_id', 'cart', 'ticket_id', 'tickets', 'id', 'CASCADE');
        $this->addForeignKey('fk_cart_reserve_meeting_id', 'cart', 'reserve_meeting_id', 'reserve_meetings', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_cart_creator_id', 'cart');
        $this->dropForeignKey('fk_cart_webinar_id', 'cart');
        $this->dropForeignKey('fk_cart_ticket_id', 'cart');
        $this->dropForeignKey('fk_cart_reserve_meeting_id', 'cart');
        $this->dropTable('{{%cart}}');
    }
}
