<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ComentarioAviso;

/**
 * ComentarioAvisoSearch represents the model behind the search form of `app\models\ComentarioAviso`.
 */
class ComentarioAvisoSearch extends ComentarioAviso
{
    public $comentarioTexto;
    public $alumnoComentario;
    public $avisoDivision;
    public $avisoTitulo;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comavi_id', 'comavi_fkcomentario', 'comavi_fkaviso'], 'integer'],
            [['comentarioTexto','alumnoComentario','avisoDivision','avisoTitulo'], 'safe'],
        
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
        $query = ComentarioAviso::find();

        // add conditions that should always apply here
        $query->joinwith(['comaviFkcomentario', 'comaviFkcomentario.comFkusuario','comaviFkaviso.aviFkdivision', 'comaviFkaviso']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->setSort([
            'attributes' => [
                'comavi_id',
                'comavi_fkcomentario',
                'comavi_fkaviso',
                'alumnoComentario' => [
                    'asc' => ['usu_nombre' => SORT_ASC],
                    'desc' => ['usu_nombre' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'avisoDivision' => [
                    'asc' => ['div_nombre' => SORT_ASC],
                    'desc' => ['div_nombre' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'avisoTitulo' => [
                    'asc' => ['avi_titulo' => SORT_ASC],
                    'desc' => ['avi_titulo' => SORT_DESC],
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
            'comavi_id' => $this->comavi_id,
            'comavi_fkcomentario' => $this->comavi_fkcomentario,
            'comavi_fkaviso' => $this->comavi_fkaviso,
        ]);
        $query->andFilterWhere(['like', 'com_texto', $this->comentarioTexto])
        ->andFilterWhere(['like', 'usu_nombre', $this->alumnoComentario])
        ->andFilterWhere(['like', 'avi_titulo', $this->avisoTitulo])
        ->andFilterWhere(['like', 'div_nombre', $this->avisoDivision]);

        return $dataProvider;
    }
}
