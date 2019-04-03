<?php

use common\models\Member;
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;


$asset = AppAsset::register($this);
$baseUrl = $asset->baseUrl;
$path =  'img/user1.jpg';
if($model->photo != null) $path = 'uploads/'.$model->photo;

/* @var $this View */
/* @var $model Member */
/* @var $form ActiveForm */
?>

<div class="member-form">

    <div class="card card-info" style="width: 90%; margin: 0 auto;">
        <div class="card-header">
            <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        </div>
              <!-- /.card-header -->
              <!-- form start -->
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>
<div class="card-body" style="width: 800px;  margin: 0 auto;">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user" style="width: 300px; margin: 0 auto;">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info-active">
                <h3 class="widget-user-username"><?= $form->field($model, 'matricule')->model->matricule; ?></h3>
              </div>
              <div class="widget-user-image">
                  <img class="img-circle elevation-2" src="<?= $path; ?>" alt="User Avatar" id="profile"
                       style="position: relative;
    float: left;
    width:  100px;
    height: 100px;
    background-position: 50% 50%;
    background-repeat:   no-repeat;
    background-size:     cover;">
              </div>
              <div class="card-footer">
                    <div class="description-block">
                        <label for="image" class="custom-file-upload">
    <i class="fa fa-cloud-upload"></i> Choose image
</label>
                      <?= $form->field($picture, 'file')->fileInput([
                          'id'=>'image',
                         ])->label(false); ?>
                    </div>
              </div>
                <!-- /.row -->
            </div>
            <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>
                  </div>
                  <div class="form-group">
                    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>
                  </div>
                  <div class="form-group">
                  <label>Phone</label>
                <!-- /.form group -->
                <div class="input-group">
                    <div class="input-group-prepend" style="height: 38px;">
                      <span class="input-group-text"><i class="fa fa-phone"></i></span>
                    </div>
                <!-- phone mask -->
                    <?= $form->field($model, 'phone')->widget(MaskedInput::className(), [
                        'name' => 'phone',
                        'id' => 'dataphone',
                        'mask' => '999-999-999',
                    ])->label(false); ?>
                </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                  </div>
                  <div class="form-group">
                    <?= $form->field($model, 'pobox')->textInput(['maxlength' => true]) ?>
                  </div>
                  <div class="form-group">
                    <?= $form->field($model, 'residence')->textInput(['maxlength' => true]) ?>
                  </div>
                    </div>
                </div>
            </div>
              <!-- /.card-body -->
                <div class="card-footer">
                  <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                  <?= Html::a('Cancel',['member/index'],['class' => 'btn btn-default float-right']) ?>
                </div>
                <!-- /.card-footer -->
               <?php ActiveForm::end(); ?>
    </div>    

    

