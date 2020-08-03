<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\adminka\models\PageModelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Page Models';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-model-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Page Model', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'author',
            'slug',
            'category',
            'title',
            'tags',
            'dateCreation',
            'dateModification',
            'status',
            'shortContent',
            'rating',
            'content',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
