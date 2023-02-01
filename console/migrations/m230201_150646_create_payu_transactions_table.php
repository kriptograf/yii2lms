<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%payu_transactions}}`.
 */
class m230201_150646_create_payu_transactions_table extends Migration
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

        $this->createTable('{{%payu_transactions}}', [
            'id'             => $this->primaryKey(),
            'paid_for_id'    => $this->integer(),
            'paid_for_type'  => $this->string()->null(),
            'transaction_id' => $this->string()->unique(),
            'gateway'        => $this->text(),
            'body'           => $this->text(),
            'destination'    => $this->string(),
            'hash'           => $this->text(),
            'response'       => $this->string(),
            'status'         => $this->string(), // -- 'pending', 'failed', 'successful', 'invalid'
            'verified_at'    => $this->dateTime(),
            'created_at'     => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'     => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->createIndex('idx_payu_transactions_status', 'payu_transactions', 'status');
        $this->createIndex('idx_payu_transactions_verified_at', 'payu_transactions', 'verified_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_payu_transactions_status', 'payu_transactions');
        $this->dropIndex('idx_payu_transactions_verified_at', 'payu_transactions');
        $this->dropTable('{{%payu_transactions}}');
    }
}
