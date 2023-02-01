<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sales_log}}`.
 */
class m230201_151748_create_sales_log_table extends Migration
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

        $this->createTable('{{%sales_log}}', [
            'id'        => $this->primaryKey(),
            'sale_id'   => $this->integer(),
            'viewed_at' => $this->dateTime(),
        ], $tableOptions);

        $this->addForeignKey('fk_sales_log_sale_id', 'sales_log', 'sale_id', 'sales', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_sales_log_sale_id', 'sales_log');
        $this->dropTable('{{%sales_log}}');
    }
}
