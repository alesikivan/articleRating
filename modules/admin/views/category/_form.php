<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(['id' => 'w0']); ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true, 'id' => 'category-slug']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'id' => 'category-title']) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'id_parent')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
