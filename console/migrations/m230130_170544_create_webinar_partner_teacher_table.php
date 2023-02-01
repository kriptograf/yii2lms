<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%webinar_partner_teacher}}`.
 */
class m230130_170544_create_webinar_partner_teacher_table extends Migration
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

        $this->createTable('{{%webinar_partner_teacher}}', [
            'id' => $this->primaryKey(),
            'webinar_id' => $this->integer(),
            'teacher_id' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_webinar_partner_teacher_webinar_id', 'webinar_partner_teacher', 'webinar_id', 'webinars', 'id');
        $this->addForeignKey('fk_webinar_partner_teacher_teacher_id', 'webinar_partner_teacher', 'teacher_id', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_webinar_partner_teacher_webinar_id', 'webinar_partner_teacher');
        $this->dropForeignKey('fk_webinar_partner_teacher_teacher_id', 'webinar_partner_teacher');
        $this->dropTable('{{%webinar_partner_teacher}}');
    }
}
