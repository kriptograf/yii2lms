<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%badges}}`.
 */
class m230131_125916_create_badges_table extends Migration
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

        $this->createTable('{{%badges}}', [
            'id'          => $this->primaryKey(),
            'title'       => $this->string(),
            'description' => $this->text()->null(),
            'image'       => $this->string(),
            'type'        => $this->string(), // -- 'register_date', 'course_count', 'course_rate', 'sale_count', 'support_rate'
            'condition'   => $this->string(),
            'created_at'  => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'  => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->createIndex('idx_badges_type', 'badges', 'type');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_badges_type', 'badges');
        $this->dropTable('{{%badges}}');
    }
}
