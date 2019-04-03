<?php

use common\models\Help;
use common\models\Setting;
use yii\db\Query;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Help */
/* @var $form ActiveForm */

$today = date("Y-m-d");
$current_exercise_id = (new Query())->from('exercise')->max('id');
$setting = Setting::findOne(['id_exercise'=>$current_exercise_id]);
$expire = date('Y-m-d', strtotime('+'.$setting->delays_sb.' months', strtotime($today)));
$current_session_id = (new Query())->from('session')->where(['id_exercise' =>$current_exercise_id])->max('id');
$today_dt = new DateTime($today);
$expire_dt = new DateTime($expire);
if( $today_dt < $expire_dt){
    $helpable = (new Query())->from('member')->all();
}else{
    
}
?>
<div class="help-form">
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
                <?= $form->field($model, 'matricule_member')->dropDownList(\common\models\Help::getMemberList())->label('Member') ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'type')->dropDownList(['Parent Death','Parent In Law Death', 'Member Death','Partner Death','Childreen Death','Birth','Wedding', 'Other Happy Events', 'Other Unfortunate Events'])->label('Help Type') ?>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
       <?= Html::a('Cancel', ['help/index'], ['class' => 'btn btn-default float-right']) ?>
        </div>
        <!-- /.card-footer -->
<?php ActiveForm::end(); ?>
    </div>
</div>
