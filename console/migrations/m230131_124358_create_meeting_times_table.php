<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%meeting_times}}`.
 */
class m230131_124358_create_meeting_times_table extends Migration
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

        $this->createTable('{{%meeting_times}}', [
            'id'         => $this->primaryKey(),
            'meeting_id' => $this->integer(),
            'day_label'  => $this->string(), // -- 'saturday','sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday'
            'time'       => $this->string(),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_meetings_times_meeting_id', 'meeting_times', 'meeting_id', 'meetings', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_meetings_times_meeting_id', 'meeting_times');
        $this->dropTable('{{%meeting_times}}');
    }
}
