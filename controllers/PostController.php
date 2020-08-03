<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Users;

class PostController extends Controller
{
      public function actionIndex()
      {
        $model = Users::find()->all();
        return $this->render('index', ['model' => $model]);

      }
}
