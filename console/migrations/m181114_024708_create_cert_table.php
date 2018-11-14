<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cert`.
 */
class m181114_024708_create_cert_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('cert', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'sort' => $this->integer(11),
            'active' => "ENUM ('yes','no') DEFAULT 'yes'"
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('cert');
        return true;
    }
}
