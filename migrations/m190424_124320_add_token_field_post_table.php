<?php

use yii\db\Migration;

/**
 * Class m190424_124320_add_token_field_post_table
 */
class m190424_124320_add_token_field_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%post}}', 'token',
            $this->string()->notNull()->after('content'));

        $this->createIndex('{{%token_post_index}}', '{{%post}}', 'token');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('{{%token_post_index}}', '{{%post}}');
        $this->dropColumn('{{%post}}', 'token');
    }
}
