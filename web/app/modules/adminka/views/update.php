<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\adminka\models\PageModel */

$this->title = 'Update Page Model: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Page Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="page-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
