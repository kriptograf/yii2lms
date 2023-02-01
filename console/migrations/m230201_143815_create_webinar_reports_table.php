<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%webinar_reports}}`.
 */
class m230201_143815_create_webinar_reports_table extends Migration
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

        $this->createTable('{{%webinar_reports}}', [
            'id'         => $this->primaryKey(),
            'user_id'    => $this->integer(),
            'webinar_id' => $this->integer(),
            'reason'     => $this->string(),
            'message'    => $this->text(),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_webinar_reports_user_id', 'webinar_reports', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_webinar_reports_webinar_id', 'webinar_reports', 'webinar_id', 'webinars', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_webinar_reports_user_id', 'webinar_reports');
        $this->dropForeignKey('fk_webinar_reports_webinar_id', 'webinar_reports');
        $this->dropTable('{{%webinar_reports}}');
    }
}
