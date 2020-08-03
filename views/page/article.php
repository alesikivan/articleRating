
<?php
  use app\models\Tag;
  use yii\helpers\Html;
 ?>



<style media="screen">
</style>

<div class="well">

            <h3 class="someClass"><b>Title:</b> <?=$model->title;?></h3>
            <h5><b class="default-color">Date of creation:</b> <?=$model->date_create;?></h5>
            <h5><b>Тags: </b>  <?php foreach ($tags as $value): ?>
                <?php $newTag = Tag::find()->where(['title' => $value])->one(); ?>
                <a href="../page/tag/<?= $newTag->slug?>.html"><?php echo $value?>,</a>
              <?php endforeach; ?>
            </h5>
            <h5><b>Content:</b> <?=$model->content;?></h5>

            <!-- Rating start -->
            <h5><b>Rating:</b></h5>
            <br>
            <div id="rating" class="<?=$styleForRating?>">
                      <?php
                          for ($i=5; $i > $stars; $i--) {
                              echo Html::tag("span", "☆", ['value' => $i, 'id' => $i]);
                          }
                          for ($i=$stars; $i > 0; $i--) {
                              echo Html::tag("span", "☆", ['value' => $i, 'class' => $style, 'id' => $i]);
                          }
                      ?>
          </div>

      <!-- Rating end -->

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
var slug ='<?=$model->slug?>';
var ip  ='<?=Yii::$app->request->userIP?>';
</script>
