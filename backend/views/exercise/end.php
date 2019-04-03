<?php

use common\models\Exercise;
use common\models\Session;
use common\models\Setting;
use yii\db\Query;
use yii\web\View;

/* @var $this View */
/* @var $model Exercise */

$current_exercise_id = (new Query())->from('exercise')->max('id');
$month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
$members = (new Query())->from('member')->orderBy('firstname')->orderBy('lastname')->all();
$this->title = 'End';
$this->params['breadcrumbs'][] = ['label' => 'Exercises', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php 
    $current_exercise = Exercise::findOne($current_exercise_id);
    $setting = Setting::findOne(['id_exercise'=>$current_exercise_id]);
    $sessions = $current_exercise->getSessions();
    $sessions_in_current_exercise_id = (new Query())->select('id')->from('session')->where(['id_exercise' => $current_exercise_id]);
    $sessions_in_current_exercise = (new Query())->from('session')->where(['id_exercise' => $current_exercise_id]);
    $count = (new Query())->from('session')->where(['id_exercise' => $current_exercise_id])->count();
    $sessions_id = [];
    $total_loan = [];
    $total_saving = [];
    $ratio = [];
    
    foreach ($sessions_in_current_exercise_id->each() as $item){
        $sessions_id[] = $item['id'];
    }
    
    foreach($sessions->each() as $session){
        $active_session = Session::findOne($session['id']);
        $sum_loan = (new Query())->from('loan')->where(['id_session'=>$session['id']])->sum('amount');
        $total_loan[] = $sum_loan;
        $sum_saving = (new Query())->from('saving')->where(['id_session'=>$sessions_in_current_exercise_id])->andWhere(['<=','id_session',$session['id']])->sum('amount');
        $total_saving[] = $sum_saving;
        if($sum_saving != 0){
            $ratio[] = ($sum_loan*$setting->interest_rate)/$sum_saving;
        }else{
            $ratio[] = 0;
        }
        
    }

?>
<div class="exercice-end" style="margin: 0 auto;">
            <div class="card" id="changeable" style="width: 96%;margin: 0 auto;">
                <div class="card-header">
                    <h3 class="card-title">Repartition of the benefices for the current exercise</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                               <th>Member</th>
                               <th>Total Savings (FCFA)</th>
                               <th>Interest produiced (FCFA)</th>
                               <th>Total to receive (FCFA)</th>                              
                            </tr>
                        </thead>
                        <tbody>
                           <?php foreach($members as  $member): ?>
                            <?php $saving = (new Query())->from('saving')->where(['matricule_member' => $member['matricule'] ,'id_session'=>$sessions_in_current_exercise_id])->sum('amount'); ?>
                            <?php 
                                $benefice = 0;
                                for($i = 0; $i<$count ; $i++){
                                    $sum_saving_of_member = (new Query())->from('saving')->where(['id_session'=>$sessions_in_current_exercise_id, 'matricule_member' => $member['matricule']])->andWhere(['<=','id_session',$sessions_id[$i]])->sum('amount');
                                    $benefice += $sum_saving_of_member*$ratio[$i];
                                }
                            ?>
                            <tr>
                               <td><?= $member['firstname'].' '.$member['lastname'] ?></td>
                               <td><?= number_format($saving,2,",","."); ?></td>
                               <td><?= number_format($benefice,2,",","."); ?></td>
                               <td><?= number_format($saving+$benefice,2,",","."); ?></td>
                            </tr>
                            <?php endforeach; ?> 
                        </tbody>
                        <tfoot>
                            <tr>
                               <th>Member</th>
                               <th>Total Savings (FCFA)</th>
                               <th>Interest produiced (FCFA)</th>
                               <th>Total to receive (FCFA)</th>   
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
<!-- /.row -->
