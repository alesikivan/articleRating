<?php use yii\heplers\Html; ?>

<h1>Генератор виджета</h1>

<?php $form=$this->beginWidget('CCodeForm', array('model'=>$model)); ?>

    <div class="row">
    <?php     echo $form->labelEx($model,'className'); ?>
      <?php   echo $form->textField($model,'className',array('size'=>65)); ?>
        <div class="tooltip">
            Класс виджета должен содержать только буквы.
        </div>
      <?php   echo $form->error($model,'className'); ?>
    </div>

 <?php $this->endWidget(); ?>
