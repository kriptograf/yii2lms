<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%payouts}}`.
 */
class m230131_183010_create_payouts_table extends Migration
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

        $this->createTable('{{%payouts}}', [
            'id'                => $this->primaryKey(),
            'user_id'           => $this->integer(),
            'amount'            => $this->decimal(13, 2),
            'account_name'      => $this->string(),
            'account_number'    => $this->string(),
            'account_bank_name' => $this->string(),
            'status'            => $this->string(), // -- 'waiting', 'done', 'reject'
            'created_at'        => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'        => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_payouts_user_id', 'payouts', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_payouts_user_id', 'payouts');
        $this->dropTable('{{%payouts}}');
    }
}
