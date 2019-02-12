<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 12.02.2019
 * Time: 15:41
 */

namespace app\modules\admin\models\forms;


use app\models\Post;
use app\modules\admin\models\Category;
use app\modules\admin\models\User;

class PostForm extends Post
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
            [['title', 'author_id', 'category_id'], 'required'],
            [['content'], 'string'],
            [['status', 'category_id'], 'integer'],
            [['title', 'slug', 'description'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }
}