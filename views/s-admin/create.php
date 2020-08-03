<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SPageModel */

$this->title = 'Создать s-page:';
$this->params['breadcrumbs'][] = ['label' => 'Админка s-page', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spage-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
