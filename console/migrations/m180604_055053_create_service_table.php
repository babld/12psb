<?php

use yii\db\Migration;

/**
 * Handles the creation of table `service`.
 */
class m180604_055053_create_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('service', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'short_text' => $this->text(),
            'text' => $this->text()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('service');
        return true;
    }
}
