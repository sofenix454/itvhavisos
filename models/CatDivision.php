<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cat_division".
 *
 * @property int $div_id Id
 * @property string $div_nombre Nombre
 * @property string $div_imagen Imagen
 *
 * @property Aviso[] $avisos
 * @property Encargado[] $encargados
 * @property Seguimiento[] $seguimientos
 */
class CatDivision extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cat_division';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['div_nombre', 'div_imagen'], 'required'],
            [['div_nombre'], 'string', 'max' => 50],
            [['div_imagen'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'div_id' => 'Id',
            'div_nombre' => 'Nombre',
            'div_imagen' => 'Imagen',
        ];
    }

    /**
     * Gets query for [[Avisos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvisos()
    {
        return $this->hasMany(Aviso::className(), ['avi_fkdivision' => 'div_id']);
    }

    /**
     * Gets query for [[Encargados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEncargados()
    {
        return $this->hasMany(Encargado::className(), ['enc_fkdivision' => 'div_id']);
    }

    /**
     * Gets query for [[Seguimientos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeguimientos()
    {
        return $this->hasMany(Seguimiento::className(), ['seg_fkdivision' => 'div_id']);
    }
}
