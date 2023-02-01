<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users_metas}}`.
 */
class m230131_130421_create_users_metas_table extends Migration
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

        $this->createTable('{{%users_metas}}', [
            'id'      => $this->primaryKey(),
            'user_id' => $this->integer(),
            'name'    => $this->string(),
            'value'   => $this->string(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users_metas}}');
    }
}
