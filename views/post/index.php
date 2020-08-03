<?php if (count($model)): ?>
  <?php foreach ($model as  $element): ?>
      <div class="well">
        <h3><b>Username: </b><?= $element->username ?></h3>
        <p><b>email: </b><?= $element->email ?></p>
      </div>
  <?php endforeach; ?>
<?php endif; ?>
