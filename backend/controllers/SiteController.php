<?php
namespace backend\controllers;

use common\models\LoginForm;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = 'main';
        $user_id = Yii::$app->request->get('id'); 
        return $this->redirect('index.php?r=exercise/index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $user_id = Yii::$app->request->get('id');             
        $user = User::findOne($user_id);
        $virtuallogfrom = new LoginForm();
        $virtuallogfrom->rememberMe = false;
        Yii::$app->user->login($user, $virtuallogfrom->rememberMe ? 3600 * 24 * 30 : 0);
        return $this->redirect('index.php?r=exercise/index');
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('/advanced/frontend/web/index.php?r=site/index');
    }
}
