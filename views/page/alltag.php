<h1>Поиск по тегу:</h1>


<div class="well">
<?php foreach ($model as  $element): ?>
  <a href="../tag/<?=$element->slug ?>" class="btn btn-success"><?php echo $element->title ?></a> <br><br>
<?php endforeach; ?>
</div>
