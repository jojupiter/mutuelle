<?php

use common\models\Loan;
use common\models\Member;
use common\models\Setting;
use common\models\User;
use yii\db\Query;
use yii\helpers\Url;
use yii\web\View;
/* @var $this View */

$this->title = 'Repayments';
$this->params['breadcrumbs'][] = $this->title;
$current_exercise_id = (new Query())->from('exercise')->max('id');
$sessions_in_current_exercise_id = (new Query())->select('id')->from('session')->where(['id_exercise' => $current_exercise_id]);
$loans = (new Query())->from('loan')->where(['id_session'=>$sessions_in_current_exercise_id]);
$setting = Setting::findOne(['id_exercise'=>$current_exercise_id]);
$unpayed_loans_ids = [];
?>
<?php
    foreach ($loans->each() as $loan){
        $active_loan = Loan::findOne($loan['id']);
        $total = $active_loan->getRepayments()->sum('amount');
        if($total < (1+$setting->interest_rate)*$active_loan->amount) $unpayed_loans_ids[] = $active_loan->id;
    }
        $unpayed_loans = (new Query())->from('loan')->where(['id'=>$unpayed_loans_ids]);

?>
<?php $user = User::findOne(['id'=>Yii::$app->user->id]); ?>
<div class="repayment-index">
        <div class="col-12">
            <div class="card" id="changeable">
                <div class="card-header">
                    <h3 class="card-title">Unachieved repayments for the current exercise</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                               <th>Member</th>
                               <th>Total to paid (FCFA)</th>
                               <th>Already paid (FCFA)</th>
                               <th>Remaining (FCFA)</th>
                               <?php if($user->type == 1): ?>
                               <th>Action</th> 
                               <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                           <?php foreach($unpayed_loans->each() as  $unpayed_loan): ?>
                            <?php $member = Member::findOne(['matricule' => $unpayed_loan['matricule_member']]); ?>
                            <?php 
                                $active_loan = Loan::findOne($unpayed_loan['id']);
                                $total = $active_loan->getRepayments()->sum('amount');
                            ?>
                            <tr>
                               <td><?= $member['firstname'].' '.$member['lastname'] ?></td>
                               <td><?= number_format((1+$setting->interest_rate)*$active_loan->amount,2,",",".") ?></td>
                               <td><?= number_format($total,2,",",".") ?></td>
                               <td><?= number_format((1+$setting->interest_rate)*$active_loan->amount-$total,2,",",".") ?></td>
                               <?php if($user->type == 1): ?>
                    <td>
                        <a href="<?= Url::to(['repayment/create', 'idl' => $active_loan->id])?>" class="btn btn-app">
                  <i class="fa fa-paypal"></i> Make payment
                                        </a>
                    </td><?php endif; ?>
                            </tr>
                            <?php endforeach; ?> 
                        </tbody>
                        <tfoot>
                            <tr>
                               <th>Member</th>
                               <th>Total to paid (FCFA)</th>
                               <th>Already paid (FCFA)</th>
                               <th>Remaining (FCFA)</th>
                               <?php if($user->type == 1): ?>
                               <th>Action</th> 
                               <?php endif; ?>  
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
<!-- /.row -->