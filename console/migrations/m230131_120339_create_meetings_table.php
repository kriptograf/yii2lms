<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%meetings}}`.
 */
class m230131_120339_create_meetings_table extends Migration
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

        $this->createTable('{{%meetings}}', [
            'id'         => $this->primaryKey(),
            'creator_id' => $this->integer(),
            'teacher_id' => $this->integer(),
            'amount'     => $this->integer()->null(),
            'discount'   => $this->integer()->null(),
            'disabled'   => $this->boolean()->defaultValue(false),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_meetings_creator_id', 'meetings', 'creator_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_meetings_teacher_id', 'meetings', 'teacher_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_meetings_creator_id', 'meetings');
        $this->dropForeignKey('fk_meetings_teacher_id', 'meetings');
        $this->dropTable('{{%meetings}}');
    }
}
