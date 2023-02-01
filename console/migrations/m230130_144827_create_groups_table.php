<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%groups}}`.
 */
class m230130_144827_create_groups_table extends Migration
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

        $this->createTable('{{%groups}}', [
            'id'         => $this->primaryKey(),
            'creator_id' => $this->integer(),
            'name'       => $this->string(255),
            'discount'   => $this->integer()->null(),
            'commission' => $this->integer()->null(),
            'status'     => $this->string()->defaultValue('inactive'), // -- 'active', 'inactive'
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->createIndex('idx_groups_creator_id', 'groups', 'creator_id');
        $this->addForeignKey('fk_groups_user_creator_id', 'groups', 'creator_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_groups_creator_id', 'groups');
        $this->dropForeignKey('fk_groups_user_creator_id', 'groups');

        $this->dropTable('{{%groups}}');
    }
}
