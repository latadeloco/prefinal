<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Movimiento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="movimiento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha_mov')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'concepto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ingreso')->textInput() ?>

    <?= $form->field($model, 'cuenta_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
