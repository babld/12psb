<?php

use yii\db\Migration;

/**
 * Handles the creation of table `page`.
 */
class m181218_055704_create_page_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('page', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'short_text' => $this->text(),
            'text' => $this->text(),
            'active' => "ENUM ('yes','no') DEFAULT 'yes'",
            'slug' => $this->string(255),
            'type' => $this->string(255)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('page');
        return true;
    }
}
