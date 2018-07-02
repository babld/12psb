<?php

use yii\db\Migration;

/**
 * Handles the creation of table `video`.
 */
class m180629_090813_create_video_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('video', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'short_text' => $this->text(),
            'url' => $this->string()->notNull(),
            'active' => "ENUM ('yes','no') DEFAULT 'no'",
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('video');
        return true;
    }
}
