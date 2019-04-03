<?php

namespace backend\controllers;

use common\models\Exercise;
use common\models\Session;
use Yii;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * SessionController implements the CRUD actions for Session model.
 */
class SessionController extends Controller {

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
     * Lists all Session models.
     * @return mixed
     */
    public function actionIndex() {
        $id = (new Query())->from('exercise')->max('id');
        $parameter1 = Yii::$app->request->get('id');
        $parameter2 = Yii::$app->request->get('from');
        if ($parameter1 == NULL) {
            $exercise = Exercise::findOne(['id' => $id]);
            if ($exercise != NULL) {
                return $this->render('index', [
                            'exercise' => $exercise
                ]);
            }else{
                return $this->redirect('index.php?r=site/error');
            }
        } else {
            $exercise = Exercise::findOne(['id' => $parameter1]);
            if ($exercise != NULL) {
                if ($parameter2 == NULL) {
                    return $this->render('index', [
                                'exercise' => $exercise
                    ]);
                } else {
                    return $this->render('index', [
                                'exercise' => $exercise
                    ]);
                }
            }else{
                return $this->redirect('index.php?r=site/error');
            }
        }
    }

    /**
     * Displays a single Session model.
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
     * Creates a new Session model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Session();

        if ($model->load(Yii::$app->request->post())) {
            $model->id_exercise = (new Query())->from('exercise')->max('id');
            if ($model->save()) {
                return $this->redirect(['index', 'exercise' => $model, 'from' => 1]);
            }
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Session model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'exercise' => $model, 'from' => 2]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Session model.
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
     * Finds the Session model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Session the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Session::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
