<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_review`.
 */
class m180529_053401_create_product_review_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product_review', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer(11)->notNull(),
            'name' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'fullname' => $this->string(255),
            'message' => $this->string()->notNull(),
            'phone' => $this->string(255)->notNull(),
            'is_active' => "ENUM ('yes','no') DEFAULT 'no'",
            'created_at' => $this->integer(11),
            'company' => $this->string(255)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('product_review');
        return true;
    }
}
