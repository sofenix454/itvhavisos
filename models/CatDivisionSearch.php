<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CatDivision;

/**
 * CatDivisionSearch represents the model behind the search form of `app\models\CatDivision`.
 */
class CatDivisionSearch extends CatDivision
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['div_id'], 'integer'],
            [['div_nombre', 'div_imagen'], 'safe'],
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
        $query = CatDivision::find();

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
            'div_id' => $this->div_id,
        ]);

        $query->andFilterWhere(['like', 'div_nombre', $this->div_nombre])
            ->andFilterWhere(['like', 'div_imagen', $this->div_imagen]);

        return $dataProvider;
    }
}
