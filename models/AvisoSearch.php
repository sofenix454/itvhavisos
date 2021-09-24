<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Aviso;

/**
 * AvisoSearch represents the model behind the search form of `app\models\Aviso`.
 */
class AvisoSearch extends Aviso
{
    public $divisionNombre;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['avi_id', 'avi_fkdivision'], 'integer'],
            [['avi_titulo', 'avi_texto', 'avi_imagen', 'avi_creacion', 'avi_publicacion', 'avi_terminacion','divisionNombre'], 'safe'],
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
        $query = Aviso::find();

        // add conditions that should always apply here
        $query->joinWith('aviFkdivision');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->setSort([
            'attributes' => [
                'avi_id',
                'avi_titulo',
                'avi_texto',
                'avi_imagen',
                'avi_creacion',
                'avi_publicacion',
                'avi_terminacion',
                'avi_fkdivision',
                'divisionNombre' => [
                    'asc' => ['div_nombre' => SORT_ASC],
                    'desc' => ['div_nombre' => SORT_DESC],
                    'default' => SORT_ASC,
                ]

            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'avi_id' => $this->avi_id,
            'avi_creacion' => $this->avi_creacion,
            'avi_publicacion' => $this->avi_publicacion,
            'avi_terminacion' => $this->avi_terminacion,
            'avi_fkdivision' => $this->avi_fkdivision,
        ]);

        $query->andFilterWhere(['like', 'avi_titulo', $this->avi_titulo])
            ->andFilterWhere(['like', 'avi_texto', $this->avi_texto])
            ->andFilterWhere(['like', 'div_nombre', $this->divisionNombre])
            ->andFilterWhere(['like', 'avi_imagen', $this->avi_imagen]);

        return $dataProvider;
    }
}
