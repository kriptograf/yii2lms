<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reserve_meetings}}`.
 */
class m230131_124725_create_reserve_meetings_table extends Migration
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

        $this->createTable('{{%reserve_meetings}}', [
            'id'              => $this->primaryKey(),
            'meeting_id'      => $this->integer(),
            'sale_id'         => $this->integer(),
            'meeting_time_id' => $this->integer(),
            'user_id'         => $this->integer(),
            'day'             => $this->string(),
            'date'            => $this->dateTime(),
            'locked_at'       => $this->dateTime()->null(),
            'reserved_at'     => $this->dateTime()->null(),
            'paid_amount'     => $this->decimal(13, 2),
            'discount'        => $this->integer()->null(),
            'link'            => $this->string()->null(),
            'password'        => $this->string()->null(),
            'status'          => $this->string(), // -- 'pending','open','finished','canceled'
            'created_at'      => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'      => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_reserve_meetings_meeting_id', 'reserve_meetings', 'meeting_id', 'meetings', 'id', 'CASCADE');
        $this->addForeignKey('fk_reserve_meetings_meeting_time_id', 'reserve_meetings', 'meeting_time_id', 'meeting_times', 'id', 'CASCADE');
        $this->addForeignKey('fk_reserve_meetings_user_id', 'reserve_meetings', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_reserve_meetings_meeting_id', 'reserve_meetings');
        $this->dropForeignKey('fk_reserve_meetings_meeting_time_id', 'reserve_meetings');
        $this->dropForeignKey('fk_reserve_meetings_user_id', 'reserve_meetings');
        $this->dropTable('{{%reserve_meetings}}');
    }
}
