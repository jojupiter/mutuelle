<?php

use common\models\Exercise;
use common\models\Member;
use common\models\Session;
use common\models\Setting;
use common\models\User;
use yii\db\Query;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
/* @var $this View */

$this->title = 'Socialbackgrounds';
$this->params['breadcrumbs'][] = $this->title;
$month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
$types = ['Parent Death','Parent In Law Death', 'Member Death','Partner Death','Childreen Death','Birth','Wedding', 'Other Happy Events', 'Other Unfortunate Events'];
$total = 0;
$inspected = 0;
$current_exercise_id = (new Query())->from('exercise')->max('id');
$current_exercise = Exercise::findOne(['id' => $current_exercise_id]);
$current_session_id = (new Query())->from('session')->where(['id_exercise' => $current_exercise_id])->max('id');
$current_session = Session::findOne(['id' => $current_session_id]);
$exercises = (new Query())->from('exercise')->all();
$sessions = (new Query())->from('session')->where(['id_exercise' => $selected_exercise_id])->all();
$sessions_in_selected_exercise = (new Query())->select('id')->from('session')->where(['id_exercise' => $selected_exercise_id]);
$members_matricules = (new Query())->select('matricule_member')->from('socialbackground')->where(['id_session'=>$sessions_in_selected_exercise])->distinct();
$helps = (new Query())->from('help')->where(['id_session' => $selected_session_id])->orderBy('id')->all();
$setting = Setting::findOne(['id_exercise'=>$selected_exercise_id]);
?>
<?php $user = User::findOne(['id'=>Yii::$app->user->id]); ?>
<div class="socialbackground-index">
        <div class="col-12">
            <div class="card" id="changeable">
                <div class="card-header">
                    <h3 class="card-title">Social Contributions Management</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                            <div class="form-group">
                                <label>Exercise</label><br>
                                <select class="form-control select2" id='exercice_combo' style="width: 20%;" tabindex="-1" aria-hidden="true" onchange="change_exercice(4)">
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
                    <table id="example" class="table table-bordered table-striped">
                        <thead style="text-align:center;"> 
                            <tr>
                               <th style="text-align:left;">Member</th>
                               <th>Progress</th>
                               <th>Percentage</th>
                               <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($members_matricules->each() as  $matricule): ?>
                            <?php $member = Member::findOne(['matricule' => $matricule['matricule_member']]); ?>
                            <?php $amount = (new Query())->from('socialbackground')->where(['matricule_member' => $member['matricule'] ,'id_session'=>$sessions_in_selected_exercise])->sum('amount'); ?>
                            <?php 
                                $k = (int)substr($member['matricule'],0,2);
                                $j = $current_exercise['year']%100;
                                $total = $amount;
                                if($k < $j){
                                    $inspected = $setting['amount_sb_om'];
                                    $percentage = (int)(($amount/$setting['amount_sb_om'])*100);
                                }else{
                                    $inspected = $setting['amount_sb_nm'];
                                    $percentage = (int)(($amount/$setting['amount_sb_nm'])*100);
                                }
                            ?>
                            <tr>
                               <td style="vertical-align: middle;"><?= $member['firstname'].' '.$member['lastname'] ?></td>
                               <?php if($percentage < 50): ?>
                               <td style="vertical-align: middle;">
                      <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-danger" style="width: <?= $percentage ?>%"></div>
                      </div>
                    </td>
                    <td style="vertical-align: middle;text-align:center;"><span class="badge bg-danger"><?= $percentage." %" ?></span></td>
                               <?php elseif($percentage >= 50 &&  $percentage <=75): ?>
                               <td style="vertical-align: middle;">
                      <div class="progress progress-xs">
                        <div class="progress-bar bg-warning" style="width: <?= $percentage ?>%"></div>
                      </div>
                    </td>
                    <td style="vertical-align: middle;text-align:center;"><span class="badge bg-warning"><?= $percentage." %" ?></span></td>
                               <?php else : ?>
                    <td style="vertical-align: middle;">
                      <div class="progress progress-xs progress-striped active">
                        <div class="progress-bar bg-success" style="width: <?= $percentage ?>%"></div>
                      </div>
                    </td>
                    <td style="vertical-align: middle;text-align:center;"><span class="badge bg-success"><?= $percentage." %" ?></span></td>
                               <?php endif; ?>
                    <td style="vertical-align: middle;text-align:center;">
                        <a href="<?= Url::to(['socialbackground/view', 'ide' => $selected_exercise_id , 'idm'=>$member['matricule'],'tot'=>$total,'insp'=>$inspected])?>" class="btn btn-app">
                  <i class="fa fa-eye"></i> Details
                                        </a>
                    </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot style="text-align:center;">
                            <tr>
                               <th style="text-align:left;">Member</th>
                               <th>Progress</th>
                               <th>Percentage</th>
                               <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
          <?php if($current_exercise_id == $selected_exercise_id && $current_session_id == $selected_session_id): ?>
                <?php if($user!= NULL && $user->type == 1): ?>
                    <div class="card-footer">
                    <p>
        <?= Html::a('Create Socialbackground', ['create'], ['class' => 'btn btn-success', 'id'=>'soumettre']) ?>
    </p>
                </div>
                <!-- /.card-body -->
                 <?php endif; ?>
                <?php endif; ?>
                 </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
</div>
