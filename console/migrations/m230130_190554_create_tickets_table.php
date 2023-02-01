<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tickets}}`.
 */
class m230130_190554_create_tickets_table extends Migration
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

        $this->createTable('{{%tickets}}', [
            'id'         => $this->primaryKey(),
            'creator_id' => $this->integer(),
            'webinar_id' => $this->integer(),
            'title'      => $this->string(),
            'start_date' => $this->dateTime()->null(),
            'end_date'   => $this->dateTime()->null(),
            'discount'   => $this->integer(),
            'capacity'   => $this->integer(),
            'order'      => $this->integer()->null(),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_tickets_creator_id', 'tickets', 'creator_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_tickets_webinar_id', 'tickets', 'webinar_id', 'webinars', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_tickets_creator_id', 'tickets');
        $this->dropForeignKey('fk_tickets_webinar_id', 'tickets');
        $this->dropTable('{{%tickets}}');
    }
}
