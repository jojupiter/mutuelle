<?php

namespace backend\controllers;

use common\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $username = Yii::$app->request->get('username');
        if($username != NULL){
            
            $user = User::findByUsername($username);
           
        if($user->status == 0){
            $user->status = 10;
        }else{
            $user->status = 0;
        }
        $user->save();
        }
        return $this->render('index');

    }
    
    public function actionAdmin()
    {
        $username = Yii::$app->request->get('username');
        if($username != NULL){
            
            $user = User::findByUsername($username);
           
        if($user->type == 0){
            $user->type = 1;
        }else{
            $user->type = 0;
        }
        $user->save();
        }
        return $this->render('index');

    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_i = $this->findModel($id);
        $username = $model_i->username;
        $password = "";
        $retyped = "";
        $i = 0;
        if ($model->load(Yii::$app->request->post())) {
            $username = $model->username;
            $password = $model->password_hash;
            $retyped = $model->email;
            $user = User::findByUsername($model->username);
            if($user != NULL && $user['username'] != $model_i->username){
                $model = $this->findModel($id);
                $model->addError('username', 'This username already exists');
                $i++;
            }
            if($model->username == ""){
                $model = $this->findModel($id);
                $model->addError('username', 'Username cannot be blanck');  
                $i++;
            }
            if($model->password_hash == ""){
                $model = $this->findModel($id);
                $model->addError('password_hash', 'Password cannot be blanck');
                $i++;
            }else{
                if(strlen($model->password_hash) < 6){
                $model = $this->findModel($id);
                $model->addError('password_hash', 'Password most contain at least 6 characters');
                $i++;
               }else{
                   if($model->password_hash != $model->email){
                        $model = $this->findModel($id);
                        $model->addError('password_hash', 'Password and retyped password are different');    
                        $model->addError('email', 'Password and retyped password are different');
                        $i++;
                    }
               }
            }
                if($i != 0){
                    return $this->render('update', [
                    'model' => $model, 'username' => $username,'password'=>$password,'retyped'=>$retyped,
                ]);
                }else{
                    $user1 = new User();
                    $user1->username = $model->username;
                    $user1->email = $model_i->email;
                    $user1->id = $model_i->id;
                    $user1->status = $user::STATUS_ACTIVE;
                    $user1->type = $model_i->type;
                    $user1->setPassword($model->password_hash);
                    $user1->generateAuthKey();
                    $user1->generatePasswordResetToken();
                    $model_i->delete();
                    $user1->save();
                    return $this->render('index');
                    
                }
        }

        return $this->render('update', [
            'model' => $model,'username' => $username,'password'=>$password,'retyped'=>$retyped,
        ]);
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
