<?php

use app\modules\admin\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">
    <div class="row">

        <?php $form = ActiveForm::begin(); ?>

        <div class="col-md-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'category_id')->dropDownList(
                ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'name'), ['prompt' => '']
            )->label('Category') ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'status')
                ->dropDownList(
                    Category::getStatusNames()
                ); ?>
        </div>

        <div class="col-md-12">
            <?= $form->field($model, 'content')->textarea(['rows' => 10]) ?>
        </div>

        <div class="col-md-12">
            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
        </div>


        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
