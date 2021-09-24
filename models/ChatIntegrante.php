<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chat_integrante".
 *
 * @property int $chaInt_id Id
 * @property int $chaInt_fkchat Chat
 * @property int $chaInt_fkusuario Usuario
 *
 * @property Chat $chaIntFkchat
 * @property Usuario $chaIntFkusuario
 */
class ChatIntegrante extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat_integrante';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['chaInt_id', 'chaInt_fkchat', 'chaInt_fkusuario'], 'required'],
            [['chaInt_id', 'chaInt_fkchat', 'chaInt_fkusuario'], 'integer'],
            [['chaInt_id'], 'unique'],
            [['chaInt_fkchat'], 'exist', 'skipOnError' => true, 'targetClass' => Chat::className(), 'targetAttribute' => ['chaInt_fkchat' => 'cha_id']],
            [['chaInt_fkusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['chaInt_fkusuario' => 'usu_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'chaInt_id' => 'Id',
            'chaInt_fkchat' => 'Chat',
            'chaInt_fkusuario' => 'Usuario',
        ];
    }

    /**
     * Gets query for [[ChaIntFkchat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChaIntFkchat()
    {
        return $this->hasOne(Chat::className(), ['cha_id' => 'chaInt_fkchat']);
    }

    /**
     * Gets query for [[ChaIntFkusuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChaIntFkusuario()
    {
        return $this->hasOne(Usuario::className(), ['usu_id' => 'chaInt_fkusuario']);
    }
}
