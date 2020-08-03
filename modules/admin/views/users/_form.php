<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(['id' => 'register']); ?>

    <?= $form->field($model, 'username')->textInput(['id' => 'register-username']) ?>

    <?= $form->field($model, 'email')->textInput(['id' => 'register-email']) ?>

    <?= $form->field($model, 'displayname')->textInput(['id' => 'register-displayname']) ?>

    <?= $form->field($model, 'password')->passwordInput(['id' => 'register-password']) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
