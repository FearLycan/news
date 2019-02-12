<?php

use app\modules\admin\models\Category;
use app\modules\admin\models\Post;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\searches\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">
    <?php Pjax::begin(); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left">
                        <i class="fa fa-bars" aria-hidden="true"></i> Post List
                    </h3>

                    <div class="btn-group pull-right">
                        <a href="<?= Url::to(['create']) ?>" class="btn btn-success btn-sm">Add new</a>
                    </div>
                </div>

                <div class="panel-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute' => 'title',
                                'format' => 'raw',
                                'value' => function ($data) {
                                    /* @var Post $data */
                                    return Html::a($data->title, ['post/view', 'id' => $data->id]);
                                },
                            ],
                            [
                                'attribute' => 'category_id',
                                'label' => 'Category',
                                'format' => 'raw',
                                'filter' => ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'name'),
                                'value' => function ($data) {
                                    /* @var Post $data */
                                    return Html::a($data->category->name, ['category/view', 'id' => $data->category_id]);
                                },
                            ],
                            [
                                'attribute' => 'author',
                                'format' => 'raw',
                                'value' => function ($data) {
                                    /* @var Post $data */
                                    return Html::a($data->author->name, ['user/view', 'id' => $data->author_id]);
                                },
                                'contentOptions' => ['style' => 'width: 150px;'],
                            ],
                            [
                                'attribute' => 'status',
                                'filter' => Post::getStatusNames(),
                                'value' => function ($data) {
                                    /* @var Post $data */
                                    return $data->getStatusName();
                                },
                                'contentOptions' => ['style' => 'width: 150px;'],
                            ],
                            [
                                'attribute' => 'created_at',
                                'contentOptions' => ['style' => 'width: 155px;'],
                            ],

                            [
                                'class' => 'yii\grid\ActionColumn',
                                'contentOptions' => ['style' => 'width: 110px'],
                                'template' => '{new_action1} {new_action2}',
                                'buttons' => [
                                    'new_action1' => function ($url, $model, $key) {
                                        return Html::a(
                                            'Edit',
                                            ['update', 'id' => $model->id],
                                            ['title' => 'Edytuj', 'class' => 'btn btn-primary btn-xs']
                                        );
                                    },
                                    'new_action2' => function ($url, $model, $key) {
                                        return Html::a(
                                            'Delete',
                                            ['delete', 'id' => $model->id],
                                            [
                                                'title' => 'Delete', 'class' => 'btn btn-danger btn-xs',
                                                'data' => [
                                                    'confirm' => 'Are you sure you want to delete this item?',
                                                    'method' => 'post',
                                                ],
                                            ]
                                        );
                                    },
                                ],
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
