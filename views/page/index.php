
<?php
use yii\widgets\LinkPager;
 ?>

<?php if(count($articles) > 0) {?>
<div class="well">
<?php foreach ($articles as  $element): ?>
  <a href="http://localhost/basic/web/page/category/<?=$element->slug ?>.html" class="btn btn-primary"><?php echo $element->title ?></a> <br><br>
<?php endforeach; ?>
</div>

<?php
echo LinkPager::widget([
  'pagination' => $pagination,
    'class' => 'pagination',
]);
 ?>

<?php }else {?>
  <h1>Нет доступных категорий :D</h1>
<?php } ?>
