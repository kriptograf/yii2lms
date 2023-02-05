<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%role_permission}}`.
 */
class m230205_175208_drop_role_permission_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk_permissions_role_id', 'permissions');
        $this->dropForeignKey('fk_permissions_section_id', 'permissions');
        $this->dropTable('{{%permissions}}');
        $this->dropTable('{{%roles}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return 'Невозможно откатить миграцию m230205_175208_drop_role_permission_table';
    }
}
