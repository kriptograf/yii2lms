<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%become_instructors}}`.
 */
class m230201_143504_create_become_instructors_table extends Migration
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

        $this->createTable('{{%become_instructors}}', [
            'id'          => $this->primaryKey(),
            'user_id'     => $this->integer(),
            'certificate' => $this->string()->null(),
            'description' => $this->text()->null(),
            'status'      => $this->string()->defaultValue('pending'), // -- 'pending', 'accept', 'reject'
            'created_at'  => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'  => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_become_instructors_user_id', 'become_instructors', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_become_instructors_user_id', 'become_instructors');
        $this->dropTable('{{%become_instructors}}');
    }
}
