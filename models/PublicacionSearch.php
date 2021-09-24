<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Publicacion;

/**
 * PublicacionSearch represents the model behind the search form of `app\models\Publicacion`.
 */
class PublicacionSearch extends Publicacion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pub_id', 'pub_fkalumno', 'pub_fkgrupo'], 'integer'],
            [['pub_fecha', 'pub_texto', 'pub_imagen'], 'safe'],
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
        $query = Publicacion::find();

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
            'pub_id' => $this->pub_id,
            'pub_fecha' => $this->pub_fecha,
            'pub_fkalumno' => $this->pub_fkalumno,
            'pub_fkgrupo' => $this->pub_fkgrupo,
        ]);

        $query->andFilterWhere(['like', 'pub_texto', $this->pub_texto])
            ->andFilterWhere(['like', 'pub_imagen', $this->pub_imagen]);

        return $dataProvider;
    }
}
