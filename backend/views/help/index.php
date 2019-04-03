<?php

use common\models\Exercise;
use common\models\Member;
use common\models\Session;
use common\models\Setting;
use yii\db\Query;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
/* @var $this View */

$this->title = 'Helps';
$this->params['breadcrumbs'][] = $this->title;
$month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
$types = ['Parent Death','Parent In Law Death', 'Member Death','Partner Death','Childreen Death','Birth','Wedding', 'Other Happy Events', 'Other Unfortunate Events'];
$count = 0;
$current_exercise_id = (new Query())->from('exercise')->max('id');
$current_exercise = Exercise::findOne(['id' => $current_exercise_id]);
$current_session_id = (new Query())->from('session')->where(['id_exercise' => $current_exercise_id])->max('id');
$current_session = Session::findOne(['id' => $current_session_id]);
$exercises = (new Query())->from('exercise')->all();
$sessions = (new Query())->from('session')->where(['id_exercise' => $selected_exercise_id])->all();
$helps = (new Query())->from('help')->where(['id_session' => $selected_session_id])->orderBy('id')->all();
$setting = Setting::findOne(['id_exercise'=>$selected_exercise_id]);
?>      

<div class="help-index">
    <?php $user = \common\models\User::findOne(['id'=>Yii::$app->user->id]); ?>
    <div class="col-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Select exercise and session</h3>
                </div>
                <!-- /.card-header -->
                  <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Exercise</label>
                                <select class="form-control select2" id='exercice_combo' style="width: 100%;" tabindex="-1" aria-hidden="true" onchange="change_exercice(3)">
                                    <?php
                                    foreach ($exercises as $exercise) {
                                        if ($exercise['id'] == $selected_exercise_id) {
                                            echo '<option selected="selected" name ='.$exercise['id'].'>'.$month[$exercise['month']].' '.$exercise['year'].'</option>';                                  
                                        }else{
                                            echo '<option name ='.$exercise['id'].'>'.$month[$exercise['month']].' '.$exercise['year'].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label>Session</label>
                                <select class="form-control select2" id='session_combo' style="width: 100%;" tabindex="-1" aria-hidden="true" onchange="change_session(3)">
                                    <?php
                                    foreach ($sessions as $session) {
                                        if ($session['id'] == $selected_session_id) {
                                            print_r("Yo");
                                            echo '<option selected="selected" name ='.$session['id'].'>'.(date("Y-m-d",strtotime($session['date_']))).'</option>';                               
                                        }else{
                                            echo '<option name ='.$session['id'].'>'.(date("Y-m-d",strtotime($session['date_']))).'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
            </div>
            <div class="card" id="changeable">
                <div class="card-header">
                    <h3 class="card-title">Helps Management</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                               <th>Member</th>
                               <th>Help Type</th>
                               <th>Amount (FCFA)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($helps as  $help): ?>
                            <?php $member = Member::findOne(['matricule' => $help['matricule_member']]); ?>
                            <?php $type = $types[$help['type']]?>
                            <?php $amount = $setting->getAttribute(strtolower(str_replace(' ', '_',$type)))?>
                            <tr>
                               <td><?= $member['firstname'].' '.$member['lastname'] ?></td>
                               <td><?= $type ?></td>
                               <td><?= number_format($amount,2,",",".") ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                               <th>Member</th>
                               <th>Help Type</th>
                               <th>Amount (FCFA)</th>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
          <?php if($current_exercise_id == $selected_exercise_id && $current_session_id == $selected_session_id && $user->type == 1): ?>
                    <div class="card-footer">
                    <p>
        <?= Html::a('Create Help', ['create'], ['class' => 'btn btn-success', 'id'=>'soumettre']) ?>
    </p>
                </div>
                <!-- /.card-body -->
                <?php endif; ?>
                 </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->  
</div>