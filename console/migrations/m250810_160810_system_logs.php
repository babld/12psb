<?php

use yii\db\Migration;

class m250810_160810_system_logs extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(<<<SQL
                            CREATE TABLE `system_log` (
                               `id` int NOT NULL AUTO_INCREMENT,
                               `module` varchar(255) DEFAULT NULL,
                               `level` varchar(255) DEFAULT NULL,
                               `message` text,
                               `context` json DEFAULT NULL,
                               `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                               PRIMARY KEY (`id`),
                               KEY `system_logs_module_idx` (`module`),
                               KEY `system_logs_log_level_idx` (`level`),
                               KEY `system_logs_message_idx` (`message`(256))
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
SQL);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%system_log}}');
    }
}
