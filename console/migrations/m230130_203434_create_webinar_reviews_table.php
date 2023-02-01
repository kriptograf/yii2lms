<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%webinar_reviews}}`.
 */
class m230130_203434_create_webinar_reviews_table extends Migration
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

        $this->createTable('{{%webinar_reviews}}', [
            'id'                => $this->primaryKey(),
            'webinar_id'        => $this->integer(),
            'creator_id'        => $this->integer(),
            'content_quality'   => $this->integer(),
            'instructor_skills' => $this->integer(),
            'purchase_worth'    => $this->integer(),
            'support_quality'   => $this->integer(),
            'rates'             => $this->integer(),
            'description'       => $this->text(),
            'status'            => $this->string(), // -- 'pending', 'active'
            'created_at'        => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'        => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_webinar_reviews_creator_id', 'webinar_reviews', 'creator_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_webinar_reviews_webinar_id', 'webinar_reviews', 'webinar_id', 'webinars', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_webinar_reviews_creator_id', 'webinar_reviews');
        $this->dropForeignKey('fk_webinar_reviews_webinar_id', 'webinar_reviews');
        $this->dropTable('{{%webinar_reviews}}');
    }
}
