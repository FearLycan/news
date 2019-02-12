<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left"><i class="fa fa-bars" aria-hidden="true"></i> Post:
                        <strong><?= Html::encode($model->title) ?></strong>
                    </h3>
                    <div class="pull-right">
                        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger btn-sm',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </div>
                </div>
                <div class="panel-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'title',
                            'slug',
                            'description',
                            'content:ntext',
                            [
                                'attribute' => 'status',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return $model->getStatusName();
                                }
                            ],
                            [
                                'label' => 'Author',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return Html::a($model->author->name, ['user/view', 'id' => $model->id]);
                                }
                            ],
                            [
                                'label' => 'Category',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return Html::a($model->category->name, ['category/view', 'id' => $model->category_id]);
                                }
                            ],
                            'created_at',
                            'updated_at',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

