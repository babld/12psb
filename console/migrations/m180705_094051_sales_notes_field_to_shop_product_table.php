<?php

use yii\db\Migration;

/**
 * Class m180705_094051_sales_notes_field_to_shop_product_table
 */
class m180705_094051_sales_notes_field_to_shop_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_product', 'sales_notes', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180705_094051_sales_notes_field_to_shop_product_table cannot be reverted.\n";
        $this->dropColumn('shop_product', 'sales_notes');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180705_094051_sales_notes_field_to_shop_product_table cannot be reverted.\n";

        return false;
    }
    */
}
