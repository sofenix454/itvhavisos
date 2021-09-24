<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aviso".
 *
 * @property int $avi_id Id
 * @property string $avi_titulo Titulo
 * @property string $avi_texto Texto
 * @property string|null $avi_imagen Imagen
 * @property string $avi_creacion Creación
 * @property string $avi_publicacion Publicación
 * @property string $avi_terminacion Terminación
 * @property int $avi_fkdivision División
 *
 * @property CatDivision $aviFkdivision
 * @property ComentarioAviso[] $comentarioAvisos
 * @property Comentario[] $comentarios
 * @property Reaccion[] $reaccions
 */
class Aviso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'aviso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['avi_titulo', 'avi_texto', 'avi_creacion', 'avi_publicacion', 'avi_terminacion', 'avi_fkdivision'], 'required'],
            [['avi_texto'], 'string'],
            [['avi_creacion', 'avi_publicacion', 'avi_terminacion'], 'safe'],
            [['avi_fkdivision'], 'integer'],
            [['avi_titulo', 'avi_imagen'], 'string', 'max' => 100],
            [['avi_fkdivision'], 'exist', 'skipOnError' => true, 'targetClass' => CatDivision::className(), 'targetAttribute' => ['avi_fkdivision' => 'div_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'avi_id' => 'Id',
            'avi_titulo' => 'Titulo',
            'avi_texto' => 'Texto',
            'avi_imagen' => 'Imagen',
            'avi_creacion' => 'Creación',
            'avi_publicacion' => 'Publicación',
            'avi_terminacion' => 'Terminación',
            'avi_fkdivision' => 'División',
            'divisionNombre' => 'Division'
        ];
    }

    /**
     * Gets query for [[AviFkdivision]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAviFkdivision()
    {
        return $this->hasOne(CatDivision::className(), ['div_id' => 'avi_fkdivision']);
    }

    /**
     * Gets query for [[ComentarioAvisos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarioAvisos()
    {
        return $this->hasMany(ComentarioAviso::className(), ['comavi_fkaviso' => 'avi_id']);
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentario::className(), ['com_fkaviso' => 'avi_id']);
    }

    /**
     * Gets query for [[Reaccions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReaccions()
    {
        return $this->hasMany(Reaccion::className(), ['rea_fkaviso' => 'avi_id']);
    }
    public function getDivisionNombre()
    {
        return $this->aviFkdivision->div_nombre;

    }
}