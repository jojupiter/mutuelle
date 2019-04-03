<?php

use common\models\Member;
use common\models\User;
use yii\db\Query;
use yii\helpers\Html;
use yii\web\View;
/* @var $this View */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
$users = (new Query())->from('user')->all();
$user_ = User::findOne(['id'=>Yii::$app->user->id]);
?>
<div class="help-index">
    <div class="col-12">
        <div class="card" id="changeable" style="width:99%; margin: 0 auto;">
                <div class="card-header">
                    <h3 class="card-title">Users Accounts Management</h3>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                               <th>Member</th>
                               <th>Account Statu</th>
                               <th>Administrator</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($users as  $user): ?>
                            <?php $member = Member::findOne(['matricule' => $user['id']]); ?>
                            <?php if($user_->id != $user['id']): ?>
                            <tr>
                               <td style="vertical-align: middle"><?= $member['firstname'].' '.$member['lastname'] ?></td>
                               <td style="vertical-align: middle">
                                   <?php if($user['status'] == 10): ?>
                                   <?php if($user_->type == 1): ?>
                                   <p onclick='window.open("index.php?r=user/index&username="+"<?= $user['username'] ?>", "_self");'><input type="checkbox" class="toggle-two" checked /></p>                                    <?php else: ?>
                                   <div class="toggle btn btn-primary" data-toggle="toggle" style="width: 94px; height: 34px;"><input type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled"><div class="toggle-group"><label class="btn btn-primary toggle-on">Enabled</label><label class="btn btn-default active toggle-off">Disabled</label><span class="toggle-handle btn btn-default"></span></div></div>
                                   <?php endif; ?>
                                   <?php else: ?>
                                   <?php if($user_->type == 1): ?>
                     <p onclick='window.open("index.php?r=user/index&username="+"<?= $user['username'] ?>", "_self");'><input type="checkbox" class="toggle-two"/></p>  
                                    <?php else: ?>
                     <div class="toggle btn btn-default off" data-toggle="toggle" style="width: 94px; height: 34px;"><input type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled"><div class="toggle-group"><label class="btn btn-primary toggle-on">Enabled</label><label class="btn btn-default active toggle-off">Disabled</label><span class="toggle-handle btn btn-default"></span></div></div>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                                <td style="vertical-align: middle">
                                   <?php if($user['type'] == 1): ?>
                                   <?php if($user_->type == 1): ?>
                                   <p onclick='window.open("index.php?r=user/admin&username="+"<?= $user['username'] ?>", "_self");'><input type="checkbox" class="toggle-one" checked /></p>                                    <?php else: ?>
                                   <div class="toggle btn btn-primary" data-toggle="toggle" style="width: 94px; height: 34px;"><input type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No"><div class="toggle-group"><label class="btn btn-primary toggle-on">Yes</label><label class="btn btn-default active toggle-off">No</label><span class="toggle-handle btn btn-default"></span></div></div>
                                   <?php endif; ?>
                                   <?php else: ?>
                                   <?php if($user_->type == 1): ?>
                     <p onclick='window.open("index.php?r=user/admin&username="+"<?= $user['username'] ?>", "_self");'><input type="checkbox" class="toggle-one"/></p>  
                                    <?php else: ?>
                     <div class="toggle btn btn-default off" data-toggle="toggle" style="width: 94px; height: 34px;"><input type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No"><div class="toggle-group"><label class="btn btn-primary toggle-on">Yes</label><label class="btn btn-default active toggle-off">No</label><span class="toggle-handle btn btn-default"></span></div></div>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                               <th>Member</th>
                               <th>Account Statu</th>
                               <th>Administrator</th>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                <div class="card-footer">
                    <p>
                   <?= Html::a('Change my username and/or my password', ['update', 'id'=>$user_->id], ['class' => 'btn btn-success']) ?>
                    </p>
                </div>
                 </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->   
</div>