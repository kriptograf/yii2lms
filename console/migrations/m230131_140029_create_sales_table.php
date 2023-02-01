<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sales}}`.
 */
class m230131_140029_create_sales_table extends Migration
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

        $this->createTable('{{%sales}}', [
            'id'             => $this->primaryKey(),
            'seller_id'      => $this->integer()->null(),
            'buyer_id'       => $this->integer(),
            'order_id'       => $this->integer()->null(),
            'webinar_id'     => $this->integer()->null(),
            'meeting_id'     => $this->integer()->null(),
            'subscribe_id'   => $this->integer()->null(),
            'ticket_id'      => $this->integer()->null(),
            'promotion_id'   => $this->integer()->null(),
            'type'           => $this->string(), // -- 'webinar','meeting','subscribe', 'promotion'
            'payment_method' => $this->string(), // -- 'credit','payment_channel','subscribe'
            'amount'         => $this->integer(),
            'tax'            => $this->decimal(13, 2)->null(),
            'commission'     => $this->decimal(13, 2)->null(),
            'discount'       => $this->decimal(13, 2)->null(),
            'total_amount'   => $this->decimal(13, 2)->null(),
            'refund_at'      => $this->dateTime()->null(),
            'created_at'     => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'     => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_sales_buyer_id', 'sales', 'buyer_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_sales_seller_id', 'sales', 'seller_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_sales_order_id', 'sales', 'order_id', 'orders', 'id', 'CASCADE');
        $this->addForeignKey('fk_sales_webinar_id', 'sales', 'webinar_id', 'webinars', 'id', 'CASCADE');
        $this->addForeignKey('fk_sales_meeting_id', 'sales', 'meeting_id', 'meetings', 'id', 'CASCADE');
        $this->addForeignKey('fk_sales_ticket_id', 'sales', 'ticket_id', 'tickets', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_sales_buyer_id', 'sales');
        $this->dropForeignKey('fk_sales_seller_id', 'sales');
        $this->dropForeignKey('fk_sales_order_id', 'sales');
        $this->dropForeignKey('fk_sales_webinar_id', 'sales');
        $this->dropForeignKey('fk_sales_meeting_id', 'sales');
        $this->dropForeignKey('fk_sales_ticket_id', 'sales');
        $this->dropTable('{{%sales}}');
    }
}
