<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(['id' => 'w0']); ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true, 'id' => 'article-author']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'id' => 'article-title']) ?>

    <label>Category</label>
    <?= Html::dropDownList('category_title', $newselectedCategory, $newcategories, ['class' => 'form-control',  'id' => 'article-category_title']) ?>

   <?= $form->field($model, 'slug')->textInput(['maxlength' => true, 'id' => 'article-slug']) ?>

    <label>Tags</label>
    <?= Html::dropDownList('tag_list', $newselectedTags, $newTags, ['class' => 'form-control', 'multiple' => true, 'id' => 'article-tags']) ?>

    <?= $form->field($model, 'date_create')->textInput() ?>

    <?= $form->field($model, 'date_update')->textInput() ?>

    <label>Status</label>
    <?= Html::dropDownList('status', $newResult, $newStatus_list, ['class' => 'form-control',  'id' => 'article-status']) ?>

    <?= $form->field($model, 'short_content')->textInput(['maxlength' => true, 'id' => 'article-short_content']) ?>

    <?= $form->field($model, 'rating')->textInput(['id' => 'article-rating']) ?>
    <?= $form->field($model, 'peoples_voices')->textInput(['id' => 'voice']) ?>

    <?= $form->field($model, 'content')->textInput(['maxlength' => true,  'article-content']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
