<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<div class="login-box" style="position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);">
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-header" style="background-color: #FDC601;vertical-align: middle;">
            <div style="text-align:center;vertical-align:middle;font-size: 25px;">
                <b>CONNEXION</b>
            </div>
        </div>
        <div class="card-body login-card-body">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <div class="form-group has-feedback">
                <div class="wrapper" style="position: relative;">
                <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form-control', 'placeholder' => 'Username']) ?>
                    <span class="fa fa-user form-control-feedback" style=" position: absolute; top: 30px; left: 300px;"></span>
                </div>
            </div>
            <div class="form-group has-feedback">
                <div class="wrapper" style="position: relative;">
                <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control', 'placeholder' => 'Password']) ?>
                <span class="fa fa-lock form-control-feedback" style=" position: absolute; top: 30px; left: 300px;"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="checkbox icheck">
                        <label>
                            <?= $form->field($model, 'rememberMe')->checkbox(['class' => 'checkbox']) ?>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group has-feedback">
                <p class="mb-0">
                    Forgot password ? <?= Html::a('reset it', ['site/request-password-reset']) ?>.  
                </p>
                <br>
                <p class="mb-0">
                    Create a new account ? <?= Html::a('sign up', ['site/signup']) ?>.
                </p>
            </div>
        </div>
        <!-- /.login-card-body -->
        <div class="card-footer">
                <?= Html::submitButton('<div style="text-align:center;vertical-align:middle;font-size: 18px;">
                <b>Sign In</b>
            </div>', ['class' => 'btn btn-primary btn-block btn-warning', 'name' => 'login-button']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
