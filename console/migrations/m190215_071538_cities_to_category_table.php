<?php

use yii\db\Migration;

class m190215_071538_cities_to_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_category', 'text_omsk', $this->text());
        $this->addColumn('shop_category', 'text_moskva', $this->text());
        $this->addColumn('shop_category', 'text_sankt_peterburg', $this->text());
        $this->addColumn('shop_category', 'text_ekaterinburg', $this->text());
        $this->addColumn('shop_category', 'text_nizhnij_novgorod', $this->text());
        $this->addColumn('shop_category', 'text_kazan', $this->text());
        $this->addColumn('shop_category', 'text_cheljabinsk', $this->text());
        $this->addColumn('shop_category', 'text_rostov_na_donu', $this->text());
        $this->addColumn('shop_category', 'text_ufa', $this->text());
        $this->addColumn('shop_category', 'text_perm', $this->text());
        $this->addColumn('shop_category', 'text_voronezh', $this->text());
        $this->addColumn('shop_category', 'text_volgograd', $this->text());
        $this->addColumn('shop_category', 'text_samara', $this->text());
        $this->addColumn('shop_category', 'text_krasnojarsk', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190215_071538_cities_to_shop_category_table cannot be reverted.\n";
        $this->dropColumn('shop_category', 'text_omsk');
        $this->dropColumn('shop_category', 'text_moskva');
        $this->dropColumn('shop_category', 'text_sankt_peterburg');
        $this->dropColumn('shop_category', 'text_ekaterinburg');
        $this->dropColumn('shop_category', 'text_nizhnij_novgorod');
        $this->dropColumn('shop_category', 'text_kazan');
        $this->dropColumn('shop_category', 'text_cheljabinsk');
        $this->dropColumn('shop_category', 'text_rostov_na_donu');
        $this->dropColumn('shop_category', 'text_ufa');
        $this->dropColumn('shop_category', 'text_perm');
        $this->dropColumn('shop_category', 'text_voronezh');
        $this->dropColumn('shop_category', 'text_volgograd');
        $this->dropColumn('shop_category', 'text_samara');
        $this->dropColumn('shop_category', 'text_krasnojarsk');
        return true;
    }
}
