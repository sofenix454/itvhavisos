<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "alumno".
 *
 * @property int $alu_id Id
 * @property string $alu_matricula Matrícula
 * @property int $alu_semestre Semestre
 * @property int $alu_fkcarrera Carrera
 * @property int $alu_fkusuario Usuario
 *
 * @property CatCarrera $aluFkcarrera
 * @property Usuario $aluFkusuario
 * @property Grupo[] $grupos
 * @property Integrante[] $integrantes
 * @property Publicacion[] $publicacions
 * @property Reaccion[] $reaccions
 * @property Seguimiento[] $seguimientos
 */
class Alumno extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alumno';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alu_matricula', 'alu_semestre', 'alu_fkcarrera', 'alu_fkusuario'], 'required'],
            [['alu_semestre', 'alu_fkcarrera', 'alu_fkusuario'], 'integer'],
            [['alu_matricula'], 'string', 'max' => 12],
            [['alu_fkcarrera'], 'exist', 'skipOnError' => true, 'targetClass' => CatCarrera::className(), 'targetAttribute' => ['alu_fkcarrera' => 'car_id']],
            [['alu_fkusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['alu_fkusuario' => 'usu_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'alu_id' => 'Id',
            'alu_matricula' => 'Matrícula',
            'alu_semestre' => 'Semestre',
            'alu_fkcarrera' => 'Carrera',
            'alu_fkusuario' => 'Usuario',
        ];
    }

    /**
     * Gets query for [[AluFkcarrera]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAluFkcarrera()
    {
        return $this->hasOne(CatCarrera::className(), ['car_id' => 'alu_fkcarrera']);
    }

    /**
     * Gets query for [[AluFkusuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAluFkusuario()
    {
        return $this->hasOne(Usuario::className(), ['usu_id' => 'alu_fkusuario']);
    }

    /**
     * Gets query for [[Grupos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos()
    {
        return $this->hasMany(Grupo::className(), ['gru_fkalumno' => 'alu_id']);
    }

    /**
     * Gets query for [[Integrantes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIntegrantes()
    {
        return $this->hasMany(Integrante::className(), ['int_fkalumno' => 'alu_id']);
    }

    /**
     * Gets query for [[Publicacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacions()
    {
        return $this->hasMany(Publicacion::className(), ['pub_fkalumno' => 'alu_id']);
    }

    /**
     * Gets query for [[Reaccions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReaccions()
    {
        return $this->hasMany(Reaccion::className(), ['rea_fkalumno' => 'alu_id']);
    }

    /**
     * Gets query for [[Seguimientos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeguimientos()
    {
        return $this->hasMany(Seguimiento::className(), ['seg_fkalumno' => 'alu_id']);
    }

     public static function map(){ //esta la uso en la vista _form.php de REACCION
        return ArrayHelper::map(Alumno::find()->all(),'alu_id', 'aluFkusuario.usu_nombre');
    }
}
