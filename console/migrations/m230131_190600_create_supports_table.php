<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%supports}}`.
 */
class m230131_190600_create_supports_table extends Migration
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

        $this->createTable('{{%supports}}', [
            'id'            => $this->primaryKey(),
            'user_id'       => $this->integer(),
            'webinar_id'    => $this->integer()->null(),
            'department_id' => $this->integer()->null(),
            'title'         => $this->string(),
            'status'        => $this->string(), // -- 'open','close','replied','supporter_replied
            'created_at'    => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'    => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_supports_user_id', 'supports', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_supports_webinar_id', 'supports', 'webinar_id', 'webinars', 'id', 'CASCADE');
        $this->addForeignKey('fk_supports_department_id', 'supports', 'department_id', 'support_departments', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_supports_user_id', 'supports');
        $this->dropForeignKey('fk_supports_webinar_id', 'supports');
        $this->dropForeignKey('fk_supports_department_id', 'supports');
        $this->dropTable('{{%supports}}');
    }
}
