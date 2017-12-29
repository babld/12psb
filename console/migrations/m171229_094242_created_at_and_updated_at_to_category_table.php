<?php

use yii\db\Migration;

class m171229_094242_created_at_and_updated_at_to_category_table extends Migration
{
    public function up()
    {
        $this->addColumn('shop_category', 'created_at',  $this->integer());
        $this->addColumn('shop_category', 'updated_at',  $this->integer());
    }

    public function down()
    {
        echo "m171229_094242_created_at_and_updated_at_to_category_table cannot be reverted.\n";
        $this->dropColumn('shop_category', 'created_at');
        $this->dropColumn('shop_category', 'updated_at');
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
