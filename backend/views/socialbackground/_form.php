<?php

use common\models\Help;
use common\models\Socialbackground;
use yii\db\Query;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Socialbackground */
/* @var $form ActiveForm */

$current_exercise_id = (new Query())->from('exercise')->max('id');
$current_session_id = (new Query())->from('session')->where(['id_exercise' =>$current_exercise_id])->max('id');
?>

<div class="socialbackground-form">
     <div class="card card-info" style="width: 50%; margin: 0 auto;">
        <div class="card-header">
            <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php $form = ActiveForm::begin(
    ['class' => 'form-horizontal']); ?>
        <?php $model->id_session = $current_session_id ?>
        <div class="card-body">
            <div class="form-group">
                <?= $form->field($model, 'matricule_member')->dropDownList(Help::getMemberList())->label('Member') ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'amount')->textInput() ?>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
       <?= Html::a('Cancel', ['socialbackground/index'], ['class' => 'btn btn-default float-right']) ?>
        </div>
        <!-- /.card-footer -->
<?php ActiveForm::end(); ?>
            </div>
</div>
