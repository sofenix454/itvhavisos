<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grupo".
 *
 * @property int $gru_id Id
 * @property string $gru_nombre Nombre
 * @property int $gru_fkalumno Alumno
 *
 * @property Alumno $gruFkalumno
 * @property Integrante[] $integrantes
 * @property Publicacion[] $publicacions
 */
class Grupo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'grupo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gru_nombre', 'gru_fkalumno'], 'required'],
            [['gru_fkalumno'], 'integer'],
            [['gru_nombre'], 'string', 'max' => 50],
            [['gru_fkalumno'], 'exist', 'skipOnError' => true, 'targetClass' => Alumno::className(), 'targetAttribute' => ['gru_fkalumno' => 'alu_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gru_id' => 'Id',
            'gru_nombre' => 'Nombre',
            'gru_fkalumno' => 'Alumno',
        ];
    }

    /**
     * Gets query for [[GruFkalumno]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGruFkalumno()
    {
        return $this->hasOne(Alumno::className(), ['alu_id' => 'gru_fkalumno']);
    }

    /**
     * Gets query for [[Integrantes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIntegrantes()
    {
        return $this->hasMany(Integrante::className(), ['int_fkgrupo' => 'gru_id']);
    }

    /**
     * Gets query for [[Publicacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacions()
    {
        return $this->hasMany(Publicacion::className(), ['pub_fkgrupo' => 'gru_id']);
    }
}
