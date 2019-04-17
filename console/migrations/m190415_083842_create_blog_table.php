<?php

use yii\db\Migration;

/**
 * Handles the creation of table `blog`.
 */
class m190415_083842_create_blog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('blog', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'text' => $this->text(),
            'active' => "ENUM ('yes','no') DEFAULT 'yes'",
            'created_at' => $this->bigInteger(),
            'updated_at' => $this->bigInteger(),
            'sort' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('blog');
        return true;
    }
}
