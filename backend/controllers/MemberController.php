<?php

namespace backend\controllers;

use common\models\Exercise;
use common\models\Member;
use common\models\Registration;
use common\models\Setting;
use common\models\UploadForm;
use common\models\User;
use Yii;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * MemberController implements the CRUD actions for Member model.
 */
class MemberController extends Controller
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
     * Lists all Member models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays a single Member model.
     * @param string $id
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
     * Creates a new Member model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Member();
        $picture = new UploadForm();
        $prefix = ((int)date("Y"))%100;
        $last_member = (new Query())->from('member')->where(['like','matricule',$prefix.'M'])->orderBy(['matricule' => SORT_DESC])->limit(1);
        
        if($last_member->count() == 0){
            $model->matricule = $prefix.'M001';
        }else{
            foreach ($last_member->each() as $member){
                $suffix = ((int)substr($member['matricule'],3));
                $var = strlen("".($suffix+1));
                $suffix++;
                switch ($var){
                case 1: $model->matricule = $prefix.'M00'.$suffix;
                    break;
                case 2: $model->matricule = $prefix.'M0'.$suffix;
                    break;
                default : break;
                }
            }
        }
        
       
        if ($model->load(Yii::$app->request->post()) && $picture->load(Yii::$app->request->post())){
            $picture->file = UploadedFile::getInstance($picture, 'file');
            $model->firstname = strtoupper($model->firstname);
            $model->lastname = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($model->lastname))));
            if($picture->file && $picture->validate()){
                $picture->file->saveAs('uploads/' . $picture->file->baseName . '.' . $picture->file->extension);
                $model->photo = $picture->file->name;
            }
            
        }
        
        if ($model->save()) {
            $account = new User();
            $fees = new Registration();
            $current_exercise_id = (new Query())->from('exercise')->max('id');
            $current_exercise = Exercise::findOne(['id' => $current_exercise_id]);
            $setting = Setting::findOne(['id_exercise' => $current_exercise_id]);
            $fees->matricule_member = $model->matricule;
            $fees->amount = $setting->registration_fees;
            $fees->save();
            /*$account->username = $model->matricule;
            $account->*/
            return $this->redirect(['view', 'id' => $model->matricule, 'picture' => $picture]);
        }

        return $this->render('create', [
            'model' => $model,'picture' => $picture,
        ]);
    }

    /**
     * Updates an existing Member model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $picture = new UploadForm();
        $picture->file = 'uploads/'.$model->photo;
        if ($model->load(Yii::$app->request->post())) {
            if($picture->load(Yii::$app->request->post())){
               $picture->file = UploadedFile::getInstance($picture, 'file'); 
               if($picture->file && $picture->validate()){
                $picture->file->saveAs('uploads/' . $picture->file->baseName . '.' . $picture->file->extension);
                $model->photo = $picture->file->name;
               }
            }
            
            $model->firstname = strtoupper($model->firstname);
            $model->lastname = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($model->lastname))));       
          if($model->save()){
              $user = User::findOne($model->matricule);
              if($user != NULL){
                  $user->email = $model->email;
                  $user->save();
              }
              return $this->redirect(['view', 'id' => $model->matricule,'picture'=>$picture]);
          }
        }

        return $this->render('update', [
            'model' => $model,'picture'=>$picture,
        ]);
    }

    /**
     * Deletes an existing Member model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Member model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Member the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Member::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
