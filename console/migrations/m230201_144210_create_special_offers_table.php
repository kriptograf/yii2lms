<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%special_offers}}`.
 */
class m230201_144210_create_special_offers_table extends Migration
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

        $this->createTable('{{%special_offers}}', [
            'id'         => $this->primaryKey(),
            'creator_id' => $this->integer(),
            'webinar_id' => $this->integer(),
            'name'       => $this->string(),
            'percent'    => $this->integer(),
            'status'     => $this->boolean()->defaultValue(true),
            'from_date'  => $this->date(),
            'to_date'    => $this->date(),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);

        $this->addForeignKey('fk_special_offers_creator_id', 'special_offers', 'creator_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_special_offers_webinar_id', 'special_offers', 'webinar_id', 'webinars', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_special_offers_creator_id', 'special_offers');
        $this->dropForeignKey('fk_special_offers_webinar_id', 'special_offers');
        $this->dropTable('{{%special_offers}}');
    }
}
