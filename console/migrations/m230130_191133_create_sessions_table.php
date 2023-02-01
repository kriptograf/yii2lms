<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sessions}}`.
 */
class m230130_191133_create_sessions_table extends Migration
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

        $this->createTable('{{%sessions}}', [
            'id'               => $this->primaryKey(),
            'creator_id'       => $this->integer(),
            'webinar_id'       => $this->integer(),
            'title'            => $this->string(),
            'date'             => $this->date()->null(),
            'duration'         => $this->integer(),
            'link'             => $this->string(),
            'session_api'      => $this->string()->defaultValue('local'), // -- 'local', 'big_blue_button', 'zoom'
            'api_secret'       => $this->string()->null(),
            'moderator_secret' => $this->string()->null(),
            'zoom_start_link'  => $this->text()->null(),
            'description'      => $this->text()->null(),
            'order'            => $this->integer()->null(),
            'created_at'       => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'       => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_sessions_creator_id', 'sessions', 'creator_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_sessions_webinar_id', 'sessions', 'webinar_id', 'webinars', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_sessions_creator_id', 'sessions');
        $this->dropForeignKey('fk_sessions_webinar_id', 'sessions');
        $this->dropTable('{{%sessions}}');
    }
}
