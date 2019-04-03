<?php
/* @var $this View */
/* @var $form ActiveForm */
/* @var $model PasswordResetRequestForm */

use frontend\models\PasswordResetRequestForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

$this->title = 'Request password reset';
?>
    <div class="card" style="position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);">
        <div class="card-header" style="background-color: #FDC601;vertical-align: middle;">
            <div style="text-align:center;vertical-align:middle;font-size: 25px;margin: 0 auto;">
                <b>REQUEST PASSWORD RESET</b>
            </div>
        </div>
        <div class="card-body login-card-body" style="margin: 0 auto;">
            <p class="login-box-msg" style="text-align: justify;">Please fill out your email. A link to reset password will be sent there.</p>
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
            <div class="form-group has-feedback">
                <div class="wrapper" style="position: relative;">
                <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'class' => 'form-control', 'placeholder' => 'Email']) ?>
                    <span class="fa fa-envelope form-control-feedback" style=" position: absolute; top: 30px; left: 460px;"></span>
                </div>
            </div>
        </div>
        <!-- /.login-card-body -->
        <div class="card-footer">
            <?= Html::submitButton('<div style="text-align:center;vertical-align:middle;font-size: 18px;">
                <b>Send</b>
            </div>', ['class' => 'btn btn-primary btn-block btn-warning']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>     


