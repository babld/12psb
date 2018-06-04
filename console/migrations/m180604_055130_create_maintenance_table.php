<?php

use yii\db\Migration;

/**
 * Handles the creation of table `maintenance`.
 */
class m180604_055130_create_maintenance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('maintenance', [
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
        $this->dropTable('maintenance');
        return true;
    }
}
