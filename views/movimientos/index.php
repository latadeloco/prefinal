<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchMmovimientos%2Findexodel app\models\MovimientoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Movimientos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="movimiento-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Hacer transacción', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
            'label' => 'Numero',
            'value' => function ($model, $key, $index, $column) {
                return Html::a(
                    $model->numero,
                    ['movimientos/consulta', 'num' => $model->numero]
                );
            },
            'format' => 'html',
        ],
            'concepto',
            'ingreso:currency',
            'fecha_mov:datetime',
        ],
    ]); ?>
</div>
