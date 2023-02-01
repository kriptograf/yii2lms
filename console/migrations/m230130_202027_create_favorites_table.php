<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%favorites}}`.
 */
class m230130_202027_create_favorites_table extends Migration
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

        $this->createTable('{{%favorites}}', [
            'id'         => $this->primaryKey(),
            'webinar_id' => $this->integer(),
            'user_id'    => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_favorites_webinar_id', 'favorites', 'webinar_id', 'webinars', 'id', 'CASCADE');
        $this->addForeignKey('fk_favorites_user_id', 'favorites', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_favorites_webinar_id', 'favorites');
        $this->dropForeignKey('fk_favorites_user_id', 'favorites');
        $this->dropTable('{{%favorites}}');
    }
}
