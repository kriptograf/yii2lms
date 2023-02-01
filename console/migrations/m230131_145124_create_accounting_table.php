<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%accounting}}`.
 */
class m230131_145124_create_accounting_table extends Migration
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

        $this->createTable('{{%accounting}}', [
            'id'                      => $this->primaryKey(),
            'user_id'                 => $this->integer(),
            'creator_id'              => $this->integer(),
            'webinar_id'              => $this->integer(),
            'meeting_time_id'         => $this->integer()->null(),
            'subscribe_id'            => $this->integer()->null(),
            'promotion_id'            => $this->integer()->null(),
            'registration_package_id' => $this->integer()->null(),
            'system'                  => $this->tinyInteger()->defaultValue(0),
            'tax'                     => $this->tinyInteger()->defaultValue(0),
            'amount'                  => $this->decimal(13, 2)->null(),
            'type'                    => $this->string(), // -- 'addiction', 'deduction'
            'type_account'            => $this->string(), // -- 'income','asset','subscribe','promotion','registration_package'
            'store_type'              => $this->string()->defaultValue('automatic'), // -- 'automatic', 'manual'
            'referred_user_id'        => $this->integer()->null(),
            'is_affiliate_amount'     => $this->tinyInteger()->defaultValue(0),
            'is_affiliate_commission' => $this->tinyInteger()->defaultValue(0),
            'description'             => $this->text()->null(),
            'created_at'              => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'              => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_accounting_user_id', 'accounting', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_accounting_webinar_id', 'accounting', 'webinar_id', 'webinars', 'id', 'CASCADE');
        $this->addForeignKey('fk_accounting_meeting_time_id', 'accounting', 'meeting_time_id', 'meeting_times', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_accounting_user_id', 'accounting');
        $this->dropForeignKey('fk_accounting_webinar_id', 'accounting');
        $this->dropForeignKey('fk_accounting_meeting_time_id', 'accounting');
        $this->dropTable('{{%accounting}}');
    }
}
