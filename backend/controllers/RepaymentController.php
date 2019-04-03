<?php

namespace backend\controllers;

use common\models\Repayment;
use Yii;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * RepaymentController implements the CRUD actions for Repayment model.
 */
class RepaymentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Repayment models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays a single Repayment model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Repayment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $idl = Yii::$app->request->get('idl');
        $current_exercise_id = (new Query())->from('exercise')->max('id');
        $current_session_id = (new Query())->from('session')->where(['id_exercise' => $current_exercise_id])->max('id');
        $model = new Repayment();
        if ($model->load(Yii::$app->request->post())) {
            $model->id_session = $current_session_id;
            $model->id_loan = $idl;
            $repayment = Repayment::findOne(['id_session'=>$model->id_session, 'id_loan'=>$model->id_loan]);
            
            if($repayment != NULL){
            $repayment->amount += $model->amount;
            if($repayment->save()){
                return $this->redirect(['index']);
            }
        }else{
            if($model->save()){
                return $this->redirect(['index']);
            }
        }
 
        }

        return $this->render('create', [
            'model' => $model,'idl' =>$idl,
        ]);
    }

    /**
     * Updates an existing Repayment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Repayment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Repayment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Repayment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Repayment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
