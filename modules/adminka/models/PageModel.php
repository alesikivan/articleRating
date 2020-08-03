<?php

namespace app\modules\adminka\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string|null $author
 * @property string|null $slug
 * @property string|null $category
 * @property string|null $title
 * @property string|null $tags
 * @property string|null $dateCreation
 * @property string|null $dateModification
 * @property string|null $status
 * @property string|null $shortContent
 * @property int|null $rating
 * @property string|null $content
 */
class PageModel extends \yii\db\ActiveRecord
{

// public $category = ['asdcsdc', 'sadcsadc'];


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dateCreation', 'dateModification'], 'safe'],
            [['rating'], 'integer'],
            [['author', 'slug', 'title', 'tags', 'status', 'shortContent', 'content'], 'string', 'max' => 255],
            [['category'], 'required'],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author' => 'Author',
            'slug' => 'Slug',
            'category' => 'Category',
            'title' => 'Title',
            'tags' => 'Tags',
            'dateCreation' => 'Date Creation',
            'dateModification' => 'Date Modification',
            'status' => 'Status',
            'shortContent' => 'Short Content',
            'rating' => 'Rating',
            'content' => 'Content',
        ];
    }

    public function optsCategory()
    {
        $licenses = [
            'dogs',
            'cats',
            'birds',
        ];

        return array_combine($licenses, $licenses);
    }

    public function optsStatus()
    {
        $licenses = [
            'guest',
            'user',
            'admin',
            'link',
        ];

        return array_combine($licenses, $licenses);
    }

    public function normMassiv($someArray)
    {
        return implode(",", $someArray);
    }


}
