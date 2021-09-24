<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "integrante".
 *
 * @property int $int_id Id
 * @property string $int_ingreso Fecha de ingreso
 * @property int $int_fkgrupo Grupo
 * @property int $int_fkalumno Alumno
 *
 * @property Alumno $intFkalumno
 * @property Grupo $intFkgrupo
 */
class Integrante extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'integrante';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['int_ingreso', 'int_fkgrupo', 'int_fkalumno'], 'required'],
            [['int_ingreso'], 'safe'],
            [['int_fkgrupo', 'int_fkalumno'], 'integer'],
            [['int_fkgrupo'], 'exist', 'skipOnError' => true, 'targetClass' => Grupo::className(), 'targetAttribute' => ['int_fkgrupo' => 'gru_id']],
            [['int_fkalumno'], 'exist', 'skipOnError' => true, 'targetClass' => Alumno::className(), 'targetAttribute' => ['int_fkalumno' => 'alu_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'int_id' => 'Id',
            'int_ingreso' => 'Fecha de ingreso',
            'int_fkgrupo' => 'Grupo',
            'int_fkalumno' => 'Alumno',
        ];
    }

    /**
     * Gets query for [[IntFkalumno]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIntFkalumno()
    {
        return $this->hasOne(Alumno::className(), ['alu_id' => 'int_fkalumno']);
    }

    /**
     * Gets query for [[IntFkgrupo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIntFkgrupo()
    {
        return $this->hasOne(Grupo::className(), ['gru_id' => 'int_fkgrupo']);
    }
}
