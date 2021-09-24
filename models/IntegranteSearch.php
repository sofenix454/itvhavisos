<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Integrante;

/**
 * IntegranteSearch represents the model behind the search form of `app\models\Integrante`.
 */
class IntegranteSearch extends Integrante
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['int_id', 'int_fkgrupo', 'int_fkalumno'], 'integer'],
            [['int_ingreso'], 'safe'],
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
        $query = Integrante::find();

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
            'int_id' => $this->int_id,
            'int_ingreso' => $this->int_ingreso,
            'int_fkgrupo' => $this->int_fkgrupo,
            'int_fkalumno' => $this->int_fkalumno,
        ]);

        return $dataProvider;
    }
}
