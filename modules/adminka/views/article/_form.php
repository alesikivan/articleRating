<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\modules\adminka\models\PageModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'category')->dropDownList($model->optsCategory(), ['prompt'=>'Status...'])
    echo $form->field($model, 'category')->widget(Select2::classname(), [
        'data' => ['dogs' => "Dogs", 'cats' => "Cats", 'Birds' => "Birds"],
        // 'language' => 'de',
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => [
            'allowClear' => true,
                // 'multiple' => true,
        ],
    ]);
    ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'dateCreation')->textInput() ?>

    <?php //$form->field($model, 'dateModification')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList($model->optsStatus(), ['prompt'=>'Status...']) ?>

    <?= $form->field($model, 'shortContent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rating')->textInput() ?>

    <?= $form->field($model, 'content')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
