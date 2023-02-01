<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%certificates_templates}}`.
 */
class m230130_202711_create_certificates_templates_table extends Migration
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

        $this->createTable('{{%certificates_templates}}', [
            'id'         => $this->primaryKey(),
            'title'      => $this->string(),
            'body'       => $this->text(),
            'image'      => $this->string(),
            'position_x' => $this->string()->null(),
            'position_y' => $this->string()->null(),
            'font_size'  => $this->string()->null(),
            'text_color' => $this->string()->null(),
            'status'     => $this->string()->defaultValue('draft'), // -- 'draft','publish'
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%certificates_templates}}');
    }
}
