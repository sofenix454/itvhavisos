<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chat".
 *
 * @property int $cha_id Id
 *
 * @property ChatIntegrante[] $chatIntegrantes
 * @property Mensaje[] $mensajes
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cha_id' => 'Id',
        ];
    }

    /**
     * Gets query for [[ChatIntegrantes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChatIntegrantes()
    {
        return $this->hasMany(ChatIntegrante::className(), ['chaInt_fkchat' => 'cha_id']);
    }

    /**
     * Gets query for [[Mensajes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMensajes()
    {
        return $this->hasMany(Mensaje::className(), ['men_fkchat' => 'cha_id']);
    }
}
