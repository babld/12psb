<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%setting}}`.
 */
class m231122_132700_create_setting_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%setting}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'key' => $this->string(255),
            'value' => $this->string(2048),
            'is_active' => $this->boolean(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%setting}}');
    }
}
