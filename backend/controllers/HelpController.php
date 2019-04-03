<?php

namespace backend\controllers;

use common\models\Help;
use Yii;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * HelpController implements the CRUD actions for Help model.
 */
class HelpController extends Controller {

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
     * Lists all Help models.
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

        if ($selected_exercise_id != NULL && $selected_session_id != NULL) {
            return $this->render('index', [
                        'selected_exercise_id' => $selected_exercise_id,
                        'selected_session_id' => $selected_session_id,
            ]);
        } else {
            return $this->redirect('index.php?r=site/error');
        }
    }

    /**
     * Displays a single Help model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Help model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Help();
        $current_exercise_id = (new Query())->from('exercise')->max('id');
        $current_session_id = (new Query())->from('session')->where(['id_exercise' => $current_exercise_id])->max('id');

        if ($model->load(Yii::$app->request->post())) {
            $model->id_session = $current_session_id;
            if ($model->save()) {
                return $this->render('index', [
                            'selected_exercise_id' => $current_exercise_id,
                            'selected_session_id' => $current_session_id,
                ]);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Help model.
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
     * Deletes an existing Help model.
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
     * Finds the Help model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Help the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Help::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
