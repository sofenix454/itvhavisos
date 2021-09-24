<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "encargado".
 *
 * @property int $enc_id Id
 * @property string $enc_fecha Fecha de incio del encargado
 * @property int $enc_fkusuario Usuario
 * @property int $enc_fkdivision División
 *
 * @property CatDivision $encFkdivision
 * @property Usuario $encFkusuario
 */
class Encargado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'encargado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_fecha', 'enc_fkusuario', 'enc_fkdivision'], 'required'],
            [['enc_fecha'], 'safe'],
            [['enc_fkusuario', 'enc_fkdivision'], 'integer'],
            [['enc_fkdivision'], 'exist', 'skipOnError' => true, 'targetClass' => CatDivision::className(), 'targetAttribute' => ['enc_fkdivision' => 'div_id']],
            [['enc_fkusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['enc_fkusuario' => 'usu_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'enc_id' => 'Id',
            'enc_fecha' => 'Fecha de incio del encargado',
            'enc_fkusuario' => 'Usuario',
            'enc_fkdivision' => 'División',
        ];
    }

    /**
     * Gets query for [[EncFkdivision]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEncFkdivision()
    {
        return $this->hasOne(CatDivision::className(), ['div_id' => 'enc_fkdivision']);
    }

    /**
     * Gets query for [[EncFkusuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEncFkusuario()
    {
        return $this->hasOne(Usuario::className(), ['usu_id' => 'enc_fkusuario']);
    }
}
