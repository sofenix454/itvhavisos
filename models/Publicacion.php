<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publicacion".
 *
 * @property int $pub_id Id
 * @property string $pub_fecha Fecha
 * @property string $pub_texto Texto
 * @property string|null $pub_imagen Imagen
 * @property int $pub_fkalumno Usuario
 * @property int $pub_fkgrupo Grupo
 *
 * @property ComentarioPublicacion[] $comentarioPublicacions
 * @property Alumno $pubFkalumno
 * @property Grupo $pubFkgrupo
 */
class Publicacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publicacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pub_fecha', 'pub_texto', 'pub_fkalumno', 'pub_fkgrupo'], 'required'],
            [['pub_fecha'], 'safe'],
            [['pub_texto'], 'string'],
            [['pub_fkalumno', 'pub_fkgrupo'], 'integer'],
            [['pub_imagen'], 'string', 'max' => 100],
            [['pub_fkalumno'], 'exist', 'skipOnError' => true, 'targetClass' => Alumno::className(), 'targetAttribute' => ['pub_fkalumno' => 'alu_id']],
            [['pub_fkgrupo'], 'exist', 'skipOnError' => true, 'targetClass' => Grupo::className(), 'targetAttribute' => ['pub_fkgrupo' => 'gru_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pub_id' => 'Id',
            'pub_fecha' => 'Fecha',
            'pub_texto' => 'Texto',
            'pub_imagen' => 'Imagen',
            'pub_fkalumno' => 'Usuario',
            'pub_fkgrupo' => 'Grupo',
        ];
    }

    /**
     * Gets query for [[ComentarioPublicacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarioPublicacions()
    {
        return $this->hasMany(ComentarioPublicacion::className(), ['compub_fkpublicacion' => 'pub_id']);
    }

    /**
     * Gets query for [[PubFkalumno]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPubFkalumno()
    {
        return $this->hasOne(Alumno::className(), ['alu_id' => 'pub_fkalumno']);
    }

    /**
     * Gets query for [[PubFkgrupo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPubFkgrupo()
    {
        return $this->hasOne(Grupo::className(), ['gru_id' => 'pub_fkgrupo']);
    }
}
