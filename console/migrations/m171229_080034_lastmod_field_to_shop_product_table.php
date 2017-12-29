<?php

use yii\db\Migration;

class m171229_080034_lastmod_field_to_shop_product_table extends Migration
{
    public function up()
    {
        $this->addColumn('shop_product', 'created_at',  $this->integer());
        $this->addColumn('shop_product', 'updated_at',  $this->integer());
    }

    public function down()
    {
        echo "m171229_080034_lastmod_field_to_shop_product_table cannot be reverted.\n";
        $this->dropColumn('shop_product', 'created_at');
        $this->dropColumn('shop_product', 'updated_at');
        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
