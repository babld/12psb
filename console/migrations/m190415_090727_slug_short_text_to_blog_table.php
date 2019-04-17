<?php

use yii\db\Migration;

/**
 * Class m190415_090727_slug_short_text_to_blog_table
 */
class m190415_090727_slug_short_text_to_blog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('blog', 'short_text', $this->text());
        $this->addColumn('blog', 'slug', $this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190415_090727_slug_short_text_to_blog_table cannot be reverted.\n";
        $this->dropColumn('blog', 'short_text');
        $this->dropColumn('blog', 'slug');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190415_090727_slug_short_text_to_blog_table cannot be reverted.\n";

        return false;
    }
    */
}
