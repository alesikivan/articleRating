<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SPageModel */

$this->title = 'Create S Page Model';
$this->params['breadcrumbs'][] = ['label' => 'S Page Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spage-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
