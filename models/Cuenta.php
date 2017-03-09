<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cuentas".
 *
 * @property integer $id
 * @property string $numero
 * @property string $fecha_creacion
 * @property integer $usuario_id
 *
 * @property Usuarios $usuario
 * @property Movimientos[] $movimientos
 */
class Cuenta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['numero', 'usuario_id'], 'required'],
            [['numero'], 'number'],
            [['fecha_creacion'], 'safe'],
            [['usuario_id'], 'integer'],
            [['numero'], 'unique'],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'numero' => 'Numero',
            'fecha_creacion' => 'Fecha Creacion',
            'usuario_id' => 'Usuario ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'usuario_id'])->inverseOf('cuentas');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimientos()
    {
        return $this->hasMany(Movimiento::className(), ['cuenta_id' => 'id'])->inverseOf('cuenta');
    }
}
