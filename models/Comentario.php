<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comentario".
 *
 * @property int $com_id Id
 * @property string $com_fecha Fecha
 * @property string $com_texto Texto
 * @property string|null $com_imagen Imagen
 * @property int $com_fkusuario Usuario
 * @property int|null $com_fkcomentario Respuesta
 *
 * @property Comentario $comFkcomentario
 * @property Usuario $comFkusuario
 * @property ComentarioAviso[] $comentarioAvisos
 * @property ComentarioPublicacion[] $comentarioPublicacions
 * @property Comentario[] $comentarios
 */
class Comentario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['com_fecha', 'com_texto', 'com_fkusuario'], 'required'],
            [['com_fecha'], 'safe'],
            [['com_texto'], 'string'],
            [['com_fkusuario', 'com_fkcomentario'], 'integer'],
            [['com_imagen'], 'string', 'max' => 100],
            [['com_fkusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['com_fkusuario' => 'usu_id']],
            [['com_fkcomentario'], 'exist', 'skipOnError' => true, 'targetClass' => Comentario::className(), 'targetAttribute' => ['com_fkcomentario' => 'com_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'com_id' => 'Id',
            'com_fecha' => 'Fecha',
            'com_texto' => 'Texto',
            'com_imagen' => 'Imagen',
            'com_fkusuario' => 'Usuario',
            'com_fkcomentario' => 'Respuesta',
            'alumnoNombre' => 'Alumno',
        ];
    }

    /**
     * Gets query for [[ComFkaviso]].
     *
     * @return \yii\db\ActiveQuery
     */
   
    /**
     * Gets query for [[ComFkcomentario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComFkcomentario()
    {
        return $this->hasOne(Comentario::className(), ['com_id' => 'com_fkcomentario']);
    }

    /**
     * Gets query for [[ComFkusuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComFkusuario()
    {
        return $this->hasOne(Usuario::className(), ['usu_id' => 'com_fkusuario']);
    }

    /**
     * Gets query for [[ComentarioAvisos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarioAvisos()
    {
        return $this->hasMany(ComentarioAviso::className(), ['comavi_fkcomentario' => 'com_id']);
    }

    /**
     * Gets query for [[ComentarioPublicacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarioPublicacions()
    {
        return $this->hasMany(ComentarioPublicacion::className(), ['compub_fkcomentario' => 'com_id']);
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentario::className(), ['com_fkcomentario' => 'com_id']);
    }
    public function getAlumnoNombre()
    {
        return $this->comFkusuario->usu_nombre;
    }
}
