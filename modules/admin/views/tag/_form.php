<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tag-form">

    <?php $form = ActiveForm::begin(['id' => 'w0']); ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true, 'id' => 'tag-slug']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'id' => 'tag-title']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
