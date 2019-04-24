<?php

use app\models\Category;
use yii\db\Migration;

/**
 * Handles adding parent to table `category`.
 */
class m190424_121338_add_parent_column_to_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%category}}', 'parent_id',
            $this->integer()->defaultValue(Category::MAIN_CATEGORY)->after('description'));

        $this->addColumn('{{%category}}', 'children',
            $this->string()->null()->after('parent_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%category}}', 'childrens');
        $this->dropColumn('{{%category}}', 'parent_id');
    }
}
