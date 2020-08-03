<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Article;

/**
 * ArticleSearch represents the model behind the search form of `app\models\Article`.
 */
class ArticleSearch extends Article
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rating', 'peoples_voices'], 'integer'],
            [['author', 'slug', 'category_title', 'title', 'tag_list', 'date_create', 'date_update', 'status', 'short_content', 'content'], 'safe'],
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
        $query = Article::find();

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
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
            'rating' => $this->rating,
            'peoples_voices' => $this->peoples_voices,
            'mark' => $this->mark,
        ]);

        $query->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'category_title', $this->category_title])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'tag_list', $this->tag_list])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'short_content', $this->short_content])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
