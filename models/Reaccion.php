<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reaccion".
 *
 * @property int $rea_id Id
 * @property int $rea_fkalumno Usuario
 * @property int $rea_fkaviso Aviso
 *
 * @property Alumno $reaFkalumno
 * @property Aviso $reaFkaviso
 */
class Reaccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reaccion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rea_fkalumno', 'rea_fkaviso'], 'required'],
            [['rea_fkalumno', 'rea_fkaviso'], 'integer'],
            [['rea_fkalumno'], 'exist', 'skipOnError' => true, 'targetClass' => Alumno::className(), 'targetAttribute' => ['rea_fkalumno' => 'alu_id']],
            [['rea_fkaviso'], 'exist', 'skipOnError' => true, 'targetClass' => Aviso::className(), 'targetAttribute' => ['rea_fkaviso' => 'avi_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rea_id' => 'Id',
            'rea_fkalumno' => 'Usuario',
            'rea_fkaviso' => 'Aviso',
        ];
    }

    /**
     * Gets query for [[ReaFkalumno]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReaFkalumno()
    {
        return $this->hasOne(Alumno::className(), ['alu_id' => 'rea_fkalumno']);
    }

    /**
     * Gets query for [[ReaFkaviso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReaFkaviso()
    {
        return $this->hasOne(Aviso::className(), ['avi_id' => 'rea_fkaviso']);
    }
}
