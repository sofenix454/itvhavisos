<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Mensaje;

/**
 * MensajeSearch represents the model behind the search form of `app\models\Mensaje`.
 */
class MensajeSearch extends Mensaje
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['men_id', 'men_fkchat', 'men_fkusuario'], 'integer'],
            [['men_mensaje', 'men_fechaEnviado'], 'safe'],
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
        $query = Mensaje::find();

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
            'men_id' => $this->men_id,
            'men_fechaEnviado' => $this->men_fechaEnviado,
            'men_fkchat' => $this->men_fkchat,
            'men_fkusuario' => $this->men_fkusuario,
        ]);

        $query->andFilterWhere(['like', 'men_mensaje', $this->men_mensaje]);

        return $dataProvider;
    }
}
