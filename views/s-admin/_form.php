<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SPageModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="spage-model-form">

    <?php $form = ActiveForm::begin(['id' => 'w0']); ?>

    <?= $form->field($model, 'author')->textInput(['id' => 'article-author']) ?>

    <?= $form->field($model, 'slug')->textInput(['id' => 'article-slug']) ?>

    <?= $form->field($model, 'category')->dropDownList($model->optsAnimal(),['id' => 'article-category_title'])?>

    <?= $form->field($model, 'title')->textInput(['id' => 'article-title']) ?>

    <?= $form->field($model, 'tags')->dropDownList($model->optsAnimal2(),['id' => 'article-tags', 'multiple' => true]);
    echo'Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.'.'<br>'.'<br>'.'<br>'; ?>

     <!-- $form->field($model, 'dateCreation')->textInput()
     $form->field($model, 'dateModification')->textInput()  -->



    <?= $form->field($model, 'status')->dropDownList($model->optsRolles(), ['id' => 'article-status']) ?>

    <?= $form->field($model, 'shortContent')->textInput(['id' => 'article-short_content']) ?>

    <?= $form->field($model, 'rating')->textInput(['id' => 'article-rating']) ?>

    <?= $form->field($model, 'content')->textInput(['id' => 'article-content']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
