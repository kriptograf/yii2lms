<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%permissions}}`.
 */
class m230130_164756_create_permissions_table extends Migration
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

        $this->createTable('{{%permissions}}', [
            'id'         => $this->primaryKey(),
            'role_id'    => $this->integer(),
            'section_id' => $this->integer(),
            'allow'      => $this->boolean()->defaultValue(false),
        ], $tableOptions);

        $this->addForeignKey('fk_permissions_role_id', 'permissions', 'role_id', 'roles', 'id', 'CASCADE');
        $this->addForeignKey('fk_permissions_section_id', 'permissions', 'section_id', 'sections', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_permissions_role_id', 'permissions');
        $this->dropForeignKey('fk_permissions_section_id', 'permissions');
        $this->dropTable('{{%permissions}}');
    }
}
