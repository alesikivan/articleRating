<?php
use app\models\Article;
?>

<?php foreach ($articles as $element): ?>
  <div class="well">
    <h3><b>Название: </b><?= $element->title ?></h3>
    <p><b>Автор: </b><?= $element->author ?></p>
    <p><b>Краткое описание: </b><?= $element->short_content ?></p>
    <a href="../<?=$element->slug ?>.html" class="btn btn-primary">Просмотреть!</a>
  </div>
<?php endforeach; ?>
