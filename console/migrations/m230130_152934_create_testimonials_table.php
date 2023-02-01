<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%testimonials}}`.
 */
class m230130_152934_create_testimonials_table extends Migration
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

        $this->createTable('{{%testimonials}}', [
            'id'          => $this->primaryKey(),
            'user_name'   => $this->string(),
            'user_avatar' => $this->string(),
            'user_bio'    => $this->string(),
            'rate'        => $this->integer()->defaultValue(5),
            'comment'     => $this->text(),
            'status'      => $this->string()->defaultValue('disable'), // -- 'active', 'disable'
            'created_at'  => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'  => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%testimonials}}');
    }
}
