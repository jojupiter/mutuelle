<?php

namespace backend\controllers;

use common\models\Loan;
use Yii;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * LoanController implements the CRUD actions for Loan model.
 */
class LoanController extends Controller
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
     * Lists all Loan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $id = (new Query())->from('exercise')->max('id');
        $selected_exercise_id = Yii::$app->request->get('id');
        if ($selected_exercise_id == NULL) $selected_exercise_id = $id;
            return $this->render('index', [
                'selected_exercise_id' => $selected_exercise_id,
            ]); 
    }

    /**
     * Displays a single Loan model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
        $exercise_id = Yii::$app->request->get('ide');
        $matricule_member = Yii::$app->request->get('idm');
        return $this->render('view', [
            'exercise_id' => $exercise_id,
            'matricule_member' => $matricule_member,
        ]);
    }

    /**
     * Creates a new Loan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Loan();
        $current_exercise_id = (new Query())->from('exercise')->max('id');
        $current_session_id = (new Query())->from('session')->where(['id_exercise' =>$current_exercise_id])->max('id');
        if ($model->load(Yii::$app->request->post())) {
            $model->id_session = $current_session_id;
            $loan = Loan::findOne(['id_session'=>$model->id_session, 'matricule_member'=>$model->matricule_member]);
            if($loan != NULL){
            $loan->amount += $model->amount;
            if($loan->save()){
                return $this->render('view', [
                'exercise_id' => $current_exercise_id,
                'matricule_member' => $model->matricule_member,
        ]);
            }
        }else{
            if($model->save()){
                 return $this->render('view', [
            'exercise_id' => $current_exercise_id,
            'matricule_member' => $model->matricule_member,
        ]);
            }
        }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Loan model.
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
     * Deletes an existing Loan model.
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
     * Finds the Loan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Loan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Loan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
