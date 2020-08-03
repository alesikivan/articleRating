<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Article;
use app\models\Tag;
use app\models\Category;
use app\models\ArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\data\Pagination;
/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        // $searchModel = new ArticleSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $query = Article::find();


        $count = clone $query;

          // create a pagination object with the total count
        $pagination = new Pagination(['totalCount' => $count->count(), 'pageSize' => 10, 'pageSizeParam' => false]);
          // limit the query using the pagination and retrieve the articles
        $articles = $query->offset($pagination->offset)
              ->limit($pagination->limit)
              ->all();
              // var_dump($articles);die;

        return $this->render('index', [
            // 'searchModel' => $searchModel,
            // 'dataProvider' => $dataProvider,
            'articles' => $articles,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      //статус

      $status_list = [
        1 => 'guest',
        2 => 'user',
        3 => 'admin',
        4 => 'link',
      ];


      //категории
        $model = new Article();
        $mainCategory = new Category();
         $selectedCategory = $mainCategory->id;
         $categories =  ArrayHelper::map(Category::find()->all(), 'id', 'title');

         // добавление тегов
         $selectedTags = 1;
         $tags = ArrayHelper::map(Tag::find()->all(), 'id', 'title');
         $arrayIdTags = Yii::$app->request->post('tag_list');
         $getTagsTitle = [];
         if(Yii::$app->request->isPost){
           foreach ($arrayIdTags as  $element) {
             $getTagObj = Tag::findOne([
             'id' => $element,
             ]);
             array_push($getTagsTitle, $getTagObj->title);
           }
                 $result = implode(",", $getTagsTitle);
            $model->saveTags($getTagsTitle);
         }


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          $category = Yii::$app->request->post('category_title');
          $status = Yii::$app->request->post('status');
          $model->saveStatus($status_list, $status);



          $getCategoryObj = Category::findOne([
          'id' => $category,
          ]);
          $getTitle = $getCategoryObj->title;
          $model->saveCategory($getTitle);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'selectedCategory' => $selectedCategory,
             'categories' => $categories,
             'selectedTags' => $selectedTags,
             'tags' => $tags,
             'status_list' => $status_list,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

      $status_list = [
        1 => 'guest',
        2 => 'user',
        3 => 'admin',
        4 => 'link',
      ];
        $model = $this->findModel($id);
        $article_status = Article::findOne([
        'id' => $id,
        ]);
        $newIndexForStatus = $article_status->status;


        function getTrueResult($value, $list)
        {

            foreach ($list as $key => $element) {
              if($value == $element){
                return $key;
              }
            }

        }

        $newmodel = new Article();
        $selectedCategory = $model->category->id;
        $categories =  ArrayHelper::map(Category::find()->all(), 'id', 'title');

        $valueTagListFromArticle =  Article::findOne([
        'id' => $id,
        ]);
        if($valueTagListFromArticle->tag_list != ''){
        $pieces = explode(",", $valueTagListFromArticle->tag_list);

        $newArrayForEqual = [];
        foreach ($pieces as  $value) {
          $valueTag =  Tag::findOne([
          'title' => $value,
          ]);
           array_push($newArrayForEqual, $valueTag->id);
        }


        // изменения тегов
          $selectedTags = $newArrayForEqual;
        }else{
          $selectedTags = 1;
        }
        $tags = ArrayHelper::map(Tag::find()->all(), 'id', 'title');
        $arrayIdTags = Yii::$app->request->post('tag_list');
        $getTagsTitle = [];
        if(Yii::$app->request->isPost){
          foreach ($arrayIdTags as  $element) {
            $getTagObj = Tag::findOne([
            'id' => $element,
            ]);
            array_push($getTagsTitle, $getTagObj->title);
          }
                $result = implode(",", $getTagsTitle);
           $model->saveTags($getTagsTitle);
        }

// var_dump(Yii::$app->request->post());die;
        if ($model->load(Yii::$app->request->post() ) ) {
          $category = Yii::$app->request->post('category_title');
          $status = Yii::$app->request->post('status');
          $model->saveStatus($status_list, $status);
          // var_dump($category);die;
          $getCategoryObj = Category::findOne([
          'id' => $category,
          ]);
          $getTitle = $getCategoryObj->title;
          $model->category_title = $getTitle;
          $model->date_update = date('Y-m-d H:i:s');
          if($model->save())
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $newVar = getTrueResult($newIndexForStatus, $status_list);

        return $this->render('update', [
            'model' => $model,
            'selectedCategory' => $selectedCategory,
             'categories' => $categories,
             'selectedTags' => $selectedTags,
             'tags' => $tags,
             'status_list' => $status_list,
             'result' => $newVar,
        ]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSetCategory($id)
    {
      $article = $this->findModel($id);
      $selectedCategory = $article->category->id;
      $categories =  ArrayHelper::map(Category::find()->all(), 'id', 'title');
      // var_dump($categories);die;
      //var_dump($article->title);
      //var_dump($article->category->title);     Мы можем обращаться к категории через статью, к которой она принадлежит

      //отлавливаем значение из DropDown
      if (Yii::$app->request->isPost) {
        $category = Yii::$app->request->post('category');
        //var_dump($category);die;
        $article->saveCategory($category);
        return $this->redirect(['view', 'id' => $article->id]);
      }


      return $this->render('category', ['article' => $article, 'selectedCategory' => $selectedCategory, 'categories' => $categories]);
    }


    public function actionSetTags($id)
    {
      // $article = $this->findModel($id);
      // var_dump($article->tags);
      // вывод всех тегов одной статьи

      $tags = Tag::findOne(1);
      var_dump($tags->article);

    }

}
