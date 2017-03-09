<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CuentaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cuentas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuenta-index">

    <h1><?= Html::encode($this->title) ?></h1>

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
                'fecha_creacion:datetime',            ],
        ]); ?>

</div>
