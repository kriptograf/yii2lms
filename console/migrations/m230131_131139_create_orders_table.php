<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m230131_131139_create_orders_table extends Migration
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

        $this->createTable('{{%orders}}', [
            'id'                => $this->primaryKey(),
            'user_id'           => $this->integer(),
            'status'            => $this->string(), // -- 'pending', 'paying', 'paid', 'fail'
            'payment_method'    => $this->string(), // -- 'credit', 'payment_channel'
            'is_charge_account' => $this->boolean()->defaultValue(false),
            'type'              => $this->string(), // -- 'webinar','meeting','charge', 'subscribe','promotion'
            'amount'            => $this->integer(),
            'tax'               => $this->decimal(13, 3)->null(),
            'total_discount'    => $this->decimal(13, 2)->null(),
            'total_amount'      => $this->decimal(13, 2)->null(),
            'reference_id'      => $this->text()->null(),
            'created_at'        => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'        => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_orders_user_id', 'orders', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_orders_user_id', 'orders');
        $this->dropTable('{{%orders}}');
    }
}
