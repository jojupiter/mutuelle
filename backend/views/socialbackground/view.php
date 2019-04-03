<?php

use common\models\Exercise;
use common\models\Member;
use common\models\Session;
use common\models\Socialbackground;
use yii\db\Query;
use yii\web\View;

/* @var $this View */
/* @var $model Socialbackground */

$member = Member::findOne(['matricule' => $matricule_member]);
$exercice = Exercise::findOne(['id' => $exercise_id]);
$month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
$sessions_exercise = (new Query())->select('id')->from('session')->where(['id_exercise' => $exercise_id]);
$socialbackgrounds = (new Query())->from('socialbackground')->where(['id_session' => $sessions_exercise, 'matricule_member' => $matricule_member])->orderBy('id')->all();
$this->title = $member->firstname.' '.$member->lastname.' - '.$month[$exercice->month].' '.$exercice->year;
$this->params['breadcrumbs'][] = ['label' => 'Socialbackgrounds', 'url' => ['index', 'id'=>$exercise_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="socialbackground-view" >
    <div class="col-12" style="margin: 0 auto;">
            <div class="card" id="changeable" style="width: 70%; margin: 0 auto;">
                <div class="card-header" style="text-align: center;">
                    <h3 class="card-title">History of <?= $member->firstname.' '.$member->lastname ?> contributions for the exercise <?= $month[$exercice->month].' '.$exercice->year ?></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-striped" style="width: 100%; margin: 0 auto; vertical-align: middle;" id="example">
                        <thead style="text-align: center; vertical-align: middle;">
                            <tr>
                               <th>Session</th>
                               <th>Amount (FCFA)</th>                            
                            </tr>
                        </thead>
                        <tbody style="vertical-align: middle;">
                           <?php foreach($socialbackgrounds as  $socialbackground): ?>
                            <?php $session = Session::findOne(['id' => $socialbackground['id_session']]); ?>
                            <tr>
                                <td><?= date('d F, Y (l)', strtotime($session['date_'])); ?></td>
                               <td style="text-align: center;"><?= number_format($socialbackground['amount'],2,",",".") ?></td>
                            </tr>
                            <?php endforeach; ?> 
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <table class="table table-bordered table-striped" style="width: 60%; margin: 0 auto; vertical-align: middle; text-align: center;">
                        <thead style="text-align: center; vertical-align: middle;">
                            <tr>
                               <th>Total (FCFA)</th>
                               <th>Expected (FCFA)</th>                            
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= number_format($total,2,",","."); ?></td>
                                <td><?= number_format($inspected,2,",","."); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>