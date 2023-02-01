<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%webinars}}`.
 */
class m230130_165119_create_webinars_table extends Migration
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

        $this->createTable('{{%webinars}}', [
            'id'                   => $this->primaryKey(),
            'teacher_id'           => $this->integer(),
            'creator_id'           => $this->integer(),
            'category_id'          => $this->integer(),
            'type'                 => $this->string()->defaultValue('webinar'), // -- 'webinar','course','text_lesson'
            'title'                => $this->string(),
            'slug'                 => $this->string()->unique(),
            'start_date'           => $this->dateTime()->null(),
            'duration'             => $this->integer(),
            'seo_description'      => $this->text(),
            'thumbnail'            => $this->string(),
            'image_cover'          => $this->string()->null(),
            'video_demo'           => $this->string()->null(),
            'capacity'             => $this->integer(),
            'price'                => $this->integer(),
            'description'          => $this->text()->null(),
            'support'              => $this->boolean()->defaultValue(false),
            'downloadable'         => $this->boolean()->defaultValue(false),
            'partner_instructor'   => $this->boolean()->defaultValue(false),
            'subscribe'            => $this->boolean()->defaultValue(false),
            'points'               => $this->integer()->null(),
            'private'              => $this->boolean()->defaultValue(false),
            'message_for_reviewer' => $this->text()->null(),
            'status'               => $this->string(), // -- 'active','pending','is_draft','inactive'
            'created_at'           => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'           => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->createIndex('idx_webinars_category_id', 'webinars', 'category_id');
        $this->createIndex('idx_webinars_teacher_id', 'webinars', 'teacher_id');
        $this->createIndex('idx_webinars_title', 'webinars', 'title');

        $this->addForeignKey('fk_webinars_teacher_id', 'webinars', 'teacher_id', 'user', 'id');
        $this->addForeignKey('fk_webinars_creator_id', 'webinars', 'creator_id', 'user', 'id');
        $this->addForeignKey('fk_webinars_category_id', 'webinars', 'category_id', 'categories', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_webinars_category_id', 'webinars');
        $this->dropIndex('idx_webinars_teacher_id', 'webinars');
        $this->dropIndex('idx_webinars_title', 'webinars');

        $this->dropForeignKey('fk_webinars_teacher_id', 'webinars');
        $this->dropForeignKey('fk_webinars_creator_id', 'webinars');
        $this->dropForeignKey('fk_webinars_category_id', 'webinars');

        $this->dropTable('{{%webinars}}');
    }
}
