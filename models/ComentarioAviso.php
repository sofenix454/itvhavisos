<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comentario_aviso".
 *
 * @property int $comavi_id Id
 * @property int $comavi_fkcomentario Comentario
 * @property int $comavi_fkaviso Aviso
 *
 * @property Aviso $comaviFkaviso
 * @property Comentario $comaviFkcomentario
 */
class ComentarioAviso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentario_aviso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comavi_fkcomentario', 'comavi_fkaviso'], 'required'],
            [['comavi_fkcomentario', 'comavi_fkaviso'], 'integer'],
            [['comavi_fkcomentario'], 'exist', 'skipOnError' => true, 'targetClass' => Comentario::className(), 'targetAttribute' => ['comavi_fkcomentario' => 'com_id']],
            [['comavi_fkaviso'], 'exist', 'skipOnError' => true, 'targetClass' => Aviso::className(), 'targetAttribute' => ['comavi_fkaviso' => 'avi_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'comavi_id' => 'Id',
            'comavi_fkcomentario' => 'Comentario',
            'comavi_fkaviso' => 'Aviso',
            'avisoTitulo' => 'Aviso titulo',
            'comentarioTexto' => 'Texto',
            'avisoDivision' => 'Division',
            'alumnoComentario' => 'Alumno',
            
        ];
    }

    /**
     * Gets query for [[ComaviFkaviso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComaviFkaviso()
    {
        return $this->hasOne(Aviso::className(), ['avi_id' => 'comavi_fkaviso']);
    }

    /**
     * Gets query for [[ComaviFkcomentario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComaviFkcomentario()
    {
        return $this->hasOne(Comentario::className(), ['com_id' => 'comavi_fkcomentario']);
    }

    public function getComentarioTexto()
    {
        return $this->comaviFkcomentario->com_texto;
    }
    public function getAvisoDivision()
    {
        return $this->comaviFkaviso->aviFkdivision->div_nombre;
    }
    public function getAlumnoComentario()
    {
        return $this->comaviFkcomentario->comFkusuario->usu_nombre;
    }
    public function getAvisoTitulo()
    {
        return $this->comaviFkaviso->avi_titulo;
    }
}
