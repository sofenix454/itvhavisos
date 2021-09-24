<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comentario_publicacion".
 *
 * @property int $compub_id Id
 * @property int $compub_fkcomentario Comentario
 * @property int $compub_fkpublicacion Publicación
 *
 * @property Comentario $compubFkcomentario
 * @property Publicacion $compubFkpublicacion
 */
class ComentarioPublicacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentario_publicacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['compub_fkcomentario', 'compub_fkpublicacion'], 'required'],
            [['compub_fkcomentario', 'compub_fkpublicacion'], 'integer'],
            [['compub_fkcomentario'], 'exist', 'skipOnError' => true, 'targetClass' => Comentario::className(), 'targetAttribute' => ['compub_fkcomentario' => 'com_id']],
            [['compub_fkpublicacion'], 'exist', 'skipOnError' => true, 'targetClass' => Publicacion::className(), 'targetAttribute' => ['compub_fkpublicacion' => 'pub_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'compub_id' => 'Id',
            'compub_fkcomentario' => 'Comentario',
            'compub_fkpublicacion' => 'Publicación',
            'comentarioTexto' => 'Texto',
            'alumnoComentario' => 'Alumno',
            
        ];
    }

    /**
     * Gets query for [[CompubFkcomentario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompubFkcomentario()
    {
        return $this->hasOne(Comentario::className(), ['com_id' => 'compub_fkcomentario']);
    }

    /**
     * Gets query for [[CompubFkpublicacion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompubFkpublicacion()
    {
        return $this->hasOne(Publicacion::className(), ['pub_id' => 'compub_fkpublicacion']);
    }
    public function getComentarioTexto()
    {
        return $this->compubFkcomentario->com_texto;
    }
    public function getAlumnoComentario()
    {
        return $this->compubFkcomentario->comFkusuario->usu_nombre;
    }
}
