<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = 'Update Article: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="article-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php $newcategories = $categories;
                $newselectedCategory = $selectedCategory;
                $newselectedTags = $selectedTags;
                $newTags = $tags;
                $newStatus_list = $status_list;
                $newResult = $result;
    ?>
        <?= $this->render('__form', [
            'model' => $model,
            'newcategories' => $newcategories,
            'newselectedCategory' => $newselectedCategory,
            'newselectedTags' => $newselectedTags,
            'newStatus_list' => $newStatus_list,
            'newTags' => $newTags,
            'newResult' => $newResult
        ]) ?>

</div>
