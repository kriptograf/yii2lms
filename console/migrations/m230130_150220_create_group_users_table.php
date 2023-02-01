<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%group_users}}`.
 */
class m230130_150220_create_group_users_table extends Migration
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

        $this->createTable('{{%group_users}}', [
            'id'       => $this->primaryKey(),
            'group_id' => $this->integer(),
            'user_id'  => $this->integer(),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->createIndex('idx_group_users_group_id', 'group_users', 'group_id');
        $this->createIndex('idx_group_users_user_id', 'group_users', 'user_id');

        $this->addForeignKey('fk_group_users_group_id', 'group_users', 'group_id', 'groups', 'id', 'CASCADE');
        $this->addForeignKey('fk_group_users_user_id', 'group_users', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_group_users_group_id', 'group_users');
        $this->dropIndex('idx_group_users_user_id', 'group_users');

        $this->dropForeignKey('fk_group_users_group_id', 'group_users');
        $this->dropForeignKey('fk_group_users_user_id', 'group_users');

        $this->dropTable('{{%group_users}}');
    }
}
