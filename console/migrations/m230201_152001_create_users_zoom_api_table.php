<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users_zoom_api}}`.
 */
class m230201_152001_create_users_zoom_api_table extends Migration
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

        $this->createTable('{{%users_zoom_api}}', [
            'id'         => $this->primaryKey(),
            'user_id'    => $this->integer(),
            'jwt_token'  => $this->text(),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_users_zoom_api_user_id', 'users_zoom_api', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_users_zoom_api_user_id', 'users_zoom_api');
        $this->dropTable('{{%users_zoom_api}}');
    }
}
