<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = 'Create Article';
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <h1><?= Html::encode($this->title) ?></h1>
<?php $newcategories = $categories;
            $newselectedCategory = $selectedCategory;
            $newselectedTags = $selectedTags;
            $newTags = $tags;
            $newStatus_list = $status_list;
?>
    <?= $this->render('_form', [
        'model' => $model,
        'newcategories' => $newcategories,
        'newselectedCategory' => $newselectedCategory,
        'newselectedTags' => $newselectedTags,
        'newTags' => $newTags,
        'newStatus_list' => $newStatus_list,
    ]) ?>

</div>
