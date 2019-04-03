<?php

use backend\assets\AppAsset;
use common\models\Setting;
use common\models\User;
use yii\db\Query;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;
/* @var $this View */

$this->title = 'Settings';
$this->params['breadcrumbs'][] = $this->title;
$model = Setting::findOne(['id_exercise' => $exercise->id]);
$exercises = (new Query())->from('exercise')->orderBy('id');
$current_exercise_id = (new Query())->from('exercise')->max('id');
$month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
$count = 0;
AppAsset::register($this);
?>
<?php $user = User::findOne(['id'=>Yii::$app->user->id]); ?>
<div class="setting-index">
            <div class="card" id="changeable" style="margin: 0 auto;width: 96%;">
                <div class="card-header">
                    <h3 class="card-title">Exercise settings</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select id='exercice_combo' onchange="change_exercice(1)" class="form-control select2" style="width: 30%;" tabindex="-1" aria-hidden="true">
                                    <?php
                                    foreach ($exercises->each() as $item) {
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
<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Registration Fees',
                'value' => number_format($model->registration_fees,2,",",".").' FCFA'
            ],
            [
                'label' => 'Interest Rate',
                'value' => 100*$model->interest_rate.' %'
            ],
            [
                'label' => 'Amount Social Background Old Members',
                'value' => number_format($model->amount_sb_om,2,",",".").' FCFA'
            ],
            [
                'label' => 'Amount Social Background New Members',
                'value' => number_format($model->amount_sb_nm,2,",",".").' FCFA'
            ],
            [
                'label' => 'Social Background Payment Delay',
                'value' => $model->delays_sb.' month(s)',
            ],
            [
                'label' => 'Parent Death',
                'value' => number_format($model->parent_death,2,",",".").' FCFA'
            ],
            [
                'label' => 'Parent In Law Death',
                'value' => number_format($model->parent_in_law_death,2,",",".").' FCFA'
            ],
            [
                'label' => 'Member Death',
                'value' => number_format($model->member_death,2,",",".").' FCFA'
            ],
            [
                'label' => 'Partner Death',
                'value' => number_format($model->partner_death,2,",",".").' FCFA'
            ],
            [
                'label' => 'Childreen Death',
                'value' => number_format($model->member_death,2,",",".").' FCFA'
            ],
            [
                'label' => 'Birth',
                'value' => number_format($model->birth,2,",",".").' FCFA'
            ],
            [
                'label' => 'Wedding',
                'value' => number_format($model->wedding,2,",",".").' FCFA'
            ],
            [
                'label' => 'Other Happy Events',
                'value' => number_format($model->other_happy_events,2,",",".").' FCFA'
            ],
            [
                'label' => 'Other Unfortunate Events',
                'value' => number_format($model->other_unfortunate_events,2,",",".").' FCFA'
            ],
        ],
    ]) ?>
                </div>
                <!-- /.card-body -->
                <?php if($model->id_exercise == $current_exercise_id && $user->type == 1): ?>
                <div class="card-footer">
      <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_exercise], ['class' => 'btn btn-primary']) ?>
    </p>
    </div>
                <?php endif; ?>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    <!-- /.row -->
