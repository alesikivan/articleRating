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
use app\assets\MyClassAsset;
use app\assets\AppAsset;
use yii\db\Query;
use app\assets\AdminAsset;
use yii\web\NotFoundHttpException;


class PageController extends Controller


{

    public function actionIndex()
    {

        $myUserId = Yii::$app->user->id;
        $user = Users::find()->where(['id' => $myUserId])->one();
        $model = Category::find()->all();
        $modelForGuest = Category::find()->where(['status' => 'guest'])->all();
        $modelForUser = Category::find()->where(['status' => 'user'])->all();
        $modelForUser = array_merge($modelForUser, $modelForGuest);

        if($myUserId == null)
        {
          $query = Category::find()->where(['status' => ['guest', ''] ]);
        }else if($user->access == 'user')
        {
          $query = Category::find()->where(['status' => ['user', 'guest', '']]);
        }else if($user->access == 'admin')
        {
          $query = Category::find();
        }
        // ->orderBy('id DESC')
        // get the total number of articles (but do not fetch the article data yet)
        $count = clone $query;

        // create a pagination object with the total count
        $pagination = new Pagination(['totalCount' => $count->count(), 'pageSize' => 10, 'pageSizeParam' => false]);
        // var_dump($count->count());die;

        // limit the query using the pagination and retrieve the articles
        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

            return $this->render('index', [
              'articles' => $articles,
              'pagination' => $pagination,
            ]);
    }


    public function actionCategory($slug)
    {

      $sort = new Sort([
          'attributes' => [
              'rating' => [
                  'asc' => ['rating' => SORT_ASC, 'rating' => SORT_ASC],
                  'desc' => ['rating' => SORT_DESC, 'rating' => SORT_DESC],
                  'default' => SORT_DESC,
                  'label' => 'Rating',
              ],
              'update_date' => [
                  'asc' => ['date_update' => SORT_ASC, 'date_update' => SORT_ASC],
                  'desc' => ['date_update' => SORT_DESC, 'date_update' => SORT_DESC],
                  'default' => SORT_DESC,
                  'label' => 'Update date',
              ],
              'date' => [
                  'asc' => ['date_create' => SORT_ASC, 'date_create' => SORT_ASC],
                  'desc' => ['date_create' => SORT_DESC, 'date_create' => SORT_DESC],
                  'default' => SORT_DESC,
                  'label' => 'Date',
              ],
              'title' => [
                  'asc' => ['title' => SORT_ASC, 'title' => SORT_ASC],
                  'desc' => ['title' => SORT_DESC, 'title' => SORT_DESC],
                  'default' => SORT_DESC,
                  'label' => 'Title',
              ],
          ],
      ]);


      $myUserId = Yii::$app->user->id;
      $model = Category::find()->where(['slug' => $slug])->one();
      $article = $model->articles;
      $user = Users::find()->where(['id' => $myUserId])->one();
      // $query = $model->getArticles()->orderBy($sort->orders);

      if($myUserId != null)
      {
           if($model->status == 'admin' && $user->access == 'user'){
                throw new NotFoundHttpException('404 Error');
           }
      }else{
           if($model->status == 'admin' && $myUserId == null)
           {
                throw new NotFoundHttpException('404 Error');
           }elseif($model->status == 'user' && $myUserId == null ){
                throw new NotFoundHttpException('404 Error');
           }
      }



      // сортировка пользователей
      if($myUserId == null)
      {
        $query = (new \yii\db\Query())
            ->from('article')
            ->where(['status' => 'guest', 'category_title' => $model->title])->orderBy($sort->orders);
      }else if($user->access == 'user')
      {
        // $query = Category::find()->where(['status' => ['user', 'guest']]);
        $query = (new \yii\db\Query())
            ->from('article')
            ->where(['status' => ['user', 'guest'], 'category_title' => $model->title])->orderBy($sort->orders);
      }else if($user->access == 'admin')
      {
        $query = (new \yii\db\Query())
            ->from('article')->where(['category_title' => $model->title])->orderBy($sort->orders);
      }


      $count = clone $query;

        // create a pagination object with the total count
      $pagination = new Pagination(['totalCount' => $count->count(), 'pageSize' => 10, 'pageSizeParam' => false,]);
        // limit the query using the pagination and retrieve the articles
      $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
      return $this->render('category', [
              'newArticles' => $articles,
              'pagination' => $pagination,
              'sort' =>$sort,
            ]);

    }






    public function actionArticle($slug)
    {
         $myUserId1 = Yii::$app->user->id;
         $model1 = Article::find()->where(['slug' => $slug])->one();
         $user1 = Users::find()->where(['id' => $myUserId1])->one();
         if($myUserId1 != null)
         {
              if($model1->status == 'admin' && $user1->access == 'user'){
                  throw new NotFoundHttpException('404 Error');
            }
       }else {
            if($model1->status == 'admin' && $myUserId1 == null)
            {
                 throw new NotFoundHttpException('404 Error');
            }elseif($model1->status == 'user' && $myUserId1 == null ){
                 throw new NotFoundHttpException('404 Error');
            }
       }

     // begin check article inside category

     $myNewArticle = Article::find()->where(['slug' => $slug])->one();
     $nameOfCategory = $myNewArticle->category_title;
     $myNewCategory = Category::find()->where(['title' => $nameOfCategory])->one();
     if($myUserId1 != null)
     {
          if($myNewCategory->status == 'admin')
          {
               throw new NotFoundHttpException('404 Error');
          }
     }else{
          if($myNewCategory->status == 'admin' || $myNewCategory->status == 'user')
          {
               throw new NotFoundHttpException('404 Error');
          }
     }




    $model = Article::find()->where(['slug'=> $slug])->one();
    $result = (new \yii\db\Query())
         ->from('rating')
         ->where(['page' => $slug])
         ->average('voice');



    // определение id статьи
    $id = $model->id;
    // определение ip пользователя
    $ip = Yii::$app->request->userIP;

    // есть ли в таблице rating пересечения статьи и ip пользователя:
    $rating = Rating::find()->where(['page'=> $slug, 'ip' => $ip])->one();
    // если пользователь нашёлся, то нам нужен его голос
    $style = "default";
    $styleForRating = "rating";

    if($rating == null){
          $result = (new \yii\db\Query())
                  ->from('rating')
                  ->where(['page' => $slug])
                  ->average('voice');
          $stars = round($result);
    }else {
        $stars = $rating->voice;
        $style = "star-active";
        $styleForRating = "new-rating";
    }




    // $className = 'star-active';
    // $newStyle = 'style2';
    // if($rating != null)
    // {
    //   $stars = $rating->voice;
    //   $className = 'new-star-active';
    //   $newStyle = 'style1';
    // }else{
    //   $result = (new \yii\db\Query())
    //       ->from('article')
    //       ->where(['slug' => $slug])
    //       ->average('rating');
    //   $stars = round($result);
    // }
    // // var_dump($stars);die;
    //
    $tags = explode(",", $model->tag_list);
    //
    // $text = '';
    // if(Yii::$app->user->id == null)
    // {
    //   $className = 'special-star-active';
    //   $newStyle = 'style1';
    //   $text = 'Вы не можете голосовать! Сначала зарегистрируйтесь!';
    // }

      return $this->render('article', [
        'stars' => $stars,
        'model' => $model,
        'tags' => $tags,
        'style' => $style,
        'styleForRating' => $styleForRating,
      ]);


    }





    public function actionAlltag()
    {
      $model = Tag::find()->all();
      return $this->render('alltag', ['model' => $model]);
    }

    public function actionTag($slug)
    {
      $tag = Tag::find()->where(['slug' => $slug])->one();
      $articles = Article::find()->all();
      $myUserId = Yii::$app->user->id;
      $user = Users::find()->where(['id' => $myUserId])->one();

      $myArray = [];
      foreach ($articles as $element) {
        $arrayWithArticlesTags = explode(",", $element->tag_list);
        if (in_array($tag->title, $arrayWithArticlesTags)) {
        array_push($myArray, $element->title);
      }
      }



      $myUserId = Yii::$app->user->id;
      $user = Users::find()->where(['id' => $myUserId])->one();

      // существование user

      if($user != null)
      {
        // массив со статьями для user
        $someArrayForUser = [];
        if($user->access == 'user' || $user->access == 'guest')
        {
          foreach ($myArray as $element) {
            $art = Article::find()->where(['title' => $element])->one();
            if($art->status == 'guest' || $art->status == 'user')
            {
              array_push($someArrayForUser, $art);
            }
          }
        }

        $someArrayForAdmin = [];
        if($user->access == 'user' || $user->access == 'guest' || $user->access == 'admin')
        {
          foreach ($myArray as $element) {
            $art = Article::find()->where(['title' => $element])->one();
            if($art->status == 'guest' || $art->status == 'user' || $art->status == 'admin')
            {
              array_push($someArrayForAdmin, $art);
            }
          }
        }
      }else{
        // массив со статьями для guest
        $someArrayForGuest = [];
        if($myUserId == null)
        {
          foreach ($myArray as $element) {
            $art = Article::find()->where(['title' => $element])->one();
            if($art->status == 'guest')
            {
              array_push($someArrayForGuest, $art);
            }
          }
        }
      }









      $result = [];
      if($myUserId == null)
      {
            $result = $someArrayForGuest;
      }else if($user->access == 'user')
      {
            $result = $someArrayForUser;
      }else if($user->access == 'admin')
      {
            $result = $someArrayForAdmin;
      }


      return $this->render('tag', ['tag' => $tag, 'articles' => $result]);
     }

}
