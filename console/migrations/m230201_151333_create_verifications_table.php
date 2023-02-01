<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%verifications}}`.
 */
class m230201_151333_create_verifications_table extends Migration
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

        $this->createTable('{{%verifications}}', [
            'id'          => $this->primaryKey(),
            'user_id'     => $this->integer(),
            'mobile'      => $this->string(),
            'email'       => $this->string(),
            'code'        => $this->string(),
            'verified_at' => $this->dateTime(),
            'expired_at'  => $this->dateTime(),
            'created_at'  => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'  => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_verifications_user_id', 'verifications', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_verifications_user_id', 'verifications');
        $this->dropTable('{{%verifications}}');
    }
}
