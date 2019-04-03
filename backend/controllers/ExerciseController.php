<?php

namespace backend\controllers;

use common\models\Exercise;
use common\models\Setting;
use Yii;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ExerciseController implements the CRUD actions for Exercise model.
 */
class ExerciseController extends Controller
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
     * Lists all Exercise models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'main';
        return $this->render('index');
    }
    
    public function actionEnd(){
        return $this->render('end');
    }

    /**
     * Displays a single Exercise model.
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
     * Creates a new Exercise model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Exercise();
        $current_exercise_id = (new Query())->from('exercise')->max('id');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $setting = new Setting();
            if($current_exercise_id == NULL){
                $setting->getDefaultSetting();
                $setting->id_exercise = $model->id;
                $setting->save();
            }else{
               $new_setting = new Setting();
               $current_exercise = Exercise::findOne(['id' => $current_exercise_id]);
               $setting = Setting::findOne(['id_exercise' => $current_exercise_id]);
               $new_setting->clonage($setting, $model->id);
               $new_setting->save();
            } 
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Exercise model.
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
     * Deletes an existing Exercise model.
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
     * Finds the Exercise model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Exercise the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Exercise::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
