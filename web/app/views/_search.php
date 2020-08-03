<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SPageModelSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="spage-model-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'author') ?>

    <?= $form->field($model, 'slug') ?>

    <?= $form->field($model, 'category') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'tags') ?>

    <?php // echo $form->field($model, 'dateCreation') ?>

    <?php // echo $form->field($model, 'dateModification') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'shortContent') ?>

    <?php // echo $form->field($model, 'rating') ?>

    <?php // echo $form->field($model, 'content') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
