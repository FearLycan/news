<?php

use app\modules\admin\models\Category;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\searches\CategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-search">
    <div class="row">

        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'options' => [
                'data-pjax' => 1
            ],
        ]); ?>

        <div class="col-md-4">
            <?= $form->field($model, 'name') ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'status')
                ->dropDownList(
                    Category::getStatusNames(),         // Flat array ('id'=>'label')
                    ['prompt' => 'Pokaż wszystko']    // options
                ); ?>
        </div>

        <?php // echo $form->field($model, 'author_id') ?>

        <?php // echo $form->field($model, 'created_at') ?>

        <?php // echo $form->field($model, 'updated_at') ?>

        <input type="submit" style="position: absolute; left: -9999px"/>

        <?php ActiveForm::end(); ?>

    </div>
</div>

<?php $this->beginBlock('script') ?>
<script>
    $(document).on('change', '#categorysearch-status', function () {
        $(this).closest('form').submit();
    })
</script>
<?php $this->endBlock(); ?>
