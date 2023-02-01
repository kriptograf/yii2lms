<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%payment_channels}}`.
 */
class m230131_154655_create_payment_channels_table extends Migration
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

        $this->createTable('{{%payment_channels}}', [
            'id'         => $this->primaryKey(),
            'title'      => $this->string(),
            'class_name' => $this->string(), // -- Paypal', 'Paystack', 'Paytm', 'Payu', 'Razorpay', 'Zarinpal', 'Stripe', 'Paysera', 'Fastpay', 'YandexCheckout', '2checkout', 'Bitpay', 'Midtrans', 'Adyen', 'Flutterwave', 'Payfort'
            'status'     => $this->string(), // -- 'active', 'inactive'
            'image'      => $this->string()->null(),
            'settings'   => $this->text()->null(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%payment_channels}}');
    }
}
