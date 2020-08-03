<?php

namespace app\modules\adminka\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\adminka\models\PageModel;

/**
 * PageModelSearch represents the model behind the search form of `app\modules\adminka\models\PageModel`.
 */
class PageModelSearch extends PageModel
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
    public function rules()
    {
        return [
            [['id', 'rating'], 'integer'],
            [['author', 'slug', 'category', 'title', 'tags', 'dateCreation', 'dateModification', 'status', 'shortContent', 'content'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PageModel::find();

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'dateCreation' => $this->dateCreation,
            'dateModification' => $this->dateModification,
            'rating' => $this->rating,
        ]);

        $query->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'shortContent', $this->shortContent])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }



}
