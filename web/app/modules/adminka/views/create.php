<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\adminka\models\PageModel */

$this->title = 'Create Page Model';
$this->params['breadcrumbs'][] = ['label' => 'Page Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
