<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%files}}`.
 */
class m230130_194241_create_files_table extends Migration
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

        $this->createTable('{{%files}}', [
            'id'            => $this->primaryKey(),
            'creator_id'    => $this->integer(),
            'webinar_id'    => $this->integer(),
            'title'         => $this->string(),
            'accessibility' => $this->string(), // -- 'free', 'paid'
            'downloadable'  => $this->boolean()->defaultValue(true),
            'storage'       => $this->string(), // -- 'local', 'online'
            'file'          => $this->string(),
            'volume'        => $this->string(),
            'file_type'     => $this->string(),
            'description'   => $this->text()->null(),
            'order'         => $this->integer()->null(),
            'created_at'    => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'    => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_files_creator_id', 'files', 'creator_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_files_webinar_id', 'files', 'webinar_id', 'webinars', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_files_creator_id', 'files');
        $this->dropForeignKey('fk_files_webinar_id', 'files');
        $this->dropTable('{{%files}}');
    }
}
