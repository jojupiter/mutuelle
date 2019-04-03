<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
$model->password_hash = "";
$model->email = "";
$model->username = $username;
$model->password_hash = $password;
$model->email = $retyped;
?>

<div class="user-form">
<div class="card card-info" style="width: 50%; margin: 0 auto;">
        <div class="card-header">
            <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
    <?php $form = ActiveForm::begin(); ?>
        <div class="card-body">
            <div class="form-group">
                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true])->label('Password') ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'email')->passwordInput(['maxlength' => true])->label('Retype password') ?>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
       <?= Html::a('Cancel', ['user/index'], ['class' => 'btn btn-default float-right']) ?>
        </div>
        <!-- /.card-footer -->
    <?php ActiveForm::end(); ?>

</div>
</div>
