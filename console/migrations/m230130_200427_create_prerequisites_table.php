<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%prerequisites}}`.
 */
class m230130_200427_create_prerequisites_table extends Migration
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

        $this->createTable('{{%prerequisites}}', [
            'id'              => $this->primaryKey(),
            'webinar_id'      => $this->integer(),
            'prerequisite_id' => $this->integer(),
            'required'        => $this->boolean()->defaultValue(false),
            'order'           => $this->integer(),
            'created_at'      => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'      => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_prerequisites_webinar_id', 'prerequisites', 'webinar_id', 'webinars', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_prerequisites_webinar_id', 'prerequisites');
        $this->dropTable('{{%prerequisites}}');
    }
}
