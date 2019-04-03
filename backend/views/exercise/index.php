<?php

use common\models\User;
use yii\db\Query;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
/* @var $this View */

$this->title = 'Exercises';
$this->params['breadcrumbs'][] = $this->title;

$exercises = (new Query())->from('exercise')->all();
$effectif = (new Query())->from('exercise')->count();
$count = 0;
$month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
?>
<?php $user = User::findOne(['id'=>Yii::$app->user->id]); ?>
<div class="exercise-index">
    <div class="card" style="margin: 0 auto;width: 96%;">
            <div class="card-header">
              <h3 class="card-title">List of exercises</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
    <table id="example" class="table table-bordered table-striped" style="text-align: center;">
        <thead>
            <tr>
                <th>Year</th>
                <th>Month</th>
                <th>Duration</th>
                <th>Session Frequency</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($exercises as $exercise): ?>
            <?php $count++ ?>
            <tr>
                <td style="vertical-align: middle;"><?= $exercise['year'] ?></td>
                <td style="vertical-align: middle;"><?= $month[$exercise['month']] ?></td>
                <td style="vertical-align: middle;"><?= $exercise['duration'] ?></td>
                <td style="vertical-align: middle;"><?= $exercise['session_frequency'] ?></td>
                <td style="vertical-align: middle;">
                    <?php if($count != $effectif): ?>
       <a href="<?= Url::to(['exercise/view', 'id' => $exercise['id']])?>" class="btn btn-app">
                  <i class="fa fa-eye"></i> Details
                </a>
                    <?php endif;?> 
                    <?php if($count == $effectif): ?>     
                    <a href="<?= Url::to(['exercise/view', 'id' => $exercise['id']]) ?>" class="btn btn-app">
                  <i class="fa fa-eye"></i> Details
                </a>
                    <?php $user = User::findOne(['id'=>Yii::$app->user->id]) ?>
                    <?php if( $user!= NULL && $user->type == 1): ?>
                  <a href="<?= Url::to(['exercise/update', 'id' => $exercise['id']])?>" class="btn btn-app">
                  <i class="fa fa-edit"></i> Edit
                                        </a>
              <?= Html::a('<i class="fa fa-remove"></i> Delete', ['delete', 'id' => $exercise['id']], ['class' => 'btn btn-app',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
                    <?php endif; ?>
                 <?php endif;?> 
                                    </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Year</th>
                <th>Month</th>
                <th>Duration</th>
                <th>Session Frequency</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
            </div>
            <!-- /.card-body -->
     <?php if($user!= NULL && $user->type == 1): ?>
     <div class="card-footer">
     <p>
      <?= Html::a('Create Exercise', ['exercise/create'], ['class' => 'btn btn-success']) ?>
      <?php if($exercises != []): ?>
      <?= Html::a('End Exercise', ['exercise/end'], ['class' => 'btn btn-warning']) ?>
      <?php endif; ?>
    </p>
    </div>
            <?php endif;?>
    </div>
</div>