<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m190212_085317_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'description' => $this->string()->null(),
            'content' => $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext'),
            'status' => $this->smallInteger()->defaultValue(0),
            'author_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null()
        ]);

        $this->createIndex('{{%post_created_at_index}}', '{{%post}}', 'created_at');
        $this->createIndex('{{%post_updated_at_index}}', '{{%post}}', 'updated_at');
        $this->createIndex('{{%post_status_index}}', '{{%post}}', 'status');
        $this->createIndex('{{%post_title_index}}', '{{%post}}', 'title');
        $this->createIndex('{{%post_slug_index}}', '{{%post}}', 'slug');

        $this->addForeignKey('{{%post_author_id_fk}}', '{{%post}}', 'author_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('{{%post_category_id_fk}}', '{{%post}}', 'category_id', '{{%category}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%post}}');
    }
}
