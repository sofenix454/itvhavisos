<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mensaje".
 *
 * @property int $men_id Id
 * @property string $men_mensaje Mensaje
 * @property string $men_fechaEnviado Fecha de enviado
 * @property int $men_fkchat Chat
 * @property int $men_fkusuario Usuario
 *
 * @property Chat $menFkchat
 * @property Usuario $menFkusuario
 */
class Mensaje extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mensaje';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['men_mensaje', 'men_fechaEnviado', 'men_fkchat', 'men_fkusuario'], 'required'],
            [['men_mensaje'], 'string'],
            [['men_fechaEnviado'], 'safe'],
            [['men_fkchat', 'men_fkusuario'], 'integer'],
            [['men_fkusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['men_fkusuario' => 'usu_id']],
            [['men_fkchat'], 'exist', 'skipOnError' => true, 'targetClass' => Chat::className(), 'targetAttribute' => ['men_fkchat' => 'cha_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'men_id' => 'Id',
            'men_mensaje' => 'Mensaje',
            'men_fechaEnviado' => 'Fecha de enviado',
            'men_fkchat' => 'Chat',
            'men_fkusuario' => 'Usuario',
        ];
    }

    /**
     * Gets query for [[MenFkchat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMenFkchat()
    {
        return $this->hasOne(Chat::className(), ['cha_id' => 'men_fkchat']);
    }

    /**
     * Gets query for [[MenFkusuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMenFkusuario()
    {
        return $this->hasOne(Usuario::className(), ['usu_id' => 'men_fkusuario']);
    }
}
