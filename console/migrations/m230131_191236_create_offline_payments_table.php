<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%offline_payments}}`.
 */
class m230131_191236_create_offline_payments_table extends Migration
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

        $this->createTable('{{%offline_payments}}', [
            'id'               => $this->primaryKey(),
            'user_id'          => $this->integer(),
            'amount'           => $this->decimal(13, 2),
            'bank'             => $this->string(),
            'reference_number' => $this->string(),
            'pay_date'         => $this->string(),
            'status'           => $this->string(), // -- 'waiting', 'approved', 'reject'
            'created_at'       => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'       => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_offline_payments_user_id', 'offline_payments', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_offline_payments_user_id', 'offline_payments');
        $this->dropTable('{{%offline_payments}}');
    }
}
