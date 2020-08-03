<?php

namespace app\controllers;

use yii\web\Controller;
use Yii;
use app\models\Article;
use app\models\Users;
use app\models\Rating;
use app\models\Tag;
use app\models\Category;
use app\models\ArticleSearch;
use yii\helpers\ArrayHelper;
use yii\web\ForbiddenHttpException;
use mdm\admin\models\User;
use yii\data\Pagination;
use  yii\data\Sort;

class RatingController extends Controller
{
      public function actionVote()
      {
        $model = new Rating();
        if(count(Yii::$app->request->get()) > 0 )
        {
          // Берем slug из массива $_POST - его мы должны отправить с помощью jQuery вместе с голосом
        $slug = Yii::$app->request->get('slug');
        // ищем, есть ли в базе строка с указанным $slug и данным $ip
        $result = Rating::find()->where(['page'=> $slug , 'ip' => Yii::$app->request->userIP])->one();
        if($result == null)
        {
          $article = Article::find()->where(['slug'=> $slug])->one();
          $article->peoples_voices++;
          $article->mark = $article->mark + Yii::$app->request->get('i');
          $article->rating = round($article->mark / $article->peoples_voices);
          $article->save(false);
            $model->page = Yii::$app->request->get('slug');
            $model->voice = Yii::$app->request->get('i');
            $model->ip = Yii::$app->request->get('ip');
            $model->save(false);
        }
        }


        return $this->render('vote');

      }
}
