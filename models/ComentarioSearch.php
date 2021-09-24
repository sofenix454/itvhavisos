<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Comentario;

/**
 * ComentarioSearch represents the model behind the search form of `app\models\Comentario`.
 */
class ComentarioSearch extends Comentario
{
    public $alumnoNombre;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['com_id', 'com_fkusuario', 'com_fkcomentario'], 'integer'],
            [['com_fecha', 'com_texto', 'com_imagen','alumnoNombre'], 'safe'],
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
        $query = Comentario::find();
        
        // add conditions that should always apply here
        $query->joinwith('comFkusuario');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'com_id',
                'com_fecha',
                'com_texto',
                'com_imagen',
                'com_fkusuario',
                'alumnoNombre' => [
                    'asc' => ['usu_nombre' => SORT_ASC],
                    'desc' => ['usu_nombre' => SORT_DESC],
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
            'com_id' => $this->com_id,
            'com_fecha' => $this->com_fecha,
            'com_fkusuario' => $this->com_fkusuario,
            'com_fkcomentario' => $this->com_fkcomentario,

        ]);

        $query->andFilterWhere(['like', 'com_texto', $this->com_texto])
            ->andFilterWhere(['like', 'usu_nombre', $this->alumnoNombre])
            ->andFilterWhere(['like', 'com_imagen', $this->com_imagen]);

        return $dataProvider;
    }
}
