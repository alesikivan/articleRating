
<?php
use yii\widgets\LinkPager;
 ?>
 <h4>Сортировка:  <?php echo $sort->link('title') . ' | ' . $sort->link('date'). ' | ' . $sort->link('update_date'). ' | ' . $sort->link('rating'); ?></h4>
 <br>

<?php if(count($newArticles) > 0) {?>
  <?php foreach ($newArticles as $value): ?>
    <div class="well">
      <h3><b>Название: </b><?= $value['title']; ?></h3>
      <p><b>Автор: </b><?=  $value['author']; ?></p>
      <p><b>Краткое описание: </b><?=$value['short_content']; ?></p>
      <a href="/basic/web/page/<?=$value['slug']; ?>.html" class="btn btn-primary">Просмотреть!</a>
    </div>
  <?php endforeach; ?>

  <?php
  echo LinkPager::widget([
    'pagination' => $pagination,
    'class' => 'pagination',
  ]);
   ?>

<?php }else {?>
  <h1>Нет доступных статей :D</h1>
<?php } ?>
