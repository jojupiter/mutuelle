<?php

namespace backend\controllers;

use common\models\Socialbackground;
use Yii;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * SocialbackgroundController implements the CRUD actions for Socialbackground model.
 */
class SocialbackgroundController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
     * Lists all Socialbackground models.
     * @return mixed
     */
    public function actionIndex() {
        $selected_exercise_id = Yii::$app->request->get('ide');
        $selected_session_id = Yii::$app->request->get('ids');
        $i = Yii::$app->request->get('i');
        if ($i == NULL) {
            $selected_exercise_id = (new Query())->from('exercise')->max('id');
            $selected_session_id = (new Query())->from('session')->where(['id_exercise' => $selected_exercise_id])->max('id');
        } else if ($i == 1) {
            $selected_session_id = (new Query())->from('session')->where(['id_exercise' => $selected_exercise_id])->max('id');
        }
        return $this->render('index', [
                    'selected_exercise_id' => $selected_exercise_id,
                    'selected_session_id' => $selected_session_id,
        ]);
    }

    /**
     * Displays a single Socialbackground model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView() {
        $exercise_id = Yii::$app->request->get('ide');
        $matricule_member = Yii::$app->request->get('idm');
        $total = Yii::$app->request->get('tot');
        $inspected = Yii::$app->request->get('insp');

        return $this->render('view', [
                    'exercise_id' => $exercise_id,
                    'matricule_member' => $matricule_member,
                    'total' => $total,
                    'inspected' => $inspected,
        ]);
    }

    /**
     * Creates a new Socialbackground model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Socialbackground();
        $current_exercise_id = (new Query())->from('exercise')->max('id');
        $current_session_id = (new Query())->from('session')->where(['id_exercise' => $current_exercise_id])->max('id');

        if ($model->load(Yii::$app->request->post())) {
            $model->id_session = $current_session_id;
            $found = Socialbackground::findOne(['id_session' => $model->id_session, 'matricule_member' => $model->matricule_member]);
            if ($found != NULL) {
                $found->amount += $model->amount;
                if ($found->save()) {
                    return $this->redirect(['index',
                                'selected_exercise_id' => $current_exercise_id,
                                'selected_session_id' => $current_session_id,]);
                }
            } else {
                if ($model->save()) {
                    return $this->redirect(['index',
                                'selected_exercise_id' => $current_exercise_id,
                                'selected_session_id' => $current_session_id,]);
                }
            }
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Socialbackground model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Socialbackground model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Socialbackground model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Socialbackground the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Socialbackground::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
