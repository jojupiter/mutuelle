<?php

use common\models\Exercise;
use common\models\User;
use yii\db\Query;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Exercise */

$current_exercise_id = (new Query())->from('exercise')->max('id');
$month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
$this->title = $month[$model->month].' '.$model->year;
$this->params['breadcrumbs'][] = ['label' => 'Exercises', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exercise-view">
    <div class="card" style="margin: 0 auto;width: 96%;">
            <div class="card-header">
              <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
        <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'year',
            [
                'label' => 'Month',
                'value' => $month[$model->month],
            ],
            [
                'label' => 'Duration',
                'value' => $model->duration.' months',
            ],
            [
                'label' => 'Session Frequency',
                'value' => $model->session_frequency.' month(s)',
            ],
        ],
    ]) ?>
            </div>
                   <!-- /.card-body -->
                   <?php  if( $model->id == $current_exercise_id): ?>
                   <?php $user = User::findOne(['id'=>Yii::$app->user->id]); ?>
                   <?php if($user->type == 1): ?>
     <div class="card-footer">
     <p>
       
      <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    </div>
                   <?php endif; ?>
                   <?php endif; ?>
    </div>

</div>
