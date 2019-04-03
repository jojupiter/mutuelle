<?php
/* @var $this View */
/* @var $form ActiveForm */
/* @var $model SignupForm */

use frontend\models\SignupForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

$this->title = 'Sign Up';
?>
<div class="registration-box">
    <!-- /.login-logo -->
    <div class="card" style="position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);width: 51%">
        <div class="card-header" style="background-color: #FDC601;vertical-align: middle;">
            <div style="text-align:center;vertical-align:middle;font-size: 25px;">
                <b>REGISTRATION</b>
            </div>
        </div>
        <div class="card-body login-card-body">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <div class="row">
            <div class="col-md-6">
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
            <div class="form-group has-feedback">
                <div class="wrapper" style="position: relative;">
                <?= $form->field($model, 'retype_password')->passwordInput(['class' => 'form-control', 'placeholder' => 'Confirm Password'])->label('Confirm Password') ?>
                <span class="fa fa-lock form-control-feedback" style=" position: absolute; top: 30px; left: 300px;"></span>
                </div>
            </div>
            </div>
            <div class="col-md-6">
                <div class="form-group has-feedback">
                <div class="wrapper" style="position: relative;">
                <?= $form->field($model, 'email')->textInput(['class' => 'form-control', 'placeholder' => 'Email']) ?>
                <span class="fa fa-envelope form-control-feedback" style=" position: absolute; top: 30px; left: 300px;"></span>
                </div>
                 </div>
                <div class="form-group has-feedback">
                <div class="wrapper" style="position: relative;">
                <?= $form->field($model, 'id')->textInput(['class' => 'form-control', 'placeholder' => 'Matricule'])->label('Matricule') ?>
                <span class="fa fa-user form-control-feedback" style=" position: absolute; top: 30px; left: 300px;"></span>
                </div>
                </div>
            </div>
        </div>
            <div class="form-group has-feedback">
                <div class="wrapper" style="position: relative;">
                <?= Html::a('I already have an account', ['site/login']) ?>
                </div>
            </div>
        </div>
        <!-- /.login-card-body -->
        <div class="card-footer">
            <?= Html::submitButton('<div style="text-align:center;vertical-align:middle;font-size: 18px;">
                <b>Sign Up</b>
            </div>', ['class' => 'btn btn-primary btn-block btn-warning', 'name' => 'signup-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>