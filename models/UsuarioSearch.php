<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Usuario;

/**
 * UsuarioSearch represents the model behind the search form of `app\models\Usuario`.
 */
class UsuarioSearch extends Usuario
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usu_id', 'usu_genero', 'usu_fkuser'], 'integer'],
            [['usu_nombre', 'usu_paterno', 'usu_materno', 'usu_foto', 'usu_telefono'], 'safe'],
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
        $query = Usuario::find();

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
            'usu_id' => $this->usu_id,
            'usu_genero' => $this->usu_genero,
            'usu_fkuser' => $this->usu_fkuser,
        ]);

        $query->andFilterWhere(['like', 'usu_nombre', $this->usu_nombre])
            ->andFilterWhere(['like', 'usu_paterno', $this->usu_paterno])
            ->andFilterWhere(['like', 'usu_materno', $this->usu_materno])
            ->andFilterWhere(['like', 'usu_foto', $this->usu_foto])
            ->andFilterWhere(['like', 'usu_telefono', $this->usu_telefono]);

        return $dataProvider;
    }
}
