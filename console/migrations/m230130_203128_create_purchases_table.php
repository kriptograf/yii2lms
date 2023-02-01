<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%purchases}}`.
 */
class m230130_203128_create_purchases_table extends Migration
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

        $this->createTable('{{%purchases}}', [
            'id'         => $this->primaryKey(),
            'webinar_id' => $this->integer(),
            'user_id'    => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_purchases_user_id', 'purchases', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_purchases_webinar_id', 'purchases', 'webinar_id', 'webinars', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_purchases_user_id', 'purchases');
        $this->dropForeignKey('fk_purchases_webinar_id', 'purchases');
        $this->dropTable('{{%purchases}}');
    }
}
