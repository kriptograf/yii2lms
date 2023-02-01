<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%feature_webinars}}`.
 */
class m230131_175757_create_feature_webinars_table extends Migration
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

        $this->createTable('{{%feature_webinars}}', [
            'id'          => $this->primaryKey(),
            'webinar_id'  => $this->integer(),
            'page'        => $this->string(), // -- 'categories', 'home', 'home_categories'
            'description' => $this->text(),
            'status'      => $this->string(), // -- 'publish', 'pending'
            'created_at'  => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'  => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->createIndex('idx_feature_webinars_webinar_id', 'feature_webinars', 'webinar_id');
        $this->addForeignKey('fk_feature_webinars_webinar_id', 'feature_webinars', 'webinar_id', 'webinars', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_feature_webinars_webinar_id', 'feature_webinars');
        $this->dropForeignKey('fk_feature_webinars_webinar_id', 'feature_webinars');
        $this->dropTable('{{%feature_webinars}}');
    }
}
