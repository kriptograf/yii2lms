<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_items}}`.
 */
class m230131_131840_create_order_items_table extends Migration
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

        $this->createTable('{{%order_items}}', [
            'id'                 => $this->primaryKey(),
            'user_id'            => $this->integer(),
            'order_id'           => $this->integer(),
            'webinar_id'         => $this->integer()->null(),
            'subscribe_id'       => $this->integer()->null(),
            'promotion_id'       => $this->integer()->null(),
            'reserve_meeting_id' => $this->integer()->null(),
            'ticket_id'          => $this->integer()->null(),
            'discount_id'        => $this->integer()->null(),
            'amount'             => $this->integer()->null(),
            'tax'                => $this->integer()->null(),
            'tax_price'          => $this->decimal(13, 2)->null(),
            'commission'         => $this->integer()->null(),
            'commission_price'   => $this->decimal(13, 2)->null(),
            'discount'           => $this->decimal(13, 2)->null(),
            'total_amount'       => $this->decimal(13, 2)->null(),
            'created_at'         => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'         => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_order_items_user_id', 'order_items', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_order_items_order_id', 'order_items', 'order_id', 'orders', 'id', 'CASCADE');
        $this->addForeignKey('fk_order_items_webinar_id', 'order_items', 'webinar_id', 'webinars', 'id', 'CASCADE');
        $this->addForeignKey('fk_order_items_reserve_meeting_id', 'order_items', 'reserve_meeting_id', 'reserve_meetings', 'id', 'CASCADE');
        $this->addForeignKey('fk_order_items_ticket_id', 'order_items', 'ticket_id', 'tickets', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_order_items_user_id', 'order_items');
        $this->dropForeignKey('fk_order_items_order_id', 'order_items');
        $this->dropForeignKey('fk_order_items_webinar_id', 'order_items');
        $this->dropForeignKey('fk_order_items_reserve_meeting_id', 'order_items');
        $this->dropForeignKey('fk_order_items_ticket_id', 'order_items');
        $this->dropTable('{{%order_items}}');
    }
}
