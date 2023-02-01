<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subscribes}}`.
 */
class m230131_192239_create_subscribes_table extends Migration
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

        $this->createTable('{{%subscribes}}', [
            'id'           => $this->primaryKey(),
            'title'        => $this->string(),
            'usable_count' => $this->integer(),
            'days'         => $this->integer(),
            'price'        => $this->integer(),
            'icon'         => $this->string(),
            'description'  => $this->string()->null(),
            'is_popular'   => $this->boolean()->defaultValue(false),
            'created_at'   => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
            'updated_at'   => $this->dateTime()->defaultValue(new \yii\db\Expression('now()')),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%subscribes}}');
    }
}
