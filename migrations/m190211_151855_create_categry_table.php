<?php

use yii\db\Migration;

/**
 * Handles the creation of table `categry`.
 */
class m190211_151855_create_categry_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'description' => $this->text()->null(),
            'status' => $this->smallInteger()->defaultValue(0),
            'author_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null()
        ]);

        $this->createIndex('{{%category_created_at_index}}', '{{%category}}', 'created_at');
        $this->createIndex('{{%category_updated_at_index}}', '{{%category}}', 'updated_at');

        $this->createIndex('{{%category_status_index}}', '{{%category}}', 'status');

        $this->addForeignKey('{{%category_author_id_fk}}', '{{%category}}', 'author_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
