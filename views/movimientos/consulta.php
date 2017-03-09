<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchMmovimientos%2Findexodel app\models\MovimientoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Movimientos';
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = $num;
?>
<div class="movimiento-consulta">

    <h1><?= Html::encode($this->title) ?> de la cuenta: <?= $num?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'fecha_mov:datetime',
            'concepto',
            'ingreso:currency',
        ],
    ]); ?>

    <h2>Total: <?=$total?></h2>
</div>
