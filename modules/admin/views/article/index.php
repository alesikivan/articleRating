<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<style media="screen">
  table, tr, td, th {
    border: 1px solid black;
    text-align: center;
  }
  table{
    width: 100%;
  }
  .blue{
    background-color: blue;
  }
  .green{
    background-color: green;
  }
.red{
  background-color: red;
}
.blue, .green, .red{
  margin-top: 10px;
  margin-bottom: 10px;
}
</style>


<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Article', ['create'], ['class' => 'btn btn-success']) ?>
    </p>



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    // echo GridView::widget([
    //     'dataProvider' => $dataProvider,
    //     'filterModel' => $searchModel,
    //     'columns' => [
    //         ['class' => 'yii\grid\SerialColumn'],
    //
    //         'id',
    //         'author',
    //         'slug',
    //         'category_title',
    //         'title',
    //         'tag_list',
    //         'date_create',
    //         'date_update',
    //         'status',
    //         'short_content',
    //         'rating',
    //         'content',
    //         'peoples_voices',
    //
    //         ['class' => 'yii\grid\ActionColumn'],
    //     ],
    // ]);
     ?>
<?php
  $counter = 0;
 ?>
      <table>
        <tr>
              <th>#</th>
              <th>ID</th>
              <th>Title</th>
              <th>Author</th>
              <th>CRUD</th>
        </tr>
           <?php foreach ($articles as $element): ?>
             <tr>
                       <th><?=$counter?></th>
                       <th><?=$element->id?></th>
                       <th><?=$element->title?></th>
                       <th><?=$element->author?></th>
                       <th>
                         <p>
                            <?= Html::a('View', ['view', 'id' => $element->id], ['class' => 'btn btn-primary green']) ?>
                             <?= Html::a('Update', ['update', 'id' => $element->id], ['class' => 'btn btn-primary blue']) ?>
                             <?= Html::a('Delete', ['delete', 'id' => $element->id], [
                                 'class' => 'btn btn-danger',
                                 'data' => [
                                     'confirm' => 'Are you sure you want to delete this item?',
                                     'method' => 'post',
                                 ],
                             ]) ?>
                         </p>
                       </th>
            </tr>
            <?php $counter++; ?>
           <?php endforeach; ?>
      </table>



     <?php
     echo LinkPager::widget([
       'pagination' => $pagination,
       'class' => 'pagination',
     ]);
      ?>
</div>
