<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string|null $slug
 * @property string|null $title
 * @property string|null $status
 * @property int|null $id_parent
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_parent'], 'integer'],
            [['slug', 'title', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'Slug',
            'title' => 'Title',
            'status' => 'Status',
            'id_parent' => 'Id Parent',
        ];
    }


    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['category_title' => 'title']);
    }





}
