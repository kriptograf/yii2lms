<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%advertising_banners}}`.
 */
class m230130_153458_create_advertising_banners_table extends Migration
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

        $this->createTable('{{%advertising_banners}}', [
            'id'         => $this->primaryKey(),
            'title'      => $this->string(),
            'position'   => $this->string(), // -- 'home', 'course', 'course_sidebar'
            'image'      => $this->string(),
            'size'       => $this->integer()->defaultValue(12),
            'link'       => $this->string(),
            'published'  => $this->boolean()->defaultValue(false),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%advertising_banners}}');
    }
}
