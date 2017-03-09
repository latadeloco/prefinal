<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "movimientos".
 *
 * @property integer $id
 * @property string $fecha_mov
 * @property string $concepto
 * @property string $ingreso
 * @property integer $cuenta_id
 *
 * @property Cuentas $cuenta
 */
class Movimiento extends \yii\db\ActiveRecord
{
    public $numero = 0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'movimientos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_mov'], 'safe'],
            [['concepto', 'ingreso', 'cuenta_id'], 'required'],
            [['ingreso'], 'number'],
            [['cuenta_id'], 'integer'],
            [['concepto'], 'string', 'max' => 150],
            [['cuenta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cuenta::className(), 'targetAttribute' => ['cuenta_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha_mov' => 'Fecha Mov',
            'concepto' => 'Concepto',
            'ingreso' => 'Ingreso',
            'cuenta_id' => 'Cuenta ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuenta()
    {
        return $this->hasOne(Cuenta::className(), ['id' => 'cuenta_id'])->inverseOf('movimientos');
    }
}
