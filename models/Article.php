<?php

namespace app\models;

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
class Article extends \yii\db\ActiveRecord
{
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
            [['date_create', 'date_update'], 'safe'],
            [['rating'], 'integer'],
            [['mark'], 'integer'],
            [['peoples_voices'], 'integer'],
            [['author', 'slug', 'category_title', 'title', 'tag_list', 'status', 'short_content', 'content'], 'string', 'max' => 255],
            // [['date_create'], 'date', 'format' => 'php:Y-m-d'],
            [['date_create'], 'default', 'value' => date('Y-m-d H:i:s')],
            [['date_update'], 'default', 'value' => date('Y-m-d H:i:s')],
            [['rating'], 'default', 'value' => 0],
            [['peoples_voices'], 'default', 'value' => 0],
            [['mark'], 'default', 'value' => 0],
            [['ip_array'], 'default', 'value' => '777,121'],

            //[['dateCreation'], 'default', 'value' => date('Y-m-d-h-m-s')],
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
            'category_title' => 'Category',
            'title' => 'Title',
            'tag_list' => 'Tags',
            'date_create' => 'Date Creation (Y-m-d)',
            'date_update' => 'Date Modification (Y-m-d)',
            'status' => 'Status',
            'short_content' => 'Short Content',
            'rating' => 'Rating',
            'content' => 'Content',
            'peoples_voices' => 'Voices',
            'mark' => 'Mark',
        ];
    }

    public function getCategory()
{
    return $this->hasOne(Category::className(), ['title' => 'category_title']);
}


 public function saveCategory($category_title)
 {
   $this->category_title = $category_title;
   return $this->save(false);

 }

 public function saveCategory2($category_title)
 {
   $this->category_title = $category_title;
   return $this->save();

 }



  public function saveTags($someArray)
  {
      $result = implode(",", $someArray);
    $this->tag_list = $result;
    return $this->save();

  }


 public function getTags()
 {
     return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
         ->viaTable('article_tag', ['article_id' => 'id']);
 }

  public function getSelectedTags()
  {
    $selectedTags = $this->getTags()->select('id')->asArray()->all();   //вытащить все теги связаные с этой статьёй и из них выбрать только их id
    // var_dump($selectedTags);
  }



public function saveStatus($myarray, $array_id)
{
  $this->status = $myarray[$array_id];
  return $this->save();

}


public function saveRating($myarray, $array_id)
{
  $this->status = $myarray[$array_id];
  return $this->save();

}

public static function getSpecialParams2($result)
{
    // $this->peoples_voices = $this->peoples_voices + 1;
    // $this->mark = $this->mark + $result;
    // $rating = round(($this->mark) / ($this->peoples_voices));
    // return $this->save(false);
}


}
