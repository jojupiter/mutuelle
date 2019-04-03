<?php

use common\models\User;
use yii\db\Query;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;
/* @var $this View */

$this->title = 'Members';
$members = (new Query())->from('member')->all();
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $user = User::findOne(['id'=>Yii::$app->user->id]); ?>
<div class="member-index">
    <div class="card" style="margin: 0 auto;width: 96%;">
        <div class="card-header">
              <h3 class="card-title">List of members</h3>
        </div>
            <!-- /.card-header -->
            <div class="card-body">
    <table id="example" class="table table-bordered table-striped" style="text-align: center;">
        <thead>
            <tr>
                <th>Matricule</th>
                <th style="text-align: left">First Name</th>
                <th style="text-align: left">Last Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($members as $member): ?>
            <tr>
                <td style="vertical-align:middle"> 
<?= $member['matricule'] ?></td>
                <td style="text-align: left;vertical-align:middle"><?= $member['firstname'] ?></td>
                <td style="text-align: left;vertical-align:middle"><?= $member['lastname'] ?></td>
                <td style="vertical-align:middle"> 
                    <a href="<?= Url::to(['member/view', 'id' => $member['matricule']])?>" class="btn btn-app">
                  <i class="fa fa-eye"></i> Details
                                        </a>
                    <?php if($user->type == 1 || ($user->type == 0 && $user->id == $member['matricule'])): ?>
                  <a href="<?= Url::to(['member/update', 'id' => $member['matricule']])?>" class="btn btn-app">
                  <i class="fa fa-edit"></i> Edit
                                        </a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Matricule</th>
                <th style="text-align: left">First Name</th>
                <th style="text-align: left">Last Name</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
            </div>
            <!-- /.card-body -->
     <?php if($user->type == 1): ?>
     <div class="card-footer">
     <p>
         <?= Html::a('Create Member', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    </div>
    <?php endif; ?>
    </div>
</div>
