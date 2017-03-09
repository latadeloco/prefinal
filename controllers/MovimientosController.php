<?php

namespace app\controllers;

use Yii;
use app\models\Movimiento;
use app\models\MovimientoSearch;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * MovimientosController implements the CRUD actions for Movimiento model.
 */
class MovimientosController extends Controller
{
    /**
     * @inheritdoc
     */
     public function behaviors()
     {
         return [
             'access' => [
                 'class' => AccessControl::className(),
                 'only' => ['index'],
                 'rules' => [
                     [
                         'allow' => true,
                         'actions' => ['index'],
                         'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->id;
                        }
                     ],
                 ],
             ],
         ];
     }

    /**
     * Lists all Movimiento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Movimiento::findBySql('select * from movimientos join cuentas on movimientos.cuenta_id = cuentas.id where usuario_id=('
                                                . Yii::$app->user->id.")"),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Movimiento model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Movimiento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Movimiento();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Creates a new Movimiento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionConsulta($num)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Movimiento::findBySql('select * from movimientos join cuentas on movimientos.cuenta_id = cuentas.id where usuario_id=('
                                                . Yii::$app->user->id.") and numero=(".$num.")"),
        ]);

        $total = Movimiento::findBySql('select * from movimientos join cuentas on movimientos.cuenta_id = cuentas.id where usuario_id=('
                                            . Yii::$app->user->id.") and numero=(".$num.")")->sum('ingreso');

        return $this->render('consulta', [
            'total' => $total,
            'num' => $num,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Updates an existing Movimiento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Movimiento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Movimiento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Movimiento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Movimiento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
