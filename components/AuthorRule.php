<?php

namespace app\components;

use yii\rbac\Rule;
use app\models\Article;
use app\models\Users;
use app\models\Tag;
use app\models\Category;
/**
 * Проверяем authorID на соответствие с пользователем, переданным через параметры
 */
class AuthorRule extends Rule
{
    public $name = 'isAuthor';
    public $result;

    /**
     * @param string|int $user the user ID.
     * @param Item $item the role or permission that this rule is associated width.
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {

        $articleID = $params['postModel']->id;

        $article = Article::find()->where(['id' => $articleID])->one();
        $articleStatus = $article->status;



        $_user = Users::find()->where(['id' => $user])->one();
        $status = $_user->status;
        // var_dump($status);die;
        $userStatus1 = $_user->access;
        // var_dump($userStatus1);die;
        if($userStatus1 == 'admin')
        {
          return true;
        }
        if($articleStatus == 'guest' && $userStatus1 == 'user')
        {
            return false;
        }
        return (!($userStatus1 == $articleStatus));
        // return isset($params['post']) ? $params['post']->id == $user : false;
    }
}


 ?>
