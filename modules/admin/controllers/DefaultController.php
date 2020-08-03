<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use Yii;
use app\models\Article;
use app\models\Tag;
use app\models\Category;
use app\models\ArticleSearch;


/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $category = Category::find()->all();
        return $this->render('index', ['category' => $category]);
    }



    public function actionCategory($id)
    {
        // $category = Category::getOne($id);
        // var_dump($category);die;
        return $this->render('category');
    }


}
