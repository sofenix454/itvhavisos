<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cat_carrera".
 *
 * @property int $car_id Id
 * @property string $car_clave Clave
 * @property string $car_nombre Nombre
 *
 * @property Alumno[] $alumnos
 */
class CatCarrera extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cat_carrera';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['car_clave', 'car_nombre'], 'required'],
            [['car_clave'], 'string', 'max' => 15],
            [['car_nombre'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'car_id' => 'Id',
            'car_clave' => 'Clave',
            'car_nombre' => 'Nombre',
        ];
    }

    /**
     * Gets query for [[Alumnos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnos()
    {
        return $this->hasMany(Alumno::className(), ['alu_fkcarrera' => 'car_id']);
    }
}
