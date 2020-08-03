<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "yii_auth.article".
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
class SPageModel extends \yii\db\ActiveRecord
{
  public $id;
  public $author;
  public $slug;
  public $category;
  public $title;
  public $tags;
  public $dateCreation;
  public  $dateModification;
  public $status;
  public $shortContent;
  public $rating;
  public $content;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yii_auth.article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dateCreation', 'dateModification'], 'safe'],
            [['rating'], 'integer'],
            [['author', 'slug', 'category', 'title', 'status', 'shortContent', 'content'], 'string', 'max' => 255],
            ['slug', 'match', 'pattern'=>'/^[a-zA-Z0-9]+$/', 'message'=>'Here must be uniqued format'],
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


    public function optsAnimal()
    {
        $licenses = [
            'dogs',
            'cats',
            'birds',
        ];

        return array_combine($licenses, $licenses);
    }

    public function optsAnimal2()
    {
        $licenses = [
            'dogs',
            'cats',
            'birds',
        ];

        return array_combine($licenses, $licenses);
    }
    public function optsRolles()
    {
        $licenses = [
            'guest',
            'user',
            'admin',
            'link',
        ];

        return array_combine($licenses, $licenses);
    }

}
