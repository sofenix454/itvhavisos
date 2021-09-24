<?php

namespace app\models;

use webvimark\modules\UserManagement\models\User;

/**
 * This is the model class for table "usuario".
 *
 * @property int $usu_id Id 
 * @property string $usu_nombre Nombre
 * @property string $usu_paterno Apellido Paterno
 * @property string $usu_materno Apellido Materno
 * @property string $usu_foto Foto
 * @property int $usu_genero Género
 * @property string $usu_telefono Télefono
 * @property int $usu_fkuser User
 *
 * @property Alumno[] $alumnos
 * @property ChatIntegrante[] $chatIntegrantes
 * @property Comentario[] $comentarios
 * @property Encargado[] $encargados
 * @property Mensaje[] $mensajes
 * @property User $usuFkuser
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usu_nombre', 'usu_paterno', 'usu_materno', 'usu_foto', 'usu_genero', 'usu_telefono', 'usu_fkuser'], 'required'],
            [['usu_genero', 'usu_fkuser'], 'integer'],
            [['usu_nombre', 'usu_paterno', 'usu_materno'], 'string', 'max' => 50],
            [['usu_foto'], 'string', 'max' => 100],
            [['usu_telefono'], 'string', 'max' => 15],
            [['usu_fkuser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usu_fkuser' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'usu_id' => 'Id ',
            'usu_nombre' => 'Nombre',
            'usu_paterno' => 'Apellido Paterno',
            'usu_materno' => 'Apellido Materno',
            'usu_foto' => 'Foto',
            'usu_genero' => 'Género',
            'usu_telefono' => 'Télefono',
            'usu_fkuser' => 'User',
        ];
    }

    /**
     * Gets query for [[Alumnos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnos()
    {
        return $this->hasMany(Alumno::className(), ['alu_fkusuario' => 'usu_id']);
    }

    /**
     * Gets query for [[ChatIntegrantes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChatIntegrantes()
    {
        return $this->hasMany(ChatIntegrante::className(), ['chaInt_fkusuario' => 'usu_id']);
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentario::className(), ['com_fkusuario' => 'usu_id']);
    }

    /**
     * Gets query for [[Encargados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEncargados()
    {
        return $this->hasMany(Encargado::className(), ['enc_fkusuario' => 'usu_id']);
    }

    /**
     * Gets query for [[Mensajes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMensajes()
    {
        return $this->hasMany(Mensaje::className(), ['men_fkusuario' => 'usu_id']);
    }

    /**
     * Gets query for [[UsuFkuser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuFkuser()
    {
        return $this->hasOne(User::className(), ['id' => 'usu_fkuser']);
    }
}
