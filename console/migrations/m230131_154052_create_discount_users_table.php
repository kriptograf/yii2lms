<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%discount_users}}`.
 */
class m230131_154052_create_discount_users_table extends Migration
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

        $this->createTable('{{%discount_users}}', [
            'id'          => $this->primaryKey(),
            'discount_id' => $this->integer(),
            'user_id'     => $this->integer(),
            'created_at'  => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'  => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_discount_users_discount_id', 'discount_users', 'discount_id', 'discounts', 'id', 'CASCADE');
        $this->addForeignKey('fk_discount_users_user_id', 'discount_users', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_discount_users_discount_id', 'discount_users');
        $this->dropForeignKey('fk_discount_users_user_id', 'discount_users');
        $this->dropTable('{{%discount_users}}');
    }
}
