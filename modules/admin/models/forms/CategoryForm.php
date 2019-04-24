<?php

namespace app\modules\admin\models\forms;


use app\modules\admin\models\Category;
use app\modules\admin\models\User;

class CategoryForm extends Category
{
    public function init()
    {
        parent::init();
        $this->author_id = \Yii::$app->user->identity->id;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
            [['description'], 'string'],
            [['parent_id'], 'integer'],
            [['status'], 'in', 'range' => array_keys(self::getStatuses())],
            [['name'], 'string', 'max' => 255],
        ];
    }
}