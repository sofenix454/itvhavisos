<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Encargado;

/**
 * EncargadoSearch represents the model behind the search form of `app\models\Encargado`.
 */
class EncargadoSearch extends Encargado
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'enc_fkusuario', 'enc_fkdivision'], 'integer'],
            [['enc_fecha'], 'safe'],
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
        $query = Encargado::find();

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
            'enc_id' => $this->enc_id,
            'enc_fecha' => $this->enc_fecha,
            'enc_fkusuario' => $this->enc_fkusuario,
            'enc_fkdivision' => $this->enc_fkdivision,
        ]);

        return $dataProvider;
    }
}
