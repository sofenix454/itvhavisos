<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seguimiento".
 *
 * @property int $seg_id Id
 * @property int $seg_fkdivision División
 * @property int $seg_fkalumno Alumno
 *
 * @property Alumno $segFkalumno
 * @property CatDivision $segFkdivision
 */
class Seguimiento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seguimiento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['seg_fkdivision', 'seg_fkalumno'], 'required'],
            [['seg_fkdivision', 'seg_fkalumno'], 'integer'],
            [['seg_fkalumno'], 'exist', 'skipOnError' => true, 'targetClass' => Alumno::className(), 'targetAttribute' => ['seg_fkalumno' => 'alu_id']],
            [['seg_fkdivision'], 'exist', 'skipOnError' => true, 'targetClass' => CatDivision::className(), 'targetAttribute' => ['seg_fkdivision' => 'div_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'seg_id' => 'Id',
            'seg_fkdivision' => 'División',
            'seg_fkalumno' => 'Alumno',
        ];
    }

    /**
     * Gets query for [[SegFkalumno]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSegFkalumno()
    {
        return $this->hasOne(Alumno::className(), ['alu_id' => 'seg_fkalumno']);
    }

    /**
     * Gets query for [[SegFkdivision]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSegFkdivision()
    {
        return $this->hasOne(CatDivision::className(), ['div_id' => 'seg_fkdivision']);
    }
}
