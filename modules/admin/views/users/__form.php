<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(['id' => 'update']); ?>

    <?= $form->field($model, 'username')->textInput(['id' => 'update-username']) ?>

    <?= $form->field($model, 'email')->textInput(['id' => 'update-email']) ?>

    <?= $form->field($model, 'displayname')->textInput(['id' => 'update-displayname']) ?>

    <?= $form->field($model, 'password')->passwordInput(['id' => 'update-password']) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
