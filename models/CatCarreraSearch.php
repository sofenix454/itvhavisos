<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CatCarrera;

/**
 * CatCarreraSearch represents the model behind the search form of `app\models\CatCarrera`.
 */
class CatCarreraSearch extends CatCarrera
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['car_id'], 'integer'],
            [['car_clave', 'car_nombre'], 'safe'],
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
        $query = CatCarrera::find();

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
            'car_id' => $this->car_id,
        ]);

        $query->andFilterWhere(['like', 'car_clave', $this->car_clave])
            ->andFilterWhere(['like', 'car_nombre', $this->car_nombre]);

        return $dataProvider;
    }
}
