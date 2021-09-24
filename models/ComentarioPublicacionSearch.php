<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ComentarioPublicacion;

/**
 * ComentarioPublicacionSearch represents the model behind the search form of `app\models\ComentarioPublicacion`.
 */
class ComentarioPublicacionSearch extends ComentarioPublicacion
{
    public $comentarioTexto;
    public $alumnoComentario;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['compub_id', 'compub_fkcomentario', 'compub_fkpublicacion'], 'integer'],
            [['comentarioTexto', 'alumnoComentario'], 'safe'],
            
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
        $query = ComentarioPublicacion::find();

        // add conditions that should always apply here
        $query->joinwith(['compubFkcomentario', 'compubFkcomentario.comFkusuario']);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            
        ]);
        $dataProvider->setSort([
            'attributes' => [
                'compub_id',
                'compub_fkcomentario',
                'compub_fkpublicacion',
                'alumnoComentario' => [
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
            'compub_id' => $this->compub_id,
            'compub_fkcomentario' => $this->compub_fkcomentario,
            'compub_fkpublicacion' => $this->compub_fkpublicacion,
        ]);
        $query->andFilterWhere(['like', 'com_texto', $this->comentarioTexto])
              ->andFilterWhere(['like', 'usu_nombre', $this->alumnoComentario]);

        return $dataProvider;
    }
}
