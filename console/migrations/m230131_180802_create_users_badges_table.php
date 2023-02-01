<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users_badges}}`.
 */
class m230131_180802_create_users_badges_table extends Migration
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

        $this->createTable('{{%users_badges}}', [
            'id'         => $this->primaryKey(),
            'user_id'    => $this->integer(),
            'badge_id'   => $this->integer(),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_users_badges_user_id', 'users_badges', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_users_badges_badge_id', 'users_badges', 'badge_id', 'badges', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_users_badges_user_id', 'users_badges');
        $this->dropForeignKey('fk_users_badges_badge_id', 'users_badges');
        $this->dropTable('{{%users_badges}}');
    }
}
