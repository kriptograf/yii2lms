<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%discounts}}`.
 */
class m230131_153514_create_discounts_table extends Migration
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

        $this->createTable('{{%discounts}}', [
            'id'         => $this->primaryKey(),
            'creator_id' => $this->integer(),
            'title'      => $this->string(),
            'code'       => $this->string(),
            'percent'    => $this->integer()->null(),
            'amount'     => $this->integer()->null(),
            'count'      => $this->integer()->defaultValue(1),
            'type'       => $this->string(), // -- 'all_users', 'special_users'
            'expired_at' => $this->dateTime()->null(),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_discounts_creator_id', 'discounts', 'creator_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_discounts_creator_id', 'discounts');
        $this->dropTable('{{%discounts}}');
    }
}
