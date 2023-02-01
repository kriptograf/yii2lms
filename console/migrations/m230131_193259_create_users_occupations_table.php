<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users_occupations}}`.
 */
class m230131_193259_create_users_occupations_table extends Migration
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

        $this->createTable('{{%users_occupations}}', [
            'id'          => $this->primaryKey(),
            'user_id'     => $this->integer(),
            'category_id' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_users_occupations_user_id', 'users_occupations', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_users_occupations_category_id', 'users_occupations', 'category_id', 'categories', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_users_occupations_user_id', 'users_occupations');
        $this->dropForeignKey('fk_users_occupations_category_id', 'users_occupations');
        $this->dropTable('{{%users_occupations}}');
    }
}
