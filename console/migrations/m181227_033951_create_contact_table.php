<?php

use yii\db\Migration;

/**
 * Handles the creation of table `contact`.
 */
class m181227_033951_create_contact_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('contact', [
            'id' => $this->primaryKey(),
            'city' => $this->string(255)->notNull(),
            'code' => $this->string(255)->notNull(),
            'address' => $this->string(255)->notNull(),
            'phone' => $this->string(255)->notNull(),
            'active' => "ENUM ('yes','no') DEFAULT 'yes'",
            'sort' => $this->integer(11)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('contact');
        return true;
    }
}
