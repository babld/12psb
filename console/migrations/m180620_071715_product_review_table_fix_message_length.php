<?php

use yii\db\Migration;

/**
 * Class m180620_071715_product_review_table_fix_message_length
 */
class m180620_071715_product_review_table_fix_message_length extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('product_review', 'message', $this->text()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180620_071715_product_review_table_fix_message_length cannot be reverted.\n";
        $this->alterColumn('product_review', 'message', $this->string()->notNull());
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180620_071715_product_review_table_fix_message_length cannot be reverted.\n";

        return false;
    }
    */
}
