<?php

use yii\db\Migration;

/**
 * Class m181228_031038_lat_lon_fields_to_contact_table
 */
class m181228_031038_lat_lon_fields_to_contact_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('contact', 'lat', $this->string(255)->notNull());
        $this->addColumn('contact', 'lon', $this->string(255)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181228_031038_lat_lon_fields_to_contact_table cannot be reverted.\n";
        $this->dropColumn('contact', 'lat');
        $this->dropColumn('contact', 'lon');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181228_031038_lat_lon_fields_to_contact_table cannot be reverted.\n";

        return false;
    }
    */
}
