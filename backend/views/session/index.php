<?php

use common\models\Session;
use common\models\User;
use yii\db\Query;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
/* @var $this View */

$this->title = 'Sessions';
$this->params['breadcrumbs'][] = $this->title;
$sessions = Session::findAll(['id_exercise' => $exercise->id]);
$exercises = (new Query())->from('exercise')->orderBy('id')->all();
$effectif = (new Query())->from('session')->where(['id_exercise' => $exercise->id])->count();
$current_exercise_id = (new Query())->from('exercise')->max('id');
$month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
$count = 0;
?>
<?php $user = User::findOne(['id'=>Yii::$app->user->id]); ?>
<div class="session-index">
    <div class="card" id="changeable" style="margin: 0 auto;width: 96%;">
                <div class="card-header">
                    <h3 class="card-title">Exercise sessions</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select id='exercice_combo' onchange="change_exercice(2);" class="form-control select2" style="width: 30%;" tabindex="-1" aria-hidden="true">
                                    <?php
                                    foreach ($exercises as $item) {
                                        if ($item['id'] == $exercise->id) {
                                            echo '<option selected="selected" name ='.$item['id'].'>'.$month[$item['month']].' '.$item['year'].'</option>';
                                            
                                        }else{
                                            echo '<option name ='.$item['id'].'>'.$month[$item['month']].' '.$item['year'].'</option>';
                                        }
                                        $count++;
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                </div>
                <table id="example" class="table table-bordered table-striped" style="text-align: center;">
        <thead>
            <tr>
                <th>N°</th>
                <th>Date</th>
                <?php if($exercise->id == $current_exercise_id && $user->type == 1): ?>
                <th>Action</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php $count = 0; ?>
            <?php foreach ($sessions as $session): ?>
            <tr>
                <td style="vertical-align: middle;"><?= ++$count; ?></td>
                <td style="vertical-align: middle;"><?= date('d F, Y (l)', strtotime($session['date_'])); ?></td>
                <?php if($exercise->id == $current_exercise_id && $user->type == 1): ?>
                <td style="vertical-align: middle;">
                    <?php if($count == $effectif): ?>     
                  <a href="<?= Url::to(['session/update', 'id' => $session['id']])?>" class="btn btn-app">
                  <i class="fa fa-edit"></i> Edit
                                        </a>
              <?= Html::a('<i class="fa fa-remove"></i> Delete', ['delete', 'id' => $session['id']], ['class' => 'btn btn-app',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>                               
                 <?php endif;?> 
                </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>N°</th>
                <th>Date</th>
                <?php if($exercise->id == $current_exercise_id && $user->type == 1): ?>
                <th>Action</th>
                <?php endif; ?>
            </tr>
        </tfoot>
    </table>
                </div>
                <!-- /.card-body -->
    <?php if($exercise->id == $current_exercise_id && $user->type == 1) : ?>  
         <div class="card-footer">
            <p>
                <?= Html::a('Create Session', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
    <?php endif; ?>
            </div>
            <!-- /.card -->
</div>
        <!-- /.col -->
    <!-- /.row -->