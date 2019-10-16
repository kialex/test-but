<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%words}}`.
 */
class m191016_165659_create_words_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%words}}', [
            'id' => $this->primaryKey(),
            'user_ip' => $this->string()->notNull(),
            'word' => $this->string()->notNull(),
            'created_at' => $this->string()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%words}}');
    }
}
